@extends('admin.layouts.admin')
@section('title')
{{ __('admin.Edit patient') }}
@endsection
@section('content')
<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-light p-3">
        <a href='{{ route('admin.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
        <li class="breadcrumb-item active" aria-current="page">تعديل مالك</li>
    </ol>
</nav>

<form class="row row-gap-24 p-3 shadow rounded-3 bg-white w-100 mx-auto" action="{{ route('admin.patients.update',$patient) }}"
    method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="col-12">
        <b>تعديل مالك</b>
        <hr>
    </div>
    <div class=" col-sm-12">
        <label class="main-lable fs-5" for="">{{ __('admin.department') }}</label>
        <select name="department_id" class="main-select w-100" id="">
            @foreach ($departments as $department)
            <option {{ $patient->department_id==$department->id?'selected':'' }}  value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>
    </div>
    {{-- <div class="col-sm-6 col-md-4">
        <label class="main-lable" for="">
            الرقم الطبي
        </label>
        <input type="number" class="form-control" value="{{ App\Models\Patient:: }}">
    </div> --}}
    <div class="col-sm-6 col-md-4">
        <label class="main-lable" for="">
            {{ __('admin.The date the record was added') }}
        </label>
        <input type="date" class="form-control" name="date" placeholder="{{ __('admin.The date the record was added') }}" value="{{ $patient->date }}">
    </div>
    <div class="col-sm-6 col-md-4">
        <label class="main-lable" for="">
            {{ __('admin.Civil number') }}
        </label>
        <input type="number" class="form-control" name="civil" placeholder="{{ __('admin.Civil number') }}" value="{{ $patient->civil }}">
    </div>
    <div class="col-sm-6 col-md-4">
        <label class="main-lable" for="">
            {{ __('admin.phone') }}
        </label>
        <input type="text" class="form-control" name="phone" placeholder="{{ __('admin.phone') }}" value="{{ $patient->phone }}">
    </div>
    <div class="col-12">
        <hr class="m-0">
    </div>

    <div class="col-sm-6 col-md-3">
        <label class="main-lable" for="">
            {{ __('admin.name') }}
        </label>
        <input value="{{ $patient->first_name }}" type="text" class="form-control" placeholder="{{ __('admin.name') }}" name="first_name">
    </div>
    <div class="col-sm-6 col-md-3">
        <label class="main-lable" for="">
            {{ __('admin.Parent name') }}
        </label>
        <input type="text" class="form-control" placeholder="{{ __('admin.Parent name') }}" name="parent_name" value="{{ $patient->parent_name }}">
    </div>
    <div class="col-sm-6 col-md-3">
        <label class="main-lable" for="">
            {{ __('admin.Grandfather name') }}
        </label>
        <input type="text" class="form-control" placeholder="{{ __('admin.Grandfather name') }}" name="grand_name"  value="{{ $patient->grand_name }}">
    </div>
    <div class="col-sm-6 col-md-3">
        <label class="main-lable" for="">
            {{ __('admin.Last name') }}
        </label>
        <input type="text" class="form-control" placeholder="{{ __('admin.Last name') }}" name="last_name"  value="{{ $patient->last_name }}">
    </div>

    <div class="col-12">
        <hr class="m-0">
    </div>

    <div class="col-sm-6 col-md-3">
        <label class="main-lable" for="">
            {{ __('admin.relationship') }}
        </label>
        <select name="relationship_id" class="main-select w-100" id="">
            @foreach ($relationships as $relationship)
            <option {{ $patient->relationship_id==$relationship->id?'selected':'' }} value="{{ $relationship->id }}">{{ $relationship->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-6 col-md-3">
        <label class="main-lable" for="">
            {{ __('admin.Gender') }}
        </label>
        <select name="gender" class="main-select w-100" id="">
            <option value="male" {{ $patient->gender=='male'?'selected':'' }}>{{ __('admin.male') }}</option>
            <option value="female"  {{ $patient->gender=='female'?'selected':'' }}>{{ __('admin.female') }}</option>
        </select>
    </div>
    <div class="col-sm-6 col-md-3">
        <label class="main-lable" for="">
            {{ __('admin.country') }}
        </label>
        <select name="country_id" class="main-select w-100" id="">
            @foreach ($countries as $country)
            <option  {{ $patient->country_id==$country->id?'selected':'' }} value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-6 col-md-3">
        <label class="main-lable" for="">
            المدينة
        </label>
        <select name="country_id" class="main-select w-100" id="">
            <option value="">اختر المدينة</option>
        </select>
    </div>

    <div class="col-12">
        <hr class="m-0">
    </div>

    <div class="col-sm-6 ">
        <label class="main-lable" for="">
            {{ __('admin.Hijri date of birth') }}
        </label>
        <input type="date" name="birthdate" class="form-control" id=""  value="{{ $patient->birthdate }}">
    </div>
    <div class="col-sm-6 ">
        <label class="main-lable" for="">
            {{ __('admin.Age') }}
        </label>
        <input readonly type="number" name="age" placeholder="{{ __('admin.Age') }}" class="form-control" id=""  value="{{ $patient->age }}">
    </div>

    <div class="col-12">
        <hr class="m-0">
    </div>

    <div class="col-sm-6 ">
        <div class="row row-gap-24">
            <div class="col-12">
                <label class="main-lable" for="">
                    {{ __('admin.The name of a relative') }}
                </label>
                <input type="text" name="near_name" placeholder="{{ __('admin.The name of a relative') }}" class="form-control" id="" value="{{ $patient->near_name }}">
            </div>
            <div class="col-12">
                <label class="main-lable" for="">
                    {{ __('admin.The mobile of a relative') }}
                </label>
                <input type="number" name="near_mobile" placeholder="{{ __('admin.The mobile of a relative') }}" class="form-control" id=""  value="{{ $patient->near_mobile }}">
            </div>
        </div>
    </div>
    <div class="col-sm-6 ">
        <label class="main-lable" for="">
            {{ __('admin.Notes on the health record') }}
        </label>
        <textarea class="form-control" name="notes_health_record"  placeholder="{{ __('admin.Notes on the health record') }}" id="" rows="5">{{ $patient->notes_health_record }}"</textarea>
    </div>

    <div class="col-12">
        <hr class="m-0">
    </div>

    <div class="col-sm-6 ">
        <div class="row row-gap-24">
            <div class="col-12">
                <label class="main-lable" for="">
                    {{ __('admin.Are you allergic to penicillin or other medicines?') }}
                </label>
                <select name="penicillin" id="" class="main-select w-100">
                    <option disabled value="">
                        {{ __('admin.Are you allergic to penicillin or other medicines?') }}
                    </option>
                    <option value="1" {{ $patient->penicillin==1?'selected':'' }}>
                        {{__('Yes')}}
                    </option>
                    <option value="0" {{ $patient->penicillin==0?'selected':'' }}>
                        {{__('No')}}
                    </option>
                </select>
            </div>
            <div class="col-12">
                <label class="main-lable" for="">
                    {{ __('admin.Have you ever had problems during and after dental treatment?') }}
                </label>
                <select name="teeth_problems" id="" class="main-select w-100">
                    <option disabled value="">
                        {{ __('admin.Have you ever had problems during and after dental treatment?') }}
                    </option>
                    <option value="1" {{ $patient->teeth_problems==1?'selected':'' }}>
                        {{__('Yes')}}
                    </option>
                    <option value="0" {{ $patient->teeth_problems==0?'selected':'' }}>
                        {{__('No')}}
                    </option>
                </select>
            </div>
            <div class="col-12">
                <label class="main-lable" for="">
                    {{ __('admin.Are you currently taking medication?') }}
                </label>
                <select name="drugs" id="" class="main-select w-100">
                    <option disabled value="">
                        {{ __('admin.Are you currently taking medication?') }}
                    </option>
                    <option value="1" {{ $patient->drugs==1?'selected':'' }}>
                        {{__('Yes')}}
                    </option>
                    <option value="0" {{ $patient->drugs==0?'selected':'' }}>
                        {{__('No')}}
                    </option>
                </select>
            </div>

        </div>
    </div>
    <div class="col-sm-6 ">
        <label class="main-lable" for="">
            {{ __('admin.the purpose from the visit') }}
        </label>
        <textarea class="form-control" name="goal_of_visit" id="" rows="9" placeholder="{{ __('admin.the purpose from the visit') }}">{{ $patient->goal_of_visit }}</textarea>
    </div>

    <div class="col-12">
        <hr class="m-0">
    </div>

    <div class="col-md-12 text-center mt-3">
        <h5 class="mx-auto w-fit line-bottom-blue mb-4"> {{ __('admin.Have you ever had or currently suffer from?') }}</h5>
    </div>

    <div class="col-sm-6">
        <label class="main-lable" for="">
            {{ __('admin.heart disease?') }}
        </label>
        <select name="heart" id="" class="main-select w-100">
            <option disabled value="">
                {{ __('admin.heart disease?') }}
            </option>
            <option value="1" {{ $patient->heart==1?'selected':'' }}>
                {{__('Yes')}}
            </option>
            <option value="0" {{ $patient->heart==0?'selected':'' }}>
                {{__('No')}}
            </option>
        </select>
    </div>
    <div class="col-sm-6">
        <label class="main-lable" for="">
            {{ __('admin.High or low blood pressure?') }}
        </label>
        <select name="pressure" id="" class="main-select w-100">
            <option disabled value="">
                {{ __('admin.High or low blood pressure?') }}
            </option>
            <option value="1" {{ $patient->pressure==1?'selected':'' }}>
                {{__('Yes')}}
            </option>
            <option value="0" {{ $patient->pressure==0?'selected':'' }}>
                {{__('No')}}
            </option>
        </select>
    </div>
    <div class="col-sm-6">
        <label class="main-lable" for="">
            {{ __('admin.Rheumatic fever?') }}
        </label>
        <select name="fever" id="" class="main-select w-100">
            <option disabled value="">
                {{ __('admin.Rheumatic fever?') }}
            </option>
            <option value="1" {{ $patient->fever==1?'selected':'' }}>
                {{__('Yes')}}
            </option>
            <option value="0" {{ $patient->fever==0?'selected':'' }}>
                {{__('No')}}
            </option>
        </select>
    </div>
    <div class="col-sm-6">
        <label class="main-lable" for="">
            {{ __('admin.Anemia and other blood diseases?') }}
        </label>
        <select name="anemia" id="" class="main-select w-100">
            <option disabled value="">
                {{ __('admin.Anemia and other blood diseases?') }}
            </option>
            <option value="1" {{ $patient->anemia==1?'selected':'' }}>
                {{__('Yes')}}
            </option>
            <option value="0" {{ $patient->anemia==0?'selected':'' }}>
                {{__('No')}}
            </option>
        </select>
    </div>
    <div class="col-sm-6">
        <label class="main-lable" for="">
            {{ __('admin.Thyroid disease?') }}
        </label>
        <select name="thyroid_glands" id="" class="main-select w-100">
            <option disabled value="">
                {{ __('admin.Thyroid disease?') }}
            </option>
            <option value="1" {{ $patient->thyroid_glands==1?'selected':'' }}>
                {{__('Yes')}}
            </option>
            <option value="0" {{ $patient->thyroid_glands==0?'selected':'' }}>
                {{__('No')}}
            </option>
        </select>
    </div>
    <div class="col-sm-6">
        <label class="main-lable" for="">
            {{ __('admin.Bile - hepatitis or any other liver disease?') }}
        </label>
        <select name="liver" id="" class="main-select w-100">
            <option disabled value="">
                {{ __('admin.Bile - hepatitis or any other liver disease?') }}
            </option>
            <option value="1" {{ $patient->liver==1?'selected':'' }}>
                {{__('Yes')}}
            </option>
            <option value="0" {{ $patient->liver==0?'selected':'' }}>
                {{__('No')}}
            </option>
        </select>
    </div>
    <div class="col-sm-6">
        <label class="main-lable" for="">
            {{ __('admin.Diabetes or does a family member suffer from it?') }}
        </label>
        <select name="sugar" id="" class="main-select w-100">
            <option disabled value="">
                {{ __('admin.Diabetes or does a family member suffer from it?') }}
            </option>
            <option value="1" {{ $patient->sugar==1?'selected':'' }}>
                {{__('Yes')}}
            </option>
            <option value="0" {{ $patient->sugar==0?'selected':'' }}>
                {{__('No')}}
            </option>
        </select>
    </div>
    <div class="col-sm-6">
        <label class="main-lable" for="">
            {{ __('admin.Asthma - tuberculosis - or trouble breathing?') }}
        </label>
        <select name="tb" id="" class="main-select w-100">
            <option disabled value="">
                {{ __('admin.Asthma - tuberculosis - or trouble breathing?') }}
            </option>
            <option value="1" {{ $patient->tb==1?'selected':'' }}>
                {{__('Yes')}}
            </option>
            <option value="0" {{ $patient->tb==0?'selected':'' }}>
                {{__('No')}}
            </option>
        </select>
    </div>
    <div class="col-sm-6">
        <label class="main-lable" for="">
            {{ __('admin.Kidney disease?') }}
        </label>
        <select name="kidneys" id="" class="main-select w-100">
            <option disabled value="">
                {{ __('admin.Kidney disease?') }}
            </option>
            <option value="1" {{ $patient->kidneys==1?'selected':'' }}>
                {{__('Yes')}}
            </option>
            <option value="0" {{ $patient->kidneys==0?'selected':'' }}>
                {{__('No')}}
            </option>
        </select>
    </div>
    <div class="col-sm-6">
        <label class="main-lable" for="">
            {{ __('admin.Cramping, conflict, or fainting?') }}
        </label>
        <select name="convulsion" id="" class="main-select w-100">
            <option disabled value="">
                {{ __('admin.Cramping, conflict, or fainting?') }}
            </option>
            <option value="1" {{ $patient->convulsion==1?'selected':'' }}>
                {{__('Yes')}}
            </option>
            <option value="0" {{ $patient->convulsion==0?'selected':'' }}>
                {{__('No')}}
            </option>
        </select>
    </div>
    <div class="col-sm-12">
        <label class="main-lable" for="">
            {{ __('admin.other diseases') }}
        </label>
        <textarea name="other_diseases" placeholder="{{ __('admin.other diseases') }}" id="" class="form-control" rows="5">{{ $patient->other_diseases }}</textarea>
    </div>

    <div class="col-12 text-center mt-5">
        <button type="submit" class="btn btn-primary">{{ __('admin.Save') }}</button>
    </div>
</form>

@endsection
