<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class StreamTable extends Model
{
    protected $table = 'streams_sys';

    public function getonlineStreams(){
    	$total_Streams = DB::table('streams_sys')
    	                     ->join('streams', 'streams_sys.stream_id','=','streams.id')
                             ->select('streams_sys.*')
    	                     ->where('streams.type','=',1)
    	                     ->where('streams_sys.stream_status','=',0)
                             ->where('streams_sys.stream_started', '<>', '', 'and')
    	                     ->get();
    	return $total_Streams->count();
    }
    public function getofflineStreams(){
        $total_Streams = DB::table('streams_sys')
                            ->join('streams', 'streams_sys.stream_id','=','streams.id')
                            ->select('streams_sys.*')
                            ->where('streams.type','=',1)
                            ->where('streams_sys.stream_status','=',1)
                            ->where('streams_sys.pid', '=',-1)
                            ->get();
        return $total_Streams->count();
    }
}
