    <div class="main-title">
        <div class="small">
            @lang("Home")
        </div>
        <div class="large">
            {{ $obj ? 'تعديل':'اضافة'}}  مزود خدمة
        </div>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mb-2 g-3">
        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang("Name")</span>
                    <input type="text" wire:model="name" id="" class="form-control">
                </label>
            </div>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang("Phone")</span>
                    <input type="tel" id="" wire:model="phone" class="form-control">
                </label>
            </div>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span> البريد الالكتروني</span>
                    <input type="email" wire:model="email" class="form-control" id="">
                </label>
            </div>
        </div>
        <div class="col">
        <label>المجموعة</label>
        <select class="form-select" wire:model="role_id" id="">
            <option value="">اختر المجموعة</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span> @lang("Password")</span>
                    <input type="password" wire:model="password" class="form-control" id="">
                </label>
            </div>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-label" for="">@lang("City")</label>
                <select wire:model="city_id" id="" class="form-select">
                    <option value="">@lang("Select city")</option>
                    @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group mb-1">
                <label class="mb-1">@lang("Image")</label>
                <input wire:model="image" class="form-control" type="file" accept="image/*">
            </div>
            <img src="{{ $obj?->image? display_file($obj->image):asset('admin-asset/img/no-image.jpeg') }}" alt="" class="img-thumbnail img-preview" width="60px">
        </div>

        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            <div class="btn-holder mt-4">
                <button wire:click="submit" class="main-btn">@lang("Save")</button>
            </div>
        </div>
    </div>
