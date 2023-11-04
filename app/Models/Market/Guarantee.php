<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guarantee extends Model
{
    use HasFactory;
    protected $fillable=['name','product_id','status','price_increase'];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
