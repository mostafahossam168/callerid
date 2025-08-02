<section class="main-section">
    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading">{{ __('admin.Add invoice') }}</h4>
        <div class="addNvoice-content bg-white p-4 shadow">
            <div class="tip">
                <div class="main-container d-flex flex-column flex-md-row align-items-center justify-content-center">
                    <div class="right-side w-75 ms-3  mb-md-0">
                        <div class="info-box d-flex flex-column flex-md-row mb-3">
                            <div class="inp-container ms-0 ms-md-2  w-100">
                                <label for="" class="small-label">{{ __('admin.Enter') }}</label>
                                <input type="text" wire:model="patient_key"
                                    class="form-control w-100 px-1 sm-placeholder" wire:keyup='get_patient'
                                    placeholder="{{ __('admin.Patient file number or ID number') }}" />
                            </div>
                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="" class="small-label">{{ __('admin.patient') }}</label>
                                <input type="text" value="{{ $patient ? $patient->name : '' }}" readonly
                                    id="" class="form-control w-100" />
                            </div>

                            @can('check_phone_patients')
                                <div class="inp-container ms-0 ms-md-2 w-100">
                                    <label for="" class="small-label">{{ __('admin.phone') }}</label>
                                    <input type="tel" value="{{ $patient ? $patient->phone : '' }}" readonly
                                        id="" class="form-control w-100" />
                                </div>
                            @endcan
                            @if ($patient)
                                @if ($patient->animals->count() > 0)
                                    <script>
                                        // $(document).ready(function() {
                                        //     $('.js-example-basic-multiple').select2();
                                        // });
                                    </script>
                                    <div class="inp-container ms-0 ms-md-2 w-100" wire:ignore.self>
                                        <label for="" class="small-label">@lang('admin.Choose the pet')</label>
                                        <select wire:model="animals" multiple name="animal_id"
                                            class=" js-example-basic-multiple main-select w-100">
                                            @foreach ($patient->animals as $animal)
                                                <option value="{{ $animal->id }}">
                                                    {{ $animal->name ?? $animal->gender }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <p class="tip-text text-danger">{{ __('admin.Please add an animal') }}</p>
                                @endif
                            @endif
                        </div>

                        <div class="info-box d-flex flex-column flex-md-row mb-3">
                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="" class="small-label">{{ __('admin.Status') }}</label>
                                <select wire:model="status" id="" class="main-select w-100">
                                    <option value="">{{ __('admin.Status') }}</option>
                                    <option value="Paid">{{ __('admin.Paid') }}</option>
                                    <option value="Unpaid">{{ __('admin.Unpaid') }}</option>
                                    <option value="Partially Paid">{{ __('Partially Paid') }}</option>
                                    <option value="cash">{{ __('admin.cash') }}</option>
                                    <option value="card">{{ __('admin.card') }}</option>
                                    <option value="bank_transfer">{{ __('admin.bank_transfer') }}</option>
                                    <option value="retrieved">{{ __('admin.retrieved') }}</option>
                                </select>
                            </div>
                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="" class="small-label">{{ __('admin.Clinic') }}</label>
                                <select wire:model="department_id" id="" class="main-select w-100">
                                    <option value="">
                                        {{ __('admin.Choose Clinic') }}
                                    </option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="" class="small-label">{{ __('admin.dr') }}</label>
                                {{-- <select wire:model="dr_id" id="" class="main-select w-100">
                                    <option value="">{{ __('admin.dr') }}</option>
                                @foreach ($doctors as $dr)
                                <option value="{{ $dr->id }}">{{ $dr->name }}</option>
                                @endforeach
                                </select> --}}
                                <input type="text" value="{{ doctor()->name }}" readonly class="form-control">
                            </div>
                        </div>
                        {{-- <p class="sm-heading fs-13px my-2">{{__('admin.You can search by name of therapeutic services')}}</p> --}}
                        <div
                            class="info-box d-flex align-items-end justify-content-center gap-3 flex-column flex-md-row">

                            {{-- <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="">
                                    {{ __('admin.Service name') }}
                            <small class="text-secondary">({{__('admin.Service number search')}})</small>
                            </label>
                            <input type="text" class="form-control" wire:model="product_name" wire:keyup="getProduct($event.target.value)">
                        </div> --}}

                            {{-- <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="" class="small-label">{{ __('admin.product') }}</label>
                        <select wire:model="product_id" id="" class="main-select w-100" wire:change='add_product'>
                            <option value="">{{ __('admin.product') }}</option>
                            @foreach ($all_products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                            {{-- <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="" class="small-label">{{ __('admin.product') }}</label>
                    <input type="number" wire:model='product_id' class="form-control" wire:keyup='add_product'>
                </div> --}}

                            {{-- <div class="inp-container w-100 ">
                    <a target="_blank" href="{{ route('front.products.index') }}" class="btn btn-sm btn-primary px-4">{{ __('admin.services') }}</a>
            </div> --}}
                            {{-- <div class="inp-container d-flex align-items-center mb-2 w-100">
                                <label for="split" class="small-label ms-2 form-check-label text-danger">{{
                                    __('admin.split bill') }}</label>
            <input type="checkbox" wire:model="split" id="split" class="form-check-input mt-0">
        </div>
        <div class="inp-container d-flex flex-column w-100 {{ $split ? '' : 'd-none' }}">
            <label for="split" class="small-label mb-2">{{ __('admin.splits number') }}</label>
            <input type="number" wire:model="split_number" id="" wire:keyup='computeForAll' class="w-100 form-control">
        </div> --}}

                        </div>
                        @if ($all_products && count($all_products) > 0)
                            <div class="inp-container w-100 mt-3">
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
                        @endif
                        <p class="sm-heading fs-13px my-2">{{ __('admin.You can choose the products') }}</p>
                        <div
                            class="info-box d-flex align-items-end justify-content-center gap-3 flex-column flex-md-row">
                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="" class="small-label">{{ __('admin.The product') }}</label>
                                <select wire:model="item_id" id="" class="main-select w-100"
                                    wire:change='add_item'>
                                    <option value="">{{ __('admin.The product') }}</option>
                                    @foreach ($all_items as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="" class="small-label">{{ __('admin.Barcode search') }}</label>
                                <input type="number" wire:model='item_id' class="form-control"
                                    wire:keyup='add_item_barcode'>
                            </div>

                            <div class="inp-container w-100 ">
                                <a target="_blank" href="{{ route('front.items') }}"
                                    class="btn btn-sm btn-primary px-4">{{ __('admin.Products') }}</a>
                            </div>
                            {{-- <div class="inp-container d-flex align-items-center mb-2 w-100">
                                <label for="split" class="small-label ms-2 form-check-label text-danger">{{
                                    __('admin.split bill') }}</label>
        <input type="checkbox" wire:model="split" id="split" class="form-check-input mt-0">
    </div> --}}

                        </div>
                        {{-- <div class="inp-container ms-0 ms-md-2 mt-3 mb-3">
                            <label for="" class="small-label">عدد النقاط</label>
                            <input disabled type="number" class="form-control w-180px"
                                value="{{ $patient ? $patient->points : '' }}" />
    @if ($pointOffers->count() > 0)
    <div class="">
        <h6>عروض النقاط</h6>
        <div class="table-responsive ">
            <table class="table main-table">
                <tr>
                    <th>الوصف</th>
                    <th>عدد النقاط</th>
                    <th>استخدام</th>
                </tr>
                @foreach ($pointOffers as $offer)
                <tr>
                    <td>{{ $offer->description }}</td>
                    <td>{{ $offer->points }}</td>
                    <td><button class="btn btn-sm btn-primary" wire:click="useOffer({{ $offer->id }})">استخدام</button>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    @endif
    </div> --}}

                    </div>
                    <div class="left-side w-25 sw-100">
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.amount') }} :</span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="amount" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.Percentage discount') }} :</span>
                            <input {{ $discount_amount ? 'readonly' : '' }} type="text" placeholder="0"
                                class="text-center form-control w-50" wire:model="discount_rate"
                                wire:keyup="calculateNet" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.Discount amount') }} :</span>
                            <input {{ $discount_rate ? 'readonly' : '' }} type="text" placeholder="0"
                                class="text-center form-control w-50" wire:model="discount_amount"
                                wire:keyup="calculateNet" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.Discount_Offers') }} :</span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="offers_discount" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2 space-noWrap">{{ __('after discount of offers') }} :</span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="amount_after_offers_discount" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.tax') }} :</span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="tax" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2 space-noWrap"> {{ __('admin.Total with tax') }} :</span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="total" />
                        </div>
                        <div
                            class="output-box d-flex align-items-center justify-content-end mb-2 {{ $split ? '' : 'd-none' }}">
                            <span class="a_word ms-2"> {{ __('admin.total after split') }} :</span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="total_after_split" />
                        </div>
                        {{-- @can('خصم الفاتورة')
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.discount') }} :</span>
        <input type="text" placeholder="0" class="text-center form-control w-50" wire:model="discount" wire:keyup="calculateNet" />
    </div>
    @endcan --}}


                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.cash') }} :</span>
                            <input type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="cash" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.bank') }} :</span>
                            <input type="number" placeholder="0" class="text-center form-control w-50"
                                wire:model="bank" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.card') }} :</span>
                            <input type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="card" />
                        </div>

                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.rest') }} :</span>
                            <input type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="rest" readonly />
                        </div>
                    </div>
                </div>

                @if (count($items) > 0)
                    <h5 class="text-center">{{ __('admin.services') }}</h5>
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
                                        @can('discount_invoices')
                                            <td>
                                                <input type="number" wire:model="items.{{ $key }}.sub_total"
                                                    id="" wire:keyup='changeItemTotal({{ $key }})'
                                                    class="form-control w-150px text-center mx-auto" readonly disabled>
                                            </td>
                                        @else
                                            <td>{{ $item['price'] }}</td>
                                        @endcan
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
                @endif

                @if (count($products) > 0)

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
                                @foreach ($products as $key => $item)
                                    <tr>
                                        <td>{{ __($item['department']) }}</td>
                                        <td>{{ $item['product_name'] }}</td>
                                        <td><input type="text" class="form-control w-150px text-center mx-auto"
                                                wire:keyup="changeQtyAndComputeProducts({{ $key }})"
                                                wire:model="products.{{ $key }}.quantity"></td>
                                        {{-- <td>{{ $item['tax_type_ar'] }}</td> --}}
                                        <td>{{ $item['price'] }}</td>
                                        <td>{{ $item['tax'] }}</td>
                                        @can('discount_invoices')
                                            <td>
                                                <input type="number" wire:model="products.{{ $key }}.sub_total"
                                                    id="" wire:keyup='changeItemTotal({{ $key }})'
                                                    class="form-control w-150px text-center mx-auto" readonly disabled>
                                            @else
                                            <td>{{ $item['sub_total'] }}</td>
                                            </td>
                                        @endcan
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

                <div class="Thetext-area w-100">
                    <textarea wire:model.defer="notes" id="" class="form-control w-100 p-2"
                        placeholder="{{ __('admin.notes') }}"></textarea>
                </div>
                <div class="submitBtn-holder text-center mt-3">
                    <button wire:click='submit' class="btn btn-success px-5">
                        {{ __('admin.Save') }}
                    </button>
                </div>

            </div>
        </div>
    </div>

</section>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('#js-example-basic-single').select2();
    });
</script>
