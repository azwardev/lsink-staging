<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borang extends Model
{
    use HasFactory;

    protected $table = 'borang'; 

    protected $fillable = [
        'borang_a',
        'borang_c',
        'borang_d',
        'file_upload',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'borang_a'=> 'array',
        'borang_c'=> 'array',
        'borang_d'=> 'array',
        'file_upload'=> 'array',
    ];
}
