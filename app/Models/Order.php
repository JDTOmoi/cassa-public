<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'ord_message', 'phone_number', 'status'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function prs(): HasMany{
        return $this->hasMany(Prodreq::class, 'order_id', 'id');
    }
}
