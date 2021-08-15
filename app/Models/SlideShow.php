<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideShow extends Model
{
    use HasFactory;

    protected $table = 'tbl_slideshow';
    public $timestamps = false;
    protected $fillable = [
        'image',
        'latitude',
        'longitude'
    ];
}
