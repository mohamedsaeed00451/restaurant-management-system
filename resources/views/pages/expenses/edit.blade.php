<!-- Modal effects -->
<div class="modal fade" id="edit{{ $expense->id }}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل عامل</h6>
                <button aria-label="Close" class="close"
                        data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('expenses.update',$expense->id) }}" method="post" autocomplete="off">
                {{ method_field('patch') }}
                @csrf
                <div class="modal-body">

                    <div class="col">
                        <div class="form-group mg-b-0">
                            <label class="form-label">الإسم</label>
                            <textarea class="form-control" name="name"
                                      placeholder="الإسم" type="text" required="" rows="3">{{ $expense->name }}</textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mg-b-0">
                            <label class="form-label">السعر</label>
                            <input class="form-control" name="price"
                                   placeholder="السعر" type="number" required="" value="{{ $expense->price }}">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" type="submit">تعديل</button>
                    <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">إلغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal effects-->
