<section class="patinet-report main-section pt-5">
    <div class="container">
        <div class="d-flex mb-3 gap-3 align-items-center ">
            <a href="{{ route('front.reports') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
            <h4 class="main-heading m-0">{{__("admin.Purchases report")}}</h4>
        </div>
        <div class="treasuryAccount-content bg-white p-4 rounded-2 shadow">
            <div class="row">
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
                <div class="col-12 col-md-6  d-flex align-items-end justify-content-end">
                    <button class="btn btn-sm btn-outline-info" id="export-btn">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>{{ __('admin.Export') }} Excel</span>
                    </button>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table main-table" id="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.name') }}</th>
                            <th>{{ __('admin.amount') }}</th>
                            <th>{{ __('department.taxstatus') }}</th>
                            <th>{{ __('admin.tax') }}</th>
                            <th>{{ __('department.tax-amount') }}</th>
                            <th>{{ __('department.net') }}</th>
                            <th>{{ __('admin.Date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($purchases as $purchase)
                        <tr>
                            <td>{{ $purchase->id }}</td>
                            <td>{{ $purchase->name }}</td>
                            <td>{{ $purchase->amount }}</td>
                            <td>{{ $purchase->tax?__('Yes'):__('No') }}</td>
                            <td>{{ $purchase->tax }} %</td>
                            <td>{{ number_format($purchase->amount_tax,2) }} </td>
                            <td>{{ number_format($purchase->net,2) }} </td>
                            <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12">{{ __('admin.Sorry, there are no results') }}</td>
                        </tr>
                        @endforelse
                        @if ($purchases->count()>0)
                        <tr>
                            <td>{{ __('department.tax_total') }}</td>
                            <td>{{ number_format($purchases->sum('amount_tax'),2)}}</td>
                            <td></td>
                            <td>{{ __('department.net_sum') }}</td>
                            <td>{{ number_format($purchases->sum('net'),2)}}</td>
                            <td></td>
                            <td>{{ __('department.total_sum') }}</td>
                            <td>{{ number_format($purchases->sum('net') + $purchases->sum('amount_tax'),2) }}</td>
                        </tr>
                        @endif

                    </tbody>
                </table>
                {{ $purchases->links() }}
            </div>
        </div>
    </div>
</section>
