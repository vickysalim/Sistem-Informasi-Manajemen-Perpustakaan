@extends('layout.pdf')

@section('title', 'Laporan Buku')

@section('content')
    <div class="text-center">
        <h3>Laporan Transaksi Peminjaman</h3>
        <h4>Perpustakaan {{ $institutionNameData->value }}</h4>
    </div>

    <hr>

    <div>
        <table style="width:auto !important;">
            <tr>
                <td>Total Kunjungan</td>
                <td>:</td>
                <td>{{ $visitingCountData }} kali</td>
            </tr>
            <tr>
                <td>Total Pengunjung</td>
                <td>:</td>
                <td>{{ $visitorCountData }} anggota</td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Anggota</th>
                <th>Nama Anggota</th>
                <th>Jumlah Kunjungan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topVisitorData as $item)
                <tr>
                    <td class="text-center">{{ $loop->index + 1 }}</td>
                    <td>{{ $item->member_id }}232323</td>
                    <td>{{ $item->Member->name }}</td>
                    <td>{{ $item->total }} kali kunjungan</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h6>Tabel 10 anggota dengan kunjungan terbanyak</h6>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Anggota</th>
                <th>Nama Anggota</th>
                <th>Tanggal Kunjungan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visitorData as $item)
                <tr>
                    <td class="text-center">{{ $loop->index + 1 }}</td>
                    <td>{{ $item->member_id }}232323</td>
                    <td>{{ $item->Member->name }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="float:right;">
        <table class="footer">
            <tr>
                <td colspan="2" class="text-center">{{ $cityData->value }}, {{ date('d M Y', strtotime($printDateData)) }}</td>
            </tr>
            <tr>
                <td>Mengetahui</td>
                <td>Kepala Perpustakaan</td>
            </tr>
            <tr>
                <td>Kepala Sekolah</td>
            </tr>
            <tr class="signature-space">
                <td>{{ $principalData->value }}</td>
                <td>{{ $headLibrarianData->value }}</td>
            </tr>
        </table>
    </div>
@endsection