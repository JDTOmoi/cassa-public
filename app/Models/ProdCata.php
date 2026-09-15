<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProdCata extends Model
{
    use HasFactory;

    protected $fillable = ['produk_id', 'category_id'];

    public function produk(): BelongsTo{
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
