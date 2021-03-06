<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Convenience extends Model
{
    protected $table = 'conveniences';
    protected $fillable = ['name','type'];
    public function posts()
    {
        return $this->belongsToMany('App\Models\Post', 'post_conveniences', 'convenience_id', 'post_id');
    }
}
