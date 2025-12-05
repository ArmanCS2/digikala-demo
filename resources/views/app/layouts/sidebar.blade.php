<aside id="sidebar" class="sidebar col-md-3">
    <section class="content-wrapper bg-white p-3 rounded-2 mb-3">

        <!-- Sidebar Navigation -->
        <nav class="sidebar-nav">

            <ul class="list-unstyled m-0">

                <li class="sidebar-nav-item">
                    <a class="sidebar-nav-item-title p-3 d-block {{ request()->routeIs('profile.orders') ? 'active' : '' }}"
                       href="{{ route('profile.orders') }}">
                        سفارش‌های من
                    </a>
                </li>

                <li class="sidebar-nav-item">
                    <a class="sidebar-nav-item-title p-3 d-block {{ request()->routeIs('profile.addresses') ? 'active' : '' }}"
                       href="{{ route('profile.addresses') }}">
                        آدرس‌های من
                    </a>
                </li>

                <li class="sidebar-nav-item">
                    <a class="sidebar-nav-item-title p-3 d-block {{ request()->routeIs('profile.favorites') ? 'active' : '' }}"
                       href="{{ route('profile.favorites') }}">
                        لیست علاقه‌مندی
                    </a>
                </li>

                <li class="sidebar-nav-item">
                    <a class="sidebar-nav-item-title p-3 d-block {{ request()->routeIs('profile.compares') ? 'active' : '' }}"
                       href="{{ route('profile.compares') }}">
                        لیست مقایسه
                    </a>
                </li>

                <li class="sidebar-nav-item">
                    <a class="sidebar-nav-item-title p-3 d-block {{ request()->routeIs('profile.ticket.index') ? 'active' : '' }}"
                       href="{{ route('profile.ticket.index') }}">
                        لیست تیکت‌ها
                    </a>
                </li>

                <li class="sidebar-nav-item">
                    <a class="sidebar-nav-item-title p-3 d-block {{ request()->routeIs('profile.index') ? 'active' : '' }}"
                       href="{{ route('profile.index') }}">
                        حساب کاربری
                    </a>
                </li>

                <li class="sidebar-nav-item">
                    <a class="sidebar-nav-item-title p-3 d-block text-danger"
                       href="{{ route('auth.logout') }}">
                        خروج از حساب کاربری
                    </a>
                </li>

            </ul>

        </nav>
        <!-- End Sidebar Navigation -->

    </section>
</aside>
