<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Absen::all();
        $filteredData = [];

        return view('dashboard.absen', [
            'data' => $data,
            'filteredData' => $filteredData
        ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Absen $absen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absen $absen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absen $absen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absen $absen)
    {
        //
    }

    public function filterDataByNama(Request $request)
    {
        $nama = $request->nama;
        // dd($nama);

        $filteredData = Absen::where('siswa_id', $nama)->get();
        $data = Absen::all();

        return view('dashboard.absen', [
            'filteredData' => $filteredData,
            // 'siswa' => Siswa::all(),
            'data' => $data
        ]);
    }
}
