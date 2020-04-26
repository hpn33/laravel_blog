<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


    /**
     * @param array|string $extension
     * @return string
     */
    function path($extension = [])
    {

        $path = "/categories/{$this->slug}";

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

    function scopeWithAvailablePost($query)
    {

        return $query->with(['posts' =>
            function ($query) {
                $query->published();
            }])
            ->orderBy('title', 'asc');

    }

}
