<div class="main-side">
    <div class="main-title">
        <div class="small">
            @lang('admin.Home')
        </div>
        <div class="large">
            @lang('admin.General Settings')
        </div>
    </div>
    <x-admin-alert></x-admin-alert>
    <h6 class="main-head">
        البيانات الاساسية
    </h6>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mb-2 g-3">
        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.Name site')</span>
                    <input type="text" wire:model="website_name" id="" class="form-control">
                </label>
            </div>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.URL site')</span>
                    <input type="url" wire:model="website_url" id="" class="form-control">
                </label>
            </div>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.Tax Number')</span>
                    <input type="number" wire:model="tax_number" id="" class="form-control">
                </label>
            </div>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.Address')</span>
                    <input type="text" wire:model="address" id="" class="form-control">
                </label>
            </div>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.Building number')</span>
                    <input type="number" wire:model="building_number" id="" class="form-control">
                </label>
            </div>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.Steet')</span>
                    <input type="text" wire:model="street_number" id="" class="form-control">
                </label>
            </div>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.Phone')</span>
                    <input type="tel" wire:model="phone" id="" class="form-control">
                </label>
            </div>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span> @lang('admin.Email')</span>
                    <input type="email" class="form-control" wire:model="email" id="">
                </label>
            </div>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-label" for="tax">@lang('admin.Activate tax')</label>
                <select wire:model="is_tax" id="tax" class="form-select">
                    <option value="">@lang('admin.Active')</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            <hr>
            <h6 class="main-head m-0">
                التواصل الاجتماعي
            </h6>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.WhatsApp')</span>
                    <input type="text" wire:model='whatsapp' class="form-control" id="">
                </label>
            </div>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span> @lang('admin.Snapchat')</span>
                    <input type="text" wire:model='snapchat' class="form-control" id="">
                </label>
            </div>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span> @lang('admin.Twitter')</span>
                    <input type="text" wire:model='twitter' class="form-control" wire:model="twitter" id="">
                </label>
            </div>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span> @lang('admin.Facebook')</span>
                    <input type="text" wire:model='facebook' class="form-control" wire:model="facebook" id="">
                </label>
            </div>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span> @lang('admin.Instagram')</span>
                    <input type="text" class="form-control" wire:model="instagram" id="">
                </label>
            </div>
        </div>

        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            <hr>
        </div>


        <div class="col">
            <div class="inp-holder">
                <label class="special-label" for="siteStatus">@lang('admin.Site status')</label>
                <select wire:model="website_status" id="siteStatus" class="form-select">
                    <option value="">@lang('admin.Choose')</option>
                    <option value="1">@lang('admin.Active')</option>
                    <option value="0">@lang('admin.Inactive')</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-12 col-xl-4 transform-up-xl">
            <label class="special-label" for="siteLogo">@lang('admin.Site deactivation message')</label>
            <textarea wire:model="maintainance_message" id="" rows="4" class="form-control" placeholder="نعتذر الموقع مغلق للصيانة ..."></textarea>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-input mb-1">
                    <span>@lang('admin.Logo image')</span>
                    <input type="file" wire:model="logo" id="siteLogo" class="form-control">
                </label>
                @if($show_logo)
                <img src="{{ display_file($show_logo) }}" alt="" width='50'>
                @endif
            </div>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-input mb-1">
                    <span>@lang('admin.Browser icon image')</span>
                    <input type="file" wire:model="fav" id="siteLogo" class="form-control">
                </label>
                @if(setting('fav'))
                <img src="{{ display_file(setting('fav')) }}" alt="" width='50'>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            <div class="btn-holder d-flex justify-content-center mt-4">
                <button wire:click='save' type="button" class="main-btn">@lang('admin.Save')</button>
            </div>
        </div>
    </div>
</div>
