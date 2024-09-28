<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkorderRequest;
use App\Http\Requests\UpdateWorkorderRequest;
use App\Models\DocumentationAfterWork;
use App\Models\DocumentationBeforeWork;
use App\Models\Workorder;
use App\Models\ListMaterial;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class WorkorderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function getMaterials(Workorder $workorder)
     {
         $materials = $workorder->listMaterials->map(function($listMaterial) {
             return [
                 'id_material' => $listMaterial->material_id,
                 'name' => $listMaterial->material->nama, // Ambil nama material dari relasi
                 'quantity' => $listMaterial->count
             ];
         });
 
         return response()->json([
            'status' => true,
            'message' => 'Berhasil mengambil list material workorder',
            'workorder' => $materials
        ]);
     }

     public function getListWorkorder(Request $request)
{
    $date = $request->query('date');
    $status = $request->query('status');
    
    $query = Workorder::query();
    
    // Tambahkan filter untuk mengecualikan status 'complete'
    $query->where('status', '!=', 'complete');

    if ($date) {
        $query->whereDate('created_at', $date);
    }

    if ($status) {
        $query->where('status', $status);
    }

    $workorders = $query->get();
    
    $waiting = Workorder::where('status', 'waiting')->count();
    $pending = Workorder::where('status', 'pending')->count();

    return response()->json([
        'status' => true,
        'message' => 'Berhasil mengambil workorder',
        'workorder' => $workorders,
        'waiting_workorders' => $waiting,
        'pending_workorders' => $pending,
    ]);
}

     public function getWorkorderCount()
     {   
         $waiting = Workorder::where('status', 'waiting')->count();
         $pending = Workorder::where('status', 'pending')->count();

         return response()->json([
             'status' => true,
             'message' => 'Berhasil mengambil jumlah workorder',
             'waiting_workorders' => $waiting,
             'pending_workorders' => $pending,
         ]);
     }

    public function index(Request $request)
    {
        $status = $request->input('status');

        // Jika status adalah "Ongoing", ambil data workorder tanpa memperhatikan user_id
        if ($status != "Ongoing") {
            $workorder = Workorder::where('status', $status)
                ->with('user','listMaterials.material', 'documentationBefore', 'documentationAfter')
                ->get();
        } else {
            // Jika bukan "Ongoing", gunakan ID pengguna seperti biasa
            $user_id = $request->user()->id;
        
            $workorder = Workorder::where('status', $status)
                ->where('user_id', $user_id)
                ->with('user','listMaterials.material', 'documentationBefore', 'documentationAfter')
                ->get();
        }
        
        return response()->json($workorder);
    }

    public function uploadImage(Request $request)
    {
        // Validasi request, pastikan file yang dikirim adalah gambar
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif', // Sesuaikan dengan kebutuhan Anda
        ]);

        if ($request->file('image')->isValid()) {
            // Simpan gambar ke storage atau folder tertentu
            $path = $request->file('image')->store('images', 'public'); // 'images' adalah nama folder penyimpanan

            // Mengembalikan path gambar untuk informasi selanjutnya atau respons yang sesuai
            return response()->json(['image_path' => $path]);
        } else {
            // Respons jika terjadi kesalahan saat menyimpan gambar
            return response()->json(['message' => 'Gagal menyimpan gambar'], 500);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     */

     public function updateStatus(Request $request, Workorder $workorder)
     {
         $request->validate([
             'status' => 'required|in:complete,pending',
         ]);

         $previousStatus = $workorder->status;
         $newStatus = $request->status;
     
         $workorder->update([
             'status' => $newStatus,
         ]);
     
         // Menambahkan notifikasi
         $notification = new Notification();
         $notification->workorder_id = $workorder->id;
         $notification->status = $newStatus;
         $notification->isi_notifikasi = "Workorder #{$workorder->nomor_tiket} status telah diperbarui dari {$previousStatus} menjadi {$newStatus}.";
         $notification->created_at = now();
         $notification->updated_at = now();
         $notification->save();
 
         // Redirect ke halaman detail dengan pesan sukses
         return redirect("/dashboard/workorder/{$workorder->id}")->with('status', 'Status updated successfully!');
     }
 
     // Metode untuk menambahkan catatan ke workorder
     public function addNote(Request $request, Workorder $workorder)
     {
         $request->validate([
             'note' => 'required|string|max:255',
         ]);
 
         $note = $request->note;

         $workorder->catatan = $note;
         $workorder->save();
          // Menambahkan notifikasi
        $notification = new Notification();
        $notification->workorder_id = $workorder->id;
        $notification->status = $workorder->status;
        $notification->isi_notifikasi = "Workorder #{$workorder->nomor_tiket} telah ditambahkan catatan baru: {$note}.";
        $notification->created_at = now();
        $notification->updated_at = now();
        $notification->save();
 
         // Redirect ke halaman detail dengan pesan sukses
         return redirect("/dashboard/workorder/{$workorder->id}")->with('status', 'Catatan added successfully!');
     }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'nomor_tiket' => 'required|string',
            'witel' => 'required|string',
            'sto' => 'required|string',
            'headline' => 'required|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'list_material' => 'required|array',
            'list_material.*.id' => 'required|integer',
            'list_material.*.quantity' => 'required|integer',
            'evidence_before' => 'required|string',
            'evidence_after' => 'required|string',
            'status' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
    
        try {
            DB::transaction(function () use ($request) {
                // Cek apakah workorder dengan nomor_tiket yang sama sudah ada
                $workorder = Workorder::updateOrCreate(
                    ['nomor_tiket' => $request->nomor_tiket],
                    [
                        'user_id' => $request->user_id,
                        'witel' => $request->witel,
                        'sto' => $request->sto,
                        'headline' => $request->headline,
                        'lat' => $request->lat,
                        'lng' => $request->lng,
                        'evidence_before' => $request->evidence_before ?? null,
                        'evidence_after' => $request->evidence_after ?? null,
                        'status' => $request->status,
                    ]
                );
    
                // Hapus material lama jika ada
                ListMaterial::where('workorder_id', $workorder->id)->delete();
    
                // Tambah material yang baru
                foreach ($request->list_material as $material) {
                    ListMaterial::create([
                        'workorder_id' => $workorder->id,
                        'material_id' => $material['id'],
                        'count' => $material['quantity'],
                    ]);
                }
    
                // Membuat notifikasi
                if ($workorder->wasRecentlyCreated) {
                    $notification = new Notification();
                    $notification->workorder_id = $workorder->id;
                    $notification->status = 'waiting';
                    $notification->isi_notifikasi = 'Workorder #' . $workorder->nomor_tiket . ' telah dibuat dan menunggu pengecekan oleh admin.';
                    $notification->created_at = now();
                    $notification->updated_at = now();
                    $notification->save();
                } else {
                    $notification = new Notification();
                    $notification->workorder_id = $workorder->id;
                    $notification->status = 'waiting';
                    $notification->isi_notifikasi = 'Workorder #' . $workorder->nomor_tiket . ' telah diperbarui.';
                    $notification->created_at = now();
                    $notification->updated_at = now();
                    $notification->save();
                }
            });
    
            return response()->json([
                'status' => true,
                'message' => 'Workorder updated successfully',
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create or update workorder',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Workorder $id)
    {
        $workorder = Workorder::find($id);
        return response()->json($workorder);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workorder $workorder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkorderRequest $request, Workorder $id)
    {
        return response()->json(['message' => 'Workorder berhasil diperbarui', 'workorder' => $request]);

    //    // Mendapatkan data yang dikirim dari Flutter
    //    $dataFromFlutter = $request->all(); // Mendapatkan semua data dari request

    //    // Mengambil workorder berdasarkan ID yang dikirim dari Flutter
    //    $workorder = Workorder::findOrFail($id);

    //    // Lakukan update data workorder
    //    $workorder->update($dataFromFlutter);

       // Jika ingin memberikan respons ke aplikasi Flutter
    //    return response()->json(['message' => 'Workorder berhasil diperbarui', 'workorder' => $workorder]);
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workorder $id)
    {
        $workorder = Workorder::find($id);
        $workorder->delete();

        return response()->json('Workorder deleted successfully');
    }
}
