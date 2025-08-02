<section class="main-section users">
    <x-alert></x-alert>

    <div class="container-fluid">
        <div class="d-flex mb-3 gap-3 align-items-center ">
            @if (in_array($screen, ['create', 'edit']))
                <button type="button" wire:click='$set("screen","index")' class="btn bg-main-color text-white">
                    <i class="fas fa-angle-right"></i>
                </button>
            @else
                <a href="{{ route('front.reports') }}" class="btn bg-main-color text-white">
                    <i class="fas fa-angle-right"></i>
                </a>
            @endif
            <h4 class="main-heading m-0">{{ __('admin.Purchases') }}</h4>
        </div>
        @if ($screen == 'index')
            <div class="section-content p-4 bg-white rounded-3 shadow">
                <div class="d-flex align-items-center flex-wrap gap-1 justify-content-end mb-3">
                    <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning">
                        <i class="fa-solid fa-print"></i>
                    </button>
                    <button class="btn-main-sm" wire:click='$set("screen","create")'>
                        {{-- data-bs-toggle="modal" data-bs-target="#add_or_update"  --}}
                        {{ __('admin.Add a purchase invoice') }}
                        <i class="icon fa-solid fa-plus me-1"></i>
                    </button>
                    <a href="{{ route('front.purchase-categories') }}" class="btn btn-primary btn-sm">اقسام
                        المشتريات</a>
                </div>
                <div id="prt-content" class="table-print">
                    <x-header-invoice></x-header-invoice>
                    <div class="table-responsive">
                        <table class="table main-table">
                            <thead>
                                <tr>
                                    <th>{{ __('Invoice no.') }}</th>
                                    <th>{{ __('Company Name') }}</th>
                                    <th>{{ __('Tax number') }}</th>
                                    <th>{{ __('Invoice Type') }}</th>
                                    <th>{{ __('admin.parent_category') }}</th>
                                    <th>{{ __('admin.child_category') }}</th>
                                    <th>{{ __('admin.supply') }}</th>
                                    <th>{{ __('admin.qty') }}</th>
                                    <th>{{ __('admin.Date') }}</th>
                                    <th>{{ __('admin.amount') }}</th>
                                    <th>{{ __('admin.Taxes included') }}</th>
                                    <th>{{ __('Tax rate') }}</th>
                                    <th class="text-center not-print">{{ __('admin.delivery') }}</th>
                                    <th class="text-center not-print">{{ __('admin.managers') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchases as $purchase)
                                    <tr>
                                        <td>{{ $purchase->id }}</td>
                                        <td>{{ $purchase->name }}</td>
                                        <td>{{ $purchase->tax_number }}</td>
                                        <td>{{ __($purchase->type) }}</td>
                                        <td>{{ $purchase->category?->name ?? '--' }}</td>
                                        <td>{{ $purchase->categoryChild?->name ?? '--' }}</td>
                                        <td>{{ $purchase->supply?->name ?? '--' }}</td>
                                        <td>{{ $purchase->qty }}</td>
                                        <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $purchase->amount }}</td>
                                        <td>{{ $purchase->tax ? __('Yes') : __('No') }}</td>
                                        <td>{{ $purchase->tax ? $purchase->tax_value : '-' }}</td>
                                        <td>
                                            @if ($purchase->type == 'stocks')
                                                @if (!$purchase->date)
                                                    <button class="btn btn-success btn-sm"
                                                        wire:click='supply({{ $purchase->id }})'>تم الاستلام</button>
                                                @else
                                                    تم الاستلام في {{ $purchase->date }}
                                                @endif
                                            @else
                                                --
                                            @endif
                                        </td>
                                        <td class="not-print">
                                            <div class="d-flex align-items-center justify-content-center gap-1">
                                                <button class="btn btn-sm btn-info text-white ms-1"
                                                    wire:click='edit({{ $purchase }})'>
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#delete_agent{{ $purchase->id }}">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('front.purchases.delete')
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            @include('front.purchases.add_or_update')
        @endif

    </div>
</section>
