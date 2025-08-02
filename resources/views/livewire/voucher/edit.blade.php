<section id="app" class="main-section">
    <div class="container">
        <h4 class="main-heading mb-4">
            @lang('Add Registration documents')
        </h4>
        <x-message-admin></x-message-admin>
        <div class="bg-white shadow p-4 rounded-3">
            <div class="amountPatients-holder gap-2 d-flex align-items-start align-items-md-center justify-content-between my-3 flex-column flex-md-row">
                <div class="d-flex flex-column flex-md-row my-3">
                </div>
                <div class="btn-holders ">
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="{{ __('Visitor registrars are those who have made reservations over the phone or via the website and their data is completed when they attend the clinic') }}">
                        <i class="fa-solid fa-question"></i>
                    </button>
                    <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning py-1">
                        <i class="fa-solid fa-print"></i>
                    </button>
                </div>
            </div>
            <div class="">
                <div class="table-responsive">
                    <table id="prt-content" class="table main-table">
                        <thead>
                            <tr class=" " style="border-bottom: 1px solid #f9fafb !important;">
                                <th>@lang('Bond no') : {{ $voucher_no }}</th>
                                <th>@lang('reference number') {{ $voucher_no }}</th>
                                <th>@lang('the currency') ريال سعودي</th>
                            </tr>
                            <tr class="">
                                <th>
                                    @lang('Bond date') : <input type="date" wire:model='date' class="form-control">

                                </th>
                                <th></th>
                                <th>
                                    <div class="d-flex align-items-center">
                                        @lang('Description') <input type="text" wire:model.defer='description' class="form-control">
                                    </div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="table-responsive">
                    <table id="prt-content" class="table main-table">
                        <thead>
                            <tr>
                                <th>
                                    <button class="btn btn-sm btn-success xs-btn-icon " type="button" wire:click="addRow">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </th>
                                <th>رقم الحساب</th>
                                <th>اسم الحساب</th>
                                <th>مركز التكلفة</th>
                                <th>المدين</th>
                                <th>الدائن</th>
                                 <th>الوصف</th>
                                <!-- <th class="text-center not-print">{{ __('admin.managers') }}</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @if ($accounts)
                            @foreach ($accounts as $key => $account)
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-center ">
                                        <div class="addBtn-holder ">
                                            @if($loop->index && ($key % 2 == 0))
                                            <button class="btn btn-sm btn-danger xs-btn-icon" type="button" wire:click="removeRow({{ $key }})">
                                                <i class="fas fa-trash-can"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <input type="text" value="{{ isset($accounts[$key]['account_id']) ? App\Models\Account::find($accounts[$key]['account_id'])?->id : '' }}" readonly id="account_id2{{ $key }}" class="form-control " />
                                    </div>
                                </td>
                                <td>
                                    <div wire:ignore>
                                        <select data-pharaonic="select2" data-component-id="{{ $this->id }}" id="select{{ $key }}" wire:model="accounts.{{ $key }}.account_id">
                                            <option value="">اختر الحساب</option>
                                            @foreach ($all_accounts as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div wire:ignore>
                                        <select data-pharaonic="select2"
                                            data-component-id="{{ $this->id }}"
                                            id="cost_center{{ $key }}"
                                            wire:model="accounts.{{ $key }}.cost_center_id">
                                            <option value="">اختر مركز التكلفة</option>
                                            @foreach ($cost_centers as $cost_center)
                                                <option value="{{ $cost_center->id }}">
                                                    {{ $cost_center->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                @php
                                $disabledCredit = '';
                                $disabledDebit = '';
                                if(($key -1) % 2 == 0){
                                if(isset($accounts[$key -1])){
                                $disabledCredit = isset($accounts[$key - 1]['credit']) && !empty($accounts[$key - 1]['credit']) ? 'disabled' : '';
                                $disabledDebit = isset($accounts[$key - 1]['debit']) && !empty($accounts[$key - 1]['debit']) ? 'disabled' : '';
                                }
                                }
                                @endphp
                                <td>
                                    <div dir="ltr" class="input-group mb-2 mb-md-0 ">
                                        <input required wire:model="accounts.{{ $key }}.debit" type="text" class="form-control" wire:keyup='computeAll' id="" {{ $accounts[$key]['credit'] ? 'readonly' : '' }} {{ $disabledDebit }}>
                                    </div>
                                </td>
                                <td>
                                    <div dir="ltr" class="input-group mb-2 mb-md-0 ">
                                        <input required wire:model="accounts.{{ $key }}.credit" type="text" class="form-control" wire:keyup='computeAll' id="" {{ $accounts[$key]['debit'] ? 'readonly' : '' }} {{ $disabledCredit }}>
                                    </div>
                                </td>
                                
                                <td>
                                    <div dir="ltr" class="input-group mb-2 mb-md-0">
                                        <input required wire:model="accounts.{{ $key }}.description" type="text" class="form-control" id="">
                                    </div>
                                </td>
                            </tr>
                            {{-- <tr>
                                <td>

                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <input type="text" value="{{ isset($accounts[$key]['account_id2']) ? App\Models\Account::find($accounts[$key]['account_id2'])?->id : '' }}" readonly id="account_id2{{ $key }}" class="form-control " />
                </div>
                </td>
                <td>
                    <div wire:ignore>
                        <select data-pharaonic="select2" data-component-id="{{ $this->id }}" id="account_id2{{ $key }}" wire:model="accounts.{{ $key }}.account_id2">
                            <option value="">اختر الحساب</option>
                            @foreach ($all_accounts as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td>
                    <div dir="ltr" class="input-group mb-2 mb-md-0 ">
                        <input required wire:model="accounts.{{ $key }}.debit2" type="text" class="form-control" wire:keyup='computeAll' id="" {{ $accounts[$key]['credit2'] ? 'readonly' : '' }} {{ $accounts[$key]['debit'] ? 'readonly' : '' }}>
                    </div>
                </td>
                <td>
                    <div dir="ltr" class="input-group mb-2 mb-md-0 ">
                        <input required wire:model="accounts.{{ $key }}.credit2" type="text" class="form-control" wire:keyup='computeAll' id="" {{ $accounts[$key]['debit2'] ? 'readonly' : '' }} {{ $accounts[$key]['credit'] ? 'readonly' : '' }}>
                    </div>
                </td>
                <td>
                    <div dir="ltr" class="input-group mb-2 mb-md-0 ">
                        <input dir="rtl" type="text" value="{{ isset($accounts[$key]['branch_id']) ? App\Models\Branch::find($accounts[$key]['branch_id'])->name : '' }}" class="form-control " placeholder="" disabled />
                    </div>
                </td>
                <td>
                    <div dir="ltr" class="input-group mb-2 mb-md-0">
                        <input required wire:model="accounts.{{ $key }}.description2" type="text" class="form-control" id="">
                    </div>
                </td>
                </tr> --}}
                @endforeach
                @endif
                <tr>
                    <td colspan="3" class="border">
                        المجموع
                    </td>
                    <td class="border">
                        {{ $totalDebit + $debit }}
                    </td>
                    <td class="border">
                        {{ $totalCredit + $credit }}
                    </td>
                </tr>
                </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table id="prt-content" class="table main-table">
                    <thead>
                        <tr class=" " style="border-bottom: 1px solid #f9fafb !important;">
                            <th class="pb-0">المحاسب</th>
                            <th class="pb-0">المراجع</th>
                            <th class="pb-0">المدير</th>
                        </tr>
                        <tr class="">
                            <th>--</th>
                            <th>--</th>
                            <th>--</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="d-flex justify-content-end ">
                <div class="addBtn-holder ">
                    <button type="button" wire:click='submit' class="btn-main-sm px-3">
                        حفظ
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@push('js')
<x:pharaonic-select2::scripts />
@endpush
