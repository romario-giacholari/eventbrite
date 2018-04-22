<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable;

   protected $guarded = [];

   protected $appends = ['favoritesCount','isFavorited'];

   protected $with = ['owner'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
   {
   	    return $this->belongsTo(User::class, 'user_id');
   }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
   {
        return $this->belongsTo(Event::class);
   }

}