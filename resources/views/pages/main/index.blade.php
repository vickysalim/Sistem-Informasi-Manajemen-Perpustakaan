@extends('layout.main')

@section('title', 'Beranda')

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1>Cari Buku</h1>
            <p class="lead text-muted">Masukkan kata kunci dari judul atau pengarang buku.</p>
            <form action="#">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari buku" name="search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection