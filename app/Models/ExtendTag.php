<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtendTag extends Model
{
    protected $table = "extend_tag";
    public $timestamps = false;
    
    protected $guarded = ['id'];
}
