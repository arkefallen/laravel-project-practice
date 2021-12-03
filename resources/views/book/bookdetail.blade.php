@extends('layouts.app')

@section('content')
    @if(Session::has('msg_success_comment'))
    <div class="alert alert-success">
        {{Session::get('msg_success_comment')}}
    </div>
    @endif
    <div class="container">
        <a href="{{ route('book.list') }}" class="my-4">
            <button class="btn btn-outline-primary">Kembali</button>
        </a>
        
        <h1>'{{ $bookData->title }}' Book Gallery</h1>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach ($galleries as $gallery)
            <div class="col">
                {{-- <div class="card"> --}}
                    <a href="{{ asset('assets/img/'.$gallery->image) }}"
                        data-lightbox="image-1" 
                        data-title="{{ $gallery->description }}"
                        class="card text-decoration-none text-center">
                    
                        <img src="{{ asset('assets/img/'.$gallery->image) }}" class="card-img-top">
                        <h5 class="card-title py-3">{{ $gallery->gallery_name }} </h5>
                    </a>
            </div>
        @endforeach
        <div style="margin-top : 20px;">{{ $galleries->links() }}</div>
        </div>
        <br>
        <hr>
        
        <div class="w-full">
            <h3>Komentar</h3>
            <form action="{{ route('book.comment', $bookData->id) }}" method="post">
                @csrf
                <textarea name="comment" id="" cols="30" rows="5" class="w-100 form-control my-3"></textarea>
                <button type="submit" class="btn btn-primary">Comment</button>
            </form>
        </div>

        @foreach ($comments as $comment)
            <div class="shadow p-3 my-4 rounded">
                <div class="g-mb-15">
                    <h5 class="h5 g-color-gray-dark-v1 mb-0">{{ $comment->users->name }}</h5> 
                </div>
                <p>{{ $comment->comment }}
                </p>
            </div>
        @endforeach

    </div>
@endsection