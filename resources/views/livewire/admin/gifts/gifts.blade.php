<div class="main-side">
    <x-admin-alert></x-admin-alert>
    @if ($screen == 'index')
        <div class="d-flex align-items-center flex-column flex-xl-row justify-content-between gap-3 mb-3">
            <div class="main-title mb-0 me-auto me-xl-0">
                <div class="small">{{ __('admin.Home') }}</div>
                <div class="large"> جرب حظك</div>
            </div>

            <div class="box-search">
                <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
                <input type="search" wire:model.live="search" id="" placeholder="@lang(' Search')" />
            </div>
        </div>
        <div class="bar-options d-flex align-items-center justify-content-start flex-wrap gap-1 mb-2">
            <button class="main-btn" wire:click='$set("screen","create")'>@lang('Add') <i
                    class="fas fa-plus"></i></button>
            <button class="main-btn btn-main-color" wire:click='$set("filter_status","")'>@lang('All gifts'):
                {{ \App\Models\Gift::count() }}</button>
            <button class="main-btn" wire:click="$set('filter_status','active')">@lang('Activated gifts'):
                {{ \App\Models\Gift::Active()->count() }}</button>
            <button class="main-btn bg-danger" wire:click="$set('filter_status','inactive')">@lang('Unactivated gifts'):
                {{ \App\Models\Gift::InActive()->count() }}</button>
        </div>

        <div class="table-responsive">
            <table class="main-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('Name')</th>
                        <th>السعر</th>
                        <th>الكود</th>
                        <th>الفائز</th>
                        <th>مفتوح</th>
                        <th>@lang('Active')</th>
                        <th class="text-center">@lang('Actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($gifts as $gift)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $gift->name }}</td>
                            <td>{{ (int) $gift->amount }}</td>
                            <td>{{ $gift->code }}</td>
                            <td>{{ $gift->device_id }}</td>
                            <td>
                                @if ($gift->opened)
                                    نعم
                                @else
                                    لا
                                @endif
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" wire:click="toggle({{ $gift->id }})"
                                        @checked($gift->status) type="checkbox" role="switch" id="">
                                </div>
                            </td>


                            <td>
                                <div class="btn-holder d-flex align-items-center gap-3">
                                    <button type="button" wire:click='edit({{ $gift->id }})'>
                                        <i class="fas fa-pen text-info icon-table"></i>
                                    </button>
                                    <button type="button" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $gift->id }}">
                                        <i class="fas fa-trash text-danger icon-table"></i>
                                    </button>
                                    <div class="modal fade" id="exampleModal{{ $gift->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">حذف </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    هل انت متأكد من الحذف؟
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm px-3"
                                                        data-bs-dismiss="modal">الغاء</button>
                                                    <button data-bs-dismiss="modal" class="btn btn-danger btn-sm px-3"
                                                        wire:click='delete({{ $gift->id }})'>حذف</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan='6' class="text-center">
                                <div class="alert alert-warning mb-0">
                                    @lang('No results')
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $gifts->links() }}
        </div>
    @else
        @include('livewire.admin.gifts.createOrUpdate')
    @endif
</div>
