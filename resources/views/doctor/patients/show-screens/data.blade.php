
<div class="table-responsive">
  <table class="table main-table">
      <thead>
          <tr>
              <th>{{ __('admin.Medical number') }}</th>
              <th>{{ __('admin.name') }}</th>
              <th>{{ __('admin.phone') }}</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td>{{ $patient->id }}</td>
              <td>{{ $patient->name }}</td>
              <td>{{ $patient->phone }}</td>
          </tr>
      </tbody>
  </table>
</div>
@if(!($patient instanceof App\Models\Animal))
<h3 class="small-heading my-3 fs-18px">{{__('admin.Pets')}}</h3>

<div class="table-responsive">
  <table class="table main-table">
      <thead>
          <tr>
              <th>{{__('admin.name')}}</th>
              <th>{{__('admin.Type')}}</th>
              <th>{{__('admin.category')}}</th>
              <th>{{__('admin.Owner')}}</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($patient->animals as $animal)
          <tr>
              <td>{{ $animal->name ?? 'لا يوجد' }}</td>
              <td>{{ $animal->gender ?? 'لا يوجد' }}</td>
              <td>{{ $animal->category?->name }}</td>
              <td>{{ $animal->patient?->first_name ?? null }}</td>
          </tr>
          @endforeach

      </tbody>
  </table>
</div><br><br><br>
@endif


{{-- <div class="row g-3 mb-3">
  <div class="col-md-2 text-center">
    <label for="" class="small-label mb-2">العلامات الحيوية</label>
    <div class="d-flex flex-column gap-3 justify-content-center">
      <div class="inp-holder">
        <input type="text" wire:model="age" id="" class="form-control" placeholder="{{__('admin.Age')}}">
      </div>
      <div class="inp-holder">
        <input type="text" wire:model="weight" id="" class="form-control" placeholder="{{__('admin.the weight')}}">
      </div>
    </div>
  </div>
  <div class="col-md-5">
    <label for="" class="small-label mb-2">{{__('admin.Diagnosis')}}</label>
    <div class="form-floating">
      <textarea class="form-control" wire:model="treatment" placeholder="Leave a comment here" id="floatingTextarea2"
        style="height: 90px"></textarea>
      <label for="floatingTextarea2">{{__('admin.Diagnosis')}}</label>
    </div>
  </div>
  <div class="col-md-5">
    <label for="" class="small-label mb-2">الاجراء المتخذ</label>
    <div class="form-floating">
      <textarea class="form-control" wire:model="taken" placeholder="Leave a comment here" id="floatingTextarea2"
        style="height: 90px"></textarea>
      <label for="floatingTextarea2">الاجراء المتخذ</label>
    </div>
  </div>
</div>
<div class="row g-2">
  <div class="col-12 col-md-6 col-lg-6">
    <table class="table main-table">
      <thead>
        <tr>
          <th class="d-flex align-items-center justify-content-between">
            {{__("admin.Vaccinations")}}
          </th>
          <th>
            <button wire:click.prevent="addNewVaccination" class="btn btn-primary btn-sm">
              <i class="fa-solid fa-plus"></i>
            </button>
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach ($vaccinations as $key => $vaccination)
        <tr>
          <td>
            <input type="text" wire:model="vaccinations.{{ $key }}" id="" class="form-control"
              placeholder="{{__("admin.Type the name of the vaccination")}}">
          </td>
          <td style="vertical-align: middle;">
            @if ($key != 0)
            <button class="btn btn-danger btn-sm" wire:click.prevent="removeVaccination({{ $key }})"><i
                class="fa fa-trash"></i></button>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="col-12 col-md-6 col-lg-6">
    <table class="table main-table">
      <thead>
        <tr>
          <th class="d-flex align-items-center justify-content-between">
            {{__("admin.Allergies")}}
          </th>
          <th>
            <button wire:click.prevent="addNewSensitivity" class="btn btn-primary btn-sm">
              <i class="fa-solid fa-plus"></i>
            </button>
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sensitivity as $index => $sens)
        <tr>
          <td>
            <input type="text" wire:model="sensitivity.{{ $index }}" id="" class="form-control"
              placeholder="اكتب اسم {{__("admin.Allergies")}}">
          </td>
          <td style="vertical-align: middle;">
            @if ($index != 0)
            <button class="btn btn-danger btn-sm" wire:click.prevent="removeSensitivity({{ $index }})"><i
                class="fa fa-trash"></i></button>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="col-md-12 d-flex justify-content-end">
    <button class="btn btn-sm btn-primary px-5" wire:click="saveDiagnose">{{ __('admin.save') }}</button>
  </div>
</div> --}}
