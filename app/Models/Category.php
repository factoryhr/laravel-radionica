<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   	public function notes()
   	{
   		return $this->hasMany(\App\Models\Note::class);
   	}
}
