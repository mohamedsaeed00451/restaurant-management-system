<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header">
        <h4 class="desktop-logo logo-light active main-logo tx-bold">مٍــــٌن الأًخٍــــــّر</h4>
        <h2 class="logo-icon mobile-logo icon-light active logo-icon tx-sm-8">مٍــــٌن الأًخٍــــــّر</h2>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround"
                         src="{{asset('assets/icons/3170733.ico')}}"><span
                        class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="fw-semibold mt-3 mb-0">مٍــــٌن الأًخٍــــــّر</h4>
                    <span class="mb-0 text-muted">{{ auth()->user()->name }}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">

            @if(auth()->user()->is_admin)

                {{--     Dashboard       --}}
                <li class="slide">
                    <a class="side-menu__item text-dark" href="{{ route('dashboard') }}">
                        <i class="typcn typcn-home tx-22"></i>
                        <span class="side-menu__label text-dark mg-r-15">الرئيسية</span></a>
                </li>

            @endif

            {{--     Cashier       --}}
            <li class="slide">
                <a class="side-menu__item text-dark" href="{{ route('invoices.create') }}">
                    <i class="fa fa-laptop"></i>
                    <span class="side-menu__label text-dark mg-r-15">الكاشير</span></a>
            </li>

            {{--     Expenses       --}}
            <li class="slide">
                <a class="side-menu__item text-dark" href="{{ route('expenses.index') }}">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="side-menu__label text-dark mg-r-15">المصروفات</span></a>
            </li>

            @if(auth()->user()->is_admin)

                {{--     Invoices       --}}
                <li class="slide">
                    <a class="side-menu__item text-dark" href="{{ route('invoices.index') }}">
                        <i class="las la-dollar-sign tx-20"></i>
                        <span class="side-menu__label text-dark mg-r-15">الفواتير</span></a>
                </li>

                {{--     Users       --}}
                <li class="slide">
                    <a class="side-menu__item text-dark" href="{{ route('users.index') }}">
                        <i class="fa fa-lock"></i>
                        <span class="side-menu__label text-dark mg-r-15">عمال الكاشير</span></a>
                </li>


                {{--     Employees       --}}
                <li class="slide">
                    <a class="side-menu__item text-dark" href="{{ route('employees.index') }}">
                        <i class="fa fa-users"></i>
                        <span class="side-menu__label text-dark mg-r-15">العمال</span></a>
                </li>

                {{--     Items & Items Types       --}}
                <li class="slide">
                    <a class="side-menu__item text-dark" data-bs-toggle="slide" href="#">
                        <i class="fas fa-utensils"></i>
                        <span class="side-menu__label text-dark mg-r-15">المأكولات</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{ route('items.index') }}">عرض المأكولات</a></li>
                        <li><a class="slide-item" href="{{ route('items-types.index') }}">عرض الأصناف</a></li>
                    </ul>
                </li>

            @endif

        </ul>
    </div>
</aside>
<!-- main-sidebar -->
