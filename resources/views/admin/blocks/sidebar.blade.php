<div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
    <div class="sidebar-header border-bottom">
        <div class="sidebar-brand">
            <svg class="sidebar-brand-full" width="88" height="32" alt="CoreUI Logo">
                <use xlink:href="{{ asset('dist/assets/brand/coreui.svg#full') }}"></use>
            </svg>
            <svg class="sidebar-brand-narrow" width="32" height="32" alt="CoreUI Logo">
                <use xlink:href="{{ asset('dist/assets/brand/coreui.svg#signet') }}"></use>
            </svg>
        </div>
        <button class="btn-close d-lg-none" type="button" data-coreui-theme="dark" aria-label="Close"
            onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"></button>
    </div>

    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-speedometer') }}"></use>
                </svg>
                Dashboard
            </a>
        </li>

        <li class="nav-title">Quản lý</li>

        <li>
            <a class="nav-link" href="{{ route('admin.devices.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-devices') }}"></use>
                </svg>
                Thiết bị
            </a>
        </li>

        <li>
            <a class="nav-link" href="{{ route('admin.agents.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
                </svg>
                Đại lý
            </a>
        </li>

        <li>
            <a class="nav-link" href="{{ route('admin.projects.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-briefcase') }}"></use>
                </svg>
                Dự án
            </a>
        </li>

        <li>
            <a class="nav-link" href="{{ route('admin.warranties.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-shield-alt') }}"></use>
                </svg>
                Bảo hành
            </a>
        </li>

        <li>
            <a class="nav-link" href="{{ route('admin.debts.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-cash') }}"></use>
                </svg>
                Công nợ
            </a>
        </li>

        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-people') }}"></use>
                </svg>
                Người dùng
            </a>
            <ul class="nav-group-items compact">
                <li><a class="nav-link" href="{{ route('admin.users.index') }}">
                        <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Người dùng
                    </a></li>
                <li><a class="nav-link" href="{{ route('admin.roles.index') }}">
                        <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Vai trò
                    </a></li>
            </ul>
        </li>

        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-list') }}"></use>
                </svg>
                Danh mục
            </a>
            <ul class="nav-group-items compact">
                <li><a class="nav-link" href="{{ route('admin.categories.index') }}">
                        <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Thiết bị vật tư
                    </a></li>
                <li><a class="nav-link" href="{{ route('admin.warehouses.index') }}">
                        <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Kho quản lý
                    </a></li>
                <li><a class="nav-link" href="{{ route('admin.sales_units.index') }}">
                        <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Đơn vị bán hàng
                    </a></li>
            </ul>
        </li>
    </ul>

    <div class="sidebar-footer border-top d-none d-md-flex">
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
</div>
