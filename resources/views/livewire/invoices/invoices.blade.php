<section class="main-section">
    <div class="container-fluid">
        <h4 class="main-heading mb-4">{{ __('admin.invoices') }}</h4>
        <div class="bills-content bg-white p-4 rounded-2 shadow">
            <div class="control-option d-flex flex-wrap align-items-center mb-3 justify-content-end gap-1">
                <div class="print-btn btn btn-sm btn-warning " id="btn-prt-content">
                    <i class="fa-solid fa-print"></i>
                </div>
                <a href="{{ route('front.invoices.create') }}" class="btn-main-sm">
                    {{ __('admin.Add invoice') }}
                    <i class="icon fa-solid fa-plus me-1"></i>
                </a>
                <!-- <a href="#" class="btn btn-sm btn-info px-3">
                    فواتير المختبر
                </a> -->
                <a class="btn btn-sm btn-outline-primary" href="{{ route('front.patientsInvoice.export') }}">
                    {{ __('admin.Export') }}
                    <i class="fa-solid fa-file-import"></i>
                </a>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="the-doctor"
                            class="report-name small-label">{{ __('admin.search_name_and_mobile') }}</label>
                        <input wire:model="search_name" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="the-doctor"
                            class="report-name small-label">{{ __('Search by invoice number') }}</label>
                        <input wire:model="search" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="inp-holder">
                        <label for="duration-from" class="billData-name small-label">{{ __('admin.from') }}</label>
                        <input type="date" class="form-control" value="2022-07-12" wire:model="from"
                            id="duration-from" />
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="inp-holder">
                        <label for="duration-to" class="billData-name small-label">{{ __('admin.To') }}</label>
                        <input type="date" class="form-control" value="2024-03-03" wire:model="to"
                            id="duration-to" />
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="inp-holder">
                        <label for="doctor-name " class="billData-name small-label">{{ __('admin.dr') }}</label>
                        <select class="main-select w-100 doctor-name" id="doctor-name" wire:model="dr">
                            <option value="">{{ __('admin.All doctors') }}</option>
                            @foreach ($doctors as $dr)
                                <option value="{{ __($dr->id) }}">{{ $dr->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="inp-holder">
                        <label for="doctor-name " class="billData-name small-label">{{ __('Employees') }}</label>
                        <select wire:model="employee_id" class="main-select w-100 doctor-name" id="employee_id">
                            <option value="">{{ __('Select an Employee') }}</option>
                            @foreach ($receptions as $reception)
                                <option value="{{ $reception->id }}">{{ $reception->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="inp-holder">
                        <label for="bill-state" class="billData-name small-label">{{ __('admin.Status') }}</label>
                        <select class="main-select w-100 bill-state" id="bill-state" wire:model="status">
                            <option value="">{{ __('admin.All') }}</option>
                            <option value="Paid">{{ __('admin.Paid') }}</option>
                            <option value="Unpaid">{{ __('admin.Unpaid') }}</option>
                            <option value="cash">{{ __('admin.cash') }}</option>
                            <option value="card">{{ __('admin.card') }}</option>
                            <option value="bank_transfer">{{ __('admin.bank_transfer') }}</option>
                            <option value="retrieved">{{ __('admin.retrieved') }}</option>
                            <option value="Partially Paid">{{ __('Partially Paid') }}</option>
                            {{-- <option value="tamara">{{ __('admin.tamara') }}</option>
                            <option value="tape">{{ __('admin.tape') }}</option> --}}
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="inp-holder">
                        <label for="bill-state" class="billData-name small-label">{{ __('section') }}</label>
                        <select class="main-select w-100 bill-state" id="bill-state" wire:model="department_id">
                            <option value="">{{ __('admin.All') }}</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="inp-holder">
                        <label for="bill-state" class="billData-name small-label">{{ __('Pharmacy Invoices') }}</label>
                        <input type="checkbox" wire:model="pharmacy_invoices" class="form-check-input">
                    </div>
                </div>


            </div>
            <div id="prt-content" class="table-print">
                <x-header-invoice></x-header-invoice>
                <div class="table-responsive">
                    <table class="table main-table table-sm">
                        <thead>
                            <tr>
                                <th>{{ __('admin.Invoice no.') }}</th>
                                <th>{{ __('admin.department') }}</th>
                                <th>{{ __('admin.f_number') }}</th>
                                <th>{{ __('admin.patient') }}</th>
                                <th>{{ __('admin.animal') }}</th>
                                <th>{{ __('admin.dr') }}</th>
                                <th>{{ __('admin.employee') }}</th>
                                <th>{{ __('admin.Date') }}</th>
                                <th>{{ __('admin.amount') }}</th>
                                <th>{{ __('admin.tax') }}</th>
                                <th>{{ __('admin.Total with tax') }}</th>
                                <th>{{ __('admin.rest') }}</th>
                                <th>{{ __('admin.paid') }}</th>
                                <th>{{ __('admin.Status') }}</th>
                                <th class="not-print">{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    {{-- <td>{{ $loop->index + 1 }}</td> --}}
                                    <td>{{ $invoice->id }}</td>

                                    {{-- {{ $invoice->id }} --}}
                                    <td>{{ $invoice->department?->name }}</td>
                                    <td>{{ $invoice->patient->id ?? 'لا يوجد' }}</td>
                                    <td class="text-nowrap">{{ $invoice->patient->name ?? 'عميل نقدي' }}</td>
                                    {{-- <td class="text-nowrap">
                                        {{ $invoice->animal_id ? App\Models\Animal::find($invoice->animal_id)->name : 'لا يوجد' }}
                                </td> --}}
                                    <td class="text-nowrap">{{ $invoice->animals->pluck('name')->join(', ') }}</td>
                                    <td class="text-nowrap">{{ $invoice->dr ? $invoice->dr->name : 'لا يوجد' }}</td>
                                    <td class="text-nowrap">{{ $invoice->employee?->name }}</td>
                                    <td class="text-nowrap">{{ $invoice->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $invoice->amount }}</td>
                                    <td>{{ $invoice->tax }}</td>
                                    <td>{{ $invoice->total }}</td>
                                    <td>{{ $invoice->rest }}</td>
                                    <td>{{ $invoice->paid }}</td>
                                    <td>{{ __($invoice->status) }}</td>
                                    {{-- <td>
                                        @if ($invoice->card == 0)
                                            {{ __('نقدا') }}
                                @else
                                {{ __('شبكة') }}
                                @endif
                                </td> --}}
                                    @php
                                        $content =
                                            setting()->site_name .
                                            '%0A%0A' .
                                            'فاتورة مبيعات' .
                                            '%0A' .
                                            route('front.invoice.send', $invoice);

                                    @endphp
                                    <td class="not-print">
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <a href="https://api.whatsapp.com/send?phone=+966{{ $invoice->patient?->phone }}&text={{ $content }}"
                                                class="btn btn-sm btn-success" target="_blank"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="{{ __('Send invoice via WhatsApp') }}"
                                                data-bs-custom-class="sm-tooltip">
                                                <i class="fa-solid fa-share"></i>
                                            </a>
                                            <!--btn  Modal repeat-->
                                            <a href="{{ route('front.invoices.show', $invoice) }}"
                                                class="btn btn-sm btn-purple">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @if (in_array($invoice->status, ['Partially Paid', 'Paid']))
                                                <a data-bs-toggle="modal"
                                                    data-bs-target="#retrieved{{ $invoice->id }}"
                                                    class="btn btn-sm btn-primary text-white">
                                                    {{ __('admin.Recovery') }}
                                                </a>
                                            @endif


                                            @if (in_array($invoice->status, ['Unpaid', 'Partially Paid']))
                                                <a href="{{ route('front.invoices.bonds', $invoice) }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="{{ __('Only used for partially paid invoices.') }}"
                                                    data-bs-custom-class="sm-tooltip" class="btn btn-sm btn-info">
                                                    <i class="fa-solid fa-file-contract"></i>
                                                </a>
                                            @endif




                                            <div class="dropdown drop-table dropend">
                                                <button
                                                    class="btn btn-outline-secondary fs-12px btn-sm dropdown-toggle"
                                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @can('update_invoices')
                                                        <li>
                                                            <a href="{{ route('front.invoices.edit', $invoice) }}"
                                                                class="dropdown-item">
                                                                <i class="fa-solid fa-pen-to-square"></i> @lang('admin.Edit_invoice')
                                                            </a>
                                                        </li>
                                                    @endcan
                                                    <li>
                                                        @can('delete_invoices')
                                                            <button class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#delete_agent{{ $invoice->id }}">
                                                                <i class="fa fa-trash-can"></i> @lang('admin.Delete_invoice')
                                                            </button>
                                                        @endcan
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @include('front.invoice.delete')
                                @include('front.invoice.retrieved')
                            @endforeach

                        </tbody>
                    </table>
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
