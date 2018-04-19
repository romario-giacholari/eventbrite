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
    
    public function path()
    {
        return "/events/{$this->id}";
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function addReply($reply)
    {
        return $this->replies()->create($reply);
    }
    
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

}
