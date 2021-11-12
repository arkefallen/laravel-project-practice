<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';

    public function bookAsForeignKey() {
        return $this->belongsTo('App\Book','book_id','id');
    }
}
