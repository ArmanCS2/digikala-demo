<div class="row m-5">
    @if ($cartItems->count()==0)
        <div class="col-md-12 text-center">
            <div class="d-flex justify-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="130" height="130" viewBox="0 0 24 24">
                    <path
                        d="M10 19.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5zm3.5-1.5c-.828 0-1.5.671-1.5 1.5s.672 1.5 1.5 1.5 1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5zm1.336-5l1.977-7h-16.813l2.938 7h11.898zm4.969-10l-3.432 12h-12.597l.839 2h13.239l3.474-12h1.929l.743-2h-4.195z">
                    </path>
                </svg>
            </div>
            <h3 class="text-bold d-flex justify-content-center">سبد خرید خالی است</h3>
            <a href="{{ route('livewire.product.base') }}" class="btn btn-outline-dark mt-3">محصولات</a>
        </div>
    @else
        <div class="col-lg-12 pl-3 pt-3">
            <table class="table table-hover border bg-white">
                <thead>
                <tr>
                    <th>محصول</th>
                    <th>قیمت</th>
                    <th style="width:10%;">تعداد</th>
                    <th>مجموع قیمت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($cartItems as $cartItem)
                    <tr>
                        <td class="align-middle">
                            <div class="row">
                                <div class="col-lg-2">
                                    <img src="{{ $cartItem->product->imageUrl() }}"
                                         alt="..." class="img-fluid" />
                                </div>
                                <div class="col-lg-10">
                                    <h4>{{ $cartItem->product->title }}</h4>
                                    <p>{{ $cartItem->product->description }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle"> {{ number_format($cartItem->price) }} تومان </td>
                        <td class="align-middle" style="width: 15%">
                            <button wire:loading.attr="disabled" wire:target="increment({{ $cartItem->id }})"
                                    wire:click="increment({{ $cartItem->id }})" class="btn btn-sm btn-dark me-2">
                                +
                                <div wire:loading wire:target="increment({{ $cartItem->id }})">
                                    <div class="spinner-border spinner-border-sm"></div>
                                </div>
                            </button>

                            <span>{{ $cartItem->number }}</span>

                            <button wire:loading.attr="disabled" wire:target="decrement({{ $cartItem->id }})"
                                    wire:click="decrement({{ $cartItem->id }})" class="btn btn-sm btn-dark ms-2">
                                -
                                <div wire:loading wire:target="decrement({{ $cartItem->id }})">
                                    <div class="spinner-border spinner-border-sm"></div>
                                </div>
                            </button>
                        </td>
                        <td class="align-middle"> {{ number_format($cartItem->price * $cartItem->number) }} تومان </td>
                        <td class="align-middle" style="width:15%;">
                            <button wire:loading.attr="disabled" wire:target="delete({{ $cartItem->id }})"
                                    wire:click="delete({{ $cartItem->id }})" class="btn btn-danger btn-sm">
                                حذف
                                <div wire:loading wire:target="delete({{ $cartItem->id }})">
                                    <div class="spinner-border spinner-border-sm"></div>
                                </div>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td>
                        <button wire:click="clearCart" wire:loading.attr="disabled" wire:target="clearCart" class="btn btn-dark">
                            حذف محصولات
                            <div wire:loading wire:target="clearCart">
                                <div class="spinner-border spinner-border-sm"></div>
                            </div>
                        </button>
                    </td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center" style="width:15%;"><strong>مجموع :
                            {{ number_format($cartItemsPrices)  }} تومان </strong></td>
                    <td><button class="btn btn-success btn-block">ادامه</button>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    @endif
</div>
