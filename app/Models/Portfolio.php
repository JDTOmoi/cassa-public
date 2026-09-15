<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

   public $timestamps = false;

   protected $fillable=[
    'port_image',
    'title',
    'content',
];


}
