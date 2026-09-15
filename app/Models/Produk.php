<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'sku',
        'brand',
        'tags',
        'description',
    ];

    public function pcs(): HasMany{
        return $this->hasMany(ProdCata::class, 'produk_id', 'id');
    }

    public function prs(): HasMany{
        return $this->hasMany(Prodreq::class, 'produk_id', 'id');
    }

    public function BrandProduk():BelongsTo{
        return $this->belongsTo(Brand::class, 'brand','id');
    }
}
