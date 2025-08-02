<section class="main-section users">
    <x-alert></x-alert>

    <div class="container" id="data-table">
        @if ($screen == 'index')
            <div class="d-flex align-items-center felx-wrap justify-content-between mb-3 flex-wrap gap-2">
                <h4 class="main-heading mb-0 ">{{ __('admin.pharmacy_requests') }}</h4>
                <div class="btn-holder d-flex gap-2 w-55 text-end">
                    <button class="btn btn-success btn-sm">المصروفات:
                        {{ $requests->where('status', 'paid')->count() }}</button>
                    <button class="btn btn-warning btn-sm">الانتظار:
                        {{ $requests->where('status', 'pending')->count() }}</button>
                </div>
            </div>
            <div class="bg-white shadow p-4 rounded-3">
                <div
                    class="amountPatients-holder mb-2 d-flex gap-2 align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
                    <div class="col-6">
                        <input type="text" wire:model="search" class="form-control"
                            placeholder="بحث بالرقم الطبي أو رقم الهوية أو الجوال">
                    </div>
                    <div class="flex-fill alert alert-warning text-center m-0 py-2">
                        يمكن تحديد الادوية التي تصرف فقط
                    </div>
                    <div class="btn-holders">
                        <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning py-1">
                            <i class="fa-solid fa-print"></i>
                        </button>
                    </div>
                </div>

                <div class="">

                    <div class="table-responsive">
                        <table id="prt-content" class="table main-table">
                            <thead>
                                <tr>
                                    <th>رقم الطلب</th>
                                    <th>{{ __('admin.index') }}</th>
                                    <th>{{ __('patient') }}</th>
                                    <th>{{ __('the Doctor') }}</th>
                                    <th>{{ __('section') }}</th>
                                    <th>{{ __('admin.medicines') }}</th>
                                    <th>{{ __('admin.notes') }}</th>
                                    <th>{{ __('admin.status') }}</th>
                                    <th class="not-print">صرف</th>
                                    <th>{{ __('admin.Date') }}</th>
                                    <th class="text-center not-print">{{ __('admin.managers') }}</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($requests as $request)
                                    <tr>
                                        <td>{{ $request->id }}</td>
                                        <td>{{ $request->patient?->id }}</td>
                                        <td>{{ $request->patient?->name }}</td>
                                        <td>{{ $request->doctor?->name }}</td>
                                        <td>{{ $request->clinic?->name }}</td>
                                        {{-- <td>{{ $request->room?->name }}</td> --}}
                                        <td>
                                            <table class="w-100">
                                                @php
                                                    $ids = array_keys(collect($request->drugs)->toArray());
                                                    $paid = collect($request->paid_drugs)
                                                        ->pluck('id')
                                                        ->toArray();

                                                    $not = array_diff($ids, $paid);
                                                @endphp
                                                @if ($request->paid_drugs)
                                                    @if (count($not) > 0)

                                                        <tr>
                                                            <th colspan="2">الأدوية الغير مصروفة</th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="2">{{ __('admin.medicine') }}</th>
                                                            {{-- <th>{{ __('admin.quantity') }}</th> --}}
                                                        </tr>
                                                        @foreach ($not as $index => $item)
                                                            @php
                                                                $medicine = \App\Models\Medicine::find($item);

                                                            @endphp

                                                            <tr>
                                                                <td colspan="2" width="60%">
                                                                    {{ $medicine->name_ar }}
                                                                </td>
                                                                {{-- <td>
                                                                    {{ $index }}
                                                                </td> --}}
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    <tr>
                                                        <th colspan="2">الأدوية المصروفة</th>
                                                    </tr>
                                                    <tr>
                                                        <th>اسم الدواء</th>
                                                        <th>{{__('admin.quantity')}}</th>
                                                    </tr>
                                                    @foreach ($request->paid_drugs as $index => $item)
                                                        @php
                                                            $medicine = \App\Models\Medicine::find($item['id']);

                                                        @endphp
                                                        <tr>
                                                            <td>{{ $medicine->name_ar }}</td>
                                                            <td>{{ $item['quantity'] }}</td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <th>{{ __('admin.medicine') }}</th>
                                                        <th>{{ __('admin.quantity') }}</th>
                                                        <th>{{ __('admin.paid_quantity') }}</th>
                                                    </tr>
                                                    @foreach ($request->drugs as $index => $item)
                                                        @php
                                                            $medicine = \App\Models\Medicine::find($index);

                                                        @endphp

                                                        <tr>
                                                            <td width="60%">
                                                                <input type="checkbox" value="{{ $medicine->id }}"
                                                                    wire:model='paid_drugs.{{ $medicine->id }}.{{ $request->id }}.id'>
                                                                {{ $medicine->name_ar }}
                                                            </td>
                                                            <td>
                                                                {{ $item }}
                                                            </td>
                                                            <td>
                                                                <div>
                                                                    <input type="text"
                                                                        style="width: 50%; border:1px solid #000 !important"
                                                                        wire:model='paid_drugs.{{ $medicine->id }}.{{ $request->id }}.quantity'>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </table>
                                        </td>

                                        <td>{{ $request->notes }}</td>
                                        <td>
                                            <h6><span
                                                    class="badge bg-secondary {{ $request->status == 'pending' ? 'bg-warning' : 'bg-success' }}">{{ $request->status == 'pending' ? __('admin.pending') : __('admin.paid') }}</span>
                                            </h6>
                                        </td>
                                        <td class="not-print">
                                            <div class="form-check form-switch">
                                                @if (!$request->paid_drugs)
                                                    <button class="btn btn-primary btn-sm"
                                                        wire:click="changestatus({{ $request->id }})">@lang('admin.Pay')</button>
                                                @else
                                                    <button class="btn btn-danger btn-sm"
                                                        wire:click="unPay({{ $request->id }})">@lang('admin.unPay')</button>
                                                @endif
                                                {{-- <input class="form-check-input" type="checkbox"
                                                    wire:change="changestatus({{ $request->id }})" wire:model='status'
                                                    {{ $request->status == 'paid' ? 'checked' : '' }}> --}}
                                            </div>
                                        </td>
                                        <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                        <td class="not-print">
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete_agent{{ $request->id }}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                            @include('front.requests.delete')
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{ $requests->links() }}
                </div>
            </div>
        @else
            @include('scan.requests.show')
        @endif
    </div>
</section>
