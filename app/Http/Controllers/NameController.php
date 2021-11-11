<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Middleware\Authenticate;

class NameController extends Controller
{

    public function __construct()
    {   
        $this->middleware('auth');
    }

    public function heading() {
        return view("name");
    }
}

?>