<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded=[];

    public function city()
    {
        return $this->belongsTo(ProvinceCity::class,'city_id');
    }

    public function province()
    {
        return $this->belongsTo(ProvinceCity::class,'province_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);    }
}
