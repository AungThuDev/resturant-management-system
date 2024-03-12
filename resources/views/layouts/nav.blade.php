<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="{{ asset('assets/img/brand/logo.webp') }}" class="navbar-brand-img" alt="logo">
            </a>
        </div>
        <div class="navbar-inner mt-5">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    @foreach(auth()->user()->roles as $role)
                    @foreach($role->permissions as $p)
                    @if($p->name == 'reporting')
                    <li class="nav-item">
                        <a class="nav-link @yield('dash-active')" href="{{ url('/dashboard') }}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('record-active')" href="{{ url('/sales-records') }}">
                            <i class="fa-regular fa-clipboard text-info"></i>
                            <span class="nav-link-text">Sales Records</span>
                        </a>
                    </li>
                    @endif
                    @endforeach
                    @endforeach

                    @foreach(auth()->user()->roles as $role)
                    @foreach($role->permissions as $p)
                    @if($p->name == 'order-management')
                    <li class="nav-item">
                        <a class="nav-link @yield('dinning-active')" href="{{ url('/dinning-plans') }}">
                            <i class="fa fa-utensils text-success"></i>
                            <span class="nav-link-text">Order Here</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('order-active')" href="{{ url('/order-list') }}">
                            <i class="fa-solid fa-list text-danger"></i>
                            <span class="nav-link-text">Current Orders</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('table-active')" href="{{ route('tables.index') }}">
                            <i class="fa-solid fa-bowl-food"></i>
                            <span class="nav-link-text">Tables</span>
                        </a>
                    </li>
                    @endif
                    @endforeach
                    @endforeach
                    
                    @foreach (auth()->user()->roles as $role)
                    @foreach ($role->permissions as $p)
                    @if ($p->name == 'menu-management')
                    <li class="nav-item">
                        <a class="nav-link @yield('kitchen-active')" href="{{ route('kitchens.index') }}">
                            <i class="ni ni-shop text-success"></i>

                            <span class="nav-link-text">Kitchen</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @yield('cat-active')" href="{{ route('categories.index') }}">
                            <i class="ni ni-planet  text-orange"></i>
                            <span class="nav-link-text">Category</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('recipe-active')" href="{{ route('recipes.index') }}">
                            <i class="ni ni-collection text-yellow"></i>
                            <span class="nav-link-text">Recipe</span>
                        </a>
                    </li>
                    @endif
                    @endforeach
                    @endforeach

                    @foreach (auth()->user()->roles as $role)
                    @foreach ($role->permissions as $p)
                    @if ($p->name == 'user-management')
                    <li class="nav-item">
                        <a class="nav-link @yield('user-active')" href="{{ route('users') }}">
                            <i class="ni ni-single-02 text-purple"></i>
                            <span class="nav-link-text">User</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @yield('role-active')" href="{{ route('roles.index') }}">
                            <i class="ni ni-settings text-brown"></i>
                            <span class="nav-link-text">Role</span>
                        </a>
                    </li>
                    @endif
                    @endforeach
                    @endforeach

                    @foreach(auth()->user()->roles as $role)
                    @foreach($role->permissions as $p)
                    @if($p->name == 'discount-management')
                    <li class="nav-item">
                        <a class="nav-link @yield('cus-active')" href="{{ route('customers.index') }}">
                            <i class="ni ni-money-coins text-black"></i>
                            <span class="nav-link-text">Customer Discount</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('catDis-active')" href="{{ route('categoryDiscounts.index') }}">
                            <i class="ni ni-money-coins text-red"></i>
                            <span class="nav-link-text">Category Discount</span>
                        </a>
                    </li>
                    @endif
                    @endforeach
                    @endforeach
                    
                </ul>
                <!-- Divider -->
                <hr class="my-3">
                <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span>General Settings</span>
                </h6>
                <!-- Navigation -->
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link" href="" target="_blank">
                            <i class="ni ni-settings-gear-65"></i>
                            <span class="nav-link-text">Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>