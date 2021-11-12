@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifikasi Galeri</h1>
        <form class="form" action="{{ route('gallery.update', $gallery->id ) }}" method="post" enctype="multipart/form-data">
            @csrf
            <table class="table">
                <tbody>
                    <tr>
                        <td>Judul</td>
                        <td>
                            <input type="text" name="gallery_name" class="form-control" value="{{ $gallery->gallery_name }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Buku</td>
                        <td>
                            <select name="book_id" id="" class="form-control">
                                <option value="{{ $gallery->book_id }}" selected>{{ $gallery->bookAsForeignKey->title }}</option>
                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>
                            <textarea name="description" class="form-control">{{ $gallery->description }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Upload Foto</td>
                        <td>
                            <input type="file" name="image" class="form-control" value="{{ $gallery->image }}">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="margin : 20px 0px 10px 0px;">
                <button class="btn btn-primary" type="submit">Simpan</button>
                @if (count($errors) > 0)
                    <ul class="alert alert-danger" style="margin-top: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <a href="{{ route('gallery') }}">Kembali</a>
        </form>
    </div>
@endsection

