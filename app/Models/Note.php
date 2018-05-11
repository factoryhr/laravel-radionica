<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = [];
    protected $hidden = [];

    public function category()
    {
    	return $this->belongsTo(\App\Models\Category::class);
    }
}
