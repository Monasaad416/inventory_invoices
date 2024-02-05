<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">

    <span class="brand-text font-weight-light"><img src=""></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img src="{{ url('dashboard/assets/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                    @can( 'لوحة التحكم')
                        <li class="nav-item">
                            <a href="{{ route('index') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                لوحة التحكم
                            </p>
                            </a>

                        </li>
                    @endcan

                    @can('قائمة الوحدات')
                        <li class="nav-item">
                            <a href="{{ route('units') }}" class="nav-link {{ request()->is('units') ? 'active' : '' }}">
                            <i class="nav-icon far fa-plus-square"></i>
                            <p>
                                وحدات القياس
                            </p>
                            </a>

                        </li>
                    @endcan

                    @can('قائمة المنتجات')
                        <li class="nav-item">
                            <a href="{{route('products')}}" class="nav-link {{ request()->is('products*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                المنتجات
                            </p>
                            </a>

                        </li>
                    @endcan

                    @can('قائمة الفواتير')
                        <li class="nav-item {{ request()->is('invoices*') ? 'menu-open active' : '' }}">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                فواتير الجرد
                                <i class="fas fa-angle-left right"></i>
                                {{-- <span class="badge badge-info right">{{ App\Models\Page::count() }}</span> --}}
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('invoices')}}" class="nav-link {{ request()->is('invoices') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>  قائمة الفواتير</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('invoices.create')}}" class="nav-link {{ request()->is('invoices/create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> إضافة فاتوره</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    @endcan

                    @can('قائمة المستخدمين')
                        <li class="nav-item">
                            <a href="{{route('users')}}" class="nav-link {{ request()->is('users') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                            المستخدمين
                            </p>
                            </a>
                        </li>
                    @endcan
                    {{-- @can('تعديل الإعدادات')
                        <li class="nav-item">
                            <a href="{{route('settings.edit')}}" class="nav-link {{ request()->is('settings/update') ? 'active' : '' }}">
                                <i class="fa fa-cog nav-icon"></i>
                                <p>الإعدادات</p>
                            </a>
       
                        </li>
                    @endcan --}}
                    @can('قائمة المهام')
                        <li class="nav-item">
                            <a href="{{ route('roles') }}" class="nav-link {{ request()->is('roles*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                المهام والصلاحيات
                                {{-- <span class="badge badge-info right">{{ App\Models\Category::count() }}</span> --}}
                            </p>
                            </a>

                        </li>
                        @endcan

                <li class="nav-item {{ request()->is('user*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            الملف الشخصي
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('user.edit_profile')}}" class="nav-link {{ request()->is('user/edit-profile') ? 'active' : '' }}">
                            <i class="nav-icon far fa-circle text-warning"></i>
                            <p>تعديل الملف الشخصي</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('user.edit_password')}}" class="nav-link {{ request()->is('user/change-password') ? 'active' : '' }}">
                            <i class="nav-icon far fa-circle text-success"></i>
                            <p>تعديل كلمة السر</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link"  onclick="document.getElementById('logout-form').submit();">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p>تسجيل الخروج</p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
