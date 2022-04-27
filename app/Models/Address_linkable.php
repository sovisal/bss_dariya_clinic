<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address_linkable extends Model
{
    use HasFactory;

    protected $fillable = [
        'village_en', 'village_kh', 'village_code',
        'commune_en', 'commune_kh', 'commune_code',
        'district_en', 'district_kh', 'district_code',
        'province_en', 'province_kh', 'province_code',
        'type'
    ];
}
