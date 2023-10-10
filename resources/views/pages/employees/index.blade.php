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
                </h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ العمال</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    <div class="row row-sm">
        <div class="col-lg-6 col-xl-6 col-md-6 col-12">
            <div class="card bg-primary-gradient text-white ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white">عدد العمال</span>
                                <h2 class="text-white mb-0">{{ $employees_count }}</h2>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fa fa-users tx-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-6 col-md-6 col-12">
            <div class="card bg-warning-gradient text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white">إجمالى الرواتب</span>
                                <h2 class="text-white mb-0">{{ number_format($employees_total_amount,2) }}</h2>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fas fa-chart-pie tx-30"></i>
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
                <div class="card-header pb-0">
                    <div class="col-sm-6 col-md-4 col-xl-3">
                        <a class="modal-effect btn btn-outline-primary btn-block"
                           data-bs-effect="effect-scale"
                           data-bs-toggle="modal" href="#create">إضافة عامل</a>
                    </div>
                </div>
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
                                <th class="border-bottom-0 text-center">الإسم</th>
                                <th class="border-bottom-0 text-center">رقم الهاتف</th>
                                <th class="border-bottom-0 text-center">الراتب</th>
                                <th class="border-bottom-0 text-center">تاريخ الإنضمام</th>
                                <th class="border-bottom-0 text-center">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $employee->name }}</td>
                                    <td class="text-center">{{ $employee->phone }}</td>
                                    <td class="text-center">{{ number_format($employee->salary,2) }}</td>
                                    <td class="text-center">{{ $employee->created_at->diffForHumans() }}</td>
                                    <td class="text-center">

                                        <a class="modal-effect btn btn-sm btn-outline-primary"
                                           data-bs-effect="effect-scale"
                                           data-bs-toggle="modal" href="#edit{{$employee->id}}"><i
                                                class="las la-pen"></i></a>

                                        <a class="modal-effect btn btn-sm btn-outline-danger"
                                           data-bs-effect="effect-scale"
                                           data-bs-toggle="modal" href="#delete{{$employee->id}}"><i
                                                class="las la-trash"></i></a>

                                    </td>
                                </tr>

                                @include('pages.employees.edit')
                                @include('pages.employees.delete')

                            @endforeach
                            </tbody>
                        </table>
                        {{ $employees->links() }}
                    </div><!-- bd -->
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->
    </div>
    <!-- row closed -->

    @include('pages.employees.create')

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
