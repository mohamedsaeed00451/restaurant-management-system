<!-- Modal effects -->
<div class="modal fade" id="create">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">إضافة صنف</h6>
                <button aria-label="Close" class="close"
                        data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('items-types.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="modal-body">

                    <div class="col">
                        <div class="form-group mg-b-0">
                            <label class="form-label">الإسم</label>
                            <input class="form-control" name="name"
                                   placeholder="الإسم" type="text" required="" max="100">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mg-b-0">
                            <label class="form-label">السعر</label>
                            <input class="form-control" name="price"
                                   placeholder="السعر" type="number" required="">
                        </div>
                    </div>

                    <div class="col">
                        <p class="mg-b-10">المأكولات</p>
                        <select name="item_id" class="form-control" required="">
                            <option value="" selected>
                                -- إختر من القائمة --
                            </option>
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}"> {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" type="submit">حفظ</button>
                    <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">إلغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal effects-->
