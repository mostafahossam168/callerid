    <div class="modal fade" id="retrieved{{ $order->id }}" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('admin.Invoice_refund') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="refund">{{ __('admin.amount') }}</label>
                        <input type="text" class="form-control" wire:model="refund" id="refund">
                    </div>
                    <div class="mb-2">
                        <label for="refund_status">{{ __('admin.Status') }}</label>
                        <select class="form-control" wire:model="refund_status" id="refund_status">
                            <option value="">{{ __('admin.choose') }}</option>
                            <option value="creditor">{{ __('admin.Creditor') }}</option>
                            <option value="debtor">{{ __('admin.Debtor') }}</option>
                        </select>
                    </div>
                    <div class="alert alert-info m-0 py-2 w-100 " role="alert">
                        - {{ __('admin.Creditor_receiving_an_amount_from_the_customer') }}
                        <br>
                        - {{ __('admin.A_debtor_refunds_the_amount_to_the_customer') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex align-items-center justify-content-between gap-3 m-0 w-100">
                        <div class="d-flex align-items-center justify-content-end gap-1">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('admin.Close') }}</button>
                            <button wire:click='retrieved({{ $order->id }})' type="button" class="btn btn-primary"
                                data-bs-dismiss="modal">{{ __('admin.Yes') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
