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
                </h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ اسم الصفحة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    <!-- row -->
    <div class="row">

    </div>
    <!-- row closed -->

@endsection

@section('scripts')

@endsection
