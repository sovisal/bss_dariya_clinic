<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataParent extends Model
{
    use HasFactory;

    protected $fillable = [
		'title_en', 'title_kh', 'description', 'status', 'type'
	];
}
