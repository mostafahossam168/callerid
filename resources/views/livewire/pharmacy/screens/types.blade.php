<div class="main-tab-content border-0 pt-3 px-2 pb-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="small-heading mb-3">@lang('Types')</h4>
        <div class="d-flex">
            @can('create_pharmacy_types')
                <button wire:click="resetForm" type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                        data-bs-target="#type">
                    @lang('Add')
                </button>
            @endcan
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="type" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('Add type')</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="collectData-box mb-2">
                                <label for="" class="small-label mb-1">@lang('name')</label>
                                <input wire:model="name" type="text" id="" class="w-100 form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('back')</button>
                    <button wire:click="save" data-bs-dismiss="modal" class="btn btn-success">@lang('Save')</button>
                </div>
            </div>
        </div>
    </div>
    <div class="latestAppointments-content bg-white p-3 rounded-2 shadow">
        <div class="table-responsive">
            <table class="table main-table">
                <thead>
                <th>#</th>
                <th>@lang('Save')</th>
                <th>@lang('actions')</th>
                </thead>
                <tbody>
                @foreach($types as $type)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$type->name}}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                @can('update_pharmacy_types')
                                    <button data-bs-toggle="modal" wire:click="setData({{$type->id}})"
                                            data-bs-target="#type" class="btn btn-info btn-sm"><i
                                            class="fa-solid fa-pen"></i></button>
                                @endcan
                                @can('delete_pharmacy_types')
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#delete{{$type->id}}">
                                        <i class="fas fa-trash "></i>
                                    </button>
                                    @include('deleteModal',['item' => $type])
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
