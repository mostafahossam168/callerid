<div class="main-side">
    <div class="main-title">
        <div class="small">@lang('admin.Home')</div>
        <div class="large">@lang('admin.gifts')</div>
    </div>
    <x-admin-alert></x-admin-alert>


    <div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-update">
            @lang('admin.Add')
        </button>
    </div>
    <div class="table-responsive">
        <table class="main-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('admin.Name')</th>
                    <th>@lang('admin.code')</th>
                    <th>@lang('admin.status')</th>
                    <th>@lang('admin.Actions')</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($gifts as $gift)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $gift->name }}</td>
                        <td>{{ $gift->code }}</td>
                        <td>
                            <span class="badge {{ $gift->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $gift->status == 1 ? 'مفعل' : 'غير مفعل' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-3">
                                <button title="@lang('admin.Edit')" data-bs-toggle="modal" data-bs-target="#create-update" class="btn btn-sm btn-info" type="button"
                                    wire:click="edit({{ $gift->id }})"><i></i>
                                    <i class="fa fa-edit  icon-table"></i>
                                </button>
                                <x-delete-modal :item="$gift" />
                            </div>
                        </td>
                    </tr>
                @empty
                @endforelse

            </tbody>
        </table>
    </div>

    @include('livewire.admin.gifts.create-update')

</div>
