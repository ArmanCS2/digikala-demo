<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function subFooters()
    {
        return $this->hasMany(SubFooter::class)->orderBy('order');
    }
}
