<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';
    // protected $fillable = ['id', 'bill_id', 'bill_collection', 'created_at', 'updated_at'];
    protected $fillable = [
        'bill_id',
        'bill_collection'
    ];
    // public function borang()
    // {
    //     return $this->belongsTo(Borang::class);
    // }
}
