<?php

namespace App\Http\Controllers;

use App\Servers;
use Illuminate\Http\Request;

class ServerController extends Controller
{

    protected $server;
    public function __construct(){
        $this->server = new Servers();
    }
    function index(){
        return view('pages.dashboard');
    }




    /*
     * Api Calls
     */
    function getServers(){
        return $this->server->getAllServers();
    }
}
