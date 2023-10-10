<!-- Modal effects -->
<div class="modal fade" id="delete{{ $item->id }}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف مأكولات</h6>
                <button aria-label="Close" class="close"
                        data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('items.destroy',$item->id) }}" method="post">
                {{ method_field('delete') }}
                @csrf
                <div class="modal-body">
                    <h3 class="text-danger">هل أنت متأكد من عملية الحذف ؟</h3>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-danger" type="submit">حذف</button>
                    <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">إلغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal effects-->
