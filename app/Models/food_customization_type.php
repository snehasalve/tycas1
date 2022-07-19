<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class food_customization_type extends Model
{
    use HasFactory;
    protected $fillable = ['name','min_selection_count','max_selection_count'];
}
