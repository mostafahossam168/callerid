<div class="main-tab-content border-0 pt-3 px-2 pb-0">
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="small-heading mb-0">@lang('Latest medicines')</h4>
            @can('create_pharmacy_medicine')
                <div class="d-flex">
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                        data-bs-target="#createOrUpdate">
                        @lang('Add')
                    </button>
                </div>
            @endcan
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="createOrUpdate" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('Add medication')</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info text-center">
                        @lang('The name of the medication must be written along with the concentration strength')
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="collectData-box mb-2">
                                <label for="" class="small-label mb-1">اسم التجاري | Trade name <small
                                        class="text-danger">*</small></label>
                                <input wire:model="name" type="text" id="" class="w-100 form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="collectData-box mb-2">
                                <label for="" class="small-label mb-1">الاسم العلمي | Scientific name <small
                                        class="text-danger">*</small></label>
                                <input wire:model="scientific_name" type="text" id=""
                                    class="w-100 form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="collectData-box mb-2">
                                <label for="" class="small-label mb-1">الباركود | Barcode <small
                                        class="text-danger">*</small></label>
                                <input wire:model="barcode" type="text" id="" class="w-100 form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="collectData-box mb-2">
                                <label for="" class="small-label mb-1">النوع | Type <small
                                        class="text-danger">*</small></label>
                                <select wire:model="pharmacy_type_id" class="w-100 form-select" id="">
                                    <option value="">@lang('Choose Type')</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="collectData-box mb-2">
                                <label for="" class="small-label mb-1">الخطورة | Dangerous <small
                                        class="text-danger">*</small></label>
                                <select wire:model="pharmacy_dangerous_id" class="w-100 form-select" id="">
                                    <option value="">@lang('Choose the risk')</option>
                                    @foreach ($dangers as $danger)
                                        <option value="{{ $danger->id }}">{{ $danger->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="collectData-box mb-2">
                                <label for="" class="small-label mb-1">المخزن | Warehouse <small
                                        class="text-danger">*</small></label>
                                <select wire:model="pharmacy_warehouse_id" class="w-100 form-select" id="">
                                    <option value="">@lang('Select the Warehouse')</option>
                                    @foreach (\App\Models\PharmacyWarehouse::get() as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="collectData-box mb-2">
                                <label for="" class="small-label mb-1">رصيد الافتتاح | Opening balance <small
                                        class="text-danger">*</small></label>
                                <input type="number" wire:model="opening_balance" id=""
                                    class="w-100 form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="collectData-box mb-2">
                                <label for="" class="small-label mb-1">سعر الشراء | Purchasing price <small
                                        class="text-danger">*</small></label>
                                <input type="number" wire:model="purchasing_price" id=""
                                    class="w-100 form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="collectData-box mb-2">
                                <label for="" class="small-label mb-1">سعر البيع | Selling price <small
                                        class="text-danger">*</small></label>
                                <input type="number" wire:model="selling_price" id=""
                                    class="w-100 form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="collectData-box mb-2">
                                <label for="" class="small-label mb-1">تاريخ الانتهاء | Expiry date</label>
                                <input type="date" wire:model="expiry_date" id=""
                                    class="w-100 form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="collectData-box mb-2">
                                <label for="" class="small-label mb-1">الرقم التشغيلي | Operational
                                    number</label>
                                <input class="form-control" disabled type="text"
                                    value="{{ \App\Models\PharmacyMedicine::max('operational_number') ? \App\Models\PharmacyMedicine::max('operational_number') + 1 : 5000 }}"
                                    placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">@lang('back')</button>
                    <button wire:click="save" data-bs-dismiss="modal"
                        class="btn btn-success">@lang('Save')</button>
                </div>
            </div>
        </div>
    </div>
    <div class="latestAppointments-content bg-white p-3 rounded-2 shadow">
        <div class="btn-holder mb-2">
            <button wire:click="$set('filter','')" class="btn btn-sm btn-info">@lang('All') :
                {{ \App\Models\PharmacyMedicine::count() }}</button>
            <button wire:click="$set('filter','expired')" class="btn btn-sm btn-danger">@lang('Expiration') :
                {{ \App\Models\PharmacyMedicine::where('expiry_date', '<', date('Y-m-d'))->count() }}</button>
            <button wire:click="$set('filter','zero_quantity')" class="btn btn-sm btn-secondary">@lang('Expired quantities') :
                {{ $quantityZeroMedicines }}</button>
        </div>
        <div class="table-responsive">
            <table class="table main-table">
                <thead>
                    <th>#</th>
                    <th>@lang('Trade name')</th>
                    <th>@lang('Scientific name')</th>
                    <th>@lang('admin.Type')</th>
                    <th>@lang('Danger')</th>
                    <th>@lang('Opening balance')</th>
                    <th>@lang('Current quantity')</th>
                    <th>@lang('Expenses')</th>
                    <th>@lang('Purchasing price')</th>
                    <th>@lang('Selling price')</th>
                    <th>@lang('Expiry date')</th>
                    <th>@lang('actions')</th>
                </thead>
                <tbody>
                    @foreach ($medicines as $medicine)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $medicine->name }}</td>
                            <td>{{ $medicine->scientific_name }}</td>
                            <td>{{ $medicine->type?->name }}</td>
                            <td>{{ $medicine->dangerous?->name }}</td>
                            <td>{{ $medicine->opening_balance }}</td>
                            <td>{{ $medicine->quantities()->charge()->sum('quantity') - $medicine->quantities()->expense()->sum('quantity') }}
                            </td>
                            <td>--</td>
                            <td>{{ $medicine->purchasing_price }}</td>
                            <td>{{ $medicine->selling_price }}</td>
                            <td>{{ $medicine->expiry_date }}</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    @can('inventory_movement_items')
                                        <a href="{{ route('front.medicine.quantities.show', $medicine->id) }}"
                                            class="btn text-nowrap btn-sm btn-secondary">
                                            {{ __('admin.Inventory Movement') }}
                                        </a>

                                        <button type="button" class="btn btn-sm btn-info"
                                            wire:click="ItemId({{ $medicine->id }})" data-bs-toggle="modal"
                                            data-bs-target="#quantities">
                                            {{ __('admin.quantities') }}
                                        </button>
                                    @endcan

                                    @can('charge_items')
                                        <button type="button" wire:click="ItemId({{ $medicine->id }})"
                                            class="btn btn-sm btn-success" data-bs-toggle="modal"
                                            data-bs-target="#charge">
                                            {{ __('admin.charge') }}
                                        </button>
                                    @endcan

                                    @can('expense_items')
                                        <button type="button" wire:click="ItemId({{ $medicine->id }})"
                                            class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#expense">
                                            {{ __('admin.expense') }}
                                        </button>
                                    @endcan
                                    <div class="dropdown drop-table dropend">
                                        <button class="btn btn-outline-secondary btn-sm" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu" style="list-style:none;">
                                            <li>
                                                @can('update_pharmacy_medicine')
                                                    <button data-bs-toggle="modal"
                                                        wire:click="setData({{ $medicine->id }})"
                                                        data-bs-target="#createOrUpdate"
                                                        class="dropdown-item text-center">
                                                        <i class="fa-solid fa-pen-to-square text-dark"></i>
                                                        @lang('Edit')
                                                    </button>
                                                @endcan
                                            </li>
                                            <li>
                                                @can('delete_pharmacy_medicine')
                                                    <button type="button" class="dropdown-item text-center text-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $medicine->id }}">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                        @lang('Delete')
                                                    </button>
                                                @endcan
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @include('deleteModal', ['item' => $medicine])

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="charge" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('admin.charge') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-gap-24">
                            <div class=" col-sm-12">
                                <label class="small-label" for="">{{ __('admin.the_quantity') }}</label>
                                <input class="form-control" type="text" wire:model.defer='quantity'
                                    placeholder="">
                            </div>
                            <div class="col-sm-12">
                                <label class="small-label" for="">الرجاء اختيار المستودع المراد شحنه</label>
                                <select wire:model="pharmacy_warehouse_id" class="form-control">
                                    <option value="">@lang('Choose')</option>
                                    @foreach (\App\Models\PharmacyWarehouse::get() as $warehouse)
                                        <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" col-sm-12">
                                <label class="small-label" for="">@lang('Operational number')</label>
                                <input class="form-control" disabled type="text"
                                    value="{{ \App\Models\PharmacyQuantity::max('operational_number') ? \App\Models\PharmacyQuantity::max('operational_number') + 1 : 5000 }}"
                                    placeholder="">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            data-bs-dismiss="modal">{{ __('admin.Close') }}</button>
                        <button wire:click='charge' class="btn btn-primary"
                            data-bs-dismiss="modal">{{ __('admin.save') }}</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="expense" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('admin.expense') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-gap-24">
                            <div class=" col-sm-12">
                                <label class="small-label" for="">{{ __('admin.the_quantity') }}</label>
                                <input class="form-control" type="text" wire:model.defer='quantity'
                                    placeholder="">
                            </div>
                            <div class="col-sm-12">
                                <label class="small-label" for="">{{ __('admin.from_warehouse') }}</label>
                                <select wire:model="from_warehouse_id" class="form-control">
                                    <option value="">@lang('Choose')</option>
                                    @foreach (\App\Models\PharmacyWarehouse::get() as $warehouse)
                                        <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-sm-12">
                                <label class="small-label" for="">{{ __('admin.to_warehouse') }}</label>
                                <select wire:model="to_warehouse_id" class="form-control">
                                    <option value="">@lang('Choose')</option>
                                    @foreach (\App\Models\PharmacyWarehouse::get() as $warehouse)
                                        <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            data-bs-dismiss="modal">{{ __('admin.Close') }}</button>
                        <button wire:click='expense' class="btn btn-primary"
                            data-bs-dismiss="modal">{{ __('admin.save') }}</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="quantities" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('admin.quantities') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>@lang('warehouse')</th>
                                <th>@lang('quantity')</th>
                            </tr>
                            @php
                                $sum_quantity = 0;
                            @endphp
                            @foreach (\App\Models\PharmacyWarehouse::get() as $warehouse)
                                @php
                                    $quantity =
                                        $obj
                                            ?->quantities()
                                            ->where('pharmacy_warehouse_id', $warehouse->id)
                                            ->where('type', 'charge')
                                            ->sum('quantity') -
                                        $obj
                                            ?->quantities()
                                            ->where('from_warehouse_id', $warehouse->id)
                                            ->where('type', 'expense')
                                            ->sum('quantity') -
                                        \App\Models\InvoiceItem::where('pharmacy_medicine_id', $obj?->id)->sum(
                                            'quantity',
                                        );
                                    $sum_quantity += $quantity;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $warehouse->name }}</td>
                                    <td>
                                        {{ $quantity }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="2">@lang('admin.total')</th>
                                <th>{{ $sum_quantity }}</th>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            data-bs-dismiss="modal">{{ __('admin.Close') }}</button>
                        <button wire:click='expense' class="btn btn-primary"
                            data-bs-dismiss="modal">{{ __('admin.save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
