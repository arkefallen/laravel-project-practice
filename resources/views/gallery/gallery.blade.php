@extends('layouts.app')

@section('content')
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
        <h1>Kelola Galeri Foto</h1>
        {{-- <form action="{{ route('user.search') }}" method="get">
            @csrf
            <input type="text" name="sentence" class="form-control" placeholder="Ketikkan user yang anda cari disini..." style="width: 100%; display:inline; margin-top:10px; margin-bottom:20px;">
        </form> --}}
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Galeri</th>
                    <th>Nama Buku</th>
                    <th>Foto</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($galleries as $gallery)
                <tr>
                    <td>{{++$num}}</td>
                    <td>{{$gallery->gallery_name}}</td>
                    <td>{{$gallery->bookAsForeignKey->title}}</td>
                    <td>
                        <img src="{{ asset('assets/img/'.$gallery->image) }}" style="width:100px;">
                    </td>
                    <td>
                        <section class="d-flex flex-row">
                            <form  action="{{ route('gallery.destroy',$gallery->id) }}" method="post">
                                @csrf
                                <button class="btn btn-danger" onclick="return confirm('Are you sure about that ?')" style="margin-right: 20px">
                                Hapus
                                </button>
                            </form>
                            <form  action="{{ route('gallery.edit', $gallery->id ) }}" method="get">
                                @csrf
                                <button class="btn btn-secondary">Ubah</button>
                            </form>
                        </section>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p>Jumlah Galeri : {{$totalGallery}}</p>
        <a href="{{ route('gallery.create') }}">
            <button class="btn btn-primary">Tambah Galeri</button>
        </a>
        <div style="margin-top : 20px;">{{ $galleries->links() }}</div>
    </div>
@endsection