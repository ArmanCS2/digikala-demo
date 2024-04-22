<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubFooter extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function footer()
    {
        return $this->belongsTo(Footer::class);
    }
}
