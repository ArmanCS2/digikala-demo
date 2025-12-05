<!-- start sidebar nav -->
<nav class="sidebar-nav">

    @foreach($categories as $category)
        <section class="sidebar-nav-item">

            <span class="sidebar-nav-item-title">

                <a href="{{ request()->fullUrlWithQuery(['category' => $category->id]) }}"
                   class="d-inline">
                    {{ $category->name }}
                </a>

                @if($category->children->count() > 0)
                    <i class="fa fa-angle-left"></i>
                @endif

            </span>

            {{-- Recursive children --}}
            @include('app.layouts.sub-categories', [
                'categories' => $category->children
            ])

        </section>
    @endforeach

</nav>
<!-- end sidebar nav -->
