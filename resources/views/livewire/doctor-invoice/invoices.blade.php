<section class="">
    <div class="container">
        <div class="bills-content bg-white px-4 py-3 rounded-3 shadow">
            <div class="row mb-3 g-3">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label for="duration-from" class="small-label">{{ __('admin.from') }}</label>
                        <input type="date" class="form-control" value="2022-07-12" wire:model="from"
                            id="duration-from" />
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label for="duration-to" class="small-label">{{ __('admin.To') }}</label>
                        <input type="date" class="form-control" value="2024-03-03" wire:model="to"
                            id="duration-to" />
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label for="bill-state" class="small-label">{{ __('admin.Status') }}</label>
                        <select class="main-select w-100 bill-state" id="bill-state" wire:model="status">
                            <option value="">{{ __('admin.All') }}</option>
                            <option value="Paid">{{ __('admin.Paid') }}</option>
                            <option value="Unpaid">{{ __('admin.Unpaid') }}</option>
                            <option value="Partially Paid">{{ __('Partially Paid') }}</option>
                            <option value="cash">{{ __('admin.cash') }}</option>
                            <option value="card">{{ __('admin.card') }}</option>
                            <option value="bank_transfer">{{ __('admin.bank_transfer') }}</option>
                            <option value="retrieved">{{ __('admin.retrieved') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-3 d-flex align-items-end">
                    <div class="inp-holder w-100 d-flex justify-content-end gap-1">
                        <button type="button" wire:click="resetForm" class="sec-btn-gre px-2">
                            {{ __('admin.Reset') }}
                        </button>
                        @can('create_invoices')
                            <a href="{{ route('doctor.invoices.create') }}" class="btn-main-sm rounded-0">
                                {{ __('admin.Add invoice') }}
                                <i class="icon fa-solid fa-plus me-1"></i>
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table main-table" id="prt-content">
                    <thead>
                        <tr>
                            <th>{{ __('admin.Invoice no.') }}</th>
                            <th>{{ __('admin.patient') }}</th>
                            <th>{{ __('admin.dr') }}</th>
                            <th>{{ __('admin.employee') }}</th>
                            <th>{{ __('admin.Date') }}</th>
                            <th>{{ __('admin.Total') }}</th>
                            <th>{{ __('admin.Status') }}</th>
                            <th>{{ __('admin.Total with tax') }}</th>
                            <th>{{ __('Qr') }}</th>
                            <th class="not-print">{{ __('admin.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td class="text-nowrap">{{ $invoice->patient->name }}</td>
                                <td class="text-nowrap">{{ $invoice->dr?->name }}</td>
                                <td class="text-nowrap">{{ $invoice->employee->name }}</td>
                                <td class="text-nowrap">{{ $invoice->created_at->format('Y-m-d') }}</td>
                                <td>{{ $invoice->total }}</td>
                                <td>{{ __($invoice->status) }}</td>
                                <td>{{ $invoice->total + $invoice->tax }}</td>
                                <td>
                                    <div class="qr-table">{!! $invoice->qr() !!}</div>
                                </td>
                                <td class="not-print">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('doctor.invoices.show', $invoice) }}"
                                            class="btn btn-sm btn-purple">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @can('update_invoices')
                                            <a href="{{ route('doctor.invoices.edit', $invoice) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        @endcan
                                        @can('delete_invoices')
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete_agent{{ $invoice->id }}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @include('front.invoice.delete')
                        @endforeach

                    </tbody>
                </table>
                {{ $invoices->links() }}
            </div>
        </div>
    </div>
</section>
