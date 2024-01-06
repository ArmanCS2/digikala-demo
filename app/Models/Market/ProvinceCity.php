<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvinceCity extends Model
{
    use HasFactory;

    public function province()
    {
        return $this->belongsTo(ProvinceCity::class,'id');
    }

    public function cities()
    {
        return $this->hasMany(ProvinceCity::class,'parent');
    }
}
