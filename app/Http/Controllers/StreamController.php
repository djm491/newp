<?php

namespace App\Http\Controllers;

use App\Servers;
use App\StreamCategories;
use App\TranscodeingProfiles;
use Illuminate\Http\Request;
use App\Stream;
use App\Setting;

class StreamController extends Controller
{
    
   function showMassEditPage() {
   	  return view('pages.massEditStream');
   }


    /*
       Api Calls
    */ 
    function getStreams(){

    	return [
    	         'streams' => (new Stream())->getAllStreams(),
                 'stream_categories' => (new StreamCategories())->getAllCategories(),
                 'probeSize' => (new Setting())->getProbeSize(),
                 'servers' => (new Servers())->getServersName(),
                 'transcoding_profiles' => (new TranscodeingProfiles())->getTranscodingProfiles()
               ];
    }

}
