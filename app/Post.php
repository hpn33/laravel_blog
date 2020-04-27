<?php

namespace App;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @method static forIndexPage(int $limit = 3)
 * @method static published()
 * @method static byPopularity()
 */
class Post extends Model
{


    /**
     * @param array|string $extension
     * @return string
     */
    function path($extension = [])
    {

        $path = "/posts/{$this->slug}";

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


    function getImageThumbUrlAttribute()
    {

        $imageUrl = "";

        if (!is_null($this->image)) {

            $ext = substr(strchr($this->image, '/'), 1);
            $thumbnail = Str::replaceFirst(".{$ext}", "_thumb.{$ext}", $this->image);
            $imagePath = public_path("/img/{$thumbnail}");

            if (file_exists($imagePath)) {
                $imageUrl = asset("img/{$thumbnail}");
            }

        }

        return $imageUrl;

    }


    function author()
    {

        return $this->belongsTo(User::class);

    }


    function category()
    {

        return $this->belongsTo(Category::class);

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
     * @param mixed $value
     * @param string|null $field
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


    function getBodyHtmlAttribute()
    {

        return $this->body ? Markdown::convertToHtml($this->body) : '';

    }


    function getExcerptHtmlAttribute()
    {

        return $this->excerpt ? Markdown::convertToHtml($this->excerpt) : '';

    }


    function scopeForIndexPage($query, $limit = 3)
    {

        return $query
//            ->with('author')
            ->published()->orderBy('created_at', 'desc')->simplePaginate($limit);

    }


    function scopePublished($query)
    {

        return $query->where('published_at', '<=', now());

    }


    function scopeByPopularity($query)
    {

        return $query->orderBy('view_count', 'desc');

    }


}
