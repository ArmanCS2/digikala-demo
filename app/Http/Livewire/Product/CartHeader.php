<?php

namespace App\Http\Livewire\Product;

use App\Models\Livewire\LivewireCartItem;
use Livewire\Component;

class CartHeader extends Component
{
    protected $listeners = ['refresh' => '$refresh'];
    public function render()
    {
        return view('livewire.product.cart-header',['cartItemsCount'=>LivewireCartItem::where('user_id',1)->get()]);
    }
}
