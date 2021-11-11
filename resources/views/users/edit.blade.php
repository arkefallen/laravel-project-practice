@extends('layouts.app')

@section('content')
    <div class="container">
            <h1>Modifikasi Profil User</h1>
            <form action="{{ route('user.update', $user->id ) }}" method="post" class="form" >
                @csrf
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                            </td>
                        </tr>
                        <tr>
                            <td>Level</td>
                            <td>
                                <input type="radio" name="level" value="user"
                                    @if($user->level == 'user')
                                        checked
                                    @endif>
                                <label for="level">User</label><br>
                                <input type="radio" name="level" value="admin"
                                    @if($user->level == 'admin')
                                        checked
                                    @endif>
                                <label for="level">Admin</label><br>
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
                <a href="{{ route('user') }}">Cancel</a>
            </form>
        </div>
    </div>
@endsection

