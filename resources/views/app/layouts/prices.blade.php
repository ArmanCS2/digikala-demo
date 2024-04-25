@if(!empty($order->copan))
    <section class="d-flex justify-content-between align-items-center">
        <p class="text-muted">قیمت کالاها ({{priceFormat($cartItems->count())}})</p>
        <p class="text-dark fw-bold">{{priceFormat($finalProductPrices)}} تومان</p>
    </section>

    <section class="d-flex justify-content-between align-items-center">
        <p class="text-muted">کد تخفیف اعمال شده</p>
        <p class="text-danger">{{priceFormat($order->copan_discount_amount)}}
            تومان</p>
    </section>

    <section class="d-flex justify-content-between align-items-center">
        <p class="text-muted">حداکثر مبلغ تخفیف</p>
        <p class="text-muted">{{priceFormat($order->copan_object->discount_ceiling ?? 0)}}
            تومان</p>
    </section>

    <section class="border-bottom mb-3"></section>

    <section class="d-flex justify-content-between align-items-center">
        <p class="text-muted">جمع سبد خرید</p>
        <p class="fw-bolder">{{priceFormat($order->final_price - $order->copan_discount_amount)}}
            تومان</p>
    </section>
@elseif(!empty($commonDiscount))
    <section class="d-flex justify-content-between align-items-center">
        <p class="text-muted">قیمت کالاها ({{priceFormat($cartItems->count())}})</p>
        <p class="text-dark fw-bold">{{priceFormat($finalProductPrices)}} تومان</p>
    </section>
    <section class="d-flex justify-content-between align-items-center">
        <p class="text-muted">درصد تخفیف سایت</p>
        <p class="text-danger fw-bolder"><span>{{convertEnglishToPersian($commonDiscount->percentage)}}</span>
            <span class="small"> % </span></p>
    </section>

    <section class="d-flex justify-content-between align-items-center">
        <p class="text-muted">حداکثر مبلغ تخفیف</p>
        <p class="text-muted">{{priceFormat($commonDiscount->discount_ceiling)}}
            تومان</p>
    </section>


    <section class="border-bottom mb-3"></section>

    <section class="d-flex justify-content-between align-items-center">
        <p class="text-muted">جمع سبد خرید</p>
        <p class="fw-bolder">{{priceFormat($totalProductPrices - ($totalProductPrices  * $commonDiscount->percentage /100))}}
            تومان</p>
    </section>

@else
    <section class="d-flex justify-content-between align-items-center">
        <p class="text-muted">قیمت کالاها ({{priceFormat($cartItems->count())}})</p>
        <p class="text-dark fw-bold">{{priceFormat($finalProductPrices)}} تومان</p>
    </section>
    @if($finalProductDiscounts !=0)
        <section class="d-flex justify-content-between align-items-center">
            <p class="text-muted">تخفیف کالاها</p>
            <p class="text-danger fw-bolder">{{priceFormat($finalProductDiscounts)}}
                تومان</p>
        </section>
    @endif
    <section class="border-bottom mb-3"></section>

    <section class="d-flex justify-content-between align-items-center">
        <p class="text-muted">جمع سبد خرید</p>
        <p class="fw-bolder">{{priceFormat($totalProductPrices)}} تومان</p>
    </section>

@endif
