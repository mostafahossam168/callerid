<div class="d-flex align-items-center justify-content-between gap-3 mb-3">
    <div class="main-title mb-0">
        <div class="small">@lang('Home')</div>
        <div class="large">@lang('Add client')</div>
    </div>
    <div class="d-flex gap-2">
        <button class="main-btn btn-main-color" wire:click='$set("screen","index")'>@lang('View all clients')</button>
    </div>
</div>
<div class="row g-3">
    <div class="col-12 col-md-4 col-lg-3">
        <label for="">@lang('Name')</label>
        <input type="text" wire:model="name" class="form-control">
    </div>
    <div class="col-12 col-md-4 col-lg-3">
        <label for="">@lang('Phone')</label>
        <input type="text" wire:model="phone" class="form-control">
    </div>
    <div class="col-12 col-md-4 col-lg-3">
        <label for="">@lang('E-Mail Address')</label>
        <input type="email" wire:model="email" class="form-control">
    </div>
    <div class="col-12 col-md-4 col-lg-3">
        <label for="">@lang('Password')</label>
        <input type="password" wire:model="password" class="form-control">
    </div>

    <div class="col-12 col-md-4 col-lg-3">
        <label for="">الدولة</label>
        <select wire:model.live="country_id" class="form-control">
            <option value="">اختر الدولة</option>
            @foreach (App\Models\Country::all() as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
    </div>
    {{-- <div class="col-12 col-md-4 col-lg-3">
        <label for="">@lang('City')</label>
        <select wire:model.live="city_id" class="form-control">
            <option value="">@lang('Select city')</option>
            @foreach ($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>
    </div> --}}

    {{-- <div class="col-12 col-md-4 col-lg-3">
        <label for="">@lang("Address")</label>
        <input type="text" wire:model="address" class="form-control">
    </div> --}}
    {{-- <div class="col-12 col-md-4 col-lg-3">
        <label for="">pst</label>
        <input type="text" wire:model="pst" class="form-control">
    </div> --}}
    {{-- <div class="col-12 col-md-4 col-lg-3">
        <label for="">التواصل</label>
        <input type="text" wire:model="contact" class="form-control">
    </div> --}}
    {{-- <div class="col-12 col-md-4 col-lg-3">
        <label for="">ملاحظات</label>
        <input type="text" wire:model="notes" class="form-control">
    </div> --}}
    {{-- <div class="col-12 col-md-4 col-lg-3">
        <label for="">الفصل</label>
        <input type="text" wire:model="class" class="form-control">
    </div> --}}

    <div class="col-12 col-md-4 col-lg-3">
        <label for="">@lang('Active')</label>
        <select wire:model="active" class="form-control">
            <option value="">@lang('Choose status')</option>
            <option value="1">@lang('Active')</option>
            <option value="0">غير مفعل</option>
        </select>
    </div>


    <div class="col-12">
        <button class="main-btn" wire:click='submit'>@lang('Save')</button>
    </div>
</div>
