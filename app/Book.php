<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['name', 'description','cover_image'];

    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag','book_tag')->withPivot('tag_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
