<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public static function incomplete() {
      return static::where('completed', 0)->get();  // take basic query and wrap in (static) method
    }    
}
