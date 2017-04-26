<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = "tbl_blog";
    public $timestamps = false;

    // untuk massassignment
    protected $fillable = ['judul', 'isi']; // yang boleh diisi
    // protected $guarded = ['id']; // yang tidak boleh diisi
}
