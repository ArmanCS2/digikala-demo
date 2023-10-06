<?php

namespace App\Models\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory,SoftDeletes,Sluggable;
    public function sluggable(): array
    {
        return [
            'slug'=>[
                'source'=>'original_name'
            ]
        ];
    }
    protected $table='brands';
    protected $fillable =['original_name','persian_name','status','logo','slug','tags'];
    protected $casts=['logo'=>'array'];
}
