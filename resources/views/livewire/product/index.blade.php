<div class="row m-5">
    <div>
        <button wire:click="$emitTo('product.base','changeView')" class="btn btn-dark">ایجاد محصول</button>
    </div>
    @foreach($products as $product)
        <div class="col-md-3 mt-4">
            <div class="card">
                <img class="card-img-top" src="{{$product->imageUrl()}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$product->title}}</h5>
                    <p class="card-text">{{$product->description}}</p>

                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                        <button wire:click="addToCart({{$product->id}})" wire:loading.attr="disabled" wire:target="addToCart({{$product->id}})" class="btn btn-primary btn-sm">افزودن به سبد خرید
                            <div wire:loading wire:target="addToCart({{$product->id}})">
                                <div class="spinner-border spinner-border-sm"></div>
                            </div>
                        </button>
                    <span class="card-text">{{number_format($product->price)}} تومان </span>
                </div>
            </div>
        </div>
    @endforeach
</div>
