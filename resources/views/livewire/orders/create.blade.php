<section class="app my-3 main-section">
    <div class="container">
        <x-alert></x-alert>
        <div class="row g-3 cards hide-print">

            <div class="col-xl-8 special-medal-col">
                <div class="card-app ">
                    <div class="list-btn flex-wrap  justify-content-between">
                        <div class="d-flex align-items-center  justify-content-between flex-wrap flex-sm-nowrap gap-2">
                            <div class="text-info text-nowrap">
                                {{ __('admin.Outstanding_billing') }}:
                            </div>
                            <select class="main-select w-120px" wire:model='unpaid_order_id' wire:change='edit'>
                                <option value="">{{ __('admin.Choose_invoice') }}</option>
                                @foreach ($unpaid_orders as $order)
                                    <option value="{{ $order->id }}">{{ __('site.Invoice') }} {{ $order->id }}
                                    </option>
                                @endforeach
                            </select>

                            <select class="main-select w-120px" wire:model='category_id'>
                                <option value="">{{ __('admin.choose') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <b>{{ $date }}</b>
                            <div class="text-info">
                                {{ __('admin.invoice_number') }}: {{ $order_id }}
                            </div>
                        </div>
                    </div>
                    <div class="title-card-app  d-flex align-items-center flex-wrap gap-2 justify-content-between ">
                        <div class="d-flex  align-items-center  gap-1 ">
                            <input type="text" wire:model.defer="client_phone" id=""
                                class="form-control w-60" placeholder="{{ __('admin.Search_By_Customer_mobile') }}">
                            <input readonly type="text" class="{{ $client ? '' : 'd-none' }} form-control w-25"
                                value="{{ $client?->name }}">

                            @if ($client)
                                @if ($client->animals->count() > 0)
                                    <div class="inp-container ms-0 ms-md-2 w-100">
                                        <label for="" class="small-label">@lang('admin.Choose the pet')</label>
                                        <select wire:model="animal_id" class="main-select w-100">
                                            <option value="">{{ __('admin.choose') }}</option>
                                            @foreach ($client->animals as $animal)
                                                <option value="{{ $animal->id }}">
                                                    {{ $animal->name ?? $animal->gender }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <p class="tip-text text-danger">{{ __('admin.Please add an animal') }}</p>
                                @endif
                            @endif
                            <button wire:click='getClient'
                                class="btn btn-sm btn-primary">{{ __('site.search') }}</button>
                        </div>
                        <div class="d-flex align-items-center justify-content-end gap-1 ">
                            <input type="text" id="Qrcode" class="form-control w-60" placeholder="Qrcode"
                                wire:model='qr_code'>
                            {{-- <button class="btn btn-sm btn-success">{{__('admin.Add')}}</button> --}}
                        </div>
                    </div>

                    <div class="body-card-app content py-2">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="">
                                <div class="mb-3 d-flex gap-2">
                                    <input type="text" wire:model="product_id" id=""
                                        class="form-control w-30" placeholder="{{ __('admin.Barcode') }}">
                                    <input type="text" wire:model="product_name" id=""
                                        class="form-control w-30" placeholder="{{ __('admin.Product_name') }}">
                                </div>


                                <div class="list-orders">

                                    @foreach ($products as $product)
                                        <div class="order-btn h-100" wire:click="add_product({{ $product->id }})"
                                            @if (!$product->allow_quantity || ($product->allow_quantity && $product->quantity > 0)) wire:click="add_product({{ $product->id }})" @endif>
                                            <div
                                                class="about-product d-flex gap-1 flex-column align-items-center justify-content-center w-100 h-100 btn btn-primary btn-sm {{ !$product->allow_quantity || ($product->allow_quantity && $product->quantity > 0) ? 'btn-primary' : 'btn-danger' }}">
                                                <span class="fs-13px">{{ $product->name }}</span>
                                                <div class="d-flex align-items-center justify-content-center gap-1">
                                                    <span class="fs-11px">{{ number_format($product->sale_price, 2) }}
                                                        {{ __('admin.R.S') }}</span>
                                                    <span class="fs-11px">|</span>
                                                    <span class="fs-11px">{{ __('admin.quantity') }}:
                                                        {{ $product->quantity ?? 0 }}</span>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card-app">
                    <div class="body-card-app">
                        <div class=" box-table ">
                            <table class="table text-center shadow-none mb-0">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('admin.The product') }}</th>
                                    <th>{{ __('quantity') }}</th>
                                    <th>{{ __('admin.price') }}</th>
                                    <th>{{ __('admin.Total') }}</th>
                                    <th>{{ __('admin.Delete') }}</th>
                                </tr>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($items as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-nowrap">{{ $item['name'] }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-1">
                                                <div class="add-num control-num"
                                                    wire:click="increment({{ $key }})">
                                                    <i class="fa-solid fa-plus"></i>
                                                </div>
                                                <input class="form-control text-center p-1 "
                                                    style='width:50px !important' type="text" min="1" readonly
                                                    wire:model="items.{{ $key }}.quantity">
                                                <div class="decrease-num control-num"
                                                    wire:click="decrement({{ $key }})">
                                                    <i class="fa-solid fa-minus"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item['sale_price'] }}</td>
                                        <td>{{ $item['quantity'] * $item['sale_price'] }} </td>
                                        <td class="text-center">
                                            <div class="btn btn-sm btn-danger py-0 px-1"
                                                wire:click="delete_item({{ $key }})">
                                                <i class="fas fa-trash-can"></i>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $total += $item['quantity'] * $item['sale_price'];
                                    @endphp
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="body-card-app pt-2">
                        <div class="d-flex align-items-center  mb-2 gap-2 justify-content-end">
                            <label for="" class="text-info">
                                {{ __('admin.Amount_of_the_invoice') }}:
                            </label>
                            <input readonly type="text" oninput="checkInputNumber(this)" id=""
                                class="form-control w-60" value="{{ $amount }}">
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-2 justify-content-end">
                            <label for="" class="text-info">
                                {{ __('admin.Discount') }}:
                            </label>
                            <input type="text" oninput="checkInputNumber(this)" wire:model="discount"
                                class="form-control w-60">
                        </div>
                        @if ($offers_discount > 0)
                            <div class="d-flex align-items-center gap-2 mb-2 justify-content-end">
                                <label for="" class="text-info"> {{ __('admin.Discount_Offers') }} :</label>
                                <input readonly type="text" oninput="checkInputNumber(this)" placeholder="0"
                                    class="form-control w-60" wire:model="offers_discount" />
                            </div>
                            <div class="d-flex align-items-center gap-2 mb-2 justify-content-end">
                                <label for="" class="text-info">
                                    {{ __('admin.Amount after discount of offers') }}:</label>
                                <input readonly type="text" oninput="checkInputNumber(this)" placeholder="0"
                                    class="form-control w-60" wire:model="amount_after_offers_discount" />
                            </div>
                        @endif
                        <div class="d-flex align-items-center gap-2 mb-2 justify-content-end">
                            <label for="" class="text-info">
                                {{ __('admin.tax') }}:
                            </label>
                            <input readonly type="text" oninput="checkInputNumber(this)" id=""
                                class="form-control w-60" value="{{ $tax }}">
                        </div>
                        <div class="d-flex align-items-center gap-2  mb-2  justify-content-end">
                            <label for="" class="text-danger">
                                {{ __('admin.final_total') }}:
                            </label>
                            <input type="text" oninput="checkInputNumber(this)" id="" readonly
                                value="{{ floatval($total) + floatval($tax) - floatval($discount) - floatval($offers_discount) }}"
                                class="form-control text-danger w-60">
                        </div>

                        <div class="d-flex align-items-center gap-2 mb-2 justify-content-end">
                            <label for="" class="text-info">
                                {{ __('admin.Cash') }}:
                            </label>
                            <input type="text" oninput="checkInputNumber(this)" class="form-control w-60"
                                wire:model="cash">
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-2 justify-content-end">
                            <label for="" class="text-info">
                                {{ __('admin.card') }} - {{ __('admin.Mada') }}:
                            </label>
                            <input type="text" oninput="checkInputNumber(this)" class="form-control w-60"
                                wire:model="card">
                        </div>

                        <div class="d-flex align-items-center gap-2 mb-2 justify-content-end">
                            <label for="" class="text-info">
                                {{ __('admin.rest') }}
                            </label>
                            <input type="text" oninput="checkInputNumber(this)" readonly class="form-control w-60"
                                wire:model="rest">
                        </div>

                        <div class="d-flex align-items-center gap-2 mb-2">
                            <label for="" class="text-info">
                                {{ __('admin.Unpaid') }}
                            </label>
                            <input type="checkbox" class="form-check-input" wire:model="not_paid">
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row hide-print">
            <div class="col-xl-4 me-auto">
                <div class=" btns-control row my-3 row-gap-24">
                    <div class="col-sm-4">
                        <button wire:click='submit("card","unpaid")' class="btn-sm fs-12px btn-danger btn">
                            {{ __('admin.Invoice_suspension') }}
                        </button>
                    </div>
                    <div class="col-sm-4">
                        <button wire:click='submit("cash")' onclick="/*ourprint();*/"
                            class="btn-sm   btn-success btn fs-12px">
                            {{ __('admin.Pay') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ------------عرض الفاتورة------------- --}}


    <div class="invoice-content bg-white shadow rounded-3 pb-2 invoice-print" id="invoice-print"
        style="display: none">
        <h1 class="invoice-name text-center rounded-3 fw-bold mb-0 pt-2">
            {{ __('admin.Bill_Number') }}
            <br>
            #{{ $order->id ?? 0 }}
        </h1>
        <h4 class="  mb-2 fw-bold mb-3 text-center mt-2">
            {{ setting('website_name') }}
        </h4>
        <div class="the_date d-flex align-items-center justify-content-evenly mb-3">
            <div class="date-holder ">
                <small>{{ $order->date ?? '' }}</small>
            </div>
            <div class="date-holder ">
                <small>{{ isset($order) ? $order->created_at->format('H:i a') : '' }}</small>
            </div>
        </div>
        <div class="logo-holder m-auto text-center  rounded-3 mb-3">
            <img class="the_image mx-auto  h-auto rounded-3" src="{{ display_file(setting('logo_img')) }}"
                width="150" alt="logo">
        </div>
        <div class="me-2">
            <div class="tax-number  mb-2 fw-bold">
                <small>{{ __('admin.Tax_number') }} : <span class="">{{ setting('tax_no') }}</span></small>
            </div>
            <div class="the_address mb-4 fw-bold">
                <div class="address-holder">
                    <small>{{ setting('address') }}</small>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table main-table text-center rounded-3 w-100">
                <thead class="border-0">
                    <tr>

                        <th class="">
                            <div>{{ __('site.Description') }}</div>
                            <div class="">Description</div>
                        </th>

                        <th class="">
                            <div class="">{{ __('site.price') }}</div>
                            <div class="">price</div>
                        </th>

                        <th>
                            <div class="">{{ __('admin.quantity') }}</div>
                            <div class="">Qty</div>
                        </th>

                        <th>
                            <div class="">{{ __('site.The_Tax') }}</div>
                            <div class="">Vat</div>
                        </th>
                        <th>
                            <div class="">{{ __('admin.Total') }}</div>
                            <div class="">Total</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items ?? [] as $item)
                        <tr>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>
                                {{ $item->sale_price }}
                            </td>
                            <td>
                                {{ $item->quantity }}
                            </td>
                            <td>
                                {{ $item->tax }}
                            </td>
                            <td>
                                {{ $item->total * $item->quantity }}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="table-responsive second-table mt-2">
            <table class="table main-table" id="data-table">
                <tbody>
                    <tr>
                        <td colspan="2" class="text-end ">
                            <div class="text-center spechial-text">{{ __('admin.Total_before_discount_and_tax') }}
                            </div>
                            <div class="text-center spechial-text">Total before deduction and tax</div>
                        </td>
                        <td colspan="2"> {{ $order->amount ?? '' }}</td>
                    </tr>

                    <tr>
                        <td colspan="2" class="text-end ">
                            <div class="text-center spechial-text">{{ __('site.value_added_tax') }}</div>
                            <div class="text-center spechial-text">value added tax</div>
                        </td>
                        <td colspan="2"> {{ $order->tax ?? '' }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-end ">
                            <div class="text-center spechial-text"> {{ __('admin.Discount') }} Disc</div>
                            <!-- <div class="text-center spechial-text"></div> -->
                        </td>
                        <td colspan="2"> {{ $order->discount ?? '' }}</td>
                    </tr>
                    <tr class="">
                        <td colspan="1" class="text-end ">
                            <div class="text-center spechial-text"> {{ __('admin.Total') }} Total</div>
                            <!-- <div class="text-center spechial-text"></div> -->
                        </td>
                        <td colspan="3 " class="">{{ $order->total ?? '' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div class="bar_code_holder text-center">
            {!! $qrCode ?? '' !!}
        </div>
        <div class="d-flex justify-content-center not-print mt-3">
            <button class="btn btn-sm btn-info" onclick="print()">print</button>
        </div>

    </div>
    <style>
        @media print {
            .hide-print {
                display: none;
            }

            .invoice-print {
                display: block !important;
            }
        }
    </style>

</section>
