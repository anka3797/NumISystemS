<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    // Table name
    protected $table = 'albums';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function posts() {
        return $this->hasMany('App\Post');
    }
}
