<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcgType extends Model
{
    use HasFactory;
    protected $fillable = [
		'name_en', 'name_kh', 'default_form', 'attribite',
        'status', 'index', 'other'
	];
}
