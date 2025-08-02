<section class="ClidocReport main-section pt-5">
    <div class="container">
        <div class="d-flex mb-3 gap-3 align-items-center ">
            <a href="{{ route('front.reports') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
            <h4 class="main-heading m-0">تقرير المرضى غير سعوديين</h4>
        </div>
        <div class="Cli&doc-report-content bg-white p-4 rounded-2 shadow">
            <div class="row g-3">
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="duration-from" class="report-name small-label">{{ __('admin.from') }}</label>
                        <input type="date" class="form-control" wire:model="from" id="duration-from" />
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="duration-to" class="report-name small-label">{{ __('admin.To') }}</label>
                        <input type="date" class="form-control" wire:model="to" id="duration-to" />
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="left-holder d-flex justify-content-end gap-1 align-items-end w-100 h-100">
                        <button class="btn btn-sm btn-outline-warning" id="btn-prt-content">
                            <i class="fa-solid fa-print"></i>
                            <span>{{ __('admin.print') }}</span>
                        </button>
                        <a class="btn btn-sm btn-outline-info" href="">
                            <i class="fa-solid fa-file-excel"></i>
                            <span>{{ __('admin.Export') }} Excel</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="prt-content">
            <x-header-invoice></x-header-invoice>
            @if (count($invoices) > 0)
            <div class="table-responsive">
                <table class="table main-table" id="data-table">
                    <thead>
                        <tr>
                            <th>{{ __('admin.Date') }}</th>
                            <th>{{ __('admin.Invoice no.') }}</th>
                            <th>{{ __('admin.dr') }}</th>
                            <th>{{ __('admin.patient') }}</th>
                            <th>{{ __('admin.amount') }}</th>
                            <th>{{ __('admin.tax') }}</th>
                            <th>{{ __('admin.Total') }}</th>
                            <th>{{ __('admin.paid') }}</th>
                            <th>{{ __('admin.rest') }}</th>
                            <th>{{ __('admin.Status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                            <td>{{ $invoice->id }}</td>
                            <td>{{ $invoice->dr?->name }}</td>
                            <td>{{ $invoice->patient?->name }}</td>
                            <td>{{ $invoice->amount }}</td>
                            <td>{{ $invoice->tax }}</td>
                            <td>{{ $invoice->total }}</td>
                            <td>{{ $invoice->paid }}</td>
                            <td>{{ $invoice->rest }}</td>
                            <td>{{ __($invoice->status) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td>{{ __('admin.Sorry, there are no results') }}</td>
                        </tr>
                        @endforelse
                        <tr>
                            <td>{{ __('admin.Sum') }}</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>{{ $all_invoices->sum('amount') }}</td>
                            <td>{{ $all_invoices->sum('tax') }}</td>
                            <td>{{ $all_invoices->sum('total') }}</td>
                            <td>{{ $all_invoices->Where('status','Paid')->sum('paid') + $all_invoices->Where('status','Partially Paid')->sum('paid') }}</td>
                            <td>{{ $all_invoices->sum('rest') }}</td>
                        </tr>
                    </tbody>
                </table>
                {{ $invoices->links() }}
            </div>
            @endif
        </div>
    </div>
</section>
