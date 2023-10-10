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
                </h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ المأكولات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="col-sm-6 col-md-4 col-xl-3">
                        <a class="btn btn-outline-primary btn-block"
                           href="{{ route('items.create') }}">إضافة مأكولات</a>
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
                                <th class="border-bottom-0 text-center">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->name }}</td>
                                    <td class="text-center">

                                        <a class="btn btn-sm btn-outline-success" href="{{ route('items.show',$item->id) }}"><i
                                                class="fas fa-utensils"></i></a>

                                        <a class="btn btn-sm btn-outline-info" href="{{ route('items.edit',$item->id) }}"><i
                                                class="las la-pen"></i></a>

                                        <a class="modal-effect btn btn-sm btn-outline-danger"
                                           data-bs-effect="effect-scale"
                                           data-bs-toggle="modal" href="#delete{{$item->id}}"><i
                                                class="las la-trash"></i></a>

                                    </td>
                                </tr>

                                @include('pages.items.delete')

                            @endforeach
                            </tbody>
                        </table>
                        {{ $items->links() }}
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
