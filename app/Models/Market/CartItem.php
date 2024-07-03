<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function color()
    {
        return $this->belongsTo(ProductColor::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function guarantee()
    {
        return $this->belongsTo(Guarantee::class);
    }

    public function size()
    {
        return $this->belongsTo(ProductSize::class, 'product_size_id');
    }

    public function productPrice()
    {
        $guaranteePriceIncrease = empty($this->guarantee_id) ? 0 : $this->guarantee->price_increase;
        $colorPriceIncrease = empty($this->color_id) ? 0 : $this->color->price_increase;
        $sizePriceIncrease = empty($this->product_size_id) ? 0 : $this->size->price_increase;
        return $this->product->price + $guaranteePriceIncrease + $colorPriceIncrease + $sizePriceIncrease;
    }

    public function productDiscount()
    {
        $productPrice = $this->productPrice();
        $productDiscount = empty($this->product->activeAmazingSale()) ? 0 : $productPrice * ($this->product->activeAmazingSale()->percentage / 100);
        return $productDiscount;
    }

    public function finalProductDiscount()
    {
        return $this->productDiscount() * $this->number;
    }

    public function finalProductPrice()
    {
        return $this->number * $this->productPrice();
    }

    public function totalProductPrice()
    {
        return $this->finalProductPrice() - $this->finalProductDiscount();
    }
}
