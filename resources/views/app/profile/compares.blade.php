@extends('app.layouts.master-two-col')

@section('head-tag')
    <title>مقایسه ها</title>
@endsection

@section('content')

    <!-- start vontent header -->
    <section class="content-header mb-4">
        <section class="d-flex justify-content-between align-items-center">
            <h2 class="content-header-title">
                <span>لیست مقایسه های من</span>
            </h2>
            <section class="content-header-link">
                <!--<a href="#">مشاهده همه</a>-->
            </section>
        </section>
    </section>
    <!-- end vontent header -->

    @if($products->count() > 0)
        <section class="container table-responsive">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td>تصویر کالا</td>
                    @foreach($products as $product)
                        <td>
                            <section class="d-flex justify-content-center">
                            <a href="{{route('market.product',$product)}}"><img
                                    src="{{asset($product->image['indexArray'][$product->image['currentImage']])}}"
                                    alt="{{$product->name}}" width="200px" height="200px"></a>
                            </section>

                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td>نام کالا</td>
                    @foreach($products as $product)
                        <td>
                            <section class="product-name">
                                <h3><a class="text-dark"
                                       href="{{route('market.product',$product)}}">{{$product->name}}</a></h3>
                            </section>
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td>قیمت کالا</td>
                    @foreach($products as $product)
                        <td>
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
                                @else
                                    <section
                                        class="product-price">{{priceFormat($product->price)}}
                                        تومان
                                    </section>
                                @endif
                            </section>
                        </td>
                    @endforeach
                </tr>

                <tr>
                    <td>جنس کالا</td>
                    @foreach($products as $product)
                        <td>
                            <section class="product-name d-flex justify-content-center">
                                <h3>{{$product->material}}</h3>
                            </section>
                        </td>
                    @endforeach
                </tr>


                <tr>
                    <td>سایز کالا</td>
                    @foreach($products as $product)
                        <td>
                            <section class="product-name d-flex justify-content-center">
                                <h3>{{$product->size}}</h3>
                            </section>
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td>رنگ کالا</td>
                    @foreach($products as $product)
                        <td>
                            <section class="d-flex justify-content-center">
                                @foreach($product->colors as $key => $color)
                                    <label for="{{'color_' . $color->id}}"
                                           style="background-color: {{$color->color}};"
                                           class="product-info-colors mx-1 border"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="bottom"
                                           title="{{$color->name}}"></label>
                                @endforeach
                            </section>

                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td>عملیات</td>
                    @foreach($products as $product)
                        <td><section class="d-flex justify-content-center my-2">
                                <a href="{{route('market.product.remove-from-compare',$product)}}"
                                   class="btn btn-danger btn-sm">حذف</a>
                            </section></td>
                    @endforeach
                </tr>
                </tbody>
            </table>
        </section>
    @else
        <h2>محصولی برای مقایسه یافت نشد</h2>
    @endif

@endsection


