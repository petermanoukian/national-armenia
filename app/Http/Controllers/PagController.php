<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;



class PagController extends Controller
{
    public function index()
    {
         return view('welcome');
    }

}
