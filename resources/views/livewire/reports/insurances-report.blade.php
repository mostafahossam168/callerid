<section class="ClidocReport main-section pt-5">
    <div class="container">
    <div class="d-flex mb-3 gap-3 align-items-center ">
            <a href="{{ route('front.reports') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
            <h4 class="main-heading m-0">{{__("admin.Insurance companies report")}}</h4>
        </div>
        <div class="Cli&doc-report-content bg-white p-4 rounded-2 shadow">
            <div class="row g-3">
                <div class="col-12 col-md-7 d-flex align-items-end flex-wrap flex-sm-nowrap">
                    <div class="box-info">
                        <label for="pay-way" class="report-name small-label">{{ __('admin.insurances') }}</label>
                        <select class="main-select w-150px pay-way" id="pay-way" wire:model="insurance">
                            <option value="">{{ __('admin.All') }}</option>
                            @foreach ($insurances as $insurance)
                                <option value="{{ $insurance->id }}">{{ $insurance->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="info d-flex w-100 gap-1">
                        <div class="bg-info text-white rounded-3 p-2">{{ __('admin.number of patients') }} :
                            {{ $selected_insurance ? $selected_insurance->patients_count : App\Models\Patient::whereNotNull('insurance_id')->count() }}
                        </div>
                        <div class="bg-info text-white rounded-3 p-2 ">{{ __('admin.amount') }} :
                            {{ $invoices->sum('total') }}</div>
                    </div>
                </div>
                <div class="col-12 col-md-5 d-flex justify-content-end align-items-end">
                    <div class="btn-holder">
                        <button class="btn btn-sm btn-outline-warning ms-2" id="btn-prt-content">
                            <i class="fa-solid fa-print"></i>
                            <span>{{ __('admin.print') }}</span>
                        </button>
                        {{-- <button class="btn btn-sm btn-outline-info" id="export-btn">
                            <i class="fa-solid fa-file-excel"></i>
                            <span>{{ __('admin.Export') }} Excel</span>
                        </button> --}}
                        <a class="btn btn-sm btn-outline-info" id="export-btn"href="{{ route('front.export.insurances') }}">

                            <i class="fa-solid fa-file-excel"></i>
                            <span>{{ __('admin.Export') }} Excel</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="prt-content" class="table-print">
            <x-header-invoice></x-header-invoice>
            @if (count($invoices) > 0)
                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('admin.patient') }}</th>
                                <th>{{ __('admin.Date') }}</th>
                                <th>{{ __('admin.insurance') }}</th>
                                <th>{{ __('admin.Invoice no.') }}</th>
                                <th>{{ __('admin.Total') }}</th>
                                <th>{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($invoices as $invoice)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $invoice->patient?->name }}</td>
                                    <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $invoice->patient?->insurance?->name }}</td>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->total }}</td>
                                    <td>
                                        <a target="_blank" href="{{ route('front.invoices.show', $invoice) }}"
                                            class="btn btn-sm btn-purple">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        @can('delete_invoices')
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete_agent{{ $invoice->id }}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                                @include('front.invoice.delete')
                            @empty
                                <tr>
                                    <td>{{ __('admin.Sorry, there are no results') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $invoices->links() }}
                </div>
            @endif
        </div>
    </div>
</section>
