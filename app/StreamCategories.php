<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StreamCategories extends Model
{
    protected $table = 'stream_categories';


    public function getAllCategories() {
        return StreamCategories::all();
    }
}
