<?php

namespace App\Exports;

use App\Models\Anggota;
use App\Models\Perhimpunan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PerhimpunanMemberExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    private int $no = 1;

    public function __construct(private Perhimpunan $perhimpunan)
    {
    }

    public function collection()
    {
        return Anggota::where('perhimpunan_id', $this->perhimpunan->id)
            ->whereHas('user', fn ($query) => $query->where('is_active', 1))
            ->orderBy('no_kartu_anggota')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'No. Anggota',
            'Nama',
            'Email',
            'No HP',
            'No KTP',
            'Alamat',
            'Profesi',
            'No. STR',
            'STR Berlaku Sampai',
            'KTA Berlaku Sampai',
            'Tanggal Verifikasi',
            'Tanggal Daftar',
        ];
    }

    public function map($anggota): array
    {
        return [
            $this->no++,
            $anggota->no_kartu_anggota ?? '-',
            $anggota->nama ?? '-',
            $anggota->email ?? '-',
            $anggota->no_hp ?? '-',
            // Prefix ' agar Excel tidak mengubah angka panjang jadi notasi ilmiah
            $anggota->noktp ? "'" . $anggota->noktp : '-',
            $anggota->alamat ?? '-',
            $anggota->profesi ?? '-',
            $anggota->no_str ?? '-',
            $anggota->str_berlaku_sampai ? $anggota->str_berlaku_sampai->format('d-m-Y') : ($anggota->no_str ? 'Seumur hidup' : '-'),
            $anggota->kta_berlaku_sampai ? $anggota->kta_berlaku_sampai->format('d-m-Y') : '-',
            $anggota->tanggal_verifikasi ? $anggota->tanggal_verifikasi->format('d-m-Y H:i') : '-',
            $anggota->created_at ? $anggota->created_at->format('d-m-Y H:i') : '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
