<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class food_customization_option extends Model
{
    use HasFactory;

    protected $fillable = ['name','price'];
}

