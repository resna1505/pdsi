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

class MemberExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        try {
            return Anggota::where('spesialis', '!=', '')
                ->whereHas('user', function ($query) {
                    $query->where('is_active', 1);
                })
                ->with('user')
                ->get();
        } catch (\Exception $e) {
            Log::error('MemberExport collection error: ' . $e->getMessage());
            return collect([]);
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
            'Spesialis',
            'Alamat',
            'Kota',
            'Provinsi',
            'KTP',
            'NPWP',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Twitter URL',
            'LinkedIn URL',
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
                $anggota->spesialis ?? '-',
                $anggota->alamat ?? '-',
                $anggota->kota ?? '-',
                $anggota->provinsi ?? '-',
                $anggota->ktp ?? '-',
                $anggota->npwp ?? '-',
                $anggota->tempat_lahir ?? '-',
                $anggota->tanggal_lahir ? date('d-m-Y', strtotime($anggota->tanggal_lahir)) : '-',
                $anggota->twitter_url ?? '-',
                $anggota->linkedin_url ?? '-',
                ($anggota->user && $anggota->user->is_active) ? 'Aktif' : 'Tidak Aktif',
                $anggota->created_at ? $anggota->created_at->format('d-m-Y H:i') : '-'
            ];
        } catch (\Exception $e) {
            Log::error('MemberExport mapping error: ' . $e->getMessage());
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
