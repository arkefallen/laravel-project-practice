@extends('layouts.app')

@section('content')
    @if (Auth::check() && Auth::user()->level == 'admin')
        @if(Session::has('msg_success_store'))
            <div class="alert alert-success">
                {{Session::get('msg_success_store')}}
            </div>
        @endif
        @if(Session::has('msg_success_update'))
            <div class="alert alert-success">
                {{Session::get('msg_success_update')}}
            </div>
        @endif
        @if(Session::has('msg_success_remove'))
            <div class="alert alert-success">
                {{Session::get('msg_success_remove')}}
            </div>
        @endif
        <div class="container">
            <h2>Cari Buku Favorit Anda</h2>
            <form action="{{ route('book.search') }}" method="get">
                @csrf
                <input type="text" name="sentence" class="form-control" placeholder="Ketikkan buku yang anda cari disini..." style="width: 100%; display:inline; margin-top:10px; margin-bottom:20px;">
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Price</th>
                        <th>Publish Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookData as $book)
                    <tr>
                        <td>{{++$num}}</td>
                        <td>{{$book->title}}</td>
                        <td>{{$book->author}}</td>
                        <td>{{number_format($book->price, 0, ',','.')}}</td>
                        <td>{{$book->published_date->format('d/m/Y')}}</td>
                        <td style="display: flex; flex-direction:row;">
                            <form  action="{{ route('book.destroy',$book->id) }}" method="post">
                                @csrf
                                <button class="btn btn-danger" onclick="return confirm('Are you sure about that ?')">
                                Remove
                                </button>
                            </form>
                            <form  action="{{ route('book.edit', $book->id ) }}" method="get">
                                @csrf
                                <button class="btn btn-secondary">Edit</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p>Buku yang ada sebanyak : {{$totalBooks}}</p>
            <p>Jumlah harga semua buku : {{$totalPrice}}</p>
            <a href="{{ route('book.create') }}">
                <button class="btn btn-primary">Add Book</button>
            </a>
            <div style="margin-top : 20px;">{{ $bookData->links() }}</div>
        </div>
    @else
        <h1>Login Dulu</h1>
    @endif
@endsection