<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Middleware\Authenticate;
use App\User;

class UsersController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maxPage = 3;
        $usersData = User::orderBy('id','desc')->paginate($maxPage);
        $totalUsers = User::count('name');

        $num = $maxPage * ($usersData->currentPage()-1);
        return view('users',compact('usersData','num','totalUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $this->validate($req, [
            'name' => 'required|string',
            'email' => 'required|string',
            'level' => 'required|string',
            'password' => 'required|string',
        ]);
        $users = new User();
        $users->name = $req->name;
        $users->email = $req->email;
        $users->password = $req->password;
        $users->level = $req->level;
        $users->save();
        return redirect('/user')->with('msg_success_store','Successfully saving a data.');
    }

    public function search(Request $req) {
        $maxPage = 3;
        $findUsers = $req->sentence;
        $usersData = User::where('name','like',"%".$findUsers."%")->orwhere('level','like',"%".$findUsers."%")->paginate($maxPage);
        $totalUsers = count($usersData);

        $num = $maxPage * ($usersData->currentPage()-1);
        return view('users',compact('usersData','num','totalUsers','findUsers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $req)
    {
        $this->validate($req, [
            'name' => 'required|string',
            'email' => 'required|string',
            'level' => 'required|string',
            'password' => 'required|string',
        ]);
        $users = User::find($id);
        $users->name = $req->name;
        $users->email = $req->email;
        $users->password = $req->password;
        $users->level = $req->level;
        $users->update();
        return redirect('/user')->with('msg_success_update','Successfully updating a data');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/user')->with('msg_success_remove','Successfully removing a data');
    }
}
