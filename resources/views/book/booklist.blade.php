@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Buku</h1>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach ($bookData as $book)
            <div class="col">
                <div class="card">
                    <img src="{{ asset('assets/img/'.$book->photo) }}" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $book->title }} </h5>
                        <form  action="{{ route('book.gallery', $book->book_seo ) }}" method="get">
                            @csrf
                            <button class="btn btn-secondary">Lihat Detail</button>
                        </form>
                        <form  action="{{ route('book.like', $book->id ) }}" method="post">
                            @csrf
                            <button class="btn btn-warning btn-sm" type="submit">
                                <i class="fa fa-thumbs-up"></i>Like
                                <span class="badge-badge-light">{{ $book->like }}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        <div style="margin-top : 20px;">{{ $bookData->links() }}</div>
        <a href="{{ route('book') }}">
            <button class="btn btn-outline-primary">Kembali</button>
        </a>
    </div>
@endsection