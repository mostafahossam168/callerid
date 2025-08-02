<section class="main-section users">
    <x-alert></x-alert>
    <div class="container">
        <div class="d-flex mb-3 gap-3 align-items-center ">
            <h4 class="main-heading m-0">{{ __('admin.Purchases') }}</h4>
        </div>
        <div class="section-content p-4 bg-white rounded-3 shadow">
            <div class="row">
                <div class="col-md-4">
                    <div class="d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">{{ __('Warehouse') }}</label>
                        <select wire:model="warehouse_id" id="warehouse_id" class="form-select">
                            <option value="">اختر المستودع</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">{{ __('Supplier') }}</label>
                        <select wire:model="supplier_id" id="supplier_id" class="form-select">
                            <option value="">اختر المورد</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="col-12 mt-3 mb-3">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="50%">@lang('admin.Product_name')</th>
                                <th>@lang('admin.the_quantity')</th>
                                <th>@lang('admin.cost_price')</th>
                                <th>@lang('admin.sell_price')</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div wire:ignore>
                                            <select data-pharaonic="select2" data-component-id="{{ $this->id }}"
                                                data-dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}"
                                                id="select{{ $index }}"
                                                wire:model="items.{{ $index }}.item_id">
                                                <option value="">@lang('admin.Choose the product')</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control"
                                            wire:model="items.{{ $index }}.quantity" wire:keyup="calculateTotal">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control"
                                            wire:model="items.{{ $index }}.cost_price"
                                            wire:keyup="calculateTotal">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control"
                                            wire:model="items.{{ $index }}.sell_price">
                                    </td>
                                    <td>
                                        @if ($index == 0)
                                            <button class="btn btn-success btn-sm" wire:click="addItem"><i
                                                    class="fa fa-plus"></i></button>
                                        @endif
                                        @if ($index > 0)
                                            <button class="btn btn-danger btn-sm"
                                                wire:click="removeItem({{ $index }})"><i
                                                    class="fa fa-trash"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="col-md-4">
                    <div class="d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">{{ __('admin.amount') }}</label>
                        <input type="text" wire:model.defer="amount" disabled class="w-100 form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">{{ __('admin.tax') }}</label>
                        <input type="text" wire:model.defer="tax" disabled class="w-100 form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">{{ __('admin.total') }}</label>
                        <input type="text" wire:model.defer="total" disabled class="w-100 form-control">
                    </div>
                </div>

                <div class="col-md-12">
                    <button class="btn btn-sm  btn-success" data-bs-dismiss="modal"
                        wire:click='save'>{{ __('admin.Save') }}</button>
                </div>
            </div>
        </div>
    </div>
</section>
@push('css')
    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>
@endpush
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
