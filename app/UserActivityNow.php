<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserActivityNow extends Model
{
    protected $table = 'user_activity_now';

    public function openConnection($server_id){
       return UserActivityNow::where('user_activity_now.server_id','=',$server_id)->count();
    }
    public function onlineUsers($server_id){
         $onlineUsers = DB::table('user_activity_now')
                          ->select('user_activity_now.user_id', DB::raw('count(*) as total'))
                          ->where('user_activity_now.server_id','=',$server_id)
                          ->groupBy('user_id')
                          ->get();
         return $onlineUsers->count();
    }
}
