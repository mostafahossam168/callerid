<section class="patinet-report main-section pt-5">
    <div class="container">
        <div class="d-flex mb-3 gap-3 align-items-center ">
            <a href="{{ route('front.reports') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
            <h4 class="main-heading m-0">{{__("Queue report")}}</h4>
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
                        <label for="duration-to" class="report-name small-label">{{ __('admin.To') }}</label>
                        <input type="date" class="form-control" value="2024-03-03" wire:model="to" id="duration-to" />
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="left-holder d-flex justify-content-end w-100 h-100 align-items-end">
                        <button class="btn btn-sm btn-outline-info" id="export-btn">
                            <i class="fa-solid fa-file-excel"></i>
                            <span>{{ __('admin.Export') }} Excel</span>
                        </button>
                    </div>
                </div>

            </div>
            <div class="table-responsive mt-3">
                <table class="table main-table" id="data-table">
                    <thead>
                        <tr>
                            <th>{{ __('Visitors Count') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $queues->count() }}</td>
                        </tr>
                    </tbody>
                </table>
                {{ $queues->links() }}
            </div>
        </div>
    </div>
</section>
