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


    /**
     * @return bool
     */
    function not_published(): bool
    {

        return $this->published_at == null;

    }


    /**
     * @return bool
     */
    function is_published(): bool
    {

        return !$this->not_published();

    }


    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {

        return $this->whereNotNull('published_at')->where('slug', $value)->first();

    }


    function getDateAttribute()
    {

        return $this->published_at == null ? '' : $this->published_at->format('Y/m/d');

    }

    function scopeForIndexPage($query, $limit = 3)
    {

        return $query->with('author')->published()->orderBy('created_at', 'desc')->simplePaginate($limit);

    }

    function scopePublished($query)
    {

        return $query->where('published_at', '<=', now());

    }


    /**
     * @param array|string $extension
     * @return string
     */
    function path($extension = [])
    {

        $path = "/{$this->slug}";

        $type = gettype($extension);


        if ($type === 'string') {

            $path .= "/{$extension}";

        } elseif ($type === 'array') {

            foreach ($extension as $extend) {

                $path .= '/' . $extend;

            }

        }

        return $path;

    }

}
