<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Servers extends Model
{
    protected $table = 'streaming_servers';
    protected $user_activity;
    protected $stream_sys;
    public function __construct(){
        $this->user_activity = new UserActivityNow();
        $this->stream_sys = new StreamTable();
    }
    public function getAllServers(){
        $servers = Servers::select('id','watchdog_data','server_hardware')->get();
        $total_output = 0; $total_input = 0;
        foreach ($servers as $server){
            $server->online_users = $this->user_activity->onlineUsers($server->id);
            $server->open_connections = $this->user_activity->openConnection($server->id);
            $server->watchdog_data = json_decode($server->watchdog_data);
            $server->server_hardware = json_decode($server->server_hardware);
            $server->ram_used_percent = $server->watchdog_data->total_mem_used_percent;
            $server->uptime = $server->watchdog_data->uptime;
            $server->output = $server->watchdog_data->bytes_sent;
            $server->input = $server->watchdog_data->bytes_received;
            $server->cpu_usage = $server->watchdog_data->cpu_load_average;
            $network = trim(preg_replace('/\s+/', ' ', $server->server_hardware->network_speed));
            $server->live_streaming = trim(preg_replace('/\s+/', ' ', $server->server_hardware->total_running_streams));
            $total_bytes =  $server->watchdog_data->bytes_sent + $server->watchdog_data->bytes_received;
            $server->network = round($this->calculateNetworkSpeed($network,$total_bytes));
            $total_input += $server->input;
            $total_output += $server->output;

        }
        return [
           'servers' => $servers,
           'total_online_users' => $this->user_activity->onlineUsers(),
           'total_open_connection' => $this->user_activity->openConnection(),
           'onlineStreams' => $this->stream_sys->getonlineStreams(),
           'offlineStreams' => $this->stream_sys->getofflineStreams(),
           'totalOutput' => round($total_output),
           'totalInput' => round($total_input),
           'geo_ip_users' => $this->user_activity->getGeoIp()

        ];
    }
    function getServersName() {
        return Servers::select('id','server_name as name')->get();
    }
    private function calculateNetworkSpeed($network,$total_bytes) {
        if ($network<=0) $network = 1000;
        if($total_bytes <0.00001) $total_bytes = 0;
        $network = (($total_bytes )/($network ))*100;
        return $network;
    }
}
