<section class="lazyload-wrapper">
    <section class="lazyload light-owl-nav owl-carousel owl-theme">

        @foreach($products as $product)

            @php
                $activeSale = $product->activeAmazingSale();
                $discountPercent = $activeSale->percentage ?? $commonDiscount->percentage ?? null;
                $hasDiscount = !empty($discountPercent);
                $finalPrice = $hasDiscount
                    ? $product->price - ($product->price * $discountPercent / 100)
                    : $product->price;
                $isFavorite = auth()->check() && $product->user->contains(auth()->id());
            @endphp

            <section class="item">
                <section class="lazyload-item-wrapper">

                    <section class="product">

                        {{-- Add to Cart --}}
                        <section class="product-add-to-cart">
                            <a href="{{ route('market.cart.add-product', $product) }}"
                               data-bs-toggle="tooltip"
                               title="افزودن به سبد خرید">
                                <i class="fa fa-cart-plus"></i>
                            </a>
                        </section>

                        {{-- Favorite --}}
                        <section class="product-add-to-favorite">
                            <button class="btn btn-light btn-sm"
                                    data-url="{{ route('market.product.is-favorite', $product) }}"
                                    data-bs-toggle="tooltip"
                                    title="{{ $isFavorite ? 'حذف از علاقه‌مندی' : 'افزودن به علاقه‌مندی' }}">
                                <i class="fa fa-heart {{ $isFavorite ? 'text-danger' : '' }}"></i>
                            </button>
                        </section>

                        {{-- Product Link --}}
                        <a class="product-link" href="{{ route('market.product', $product) }}">

                            {{-- Image --}}
                            <section class="product-image">
                                <img
                                    loading="lazy"
                                    src="{{ asset($product->image['indexArray'][$product->image['currentImage']]) }}"
                                    alt="خرید {{ $product->name }} | بوتیکالا"
                                    width="300" height="300"
                                >

                            </section>

                            {{-- Name --}}
                            <section class="product-name">
                                <h3>{{ $product->name }}</h3>
                            </section>

                            {{-- Price --}}
                            <section class="product-price-wrapper">

                                @if($hasDiscount)
                                    <section class="product-discount">
                                        <span class="product-old-price">{{ priceFormat($product->price) }}</span>
                                        <span class="product-discount-amount">% {{ convertEnglishToPersian($discountPercent) }}</span>
                                    </section>

                                    <section class="product-price">
                                        {{ priceFormat($finalPrice) }} تومان
                                    </section>
                                @else
                                    <section class="product-price">
                                        {{ priceFormat($product->price) }} تومان
                                    </section>
                                @endif

                            </section>

                            {{-- Colors --}}
                            <section class="product-colors">
                                @foreach($product->colors ?? [] as $color)
                                    <section class="product-colors-item"
                                             style="background-color: {{ $color->color }}"></section>
                                @endforeach
                            </section>

                        </a>

                    </section>

                </section>
            </section>

        @endforeach

    </section>
</section>
