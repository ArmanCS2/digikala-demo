<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'url', 'image', 'position', 'status'];

    public static $positions = [
        0 => 'اسلاید شو',
        1 => 'کنار اسلاید شو',
        2 => 'دو بنر تبلیغاتی بین دو اسلایدر',
        3 => 'بنر تبلیغاتی بزرگ پایین دو اسلایدر',
        4 => 'تبلیغات',
        5 => 'نوع 1',
        6 => 'نوع 2',
        7 => 'نوع 3',
        8 => 'نوع 4',
        9 => 'نوع 5',
        10 => 'نوع 6',
    ];
}
