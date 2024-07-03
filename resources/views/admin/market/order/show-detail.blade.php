@extends('admin.layouts.master')

@section('head-tag')
    <title>جزئیات سفارش</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> جزئیات سفارش</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        جزئیات سفارش
                    </h5>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150px">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام محصول</th>
                            <th>تصویر</th>
                            <th>سایز</th>
                            <th>رنگ</th>
                            <th>گارانتی</th>
                            <th>درصد فروش شگفت انگیز</th>
                            <th>مبلغ فروش شگفت انگیز</th>
                            <th>تعداد</th>
                            <th>جمع قیمت محصول</th>
                            <th>مبلغ نهایی</th>
                            <th>ویژگی</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>
                                    <a href="{{route('market.product',$item->product()->first())}}">{{ $item->product->name ?? '-' }}</a>
                                </td>
                                <td><a href="{{route('market.product',$item->product()->first())}}"><img
                                            src="{{asset($item->product->image->indexArray->medium)}}"
                                            width="100px"></a></td>
                                <td>{{ $item->size->name ?? '-' }}</td>
                                <td>{{ $item->color->color_name ?? '-' }}</td>
                                <td>{{ $item->guarantee->name ?? '-' }}</td>
                                <td>{{ $item->amazingSale->percentage ?? '-' }} %</td>
                                <td>{{ number_format($item->amazing_sale_discount_amount) ?? '-' }} تومان</td>
                                <td>{{ $item->number }} </td>
                                <td>{{ number_format($item->final_product_price) ?? '-' }} تومان</td>
                                <td>{{ number_format($item->final_total_price) ?? '-'}} تومان</td>
                                <td>
                                    @forelse($item->orderItemAttributes as $attribute)
                                        {{ $attribute->categoryAttribute->name ?? '-' }}
                                        :
                                        {{ $attribute->categoryAttributeValue->value?? '-'}}
                                        <br>
                                    @empty
                                        <br>
                                        -
                                    @endforelse
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @include('admin.layouts.pagination',['data'=>$items])
                </section>


            </section>
        </section>
    </section>

@endsection
