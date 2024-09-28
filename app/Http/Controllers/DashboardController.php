<?php

namespace App\Http\Controllers;

use App\Models\Workorder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('list_materials')
            ->join('workorders', 'list_materials.workorder_id', '=', 'workorders.id')
            ->join('materials', 'list_materials.material_id', '=', 'materials.id')
            ->select('list_materials.*', 'workorders.nomor_tiket', 'materials.nama as material_nama', 'materials.harga as material_harga', 'list_materials.created_at')
            ->where('workorders.status', 'complete'); // Filter untuk hanya menampilkan material dari workorder yang statusnya 'complete'
    
        $filter = $request->input('filter');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        if ($filter) {
            switch ($filter) {
                case 'daily':
                    $query->whereDate('list_materials.created_at', Carbon::today());
                    break;
                case 'weekly':
                    $query->whereBetween('list_materials.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;
                case 'monthly':
                    $query->whereMonth('list_materials.created_at', Carbon::now()->month);
                    break;
                case 'yearly':
                    $query->whereYear('list_materials.created_at', Carbon::now()->year);
                    break;
            }
        }
    
        if ($startDate && $endDate) {
            $query->whereBetween('list_materials.created_at', [$startDate, $endDate]);
        }
    
        $materialTransactions = $query->get();
    
        $totalCost = $materialTransactions->sum(function($transaction) {
            return $transaction->material_harga * $transaction->count;
        });
    
        return view('dashboard.index', compact('materialTransactions', 'totalCost'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, Workorder $workorder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workorder $workorder)
    {
        
    }
}
