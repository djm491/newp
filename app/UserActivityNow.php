<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserActivityNow extends Model
{
    protected $table = 'user_activity_now';

    public function openConnection($server_id){
       return UserActivityNow::where('user_activity_now.server_id','=',$server_id)->count();
    }
}
