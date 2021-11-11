<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Middleware\Authenticate;

class MajorController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth');
    }

    public function heading() {
        return view("major");
    }
}
