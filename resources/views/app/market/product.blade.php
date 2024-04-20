@extends('app.layouts.master-one-col')

@section('head-tag')
    <title>{{$product->name}}</title>
    <style>
        /* Styling h1 and links
    ––––––––––––––––––––––––––––––––– */
        .starrating > input {
            display: none;
        }

        /* Remove radio buttons */

        .starrating > label:before {
            content: "\f005";
            /* Star */
            margin: 2px;
            font-size: 2em;
            font-family: FontAwesome;
            display: inline-block;
        }

        .starrating > label {
            color: #222222;
            /* Start color when not clicked */
        }

        .starrating > input:checked ~ label {
            color: #ffca08;
        }

        /* Set yellow color when star checked */

        .starrating > input:hover ~ label {
            color: #ffca08;
        }

        /* Set yellow color when star hover */
    </style>
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
                            <h1 class="content-header-title">
                                <span>{{$product->name}}</span>
                            </h1>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">
                        <!-- start image gallery -->
                        <section class="col-md-4">
                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">
                                <section class="product-gallery">
                                    <section class="product-gallery-selected-image mb-3">
                                        <img
                                            src="{{asset($product->image['indexArray'][$product->image['currentImage']])}}"
                                            alt="{{$product->name}}">
                                    </section>
                                    <section class="product-gallery-thumbs">
                                        <img class="product-gallery-thumb"
                                             src="{{asset($product->image['indexArray'][$product->image['currentImage']])}}"
                                             alt="{{$product->name}}"
                                             data-input="{{asset($product->image['indexArray'][$product->image['currentImage']])}}">
                                        @foreach($product->images as $image)
                                            <img class="product-gallery-thumb" src="{{asset($image->image)}}"
                                                 alt="{{$product->name}}"
                                                 data-input="{{asset($image->image)}}">
                                        @endforeach
                                    </section>
                                </section>
                            </section>
                        </section>
                        <!-- end image gallery -->


                        <!-- start product info -->
                        <section class="col-md-5">

                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            {{$product->name}}
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="product-info">
                                    <form action="{{route('market.cart.add-product',[$product])}}" method="post"
                                          id="add-product-form">
                                        @csrf
                                        @if(!empty($product->colors()->get()->toArray()))
                                            <p><span>رنگ انتخاب شده : <span id="selected-color-name"></span></span></p>
                                            <section class="d-flex">
                                                @foreach($product->colors as $key => $color)
                                                    <section class="mx-2">
                                                        <label for="{{'color_' . $color->id}}"
                                                               style="background-color: {{$color->color}};"
                                                               class="product-info-colors mx-0" data-bs-toggle="tooltip"
                                                               data-bs-placement="bottom"
                                                               title="{{$color->name}}"></label>
                                                        <input class="mx-0" type="radio" name="color"
                                                               id="{{'color_' . $color->id}}" value="{{$color->id}}"
                                                               data-color-name="{{$color->name}}"
                                                               data-color-price="{{$color->price_increase}}"
                                                               @if($key==0) checked @endif>
                                                    </section>
                                                @endforeach
                                            </section>
                                        @endif
                                        @if(!empty($product->guarantees()->get()->toArray()))
                                            <section class="my-3 col-6">
                                                <i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i>
                                                گارانتی :
                                                <select name="guarantee" id="guarantee"
                                                        class="form-control form-control-sm">

                                                    @foreach($product->guarantees as $key => $guarantee)
                                                        <option value="{{$guarantee->id}}"
                                                                data-guarantee-price="{{$guarantee->price_increase}}"
                                                                @if($key==0) selected @endif>
                                                            {{$guarantee->name}}
                                                        </option>

                                                    @endforeach

                                                </select>
                                            </section>
                                        @endif

                                        <p class="my-4">
                                            @if($product->marketable_number > 0)
                                                <i class="fa fa-store-alt cart-product-selected-store me-1"></i>
                                                <span>کالا موجود در انبار</span>
                                            @else
                                                <i class="fa fa-store-alt cart-product-selected-store me-1"></i>
                                                <span>کالا ناموجود است</span>
                                            @endif
                                        </p>


                                        {!! $product->introduction !!}

                                        <section>
                                            <section class="cart-product-number d-none ">
                                                {{--                                                <button class="cart-number cart-number-down" type="button">---}}
                                                {{--                                                </button>--}}
                                                {{--                                                <input class="" type="number" name="number" id="number" min="1"--}}
                                                {{--                                                       max="5"--}}
                                                {{--                                                       step="1" value="1"--}}
                                                {{--                                                       readonly="readonly">--}}
                                                {{--                                                <button class="cart-number cart-number-up" type="button">+--}}
                                                {{--                                                </button>--}}
                                                <input class="d-none" type="number" name="number" id="number" value="1">
                                            </section>
                                        </section>
                                        <p class="mb-3 mt-5">
                                            <i class="fa fa-info-circle me-1"></i>کاربر گرامی خرید شما هنوز
                                            نهایی نشده
                                            است.
                                            برای ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس
                                            نحوه
                                            ارسال
                                            را انتخاب کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه
                                            شده خواهد
                                            شد.
                                            و در نهایت پرداخت این سفارش صورت میگیرد. پس از ثبت سفارش کالا بر
                                            اساس نحوه
                                            ارسال
                                            که شما انتخاب کرده اید کالا برای شما در مدت زمان مذکور ارسال می
                                            گردد.
                                        </p>
                                    </form>
                                </section>
                            </section>

                        </section>
                        <!-- end product info -->

                        <section class="col-md-3">
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">قیمت کالا</p>
                                    <p class="text-muted"><span id="product-price"
                                                                data-product-original-price="{{$product->price}}">{{priceFormat($product->price)}}</span><span
                                            class="small"> تومان </span></p>
                                </section>
                                @if(!empty($product->activeAmazingSale()))
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">درصد تخفیف</p>
                                        <p class="text-danger fw-bolder"><span id="product-discount-percentage"
                                                                               data-product-discount-percentage="{{$product->activeAmazingSale()->percentage}}"></span>
                                            <span class="small"> % </span></p>
                                        <p class="text-muted">تخفیف کالا</p>
                                        <p class="text-danger fw-bolder"><span id="product-discount-price"
                                                                               data-product-discount-price="{{$product->price * $product->activeAmazingSale()->percentage / 100}}"></span>
                                            <span class="small">تومان</span></p>
                                    </section>
                                    <section class="border-bottom mb-3"></section>

                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">قیمت نهایی</p>
                                        <p class="fw-bolder"><span id="final-price"></span>
                                            <span class="small">تومان</span></p>
                                    </section>
                                @else
                                    <section class="border-bottom mb-3"></section>

                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">قیمت نهایی</p>
                                        <p class="fw-bolder"><span id="final-price"></span>
                                            <span class="small">تومان</span></p>
                                    </section>
                                @endif
                                @if($product->marketable_number > 0)
                                    <section class="">
                                        <button id="next-level" href="#"
                                                onclick="document.getElementById('add-product-form').submit();"
                                                class="btn btn-danger d-block w-100">افزودن به سبد
                                            خرید
                                        </button>
                                    </section>
                                @else
                                    <section class="">
                                        <a id="next-level" href="#" class="btn btn-dark d-block disabled">کالا
                                            ناموجود
                                            است</a>
                                    </section>
                                @endif
                                @auth
                                    @if($product->user->contains(auth()->user()->id))
                                        <section class="add-to-favorite mt-3">
                                            <button type="button"
                                                    class="btn btn-light btn-sm"
                                                    data-url="{{route('market.product.is-favorite',$product)}}"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="left"
                                                    title="حذف از علاقه مندی"><i
                                                    class="fa fa-heart text-danger"></i></button>
                                        </section>
                                    @else
                                        <section class="add-to-favorite my-2">
                                            <button type="button"
                                                    class="btn btn-light btn-sm"
                                                    data-url="{{route('market.product.is-favorite',$product)}}"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="left"
                                                    title="افزودن به علاقه مندی"><i
                                                    class="fa fa-heart"></i></button>
                                        </section>
                                    @endif
                                @endauth
                                @guest
                                    <section class="add-to-favorite my-2">
                                        <button type="button"
                                                class="btn btn-light btn-sm"
                                                data-url="{{route('market.product.is-favorite',$product)}}"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="left"
                                                title="افزودن به علاقه مندی"><i
                                                class="fa fa-heart"></i></button>
                                    </section>
                                @endguest
                            </section>
                        </section>

                    </section>
                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->



    <!-- start product lazy load -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>کالاهای مرتبط</span>
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
                                                        <h3>{{\Illuminate\Support\Str::limit($relatedProduct->name,30)}}</h3>
                                                    </section>
                                                    <section class="product-price-wrapper">
                                                        @if(!empty($relatedProduct->activeAmazingSale()))
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
    <!-- end product lazy load -->

    <!-- start description, features and comments -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start content header -->
                        <section id="introduction-features-comments" class="introduction-features-comments">
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span class="me-2"><a class="text-decoration-none text-dark"
                                                              href="#introduction">معرفی</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#features">ویژگی ها</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#comments">دیدگاه ها</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#rates">امتیاز ها</a></span>
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                        </section>
                        <!-- start content header -->

                        <section class="py-4">

                            <!-- start vontent header -->
                            <section id="introduction" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        معرفی
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-introduction mb-4">
                                {!! $product->introduction !!}
                            </section>

                            <!-- start vontent header -->
                            <section id="features" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        ویژگی ها
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-features mb-4 table-responsive">
                                <table class="table table-bordered border-white">

                                    @foreach($product->values as $value)
                                        <tr>
                                            <td>{{$value->attribute->name}}</td>
                                            <td>{{json_decode($value->value)->value}} {{$value->attribute->unit}}</td>
                                        </tr>
                                    @endforeach

                                    @foreach($product->metas ?? [] as $meta)
                                        <tr>
                                            <td>{{$meta->meta_key}}</td>
                                            <td>{{$meta->meta_value}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </section>

                            <!-- start rating -->
                            <section id="rates" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        امتیاز ها
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            @auth

                                <section class="product-rating mb-4">

                                    <div class="container">
                                        <form
                                            class="starrating risingstar d-flex justify-content-end flex-row-reverse align-items-center"
                                            action="{{route('market.product.rate',$product)}}" method="post">
                                            @csrf
                                            <div class="mx-3">
                                                <button class="btn btn-info btn-sm">ثبت امتیاز</button>
                                            </div>
                                            <input type="radio" id="star5" name="rating" value="5"/>
                                            <label for="star5" title="5 star"></label>
                                            <input type="radio" id="star4" name="rating" value="4"/>
                                            <label for="star4" title="4 star"></label>
                                            <input type="radio" id="star3" name="rating" value="3"/>
                                            <label for="star3" title="3 star"></label>
                                            <input type="radio" id="star2" name="rating" value="2"/>
                                            <label for="star2" title="2 star"></label>
                                            <input type="radio" id="star1" name="rating" value="1"/>
                                            <label for="star1" title="1 star"></label>

                                        </form>
                                        <p class="my-1">
                                            میانگین امتیاز : {{ number_format($product->ratingsAvg(), 1, '/') ?? 0 }} از {{ $product->ratingsCount() ?? 0
                                }} نفر
                                        </p>


                                    </div>

                                </section>
                            @endauth
                            @guest
                                <section class="comment-add-wrapper">
                                    <p class="my-1">
                                        میانگین امتیاز : {{ number_format($product->ratingsAvg(), 1, '/') ?? 0 }} از {{ $product->ratingsCount() ?? 0
                                }} نفر
                                    @endguest

                                    <!-- start vontent header -->
                                    <section id="comments" class="content-header mt-2 mb-4">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h2 class="content-header-title content-header-title-small">
                                                دیدگاه ها
                                            </h2>
                                            <section class="content-header-link">
                                                <!--<a href="#">مشاهده همه</a>-->
                                            </section>
                                        </section>
                                    </section>
                                    <section class="product-comments mb-4">
                                        @guest
                                            <section class="comment-add-wrapper">
                                                <p>برای افزودن دیدگاه وارد حساب کاربری خود شوید</p>
                                                <a href="{{route('auth.customer.login-register-form')}}"
                                                   class="btn btn-primary">ورود
                                                    یا ثبت نام</a>
                                            </section>
                                        @endguest
                                        @auth
                                            <section class="comment-add-wrapper">
                                                <button class="comment-add-button" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#add-comment"><i class="fa fa-plus"></i> افزودن
                                                    دیدگاه
                                                </button>
                                                <!-- start add comment Modal -->
                                                <section class="modal fade" id="add-comment" tabindex="-1"
                                                         aria-labelledby="add-comment-label" aria-hidden="true">
                                                    <section class="modal-dialog">
                                                        <section class="modal-content">
                                                            <section class="modal-header">
                                                                <h5 class="modal-title" id="add-comment-label"><i
                                                                        class="fa fa-plus"></i> افزودن دیدگاه</h5>
                                                                <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </section>
                                                            <section class="modal-body">
                                                                <form class="row"
                                                                      action="{{route('market.product.store-comment',$product)}}"
                                                                      method="post">
                                                                    @csrf
                                                                    <section class="col-12 mb-2">
                                                                        <label for="comment" class="form-label mb-1">دیدگاه
                                                                            شما</label>
                                                                        <textarea class="form-control form-control-sm"
                                                                                  id="comment"
                                                                                  placeholder="دیدگاه شما ..."
                                                                                  rows="4" name="body"></textarea>
                                                                        @error('body')
                                                                        <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                                                        @enderror
                                                                    </section>
                                                                    <section class="modal-footer py-1">
                                                                        <button type="submit"
                                                                                class="btn btn-sm btn-primary">ثبت
                                                                            دیدگاه
                                                                        </button>
                                                                        <button type="button"
                                                                                class="btn btn-sm btn-danger"
                                                                                data-bs-dismiss="modal">بستن
                                                                        </button>
                                                                    </section>
                                                                </form>
                                                            </section>

                                                        </section>
                                                    </section>
                                                </section>
                                            </section>
                                        @endauth

                                        @foreach($product->approvedComments() as $comment)
                                            <section class="product-comment">
                                                <section class="product-comment-header d-flex justify-content-start">
                                                    <section
                                                        class="product-comment-date">{{jalaliDate($comment->created_at)}}</section>
                                                    <section
                                                        class="product-comment-title">{{$comment->user->full_name ?? 'ناشناس'}}</section>
                                                </section>
                                                <section class="product-comment-body">
                                                    {{$comment->body}}
                                                </section>
                                                @if(!empty($comment->answer))
                                                    <section class="product-comment ms-5 border-bottom-0">
                                                        <section
                                                            class="product-comment-header d-flex justify-content-start">
                                                            <section
                                                                class="product-comment-date">{{jalaliDate($comment->answer->created_at)}}</section>
                                                            <section class="product-comment-title">ادمین</section>
                                                        </section>
                                                        <section class="product-comment-body">
                                                            {{$comment->answer->body}}
                                                        </section>
                                                    </section>
                                                @endif
                                            </section>
                                        @endforeach


                                    </section>
                                </section>

                        </section>
                    </section>
                </section>
            </section>
        </section>
        <!-- end description, features and comments -->
        @endsection

        @section('scripts')
            <script>
                $(document).ready(function () {
                    bill();
                    //input color
                    $('input[name="color"]').change(function () {
                        bill();
                    })
                    //guarantee
                    $('select[name="guarantee"]').change(function () {
                        bill();
                    })
                    //number
                    $('.cart-number').click(function () {
                        bill();
                    })
                })

                function bill() {
                    if ($('input[name="color"]:checked').length != 0) {
                        var selected_color = $('input[name="color"]:checked');
                        $("#selected_color_name").html(selected_color.attr('data-color-name'));
                    }

                    //price computing
                    var selected_color_price = 0;
                    var selected_guarantee_price = 0;
                    var number = 1;
                    var product_discount_price = 0;
                    var product_discount_percentage = 0;
                    var product_original_price = parseFloat($('#product-price').attr('data-product-original-price'));

                    if ($('input[name="color"]:checked').length != 0) {
                        selected_color_price = parseFloat(selected_color.attr('data-color-price'));
                    }

                    if ($('#guarantee option:selected').length != 0) {
                        selected_guarantee_price = parseFloat($('#guarantee option:selected').attr('data-guarantee-price'));
                    }

                    var product_price = product_original_price + selected_color_price + selected_guarantee_price;

                    $('#product-price').html(toPersianNumber(product_price));


                    if ($('#product-discount-percentage').length != 0) {
                        product_discount_percentage = parseFloat($('#product-discount-percentage').attr('data-product-discount-percentage'));
                        product_discount_price = product_price * product_discount_percentage / 100;
                    }


                    if ($('#number').val() > 0) {
                        number = parseFloat($('#number').val());
                    }
                    var final_price = number * (product_price - product_discount_price);


                    $('#product-discount-percentage').html(toPersianNumber(product_discount_percentage));
                    $('#product-discount-price').html(toPersianNumber(product_discount_price));
                    $('#final-price').html(toPersianNumber(final_price));
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



