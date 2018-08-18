<?php

namespace App;

# use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['imagePath', 'title', 'description', 'price'];
    # list of all fields I want to assign upon creation of Product obj
}
