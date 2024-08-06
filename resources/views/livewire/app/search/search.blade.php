<section class="mt-3 mt-md-auto search-wrapper mb-4">
    <section class="search-box">
        <section class="search-textbox">
                            <span class="pointer mx-2" onclick="document.getElementById('search-form').submit()"><i
                                    class="fa fa-search"></i></span>
            <form id="search-form" action="{{route('market.products')}}" method="get">
                <input wire:model="search" id="search" type="text" size="500" name="search" placeholder="جستجو ..."
                       value="{{!empty(request()->search) ? request()->search : '' }}"
                       autocomplete="off">
            </form>
        </section>
        @if(!empty($search))
        <section class="result bg-white">
            {{--                                    <section class="search-result-title">برای دیدن نتایج کلید Enter را فشار دهید</section>--}}
            {{--                                    <section class="search-result-item"><a class="text-decoration-none" href="#"><i--}}
            {{--                                                class="fa fa-link"></i> دسته موبایل و وسایل جانبی</a></section>--}}

            <section class="search-result-title">نتایج جستجو برای <span class="search-words">"{{$search}}"</span></section>
            @forelse($products as $product)
            <section class="search-result-item"><a class="text-decoration-none text-info" href="{{route('market.product',$product)}}"><i
                        class="fa fa-link"></i>{{$product->name}}</a></section>
            @empty
            <section class="search-result-item"><span class="search-no-result">موردی یافت نشد</span>
                @endforelse
            </section>
        </section>
        @endif
    </section>
</section>
