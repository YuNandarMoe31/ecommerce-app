    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a href="{{ route('admin') }}" class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
        </a>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.html">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>
        <li class="nav-item">
            <a class="nav-link btn" href="#collapseBanner" data-bs-toggle="collapse" role="button"
                aria-expanded="false" aria-controls="collapseBanner">
                <i class="fas fa-image"></i> <span>Banner Management</span>
            </a>
            <div class="collapse" id="collapseBanner">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Banner:</h6>
                    <a class="collapse-item" href="{{ route('banner.index') }}">All Banners</a>
                    <a class="collapse-item" href="{{ route('banner.create') }}">Create Banner</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#collapseCategory" data-bs-toggle="collapse" aria-expanded="false"
                aria-controls="collapseCategory">
                <i class="fas fa-sitemap"></i>
                <span>Category Management</span>
            </a>
            <div id="collapseCategory" class="collapse">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Category:</h6>
                    <a class="collapse-item" href="{{ route('category.index') }}">All Categories</a>
                    <a class="collapse-item" href="{{ route('category.create') }}">Create Category</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#collapseBrand" data-bs-toggle="collapse" aria-expanded="false"
                aria-controls="collapseBrand">
                <i class="fas fa-shopping-bag"></i>
                <span>Brand Management</span>
            </a>
            <div id="collapseBrand" class="collapse">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Brand:</h6>
                    <a class="collapse-item" href="{{ route('brand.index') }}">All Brands</a>
                    <a class="collapse-item" href="{{ route('brand.create') }}">Create Brand</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#collapseProducts" data-bs-toggle="collapse" aria-expanded="false"
                aria-controls="collapseProducts">
                <i class="fas fa-briefcase"></i>
                <span>Products Management</span>
            </a>
            <div id="collapseProducts" class="collapse">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Products:</h6>
                    <a class="collapse-item" href="{{ route('product.index') }}">All Products</a>
                    <a class="collapse-item" href="{{ route('product.create') }}">Create Product</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link btn" href="#collapseShipping" data-bs-toggle="collapse" role="button" aria-expanded="false"
                aria-controls="collapseShipping">
                <i class="fas fa-truck"></i>
                <span>Shipping Management</span>
            </a>
            <div class="collapse" id="collapseShipping">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Shipping:</h6>
                    <a class="collapse-item" href="{{ route('shipping.index') }}">All Shippings</a>
                    <a class="collapse-item" href="{{ route('shipping.create') }}">Create Shipping</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link btn" href="#collapseCurrency" data-bs-toggle="collapse" role="button" aria-expanded="false"
                aria-controls="collapseCurrency">
                <i class="fas fa-money-bill-alt"></i>
                <span>Currency Management</span>
            </a>
            <div class="collapse" id="collapseCurrency">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Currency:</h6>
                    <a class="collapse-item" href="{{ route('currency.index') }}">All Currencies</a>
                    <a class="collapse-item" href="{{ route('currency.create') }}">Create Currency</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link btn" href="{{ route('order.index') }}" 
                >
                <i class="fas fa-store"></i>
                <span>Order Management</span>
            </a>

        </li>
        <li class="nav-item">
            <a class="nav-link btn" href="#collapsePostCategory" data-bs-toggle="collapse" role="button"
                aria-expanded="false" aria-controls="collapsePostCategory">
                <i class="fas fa-sitemap"></i> 
                <span>Post Category</span>
            </a>
            <div class="collapse" id="collapsePostCategory">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">PostCategory:</h6>
                    <a class="collapse-item" href="buttons.html">Buttons</a>
                    <a class="collapse-item" href="cards.html">Cards</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link btn" href="#collapsePostTag" data-bs-toggle="collapse" role="button"
                aria-expanded="false" aria-controls="collapsePostTag">
                <i class="fas fa-tags"></i>                
                <span>Post Tag</span>
            </a>
            <div class="collapse" id="collapsePostTag">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Post Tag:</h6>
                    <a class="collapse-item" href="buttons.html">Buttons</a>
                    <a class="collapse-item" href="cards.html">Cards</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link btn" href="#collapsePostManagement" data-bs-toggle="collapse" role="button"
                aria-expanded="false" aria-controls="collapsePostManagement">
                <i class="fas fa-tasks"></i>
                <span>Post Management</span>
            </a>
            <div class="collapse" id="collapsePostManagement">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Post Management:</h6>
                    <a class="collapse-item" href="buttons.html">Buttons</a>
                    <a class="collapse-item" href="cards.html">Cards</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link btn" href="#collapseReview" data-bs-toggle="collapse" role="button"
                aria-expanded="false" aria-controls="collapseReview">
                <i class="far fa-star"></i>          
                <span>Review Management</span>
            </a>
            <div class="collapse" id="collapseReview">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Review Management:</h6>
                    <a class="collapse-item" href="buttons.html">Buttons</a>
                    <a class="collapse-item" href="cards.html">Cards</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link btn" href="#collapseCoupon" data-bs-toggle="collapse" role="button"
                aria-expanded="false" aria-controls="collapseCoupon">
                <i class="fas fa-ticket-alt"></i>            
                <span>Coupon Management</span>
            </a>
            <div class="collapse" id="collapseCoupon">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Coupon Management:</h6>
                    <a class="collapse-item" href="{{ route('coupon.index') }}">All Coupons</a>
                    <a class="collapse-item" href="{{ route('coupon.create') }}">Create Coupon</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link btn" href="#collapseUser" data-bs-toggle="collapse" role="button"
                aria-expanded="false" aria-controls="collapseUser">
                <i class="fas fa-users"></i>      
                <span>User Management</span>
            </a>
            <div class="collapse" id="collapseUser">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">User Management:</h6>
                    <a class="collapse-item" href="{{ route('user.index') }}">All users</a>
                    <a class="collapse-item" href="{{ route('user.create') }}">Crate user</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link btn" href="#collapseSeller" data-bs-toggle="collapse" role="button"
                aria-expanded="false" aria-controls="collapseSeller">
                <i class="fas fa-user"></i>      
                <span>Seller Management</span>
            </a>
            <div class="collapse" id="collapseSeller">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Seller Management:</h6>
                    <a class="collapse-item" href="{{ route('seller.index') }}">All seller</a>
                    {{-- <a class="collapse-item" href="{{ route('user.create') }}">Crate user</a> --}}
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link btn" href="#collapseComment" data-bs-toggle="collapse" role="button"
                aria-expanded="false" aria-controls="collapseComment">
                <i class="fas fa-comments"></i>
                <span>Comment Management</span>
            </a>
            <div class="collapse" id="collapseComment">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Comment Management:</h6>
                    <a class="collapse-item" href="buttons.html">Buttons</a>
                    <a class="collapse-item" href="cards.html">Cards</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link btn" href="{{ route('setting') }}">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Addons
        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Pages</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Login Screens:</h6>
                    <a class="collapse-item" href="login.html">Login</a>
                    <a class="collapse-item" href="register.html">Register</a>
                    <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Other Pages:</h6>
                    <a class="collapse-item" href="404.html">404 Page</a>
                    <a class="collapse-item" href="blank.html">Blank Page</a>
                </div>
            </div>
        </li>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Charts</span></a>
        </li>
        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="tables.html">
                <i class="fas fa-fw fa-table"></i>
                <span>Tables</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
        <!-- Sidebar Message -->
        <div class="sidebar-card d-none d-lg-flex">
            <img class="sidebar-card-illustration mb-2" src="{{ asset('backend/img/undraw_rocket.svg') }}"
                alt="...">
            <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components,
                and more!</p>
            <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to
                Pro!</a>
        </div>
    </ul>
    <!-- End of Sidebar -->
