<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinyOptimizer extends Model
{
    use HasFactory;
    protected $fillable = ['filename', 'filesize', 'extension', 'path'];
}
