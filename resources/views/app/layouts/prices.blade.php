@php
    $itemCountLabel = 'قیمت کالاها (' . priceFormat($cartItems->count()) . ')';
@endphp

{{-- اگر کوپن فعال است --}}
@if(!empty($order->copan))

    <section class="d-flex justify-content-between align-items-center">
        <p class="text-muted">{{ $itemCountLabel }}</p>
        <p class="text-dark fw-bold">{{ priceFormat($finalProductPrices) }} تومان</p>
    </section>

    <section class="d-flex justify-content-between align-items-center">
        <p class="text-muted">کد تخفیف اعمال شده</p>
        <p class="text-danger">{{ priceFormat($order->copan_discount_amount) }} تومان</p>
    </section>

    <section class="d-flex justify-content-between align-items-center">
        <p class="text-muted">حداکثر مبلغ تخفیف</p>
        <p class="text-muted">{{ priceFormat($order->copan_object->discount_ceiling ?? 0) }} تومان</p>
    </section>

    <section class="border-bottom mb-3"></section>

    <section class="d-flex justify-content-between align-items-center">
        <p class="text-muted">جمع سبد خرید</p>
        <p class="fw-bolder">{{ priceFormat($order->final_price - $order->copan_discount_amount) }} تومان</p>
    </section>

    {{-- اگر تخفیف عمومی (common discount) فعال است --}}
@elseif(!empty($commonDiscount))

    @php
        $discountAmount = $totalProductPrices * $commonDiscount->percentage / 100;
    @endphp

    <section class="d-flex justify-content-between align-items-center">
        <p class="text-muted">{{ $itemCountLabel }}</p>
        <p class="text-dark fw-bold">{{ priceFormat($finalProductPrices) }} تومان</p>
    </section>

    <section class="d-flex justify-content-between align-items-center">
        <p class="text-muted">درصد تخفیف سایت</p>
        <p class="text-danger fw-bolder">
            {{ convertEnglishToPersian($commonDiscount->percentage) }} %
        </p>
    </section>

    <section class="d-flex justify-content-between align-items-center">
        <p class="text-muted">حداکثر مبلغ تخفیف</p>
        <p class="text-muted">{{ priceFormat($commonDiscount->discount_ceiling) }} تومان</p>
    </section>

    <section class="border-bottom mb-3"></section>

    <section class="d-flex justify-content-between align-items-center">
        <p class="text-muted">جمع سبد خرید</p>
        <p class="fw-bolder">{{ priceFormat($totalProductPrices - $discountAmount) }} تومان</p>
    </section>

    {{-- اگر نه کوپن هست، نه تخفیف عمومی --}}
@else

    <section class="d-flex justify-content-between align-items-center">
        <p class="text-muted">{{ $itemCountLabel }}</p>
        <p class="text-dark fw-bold">{{ priceFormat($finalProductPrices) }} تومان</p>
    </section>

    @if($finalProductDiscounts != 0)
        <section class="d-flex justify-content-between align-items-center">
            <p class="text-muted">تخفیف کالاها</p>
            <p class="text-danger fw-bolder">{{ priceFormat($finalProductDiscounts) }} تومان</p>
        </section>
    @endif

    <section class="border-bottom mb-3"></section>

    <section class="d-flex justify-content-between align-items-center">
        <p class="text-muted">جمع سبد خرید</p>
        <p class="fw-bolder">{{ priceFormat($totalProductPrices) }} تومان</p>
    </section>

@endif
