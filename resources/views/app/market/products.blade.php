@extends('app.layouts.master-two-col2')

@section('head-tag')
    <meta name="description" content="بوتیکالا محصولات پوشاک تیشرت">
    <meta name="keywords" content="بوتیکالا محصولات پوشاک تیشرت">
    <title>محصولات</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a class="text-decoration-none text-dark" href="{{route('home')}}">صفحه
                    اصلی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">کالا ها</li>
        </ol>
    </nav>
    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">
        <section class="filters mb-3">
            @if(!empty(request()->search))
                <span class="d-inline-block border p-1 rounded bg-light">نتیجه جستجو برای : <span
                        class="badge bg-info text-dark">"{{request()->search}}"</span></span>
            @endif
            @if(!empty(request()->brands))
                <span class="d-inline-block border p-1 rounded bg-light">برند :
                    @foreach(request()->brands as $brandId)
                        @php
                            $brand=\App\Models\Market\Brand::find($brandId);
                        @endphp
                        <span class="badge bg-info text-dark">"{{$brand->persian_name}}"</span>
                    @endforeach
                </span>
            @endif
            @if(!empty(request()->category))
                @php
                    $category=\App\Models\Market\ProductCategory::find(request()->category);
                @endphp
                <span class="d-inline-block border p-1 rounded bg-light">دسته : <span
                        class="badge bg-info text-dark">"{{$category->name}}"</span></span>
            @endif
            @if(!empty(request()->min_price))
                <span class="d-inline-block border p-1 rounded bg-light">قیمت از : <span
                        class="badge bg-info text-dark">{{priceFormat(request()->min_price)}} تومان</span></span>
            @endif
            @if(!empty(request()->max_price))
                <span class="d-inline-block border p-1 rounded bg-light">قیمت تا : <span
                        class="badge bg-info text-dark">{{priceFormat(request()->max_price)}} تومان</span></span>
            @endif

        </section>
        <section class="sort ">
            <span>مرتب سازی بر اساس : </span>
            <a class="btn {{request()->sort == 1 ? 'btn-info' : 'btn-light'}} btn-sm px-1 py-0"
               href="{{route('market.products',['search'=>request()->search,'sort'=>1,'min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands,'category'=>request()->category])}}">جدیدترین</a>
            <a class="btn {{request()->sort == 2 ? 'btn-info' : 'btn-light'}} btn-sm px-1 py-0"
               href="{{route('market.products',['search'=>request()->search,'sort'=>2,'min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands,'category'=>request()->category])}}">محبوب
                ترین</a>
            <a class="btn {{request()->sort == 3 ? 'btn-info' : 'btn-light'}} btn-sm px-1 py-0"
               href="{{route('market.products',['search'=>request()->search,'sort'=>3,'min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands,'category'=>request()->category])}}">گران
                ترین</a>
            <a class="btn {{request()->sort == 4 ? 'btn-info' : 'btn-light'}} btn-sm px-1 py-0"
               href="{{route('market.products',['search'=>request()->search,'sort'=>4,'min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands,'category'=>request()->category])}}">ارزان
                ترین</a>
            <a class="btn {{request()->sort == 5 ? 'btn-info' : 'btn-light'}} btn-sm px-1 py-0"
               href="{{route('market.products',['search'=>request()->search,'sort'=>5,'min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands,'category'=>request()->category])}}">پربازدیدترین</a>
            <a class="btn {{request()->sort == 6 ? 'btn-info' : 'btn-light'}} btn-sm px-1 py-0"
               href="{{route('market.products',['search'=>request()->search,'sort'=>6,'min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands,'category'=>request()->category])}}">پرفروش
                ترین</a>
            @if(!empty(request()->all()))
                <a class="btn btn-danger btn-sm px-1 py-0"
                   href="{{route('market.products')}}">حذف فیلتر ها</a>
            @endif
        </section>
        <section class="row my-4 d-flex justify-content-center">
            @forelse($products as $product)
                <section class="col-md-3 my-1">
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
                                <h2>{{$product->name}}</h2>
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
                        </a>
                    </section>
                </section>
            @empty
                <p>محصولی یافت نشد</p>
            @endforelse
            <section class="my-4 d-flex justify-content-center border-0">
                {{$products->links('pagination::custom')}}
            </section>
        </section>


    </section>
@endsection

@section('scripts')

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

@endsection



