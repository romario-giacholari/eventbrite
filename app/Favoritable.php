<?php

namespace App;

trait Favoritable
{
     /**
     * Boot the trait.
     */
    protected static function bootFavoritable()
    {
        static::deleting(function ($model) {
            $model->favorites->each->delete();
        });
    }

    /**
     * @return mixed
     */
    public function favorites()
    {
   		return $this->morphMany(Favorite::class,'favorited');
    }

    /**
     * @return mixed
     */
    public function favorite()
    {
        $attributes = ['user_id' => auth()->id()]; 
 
        if(! $this->favorites()->where($attributes)->exists()) {
            return $this->favorites()->create($attributes);
        }
     }

    /**
     *return void
     */
    public function unfavorite()
     {
         $attributes = ['user_id' => auth()->id()]; 
         
         $this->favorites()->where($attributes)->delete();
 
     }

    /**
     * @return mixed
     */
    public function getIsFavoritedAttribute()
     {
         return $this->isFavorited();
     }

    /**
     * @return mixed
     */
    public function isFavorited()
     {
         return $this->favorites()->where('user_id', auth()->id())->exists();
     }

    /**
     * @return mixed
     */
    public function getFavoritesCountAttribute()
     {
         return $this->favorites->count();
     }
}