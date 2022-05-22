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

	public function prescriptions()
	{
		return $this->hasMany(Prescription::class, 'patient_id');
	}

	public function labors()
	{
		return $this->hasMany(Laboratory::class, 'patient_id');
	}

	public function xrays()
	{
		return $this->hasMany(Xray::class, 'patient_id');
	}
	
	public function echos()
	{
		return $this->hasMany(Echography::class, 'patient_id');
	}

	public function ecgs()
	{
		return $this->hasMany(Ecg::class, 'patient_id');
	}
}
