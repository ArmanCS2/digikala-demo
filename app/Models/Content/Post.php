<?php

namespace App\Models\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nagy\LaravelRating\Traits\Rateable;

class Post extends Model
{
    use HasFactory, Sluggable, Rateable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable = ['title', 'slug', 'summary', 'body', 'image', 'status', 'commentable', 'tags', 'published_at', 'author_id', 'category_id'];
    protected $casts = ['image' => 'array'];

    public function category()
    {
        return $this->belongsTo(PostCategory::class);
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Content\Comment', 'commentable');
    }


    public function approvedComments()
    {
        return $this->comments()->where('approved', 1)->whereNull('parent_id')->get();
    }

    public function imageUrl()
    {
        return asset($this->image['indexArray'][$this->image['currentImage']]);
    }

}
