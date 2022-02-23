<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends BaseModel
{
	use HasFactory;
	
	protected $guarded = ['id'];
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function roles()
	{
		return $this->belongsToMany(Role::class)->withTimestamps();
	}
	public function users()
	{
		return $this->belongsToMany(User::class)->withTimestamps();
	}

	public function scopeLimitAbility($query)
	{
		if (auth()->user()->isWebDev) {
			return $query;
		}
		return $query->whereIn('name', auth()->user()->abilities());
	}


}
