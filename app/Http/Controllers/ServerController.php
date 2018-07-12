<?php

namespace App\Http\Controllers;

use App\Servers;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function index(){
        return view('pages.dashboard');
    }
}
