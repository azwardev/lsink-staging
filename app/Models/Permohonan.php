<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;

    protected $table = 'permohonan'; 
    protected $fillable = [
        'payment_id',
    ];
    public function borang()
    {
        return $this->belongsTo(Borang::class);
    }
}
