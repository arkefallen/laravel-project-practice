<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Gallery;
use App\Comment;

class Book extends Model
{
    protected $table = 'book';
    protected $dates = ['published_date'];

    public function photos() {
        return $this->hasMany('App\Gallery','book_id','id');
    }

    public function comments() {
        return $this->hasMany('App\Comment','book_id','id');
    }
}
