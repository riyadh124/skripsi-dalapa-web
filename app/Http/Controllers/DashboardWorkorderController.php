<?php

namespace App\Http\Controllers;

use App\Models\Workorder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardWorkorderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.workorder.index',[
            'workorders' => Workorder::with('user','listMaterials.material',)
            ->get()
           ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.workorder.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->all();

        // Simpan data ke dalam database
        Workorder::create($data);

        return redirect('/dashboard/workorder')->with('success','New post has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Workorder $workorder)
    {
      
       $listMaterials = $workorder->listMaterials()->with('material')->get();

        return view('dashboard.workorder.show', [
            'workorder' => $workorder,
            'listMaterials' => $listMaterials
        ]);
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
        Workorder::destroy($workorder->id);

        return redirect('/dashboard/workorder')->with('success','Workorder has been deleted!');
    }
}
