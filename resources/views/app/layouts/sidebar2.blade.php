<aside id="sidebar" class="sidebar col-md-3">

    <form action="{{ route('market.products') }}" method="get">

        {{-- Hidden filters --}}
        <input type="hidden" name="sort" value="{{ request()->sort }}">
        <input type="hidden" name="category" value="{{ request()->category }}">

        {{-- Categories --}}
        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
            @include('app.layouts.categories', ['categories' => $categories])
        </section>


        {{-- Search In Results --}}
        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">

            <header class="content-header mb-3 d-flex justify-content-between align-items-center">
                <h2 class="content-header-title content-header-title-small">جستجو در نتایج</h2>
            </header>

            <input class="sidebar-input-text"
                   type="text"
                   name="search"
                   value="{{ request()->search }}"
                   placeholder="جستجو بر اساس نام، برند ...">

        </section>


        {{-- Brands --}}
        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">

            <header class="content-header mb-3 d-flex justify-content-between align-items-center">
                <h2 class="content-header-title content-header-title-small">برند</h2>
            </header>

            <section class="sidebar-brand-wrapper">

                @foreach($brands as $brand)
                    <section class="form-check sidebar-brand-item">
                        <input class="form-check-input"
                               type="checkbox"
                               name="brands[]"
                               id="brand-{{ $brand->id }}"
                               value="{{ $brand->id }}"
                            {{ in_array($brand->id, request()->brands ?? []) ? 'checked' : '' }}
                        >
                        <label class="form-check-label d-flex justify-content-between"
                               for="brand-{{ $brand->id }}">
                            <span>{{ $brand->persian_name }}</span>
                            <span>{{ $brand->original_name }}</span>
                        </label>
                    </section>
                @endforeach

                @if($brands->isEmpty())
                    <section class="sidebar-brand-item text-muted">فاقد برند</section>
                @endif

            </section>

        </section>


        {{-- Price Range --}}
        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">

            <header class="content-header mb-3 d-flex justify-content-between align-items-center">
                <h2 class="content-header-title content-header-title-small">محدوده قیمت</h2>
            </header>

            <section class="sidebar-price-range d-flex justify-content-between">
                <section class="p-1">
                    <input type="text"
                           name="min_price"
                           placeholder="قیمت از ..."
                           value="{{ request()->min_price }}">
                </section>

                <section class="p-1">
                    <input type="text"
                           name="max_price"
                           placeholder="قیمت تا ..."
                           value="{{ request()->max_price }}">
                </section>
            </section>

        </section>


        {{-- Submit + Reset --}}
        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">

            <section class="sidebar-filter-btn d-grid gap-2">
                <button class="btn btn-danger" type="submit">اعمال فیلتر</button>
            </section>

            <section class="sidebar-filter-btn d-grid gap-2 my-1">
                <a class="btn btn-primary" href="{{ route('market.products') }}">
                    حذف فیلتر ها
                </a>
            </section>

        </section>

    </form>

</aside>
