@extends('app.layouts.master-one-col')

@section('head-tag')
    <title>مدیریت آدرس ها و نحوه ارسال</title>
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
                                <span>تکمیل اطلاعات ارسال کالا (آدرس گیرنده، مشخصات گیرنده، نحوه ارسال) </span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">
                        <section class="col-md-9">
                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            انتخاب آدرس و مشخصات گیرنده
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>

                                <section class="address-alert alert alert-primary d-flex align-items-center p-2"
                                         role="alert">
                                    <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                    <secrion>
                                        پس از ایجاد آدرس، آدرس را انتخاب کنید.
                                    </secrion>
                                </section>


                                <section class="address-select">
                                    @error('address_id')
                                    <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                    @enderror
                                    @forelse($addresses as $address)
                                        <input type="radio" form="store-address-delivery" name="address_id"
                                               value="{{$address->id}}" id="a-{{$address->id}}"/>
                                        <!--checked="checked"-->
                                        <label for="a-{{$address->id}}" class="address-wrapper mb-2 p-2">
                                            <section class="mb-2">
                                                <i class="fa fa-city mx-1"></i>
                                                استان : {{$address->province->title ?? '-'}}
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-house-user mx-1"></i>
                                                شهر : {{$address->city->title ?? '-'}}
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-map-marker-alt mx-1"></i>
                                                آدرس : {{$address->address ?? '-'}}،
                                                ، پلاک {{convertEnglishToPersian($address->no ?? '-')}}،
                                                واحد {{convertEnglishToPersian($address->unit ?? '-')}}
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-box mx-1"></i>
                                                کدپستی
                                                : {{$address->postal_code ?? ' '}}
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-user-tag mx-1"></i>
                                                گیرنده
                                                : {{($address->recipient_first_name ?? ' ') . ' ' . ($address->recipient_last_name ?? ' ')}}
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-mobile-alt mx-1"></i>
                                                موبایل گیرنده : {{$address->mobile ?? '-'}}
                                            </section>
                                            <a class="" data-bs-toggle="modal"
                                               data-bs-target="#edit-address-{{$address->id}}"><i
                                                    class="fa fa-edit"></i> ویرایش آدرس</a>
                                            <a class="mt-4" href="{{route('market.delete-address',$address)}}"><i
                                                    class="fa fa-trash"></i> حذف آدرس</a>
                                            <span class="address-selected">کالاها به این آدرس ارسال می شوند</span>
                                        </label>
                                        <section class="address-add-wrapper">
                                            <!-- start add address Modal -->
                                            <section class="modal fade" id="edit-address-{{$address->id}}" tabindex="-1"
                                                     aria-labelledby="add-address-label" aria-hidden="true">
                                                <section class="modal-dialog">
                                                    <section class="modal-content">
                                                        <section class="modal-header">
                                                            <h5 class="modal-title" id="add-address-label"><i
                                                                    class="fa fa-plus"></i> ویرایش آدرس</h5>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </section>
                                                        <section class="modal-body">
                                                            <form id="edit-address-form-{{$address->id}}" class="row"
                                                                  method="post"
                                                                  action="{{route('market.edit-address',[$address->id])}}">
                                                                @csrf
                                                                @method('put')
                                                                <section class="col-6 mb-2">
                                                                    <label for="province"
                                                                           class="form-label mb-1">استان</label>
                                                                    <select name="province_id"
                                                                            class="form-select form-select-sm"
                                                                            id="province-{{$address->id}}">
                                                                        <option value="" selected>استان را ویرایش کنید
                                                                        </option>
                                                                        @foreach($provinces as $province)
                                                                            <option value="{{$province->id}}"
                                                                                    data-url="{{route('market.get-cities',[$province->id])}}">{{$province->title}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('province_id')
                                                                    <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                                                    @enderror
                                                                </section>

                                                                <section class="col-6 mb-2">
                                                                    <label for="city"
                                                                           class="form-label mb-1">شهر</label>
                                                                    <select name="city_id"
                                                                            class="form-select form-select-sm"
                                                                            id="city-{{$address->id}}">
                                                                        <option value="" selected>شهر را ویرایش کنید
                                                                        </option>
                                                                    </select>
                                                                    @error('city_id')
                                                                    <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                                                    @enderror
                                                                </section>
                                                                <section class="col-12 mb-2">
                                                                    <label for="address"
                                                                           class="form-label mb-1">نشانی</label>
                                                                    <textarea name="address"
                                                                              class="form-control form-control-sm"
                                                                              id="address"
                                                                              placeholder="نشانی">{{$address->address}}</textarea>
                                                                    @error('address')
                                                                    <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                                                    @enderror
                                                                </section>

                                                                <section class="col-6 mb-2">
                                                                    <label for="postal_code" class="form-label mb-1">کد
                                                                        پستی</label>
                                                                    <input name="postal_code" type="text"
                                                                           class="form-control form-control-sm"
                                                                           id="postal_code" placeholder="کد پستی"
                                                                           value="{{$address->postal_code}}">
                                                                    @error('postal_code')
                                                                    <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                                                    @enderror
                                                                </section>

                                                                <section class="col-3 mb-2">
                                                                    <label for="no" class="form-label mb-1">پلاک</label>
                                                                    <input name="no" type="text"
                                                                           class="form-control form-control-sm"
                                                                           id="no" placeholder="پلاک"
                                                                           value="{{$address->no}}">
                                                                    @error('no')
                                                                    <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                                                    @enderror
                                                                </section>

                                                                <section class="col-3 mb-2">
                                                                    <label for="unit"
                                                                           class="form-label mb-1">واحد</label>
                                                                    <input name="unit" type="text"
                                                                           class="form-control form-control-sm"
                                                                           id="unit" placeholder="واحد"
                                                                           value="{{$address->unit}}">
                                                                    @error('unit')
                                                                    <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                                                    @enderror
                                                                </section>

                                                                <section class="border-bottom mt-2 mb-3"></section>

                                                                <section class="col-12 mb-2">
                                                                    <section class="form-check">
                                                                        <input
                                                                            @if(auth()->user()->mobile != $address->mobile) checked
                                                                            @endif name="receiver"
                                                                            class="form-check-input"
                                                                            type="checkbox"
                                                                            id="receiver">
                                                                        <label class="form-check-label" for="receiver">
                                                                            گیرنده سفارش خودم نیستم (مشخصات گیرنده را
                                                                            وارد
                                                                            کنید)
                                                                        </label>
                                                                    </section>
                                                                </section>

                                                                <section class="col-6 mb-2">
                                                                    <label for="first_name" class="form-label mb-1">نام
                                                                        گیرنده</label>
                                                                    <input name="recipient_first_name" type="text"
                                                                           class="form-control form-control-sm"
                                                                           id="first_name" placeholder="نام گیرنده"
                                                                           value="{{$address->recipient_first_name}}">
                                                                    @error('recipient_first_name')
                                                                    <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                                                    @enderror
                                                                </section>

                                                                <section class="col-6 mb-2">
                                                                    <label for="last_name" class="form-label mb-1">نام
                                                                        خانوادگی گیرنده</label>
                                                                    <input name="recipient_last_name" type="text"
                                                                           class="form-control form-control-sm"
                                                                           id="last_name"
                                                                           placeholder="نام خانوادگی گیرنده"
                                                                           value="{{$address->recipient_last_name}}">
                                                                    @error('recipient_last_name')
                                                                    <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                                                    @enderror
                                                                </section>

                                                                <section class="col-6 mb-2">
                                                                    <label for="mobile" class="form-label mb-1">شماره
                                                                        موبایل</label>
                                                                    <input name="mobile" type="text"
                                                                           class="form-control form-control-sm"
                                                                           id="mobile" placeholder="شماره موبایل"
                                                                           value="{{$address->mobile}}">
                                                                    @error('mobile')
                                                                    <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                                                    @enderror
                                                                </section>


                                                            </form>
                                                        </section>
                                                        <section class="modal-footer py-1">
                                                            <button
                                                                onclick="document.getElementById('edit-address-form-{{$address->id}}').submit();"
                                                                class="btn btn-sm btn-primary">ویرایش آدرس
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                    data-bs-dismiss="modal">بستن
                                                            </button>
                                                        </section>
                                                    </section>
                                                </section>
                                            </section>
                                            <!-- end add address Modal -->
                                        </section>
                                    @empty
                                        <section class="my-address-wrapper mb-2 p-2">
                                            <p>آدرسی وجود ندارد</p>
                                        </section>
                                    @endforelse


                                    <section class="address-add-wrapper">
                                        <button class="address-add-button" type="button" data-bs-toggle="modal"
                                                data-bs-target="#add-address"><i class="fa fa-plus"></i> ایجاد آدرس جدید
                                        </button>
                                        <!-- start add address Modal -->
                                        <section class="modal fade" id="add-address" tabindex="-1"
                                                 aria-labelledby="add-address-label" aria-hidden="true">
                                            <section class="modal-dialog">
                                                <section class="modal-content">
                                                    <section class="modal-header">
                                                        <h5 class="modal-title" id="add-address-label"><i
                                                                class="fa fa-plus"></i> ایجاد آدرس جدید</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </section>
                                                    <section class="modal-body">
                                                        <form id="add-address-form" class="row" method="post"
                                                              action="{{route('market.add-address')}}">
                                                            @csrf
                                                            <section class="col-6 mb-2">
                                                                <label for="province"
                                                                       class="form-label mb-1">استان</label>
                                                                <select name="province_id"
                                                                        class="form-select form-select-sm"
                                                                        id="province">
                                                                    <option selected>استان را انتخاب کنید</option>
                                                                    @foreach($provinces as $province)
                                                                        <option value="{{$province->id}}"
                                                                                data-url="{{route('market.get-cities',[$province->id])}}">{{$province->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('province_id')
                                                                <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                                                @enderror
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="city" class="form-label mb-1">شهر</label>
                                                                <select name="city_id"
                                                                        class="form-select form-select-sm" id="city">
                                                                    <option selected>شهر را انتخاب کنید</option>
                                                                </select>
                                                                @error('city_id')
                                                                <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                                                @enderror
                                                            </section>
                                                            <section class="col-12 mb-2">
                                                                <label for="address"
                                                                       class="form-label mb-1">نشانی</label>
                                                                <textarea name="address"
                                                                          class="form-control form-control-sm"
                                                                          id="address"
                                                                          placeholder="نشانی">{{old('address')}}</textarea>
                                                                @error('address')
                                                                <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                                                @enderror
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="postal_code" class="form-label mb-1">کد
                                                                    پستی</label>
                                                                <input name="postal_code" type="text"
                                                                       class="form-control form-control-sm"
                                                                       id="postal_code" placeholder="کد پستی"
                                                                       value="{{old('postal_code')}}">
                                                                @error('postal_code')
                                                                <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                                                @enderror
                                                            </section>

                                                            <section class="col-3 mb-2">
                                                                <label for="no" class="form-label mb-1">پلاک</label>
                                                                <input name="no" type="text"
                                                                       class="form-control form-control-sm"
                                                                       id="no" placeholder="پلاک" value="{{old('no')}}">
                                                                @error('no')
                                                                <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                                                @enderror
                                                            </section>

                                                            <section class="col-3 mb-2">
                                                                <label for="unit" class="form-label mb-1">واحد</label>
                                                                <input name="unit" type="text"
                                                                       class="form-control form-control-sm"
                                                                       id="unit" placeholder="واحد"
                                                                       value="{{old('unit')}}">
                                                                @error('unit')
                                                                <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                                                @enderror
                                                            </section>

                                                            <section class="border-bottom mt-2 mb-3"></section>

                                                            <section class="col-12 mb-2">
                                                                <section class="form-check">
                                                                    <input name="receiver" class="form-check-input"
                                                                           type="checkbox"
                                                                           id="receiver">
                                                                    <label class="form-check-label" for="receiver">
                                                                        گیرنده سفارش خودم نیستم (مشخصات گیرنده را وارد
                                                                        کنید)
                                                                    </label>
                                                                </section>
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="first_name" class="form-label mb-1">نام
                                                                    گیرنده</label>
                                                                <input name="recipient_first_name" type="text"
                                                                       class="form-control form-control-sm"
                                                                       id="first_name" placeholder="نام گیرنده"
                                                                       value="{{old('recipient_first_name')}}">
                                                                @error('recipient_first_name')
                                                                <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                                                @enderror
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="last_name" class="form-label mb-1">نام
                                                                    خانوادگی گیرنده</label>
                                                                <input name="recipient_last_name" type="text"
                                                                       class="form-control form-control-sm"
                                                                       id="last_name" placeholder="نام خانوادگی گیرنده"
                                                                       value="{{old('recipient_last_name')}}">
                                                                @error('recipient_last_name')
                                                                <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                                                @enderror
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="mobile" class="form-label mb-1">شماره
                                                                    موبایل</label>
                                                                <input name="mobile" type="text"
                                                                       class="form-control form-control-sm"
                                                                       id="mobile" placeholder="شماره موبایل"
                                                                       value="{{old('mobile')}}">
                                                                @error('mobile')
                                                                <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                                                @enderror
                                                            </section>


                                                        </form>
                                                    </section>
                                                    <section class="modal-footer py-1">
                                                        <button
                                                            onclick="document.getElementById('add-address-form').submit();"
                                                            class="btn btn-sm btn-primary">ثبت آدرس
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                                data-bs-dismiss="modal">بستن
                                                        </button>
                                                    </section>
                                                </section>
                                            </section>
                                        </section>
                                        <!-- end add address Modal -->
                                    </section>

                                </section>
                            </section>


                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            انتخاب نحوه ارسال
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="delivery-select ">
                                    @error('delivery_id')
                                    <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                    @enderror

                                    <section class="address-alert alert alert-primary d-flex align-items-center p-2"
                                             role="alert">
                                        <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                        <secrion>
                                            نحوه ارسال کالا را انتخاب کنید. هنگام انتخاب لطفا مدت زمان ارسال را در نظر
                                            بگیرید.
                                        </secrion>
                                    </section>
                                    @foreach($deliveries as $delivery)
                                        <input type="radio" form="store-address-delivery" name="delivery_id"
                                               value="{{$delivery->id}}" id="d-{{$delivery->id}}"/>
                                        <label for="d-{{$delivery->id}}"
                                               class="col-12 col-md-4 delivery-wrapper mb-2 pt-2">
                                            <section class="mb-2">
                                                <i class="fa fa-shipping-fast mx-1"></i>
                                                {{$delivery->name}}
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-calendar-alt mx-1"></i>
                                                مدت زمان ارسال
                                                : {{convertEnglishToPersian($delivery->delivery_time)}} {{$delivery->delivery_time_unit}}
                                                کاری
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-money-bill-alt mx-1"></i>
                                                هزینه ارسال : {{priceFormat($delivery->amount)}} تومان
                                            </section>
                                        </label>
                                    @endforeach


                                </section>
                            </section>


                        </section>
                        <section class="col-md-3">
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                @php
                                    $finalProductPrices = 0;
                                    $finalProductDiscounts = 0;
                                    $totalProductPrices = 0;
                                @endphp

                                @foreach($cartItems as $cartItem)
                                    @php
                                        $finalProductPrices += $cartItem->finalProductPrice();
                                        $finalProductDiscounts += $cartItem->finalProductDiscount();
                                        $totalProductPrices += $cartItem->totalProductPrice();
                                    @endphp
                                @endforeach

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">قیمت کالاها ({{ priceFormat($cartItems->count()) }})</p>
                                    <p class="text-muted"><span
                                            id="final-product-prices">{{ priceFormat($finalProductPrices) }}</span>
                                        تومان
                                    </p>
                                </section>

                                @if($finalProductDiscounts != 0)
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">تخفیف کالاها</p>
                                        <p class="text-danger fw-bolder"><span
                                                id="final-product-discounts">{{ priceFormat($finalProductDiscounts) }}</span>
                                            تومان</p>
                                    </section>
                                @endif
                                <section class="border-bottom mb-3"></section>
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">جمع سبد خرید</p>
                                    <p class="fw-bolder"><span
                                            id="total-product-prices">{{ priceFormat($totalProductPrices) }}</span>
                                        تومان</p>
                                </section>


                                <p class="my-3">
                                    <i class="fa fa-info-circle me-1"></i> کاربر گرامی کالاها بر اساس نوع ارسالی که
                                    انتخاب می کنید در مدت زمان ذکر شده ارسال می شود و هزینه ارسال برای شما در نظر گرفته
                                    میشود.
                                </p>

                                <form action="{{route('market.store-address-delivery')}}" method="post"
                                      id="store-address-delivery">
                                    @csrf
                                    <section class="">
                                        <button type="submit"
                                                class="btn btn-danger d-block w-100">تکمیل فرآیند خرید
                                        </button>
                                    </section>
                                </form>

                            </section>
                        </section>
                    </section>
                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#province').change(function () {
                var element = $('#province option:selected');
                var url = element.attr('data-url');

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        if (response.status) {
                            let cities = response.cities;
                            $('#city').empty();
                            cities.map((city) => {
                                $('#city').append($('<option/>').val(city.id).text(city.title));
                            });

                        }
                    },
                    error: function (response) {
                        console.log(response);
                    }
                });
            });


            //edit-address
            var addresses = {!! auth()->user()->addresses !!};
            addresses.map(function (address) {
                var id = address.id;
                var target = '#province-' + id;
                var selected = target + ' option:selected';
                $(target).change(function () {
                    var element = $(selected);
                    var url = element.attr('data-url');

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function (response) {
                            if (response.status) {
                                let cities = response.cities;
                                $('#city-' + id).empty();
                                cities.map((city) => {
                                    $('#city-' + id).append($('<option/>').val(city.id).text(city.title));
                                });

                            }
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });
                });
            });


        })
    </script>


@endsection



