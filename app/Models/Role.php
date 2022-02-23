<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends BaseModel
{
	use HasFactory;

	protected $guarded = ['id'];
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function hasAbilities()
	{
		return $this->belongsToMany(Ability::class)->withTimestamps();
	}
	
	public function abilities()
	{
		// Get Ability from Roles
		$role_has_abilities = $this->hasAbilities->flatten()->pluck('name')->unique();
		return $role_has_abilities;
	}

	public function allowTo($ability)
	{
		if (is_string($ability)) {
			$ability = Ability::whereName($ability)->firstOrFail();
		}
		if (is_array($ability)) {
			$ability = Ability::whereIn('name', $ability)->get();
		}
		$this->hasAbilities()->sync($ability);
	}
}
