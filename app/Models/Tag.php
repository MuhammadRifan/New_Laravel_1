<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = "Tags";
    public $timestamps = false;

    protected $fillable = ['tag'];
}
