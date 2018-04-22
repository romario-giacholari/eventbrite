<?php

namespace App\Filters;

use App\User;
use Carbon\Carbon;

class EventFilters extends Filters
{
	protected $filters = ['by','popular', 'past_events','upcoming_events'];

    /**
     * @param $username
     * @return mixed
     */
    protected function by($username)
	{
		$user = User::where('name', $username)->firstOrFail();

		return $this->builder->where('user_id' , $user->id);
	}

    /**
     * @return mixed
     */
    protected function popular()
	{
		$this->builder->getQuery()->orders = [];

		return $this->builder->orderBy('favorites_count','desc');
	}

    /**
     * @return mixed
     */
    protected function past_events()
	{
		$this->builder->getQuery()->orders = [];

		return $this->builder->where('due_date', '<', Carbon::now());
	}

    /**
     * @return mixed
     */
    protected function upcoming_events()
	{
		$this->builder->getQuery()->orders = [];

		return $this->builder->where('due_date', '>', Carbon::now());
	}

}