<div class="modal fade" id="deleteBond{{ $bond->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body">
                {{-- {{ __('admin.are sure of the deleting process?') }} --}}
                <h5>لايمكنك الحذف بسبب وجود فواتير وعلاقات خاصة بالموظفي في النظام</h5>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger"
                    data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                {{-- <button class="btn btn-sm  btn-success" data-bs-dismiss="modal"
                    wire:click='delete({{ $bond }})'>{{ __('admin.Yes') }}</button> --}}
            </div>

        </div>

    </div>
</div>
