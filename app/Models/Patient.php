<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends BaseModel
{
    use HasFactory;
	protected $guarded = ['id'];
	
	public function consultations()
	{
		return $this->hasMany(Consultation::class, 'patient_id');
	}
	public function address()
	{
		return $this->belongsTo(Address_linkable::class, 'address_id')->first();
	}
}
