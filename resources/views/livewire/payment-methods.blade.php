<section class="main-section users">

    <x-alert></x-alert>
    @include('front.payment_methods.modal')

    <div class="container">
        <h4 class="main-heading">{{ __('admin.payment_methods') }}</h4>
        <div class="section-content p-4 bg-white rounded-3 shadow">
            <div class="d-flex align-items-center flex-wrap gap-1 justify-content-between mb-3">
                @can('create_payment_methods')
                    <button type="button" class="btn-main-sm px-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        {{ __('admin.Add') }}
                    </button>
                @endcan
            </div>

            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('admin.name') }}</th>
                            <th scope="col">{{ __('admin.is_active') }}</th>
                            <th scope="col">{{ __('admin.account_id') }}</th>
                            <th scope="col">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payment_methods as $payment_method)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $payment_method->name }}</td>
                                <td>{{ $payment_method->is_active == 1 ? 'نعم' : 'لا' }}</td>
                                <td>{{ $payment_method->account?->name }}</td>
                                <td>
                                    @can('update_payment_methods')
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" wire:click="edit({{ $payment_method->id }})">
                                            {{ __('admin.Update') }}
                                        </button>
                                    @endcan

                                    @can('delete_payment_methods')
                                        @if ($payment_method->vouchers() == 0)
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $payment_method->id }}">
                                                {{ __('admin.Delete') }}
                                            </button>
                                            @include('front.payment_methods.delete')
                                        @endif
                                    @endcan

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $payment_methods->links() }}
            </div>
        </div>
    </div>
</section>
