<?php

namespace App\Exports;

use App\Models\Anggota;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AdminExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        try {
            return Anggota::where('spesialis', '')
                ->whereHas('user', function ($query) {
                    $query->where('is_active', 1);
                })
                ->with('user')
                ->get();
        } catch (\Exception $e) {
            Log::error('AdminExport collection error: ' . $e->getMessage());
            return collect([]); // Return empty collection instead of failing
        }
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Email',
            'No HP',
            'Profesi',
            'Alamat',
            'Kota',
            'Provinsi',
            'KTP',
            'NPWP',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Status',
            'Tanggal Daftar'
        ];
    }

    public function map($anggota): array
    {
        static $no = 1;

        try {
            return [
                $no++,
                $anggota->nama ?? '-',
                $anggota->email ?? '-',
                $anggota->no_hp ?? '-',
                $anggota->profesi ?? '-',
                $anggota->alamat ?? '-',
                $anggota->kota ?? '-',
                $anggota->provinsi ?? '-',
                $anggota->ktp ?? '-',
                $anggota->npwp ?? '-',
                $anggota->tempat_lahir ?? '-',
                $anggota->tanggal_lahir ? date('d-m-Y', strtotime($anggota->tanggal_lahir)) : '-',
                ($anggota->user && $anggota->user->is_active) ? 'Aktif' : 'Tidak Aktif',
                $anggota->created_at ? $anggota->created_at->format('d-m-Y H:i') : '-'
            ];
        } catch (\Exception $e) {
            Log::error('AdminExport mapping error: ' . $e->getMessage());
            return [
                $no++,
                '-',
                '-',
                '-',
                '-',
                '-',
                '-',
                '-',
                '-',
                '-',
                '-',
                '-',
                '-',
                '-'
            ];
        }
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
