<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];
    
    public function path()
    {
        return "events/{$this->id}";
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
