@extends('admin.layouts.admin')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
    integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('title')
    {{ __('admin.Edit user') }}
@endsection
@section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Edit user') }}</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <b>{{ __('admin.Edit user') }}</b>
        <hr>
        <form class="row row-gap-24" action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-sm-6 col-md-3">
                <label for="">{{ __('admin.name') }}</label>
                <input class="form-control" type="text" name="name" value="{{ $user->name }}">
            </div>

            <div class="col-sm-6 col-md-3">
                <label for="">{{ __('admin.email') }}</label>
                <input class="form-control" type="email" name="email" value="{{ $user->email }}">
            </div>

            <div class="col-sm-6 col-md-3">
                <label for="">{{ __('admin.type') }}</label>
                <select class="main-select w-100" name="type" id="">
                    <option value="">{{ __('admin.select type') }}</option>
                    <option value="recep" {{ $user->type == 'recep' ? 'selected' : '' }}>{{ __('admin.recep') }}</option>
                    <option value="dr" {{ $user->type == 'dr' ? 'selected' : '' }}>{{ __('admin.dr') }}</option>
                    <option value="lab" {{ $user->type == 'lab' ? 'selected' : null }}>{{ __('admin.lab') }}</option>
                    <option value="pharmacy" {{ $user->type == 'pharmacy' ? 'selected' : null }}>صيدلي</option>
                    <option value="accountant" {{ $user->type == 'accountant' ? 'selected' : '' }}>
                        {{ __('admin.accountant') }}
                    </option>
                </select>
            </div>

            <div class="col-sm-6 col-md-3">
                <label for="">{{ __('admin.group') }}</label>
                <select class="main-select w-100" name="group" id="">
                    <option value="">{{ __('admin.select group') }}</option>
                    @foreach ($roles as $role)
                        <option {{ $user->role?->id == $role->id ? 'selected' : '' }} value="{{ $role->id }}">
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-6 col-md-3">
                <label class="main-lable" for="">{{ __('admin.warehouse') }}</label>
                <select class="main-select w-100" name="warehouse_id">
                    <option value="">{{ __('admin.choose') }}</option>
                    @foreach ($warehouses as $warehouse)
                        <option value="{{ $warehouse->id }}"
                            {{ old('warehouse_id',$user->warehouse_id) == $warehouse->id ? 'selected' : null }}>{{ $warehouse->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-6 col-md-3">
                <label for="">{{ __('admin.department') }}</label>
                <select class="main-select w-100" name="department_id[]" id="js-example-basic-single" multiple>
                    <option value="">{{ __('admin.Choose the department') }}</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}"
                            {{ in_array($department->id, $user->departments()->pluck('departments.id')->toArray()) ? 'selected' : '' }}>
                            {{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-6 col-md-3">
                <label for="">{{ __('admin.salary') }}</label>
                <input class="form-control" type="number" name="salary" value="{{ $user->salary }}">
            </div>

            <div class="col-sm-6 col-md-3">
                <label for="">نوع النسبه</label>
                <select class="form-control" name="rate_type">
                    <option value="without_rate">راتب بدون نسبه</option>
                    <option value="rating_after_salary">نسبه بعد الراتب</option>
                    <option value="rating_starting_salary">النسبه من البدايه</option>
                </select>
            </div>
            <div class="col-sm-6 col-md-3">
                <label for="">{{ __('admin.rate') }}</label>
                <input class="form-control" type="number" name="rate" value="{{ $user->rate }}">
            </div>

            <div class="col-sm-6 col-md-3">
                <label for="">{{ __('admin.password') }}</label>
                <input class="form-control" type="password" name="password">
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="alert alert-primary p-1 mb-1 fs-11">
                    يمكن تحديد الاقسام التي يمكن للموظف اصدار فواتير
                </div>
                <label class="main-lable" for="">عرض خدمات:</label>
                @foreach ($departments as $department)
                    <label for="">{{ $department->name }}</label>
                    <input {{ in_array($department->id, $user->show_department_products ?? []) ? 'checked' : '' }}
                        type="checkbox" value="{{ $department->id }}" name="show_department_products[]">
                @endforeach
            </div>



            <div class="col-12 mt-5 text-center">
                <button class="btn btn-primary">{{ __('admin.Update') }}</button>
            </div>
        </form>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('#js-example-basic-single').select2();
    });
</script>
