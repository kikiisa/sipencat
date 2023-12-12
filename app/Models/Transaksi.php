<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid','name_transaksi','qty','satuan','price_regis','price_uji','total_price','status'  
    ];
}
