<div class="main-side">
    @section('title', 'سند قبض')
    <x-admin-alert></x-admin-alert>

    <div class="main-title mb-0 me-auto me-xl-0">
        <div class="small">{{ __('admin.Home') }}</div>
        <div class="large">سند قبض</div>
    </div>

    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="card-title text-white">سند قبض</h3>
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
                        <label class="form-label">اختر العميل</label>
                        <select class="form-select" wire:model="office_id">
                            <option value="">اختر العميل</option>
                            @foreach ($offices as $office)
                                <option value="{{ $office->id }}">{{ $office->name }}</option>
                            @endforeach
                        </select>
                        @error('office_id')
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
                        <label class="form-label">طريقة الدفع</label>
                        <select class="form-select" wire:model="payment_method">
                            <option value="">اختر طريقة الدفع</option>
                            <option value="cash">كاش</option>
                            <option value="bank">تحويل بنكي</option>
                        </select>
                        @error('payment_method')
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


@push('before_livewire')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push('js')
    <script>
        $('.select2').select2();

        $('#office_id').on('change', function(e) {
            @this.set('office_id', e.target.value);
        });
    </script>
@endpush
