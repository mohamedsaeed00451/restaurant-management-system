<div class="text-center tx-bold mb-2 tx-20">الأصناف</div>
<div class="d-flex flex-wrap">

    @forelse($item_types as $itemType)

        <div class="col-md-4">

            <input type="hidden" class="card-text text-center" id="name{{$itemType->id}}" value="{{ $itemType->name }}">
            <input type="hidden" class="card-text text-center" id="price{{$itemType->id}}" value="{{ $itemType->price }}">
            <button class="col-md-12 card text-center tx-bold" id="itemTypeBtn{{$itemType->id}}" type="submit"
                    onclick="showInput( {{$itemType->id}} )">
                <div class="card-body text-center">
                    <div class="card-text text-center">{{ $itemType->name }}</div>
                    <div class="card-text text-center">{{ number_format($itemType->price,2) }} ج</div>
                </div>
            </button>

            <div class="form-group">

                <input class="form-control" name="amount" type="number" id="amountInput{{ $itemType->id }}"
                       style="display: none;"
                       value="1" placeholder="ادخل الكمية" autofocus>

                <button style="display: none;" type="button" class="w-100 btn btn-outline-success"
                        id="addToInvoice{{ $itemType->id }}" onclick="addItemToInvoice( {{ $itemType->id }} )">إضافة
                </button>

            </div>


        </div>
    @empty

        <span class="text-center text-danger tx-bold">لا يوجد أصناف</span>

    @endforelse

</div>


