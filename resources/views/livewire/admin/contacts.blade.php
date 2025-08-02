<div class="main-side">

    <x-admin-alert></x-admin-alert>
    <div class="d-flex align-items-center flex-column flex-xl-row justify-content-between gap-3 mb-3">
        <div class="main-title mb-0 me-auto me-xl-0">
            <div class="small">{{ __('admin.Home') }}</div>
            <div class="large">جهات الاتصال</div>
        </div>
        <div class="box-search">
            <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
            <input type="search" wire:model.live="search" id="" placeholder="@lang(' Search')" />
        </div>
    </div>
    <div class="bar-options d-flex align-items-center justify-content-start flex-wrap gap-1 mb-2">
        <button class="main-btn btn-main-color" wire:click='$set("filter_active","")'>كل جهات الاتصال:
            {{ \App\Models\Contact::count() }}</button>
        <div class="bar-options d-flex align-items-center justify-content-start flex-wrap gap-1 mb-2">
            <button wire:click="export" class="main-btn btn-main-color" wire:click='$set("filter_active","")'>تصدير كل
                جهات
                الاتصال:
            </button>
        </div>

        <div class="table-responsive">
            <table class="main-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الجوال</th>
                        <th>الاسم</th>
                        {{-- <th>الاسماء</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contacts as $contact)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $contact->phone_number }}</td>
                            <td>
                                {{ $contact->contactNames()->first()?->name }}
                                {{-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $contact->id }}">
                                {{ $contact->contactNames()->count() }}
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $contact->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">الاسماء</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive">
                                                <table class="main-table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>الاسم</th>
                                                            <th>التحكم</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($contact->contactNames()->get() as $contact)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $contact->name }}</td>
                                                                <td>
                                                                    <div class="d-flex gap-2">
                                                                        <button class="btn btn-sm btn-danger"
                                                                            data-bs-dismiss="modal"
                                                                            wire:click="deleteContact({{ $contact->id }})">
                                                                            <i class="fa-solid fa-trash"></i>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">رجوع</button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            </td>
                            {{-- <td>{{ $contact->contactNames()->count() }}</td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan='12' class="text-center">
                                <div class="alert alert-warning mb-0">
                                    @lang('No results')
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $contacts->links() }}

        </div>
    </div>
