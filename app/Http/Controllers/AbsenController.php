<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Siswa;
use App\Exports\AbsenExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Siswa::all();
        $nama = auth()->user()->id;

        $filteredData = Absen::with('siswa')->where('siswa_id', $nama)->get();
        // dd($filteredData);

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
        // dd($request);
        // $request->validate([
        //     'siswa_id' => 'required',
        //     'status' => 'required'
        // ]);

        $data = $request->except(['_token']);
        $data['tanggal'] = date('Y-m-d');
        $data['jam_masuk'] = date('H:i:s');
        // dd($data);
        Absen::create($data);
        $nama = auth()->user()->id;

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
        // dd($request);

        if (empty($request->status) && empty($request->keterangan)) {
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

        if (!empty($request->status)) {
            $find = Absen::findOrFail($id);
            $find->update([
                'status' => $request->status
            ]);
        }
        if (!empty($request->keterangan)) {
            $find = Absen::findOrFail($id);
            $find->update([
                'keterangan' => $request->keterangan
            ]);
        }

        

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
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $data = Absen::find($id);
        $data->delete();
        
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

    public function filterDataByNama(Request $request)
    {
        // dd($request);
        $nama = $request->nama;

        $filteredData = Absen::with('siswa')->where('siswa_id', $nama)->get();
        $absen = Absen::all();
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

    public function pulang(Request $request, $id)
    {
        $find = Absen::findOrFail($id);
        
        $data = $request->except(['_token', 'nama']);
        $data['jam_pulang'] = date('H:i:s');
        $find->update($data);
        
        $nama = auth()->user()->id;
        
        $filteredData = Absen::with('siswa')->where('siswa_id', $nama)->get();
        // dd($filteredData);
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

    public function absenexport()
    {
        return Excel::download(new AbsenExport, 'Rekap Absen.xlsx');
    }
}
