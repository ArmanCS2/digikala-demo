<section class="sidebar-nav-sub-wrapper px-2 py-1">

    @foreach($categories as $category)

        <section class="sidebar-nav-sub-item">

            <span class="sidebar-nav-sub-item-title">

                <a href="{{ request()->fullUrlWithQuery(['category' => $category->id]) }}"
                   class="d-inline">
                    {{ $category->name }}
                </a>

                @if($category->children->count() > 0)
                    <i class="fa fa-angle-left"></i>
                @endif

            </span>

            @include('app.layouts.sub-categories', [
                'categories' => $category->children
            ])

        </section>

    @endforeach

</section>
