<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaborItem extends Model
{
    use HasFactory;
    protected $fillable = [
		'name_en', 'name_kh',
        'min_range', 'max_range', 'unit',
        'status', 'index', 'other'
	];
}
