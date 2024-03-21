<!-- start sidebar nav-->
<section class="sidebar-nav">
    @foreach($categories as $category)
        <section class="sidebar-nav-item">
        <span class="sidebar-nav-item-title"><a
                href="{{route('market.products',['search'=>request()->search,'sort'=>request()->sort,'min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands,'category'=>$category->id])}}"
                class="d-inline">{{$category->name}}</a>
            @if($category->children->count() > 0)
                <i class="fa fa-angle-left"></i>
            @endif
        </span>
            @include('app.layouts.sub-categories',['categories'=>$category->children])
        </section>
    @endforeach


</section>
<!--end sidebar nav-->
