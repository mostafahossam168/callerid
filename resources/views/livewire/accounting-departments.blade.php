<section class="main-section">
    <div class="container">
        <h4 class="main-heading">{{ __('accounting management') }}</h4>
        @include('front.layouts.accounting-menu')
        <div class="bg-white shadow p-4 rounded-3">
            <div class="alert alert-info fs-13px mb-2" role="alert">
                @lang('You can define accounts and link them to invoicess')
            </div>
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>@lang('service')</th>
                            <th>@lang('Account')</th>
                            {{-- <th>{{ __('actions') }}</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $key => $accountId)
                        <tr>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td>
                                {{ $key == 'unpaid' ? __('Deferred to the patient') :__($key) }}
                            </td>
                            <td>
                                <select wire:change='submit' wire:model='departments.{{ $key }}' id="" class="main-select w-100">
                                    <option value="">@lang('Choose account')</option>
                                    @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            {{-- <td>
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <button class="btn btn-sm btn-info">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>  --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>
