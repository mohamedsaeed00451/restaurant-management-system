@extends('layouts.app')

@section('styles')

    <style>

        @media print {
            .delete-button {
                display: none;
            }
        }

    </style>

@endsection

@section('content')

    @include('messages.messages')

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                @if(auth()->user()->is_admin)
                    <h4 class="content-title mb-0 my-auto"><a class="text-dark"
                                                              href="{{ route('dashboard') }}">الرئيسية</a>
                    </h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ إضافة فاتورة</span>
                @else
                    <h4 class="content-title mb-0 my-auto">إضافة فاتورة</h4>
                @endif
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- row -->
    <div class="row">

        <div class="col-xl-2">
            <div class="card">

                <div class="card-body text-center">

                    <div class="text-center tx-bold mb-2 tx-20">المأكولات</div>

                    @forelse($items as $item)

                        <div class="col-xl-12">
                            <button class="card text-center tx-bold col-md-12" type="submit"
                                    onclick="getItemsTypes({{$item->id}})" id="addColorItem{{ $item->id }}">
                                <div class="card-body">
                                    <div class="card-text text-center">{{ $item->name }}</div>
                                </div>
                            </button>
                        </div>

                    @empty

                        <span class="text-center text-danger">لا يوجد مأكولات</span>

                    @endforelse

                </div>
            </div>
        </div>

        <div class="col-xl-5">
            <div class="card">
                <div class="card-body" id="itemsTypesSelected">

                    <div class="text-center tx-bold mb-2 tx-20">الأصناف</div>

                    {{--        Item Types         --}}

                    <div class="d-flex flex-wrap">

                        @forelse($item_types as $itemType)

                            <div class="col-md-4">

                                <input type="hidden" class="card-text text-center" id="name{{$itemType->id}}"
                                       value="{{ $itemType->name }}">
                                <input type="hidden" class="card-text text-center" id="price{{$itemType->id}}"
                                       value="{{ $itemType->price }}">
                                <button class="col-md-12 card text-center tx-bold"
                                        id="itemTypeBtn{{$itemType->id}}"
                                        type="submit"
                                        onclick="showInput( {{$itemType->id}} )">
                                    <div class="card-body text-center">
                                        <div class="card-text text-center">{{ $itemType->name }}</div>
                                        <div class="card-text text-center">{{ number_format($itemType->price,2) }} ج</div>
                                    </div>
                                </button>

                                <div class="form-group">

                                    <input class="form-control" name="amount" type="number"
                                           id="amountInput{{ $itemType->id }}"
                                           style="display: none;"
                                           value="1" placeholder="ادخل الكمية" autofocus>

                                    <button style="display: none;" type="button" class="w-100 btn btn-outline-success"
                                            id="addToInvoice{{ $itemType->id }}"
                                            onclick="addItemToInvoice( {{ $itemType->id }} )">إضافة
                                    </button>

                                </div>

                            </div>

                        @empty

                            <span class="text-center text-danger tx-bold">لا يوجد أصناف</span>

                        @endforelse

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-5">
            <div class="card" id="areaPrint">
                <div class="card-body text-left">
                    <div class="text-center tx-bold mb-2 tx-20" id="titleInvoice" style="display: block;">الفاتورة</div>

                    <div id="serialNumble">

                        {{--      Invoice Header        --}}

                    </div>

                    <div class="col-xl-12 text-center" id="messageEnd">
                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped mg-b-0 text-md-nowrap">
                                        <thead>
                                        <tr>
                                            <th class="border-bottom-0 text-center tx-bold tx-14-f">الصنف</th>
                                            <th class="border-bottom-0 text-center tx-bold tx-14-f">الكمية</th>
                                            <th class="border-bottom-0 text-center tx-bold tx-14-f">سعر الواحد</th>
                                            <th class="border-bottom-0 text-center tx-bold tx-14-f">السعر الكلى</th>
                                            <th class="border-bottom-0 text-center delete-button text-danger tx-bold tx-14-f">تراجع</th>
                                        </tr>
                                        </thead>
                                        <tbody id="invoiceBody">

                                        {{--      Invoice Body      --}}

                                        </tbody>
                                    </table>
                                </div><!-- bd -->

                            </div>
                            <div class="card-footer">
                                <div class="d-flex flex-wrap" id="footerInvoice">
                                    <label style="display: block;" class="col-md-6 tx-bold tx-20" id="labelTotal">الإجمالى</label>
                                    <input class="form-control col-md-6" type="text" readonly value="0" id="totalPrice"
                                           style="display: block;">
                                    <button style="display: block;"
                                            class="btn btn-outline-success col-md-5 mr-center mt-2" id="saveInvoice">حفظ
                                    </button>
                                    <button style="display: block;"
                                            class="btn btn-outline-danger col-md-5 mr-center mt-2"
                                            id="cancelInvoice">
                                        إلغاء
                                    </button>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>


    </div>
    <!-- row closed -->

