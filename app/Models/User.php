<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'username',
		'position',
		'gender',
		'phone',
		'address',
		'color',
		'bio',
		'image',
		'is_suspended',
		'password',
		'doctor',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function scopeFilter($query){
		$query->when(request()->status, function($query, $status){
			$query->where('status',(($status == 'active')? 1 : 0 ));
		});
		$query->when(request()->search, function ($query, $search){
			$query->where('name', 'like', '%' .$search . '%')
					->orWhere('username', 'like', '%' .$search . '%')
					->orWhere('position', 'like', '%' .$search . '%');
		});
	}

	// get Data Select2
	static function getDataSelect2($default_filter = [], $orderBy = [], $select = [])
	{
		$order_by = '';
		$orderBy = $orderBy ?: ['name', 'ASC'];
		if (is_array($orderBy[0])) {
			foreach ($orderBy as $order) {
				if ($order_by == '') {
					$order_by = '`'. $order[0] .'` '. $order[1];
				}else{
					$order_by .= ', `'. $order[0] .'` '. $order[1];
				}
			}
		}else{
			$order_by = '`'. $orderBy[0] .'` '. $orderBy[1];
		}
		$key = 'id';
		$text = 'name';
		$select = $select ?: ['id','name'];
		if (is_array($select) && !empty($select)) {
			$key = $select[0];
			$text = $select[1];
		}
		request()->merge($default_filter);
		$collection = parent::orderByRaw($order_by)
							->select($select)
							->filter()
							->limit(5)->get();
		$response = array();
		foreach($collection as $item){
			$response[] = array(
				"id"=>$item->$key,
				"text"=>$item->$text
			);
		}
		return response()->json($response); 
	}

	public function hasRoles()
	{
		return $this->belongsToMany(Role::class)->withTimestamps();
	}

	public function assignRole($role)
	{
		if (is_string($role)) {
			$role = Role::whereName($role)->firstOrFail();
		}
		$this->hasRoles()->sync($role);
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

	public function hasAbilities()
	{
		return $this->belongsToMany(Ability::class)->withTimestamps();
	}

	public function hasRoleAbilities()
	{
		// Get Ability from Roles
		return $this->hasRoles->map->hasAbilities->flatten()->pluck('name')->unique();
	}

	public function specialAbilities()
	{
		return $this->hasAbilities->flatten()->pluck('name')->unique();
	}

	public function abilities()
	{
		// Get Direct Ability from User
		$user_has_abilities = $this->specialAbilities();
		// Get Ability from Roles
		$role_has_abilities = $this->hasRoleAbilities();
		//Merge and return
		return $user_has_abilities->merge($role_has_abilities);
	}

	public function doctor() {
		return $this->belongsTo(Doctor::class, 'doctor')->first();
	}
}
