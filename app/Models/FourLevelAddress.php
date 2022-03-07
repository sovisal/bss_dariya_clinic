<?php

namespace App\Models;

use App\Models\BaseModel;

class FourLevelAddress extends BaseModel
{
	protected $table = 'addresses';

	protected $fillable = [
		'_type_kh', '_type_en', '_code', '_name_kh', '_name_en', '_path_kh', '_path_en', '_reference', '_offical_note', '_note'
	];


}
