<section class="main-section users">
  <x-alert></x-alert>

  <div class="container" id="data-table">
  @include('front.points.add_or_update_offer')

<h4 class="main-heading ">{{ __('admin.loyalty_points') }}</h4>

<div class="alert alert-primary" role="alert">
    <p class="mb-0 fs-12px">
        {{ __('admin.meassage_point') }}
    </p>
</div>

<div class="bg-white shadow p-4 rounded-3 mb-5">
  <div class="row g-2">
    <div class="col-12 col-md-4 col-lg-3 col-xl-2">
      <div dir="ltr" class="input-group d-flex flex-column align-items-end justify-content-center">
        <label for="" class="small-label d-block">قيمة المبلغ</label>
        <input dir="rtl" type="number" class="form-control w-100" wire:model='points_per_amount' />
      </div>
    </div>

    <div class="col-12 col-md-4 col-lg-3 col-xl-2">
      <div dir="ltr" class="input-group d-flex flex-column align-items-end justify-content-center">
        <label for="" class="small-label">عدد النقاط مقابل المبلغ</label>
        <input dir="rtl" type="number" class="form-control w-100" wire:model='point_value' />
      </div>
    </div>
    <div class="col-12 col-md-4 col-lg-3 col-xl-2 d-flex align-items-end justify-content-center">
      <button id="button-addon2" type="button" class="btn btn-success btn-sm px-5 rounded-0"
        wire:click='updateSettings'>
        {{ __('admin.save') }}
      </button>
    </div>
  </div>
</div>

<div class="bg-white shadow p-4 rounded-3">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h6 class="mb-0 small-heading">عروض النقاط</h6>
    <div class="d-flex align-items-center gap-1">
      <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning">
        <i class="fa-solid fa-print"></i>
      </button>
      <button class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#add_or_update">
        إضافة عرض جديد
        <i class="icon fa-solid fa-plus me-1"></i>
      </button>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table main-table mb-0" id="prt-content">
      <thead>
        <tr>
          <th>#</th>
          <th>الوصف</th>
          <th>النقاط</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($offers as $offer)
        <tr>
          <td>{{ $offer->id }}</td>
          <td>{{ $offer->description }}</td>
          <td>{{ $offer->points }}</td>
          <td class="not-print">
            <div class="d-flex align-items-center justify-content-center gap-1">
              <button data-bs-toggle="modal" data-bs-target="#add_or_update"
                class="btn btn-sm btn-info text-white ms-1" wire:click='edit({{ $offer }})'>
                <i class="fa-solid fa-pen-to-square"></i>
              </button>
              <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                data-bs-target="#delete_agent{{ $offer->id }}">
                <i class="fa-solid fa-trash-can"></i>
              </button>
            </div>
          </td>
        </tr>
        @include('front.points.delete_offer')
        @endforeach

      </tbody>
    </table>
    {{ $offers->links() }}
  </div>

</div>
  </div>

</section>