@endsection

@section('scripts')

    <!-- Jquery js-->
    <script src="{{asset('assets/jquery/jquery-3.6.0.min.js')}}"></script>
    <!--Internal  Chart.bundle js -->
    <script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>

    <script>

        const saveInvoice = document.getElementById('saveInvoice');
        const cancelInvoice = document.getElementById('cancelInvoice');
        const invoiceBody = document.getElementById('invoiceBody');
        const totalPrice = document.getElementById('totalPrice');
        const labelTotal = document.getElementById('labelTotal');
        const titleInvoice = document.getElementById('titleInvoice');

        if (totalPrice.value === '0') {
            cancelInvoice.style.display = 'none';
            saveInvoice.style.display = 'none';
        }

        let addColorItemCheck = null;

        function getItemsTypes(id) {

            const addColorItem = document.getElementById('addColorItem' + id);

            if (addColorItemCheck && addColorItemCheck.addColorItem) {
                addColorItemCheck.addColorItem.classList.remove('border-danger');
                addColorItemCheck.addColorItem.classList.remove('text-danger');
                addColorItemCheck = null;
            }

            addColorItem.classList.add('border-danger');
            addColorItem.classList.add('text-danger');
            addColorItemCheck = {addColorItem: addColorItem};

            $.ajax({

                url: '/restaurant_management_system/get-item-types',
                type: 'GET',
                data: {
                    item_id: id
                },
                success: function (response) {
                    $('#itemsTypesSelected').html(response);
                },
                error: function (e) {
                    console.log(e)
                }

            })

        }

        let lastClickItem = null;

        function showInput(id) {

            const amountInput = document.getElementById('amountInput' + id);
            const addToInvoice = document.getElementById('addToInvoice' + id);
            const itemTypeBtn = document.getElementById('itemTypeBtn' + id);

            if (lastClickItem && lastClickItem.amountInput && lastClickItem.addToInvoice && lastClickItem.itemTypeBtn) {

                if (lastClickItem.id === id) {

                    lastClickItem.amountInput.style.display = 'none';
                    lastClickItem.addToInvoice.style.display = 'none';
                    lastClickItem.itemTypeBtn.classList.remove('border-primary');
                    lastClickItem.itemTypeBtn.classList.remove('text-primary');
                    lastClickItem = null;

                } else {

                    lastClickItem.itemTypeBtn.classList.remove('border-primary');
                    lastClickItem.itemTypeBtn.classList.remove('text-primary');
                    lastClickItem.amountInput.style.display = 'none';
                    lastClickItem.addToInvoice.style.display = 'none';
                    itemTypeBtn.classList.add('border-primary');
                    itemTypeBtn.classList.add('text-primary');
                    amountInput.style.display = 'block';
                    amountInput.required = true;
                    amountInput.min = 1;
                    addToInvoice.style.display = 'block';
                    lastClickItem = {
                        id: id,
                        amountInput: amountInput,
                        addToInvoice: addToInvoice,
                        itemTypeBtn: itemTypeBtn
                    }
                }

            } else {

                itemTypeBtn.classList.add('border-primary');
                itemTypeBtn.classList.add('text-primary');
                amountInput.style.display = 'block';
                amountInput.required = true;
                amountInput.min = 1;
                addToInvoice.style.display = 'block';
                lastClickItem = {id: id, amountInput: amountInput, addToInvoice: addToInvoice, itemTypeBtn: itemTypeBtn}

            }

        }

        function addItemToInvoice(id) {

            const amountInput = document.getElementById('amountInput' + id);
            const name = document.getElementById('name' + id);
            const price = document.getElementById('price' + id);

            let totalPriceOld = parseInt(totalPrice.value);

            if (totalPriceOld !== '0') {
                cancelInvoice.style.display = 'block';
                saveInvoice.style.display = 'block';
            }

            if (amountInput.value === '') {
                amountInput.value = 1;
            }

            const row = document.createElement('tr');
            const cell1 = document.createElement('td');
            const cell2 = document.createElement('td');
            const cell3 = document.createElement('td');
            const cell4 = document.createElement('td');
            const actionBtn = document.createElement('td');

            cell1.classList.add('text-center');
            cell2.classList.add('text-center');
            cell3.classList.add('text-center');
            cell4.classList.add('text-center');
            cell4.classList.add('price-cell');
            actionBtn.classList.add('text-center');
            actionBtn.classList.add('delete-button');


            const deleteButton = document.createElement('button');
            deleteButton.classList.add('btn');
            deleteButton.classList.add('btn-sm');
            // deleteButton.classList.add('btn-outline-danger');
            deleteButton.innerHTML = '<i class="las la-trash text-danger tx-18"></i>';

            deleteButton.addEventListener('click', function () {
                deleteRow(this.parentElement.parentElement);
            });

            actionBtn.appendChild(deleteButton);

            cell1.textContent = name.value;
            cell2.textContent = amountInput.value;
            cell3.textContent = price.value;
            cell4.textContent = price.value * amountInput.value;

            row.appendChild(cell1);
            row.appendChild(cell2);
            row.appendChild(cell3);
            row.appendChild(cell4);
            row.appendChild(actionBtn);

            invoiceBody.appendChild(row);
            totalPrice.value = totalPriceOld + (price.value * amountInput.value);

            lastClickItem.amountInput.style.display = 'none';
            lastClickItem.addToInvoice.style.display = 'none';
            lastClickItem.itemTypeBtn.classList.remove('border-primary');
            lastClickItem.itemTypeBtn.classList.remove('text-primary');

        }

        function deleteRow(row) {

            const tbody = row.parentElement;

            const priceCell = row.querySelector('.price-cell');

            const price = parseFloat(priceCell.textContent);

            tbody.removeChild(row);

            if (!isNaN(price)) {
                totalPrice.value -= price;
            }

            if (totalPrice.value === '0') {
                cancelInvoice.style.display = 'none';
                saveInvoice.style.display = 'none';
            }

        }

        saveInvoice.addEventListener('click', function () {

            $.ajax({

                url: '/restaurant_management_system/add-invoice',
                type: 'GET',
                data: {
                    total_price: totalPrice.value
                },
                success: function (response) {

                    cancelInvoice.style.display = 'none';
                    saveInvoice.style.display = 'none';
                    totalPrice.style.display = 'none';
                    labelTotal.style.display = 'none';
                    titleInvoice.style.display = 'none';

                    var header = '<div class="col-md-12 d-flex"> <h3 class="col-md-4 mr-center tx-bold">الإجمالى</h3> <h3 class="col-md-4 mr-center">' + totalPrice.value + ' ج ' + '</h3> </div>'
                    var messageEnd = '<span class="text-center tx-20">مـــطعم مٍــــٌن الأًخٍــــــّر يتمنـــى لـــكم وجــبة ســـعيدة</span><br> <span class="text-center tx-20">ت / 01092338086</span>';
                    var serialNumble = '<span class="text-center mg-l-20">' + response.id + ' # </span><br> <span class="text-center mg-l-20"> {{ auth()->user()->name }} : Cashier</span><br> <span class="text-center mg-l-20">Time : {{ date('d/m/Y h:i') .' '. date('A',strtotime(date('H:i'))) }}</span><br><br>';

                    $(header).appendTo('#footerInvoice');
                    $(messageEnd).appendTo('#messageEnd');
                    $(serialNumble).appendTo('#serialNumble');

                    var printContents = document.getElementById('areaPrint').innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
                    location.reload();

                },
                error: function (e) {
                    console.log(e)
                }

            });

        });

        cancelInvoice.addEventListener('click', function () {
            invoiceBody.innerText = '';
            totalPrice.value = 0;
            cancelInvoice.style.display = 'none';
            saveInvoice.style.display = 'none';
        });

    </script>

@endsection
