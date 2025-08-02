<section class="Financial-report main-section pt-5">
    <div class="container-fluid">
        <div class="Financial-report-content bg-white p-4 rounded-2 shadow">
            <a href="{{ route('front.reports') }}" class="btn bg-main-color text-white mb-3">
                <i class="fas fa-angle-right"></i>
            </a>
            <h4 class="main-heading">{{ __('admin.Reception staff report') }}</h4>
            <div class="d-flex flex-wrap justify-content-between align-items-end mb-3 gap-3">
                <div class="form-group mb-2 mb-md-0 gap-3">
                    <label for="key" class="small-label mb-2"> الموظف</label>
                    <select wire:model="key" id="key" class=" main-select">
                        <option value="">اختر الموظف</option>
                        @foreach (App\Models\User::receptions()->get() as $e)
                            <option value="{{ $e->id }}">{{ $e->name }}</option>
                        @endforeach
                    </select>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="from" class="small-label mb-2">من</label>
                                <input type="date" id="from" class="form-control" wire:model="from">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="to" class="small-label mb-2">الى</label>
                                <input type="date" id="to" class="form-control" wire:model="to">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="btn-holder d-flex gap-1 justify-content-end align-items-end w-100 h-100">
                    <button class="btn btn-sm btn-outline-warning" id="btn-prt-content">
                        <i class="fa-solid fa-print"></i>
                        <span>{{ __('admin.print') }}</span>
                    </button>
                    <button class="btn btn-sm btn-outline-info" id="export-btn">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>{{ __('admin.Export') }} Excel</span>
                    </button>
                </div>
            </div>
            <!-- <div class="row mb-3 g-3">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label for="" class="small-label "> {{ __('employee') }}</label>
                        <select wire:model="key" id="" class=" main-select w-100">
                            <option value="">{{ __('Select an Employee') }}</option>
                            @foreach ($receptions as $reception)
<option value="{{ $reception->id }}">{{ $reception->name }}</option>
@endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label for="" class="small-label">{{ __('admin.from') }}</label>
                        <input type="date" class="form-control" wire:model="from">
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label for="" class="small-label">{{ __('admin.To') }}</label>
                        <input type="date" class="form-control" wire:model="to">
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
                            <option value="tamara">{{ __('admin.tamara') }}</option>
                            <option value="tape">{{ __('admin.tape') }}</option>
                            <option value="bank_transfer">{{ __('admin.bank_transfer') }}</option>
                            <option value="retrieved">{{ __('admin.retrieved') }}</option>
                            <option value="Partially Paid">{{ __('Partially Paid') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-3">
                    <div class="btn-holder d-flex gap-1 justify-content-end align-items-end w-100 h-100">
                        <button class="btn btn-sm btn-outline-warning" id="btn-prt-content">
                            <i class="fa-solid fa-print"></i>
                            <span>{{ __('admin.print') }}</span>
                        </button>
                        <button class="btn btn-sm btn-outline-info" id="export-btn">
                            <i class="fa-solid fa-file-excel"></i>
                            <span>{{ __('admin.Export') }} Excel</span>
                        </button>
                    </div>
                </div>
            </div> -->
            <div id="prt-content" class="table-print">
                <x-header-invoice></x-header-invoice>
                <div class="table-responsive">
                    <table class="table main-table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('employee') }}</th>
                                <th>{{ __('Patient registration') }}</th>
                                <th>{{ __('Visitor reservations') }}</th>
                                <th>{{ __('Number of invoices paid') }}</th>
                                <th>{{ __('Number of outstanding invoices') }}</th>
                                <th>{{ __('Tamara bills') }}</th>
                                <th>{{ __('Taby invoices') }}</th>
                                <th>{{ __('cash') }}</th>
                                <th>{{ __('card') }}</th>
                                <th>{{ __('Bank transfer') }}</th>
                                <th>{{ __('Visa') }}</th>
                                <th>{{ __('MasterCard') }}</th>
                                <th>سندات مدين</th>
                                <th>{{ __('Total tamara') }}</th>
                                <th>{{ __('Total Taby') }}</th>
                                <th>{{ __('Add appointments') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->patients->count() }}</td>
                                    <td>{{ $user->num_of_visitors }}</td>
                                    <td><a
                                            href="{{ route('front.invoices.index', ['employee_id' => $user->id, 'status' => 'Paid', 'from' => $from, 'to' => $to]) }}">{{ $user->employee_invoices->where('status', 'Paid')->count() }}</a>
                                    </td>
                                    <td><a
                                            href="{{ route('front.invoices.index', ['employee_id' => $user->id, 'status' => 'Unpaid', 'from' => $from, 'to' => $to]) }}">{{ $user->employee_invoices->where('status', 'Unpaid')->count() }}</a>
                                    </td>
                                    <td><a
                                            href="{{ route('front.invoices.index', ['employee_id' => $user->id, 'status' => 'paid', 'tmara' => true, 'from' => $from, 'to' => $to]) }}">{{ $user->employee_invoices->where('installment_company', 1)->count() + $user->employee_invoices->where('tamara', '>', 0)->count() }}</a>
                                    </td>
                                    <td><a
                                            href="{{ route('front.invoices.index', ['employee_id' => $user->id, 'status' => 'tab', 'from' => $from, 'to' => $to]) }}">{{ $user->employee_invoices->where('tab', 1)->count() + $user->employee_invoices->where('tabby', '>', 0)->count() }}</a>
                                    </td>
                                    <td>{{ $user->employee_invoices->where('installment_company', 0)->sum('cash') + $user->employee_invoices->where('installment_company', 0)->where('status', 'cash')->sum('total') + $user->employee_bonds->where('status', 'creditor')->where('payment_method', 'cash')->sum('amount') }}
                                    </td>
                                    <td>{{ $user->employee_invoices->where('installment_company', 0)->sum('card') + $user->employee_invoices->where('installment_company', 0)->where('status', 'card')->sum('total') + $user->employee_bonds->where('status', 'creditor')->where('payment_method', 'card')->sum('amount') }}
                                    </td>
                                    <td>{{ $user->employee_invoices->where('installment_company', 0)->sum('bank') + $user->employee_invoices->where('installment_company', 0)->where('status', 'bank_transfer')->sum('total') + $user->employee_bonds->where('status', 'creditor')->where('payment_method', 'bank')->sum('amount') }}
                                    </td>
                                    <td>{{ $user->employee_invoices->where('installment_company', 0)->sum('visa') + $user->employee_bonds->where('status', 'creditor')->where('payment_method', 'visa')->sum('amount') }}
                                    </td>
                                    <td>{{ $user->employee_invoices->where('installment_company', 0)->sum('mastercard') + $user->employee_bonds->where('status', 'creditor')->where('payment_method', 'mastercard')->sum('amount') }}
                                    </td>
                                    <td>
                                        {{ $user->employee_bonds->where('status', 'debtor')->sum('amount') }}
                                    </td>
                                    <td>{{ $user->employee_invoices->where('installment_company', 1)->sum('total') + $user->employee_invoices->where('tamara', '>', 0)->sum('tamara') + $user->employee_bonds->where('status', 'creditor')->where('payment_method', 'tmara')->sum('amount') }}
                                    </td>
                                    <td>{{ $user->employee_invoices->where('tab', 1)->sum('total') + $user->employee_invoices->where('tabby', '>', 0)->sum('tabby') + $user->employee_bonds->where('status', 'creditor')->where('payment_method', 'tab')->sum('amount') }}
                                    </td>
                                    <td>{{ $user->employee_appointments_count }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
