<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    public function heading() {
        return view("welcome");
    }
}

?>