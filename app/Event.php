<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use Favoritable;

    protected $guarded = [];

    protected $appends = ['favoritesCount','isFavorited'];


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('favoritesCount', function($builder){
            $builder->withCount('favorites');
        });
    }

    /**
     * @return string
     */
    public function path()
    {
        return "/events/{$this->id}";
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * @param $reply
     * @return Model
     */
    public function addReply($reply)
    {
        return $this->replies()->create($reply);
    }

    /**
     * @param $query
     * @param $filters
     * @return mixed
     */
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

}
