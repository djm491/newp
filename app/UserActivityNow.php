<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserActivityNow extends Model
{
    protected $table = 'user_activity_now';

    public function openConnection($server_id=0){
       if( $server_id !==0 ) {
          return UserActivityNow::where('user_activity_now.server_id','=',$server_id)->count();
       }
       return UserActivityNow::count(); 
    }
    public function onlineUsers($server_id=0) {
         $query = UserActivityNow::query();
         $query = $query->select('user_activity_now.user_id', DB::raw('count(*) as total'));
                  if($server_id!==0) {
                      $query =  $query->where('user_activity_now.server_id','=',$server_id);
                  }
         $onlineUsers = $query->groupBy('user_id')->get();
         return $onlineUsers->count();
    }
    public function getGeoIp() {
        $total_users =  UserActivityNow::select('user_activity_now.geoip_country_code', DB::raw('count(*) as number_of_users'))
                                      ->where('geoip_country_code','!=','')
                                      ->groupBy('geoip_country_code')
                                      ->get();
        $result[] = ['Country', 'Popularity'];
        foreach ($total_users as $key => $value) {
            $result[++$key] = [$value->geoip_country_code,$value->number_of_users];
        }
        return $result;

    }
}
