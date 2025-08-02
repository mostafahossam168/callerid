  <div class="main-title">
    <div class="small">
      @lang("Home")
    </div>
    <div class="large">
      {{$obj ? __("Edit"):__("Add")}} السلايدر
    </div>
  </div>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">
    <div class="col">
      <div class="inp-holder">
        <label class="special-input">
          <span>@lang("Address") الاساسى</span>
          <input type="text" wire:model="title" class="form-control">
        </label>
      </div>
    </div>
    <div class="col">
      <div class="inp-holder">
        <label class="special-input">
          <span>@lang("Address") الثانى</span>
          <input type="tel" wire:model="subtitle" class="form-control">
        </label>
      </div>
    </div>
    <div class="col">
      <div class="form-group mb-1">
        <label class="mb-1">@lang("Image")</label>
        <input class="form-control" wire:model="cover" type="file" accept="image/*">
      </div>
        <img src="{{ $obj?->cover ?  display_file($obj->cover) : asset('admin-asset/img/no-image.jpeg') }}" alt="" class="img-thumbnail img-preview" width="60px">
    </div>

    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
      <div class="btn-holder">
        <button wire:click="submit" class="main-btn">@lang("Save")</button>
      </div>
    </div>
  </div>
