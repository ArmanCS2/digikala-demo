<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;
    protected $fillable=['name','color','product_id','status','price_increase','sold_number','frozen_number','marketable_number'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
