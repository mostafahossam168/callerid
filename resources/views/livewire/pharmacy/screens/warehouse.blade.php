<div class="main-tab-content border-0 pt-3 px-2 pb-0">
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="small-heading mb-0">@lang('Pharmacy warehouses')</h4>
            <div class="alert alert-info m-0" role="alert">
                <i class="fas fa-circle-exclamation"></i>
                @lang('Inventory, dispensing and shipping operations can be followed from the medicines page')
            </div>
            <div class="btn-holder">
                @can('create_pharmacy_warehouse')
                <button wire:click="resetForm" type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createOrUpdate">
                    @lang('Add')
                </button>
                @endcan
            </div>
        </div>
    </div>
    <div class="latestAppointments-content bg-white p-3 rounded-2 shadow">
        <div class="table-responsive ">
            <table class="table main-table table-print">
                <thead>
                    <th>@lang('admin.warehouse')</th>
                    <th>@lang('SubWarehouse')</th>
                    <th>@lang('Number of medications')</th>
                    <th>@lang('pharmaceutical')</th>
                    <th>@lang('actions')</th>
                </thead>
                <tbody>
                    @foreach($warehouses as $warehouse)
                    <tr>
                        <td>{{$warehouse->name}}</td>
                        <td>{{$warehouse->parent->name ?? '--'}}</td>
                        <td>{{$warehouse->pharmacyMedicines->count()}}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{route('front.pharmacy',['screen'=>'medicine','pharmacy_warehouse_id'=>$warehouse->id])}}" class="btn btn-success btn-sm">@lang('Show')</a>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center gap-1 text-nowrap">
                                @can('update_pharmacy_warehouse')

                                <button data-bs-toggle="modal" wire:click="setData({{$warehouse->id}})" data-bs-target="#createOrUpdate" class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i></button>
                                @endcan
                                @can('delete_pharmacy_warehouse')

                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete{{$warehouse->id}}">
                                    <i class="fas fa-trash "></i>
                                </button>
                                @include('deleteModal',['item' => $warehouse])
                                @endcan
                            </div>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="createOrUpdate" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('Add warehouse')</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="collectData-box mb-2">
                                <label for="" class="small-label mb-1">@lang('Name')</label>
                                <input type="text" id="" wire:model="name" class="w-100 form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="collectData-box mb-2">
                                <label for="" class="small-label mb-1"> @lang('The main store')(@lang('optional'))</label>
                                <select wire:model="parent_id" class="w-100 form-select" id="">
                                    <option value="">@lang('Select the main store')</option>
                                    @foreach($parents as $parent)
                                    <option value="{{$parent->id}}">{{$parent->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm px-4" data-bs-dismiss="modal">@lang('back')</button>
                    <button wire:click="save" data-bs-dismiss="modal" class="btn btn-success btn-sm px-4">@lang('Save')</button>
                </div>
            </div>
        </div>
    </div>
</div>
