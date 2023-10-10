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
                </h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ إضافة مأكولات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    <!-- row -->
    <div class="row">
        {{--   page content    --}}
        <form action="{{ route('items.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="col-lg-12 col-md-12">
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

                        <div class="row row-sm">

                            <div class="col">
                                <div class="form-group mg-b-0">
                                    <label class="form-label">الإسم</label>
                                    <input class="form-control" name="name"
                                           placeholder="الإسم" type="text" required="" max="100">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row row-sm mg-t-20">
                                <div class="col">
                                    <div id="repeaterContainer" class="form-group mg-b-0">
                                        <label class="form-label">الأصناف : <span
                                                class="tx-danger">*</span></label>
                                        <div class="repeater-item">
                                            <input class="col-4" type="text" name="options[]"
                                                   placeholder="إسم الصنف" required="" max="100">
                                            <input class="col-4" type="number" name="prices[]"
                                                   placeholder="سعر الصنف" required="">
                                            <button class="remove-btn btn btn-sm btn-danger">حذف</button>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-sm btn-success pd-x-20 mg-t-10" id="addBtn">إضافة صنف
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mg-t-20">
                                <button class="btn btn-main-primary pd-x-20 mg-t-10"
                                        type="submit">حفظ
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- row closed -->

@endsection

@section('scripts')
    {{--   page js    --}}

    <!-- Jquery js-->
    <script src="{{asset('assets/jquery/jquery-3.6.0.min.js')}}"></script>

    <script>

        $(document).ready(function () {

            $("#addBtn").click(function (e) {
                e.preventDefault();

                var newItem = '<div class="repeater-item">' +

                    '<input class="col-4 mg-t-2" type="text" name="options[]" placeholder="إسم الصنف" required=""> ' +

                    '<input class="col-4 mg-t-2" type="number" name="prices[]" placeholder = "سعر الصنف" required=""> ' +

                    '<button class="remove-btn btn btn-sm btn-danger">حذف</button></div>';

                $(newItem).appendTo("#repeaterContainer");
            });

            $(document).on("click", ".remove-btn", function () {
                $(this).closest(".repeater-item").remove();
            });
        });

    </script>

@endsection
