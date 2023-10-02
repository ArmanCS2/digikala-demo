<?php

namespace App\Models\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategory extends Model
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

    protected $fillable =['name','tags','description','image','slug','status','parent_id'];
    protected $casts=['image'=>'array'];

    public function parent(){
        return $this->belongsTo(PostCategory::class,'parent_id');
    }

    public function children(){
        return $this->hasMany(PostCategory::class,'parent_id');
    }
}
