<?php

namespace App\Http\Livewire\Product;

use App\Models\Livewire\LivewireCartItem;
use Livewire\Component;

class Cart extends Component
{
    public $cartItems;
    public $cartItemsPrices=0;
    public function increment(LivewireCartItem $cartItem)
    {
        $cartItem->number+=1;
        $cartItem->save();
    }

    public function decrement(LivewireCartItem $cartItem)
    {
        if ($cartItem->number>1){
            $cartItem->number-=1;
            $cartItem->save();
        }else{
            $cartItem->delete();
            $this->emitTo('product.cart-header', 'refresh');
        }
    }

    public function delete(LivewireCartItem $cartItem)
    {
        $cartItem->delete();
        $this->emitTo('product.cart-header', 'refresh');
        $this->emit('swal', [
            'title' => 'موفق',
            'text' => 'محصول با موفقیت از سبد خرید حذف شد',
            'confirmButtonText' => 'باشه',
            'icon' => 'success',
            //'timer'=>3000,
            //'position'=>'center',
            //'toast'=>true,
        ]);
    }

    public function clearCart()
    {
        foreach($this->cartItems as $cartItem){
            $cartItem->delete();
        }
        $this->emitTo('product.cart-header', 'refresh');
        $this->emit('swal', [
            'title' => 'موفق',
            'text' => 'محصولات با موفقیت از سبد خرید حذف شدند',
            'confirmButtonText' => 'باشه',
            'icon' => 'success',
            //'timer'=>3000,
            //'position'=>'center',
            //'toast'=>true,
        ]);
    }

    public function render()
    {
        $this->cartItems=LivewireCartItem::where('user_id',1)->get();
        $this->cartItemsPrices=0;
        foreach($this->cartItems as $cartItem){
            $this->cartItemsPrices+=$cartItem->price * $cartItem->number;
        }
        return view('livewire.product.cart')->extends('livewire.layouts.master')->section('content');
    }
}
