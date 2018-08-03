<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TranscodeingProfiles extends Model
{
    protected $table = 'transcoding_profiles';

    function getTranscodingProfiles() {
        return TranscodeingProfiles::all();
    }
}
