<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    function getProbeSize() {
    	return Setting::select('probeSize')->first();
    }
}
