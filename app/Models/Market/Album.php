<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function albumType()
    {
        if ($this->type == 1) {
            return 'ویدیو';
        }
        return 'تصویر';
    }
}
