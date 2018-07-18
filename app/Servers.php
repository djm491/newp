<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Servers extends Model
{
    protected $table = 'streaming_servers';
    protected $user_activity ;
    public function __construct(){
        $this->user_activity = new UserActivityNow();
    }
    public function getAllServers(){
        $servers = Servers::all();
        foreach ($servers as $server){
            $server->open_connections = $this->user_activity->openConnection($server->id);
            $server->online_users = $this->user_activity->onlineUsers($server->id);
            $server->watchdog_data = json_decode($server->watchdog_data);
            $server->server_hardware = json_decode($server->server_hardware);
            $server->ram_used_percent = $server->watchdog_data->total_mem_used_percent;
            $server->uptime = $server->watchdog_data->uptime;
            $server->output = $server->watchdog_data->bytes_sent;
            $server->input = $server->watchdog_data->bytes_received;
            $server->cpu_usage = $server->watchdog_data->cpu_load_average;
            $network = trim(preg_replace('/\s+/', ' ', $server->server_hardware->network_speed));
            $server->live_streaming = trim(preg_replace('/\s+/', ' ', $server->server_hardware->total_running_streams));
            $total_bytes =  $server->watchdog_data->bytes_sent  + $server->watchdog_data->bytes_received ;
            $server->network = round($this->calculateNetworkSpeed($network,$total_bytes));
        }
        return $servers;
    }

    private function calculateNetworkSpeed($network,$total_bytes) {
        $network = trim($network," \r\n");
        if (!is_int($network)) $network = 1000; 
        if($total_bytes <1) $total_bytes = 1;
        //$network = (($network - ($network - $total_bytes ))/$network)*100;
        $network = (($network/100) * (($network - $total_bytes )/100));
        return $network;
    }
}
