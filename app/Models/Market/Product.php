<?php

namespace App\Models\Market;

use App\Models\User;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nagy\LaravelRating\Traits\Rateable;

class Product extends Model
{
    use HasFactory, SoftDeletes, Sluggable, Rateable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $fillable = ['name', 'introduction', 'slug', 'image', 'slug', 'weight', 'length', 'width', 'height', 'price', 'tags', 'status', 'marketable', 'sold_number', 'frozen_number', 'marketable_number', 'brand_id', 'published_at', 'size', 'material', 'feature_1', 'feature_2', 'feature_3', 'feature_4', 'feature_5'];
    protected $casts = ['image' => 'array'];

    public function categories()
    {
     return $this->belongsToMany(ProductCategory::class);
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Content\Comment', 'commentable');
    }

    public function approvedComments()
    {
        return $this->comments()->where('approved', 1)->whereNull('parent_id')->get();
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function metas()
    {
        return $this->hasMany(ProductMeta::class);
    }

    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function guarantees()
    {
        return $this->hasMany(Guarantee::class);
    }

    public function amazingSales()
    {
        return $this->hasMany(AmazingSale::class);
    }

    public function activeAmazingSale()
    {
        $commonDiscount = CommonDiscount::where('start_date', '<=', now())->where('end_date', '>=', now())->where('status', 1)->orderBy('created_at', 'desc')->first();
        if (empty($commonDiscount)) {
            return $this->amazingSales()->where('start_date', '<', Carbon::now())->where('end_date', '>', Carbon::now())->where('status', 1)->first();
        }
        return null;
    }

    public function activeAmazingSaleObj()
    {
        return $this->amazingSales()->where('start_date', '<', Carbon::now())->where('end_date', '>', Carbon::now())->where('status', 1);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function attributes()
    {
        return $this->hasMany(CategoryAttribute::class);
    }

    public function values()
    {
        return $this->hasMany(CategoryValue::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function compares()
    {
        return $this->belongsToMany(Compare::class);
    }
}
