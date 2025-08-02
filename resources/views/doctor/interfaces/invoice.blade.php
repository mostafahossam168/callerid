<section>
    <div class="alert alert-info w-fit mx-auto" role="alert">
        {{ __('admin.The invoice will be collected by the receptionist or accountant') }}
    </div>
    <div class="main-container mb-4 d-flex flex-column flex-md-row align-items-start  justify-content-center">
        <div class="right-side w-75 sw-100 ms-3 mb-4 mb-md-0">
            <div class="info-box d-flex flex-column">
                <div class="row gx-2 gy-3">
                    <div class="col-12 col-md-6">
                        @if ($patient->animals->count() > 0)
                            <div class="inp-holder">
                                <select wire:model="animal_id" name="animal_id" class="main-select w-100">
                                    <option value="">@lang('admin.Choose the pet')</option>
                                    @foreach ($patient->animals as $animal)
                                        <option value="{{ $animal->id }}">
                                            {{ $animal->name ?? $animal->gender }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <p class="tip-text text-danger">{{ __('admin.Please add an animal') }}</p>
                        @endif
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="inp-holder">
                            <select wire:model="selected_department_id" class="main-select w-100">
                                <option value="">{{ __('Choose department') }}</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="row g-1 gy-2">
                            <div class="col-12 col-md-9">
                                <div class="inp-holder">
                                    <input type="text" class="form-control"
                                           placeholder="{{ __('admin.You can search by service name') }}"
                                           wire:model="product_name" wire:keyup="getProduct($event.target.value)">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="btn-holder">
                                    <a target="_blank" href="{{ route('front.products.index') }}"
                                       class="btn btn-sm btn-primary w-100">{{ __('products') }}</a>
                                </div>
                            </div>
                            @if ($all_products && count($all_products) > 0)
                                <div class="col-12 col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            @foreach ($all_products as $key => $pro)
                                                <tr>
                                                    <td>{{ $pro['name'] }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-success"
                                                                wire:click="chooseProduct({{ $pro['id'] }})"><i
                                                                class="fa fa-check"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @can('sub_quantity_inventory')
                        <div class="col-12 col-md-12">
                            <div class="row g-1 gy-2">
                                <div class="col-12 col-md-4">
                                    <div class="inp-holder">
                                        <input type="number" wire:model='item_id'
                                               placeholder="{{ __('admin.Barcode search') }}" class="form-control"
                                               wire:keyup='add_item_barcode'>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="btn-holder">
                                        <a target="_blank" href="{{ route('front.items') }}"
                                           class="btn btn-sm btn-primary w-100">{{ __('admin.Products') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="" class="small-label">{{ __('admin.item_categories') }}</label>
                                <select wire:model.live="category_id" id="" class="main-select w-100">
                                    <option value="">
                                        {{ __('admin.choose') }}
                                    </option>
                                    @foreach ($categories ?? [] as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="inp-container ms-0 ms-md-2 w-100">
                            <label for="">
                                اسم المنتج
                                <small class="text-secondary">({{ __('admin.Service number search') }})</small>
                            </label>
                            <input type="text" class="form-control" wire:model="item_name"
                                   wire:keyup="getItem($event.target.value)">
                        </div>
                        @if ($all_items && count($all_items) > 0)
                            <div class="inp-container w-100 mt-3">
                                <table class="table table-bordered">
                                    @foreach ($all_items as $key => $item)
                                        <tr>
                                            <td>{{ $item['name'] }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-success"
                                                        wire:click="chooseItem({{ $item['id'] }})"><i
                                                        class="fa fa-check"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @endif

                    @endcan
                </div>


                {{-- <div class="inp-container w-100 mb-3">
                    <label for="" class="small-label">{{ __('service') }}</label>
                <select wire:model="product_id" class="main-select w-100" wire:change='add_product'>
                    <option value="">{{ __('Choose the service') }}</option>
                    @foreach (\App\Models\Product::query()->where('department_id', $selected_department_id)->get() as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div> --}}

                {{-- <div class="inp-container ms-0 ms-md-2 w-100 mb-3">
                    <label for="" class="small-label">{{ __('admin.Status') }}</label>
            <select wire:model="status" id="" class="main-select w-100">
                <option value="">{{ __('admin.Status') }}</option>
                <option value="Paid">{{ __('admin.Paid') }}</option>
                <option value="Unpaid">{{ __('admin.Unpaid') }}</option>
                <option value="Partially Paid">{{ __('Partially Paid') }}</option>
            </select>
        </div> --}}

                {{-- <div class="inp-container d-flex align-items-center mb-3 w-100">
                    <label for="split" class="small-label ms-2 form-check-label">{{ __('admin.split bill') }}</label>
        <input type="checkbox" wire:model="split" id="split" class="form-check-input mt-0">
    </div>
    <div class="inp-container d-flex flex-column w-100 {{ $split ? '' : 'd-none' }}">
        <label for="split" class="small-label mb-2">{{ __('admin.splits number') }}</label>
        <input type="number" wire:model="split_number" id="" wire:keyup='computeForAll' class="w-100 form-control">
    </div> --}}
            </div>

        </div>
        <div class="left-side w-50 sw-100">
            <div class="output-box d-flex flex- align-items-center justify-content-end mb-2">
                <span class="a_word ms-2"> {{ __('admin.amount') }} : </span>
                <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                       wire:model="amount"/>
            </div>
            @can('discount_invoices')
                <div class="output-box d-flex align-items-center justify-content-end mb-2">
                    <span class="a_word ms-2"> {{ __('admin.discount') }} :</span>
                    <input type="text" placeholder="0" class="text-center form-control w-50" wire:model="discount"/>
                </div>
            @endcan
            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                <span class="a_word ms-2"> {{ __('admin.Discount_Offers') }} :</span>
                <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                       wire:model="offers_discount"/>
            </div>
            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                <span class="a_word ms-2 space-noWrap"> {{ __('admin.Amount after discount of offers') }} :</span>
                <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                       wire:model="amount_after_offers_discount"/>
            </div>
            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                <span class="a_word ms-2"> {{ __('admin.tax') }} : </span>
                <input readonly type="text" placeholder="0" class="text-center form-control w-50" wire:model="tax"/>
            </div>
            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                <span class="a_word ms-2 space-noWrap"> {{ __('admin.Total with tax') }} : </span>
                <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                       wire:model="total"/>
            </div>

            <div class="output-box d-flex align-items-center justify-content-end mb-2 {{ $split ? '' : 'd-none' }}">
                <span class="a_word ms-2"> {{ __('admin.Total after split') }} : </span>
                <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                       wire:model="total_after_split"/>
            </div>

            <!-- <div class="output-box d-flex align-items-center justify-content-end mb-2">
                <span class="a_word ms-2"> {{ __('admin.cash') }}</span>
                <input type="number" placeholder="0" class="text-center form-control w-50" wire:model="cash"
                    wire:keyup="calculateNet" />
            </div>

            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                <span class="a_word ms-2"> {{ __('admin.card') }} : </span>
                <input type="number" placeholder="0" class="text-center form-control w-50" wire:model="card"
                    wire:keyup="calculateNet" />
            </div>

            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                <span class="a_word ms-2"> {{ __('admin.rest') }} : </span>
                <input type="text" placeholder="0" class="text-center form-control w-50" wire:model="rest" />
            </div> -->
        </div>
    </div>


    @if (count($product_items) > 0)
        <h5 class="text-center">{{ __('admin.Products') }}</h5>
        <div class="table-responsive ">
            <table class="table main-table">
                <thead>
                <tr>
                    <th>{{ __('admin.department') }}</th>
                    <th>{{ __('admin.product') }}</th>
                    <th>{{ __('admin.quantity') }}</th>
                    {{-- <th>نوع الضريبة</th> --}}
                    <th>{{ __('admin.price') }}</th>
                    <th>{{ __('admin.Tax rate') }}</th>
                    <th>{{ __('admin.Total') }}</th>
                    <th>{{ __('admin.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($product_items as $key => $item)
                    <tr>
                        <td>{{ __($item['department']) }}</td>
                        <td>{{ $item['product_name'] }}</td>
                        <td><input type="text" class="form-control w-150px text-center mx-auto"
                                   wire:keyup="changeQtyAndComputeProducts({{ $key }})"
                                   wire:model="product_items.{{ $key }}.quantity"></td>
                        {{-- <td>{{ $item['tax_type_ar'] }}</td> --}}
                        <td>{{ $item['price'] }}</td>
                        <td>{{ $item['tax'] }}</td>
                        {{-- <td>
                                <input type="number" wire:model="product_items.{{ $key }}.sub_total"
                                    id="" wire:keyup="changeQtyAndComputeProducts({{ $key }})"
                                    class="form-control w-150px text-center mx-auto" readonly disabled>
                            </td> --}}
                        <td>{{ $item['sub_total'] }}</td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center gap-1">
                                <button class="btn btn-sm btn-danger"
                                        wire:click="delete_product({{ $key }})">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    @endif

    <div class="table-responsive mt-4">
        <div class="table-responsive ">
            <table class="table main-table">
                <thead>
                <tr>
                    <th>{{ __('admin.department') }}</th>
                    <th>{{ __('admin.product') }}</th>
                    <th>{{ __('admin.quantity') }}</th>
                    {{-- <th>نوع الضريبة</th> --}}
                    <th>{{ __('admin.price') }}</th>
                    <th>{{ __('admin.Tax rate') }}</th>
                    <th>{{ __('admin.Total') }}</th>
                    <th>{{ __('admin.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $key => $item)
                    <tr>
                        <td>{{ __($item['department']) }}</td>
                        <td>{{ $item['product_name'] }}</td>
                        <td><input type="text" class="form-control w-150px text-center mx-auto"
                                   wire:keyup="changeQtyAndComputeItems({{ $key }})"
                                   wire:model="items.{{ $key }}.quantity"></td>
                        {{-- <td>{{ $item['tax_type_ar'] }}</td> --}}
                        <td>{{ $item['price'] }}</td>
                        <td>{{ $item['tax'] }}</td>
                        {{-- @can('خصم الفاتورة') --}}
                        {{-- <td>
                                <input type="number" wire:model="items.{{ $key }}.sub_total"
                                    id="" wire:keyup="changeQtyAndComputeItems({{ $key }})"
                                    class="form-control w-150px text-center mx-auto" readonly disabled>
                            </td> --}}
                        <td>{{ $item['sub_total'] }}</td>
                        {{-- @endcan --}}
                        <td>
                            <div class="d-flex align-items-center justify-content-center gap-1">
                                <button class="btn btn-sm btn-danger"
                                        wire:click="delete_item({{ $key }})">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="The-text-area w-100">
        <textarea wire:model.defer="notes" id="" class="form-control w-100 p-2"
                  placeholder="{{ __('admin.notes') }}"></textarea>
    </div>
    <div class="submitBtn-holder text-center mt-3">
        <button class="btn btn-secondary w-25">
            {{ __('admin.previous') }}
        </button>
        <button wire:click='addInvoice' class="btn btn-success w-25">
            {{ __('admin.next') }}
        </button>
    </div>
</section>
