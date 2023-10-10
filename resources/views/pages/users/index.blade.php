@extends('layouts.app')

@section('styles')

@endsection

@section('content')

    @include('messages.messages')

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a class="text-dark" href="{{ route('dashboard') }}">الرئيسية</a>
                </h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ عمال الكاشير</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mg-b-0 text-md-nowrap">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">الإسم</th>
                                <th class="wd-15p border-bottom-0">اسم المستخدم</th>
                                <th class="wd-20p border-bottom-0">كلمة المرور</th>
                                <th class="wd-20p border-bottom-0">الفواتير</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-outline-success" href="{{ route('user.invoices',$user->id) }}"><i
                                                class="las la-dollar-sign"></i></a>

                                        <a class="btn btn-sm btn-outline-danger" href="{{ route('user.expenses',$user->id) }}"><i
                                                class="fa fa-shopping-cart"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- bd -->
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->
    </div>
    <!-- row closed -->

@endsection

@section('scripts')

@endsection
