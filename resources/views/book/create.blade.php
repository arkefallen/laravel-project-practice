@extends('layouts.app')

@section('content')
    {{-- <header>
        <div class="links">
            <a style="color: white;">Add New Book</a>
        </div>
    </header> --}}
    <div class="container">
        <h1>Add New Book</h1>
        <form class="form" action="{{ route('book.store') }}" method="post">
            @csrf
            <table class="table">
                <tbody>
                    <tr>
                        <td>Title</td>
                        <td>
                            <input type="text" name="title" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Author</td>
                        <td>
                            <input type="text" name="author" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>
                            <input type="number" name="price" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Published Date</td>
                        <td>
                            <input type="date" name="published_date" class="date form-control" placeholder="yyyy/mm/dd">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="margin : 20px 0px 10px 0px;">
                <button class="btn btn-primary" type="submit">Save</button>
                @if (count($errors) > 0)
                    <ul class="alert alert-danger" style="margin-top: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <a href="{{ route('book') }}">Cancel</a>
        </form>
    </div>
@endsection

