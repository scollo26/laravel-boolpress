<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'author',
        'content',
        'slug',
        'user_id',
        'category_id',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
