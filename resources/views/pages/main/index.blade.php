@extends('layout.main')

@section('title', 'Beranda')

@section('content')
    <!-- Search Book -->
    <section class="jumbotron text-center">
        <div class="container">
            <h1>Cari Buku</h1>
            <p class="lead text-muted">Masukkan kata kunci dari judul atau pengarang buku.</p>
            <form action="{{ route('cari') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari buku" name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Book List -->
    <section class="jumbotron bg-white py-2">
        <div class="container">
            <h4 class="text-center mb-4">Buku Terbaru</h4>
            <div class="d-flex flex-wrap justify-content-around">
                @foreach ($bookData as $item)
                    <a href="#" title="{{ $item->name }} - {{ $item->author }}">
                        <img src="http://via.placeholder.com/120x192" alt="{{ $item->title }}" class="img-thumbnail" style="width: 120px; height: 192px;">
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection