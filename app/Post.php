<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static forIndexPage(int $limit = 3)
 * @method static published()
 */
class Post extends Model
{

    protected $dates = ['published_at'];


    function getImageUrlAttribute()
    {

        $imageUrl = "";

        if (!is_null($this->image)) {

            $imagePath = public_path("/img/{$this->image}");

            if (file_exists($imagePath)) {
                $imageUrl = asset("img/{$this->image}");
            }

        }

        return $imageUrl;

    }


    function author()
    {

        return $this->belongsTo(User::class);

    }


    function getDateAttribute()
    {

        return $this->published_at->format('Y/m/d');

    }

    function scopeForIndexPage($query, $limit = 3)
    {

        return $query->with('author')->published()->orderBy('created_at', 'desc')->simplePaginate($limit);

    }

    function scopePublished($query)
    {

        return $query->where('published_at', '<=', now());

    }

}
