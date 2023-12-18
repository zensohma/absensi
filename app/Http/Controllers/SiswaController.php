<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Siswa::all();

        return view('dashboard.siswa', compact('data'));
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
        $request->validate([
            'nama' => 'required',
            'sekolah' => 'required',
            'jurusan' => 'required',
            'kelas' => 'required',
            'no_hp' => 'required',
            'nis' => 'required',
            'password' => 'required'
        ]);

        Siswa::create([
            'nama' => $request->nama,
            'sekolah' => $request->sekolah,
            'jurusan' => $request->jurusan,
            'kelas' => $request->kelas,
            'no_hp' => $request->no_hp,
            'nis' => $request->nis,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/siswa');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $find = Siswa::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'sekolah' => 'required',
            'jurusan' => 'required',
            'kelas' => 'required',
            'no_hp' => 'required',
            'nis' => 'required',
            'password' => 'required'
        ]);

        $find->update([
            'nama' => $request->nama,
            'sekolah' => $request->sekolah,
            'jurusan' => $request->jurusan,
            'kelas' => $request->kelas,
            'no_hp' => $request->no_hp,
            'nis' => $request->nis,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/siswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $find = Siswa::findOrFail($id);
        
        $find->delete();

        return redirect('/siswa');
    }
}
