@extends('layout.pdf')

@section('title', 'Laporan Buku')

@section('content')
    <div class="text-center">
        <h3>Laporan Koleksi Buku</h3>
        <h4>Perpustakaan {{ $institutionNameData->value }}</h4>
    </div>

    <hr>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis</th>
                <th>ID Buku</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>ISBN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookData as $item)
                <tr>
                    <td class="text-center">{{ $loop->index + 1 }}</td>
                    <td>{{ $item->type }}</td>
                    <td class="text-center">{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->author }}</td>
                    <td>{{ $item->publisher }}</td>
                    <td class="text-center">{{ $item->year }}</td>
                    <td class="text-center">{{ $item->isbn }}</td>
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