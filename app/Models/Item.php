<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // Add 'name' to the $fillable array
        'email',
        'content',
        'age',
        'image_path',
    ];
}
