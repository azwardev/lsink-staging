<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCallback extends Model
{
    use HasFactory;

    protected $table = 'payment_callback';
    // protected $fillable = ['id', 'bill_id', 'bill_collection', 'created_at', 'updated_at'];
    protected $fillable = [
        'permohonan_id',
        'bill_id'
    ];
    // public function borang()
    // {
    //     return $this->belongsTo(Borang::class);
    // }
}
