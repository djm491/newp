<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servers extends Model
{
    protected $table = 'streaming_servers';


    public function getAllServers(){
        return $this->all();
    }
}
