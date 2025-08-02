<section class="Financial-report main-section py-5">
    <div class="container">
        <div class="d-flex mb-3 gap-3 align-items-center ">
            <a href="{{ route('front.reports') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
            <h4 class="main-heading m-0">{{__("admin.Sales report")}}</h4>
        </div>
        <div class="blocks-data">
            <div class="row g-3 mb-4">
                <div class="col-md-6 col-lg-3">
                    <div class="states-box box-1">
                        <div class="data-icon">
                            <span class="num-1">{{ App\Models\Order::where('status', 'paid')->count() }}</span>
                            <i class="fa-solid fa-money-bill-transfer icon-1"></i>
                        </div>
                        {{-- <div class="text">
                            <a href="{{ route('front.invoices.index') }}">{{ __('Paid invoices') }}</a>
                    </div> --}}
                    <div class="text">
                        <a href="{{ route('front.sales.report',['status'=>'paid']) }}">{{ __('Paid invoices') }}</a>
                    </div>
                    <div class="prog-box">
                        <div class="prog">
                            <span class="prog-1"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="states-box">
                    <div class="data-icon">
                        <span class="num-2">{{ App\Models\Order::where('status', 'Unpaid')->count() }}</span>
                        <i class="fa-solid fa-money-bill-trend-up icon-2"></i>
                    </div>
                    <div class="text">
                        <a href="{{ route('front.sales.report',['status'=>'unpaid']) }}">{{ __('All outstanding invoices') }}</a>

                    </div>
                    <div class="prog-box">
                        <div class="prog">
                            <span class="prog-2"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="Financial-report-content bg-white p-4 rounded-2 shadow">
        <div class="about-finan-report d-flex flex-wrap align-items-start justify-content-between">
            <form action="" class="right-holder d-flex flex-wrap flex-sm-nowrap flex-sm-row align-items-center mb-2 mb-lg-0 justify-content-center">
                <div class="duration-from d-flex align-items-center justify-content-center me-2">
                    <label for="date-from" class="fild-name ms-2">{{ __('admin.from') }}</label>
                    <input type="date" class="date-from form-control mb-2 mb-sm-0" id="date-from" wire:model="from" />
                </div>
                <div class="duration-to d-flex align-items-center justify-content-center me-2">
                    <label for="date-to" class="fild-name ms-2">{{ __('admin.To') }}</label>
                    <input type="date" class="date-to form-control mb-3 mb-sm-0" id="date-to" wire:model="to" />
                </div>
                <button type="button" class="sec-btn-gre w-75 mb-2 mb-sm-0 me-sm-2 me-0 w-50">
                    <span class="ms-1">{{ __('admin.Show') }}</span>
                    <i class="fa-solid fa-eye"></i>
                </button>
            </form>
            <div class="left-holder d-flex justify-content-center justify-content-sm-start m-auto m-sm-0">
                <button class="btn btn-sm btn-outline-warning ms-2" id="btn-prt-content">
                    <i class="fa-solid fa-print"></i>
                    <span>{{ __('admin.print') }}</span>
                </button>
                <button class="btn btn-sm btn-outline-info" id="export-btn">
                    <i class="fa-solid fa-file-excel"></i>
                    <span>{{ __('admin.Export') }} Excel</span>
                </button>
            </div>
        </div>
        <div id="prt-content" class="table-print">
            <x-header-invoice></x-header-invoice>
            <div class="table-responsive mt-4 w-50 sw-100">
                <table class="table main-table" id="data-table">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-end">{{ __('category') }}</th>
                            <th colspan="2">{{ __('amount') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2" class="text-end">{{ __('Total paid invoices') }}</td>
                            <td colspan="2">{{ $orders->where('status', 'paid')->sum('total') }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-end">{{ __('Set of outstanding invoices') }}</td>
                            <td colspan="2">{{ $orders->where('status', 'unpaid')->sum('total') }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-end">{{ __('value added tax') }}</td>
                            <td colspan="2">{{ $orders->sum('tax') }}</td>
                        </tr>

                        <tr>
                            <td colspan="2" class="text-end">{{ __('cash') }}</td>
                            <td colspan="2">{{ $orders->sum('cash') }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-end">{{ __('card') }}</td>
                            <td colspan="2">{{ $orders->sum('card') }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-end">{{ __('carry over') }}</td>
                            <td colspan="2">{{ $orders->where('status', 'unpaid')->sum('total') }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-end pe-5">{{ __('Final Total Without Time') }}</td>
                            <td colspan="2" class="text-center">
                                {{ $orders->where('status', 'paid')->sum('total') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</section>