@extends('app.layouts.master-two-col')

@section('head-tag')
    <title>علاقه مندی ها</title>
@endsection

@section('content')

    <!-- start vontent header -->
    <section class="content-header mb-4">
        <section class="d-flex justify-content-between align-items-center">
            <h2 class="content-header-title">
                <span>لیست علاقه مندی های من</span>
            </h2>
            <section class="content-header-link">
                <!--<a href="#">مشاهده همه</a>-->
            </section>
        </section>
    </section>
    <!-- end vontent header -->


    @forelse($products as $product)

        <section class="cart-item d-flex py-3">
            <section class="cart-img align-self-start flex-shrink-1"><a
                    href="{{route('market.product',[$product])}}"><img
                        src="{{asset($product->image['indexArray'][$product->image['currentImage']])}}"
                        alt="{{$product->name}}"></a></section>
            <section class="align-self-start w-100">
                <a href="{{route('market.product',[$product])}}" class="text-decoration-none text-dark"><p
                        class="fw-bold">{{$product->name}}</p></a>
                @if($product->marketable_number > 0)
                    <p><i class="fa fa-store-alt cart-product-selected-store me-1"></i> <span>کالا موجود در انبار</span>
                    </p>
                @else
                    <p><i class="fa fa-store-alt cart-product-selected-store me-1"></i> <span>کالا ناموجود است</span>
                    </p>
                @endif
                <section>
                    <a class="text-decoration-none cart-delete"
                       href="{{route('profile.delete-from-favorites',$product)}}"><i class="fa fa-trash-alt"></i> حذف از
                        لیست علاقه ها</a>
                </section>
            </section>
            <section class="align-self-start flex-shrink-1">
                @if(!empty($product->activeAmazingSale()))
                    <section class="cart-item-discount text-danger text-nowrap mb-1">
                        تخفیف {{priceFormat($product->activeAmazingSale()->percentage*$product->price/100)}} تومان
                    </section>
                @endif
                <section class="text-nowrap fw-bold">{{priceFormat($product->price)}} تومان</section>
            </section>
        </section>
    @empty
        <section class="cart-item d-flex py-3">
            <p>
                محصولی یافت نشد
            </p>
        </section>

    @endforelse

@endsection


