@extends('layouts.user')

<style>
    .book-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        gap: 10px;
    }

    .book-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin: 10px;
        width: 250px;
        text-align: center;
    }

    .book-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .book-card h3 {
        margin: 10px 0;
        font-size: 18px;
        color: #333;
    }

    .book-card p {
        font-size: 14px;
        color: #555;
    }

    .book-card .author {
        font-weight: bold;
        color: #007bff;
    }

    .btn-pinjam {
        display: inline-block;
        background-color: #007bff;
        color: white;
        padding: 8px 12px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 14px;
        font-weight: bold;
        transition: 0.3s;
        border: none;
        cursor: pointer;
    }

    .btn-pinjam:hover {
        background-color: #0056b3;
    }
</style>

@section('content')
    <div class="book-list">
        @foreach ($buku as $item)
            <div class="book-card">
                <img src="{{ asset('images/buku/' . $item->image) }}" alt="Judul Buku">
                <h3>{{ $item->judul }}</h3>
                <p class="author">{{ $item->penulis->nama_penulis }}</p>
                <p>{{ $item->deskripsi }}</p>
                <form action="{{ route('peminjaman', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Pinjam</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
