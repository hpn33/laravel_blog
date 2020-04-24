<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static forIndexPage(int $limit = 3)
 */
class Post extends Model
{


    function getImageUrlAttribute()
    {

    	$imageUrl = "";

    	if (!is_null($this->image))
    	{

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

        return $this->created_at->format('Y/mm/dd');

    }

    function scopeLatestFirst($query)
    {

        return $query->orderBy('created_at', 'desc');

    }

    function scopeForIndexPage($query, $limit = 3)
    {

        return $query->with('author')->latest()->simplePaginate($limit);

    }

}
