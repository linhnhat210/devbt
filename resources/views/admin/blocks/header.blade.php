<header class="header header-sticky p-0 mb-4">
    <div class="container-fluid border-bottom px-4">
        <button class="header-toggler" type="button"
            onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"
            style="margin-inline-start: -14px;">
            <svg class="icon icon-lg">
                <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-menu') }}">
                </use>
            </svg>
        </button>
        <ul class="header-nav d-none d-lg-flex">
            <li class="nav-item"><a class="nav-link" href="">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="">Users</a></li>
            <li class="nav-item"><a class="nav-link" href="">Settings</a></li>
        </ul>
        <ul class="header-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="debtDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg class="icon icon-lg">
                        <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-bell') }}"></use>
                    </svg>
                    @if ($debtsSoon->count() || $debtsLate->count())
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $debtsSoon->count() + $debtsLate->count() }}
                        </span>
                    @endif
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="debtDropdown" style="width: 450px;">
                    @if ($debtsSoon->count() || $debtsLate->count())
                        @foreach ($debtsSoon as $debt)
                            <li><a class="dropdown-item text-warning" href="{{ route('admin.debts.edit', $debt->id) }}">
                                    ⚠️ Công nợ: {{ $debt->debt_code }} sắp đến hạn
                                    ({{ \Carbon\Carbon::parse($debt->due_date)->format('d/m/Y') }})
                                </a></li>
                        @endforeach

                        @foreach ($debtsLate as $debt)
                            <li><a class="dropdown-item text-danger" href="{{ route('admin.debts.edit', $debt->id) }}">
                                    ❗ Công nợ {{ $debt->debt_code }} quá hạn
                                    ({{ \Carbon\Carbon::parse($debt->due_date)->format('d/m/Y') }})
                                </a></li>
                        @endforeach
                    @else
                        <li><a class="dropdown-item text-muted" href="#">Không có công nợ cần chú ý.</a></li>
                    @endif
                </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="">
                    <svg class="icon icon-lg">
                        <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-list-rich') }}">
                        </use>
                    </svg></a></li>
            <li class="nav-item"><a class="nav-link" href="">
                    <svg class="icon icon-lg">
                        <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-envelope-open') }}">
                        </use>
                    </svg></a></li>
        </ul>
        <ul class="header-nav">
            <li class="nav-item py-1">
                <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
            </li>
            <li class="nav-item dropdown">
                <button class="btn btn-link nav-link py-2 px-2 d-flex align-items-center" type="button"
                    aria-expanded="false" data-coreui-toggle="dropdown">
                    <svg class="icon icon-lg theme-icon-active">
                        <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-contrast') }}">
                        </use>
                    </svg>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" style="--cui-dropdown-min-width: 8rem;">
                    <li>
                        <button class="dropdown-item d-flex align-items-center" type="button"
                            data-coreui-theme-value="light">
                            <svg class="icon icon-lg me-3">
                                <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-sun') }}">
                                </use>
                            </svg>Light
                        </button>
                    </li>
                    <li>
                        <button class="dropdown-item d-flex align-items-center" type="button"
                            data-coreui-theme-value="dark">
                            <svg class="icon icon-lg me-3">
                                <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-moon') }}">
                                </use>
                            </svg>Dark
                        </button>
                    </li>
                    <li>
                        <button class="dropdown-item d-flex align-items-center active" type="button"
                            data-coreui-theme-value="auto">
                            <svg class="icon icon-lg me-3">
                                <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-contrast') }}">
                                </use>
                            </svg>Auto
                        </button>
                    </li>
                </ul>
            </li>
            <li class="nav-item py-1">
                <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
            </li>
            <li class="nav-item dropdown"><a class="nav-link py-0 pe-0" data-coreui-toggle="dropdown" href=""
                    role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md"><img class="avatar-img"
                            src="{{ asset('dist/assets/img/avatars/8.jpg') }}" alt="user@email.com"></div>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top mb-2">
                        Account</div><a class="dropdown-item" href="">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-bell') }}">
                            </use>
                        </svg> Updates<span class="badge badge-sm bg-info ms-2">42</span></a><a class="dropdown-item"
                        href="">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-envelope-open') }}">
                            </use>
                        </svg> Messages<span class="badge badge-sm bg-success ms-2">42</span></a><a
                        class="dropdown-item" href="">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-task') }}">
                            </use>
                        </svg> Tasks<span class="badge badge-sm bg-danger ms-2">42</span></a><a class="dropdown-item"
                        href="">
                        <svg class="icon me-2">
                            <use
                                xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-comment-square') }}">
                            </use>
                        </svg> Comments<span class="badge badge-sm bg-warning ms-2">42</span></a>
                    <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold my-2">
                        <div class="fw-semibold">Settings</div>
                    </div><a class="dropdown-item" href="">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-user') }}">
                            </use>
                        </svg> Profile</a><a class="dropdown-item" href="">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-settings') }}">
                            </use>
                        </svg> Settings</a><a class="dropdown-item" href="">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-credit-card') }}">
                            </use>
                        </svg> Payments<span class="badge badge-sm bg-secondary ms-2">42</span></a><a
                        class="dropdown-item" href="">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-file') }}">
                            </use>
                        </svg> Projects<span class="badge badge-sm bg-primary ms-2">42</span></a>
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-lock-locked') }}">
                            </use>
                        </svg> Lock Account</a>
                    <a class="dropdown-item" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <svg class="icon me-2">
                            <use
                                xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-account-logout') }}">
                            </use>
                        </svg> Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
    <div class="container-fluid px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active"><span>Dashboard</span>
                </li>
            </ol>
        </nav>
    </div>
</header>
