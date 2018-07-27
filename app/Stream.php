<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    protected $table = 'streams';

    public function getAllStreams(){
    	return DB::table('streams')->select('id', 'stream_display_name as name')->where('type','=',1)->get();
    }
}
