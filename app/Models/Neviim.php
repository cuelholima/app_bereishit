<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neviim extends Model
{
    use HasFactory;
    
    protected $table = 'neviim';
    protected $fillable = ['name_pt', 'name_he'];
}
