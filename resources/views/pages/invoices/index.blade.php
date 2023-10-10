@extends('layouts.app')

@section('styles')

    <!-- Internal Data table css -->
    <link href="{{asset('assets/plugins/datatable/datatables.min.css')}}" rel="stylesheet"/>

@endsection

@section('content')

    @include('messages.messages')

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a class="text-dark" href="{{ route('dashboard') }}">الرئيسية</a>
                </h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ الفواتير</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    <div class="row row-sm">

        <div class="col-lg-6 col-xl-4 col-md-6 col-12">
            <div class="card bg-primary-gradient text-white ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white">عدد الفواتير الكلى</span>
                                <h2 class="text-white mb-0">{{ $invoices_count }}</h2>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="las la-dollar-sign tx-40"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-xl-4 col-md-6 col-12">
            <div class="card bg-success-gradient text-white ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white">عدد فواتير اليوم</span>
                                <h2 class="text-white mb-0">{{ $invoices_day_count }}</h2>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fa fa-hourglass-end tx-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-xl-4 col-md-6 col-12">
            <div class="card bg-warning-gradient text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white">عدد فواتير الشهر</span>
                                <h2 class="text-white mb-0">{{ $invoices_month_count }}</h2>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fa fa-signal tx-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-xl-4 col-md-6 col-12">
            <div class="card bg-primary-gradient text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white">إجمالى الفواتير</span>
                                <h2 class="text-white mb-0">{{ number_format($invoices_total_amount,2) }}</h2>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="icon ion-ios-card tx-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-xl-4 col-md-6 col-12">
            <div class="card bg-success-gradient text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white">إجمالى تحصيل اليوم</span>
                                <h2 class="text-white mb-0">{{ number_format($invoices_day_amount,2) }}</h2>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fa fa-check tx-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-xl-4 col-md-6 col-12">
            <div class="card bg-warning-gradient text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white">إجمالى تحصيل الشهر</span>
                                <h2 class="text-white mb-0">{{ number_format($invoices_month_amount,2) }}</h2>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="icon ion-ios-pie tx-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="table">
                            <thead>
                            <tr>
                                <th class="border-bottom-0 text-center">#</th>
                                <th class="border-bottom-0 text-center">المسلسل</th>
                                <th class="border-bottom-0 text-center">المبلغ</th>
                                <th class="border-bottom-0 text-center">المستخدم</th>
                                <th class="border-bottom-0 text-center">تاريخ الإضافة</th>
                                <th class="border-bottom-0 text-center">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $invoice->id }} #</td>
                                    <td class="text-center">{{ number_format($invoice->total,2) }}</td>
                                    <td class="text-center">{{ $invoice->user->name }}</td>
                                    <td class="text-center">{{ $invoice->created_at->diffForHumans() }}</td>
                                    <td class="text-center">

                                        <a class="modal-effect btn btn-sm btn-outline-danger"
                                           data-bs-effect="effect-scale"
                                           data-bs-toggle="modal" href="#delete{{$invoice->id}}"><i
                                                class="las la-trash"></i></a>

                                    </td>
                                </tr>

                                @include('pages.invoices.delete')

                            @endforeach
                            </tbody>
                        </table>
                        {{ $invoices->links() }}
                    </div><!-- bd -->
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->
    </div>
    <!-- row closed -->

@endsection

@section('scripts')

    <!-- Internal Data tables -->
    <script src="{{asset('assets/plugins/datatable/datatables.min.js')}}"></script>

    <!--Internal  Datatable js -->
    <script src="{{asset('assets/js/table-data.js')}}"></script>

    <!-- Internal Modal js-->
    <script src="{{asset('assets/js/modal.js')}}"></script>

    <script>

        $('#table').DataTable({
            paging: false,
            language: {
                info: ""
            }
        });

    </script>

@endsection
