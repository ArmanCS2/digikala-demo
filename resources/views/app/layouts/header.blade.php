<!-- start header -->
<header class="header mb-4">
    <!-- start top-header logo, searchbox and cart -->
    <section class="top-header">
        <section class="container-xxl ">
            <section class="d-md-flex justify-content-md-between align-items-md-center pb-3">
                <section class="d-flex justify-content-between align-items-center d-md-block">
                    <a class="text-decoration-none" href="{{route('home')}}"><img
                            src="{{asset($setting->logo)}}" alt="logo"></a>
                    <button class="btn btn-link text-dark d-md-none" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                        <i class="fa fa-bars me-1"></i>
                    </button>
                </section>
                <section class="mt-3 mt-md-auto search-wrapper mb-4">
                    <section class="search-box">
                        <section class="search-textbox">
                            <span class="pointer mx-2" onclick="document.getElementById('search-form').submit()"><i
                                    class="fa fa-search"></i></span>
                            <form id="search-form" action="{{route('market.products')}}" method="get">
                                <input id="search" type="text" size="500" name="search" placeholder="جستجو ..."
                                       value="{{!empty(request()->search) ? request()->search : '' }}"
                                       autocomplete="off">
                            </form>
                        </section>
                        {{--                        <section class="search-result visually-hidden">--}}
                        {{--                            <section class="search-result-title">برای دیدن نتایج کلید Enter را فشار دهید</section>--}}
                        {{--                            <section class="search-result-item"><a class="text-decoration-none" href="#"><i--}}
                        {{--                                        class="fa fa-link"></i> دسته موبایل و وسایل جانبی</a></section>--}}

                        {{--                            <section class="search-result-title">نتایج جستجو برای <span class="search-words">"موبایل شیا"</span><span--}}
                        {{--                                    class="search-result-type">در برندها</span></section>--}}
                        {{--                            <section class="search-result-item"><a class="text-decoration-none" href="#"><i--}}
                        {{--                                        class="fa fa-link"></i> برند شیائومی</a></section>--}}
                        {{--                            <section class="search-result-item"><a class="text-decoration-none" href="#"><i--}}
                        {{--                                        class="fa fa-link"></i> برند توشیبا</a></section>--}}
                        {{--                            <section class="search-result-item"><a class="text-decoration-none" href="#"><i--}}
                        {{--                                        class="fa fa-link"></i> برند شیانگ پینگ</a></section>--}}

                        {{--                            <section class="search-result-title">نتایج جستجو برای <span class="search-words">"موبایل شیا"</span><span--}}
                        {{--                                    class="search-result-type">در کالاها</span></section>--}}
                        {{--                            <section class="search-result-item"><span class="search-no-result">موردی یافت نشد</span>--}}
                        {{--                            </section>--}}
                        {{--                        </section>--}}
                    </section>
                </section>
                <section class="mt-3 mt-md-auto text-end mb-3">
                    @auth
                        <section class="d-inline px-md-3">
                            <button class="btn btn-link text-decoration-none text-dark dropdown-toggle profile-button"
                                    type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <i class="fa fa-user"></i>
                            </button>
                            <section class="dropdown-menu dropdown-menu-end custom-drop-down"
                                     aria-labelledby="dropdownMenuButton1">
                                <section><a class="dropdown-item" href="{{route('profile.index')}}"><i
                                            class="fa fa-user-circle"></i> پروفایل کاربری </a></section>
                                <section><a class="dropdown-item" href="{{route('profile.orders')}}"><i
                                            class="fa fa-newspaper"></i> سفارشات </a>
                                </section>
                                <section><a class="dropdown-item" href="{{route('profile.addresses')}}"><i
                                            class="fa fa-map"></i> آدرس ها </a>
                                </section>
                                <section><a class="dropdown-item" href="{{route('profile.favorites')}}"><i
                                            class="fa fa-heart"></i> لیست علاقه مندی </a></section>
                                <section><a class="dropdown-item" href="{{route('profile.compares')}}"><i
                                            class="fa fa-balance-scale"></i> لیست مقایسه </a></section>
                                <section><a class="dropdown-item" href="{{route('profile.ticket.index')}}"><i
                                            class="fa fa-ticket"></i> تیکت ها </a></section>
                                <section>
                                    <hr class="dropdown-divider">
                                </section>
                                <section><a class="dropdown-item" href="{{route('auth.customer.logout')}}"><i
                                            class="fa fa-sign-out-alt"></i> خروج </a>
                                </section>

                            </section>
                        </section>
                    @endauth

                    @guest
                        <a href="{{ route('auth.customer.login-register-form') }}"
                           class="btn btn-link text-decoration-none text-dark profile-button">
                            <i class="fa fa-user-lock"></i>
                        </a>
                    @endguest

                    <section class="header-cart d-inline ps-3 border-start position-relative">
                        <a class="btn btn-link position-relative text-dark header-cart-link"
                           href="{{route('market.cart')}}">
                            <i class="fa fa-shopping-cart"></i> <span style="top: 80%;"
                                                                      class="position-absolute start-0 translate-middle badge rounded-pill bg-danger">{{empty($cartItems) ? 0 : $cartItems->count()}}</span>
                        </a>
                        <section class="header-cart-dropdown">
                            <section class="border-bottom d-flex justify-content-between p-2">
                                <span class="text-muted">{{empty($cartItems) ? 0 : priceFormat($cartItems->count())}} کالا</span>

                                <a class="text-decoration-none text-info" href="{{route('market.cart')}}">مشاهده
                                    سبد
                                    خرید </a>
                            </section>
                            @auth
                                <section class="header-cart-dropdown-body">
                                    @php
                                        $totalProductPrices=0;
                                    @endphp
                                    @foreach($cartItems as $cartItem)
                                        <section
                                            class="header-cart-dropdown-body-item d-flex justify-content-start align-items-center">
                                            <a href="{{route('market.product',[$cartItem->product])}}"><img
                                                    class="flex-shrink-1"
                                                    src="{{asset($cartItem->product->image['indexArray'][$cartItem->product->image['currentImage']])}}"
                                                    alt="{{$cartItem->product->slug}}"></a>
                                            <section class="w-100 text-truncate"><a
                                                    class="text-decoration-none text-dark"
                                                    href="{{route('market.product',[$cartItem->product])}}">{{$cartItem->product->name}}</a>
                                            </section>
                                            <section class="flex-shrink-1"><a
                                                    class="text-muted text-decoration-none p-1"
                                                    href="{{route('market.cart.remove-product',[$cartItem])}}"><i
                                                        class="fa fa-trash-alt"></i></a>
                                            </section>
                                        </section>
                                    @endforeach
                                </section>
                                <section
                                    class="header-cart-dropdown-footer border-top d-flex justify-content-center align-items-center p-2">
                                    <section class=""><a class="btn btn-danger btn-sm d-block"
                                                         href="{{route('market.cart')}}">ثبت
                                            سفارش</a></section>
                                </section>
                            @endauth
                            @guest
                                <section
                                    class="header-cart-dropdown-body-item d-flex justify-content-start align-items-center">
                                    <section class="w-100 text-truncate"><p class="my-2 mx-3"> وارد حساب کاربری
                                            خود شوید
                                            <a
                                                class=" text-dark fw-bold mx-4"
                                                href="{{ route('auth.customer.login-register-form') }}">
                                                ورود </a></p>
                                    </section>
                                </section>
                            @endguest
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end top-header logo, searchbox and cart -->


    <!-- start menu -->
    <nav class="top-nav border-top">
        <section class="container-xxl ">
            <nav class="">
                <section class="d-none d-md-flex justify-content-md-start position-relative">

                    <section class="super-navbar-item me-4">
                        <section class="super-navbar-item-toggle">
                            <i class="fa fa-bars me-1"></i>
                            دسته بندی کالاها
                        </section>
                        <section class="sublist-wrapper position-absolute w-100">
                            <section class="position-relative sublist-area">
                                @foreach($productCategories as $category)
                                    <section class="sublist-item">
                                        <section class="sublist-item-toggle"><a
                                                class="text-decoration-none text-dark"
                                                href="{{route('market.products',['category'=>$category->id])}}">{{$category->name}}</a>
                                        </section>
                                        <section class="sublist-item-sublist">
                                            <section
                                                class="sublist-item-sublist-wrapper d-flex justify-content-around align-items-center">
                                                @foreach($category->children as $subCategory)
                                                    <section class="sublist-column col">
                                                        <a href="{{route('market.products',['category'=>$subCategory->id])}}"
                                                           class="sub-category">{{$subCategory->name}}</a>
                                                        @foreach($subCategory->children as $subSubCategory)
                                                            <a href="{{route('market.products',['category'=>$subSubCategory->id])}}"
                                                               class="sub-sub-category">{{$subSubCategory->name}}</a>
                                                        @endforeach
                                                    </section>
                                                @endforeach
                                            </section>
                                        </section>
                                    </section>
                                @endforeach
                            </section>
                        </section>
                    </section>
                    <section class="border-start my-2 mx-1"></section>
                    @foreach($menus as $menu)
                        <section class="navbar-item"><a href="{{url($menu->url)}}">{{$menu->name}}</a>
                        </section>
                        <section class="border-start my-2"></section>
                    @endforeach
                </section>


                <!--mobile view-->
                <section class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                         aria-labelledby="offcanvasExampleLabel" style="z-index: 9999999;">
                    <section class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel"><a class="text-decoration-none"
                                                                                  href="{{route('home')}}"><img
                                    src="{{asset($setting->logo)}}" alt="logo"></a></h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </section>
                    <section class="offcanvas-body">

                        @foreach($menus as $menu)
                            <section class="navbar-item"><a href="{{url($menu->url)}}">{{$menu->name}}</a>
                            </section>
                        @endforeach

                        <hr class="border-bottom">
                        <section class="navbar-item">
                            <span>دسته بندی ها</span>
                        </section>
                        <!-- start sidebar nav-->
                        <section class="sidebar-nav mt-2 px-3">
                            @foreach($productCategories as $category)
                                <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title"><a class="text-decoration-none text-dark"
                                                                        href="{{route('market.products',['category'=>$category->id])}}">{{$category->name}}</a><i
                                        class="fa fa-angle-left"></i></span>
                                    <section class="sidebar-nav-sub-wrapper">
                                        @foreach($category->children as $subCategory)
                                            <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a
                                                href="{{route('market.products',['category'=>$subCategory->id])}}">{{$subCategory->name}}</a><i
                                                class="fa fa-angle-left"></i></span>
                                                <section class="sidebar-nav-sub-sub-wrapper">
                                                    @foreach($subCategory->children as $subSubCategory)
                                                        <section class="sidebar-nav-sub-sub-item"><a
                                                                href="{{route('market.products',['category'=>$subSubCategory->id])}}">{{$subSubCategory->name}}</a>
                                                        </section>
                                                    @endforeach
                                                </section>
                                            </section>
                                        @endforeach
                                    </section>
                                </section>
                            @endforeach

                        </section>
                        <!--end sidebar nav-->


                    </section>
                </section>

            </nav>
        </section>
    </nav>
    <!-- end menu -->


</header>
<!-- end header -->
