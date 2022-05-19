<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function detail()
	{
		return $this->hasMany(PrescriptionDetail::class, 'prescription_id');
	}
}
