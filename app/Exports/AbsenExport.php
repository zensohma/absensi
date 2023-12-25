<?php

namespace App\Exports;

use App\Models\Absen;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AbsenExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $nama = auth()->user()->id;

        return Absen::with('siswa')->where('siswa_id', $nama)->get();
    }

    public function map($absen): array
    {
        return 
        [
            $absen->id,
            $absen->siswa->nama,
            $absen->tanggal,
            $absen->jam_masuk,
            $absen->jam_pulang
        ];
    }

    public function headings(): array
    {
        return 
        [
            'No.',
            'Nama',
            'Tanggal',
            'Jam Masuk',
            'Jam Pulang'
        ];
    }
}
