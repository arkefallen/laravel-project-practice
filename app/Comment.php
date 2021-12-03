<?php

namespace App;

use App\Book;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';

    public function books() {
        return $this->belongsTo('App\Book','book_id','id');
    }

    public function users() {
        return $this->belongsTo('App\User','user_id','id');
    }
}
