@section('title')
@lang('Bank account')
@endsection
<section class="main-section">
    <div class="container">
        <div class="p-3 shadow rounded-3 bg-white">
            <div class="d-flex mb-3">
                <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                    <i class="fas fa-angle-right"></i>
                </a>
            </div>
            <h4 class="main-heading mb-4">
                @lang('Bank account')
            </h4>
            <x-message-admin />
            <div class="d-flex align-items-center justify-content-end mb-2">
                <a href="{{ route('front.bank-accounts.create') }}" class="btn-main-sm">
                    <i class="fas fa-plus"></i>
                     @lang('Add bank account')
                </a>
            </div>


            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('Account name')</th>
                            <th>@lang('Account number bank')</th>
                            <th>@lang('Balance')</th>
                            <th>@lang('actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bank_accounts as $k=>$bank)
                        <tr>
                            <td>{{ $k + 1 }}</td>
                            <td>{{ $bank->account_name }}</td>
                            <td>{{ $bank->account_number }}</td>
                            <td>{{ $bank->balance }}</td>
                            <td>

                                <a href="{{ route('front.bank-accounts.edit', $bank) }}" class="btn btn-sm btn-info"><i></i>
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_agent{{ $bank->id }}"><i></i>
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                                @include('livewire.bank-accounts.delete')
                                <!-- /.modal -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $bank_accounts->links() }}
            </div>
            <!-- end table-responsive -->
        </div>
    </div>
</section>
