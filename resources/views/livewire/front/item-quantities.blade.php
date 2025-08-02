<section class="main-section" style="height: 474px;">
    <div class="container h-100">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <h4 class="main-heading">{{ $item->name }}</h4>
            <div class="d-flex gap-2">
               <div>
                   <label>من</label>
                   <input class="form-control" type="date" wire:model="from" id="">
               </div>

                <div>
                    <label>الي</label>
                    <input class="form-control" type="date" wire:model="to" id="">
                </div>
            </div>


            <div class="d-flex align-items-center flex-wrap gap-1">
                <a type="button" class="btn btn-sm btn-secondary" href="{{ route('front.items') }}">
                    {{ __('admin.Products') }}
                </a>

            </div>


        </div>
        <div class="section-content p-4 bg-white rounded-3 shadow">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h5 class="text-center small-heading mb-2">{{ __('admin.Shipping operations') }}</h5>
                    <div class="table-responsive">
                        <table class="table main-table">
                            <thead>
                            <tr>
                                <th>{{ __('admin.the_quantity') }}</th>
                                <th>{{ __('admin.warehouse') }}</th>
                                <th>{{ __('admin.Date') }}</th>
                                <th>{{ __('admin.Employee') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($all_charges as $product)
                                <tr>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->warehouse?->name }}</td>
                                    <td>{{ $product->created_at->isoFormat('Y-M-D') }}</td>
                                    <td>{{ $product->employee?->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <h5 class="text-center small-heading mb-2">{{ __('admin.Exchange operations') }}</h5>
                    <div class="table-responsive">
                        <table class="table main-table">
                            <thead>
                            <tr>
                                <th>{{ __('admin.the_quantity') }}</th>
                                <th>{{ __('admin.from_warehouse') }}</th>
                                <th>{{ __('admin.to_warehouse') }}</th>
                                <th>{{ __('admin.Date') }}</th>
                                <th>{{ __('admin.Employee') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($all_expenses as $product)
                                <tr>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->from_warehouse?->name }}</td>
                                    <td>{{ $product->to_warehouse?->name }}</td>
                                    <td>{{ $product->created_at->isoFormat('Y-M-D') }}</td>
                                    <td>{{ $product->employee?->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
