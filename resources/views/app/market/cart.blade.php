@extends('app.layouts.master-one-col')

@section('head-tag')
    <title>سبد خرید</title>
@endsection


@section('content')
    <!-- start cart -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>سبد خرید شما</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">
                        <section class="col-md-9 mb-3">

                            <form action="{{route('market.cart.update')}}" method="post" id="cart-items"
                                  class="content-wrapper bg-white p-3 rounded-2">
                                @csrf
                                @method('put')
                                @foreach($cartItems as $cartItem)
                                    <section class="cart-item d-md-flex py-3">
                                        <section class="cart-img align-self-start flex-shrink-1"><a
                                                href="{{route('market.product',[$cartItem->product])}}"><img
                                                    src="{{asset($cartItem->product->image['indexArray'][$cartItem->product->image['currentImage']])}}"
                                                    alt="{{$cartItem->product->name}}"></a></section>
                                        <section class="align-self-start w-100">
                                            <a class="fw-bold text-decoration-none text-dark"
                                               href="{{route('market.product',[$cartItem->product])}}">
                                                <p>{{$cartItem->product->name}}</p></a>
                                            @if(!empty($cartItem->color_id))
                                                <p><span style="background-color: {{$cartItem->color->color}};"
                                                         class="cart-product-selected-color me-1 border"></span>
                                                    <span>{{$cartItem->color->name}}</span>
                                                </p>
                                            @endif
                                            @if(!empty($cartItem->guarantee_id))
                                                <p><i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i>
                                                    <span>{{$cartItem->guarantee->name}}</span>
                                                </p>
                                            @endif
                                            <p><i class="fa fa-store-alt cart-product-selected-store me-1"></i> <span>کالا موجود در انبار</span>
                                            </p>
                                            <section>
                                                <section class="cart-product-number d-inline-block d-none">
                                                    <button class="cart-number cart-number-down" type="button">-
                                                    </button>
                                                    <input class="number d-none"
                                                           name="number[{{$cartItem->id}}]"
                                                           data-product-discount="{{$cartItem->productDiscount()}}"
                                                           data-product-price="{{$cartItem->productPrice()}}"
                                                           type="number" min="1" max="5" step="1"
                                                           value="{{$cartItem->number}}"
                                                           readonly="readonly">
                                                    <button class="cart-number cart-number-up" type="button">+</button>
                                                </section>
                                                <a class="text-decoration-none cart-delete"
                                                   href="{{route('market.cart.remove-product',[$cartItem])}}"><i
                                                        class="fa fa-trash-alt"></i> حذف از سبد</a>
                                            </section>
                                        </section>
                                        <section class="align-self-center flex-shrink-1">
                                            @if(!empty($cartItem->product->activeAmazingSale()))
                                                <section class="cart-item-discount text-danger text-nowrap mb-1">تخفیف
                                                    {{priceFormat($cartItem->productDiscount())}} تومان
                                                </section>
                                            @endif
                                            <section
                                                class="text-nowrap fw-bold">{{priceFormat($cartItem->productPrice())}}
                                                تومان
                                            </section>
                                        </section>
                                    </section>
                                @endforeach
                            </form>

                        </section>
                        <section class="col-md-3">
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                @include('app.layouts.prices')

                                <p class="my-3">
                                    <i class="fa fa-info-circle me-1"></i>کاربر گرامی خرید شما هنوز نهایی نشده است. برای
                                    ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب
                                    کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت
                                    پرداخت این سفارش صورت میگیرد.
                                </p>


                                <section class="">
                                    <button onclick="document.getElementById('cart-items').submit();"
                                            class="btn btn-danger d-block w-100">تکمیل فرآیند خرید
                                    </button>
                                </section>

                            </section>
                        </section>
                    </section>
                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->




    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>کالا های دیگر</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper">
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">


                                @foreach($relatedProducts as $relatedProduct)
                                    <section class="item">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">
                                                <section class="product-add-to-cart"><a
                                                        href="{{route('market.cart.add-product',[$relatedProduct])}}"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="left"
                                                        title="افزودن به سبد خرید"><i
                                                            class="fa fa-cart-plus"></i></a></section>
                                                @auth
                                                    @if($relatedProduct->user->contains(auth()->user()->id))
                                                        <section class="product-add-to-favorite">
                                                            <button class="btn btn-light btn-sm"
                                                                    data-url="{{route('market.product.is-favorite',$relatedProduct)}}"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="left"
                                                                    title="حذف از علاقه مندی"><i
                                                                    class="fa fa-heart text-danger"></i></button>
                                                        </section>
                                                    @else
                                                        <section class="product-add-to-favorite">
                                                            <button class="btn btn-light btn-sm"
                                                                    data-url="{{route('market.product.is-favorite',$relatedProduct)}}"
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
                                                                data-url="{{route('market.product.is-favorite',$relatedProduct)}}"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-placement="left"
                                                                title="افزودن به علاقه مندی"><i
                                                                class="fa fa-heart"></i></button>
                                                    </section>
                                                @endguest
                                                <a class="product-link"
                                                   href="{{route('market.product',$relatedProduct)}}">
                                                    <section class="product-image">
                                                        <img class=""
                                                             src="{{asset($relatedProduct->image['indexArray'][$relatedProduct->image['currentImage']])}}"
                                                             alt="{{$relatedProduct->name}}">
                                                    </section>
                                                    <section class="product-name">
                                                        <h3>{{$relatedProduct->name}}</h3>
                                                    </section>
                                                    <section class="product-price-wrapper">
                                                        @if(!empty($relatedProduct->activeAmazingSale() ?? []))
                                                            <section class="product-discount">
                                                                <span
                                                                    class="product-old-price">{{priceFormat($relatedProduct->price)}}</span>
                                                                <span
                                                                    class="product-discount-amount"> % {{convertEnglishToPersian($relatedProduct->activeAmazingSale()->percentage)}}</span>
                                                            </section>
                                                            <section
                                                                class="product-price">{{priceFormat($relatedProduct->price - ($relatedProduct->price * $relatedProduct->activeAmazingSale()->percentage / 100))}}
                                                                تومان
                                                            </section>
                                                        @elseif(!empty($commonDiscount))
                                                            <section class="product-discount">
                                                                <span
                                                                    class="product-old-price">{{priceFormat($relatedProduct->price)}}</span>
                                                                <span
                                                                    class="product-discount-amount"> % {{convertEnglishToPersian($commonDiscount->percentage)}}</span>
                                                            </section>
                                                            <section
                                                                class="product-price">{{priceFormat($relatedProduct->price - ($relatedProduct->price * $commonDiscount->percentage / 100))}}
                                                                تومان
                                                            </section>
                                                        @else
                                                            <section
                                                                class="product-price">{{priceFormat($relatedProduct->price)}}
                                                                تومان
                                                            </section>
                                                        @endif
                                                    </section>
                                                    <section class="product-colors">
                                                        @foreach($relatedProduct->colors ?? [] as $productColor)
                                                            <section class="product-colors-item"
                                                                     style="background-color: {{$productColor->color}};"></section>
                                                        @endforeach
                                                    </section>
                                                </a>
                                            </section>
                                        </section>
                                    </section>
                                @endforeach

                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            bill();
            //number
            $('.cart-number').click(function () {
                bill();
            })
        })

        function bill() {

            var final_product_prices = 0;
            var final_product_discounts = 0;
            var total_product_prices = 0;

            $('.number').each(function () {
                var productPrice = parseFloat($(this).data('product-price'));
                var productDiscount = parseFloat($(this).data('product-discount'));
                var number = parseFloat($(this).val());

                final_product_prices += productPrice * number;
                final_product_discounts += productDiscount * number;
            })

            total_product_prices = final_product_prices - final_product_discounts;


            $('#final-product-prices').html(toPersianNumber(final_product_prices) + '  تومان  ');
            $('#final-product-discounts').html(toPersianNumber(final_product_discounts) + '  تومان  ');
            $('#total-product-prices').html(toPersianNumber(total_product_prices) + '  تومان  ');
        }

        function toPersianNumber(number) {
            const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            // add comma
            number = new Intl.NumberFormat().format(number);
            //convert to persian
            return number.toString().replace(/\d/g, x => farsiDigits[x]);
        }
    </script>

    <script>
        $('.add-to-favorite button').click(function () {
            var url = $(this).attr('data-url');
            var element = $(this);
            $.ajax({
                url: url,
                success: function (result) {
                    console.log(result)
                    if (result.status == 1) {
                        $(element).children().first().addClass('text-danger');
                        $(element).attr('data-original-title', 'حذف از علاقه مندی ها');
                        $(element).attr('data-bs-original-title', 'حذف از علاقه مندی ها');
                        successToast('محصول به علاقه مندی ها اضافه شد');
                    } else if (result.status == 2) {
                        $(element).children().first().removeClass('text-danger')
                        $(element).attr('data-original-title', 'افزودن به علاقه مندی ها');
                        $(element).attr('data-bs-original-title', 'افزودن به علاقه مندی ها');
                        successToast('محصول از علاقه مندی ها حذف شد');
                    } else if (result.status == 3) {
                        infoToast('برای افزودن به علاقه مندی وارد حساب کاربری خود شوید');
                    }
                }
            })


            function successToast(message) {
                var successToastTag = '<section class="toast" data-delay="4000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<a class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '</a>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(successToastTag);
                $('.toast-wrapper').removeClass('d-none');
                $('.toast').toast('show').delay(4000).queue(function () {
                    $('.toast-wrapper').addClass('d-none');
                    $(this).remove();
                });
            }

            function infoToast(message) {
                var successToastTag = '<section class="toast" data-delay="4000">\n' +
                    '<section class="toast-body py-3 d-flex bg-info text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<a href="{{route('auth.customer.login-register-form')}}" class="text-white">ورود</a>\n' +
                    '<a class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '</a>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(successToastTag);
                $('.toast-wrapper').removeClass('d-none');
                $('.toast').toast('show').delay(4000).queue(function () {
                    $('.toast-wrapper').addClass('d-none');
                    $(this).remove();
                });
            }

            function errorToast(message) {
                var errorToastTag = '<section class="toast" data-delay="4000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<a class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '</a>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(errorToastTag);
                $('.toast-wrapper').removeClass('d-none');
                $('.toast').toast('show').delay(4000).queue(function () {
                    $('.toast-wrapper').addClass('d-none');
                    $(this).remove();
                });
            }
        })
    </script>


    <script>
        $('.product-add-to-favorite button').click(function () {
            var url = $(this).attr('data-url');
            var element = $(this);
            $.ajax({
                url: url,
                success: function (result) {
                    console.log(result)
                    if (result.status == 1) {
                        $(element).children().first().addClass('text-danger');
                        $(element).attr('data-original-title', 'حذف از علاقه مندی ها');
                        $(element).attr('data-bs-original-title', 'حذف از علاقه مندی ها');
                        successToast('محصول به علاقه مندی ها اضافه شد');
                    } else if (result.status == 2) {
                        $(element).children().first().removeClass('text-danger')
                        $(element).attr('data-original-title', 'افزودن به علاقه مندی ها');
                        $(element).attr('data-bs-original-title', 'افزودن به علاقه مندی ها');
                        successToast('محصول از علاقه مندی ها حذف شد');
                    } else if (result.status == 3) {
                        infoToast('برای افزودن به علاقه مندی وارد حساب کاربری خود شوید');
                    }
                }
            })


            function successToast(message) {
                var successToastTag = '<section class="toast" data-delay="4000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<a class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '</a>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(successToastTag);
                $('.toast-wrapper').removeClass('d-none');
                $('.toast').toast('show').delay(4000).queue(function () {
                    $('.toast-wrapper').addClass('d-none');
                    $(this).remove();
                });
            }

            function infoToast(message) {
                var successToastTag = '<section class="toast" data-delay="4000">\n' +
                    '<section class="toast-body py-3 d-flex bg-info text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<a href="{{route('auth.customer.login-register-form')}}" class="text-white">ورود</a>\n' +
                    '<a class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '</a>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(successToastTag);
                $('.toast-wrapper').removeClass('d-none');
                $('.toast').toast('show').delay(4000).queue(function () {
                    $('.toast-wrapper').addClass('d-none');
                    $(this).remove();
                });
            }

            function errorToast(message) {
                var errorToastTag = '<section class="toast" data-delay="4000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<a class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '</a>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(errorToastTag);
                $('.toast-wrapper').removeClass('d-none');
                $('.toast').toast('show').delay(4000).queue(function () {
                    $('.toast-wrapper').addClass('d-none');
                    $(this).remove();
                });
            }
        })
    </script>

    <script>
        //start product introduction, features and comment
        $(document).ready(function () {
            var s = $("#introduction-features-comments");
            var pos = s.position();
            $(window).scroll(function () {
                var windowpos = $(window).scrollTop();

                if (windowpos >= pos.top) {
                    s.addClass("stick");
                } else {
                    s.removeClass("stick");
                }
            });
        });
        //end product introduction, features and comment
    </script>


@endsection



