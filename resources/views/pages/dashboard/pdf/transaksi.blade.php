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
                <td>Total Peminjam</td>
                <td>:</td>
                <td>{{ $loaneeCountData }} anggota</td>
            </tr>
            <tr>
                <td>Total Transaksi Peminjaman</td>
                <td>:</td>
                <td>{{ $transactionCountData }} transaksi</td>
            </tr>
            <tr>
                <td>Rata-rata Peminjaman Perhari</td>
                <td>:</td>
                <td>{{ round($loanAverageData, 4) }} peminjaman / hari</td>
            </tr>
            <tr>
                <td>Jumlah Denda</td>
                <td>:</td>
                <td>Rp. {{ $fineSumData }}</td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Anggota</th>
                <th>Nama Anggota</th>
                <th>ID Buku</th>
                <th>Judul Buku</th>
                <th>Status Peminjaman</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Total Denda</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($circulationData as $item)
                <tr>
                    <td class="text-center">{{ $loop->index + 1 }}</td>
                    <th>{{ $item->member_id }}232323</th>
                    <td>{{ $item->Member->name }}</td>
                    <th>{{ $item->book_id }}</th>
                    <td class="text-center">{{ $item->Book->name }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->loan_date }}</td>
                    <td>{{ $item->return_date }}</td>
                    <td class="text-center">{{ $item->fine_sum }}</td>
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