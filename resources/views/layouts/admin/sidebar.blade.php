<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('dashboard') }}" class="brand-link">
    <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
         class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->name ?? 'User Name' }}</a>
      </div>
    </div>

    <!-- Sidebar Search -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!-- Dashboard -->
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- Category Management -->
        <li class="nav-item {{ request()->is('categories*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->is('categories*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-layer-group"></i>
            <p>
              إدارة الأصناف
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('categories.index') }}" class="nav-link {{ request()->is('categories') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>عرض كل الأصناف</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('categories.create') }}" class="nav-link {{ request()->is('categories/create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>إضافة صنف جديد</p>
              </a>
            </li>
                    <li class="nav-item">
            <a href="{{ route('categories.trash') }}" class="nav-link">
                <i class="nav-icon fas fa-trash"></i>
                <p>سلة المحذوفات</p>
            </a>
        </li>

          </ul>
        </li>

        <!-- Products by Category -->
    <li class="nav-item {{ request()->is('products*') ? 'menu-open' : '' }}">
       <a href="#" class="nav-link {{ request()->is('products*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-utensils"></i>
        <p>
          قائمة المنتجات
        <i class="fas fa-angle-left right"></i>
        </p>
       </a>

  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('products.index') }}" 
         class="nav-link {{ request()->routeIs('products.index') && !request()->query('category_id') ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>عرض كل المنتجات</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('products.trash') }}" 
         class="nav-link {{ request()->routeIs('products.trash') ? 'active' : '' }}">
        <i class="nav-icon fas fa-trash"></i>
        <p>سلة المحذوفات</p>
      </a>
    </li>
  </ul>
</li>

<li class="nav-item">
    <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ request()->is('admin/contacts*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-envelope"></i>
        <p>
            Contact Messages
            @php
                $newCount = \App\Models\ContactMessage::count();
            @endphp
            @if($newCount > 0)
                <span class="badge badge-danger right">{{ $newCount }}</span>
            @endif
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('settings.index') }}" 
       class="nav-link {{ request()->is('admin/settings') ? 'active' : '' }}">
        <i class="nav-icon fas fa-cog"></i>
        <p>الإعدادات</p>
    </a>
</li>
<!-- Sliders -->
<li class="nav-item">
    <a href="{{ route('admin.sliders.index') }}" 
       class="nav-link {{ request()->is('admin/sliders*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-images"></i>
        <p> Sliders</p>
    </a>
</li>

 
<!-- Offers -->
<li class="nav-item">
    <a href="{{ route('admin.offers.index') }}" class="nav-link {{ request()->is('admin/offers*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tag"></i>
        <p> Offers</p>
    </a>
</li>

<!-- Services -->
<li class="nav-item">
    <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->is('admin/services*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-concierge-bell"></i>
        <p>Services</p>
    </a>
</li>

<!-- Banners -->
<li class="nav-item">
    <a href="{{ route('admin.banners.index') }}" class="nav-link {{ request()->is('admin/banners*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-rectangle-landscape"></i>
        <p> Banners</p>
    </a>
</li>


<!-- Orders Management -->
<li class="nav-item {{ request()->is('admin/orders*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-shopping-cart"></i>
        <p>
            إدارة الطلبات
            @php
                $pendingOrders = \App\Models\Order::where('status', 'pending')->count();
            @endphp
            @if($pendingOrders > 0)
                <span class="badge badge-danger right">{{ $pendingOrders }}</span>
            @endif
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.orders.index') }}" 
               class="nav-link {{ request()->routeIs('admin.orders.index') && !request()->query('status') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>كل الطلبات</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" 
               class="nav-link {{ request()->query('status') === 'pending' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                    قيد الانتظار
                    @if($pendingOrders > 0)
                        <span class="badge badge-warning right">{{ $pendingOrders }}</span>
                    @endif
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}" 
               class="nav-link {{ request()->query('status') === 'processing' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>قيد التجهيز</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.orders.index', ['status' => 'shipped']) }}" 
               class="nav-link {{ request()->query('status') === 'shipped' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>تم الشحن</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.orders.index', ['status' => 'delivered']) }}" 
               class="nav-link {{ request()->query('status') === 'delivered' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>تم التسليم</p>
            </a>
        </li>
    </ul>
</li>

          </ul>
   
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
