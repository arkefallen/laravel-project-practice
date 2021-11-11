@extends('layouts.app')

@section('content')
    {{-- <header>
        <a style="color: white;">Update Current Book</a>
    </header> --}}
    <div class="container">
        <h1>Update Current Book</h1>
        <form action="{{ route('book.update', $book->id ) }}" method="post" class="form" >
            @csrf
            <table class="table">
                <tbody>
                    <tr>
                        <td>Title</td>
                        <td>
                            <input class="form-control" type="text" name="title" value="{{ $book->title }}" style="width: 100%;">
                        </td>
                    </tr>
                    <tr>
                        <td>Author</td>
                        <td>
                            <input class="form-control" type="text" name="author" value="{{ $book->author }}" style="width: 100%;">
                        </td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>
                            <input class="form-control" type="number" name="price" value="{{ $book->price }}" style="width: 100%;">
                        </td>
                    </tr>
                    <tr>
                        <td>Published Date</td>
                        <td>
                            <input type="date" name="published_date" value="{{ $book->published_date }}" style="width: 100%;" class="date form-control" placeholder="yyyy/mm/dd">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="margin : 20px 0px 10px 0px;">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
            @if (count($errors) > 0)
                <ul class="alert alert-danger" style="margin-top: 20px;" >
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <a href="{{ route('book') }}">Cancel</a>
        </form>
    </div>
@endsection