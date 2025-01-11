<!-- start vontent header -->
<section class="lazyload-wrapper">
    <section class="lazyload light-owl-nav owl-carousel owl-theme">

        @foreach($products as $product)
            <section class="item">
                <section class="lazyload-item-wrapper">
                    <section class="product">
                        <section class="product-add-to-cart"><a
                                href="{{route('market.cart.add-product',[$product])}}"
                                data-bs-toggle="tooltip"
                                data-bs-placement="left"
                                title="افزودن به سبد خرید"><i
                                    class="fa fa-cart-plus"></i></a></section>
                        @auth
                            @if($product->user->contains(auth()->user()->id))
                                <section class="product-add-to-favorite">
                                    <button class="btn btn-light btn-sm"
                                            data-url="{{route('market.product.is-favorite',$product)}}"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="left"
                                            title="حذف از علاقه مندی"><i
                                            class="fa fa-heart text-danger"></i></button>
                                </section>
                            @else
                                <section class="product-add-to-favorite">
                                    <button class="btn btn-light btn-sm"
                                            data-url="{{route('market.product.is-favorite',$product)}}"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="left"
                                            title="افزودن به علاقه مندی"><i
                                            class="fa fa-heart"></i></button>
                                </section>
                            @endif
                        @endauth
                        @guest
                            <section class="product-add-to-favorite">
                                <button class="btn btn-light btn-sm"
                                        data-url="{{route('market.product.is-favorite',$product)}}"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="left"
                                        title="افزودن به علاقه مندی"><i
                                        class="fa fa-heart"></i></button>
                            </section>
                        @endguest
                        <a class="product-link" href="{{route('market.product',$product)}}">
                            <section class="product-image">
                                <img class=""
                                     src="{{asset($product->image['indexArray'][$product->image['currentImage']])}}"
                                     alt="{{$product->name}}">
                            </section>
                            <section class="product-name">
                                <h3>{{$product->name}}</h3>
                            </section>
                            <section class="product-price-wrapper">
                                @if(!empty($product->activeAmazingSale() ?? []))
                                    <section class="product-discount">
                                                                <span
                                                                    class="product-old-price">{{priceFormat($product->price)}}</span>
                                        <span
                                            class="product-discount-amount"> % {{convertEnglishToPersian($product->activeAmazingSale()->percentage)}}</span>
                                    </section>
                                    <section
                                        class="product-price">{{priceFormat($product->price - ($product->price * $product->activeAmazingSale()->percentage / 100))}}
                                        تومان
                                    </section>
                                @elseif(!empty($commonDiscount))
                                    <section class="product-discount">
                                                                <span
                                                                    class="product-old-price">{{priceFormat($product->price)}}</span>
                                        <span
                                            class="product-discount-amount"> % {{convertEnglishToPersian($commonDiscount->percentage)}}</span>
                                    </section>
                                    <section
                                        class="product-price">{{priceFormat($product->price - ($product->price * $commonDiscount->percentage / 100))}}
                                        تومان
                                    </section>
                                @else
                                    <section
                                        class="product-price">{{priceFormat($product->price)}}
                                        تومان
                                    </section>
                                @endif
                            </section>
                            <section class="product-colors">
                                @foreach($product->colors ?? [] as $color)
                                    <section class="product-colors-item"
                                             style="background-color: {{$color->color}};"></section>
                                @endforeach
                            </section>
{{--                            <section class="cart-item text-success">--}}
{{--                                موجود--}}
{{--                            </section>--}}
{{--                            <section class="cart-item text-danger">--}}
{{--                                ناموجود--}}
{{--                            </section>--}}
                        </a>
                    </section>
                </section>
            </section>
        @endforeach
    </section>
</section>
