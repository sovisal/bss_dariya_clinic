<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaborType extends Model
{
    use HasFactory;
    
    public function item()
	{
		return $this->hasMany(LaborItem::class, 'type');
	}
}
