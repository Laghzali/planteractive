<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class overlays extends Model
{
    use HasFactory;
    protected $table = 'overlays';

    protected $fillable = ['element', 'location'];
}

