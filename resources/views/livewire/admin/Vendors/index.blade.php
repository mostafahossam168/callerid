    <div class="main-side">
        <x-admin-alert />
        @if($screen == 'index')

        <div class="main-title">
            <div class="small">@lang("Home")</div>
            <div class="large">مزود الخدمة</div>
        </div>
        <div class="bar-options d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
            <div class="btn-holder">
                <a wire:click="$set('screen','create')" class="main-btn">@lang("Add")</a>
            </div>
            <div class="box-search">
                <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
                <input type="search" id="" placeholder="@lang("Search")" />
            </div>
        </div>
        <div class="table-responsive">
            <table class="main-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang("Photo") </th>
                        <th>@lang("Name") </th>
                        <th>@lang("Phone") </th>
                        <th>البريد الالكتروني</th>
                        <th>@lang("Status")</th>
                        <th>@lang("Actions")</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><img src="{{ display_file($user->image) }}" width="50"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="" wire:click='toggle({{ $user->id }})' @checked($user->active)>
                            </div>
                        </td>
                        <td>
                            <div class="table-btns">
                                <button title="تعديل" type="button" wire:click="edit({{ $user->id }})"><i></i>
                                    <i class="fa fa-edit text-info icon-table"></i>
                                </button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fas fa-trash text-danger icon-table"></i>
                                </button>

                            </div>
                        </td>
                    </tr>
                    <div class="modal fade" id="exampleModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">حذف </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    هل انت متأكد من الحذف؟
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">الغاء</button>
                                    <button data-bs-dismiss="modal" class="btn btn-danger btn-sm px-3" wire:click='delete({{ $user->id }})'>حذف</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        @include('livewire.admin.Vendors.createOrUpdate')
        @endif
    </div>
