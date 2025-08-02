<div>
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">مكتبة الرسائل النصية</li>
        </ol>
    </nav>
    <x-message-admin></x-message-admin>
    <div class="btn-holder">
        <button wire:click='$set("screen","create")' class="main-btn">اضافة <i class="fas fa-plus"></i></button>
    </div>
    @if ($screen == 'index')
        <div class="table-responsive">

            <table class="table main-table" id="prt-content">
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>المحتوي</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($messages as $msg)
                        <tr>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td>
                                {{ $msg->content }}
                            </td>

                            <td>
                                <div class="btn-holder d-flex align-items-center gap-3">
                                    <a href="#showModal{{ $msg->id }}" data-bs-toggle="modal">
                                        <i class="fas fa-eye icon-table"></i>
                                    </a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="showModal{{ $msg->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="showModalLabel">معاينة رسالة</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <table class="table main-table">
                                                            <tbody>
                                                                <tr>
                                                                    <th>المحتوي</th>
                                                                    <td>{{ $msg->content }} </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm px-3"
                                                        data-bs-dismiss="modal">الغاء</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button wire:click='edit({{ $msg->id }})'>
                                        <i class="fas fa-pen text-info icon-table"></i>
                                    </button>
                                    <button wire:click='delete({{ $msg->id }})'>
                                        <i class="fas fa-trash text-danger icon-table"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">لا يوجد رسائل</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @else
        @include('livewire.admin.messages.create')
    @endif
</div>
