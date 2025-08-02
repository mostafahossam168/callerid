<section class="addPatient-section main-section py-5">
    <div class="container">
        <div class="p-4 bg-white rounded-3 shadow">
            <div class="holder mb-3 d-flex align-items-center justify-content-between">
                <h4 class="main-heading mb-0">{{ $screen == 'add' ? __('admin.Add') : __('admin.Update') }}</h4>
                <a wire:click="$set('screen','index')" class="btn btn-sm px-3 btn-secondary">{{ __('admin.Back') }} <i
                        class="fa-solid fa-arrow-left-long"></i></a>
            </div>
            <div class="addPatient-content ">
                <h4 class="section-title px-2 py-3 fs-18px rounded-3 mb-4 text-center">
                    معلومات الأليف
                </h4>
                <div class="row">
                    <div class="col-12  col-md-6">
                        <form action="" class="row g-3 Patient-form-data">
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="text" id="Patient-id" class="form-control Patient-id"
                                    wire:model.defer="name" placeholder="{{ __('admin.Pet name') }}" />
                            </div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="text" id="age" class="form-control Patient-id"
                                    wire:model.defer="age" placeholder="{{ __('admin.Age') }}" />
                            </div>
                            {{--                            <div class="col-12 col-sm-6 col-md-6"> --}}
                            {{--                                <input type="text" id="type" class="form-control Patient-id" wire:model.defer="type" placeholder="{{__('admin.Type')}}" /> --}}
                            {{--                            </div> --}}
                            {{-- <div class="col-12 col-sm-6 col-md-6">
                            <input type="text" id="breed_type" class="form-control Patient-id"
                                wire:model.defer="breed_type" placeholder="{{__('admin.Pet strain')}}" />
                    </div> --}}
                            <div class="col-12 col-sm-6 col-md-6">
                                <select wire:model.defer="category_id" id="" class="main-select w-100">
                                    <option value="">اختر نوع الأليف </option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <select wire:model="strain_id" id="" class="main-select w-100">
                                    <option value="">اختر سلالة الأليف </option>
                                    @foreach ($strains as $strain)
                                        <option value="{{ $strain->id }}">{{ $strain->name }}</option>
                                    @endforeach
                                </select>
                                {{-- <select id="breed_type" class="form-control Patient-id" wire:model.defer="breed_type">
                            <option value="">اختر السلالة</option>
                            <option value="سلالة 1">سلالة 1</option>
                            <option value="سلالة 2">سلالة 2</option>
                            <option value="سلالة 3">سلالة 3</option>
                            <!-- أضف المزيد من الخيارات هنا -->
                        </select> --}}
                            </div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <select class="gender main-select w-100" id="gender" wire:model.defer="gender">
                                    <option value="">{{ __('admin.Gender') }}</option>
                                    <option value="male">{{ __('admin.male') }}</option>
                                    <option value="female">{{ __('admin.female') }}</option>
                                </select>
                            </div>
                            @if (setting()->active_number_sim)
                                <div class="col-12 col-sm-6 col-md-6">
                                    <input wire:model="number_sim" type="number" id="" class="form-control"
                                        placeholder="رقم الشريحة" />
                                </div>
                            @endif
                            <div class="col-12 d-flex align-items-center justify-content-center">
                                <button class="mt-3 send-data btn btn-primary btn-sm px-4"
                                    wire:click.prevent='submit'>{{ __('save the data') }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12  col-md-6">
                        <div class="content d-flex flex-column align-items-center">
                            <p>
                                في حال عدم وجود السلالات المطلوبه يمكنك اضافتها
                            </p>
                            <button class='btn btn-info'>
                                <a target="_blank" href="{{ route('admin.strains.create') }}" class='text-light'>
                                    اضافة سلالة جديدة
                                </a>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
