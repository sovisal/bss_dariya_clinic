<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends BaseModel
{
    use HasFactory;
	protected $guarded = ['id'];
	
	public function pt_gender()
	{
		return $this->belongsTo(DataParent::class, 'gender');
	}
	public function pt_nationality()
	{
		return $this->belongsTo(DataParent::class, 'nationality');
	}
	public function pt_blood_type()
	{
		return $this->belongsTo(DataParent::class, 'blood_type');
	}
	public function pt_marital_status()
	{
		return $this->belongsTo(DataParent::class, 'marital_status');
	}
}
