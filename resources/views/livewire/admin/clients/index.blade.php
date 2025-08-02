<div class="main-side">
    @if ($screen == 'index')
        <x-admin-alert></x-admin-alert>
        <div class="d-flex align-items-center flex-column flex-xl-row justify-content-between gap-3 mb-3">
            <div class="main-title mb-0 me-auto me-xl-0">
                <div class="small">{{ __('admin.Home') }}</div>
                <div class="large">@lang('Clients')</div>
            </div>

            <div class="filter-options d-flex flex-wrap align-items-center gap-1">
                <div class="inp-holder">
                    <select wire:model.live="filter_country" class="form-select">
                        <option value="">اختر الدولة</option>
                        @foreach (App\Models\Country::all() as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inp-holder">
                    <select wire:model.live="filter_active" id="" class="form-select">
                        <option value="">@lang('Choose status')</option>
                        <option value="active">@lang('Active')</option>
                        <option value="inactive">غير مفعل</option>
                    </select>
                </div>
            </div>

            <div class="box-search">
                <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
                <input type="search" wire:model.live="search" id="" placeholder="@lang(' Search')" />
            </div>
        </div>
        <div class="bar-options d-flex align-items-center justify-content-start flex-wrap gap-1 mb-2">
            <button class="main-btn" wire:click='$set("screen","create")'>@lang('Add') <i
                    class="fas fa-plus"></i></button>
            <button class="main-btn btn-main-color" wire:click='$set("filter_active","")'>@lang('All clients'):
                {{ $allClients->count() }}</button>
            <button class="main-btn" wire:click="$set('filter_active','active')">@lang('Activated clients'):
                {{ \App\Models\User::Clients()->Active()->count() }}</button>
            <button class="main-btn bg-danger" wire:click="$set('filter_active','inactive')">@lang('Unactivated clients'):
                {{ \App\Models\User::Clients()->InActive()->count() }}</button>
        </div>

        <div class="table-responsive">
            <table class="main-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('Photo')</th>
                        <th>@lang('Name')</th>
                        <th>@lang('Phone')</th>
                        <th>@lang('E-Mail Address')</th>
                        <th>الدولة</th>

                        <th>@lang('Active')</th>
                        <th>الاسماء</th>
                        <th class="text-center">@lang('Actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clients as $client)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                @if (!$client->avatar)
                                    <img src="{{ asset('admin-asset/img/no-img.jpg') }}" alt=""
                                        class="img-thumbnail img-preview" width="50">
                                @else
                                    <img src="{{ display_file($client->avatar) }}" alt=""
                                        class="img-thumbnail img-preview" width="50">
                                @endif
                            </td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->email }}</td>

                            <td>{{ $client->country?->name }}</td>

                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" wire:click="toggle({{ $client->id }})"
                                        @checked($client->active) type="checkbox" role="switch" id="">
                                </div>
                            </td>
                            <td>--</td>
                            {{-- <td>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $client->id }}">
                                    {{ $client->contacts()->count() }}
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $client->id }}" tabindex="-1"
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
                                                            @foreach ($client->contacts()->get() as $contact)
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
                                </div>
                            </td> --}}

                            <td>
                                <div class="btn-holder d-flex align-items-center gap-3">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#sendToWhatsapp"
                                        wire:click="clientId({{ $client->id }})">
                                        <img src="{{ asset('admin-asset/img/icons/whatsapp.png') }}"
                                            alt="whatsapp icon" width="20">
                                    </button>
                                    <button class="" wire:click="clientId({{ $client->id }})"
                                        data-bs-target="#send_notification{{ $client->id }}" data-bs-toggle="modal">
                                        <i class="fa fa-bell"></i>
                                    </button>
                                    {{-- <a href="{{ route('admin.clients.show', ['clientId' => $client->id]) }}">
                            <i class="fa fa-eye icon-table"></i>
                            </a> --}}
                                    {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#showModal">
                                <i class="fa fa-eye icon-table"></i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="showModal" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="showModalLabel">معاينة العميل
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive">
                                                <table class="main-table">
                                                    <tr>
                                                        <td>{{__('admin.Name')}}
                    </td>
                    <td>{{ $client->name }}</td>
                </tr>
                <tr>
                    <td>@lang("Phone")</td>
                    <td>{{ $client->phone }}</td>
                </tr>
                <tr>
                    <td>@lang("E-Mail Address")</td>
                    <td>client@client.com</td>
                </tr>
                <tr>
                    <td>المنطقة</td>
                    <td>{{ $client->city?->name }}</td>
                </tr>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">الغاء</button>
</div>
</div>
</div>
</div> --}}
                                    <button type="button" wire:click='edit({{ $client->id }})'>
                                        <i class="fas fa-pen text-info icon-table"></i>
                                    </button>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fas fa-trash text-danger icon-table"></i>
                                    </button>
                                    <div class="modal fade" id="exampleModal" aria-hidden="true">
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
                                                        wire:click='delete({{ $client->id }})'>حذف</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="send_notification{{ $client->id }}"
                                        aria-hidden="true" wire:ignore.self>
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="showModalLabel">ارسال اشعار
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                {{-- <div class="modal-body">
                                            <select wire:model="library_id" class="form-select" id="">
                                                <option>---- {{__('admin.Choose')}} ----</option>
            @foreach (\App\Models\NotificationLibrary::all() as $library)
            <option value="{{$library->id}}">{{$library->content}}</option>
            @endforeach
            </select>

        </div> --}}
                                                <div class="modal-footer">
                                                    <button wire:click="send_notification" type="button"
                                                        class="btn btn-success btn-sm px-3"
                                                        data-bs-dismiss="modal">إرسال</button>
                                                    <button type="button" class="btn btn-secondary btn-sm px-3"
                                                        data-bs-dismiss="modal">الغاء</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </td>
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
            {{ $clients->links() }}
            <!-- Modal -->
            <div class="modal fade" id="sendToWhatsapp" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="showModalLabel">إرسال رسالة عبر الواتس اب
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <textarea wire:model="message" rows="5" class="form-control"></textarea>

                            <div class="form-group">
                                <label for="">@lang('Photo')</label>
                                <input type="file" wire:model="image" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button wire:click="sendToWhatsapp" type="button" class="btn btn-success btn-sm px-3"
                                data-bs-dismiss="modal">إرسال</button>
                            <button type="button" class="btn btn-secondary btn-sm px-3"
                                data-bs-dismiss="modal">الغاء</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @else
        <x-admin-alert></x-admin-alert>
        @include('livewire.admin.clients.createOrUpdate')
    @endif
</div>
