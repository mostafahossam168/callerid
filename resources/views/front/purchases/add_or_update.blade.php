        <div class="section-content p-4 bg-white rounded-3 shadow">
            <div class="row">
                <div class="col-md-4">
                    <div class="d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">{{ __('Invoice Type') }}</label>
                        <select wire:model="type" id="type" class="form-select">
                            <option value="">اختر نوع الفاتورة</option>
                            <option value="purchases">المشتريات</option>
                            <option value="stocks">المخازن</option>
                        </select>
                    </div>
                </div>
                @if ($type)
                    <div class="col-md-4">
                        <div class="d-flex flex-column mb-2">
                            <label for="" class="small-label mb-1">{{ __('admin.parent_category') }}</label>
                            <select wire:model="category_id" id="category_id" class="form-control">
                                <option value="">@lang('Choose department')</option>
                                @if ($type == 'purchases')
                                    @foreach (App\Models\PurchaseCategory::whereNull('parent_id')->get() as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @else
                                    @foreach (App\Models\Kind::whereNull('parent')->get() as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column mb-2">
                            <label for="" class="small-label mb-1">{{ __('admin.child_category') }}</label>
                            <select wire:model="category_child_id" id="category_child_id" class="form-control">
                                <option value="">اختر القسم الفرعي</option>
                                @if ($type == 'purchases')
                                    @foreach (App\Models\PurchaseCategory::whereNotNull('parent_id')->where('parent_id', $category_id)->get() as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @else
                                    @foreach (App\Models\Kind::whereNotNull('parent')->where('parent', $category_id)->get() as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    @if ($type == 'stocks')
                        <div class="col-md-4">
                            <div class="d-flex flex-column mb-2">
                                <label for="" class="small-label mb-1">{{ __('admin.supply') }}</label>
                                <select wire:model="supply_id" id="supply_id" class="form-control">
                                    <option value="">اختر المادة</option>
                                    @foreach (App\Models\Supply::where('kind_id', $category_child_id)->get() as $supply)
                                        <option value="{{ $supply->id }}">{{ $supply->name }} : عدد
                                            {{ $supply->quantity }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-4">
                        <div class="d-flex flex-column mb-2">
                            <label for="" class="small-label mb-1">{{ __('admin.qty') }}</label>
                            <input type="integer" wire:model="qty" id="qty" class="w-100 form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column mb-2">
                            <label for="" class="small-label mb-1">اسم المورد</label>
                            <input type="text" wire:model.defer="name" id="" class="w-100 form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column mb-2">
                            <label for="" class="small-label mb-1">{{ __('admin.address') }}</label>
                            <input type="text" wire:model.defer="address" id="address" class="w-100 form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column mb-2">
                            <label for="" class="small-label mb-1">الرقم الضريبي للمورد</label>
                            <input type="integer" wire:model.defer="tax_number" id="tax_number"
                                class="w-100 form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column mb-2">
                            <label for="" class="small-label mb-1">الهاتف للمورد</label>
                            <input type="integer" wire:model.defer="phone" id="phone" class="w-100 form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column mb-2">
                            <label for="" class="small-label mb-1">{{ __('admin.amount') }}</label>
                            <input type="text" wire:model.defer="amount" id="" class="w-100 form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="d-flex flex-column mb-2">
                            <label for="" class="small-label mb-1">{{ __('admin.Taxes included') }}</label>
                            <input type="checkbox" wire:model="tax" id="" class="form-check-input ">
                        </div>
                    </div>

                    @if ($type == 'stocks')
                        <div class="col-md-4">
                            <div class="d-flex flex-column mb-2">
                                <label for="" class="small-label mb-1">{{ __('Add to Stock') }}</label>
                                <input type="checkbox" wire:model="add_to_stock" id=""
                                    class="form-check-input ">
                            </div>
                        </div>
                    @endif

                    <div class="col-md-12">
                        <button class="btn btn-sm  btn-success" data-bs-dismiss="modal"
                            wire:click='save'>{{ __('admin.Save') }}</button>
                    </div>
                @endif
            </div>
        </div>
