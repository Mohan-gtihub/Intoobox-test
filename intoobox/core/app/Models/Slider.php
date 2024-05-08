<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['hash_title', 'title', 'logo', 'photo','link','details','home_page'];
    public $timestamps = false;
}