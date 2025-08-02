<section class="main-section ">
    <div class="container">
        <div class="alert alert-secondary d-none" role="alert">
            <div class="d-flex flex-column">
                <div class="mb-2">
                    سبب الخصم :
                </div>
                <div class="">
                    كمية الخصم :
                </div>
            </div>
        </div>
        @if($screen=='salaries')
        <div class="d-flex mb-3 gap-3 align-items-center ">
            <a href="{{ route('front.reports') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
            <h4 class="main-heading m-0">{{__("admin.Employee salaries")}}</h4>
        </div>
        <div class="section-content p-4 shadow bg-white">
            <div class="d-flex gap-2 justify-content-between align-items-center flex-wrap mb-2">
                <div class="status-info d-flex gap-1 align-items-center justify-content-start flex-wrap">
                    <div class="bg-info text-white p-2 rounded-3">{{ __('admin.Total employee salary') }} {{ $users->sum('salary') }}</div>
                    <div class="bg-info text-white p-2 rounded-3">{{ __('admin.Financial discount') }} {{ $sum_discounts }} </div>
                </div>
                <div class="holder-btn d-flex gap-1 align-items-end justify-content-end flex-wrap">
                    <button class="btn trans-btn btn-sm px-3" wire:click="$set('screen','discounts')">{{ __('admin.discounts') }}</button>
                    <button class="btn trans-btn btn-sm px-3" wire:click="$set('screen','increases')">{{ __('admin.increases') }}</button>
                    <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning"><i class="fa-solid fa-print"></i></button>
                </div>
            </div>
            <div class="row g-3 mb-2">
                <div class="col-12 col-md-6">
                    <div class="info-box w-50">
                        <select id="" wire:model="filter_by_user" class="main-select w-200px">
                            <option value="">{{ __('admin.users') }}</option>
                            @foreach ($all_users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-end align-items-end gap-1">
                    <button class="btn btn-success btn-sm px-3" wire:click='$set("screen","add-discount")'>{{ __('admin.Add discount') }}</button>
                    <button class="btn btn-success btn-sm px-3" wire:click='$set("screen","add-increase")'>{{ __('admin.Add increase') }}</button>
                </div>

            </div>
            <div id="prt-content" class="table-print">
                <x-header-invoice></x-header-invoice>
                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('admin.Month') }}</th>
                                <th>{{ __('admin.employee') }}</th>
                                <th>{{ __('admin.Salary') }}</th>
                                <th>{{ __('admin.Discount') }}</th>
                                <th>الزياده</th>
                                <th>{{ __('admin.rate') }}</th>
                                <th>مبلغ النسبه</th>
                                <th>{{ __('admin.Total with rate') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td scope="row">{{ $loop->index+1 }}</td>
                                <td scope="row">{{ __('admin.Month') }} {{ now()->format('m') }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->salary }}</td>
                                <td>{{ $user->monthly_discounts }}</td>
                                <td>{{ $user->increases->sum("amount") }}</td>
                                <td>{{ $user->rate }}%</td>
                                <td>{{ $user->monthly_income_from_invoices }}</td>
                                <td>{{ ($user->monthly_income_from_invoices +$user->salary + $user->increases->sum("amount") )- $user->monthly_discounts }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @php
                        $total = ($user->monthly_income_from_invoices +$user->salary )- $user->monthly_discounts;

                        @endphp
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{ $user->sum('salary') }}</td>
                                {{-- <td>{{ $user->monthly_discounts ?  $user->sum('monthly_discounts')  : ' '}}</td>--}}
                                <td>{{ $user->monthly_income_from_invoices ?  $user->sum('monthly_income_from_invoices')  : ' '}}</td>
                                <td>%{{ $user->rate ?  $user->sum('rate')  : ' '}}</td>
                                <td>%{{ $total}}</td>

                            </tr>
                        </tfoot>
                    </table>
                    {{ $users->links() }}
                </div>

            </div>

            @if (count($discounts)>0)
            <div class="">
                <h4>{{ __('admin.discounts') }}</h4>
                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('admin.Month') }}</th>
                                <th>{{ __('admin.Discount') }}</th>
                                <th>{{ __('admin.Date') }}</th>
                                <th>{{ __('admin.reason') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($discounts as $discount)
                            <tr>
                                <td scope="row">{{ $loop->index+1 }}</td>
                                <td scope="row">{{ __('admin.Month') }} {{ now()->format('m') }}</td>
                                <td>{{ $discount->amount }}</td>
                                <td>{{ $discount->date }}</td>
                                <td>{{ $discount->reason }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $discounts->links() }}
                </div>
            </div>
            @else


            @if (count($increases)>0)
            <div class="">
                <h4>{{ __('admin.discounts') }}</h4>
                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('admin.Month') }}</th>
                                <th>{{ __('admin.Discount') }}</th>
                                <th>{{ __('admin.Date') }}</th>
                                <th>{{ __('admin.reason') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($increases as $increase)
                            <tr>
                                <td scope="row">{{ $loop->index+1 }}</td>
                                <td scope="row">{{ __('admin.Month') }} {{ now()->format('m') }}</td>
                                <td>{{ $increase->amount }}</td>
                                <td>{{ $increase->date }}</td>
                                <td>{{ $increase->reason }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $increases->links() }}
                </div>
            </div>
            @endif


            @endif

        </div>
        @else
        @include('front.salaries.'.$screen)
        @endif
    </div>
</section>