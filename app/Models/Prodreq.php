<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prodreq extends Model
{
    use HasFactory;

    protected $fillable = ['produk_id', 'order_id', 'quantity', 'notes'];

    public function produk(): BelongsTo{
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }

    public function order(): BelongsTo{
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
