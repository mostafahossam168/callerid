<div class="main-tab-content border-0 pt-3 px-2 pb-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="small-heading mb-3">@lang('Danger')</h4>
        @can('read_pharmacy_dangerous')
            <div class="d-flex">
                <button wire:click="resetForm" type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                        data-bs-target="#createOrUpdate">
                    @lang('Add')
                </button>
            </div>
        @endcan

    </div>
    <div wire:ignore.self class="modal fade" id="createOrUpdate" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('Add risk')</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="collectData-box mb-2">
                            <label for="" class="small-label mb-1">@lang('name')</label>
                            <input wire:model="name" type="text" id="" class="w-100 form-control">
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
                <th>@lang('name')</th>
                <th>@lang('admin.medicines')</th>
                <th>@lang('actions')</th>
                </thead>
                <tbody>
                @foreach($dangers as $danger)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$danger->name}}</td>
                        <td><a href="{{route('front.pharmacy',['screen' =>'medicine','danger_id' =>$danger->id])}}" class="btn btn-sm btn-purple">{{$danger->pharmacyMedicines->count()}}</a></td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                @can('update_pharmacy_dangerous')
                                    <button data-bs-toggle="modal" wire:click="setData({{$danger->id}})"
                                            data-bs-target="#createOrUpdate" class="btn btn-info btn-sm"><i
                                            class="fa-solid fa-pen"></i></button>
                                @endcan
                                @can('delete_pharmacy_dangerous')
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#delete{{$danger->id}}">
                                        <i class="fas fa-trash "></i>
                                    </button>
                                    @include('deleteModal',['item' => $danger])
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
