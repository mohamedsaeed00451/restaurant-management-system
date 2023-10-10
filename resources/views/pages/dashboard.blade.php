@extends('layouts.app')

@section('styles')

@endsection

@section('content')

    @include('messages.messages')

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    <!-- row -->
    <div class="row row-sm">

        {{--   Items  --}}

        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">المأكولات</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="col-9">
                                <h4 class="tx-20 fw-bold mb-1 text-white">{{ $items }}</h4>
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('items.index') }}"
                                       class="mb-0 tx-12 text-white op-7 ">عرض المأكولات</a>
                                @endif
                            </div>
                            <div class="col-9 text-white tx-40"><i class="fas fa-utensils"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--   Items Types  --}}

        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">الأصناف</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="col-9">
                                <h4 class="tx-20 fw-bold mb-1 text-white">{{ $items_types }}</h4>
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('items-types.index') }}"
                                       class="mb-0 tx-12 text-white op-7 ">عرض الأصناف</a>
                                @endif
                            </div>
                            <div class="col-9 text-white tx-40"><i class="si si-book-open"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--   Employees  --}}

        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">العمال</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="col-9">
                                <h4 class="tx-20 fw-bold mb-1 text-white">{{ $employees }}</h4>
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('employees.index') }}"
                                       class="mb-0 tx-12 text-white op-7 ">عرض العمال</a>
                                @endif
                            </div>
                            <div class="col-9 text-white tx-40"><i class="fa fa-users"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--   Invoices  --}}

        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">الفواتير</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="col-9">
                                <h4 class="tx-20 fw-bold mb-1 text-white">{{ $invoices }}</h4>
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('invoices.index') }}"
                                       class="mb-0 tx-12 text-white op-7 ">عرض الفواتير</a>
                                @endif
                            </div>
                            <div class="col-9 text-white tx-40"><i class="las la-dollar-sign"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--   Expenses  --}}

        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">المصروفات</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="col-9">
                                <h4 class="tx-20 fw-bold mb-1 text-white">{{ $expenses }}</h4>
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('expenses.index') }}"
                                       class="mb-0 tx-12 text-white op-7 ">عرض المصروفات</a>
                                @endif
                            </div>
                            <div class="col-9 text-white tx-40"><i class="fa fa-shopping-cart"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->

@endsection('content')

@section('scripts')

@endsection
