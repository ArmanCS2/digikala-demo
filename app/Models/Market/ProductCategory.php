<?php

namespace App\Models\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory,SoftDeletes,Sluggable;
    public function sluggable(): array
    {
        return [
            'slug'=>[
                'source'=>'name'
            ]
        ];
    }

    protected $fillable =['name','tags','description','image','slug','status','parent_id','show_in_menu'];
    protected $casts=['image'=>'array'];

    public function parent(){
        return $this->belongsTo(ProductCategory::class,'parent_id');
    }

    public function children(){
        return $this->hasMany(ProductCategory::class,'parent_id');
    }
}
