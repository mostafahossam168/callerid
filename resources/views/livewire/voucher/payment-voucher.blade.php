<section id="app" class="main-section">
    <div class="container">
        <h4 class="main-heading mb-4">
            سند صرف
        </h4>
        <x-message-admin></x-message-admin>
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title text-white">سند صرف</h3>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-3 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">التاريخ</label>
                            <input type="date" class="form-control" wire:model="date">
                            @error('date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">اختر الحساب المصروف إليه</label>
                            <div wire:ignore>
                                <select data-pharaonic="select2" data-component-id="{{ $this->id }}" id="account"
                                    class="form-select" wire:model="account_id">
                                    <option value="">اختر الحساب</option>
                                    @foreach ($accounts as $account)
                                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('account_id')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">المبلغ</label>
                            <input type="text" class="form-control" wire:model="amount">
                            @error('amount')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-3 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">طريقة الصرف</label>
                            <select class="form-select" wire:model="payment_method_id">
                                <option value="">اختر طريقة الصرف</option>
                                @foreach ($payment_methods as $payment_method)
                                    <option value="{{ $payment_method->id }}">{{ $payment_method->name }}</option>
                                @endforeach
                            </select>
                            @error('payment_method_id')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">الوصف</label>
                            <textarea class="form-control" rows="5" wire:model="description"></textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-end">
                <button wire:loading.remove class="btn btn-primary" wire:click="save"> حفظ</button>

            </div>
        </div>

    </div>
</section>

{{--
@push('js')
    <x:pharaonic-select2::scripts />
    <script>
        document.addEventListener('livewire:load', function() {
            $('select[data-pharaonic="select2"]').select2({
                placeholder: "@lang('Select an option')",
            });
        });
    </script>
@endpush
--}}
