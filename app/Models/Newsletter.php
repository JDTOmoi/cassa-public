<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    // protected $dateFormat = 'd-m-Y';
    public $timestamps = false;

    use HasFactory;
    protected $fillable=[
        'news_image',
        'title',
        'content',
        'created_at'
    ];

}
