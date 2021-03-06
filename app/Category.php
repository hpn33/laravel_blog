<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static withPublishedPost()
 */
class Category extends Model
{


    /**
     * @param array|string $extension
     * @return string
     */
    function path($extension = [])
    {

        $path = "/category/{$this->slug}";

        switch (gettype($extension)) {
            case 'string':

                $path .= "/{$extension}";

                break;
            case 'array':

                foreach ($extension as $extend) {

                    $path .= '/' . $extend;

                }

                break;
        }

        return $path;

    }

    function posts()
    {

        return $this->hasMany(Post::class);

    }

    function scopeWithPublishedPost($query)
    {

        return $query->with(['posts' =>
            function ($query) {
                $query->published();
            }])
            ->orderBy('title');

    }

}
