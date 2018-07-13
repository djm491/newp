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
            $server->watchdog_data = json_decode($server->watchdog_data);
            $server->server_hardware = json_decode($server->server_hardware);
            $server->ram_used_percent = $server->watchdog_data->total_mem_used_percent;
            $server->uptime = $server->watchdog_data->uptime;
            $server->output = $server->server_hardware->bytes_sent;
            $server->input = $server->server_hardware->bytes_received;
            $server->cpu_usage = $server->server_hardware->cpu_usage;
        }
        return $servers;
    }
}
