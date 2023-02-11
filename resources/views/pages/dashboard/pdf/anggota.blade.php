@extends('layout.pdf')

@section('title', 'Laporan Transaksi')

@section('content')
    <div class="text-center">
        <h3>Laporan Anggota</h3>
        <h4>Perpustakaan {{ $institutionNameData->value }}</h4>
    </div>

    <hr>

    <div>
        <table style="width:auto !important;">
            <tr>
                <td>Total Anggota</td>
                <td>:</td>
                <td>{{ $memberCountData }} anggota</td>
            </tr>
            <tr>
                <td>Total Anggota Aktif</td>
                <td>:</td>
                <td>{{ $activeMemberCountData }} anggota</td>
            </tr>
            <tr>
                <td>Total Anggota Tidak Aktif</td>
                <td>:</td>
                <td>{{ $inactiveMemberCountData }} anggota</td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($memberData as $item)
                <tr>
                    <td class="text-center">{{ $loop->index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->status }}</td>
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