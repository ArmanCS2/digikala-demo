<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'keywords', 'logo', 'icon', 'tel', 'telegram', 'instagram', 'whatsapp', 'email', 'address', 'my_site', 'link_1', 'link_2', 'link_3', 'link_4', 'link_5', 'link_6', 'link_7', 'link_8', 'link_9', 'link_10', 'payment_status'];

}
