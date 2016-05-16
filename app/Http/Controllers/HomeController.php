<?php

namespace TeachMe\Http\Controllers;

use Illuminate\Http\Request;

use TeachMe\Http\Requests;

class HomeController extends Controller
{
    //

    public function index(){

        return view('home');

    }
}
