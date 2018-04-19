<?php

namespace App;

use App\Reply;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable;

   protected $guarded = [];

   protected $appends = ['favoritesCount','isFavorited'];

   protected $with = ['owner'];

   public function owner()
   {
   	    return $this->belongsTo(User::class, 'user_id');
   }

   public function event()
   {
        return $this->belongsTo(Event::class);
   }

}