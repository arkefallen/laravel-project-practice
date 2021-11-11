@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah User Baru</h1>
        <form class="form" action="{{ route('user.store') }}" method="post">
            @csrf
            <table class="table">
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td>
                            <input type="text" name="name" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <input type="email" name="email" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>
                            <input type="password" name="password" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Level</td>
                        <td>
                            <input type="radio" name="level" value="user">
                            <label for="level">User</label><br>
                            <input type="radio" id="css" name="level" value="admin">
                            <label for="level">Admin</label><br>
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
            <a href="{{ route('user') }}">Cancel</a>
        </form>
    </div>
@endsection

