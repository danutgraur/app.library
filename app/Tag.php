<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'description'];

//    protected $table = 'tags';

    public function books()
    {
        return $this->belongsToMany('App\Book', 'book_tag')->withPivot('book_id');
    }
}
