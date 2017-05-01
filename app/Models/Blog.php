<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = "tbl_blog";

    // untuk massassignment
    protected $guarded = ['id']; // yang tidak boleh diisi
}
