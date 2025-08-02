<section class="patinet-report main-section pt-5">
    <div class="container">
        <div class="d-flex mb-3 gap-3 align-items-center ">
            <a href="{{ route('front.reports') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
            <h4 class="main-heading m-0">{{__("admin.Products and items")}}</h4>
        </div>
        <div class="treasuryAccount-content bg-white p-4 rounded-2 shadow">
            <div class="row g-3">
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="duration-from" class="report-name small-label">{{ __('admin.from') }}</label>
                        <input type="date" class="form-control" value="2022-07-12" wire:model="from" id="duration-from" />
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="duration-to" class="small-label report-name">{{ __('to') }}</label>
                        <input type="date" class="form-control" value="2024-03-03" wire:model="to" id="duration-to" />
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="type" class="report-name small-label">{{ __('Type') }}</label>
                        <select class="main-select w-100 type" id="type" wire:model="type">
                            <option value="">{{ __('All') }}</option>
                            <option value="products">{{ __('Products') }}</option>
                            <option value="items">{{ __('Items') }}</option>
                        </select>
                    </div>
                </div>
                {{-- <div class="row g-3">
                    <div class="col-12 col-ms-6 col-md-6">
                        <div class="box-info">
                            <label for="duration-to" class="small-label report-name mt-3 mb-2">{{ __('Total paid invoices') }}</label>
                <input type="text" class="form-control" value="{{ $patient ? $patient->invoices->where('status', 'Paid')->sum('total') : '' }}" readonly />
            </div>
        </div>
        <div class="col-12 col-ms-6 col-md-6">
            <div class="box-info">
                <label for="duration-to" class="small-label report-name mt-3 mb-2">{{ __('Total unpaid invoices') }}</label></label>
                <input type="text" class="form-control" value="{{ $patient ? $patient->invoices->where('status', 'Unpaid')->sum('total') : '' }}" readonly />
            </div>
        </div>
    </div> --}}

    </div>
    <!-- <hr> -->
    @if ($data)
    <div class="table-responsive mt-3">
        <table class="table main-table" id="data-table">
            <thead>
                <tr>
                    <th>{{ __('cash') }}</th>
                    <th>{{ __('card') }}</th>
                    <th>{{ __('tax') }}</th>
                    <th>{{ __('total') }}</th>
                </tr>
            </thead>
            <tbody>
                <td>{{ $data['cash'] }}</td>
                <td>{{ $data['card'] }}</td>
                <td>{{ $data['tax'] }}</td>
                <td>{{ $data['cash'] + $data['card'] + $data['tax'] }}</td>
            </tbody>
        </table>
    </div>
    @endif
    </div>
    </div>
</section>
