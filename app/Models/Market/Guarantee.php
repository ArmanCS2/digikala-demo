<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guarantee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'product_id', 'status', 'price_increase'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
