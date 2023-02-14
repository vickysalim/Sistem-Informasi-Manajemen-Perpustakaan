@extends('layout.main')

@section('title', 'Hasil Pencarian')

@section('content')
    <!-- Search Book -->
    <section class="jumbotron text-center">
        <div class="container">
            <h1>Cari Buku</h1>
            <p class="lead text-muted">Masukkan kata kunci dari judul atau pengarang buku.</p>
            <form action="{{ route('cari') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari buku" name="keyword" value="{{ request()->keyword }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Book List -->
    <section class="jumbotron bg-white py-2">
        <div class="container">
            <h4 class="text-center mb-4">Ditemukan <span class="text-primary">{{ count($bookData) }}</span> Hasil Pencarian untuk <span class="text-primary">{{ request()->keyword }}</span></h4>
            <div class="row">
                @foreach ($bookData as $item)
                    <div class="card col-12 mb-3">
                        <a class="row" href="{{ route('deskripsi', $item->id) }}">
                            <div class="col-auto">
                                <img src="{{ $item->cover_url != '' ? asset('storage/cover/'.$item->cover_url) : 'https://via.placeholder.com/120x192' }}" alt="{{ $item->title }}" class="img-thumbnail" style="width: 120px; height: 192px; box-shadow: 0 0 0 0 !important; border: 0 !important;">
                            </div>
                            <div class="col-auto">
                                <h5 class="mt-2">{{ $item->name }}</h5>
                                <div style="color: black;">{{ $item->author }}</div>
                                <div>
                                    <small class="text-muted">{{ $item->publisher }} - {{ $item->year }}</small>
                                </div>
                                <div>
                                    <small class="text-muted">ISBN: {{ $item->isbn }}</small>
                                </div>
                                <div class="badge {{ $item->status == 'Tersedia' ? 'badge-success' : 'badge-danger'}} mt-4">{{ $item->status }}</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection