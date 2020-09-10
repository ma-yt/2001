<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table='news';
    protected $primaryKey='n_id';
    public $timestamps=false;
    public $fillable=['n_title','cid','n_img','n_jj','n_content'];
}
