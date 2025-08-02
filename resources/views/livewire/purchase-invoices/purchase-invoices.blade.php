<section class="main-section users">
    <x-alert></x-alert>
    <div class="container">
        <div class="d-flex mb-3 gap-3 align-items-center ">
            <h4 class="main-heading m-0">{{ __('admin.Purchases') }}</h4>
        </div>
        <div class="section-content p-4 bg-white rounded-3 shadow">
            <div class="d-flex align-items-center flex-wrap gap-1 justify-content-end mb-3">
                <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning">
                    <i class="fa-solid fa-print"></i>
                </button>
                <a class="btn-main-sm" href="{{ route('front.purchase_invoices.create') }}">
                    {{ __('admin.Add a purchase invoice') }}
                    <i class="icon fa-solid fa-plus me-1"></i>
                </a>

            </div>
            <div id="prt-content" class="table-print">
                <x-header-invoice></x-header-invoice>
                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>{{ __('Invoice no.') }}</th>
                                <th>{{ __('Supplier') }}</th>
                                <th>{{ __('Warehouse') }}</th>
                                <th>{{ __('amount') }}</th>
                                <th>{{ __('admin.tax') }}</th>
                                <th>{{ __('admin.total') }}</th>
                                <th class="text-center not-print">{{ __('admin.managers') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchase_invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->supplier->name }}</td>
                                    <td>{{ $invoice->warehouse->name }}</td>
                                    <td>{{ $invoice->amount }}</td>
                                    <td>{{ $invoice->tax }}</td>
                                    <td>{{ $invoice->total }}</td>
                                    <td class="not-print">
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <a href="{{ route('front.purchase_invoices.edit', $invoice->id) }}"
                                                class="btn btn-sm btn-info text-white ms-1">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete_agent">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('livewire.purchase-invoices.delete')
                </div>
            </div>
        </div>
    </div>
</section>
