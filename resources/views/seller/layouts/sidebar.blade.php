    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a href="{{ route('seller') }}" class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text ">
                <span> {{ auth('seller')->user()->full_name }}</span>
                <span style="font-size: 12px;">
                    @if(auth('seller')->user()->is_verified)
                    <i class="fas fa-user-check text-success"  data-toggle="tooltip" title="verified" data-replacement="bottom"></i>
                    @else
                    <i class="fas fa-user-times text-danger" data-toggle="tooltip" title="unverified" data-replacement="bottom"></i>
                    @endif
                </span>
            </div>
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
            <a class="nav-link collapsed" href="#collapseProducts" data-bs-toggle="collapse" aria-expanded="false"
                aria-controls="collapseProducts">
                <i class="fas fa-briefcase"></i>
                <span>Products Management</span>
            </a>
            <div id="collapseProducts" class="collapse">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Products:</h6>
                    <a class="collapse-item" href="{{ route('seller-product.index') }}">All Products</a>
                    <a class="collapse-item" href="{{ route('seller-product.create') }}">Create Product</a>
                </div>
            </div>
        </li>
       
    </ul>
    <!-- End of Sidebar -->
