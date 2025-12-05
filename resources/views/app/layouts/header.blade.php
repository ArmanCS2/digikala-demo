<!-- start header -->
<header class="header mb-4">

    <!-- start top-header logo, searchbox and cart -->
    <section class="top-header">
        <section class="container-xxl">

            <section class="d-md-flex justify-content-md-between align-items-md-center pb-3">

                <!-- Logo + Mobile Menu Button -->
                <section class="d-flex justify-content-between align-items-center d-md-block">

                    <a class="text-decoration-none" href="{{ route('home') }}">
                        <img src="{{ asset($setting->logo) }}"
                             alt="لوگوی {{ $setting->title }}"
                             fetchpriority="high">
                    </a>

                    <!-- Mobile Menu Button -->
                    <button class="btn btn-link text-dark d-md-none"
                            type="button"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasExample"
                            aria-controls="offcanvasExample"
                            aria-label="باز کردن منو">
                        <i class="fa fa-bars me-1"></i>
                    </button>

                </section>

                <!-- Search -->
                @livewire('app.search.search')

                <!-- Profile + Cart -->
                <section class="mt-3 mt-md-auto text-end mb-3">

                    {{-- Profile --}}
                    @auth
                        <section class="d-inline px-md-3">

                            <button class="btn btn-link text-decoration-none text-dark dropdown-toggle profile-button"
                                    type="button"
                                    id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    aria-label="پروفایل کاربری">
                                <i class="fa fa-user"></i>
                            </button>

                            <section class="dropdown-menu dropdown-menu-end custom-drop-down"
                                     aria-labelledby="dropdownMenuButton1">

                                <section><a class="dropdown-item" href="{{ route('profile.index') }}"><i
                                            class="fa fa-user-circle"></i> پروفایل کاربری </a></section>

                                <section><a class="dropdown-item" href="{{ route('profile.orders') }}"><i
                                            class="fa fa-newspaper"></i> سفارشات </a></section>

                                <section><a class="dropdown-item" href="{{ route('profile.addresses') }}"><i
                                            class="fa fa-map"></i> آدرس‌ها </a></section>

                                <section><a class="dropdown-item" href="{{ route('profile.favorites') }}"><i
                                            class="fa fa-heart"></i> علاقه‌مندی‌ها </a></section>

                                <section><a class="dropdown-item" href="{{ route('profile.compares') }}"><i
                                            class="fa fa-balance-scale"></i> مقایسه </a></section>

                                <section><a class="dropdown-item" href="{{ route('profile.ticket.index') }}"><i
                                            class="fa fa-ticket"></i> تیکت‌ها </a></section>

                                <hr class="dropdown-divider">

                                <section>
                                    <a class="dropdown-item" href="{{ route('auth.logout') }}">
                                        <i class="fa fa-sign-out-alt"></i> خروج
                                    </a>
                                </section>

                            </section>
                        </section>
                    @endauth

                    @guest
                        <a href="{{ route('auth.customer.login-register-form') }}"
                           class="btn btn-link text-decoration-none text-dark profile-button"
                           aria-label="ورود به حساب">
                            <i class="fa fa-user-lock"></i>
                        </a>
                    @endguest

                    {{-- Cart --}}
                    <section class="header-cart d-inline ps-3 border-start position-relative">

                        <a class="btn btn-link position-relative text-dark header-cart-link"
                           href="{{ route('market.cart') }}"
                           aria-label="سبد خرید">

                            <i class="fa fa-shopping-cart"></i>

                            <span class="position-absolute start-0 translate-middle badge rounded-pill bg-danger"
                                  style="top: 80%;">
                                {{ $cartItems ? $cartItems->count() : 0 }}
                            </span>

                        </a>

                        <!-- Cart Dropdown -->
                        <section class="header-cart-dropdown">

                            <section class="border-bottom d-flex justify-content-between p-2">
                                <span class="text-muted">
                                    {{ $cartItems ? priceFormat($cartItems->count()) : 0 }} کالا
                                </span>

                                <a class="text-decoration-none text-info" href="{{ route('market.cart') }}">
                                    مشاهده سبد خرید
                                </a>
                            </section>

                            @auth
                                <section class="header-cart-dropdown-body">

                                    @foreach($cartItems as $cartItem)
                                        <section class="header-cart-dropdown-body-item d-flex justify-content-start align-items-center">

                                            <a href="{{ route('market.product', [$cartItem->product]) }}">
                                                <img class="flex-shrink-1"
                                                     src="{{ asset($cartItem->product->image['indexArray'][$cartItem->product->image['currentImage']]) }}"
                                                     alt="تصویر {{ $cartItem->product->name }}"
                                                     loading="lazy">
                                            </a>

                                            <section class="w-100 text-truncate">
                                                <a class="text-decoration-none text-dark"
                                                   href="{{ route('market.product', [$cartItem->product]) }}">
                                                    {{ $cartItem->product->name }}
                                                </a>
                                            </section>

                                            <section class="flex-shrink-1">
                                                <a class="text-muted text-decoration-none p-1"
                                                   href="{{ route('market.cart.remove-product', [$cartItem]) }}"
                                                   aria-label="حذف از سبد خرید">
                                                    <i class="fa fa-trash-alt"></i>
                                                </a>
                                            </section>

                                        </section>
                                    @endforeach

                                </section>

                                <section class="header-cart-dropdown-footer border-top d-flex justify-content-center align-items-center p-2">
                                    <a class="btn btn-danger btn-sm d-block" href="{{ route('market.cart') }}">
                                        ثبت سفارش
                                    </a>
                                </section>
                            @endauth

                            @guest
                                <section class="header-cart-dropdown-body-item d-flex justify-content-start align-items-center">
                                    <p class="my-2 mx-3">
                                        وارد حساب کاربری شوید
                                        <a class="text-dark fw-bold mx-4"
                                           href="{{ route('auth.customer.login-register-form') }}">
                                            ورود
                                        </a>
                                    </p>
                                </section>
                            @endguest

                        </section>
                    </section>

                </section>

            </section>
        </section>
    </section>
    <!-- end top-header -->



    <!-- ========================= -->
    <!--        MAIN NAVBAR       -->
    <!-- ========================= -->
    <nav class="top-nav border-top">
        <section class="container-xxl">
            <nav>

                <!-- Desktop Menu -->
                <section class="d-none d-md-flex justify-content-md-start position-relative">

                    <!-- Categories MegaMenu -->
                    <section class="super-navbar-item me-4">

                        <section class="super-navbar-item-toggle">
                            <i class="fa fa-bars me-1"></i>
                            دسته بندی کالاها
                        </section>

                        <section class="sublist-wrapper position-absolute w-100">

                            <section class="position-relative sublist-area">

                                @foreach($productCategories as $category)

                                    <section class="sublist-item">

                                        <section class="sublist-item-toggle">
                                            <a class="text-decoration-none text-dark"
                                               href="{{ route('market.products', ['category' => $category->id]) }}"
                                               title="مشاهده {{ $category->name }}">
                                                {{ $category->name }}
                                            </a>
                                        </section>

                                        <!-- Subcategories -->
                                        <section class="sublist-item-sublist">

                                            <section class="sublist-item-sublist-wrapper d-flex justify-content-around align-items-center">

                                                @foreach($category->children as $subCategory)

                                                    <section class="sublist-column col">

                                                        <a href="{{ route('market.products',['category'=>$subCategory->id]) }}"
                                                           class="sub-category"
                                                           title="مشاهده {{ $subCategory->name }}">
                                                            {{ $subCategory->name }}
                                                        </a>

                                                        @foreach($subCategory->children as $subSubCategory)
                                                            <a href="{{ route('market.products',['category'=>$subSubCategory->id]) }}"
                                                               class="sub-sub-category"
                                                               title="مشاهده {{ $subSubCategory->name }}">
                                                                {{ $subSubCategory->name }}
                                                            </a>
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

                    <!-- Static Menus -->
                    @foreach($menus as $menu)
                        <section class="navbar-item">
                            <a href="{{ url($menu->url) }}"
                               title="{{ $menu->name }}">
                                {{ $menu->name }}
                            </a>
                        </section>
                        <section class="border-start my-2"></section>
                @endforeach


                <!-- Social Icons -->
                    <section class="d-flex align-items-center">
                        @if($setting->instagram)
                            <section class="navbar-item">
                                <a href="{{ $setting->instagram }}" class="text-muted text-decoration-none"
                                   target="_blank" rel="noopener">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </section>
                        @endif
                        @if($setting->telegram)
                            <section class="navbar-item">
                                <a href="{{ $setting->telegram }}" class="text-muted text-decoration-none"
                                   target="_blank" rel="noopener">
                                    <i class="fab fa-telegram"></i>
                                </a>
                            </section>
                        @endif
                        @if($setting->link_1)
                            <section class="navbar-item">
                                <a href="{{ $setting->link_1 }}" class="text-muted text-decoration-none"
                                   target="_blank" rel="noopener">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </section>
                        @endif
                        @if($setting->link_2)
                            <section class="navbar-item">
                                <a href="{{ $setting->link_2 }}" class="text-muted text-decoration-none"
                                   target="_blank" rel="noopener">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </section>
                        @endif
                        @if($setting->link_3)
                            <section class="navbar-item">
                                <a href="{{ $setting->link_3 }}" class="text-muted text-decoration-none"
                                   target="_blank" rel="noopener">
                                    <i class="fab fa-youtube-square"></i>
                                </a>
                            </section>
                        @endif
                        @if($setting->link_4)
                            <section class="navbar-item">
                                <a href="{{ $setting->link_4 }}" class="text-muted text-decoration-none"
                                   target="_blank" rel="noopener">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            </section>
                        @endif
                    </section>

                </section>


                <!-- ========================= -->
                <!--      MOBILE OFFCANVAS     -->
                <!-- ========================= -->
                <section class="offcanvas offcanvas-start"
                         tabindex="-1"
                         id="offcanvasExample"
                         aria-labelledby="offcanvasExampleLabel"
                         style="z-index: 9999999;">

                    <section class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                            <a class="text-decoration-none" href="{{ route('home') }}">
                                <img src="{{ asset($setting->logo) }}"
                                     alt="لوگوی {{ $setting->title }}">
                            </a>
                        </h5>

                        <button type="button"
                                class="btn-close text-reset"
                                data-bs-dismiss="offcanvas"
                                aria-label="بستن منو">
                        </button>
                    </section>

                    <section class="offcanvas-body">

                        {{-- Main Menu --}}
                        @foreach($menus as $menu)
                            <section class="navbar-item">
                                <a href="{{ url($menu->url) }}">{{ $menu->name }}</a>
                            </section>
                        @endforeach

                        <section class="d-flex mt-2">
                            @if($setting->instagram)
                                <section class="navbar-item">
                                    <a href="{{ $setting->instagram }}" target="_blank" rel="noopener">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </section>
                            @endif

                            @if($setting->telegram)
                                <section class="navbar-item">
                                    <a href="{{ $setting->telegram }}" target="_blank" rel="noopener">
                                        <i class="fab fa-telegram"></i>
                                    </a>
                                </section>
                            @endif

                            @if($setting->link_1)
                                <section class="navbar-item">
                                    <a href="{{ $setting->link_1 }}" target="_blank" rel="noopener">
                                        <i class="fa fa-play"></i>
                                    </a>
                                </section>
                            @endif

                            @if($setting->link_2)
                                <section class="navbar-item">
                                    <a href="{{ $setting->link_2 }}" target="_blank" rel="noopener">
                                        <i class="fa fa-x"></i>
                                    </a>
                                </section>
                            @endif
                        </section>

                        <hr class="border-bottom">

                        <section class="navbar-item fw-bold">
                            دسته‌بندی‌ها
                        </section>

                        <!-- Mobile Categories -->
                        <section class="sidebar-nav mt-2 px-3">

                            @foreach($productCategories as $category)

                                <section class="sidebar-nav-item">

                                    <span class="sidebar-nav-item-title">
                                        <a class="text-decoration-none text-dark"
                                           href="{{ route('market.products',['category'=>$category->id]) }}"
                                           title="مشاهده {{ $category->name }}">
                                            {{ $category->name }}
                                        </a>
                                        <i class="fa fa-angle-left"></i>
                                    </span>

                                    <section class="sidebar-nav-sub-wrapper">

                                        @foreach($category->children as $subCategory)

                                            <section class="sidebar-nav-sub-item">

                                                <span class="sidebar-nav-sub-item-title">
                                                    <a href="{{ route('market.products',['category'=>$subCategory->id]) }}">
                                                        {{ $subCategory->name }}
                                                    </a>
                                                    <i class="fa fa-angle-left"></i>
                                                </span>

                                                <section class="sidebar-nav-sub-sub-wrapper">

                                                    @foreach($subCategory->children as $subSubCategory)
                                                        <section class="sidebar-nav-sub-sub-item">
                                                            <a href="{{ route('market.products',['category'=>$subSubCategory->id]) }}">
                                                                {{ $subSubCategory->name }}
                                                            </a>
                                                        </section>
                                                    @endforeach

                                                </section>

                                            </section>

                                        @endforeach

                                    </section>

                                </section>

                            @endforeach

                        </section>

                    </section>

                </section>
                <!-- End Offcanvas -->

            </nav>
        </section>
    </nav>

</header>
<!-- end header -->
