<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    protected $fillable = ['name', 'slug','photo', 'status','is_popular','pdf'];
    public $timestamps = false;

}