<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryValue extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'category_attribute_id', 'value', 'type'];

    public function attribute()
    {
        return $this->belongsTo(CategoryAttribute::class,'category_attribute_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
