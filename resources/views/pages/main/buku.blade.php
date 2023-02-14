@extends('layout.main')

@section('title', 'Buku')

@section('content')
    <!-- Book Data -->
    <section class="jumbotron bg-white">
        <div class="container">
            <h1 class="text-center mb-4">{{ $bookData->name }}</h1>
            <table class="table table-bordered">
                <tr>
                    <th width="25%">Pengarang</th>
                    <td>{{ $bookData->author }}</td>
                </tr>
                <tr>
                    <th>Penerbit</th>
                    <td>{{ $bookData->publisher }}</td>
                </tr>
                <tr>
                    <th>Tahun Terbit</th>
                    <td>{{ $bookData->year }}</td>
                </tr>
                <tr>
                    <th>Kode ISBN</th>
                    <td>{{ $bookData->isbn }}</td>
                </tr>
                <tr>
                    <th>Jenis Buku</th>
                    <td>{{ $bookData->type }}</td>
                </tr>
                <tr>
                    <th>Ketersediaan Buku</th>
                    <td>
                        <div class="badge {{ $bookData->status == 'Tersedia' ? 'badge-success' : 'badge-danger'}}">{{ $bookData->status }}</div>
                    </td>
                </tr>
                <tr>
                    <th>Sampul Buku</th>
                    <td>
                        <img src="{{ $bookData->cover_url != '' ? asset('storage/cover/'.$bookData->cover_url) : 'https://via.placeholder.com/240x384' }}" alt="{{ $bookData->title }}" class="img-thumbnail" style="width: 240px; height: 384px; box-shadow: 0 0 0 0 !important; border: 0 !important;">
                    </td>
                </tr>
            </table>
        </div>
    </section>
@endsection