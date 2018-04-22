<?php

namespace App;

use Intervention\Image\Facades\Image;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * @param $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addEvent($attributes)
    {
        $attributes['thumbnail_path'] = $this->addThumbnail($attributes['thumbnail_path']);
        
        return $this->events()->create($attributes);
    }

    /**
     * @param $image
     * @return string
     */
    private function addThumbnail($image)
    {
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('photos/' . $filename);

        // width - height
        Image::make($image)->resize(640, 480)->save($location);

        return $filename;
    }
}
