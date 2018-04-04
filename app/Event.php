<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
