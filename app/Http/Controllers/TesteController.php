<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteController extends Controller
{
    function index()
    {
        return view('site/teste');
    }

}
