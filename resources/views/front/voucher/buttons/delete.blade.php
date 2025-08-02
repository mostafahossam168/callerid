<div class="modal fade" id="delete{{ $paymentVoucher->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف سند صرف {{ $paymentVoucher->title }}</h5>
                <button type="button" class="btn-close ms-0 me-auto" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                هل أنت متأكد من حذف سند الصرف {{ $paymentVoucher->title }}
            </div>
            <div class="modal-footer">
                <!-- delete payment-voucher form -->
                <form action="{{ route('front.payment-vouchers.destroy', $paymentVoucher->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">لا</button>
                    <button class="btn btn-sm btn-primary" type="submit">نعم</button>
                </form>
            </div>

            </form>
        </div>
    </div>
</div>
