<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pokemon extends Model
{
public $timestamps = false;

    use HasFactory;
    protected $table = 'pokemons';
    protected $fillable = [
        'name',
        'image'
    ];
}
