<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeAbout extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'short_dis',
        'short_dis',
        'long_dis',
      
    ];
}
