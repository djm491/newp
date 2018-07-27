<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stream;

class StreamController extends Controller
{
    
   function showMassEditPage() {
   	  return view('pages.massEditStream');
   }


    /*
       Api Calls
    */ 
    function getStreams(){
    	return (new Stream())->getAllStreams();
    }

}
