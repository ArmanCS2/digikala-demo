<?php

namespace App\Http\Livewire\Product;

use App\Models\Livewire\LivewireCartItem;
use App\Models\Livewire\LivewireProduct;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Mockery\Exception;

class Index extends Component
{
    public function addToCart(LivewireProduct $product)
    {
        $user = Auth::user();
        $cartItem = LivewireCartItem::where('user_id', 1)->where('livewire_product_id', $product->id,)->first();
        try {
            if (empty($cartItem)) {
                LivewireCartItem::create([
                    'user_id' => 1,
                    'livewire_product_id' => $product->id,
                    'number' => 1,
                    'price' => $product->price
                ]);
                $this->emitTo('product.cart-header', 'refresh');
                $this->emit('swal', [
                    'title' => 'موفق',
                    'text' => 'محصول با موفقیت به سبد خرید اضافه شد',
                    'confirmButtonText' => 'باشه',
                    'icon' => 'success',
                    //'timer'=>3000,
                    //'position'=>'center',
                    //'toast'=>true,
                ]);
            } else {
                $this->emit('swal', [
                    'title' => 'خطا!',
                    'text' => 'محصول در سبد خرید موجود میباشد',
                    'confirmButtonText' => 'باشه',
                    'icon' => 'error',
                    //'timer'=>3000,
                    //'position'=>'center',
                    //'toast'=>true,
                ]);
            }
        } catch (Exception $exception) {
            $this->emit('swal', [
                'title' => 'خطا!',
                'text' => $exception->getMessage(),
                'confirmButtonText' => 'باشه',
                'icon' => 'error',
                //'timer'=>3000,
                //'position'=>'center',
                //'toast'=>true,
            ]);
        }

    }

    public function render()
    {
        return view('livewire.product.index', ['products' => LivewireProduct::all()]);
    }
}
