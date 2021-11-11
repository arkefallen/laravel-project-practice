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
        <h1>Kelola User</h1>
        <form action="{{ route('user.search') }}" method="get">
            @csrf
            <input type="text" name="sentence" class="form-control" placeholder="Ketikkan user yang anda cari disini..." style="width: 100%; display:inline; margin-top:10px; margin-bottom:20px;">
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usersData as $user)
                <tr>
                    <td>{{++$num}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->level}}</td>
                    <td style="display: flex; flex-direction:row;">
                        <form  action="{{ route('user.destroy',$user->id) }}" method="post">
                            @csrf
                            <button class="btn btn-danger" onclick="return confirm('Are you sure about that ?')" style="margin-right: 20px">
                            Remove
                            </button>
                        </form>
                        <form  action="{{ route('user.edit', $user->id ) }}" method="get">
                            @csrf
                            <button class="btn btn-secondary">Edit</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p>Jumlah User : {{$totalUsers}}</p>
        <a href="{{ route('user.create') }}">
            <button class="btn btn-primary">Add User</button>
        </a>
        <div style="margin-top : 20px;">{{ $usersData->links() }}</div>
    </div>
@endsection