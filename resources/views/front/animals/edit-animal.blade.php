@extends('front.layouts.front')
@section('title')
تعديل سلالة
@endsection
@section('content')
    <section class="addPatient-section main-section py-5">
        <div class="container">
            <div class="p-4 bg-white rounded-3 shadow">
                <div class="holder mb-3 d-flex align-items-center justify-content-between">
                    <h4 class="main-heading mb-0">{{ __('admin.Update') }}</h4>
                </div>
                <div class="addPatient-content ">
                    <h4 class="section-title px-2 py-3 fs-18px rounded-3 mb-4 text-center">
                        معلومات الأليف
                    </h4>
                    <div class="row">
                        <div class="col-12  col-md-6">
                            <form action="{{route('front.animals.update',$animal)}}" method="post" class="row g-3 Patient-form-data">
                                @method('PUT')
                                @csrf
                                <div class="col-12 col-sm-6 col-md-6">
                                    <input type="text" id="Patient-id" class="form-control Patient-id" value="{{$animal->name}}" name="name" placeholder="{{__('admin.Pet name')}}" />
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <input type="text" id="age" class="form-control Patient-id" value="{{$animal->age}}" name="age" placeholder="{{__('admin.Age')}}" />
                                </div>

                                {{-- <div class="col-12 col-sm-6 col-md-6">
                                <input type="text" id="breed_type" class="form-control Patient-id"
                                    wire:model.defer="breed_type" placeholder="{{__('admin.Pet strain')}}" />
                        </div> --}}
                                <div class="col-12 col-sm-6 col-md-6">
                                    <select name="category_id" id="" class="main-select w-100">
                                        <option value="">اختر نوع الأليف </option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}" {{$animal->category_id === $cat->id ? 'selected': ''}}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <select name="strain_id" id="" class="main-select w-100">
                                        <option value="">اختر سلالة الأليف </option>
                                        @foreach ($strains as $strain)
                                            <option value="{{ $strain->id }}" {{$animal->strain_id === $strain->id ? 'selected': ''}}>{{ $strain->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <select class="gender main-select w-100" id="gender" name="gender">
                                        <option value="">{{ __('admin.Gender') }}</option>
                                        <option value="male" {{$animal->gender === "male" ? 'selected': ''}}>{{ __('admin.male') }}</option>
                                        <option value="female" {{$animal->gender === "female" ? 'selected': ''}}>{{ __('admin.female') }}</option>
                                    </select>
                                </div>
                                @if(setting()->active_number_sim)
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <input type="number" name="number_sim" value="{{$animal->number_sim}}" id="" class="form-control" placeholder="رقم الشريحة" />
                                    </div>
                                @endif


                                <div class="col-12 d-flex align-items-center justify-content-center">
                                    <button class="mt-3 send-data btn btn-primary btn-sm px-4" type="submit">{{ __('save the data')}}</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-12  col-md-6">
                            <div class="content d-flex flex-column align-items-center">
                                <p>
                                    في حال عدم وجود السلالات المطلوبه يمكنك اضافتها
                                </p>
                                <button class='btn btn-info'>
                                    <a target="_blank" href="{{route('admin.strains.create')}}" class='text-light'>
                                        اضافة سلالة جديدة
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


@endsection
