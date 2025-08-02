<section class="Financial-report main-section pt-5">
    <div class="container">
        <div class="d-flex mb-3 gap-3 align-items-center ">
            <a href="{{ route('front.reports') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
            <h4 class="main-heading m-0">{{__("admin.Items financial report")}}</h4>
        </div>
        <div class="Financial-report-content bg-white p-4 rounded-3 shadow">
            <div class="status-info d-flex align-items-center justify-content-start mb-3">
                <div class="status bg-info rounded-3 text-white py-2 px-3 ms-2"> {{ __('admin.The product') }}:
                    {{ $item->name }}
                </div>
                <div class="status bg-info rounded-3 text-white py-2 px-3"> {{ __('admin.Number of invoices') }}:
                    {{ $orders->count() }}
                </div>
            </div>
            <div class="about-finan-report d-flex flex-wrap align-items-start justify-content-between mb-3">
                <div class="right-holder d-flex flex-wrap flex-sm-nowrap flex-sm-row align-items-center mb-2 mb-lg-0 justify-content-center">
                    <div class="duration-from d-flex align-items-center justify-content-center me-2">
                        <label for="date-from" class="fild-name ms-2">{{ __('admin.from') }}</label>
                        <input type="date" class="date-from form-control mb-2 mb-sm-0" id="date-from" wire:model="from" />
                    </div>
                    <div class="duration-to d-flex align-items-center justify-content-center me-2">
                        <label for="date-to" class="fild-name ms-2">{{ __('admin.To') }}</label>
                        <input type="date" class="date-to form-control mb-3 mb-sm-0" id="date-to" wire:model="to" />
                    </div>

                </div>
                <div class="left-holder d-flex justify-content-center justify-content-sm-start m-auto m-sm-0">
                    <button class="btn btn-sm btn-outline-warning ms-2" id="print-btn">
                        <i class="fa-solid fa-print"></i>
                        <span>{{ __('admin.print') }}</span>
                    </button>
                    <button class="btn btn-sm btn-outline-info" id="export-btn">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>{{ __('admin.Export') }} Excel</span>
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table main-table" id="data-table">
                    <thead>
                        <tr>
                            <th>{{ __('admin.cash') }}</th>
                            <th>{{ __('admin.card') }}</th>
                            <th>{{ __('admin.Paid') }}</th>
                            <th>{{ __('admin.Unpaid') }}</th>
                            <th>{{ __('admin.Without tax') }}</th>
                            <th>{{ __('admin.Total with tax') }}</th>
                            <th>{{ __('admin.tax') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $orders->sum('cash') }}</td>
                            <td>{{ $orders->sum('card') }}</td>
                            <td>{{ $orders->sum('paid') }}</td>
                            <td>{{ $orders->sum('total') - $orders->sum('paid') }}</td>
                            <td>{{ $orders->sum('amount') }}</td>
                            <td>{{ $orders->sum('total') }}</td>
                            <td>{{ $orders->sum('tax') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
