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
        $data = Siswa::all();
        $filteredData = [];

        return view('dashboard.absen', [
            'data' => $data,
            'filteredData' => $filteredData,
            'nama' => '',
            'selected' => ''
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
        dd($request);
        $request->validate([
            'siswa_id' => 'required',
            'tanggal' => 'required',
            'jam_masuk' => 'required',
            'status' => 'required'
        ]);

        $data = $request->except(['_token']);
        Absen::create($data);
        $nama = $request->nama;

        $filteredData = Absen::with('siswa')->where('siswa_id', $nama)->get();
        $absen = Absen::all();
        $data = Siswa::all();

        return response()->json([
            'filteredData' => $filteredData,
            'absen' => $absen,
            'data' => Siswa::all(),
            'nama' => $nama,
            'selected' => ''
        ]); 
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
    public function update(Request $request, $id)
    {
        $find = Absen::findOrFail($id);
        // dd($nama);
        // $request->validate([
        //     'siswa_id' => 'required',
        //     'tanggal' => 'required',
        //     'jam_masuk' => 'required',
        //     'jam_keluar' => 'required',
        //     'status' => 'required'
        // ]);
        // dd($request);
        
        $data = $request->except(['_token', 'nama']);
        // dd($data);
        $find->update($data);

        // return redirect()->back()->with($request->nama);
        return redirect('/absensi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Absen::find($id);
        $data->delete();
        
        return redirect('/absensi');
    }

    public function filterDataByNama(Request $request)
    {
        // dd($request);
        $nama = $request->nama;

        $filteredData = Absen::with('siswa')->where('siswa_id', $nama)->get();
        $absen = Absen::all();
        $data = Siswa::all();
        // dd($data);

        return response()->json([
            'filteredData' => $filteredData,
            'absen' => $absen,
            'data' => Siswa::all(),
            'nama' => $nama,
            'selected' => ''
        ]);
        // return view('dashboard.absen', [
        //     'filteredData' => $filteredData,
        //     'absen' => $absen,
        //     'data' => Siswa::all(),
        //     'nama' => $nama,
        //     'selected' => ''
        // ]);
    }
}
