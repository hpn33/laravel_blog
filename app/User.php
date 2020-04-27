<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    function posts()
    {

        return $this->hasMany(Post::class, 'author_id');

    }


    function gravatar()
    {

        return "/img/author.jpg";

    }

    /**
     * @param array|string $extension
     * @return string
     */
    function path($extension = [])
    {

        $path = "/author/{$this->slug}";

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

}
