<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbilityModule extends Model
{
    use HasFactory;
	protected $guarded = ['id'];
	
	public function abilities()
	{
		return $this->hasMany(Ability::class, 'ability_module_id');
	}

}
