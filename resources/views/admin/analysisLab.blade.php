@extends('admin.layouts.admin')
@section('title')
{{ __('admin.home') }}
@endsection
@section('content')
<nav aria-label="breadcrumb ">
  <ol class="breadcrumb bg-light p-3">
    <a href="{{ route('admin.home') }}" class="breadcrumb-item" aria-current="page">الرئيسية</a>
    <li class="breadcrumb-item active" aria-current="page">معمل التحاليل</li>
  </ol>
</nav>
<div class=" w-100 mx-auto p-3 shadow rounded-3 bg-white">
  <div class="d-flex align-items-center justify-content-between gap-1 mb-2">
    <button class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#add">{{ __('admin.Add') }} <i class="fa-solid fa-plus"></i></button>
    <!-- Add Modal -->
    <div class="modal fade" id="add" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5">اضافة تحليل</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row g-4">
              <div class="col-12 col-md-12">
                <div class="inp-holder">
                  <label for="">رقم التحليل</label>
                  <input type="number" name="" id="" class='form-control'>
                </div>
              </div>
              <div class="col-12 col-md-12">
                <div class="inp-holder">
                  <label for="">اسم التحليل</label>
                  <input type="text" name="" id="" class='form-control'>
                </div>
              </div>
              <div class="col-12 col-md-12">
                <div class="inp-holder">
                  <label for="">{{ __('admin.amount') }}</label>
                  <input type="number" name="" id="" class='form-control'>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">{{ __('admin.Back') }}</button>
            <button type="button" class="btn btn-primary btn-sm px-3">{{ __('admin.Save') }}</button>
          </div>
        </div>
      </div>
    </div>
    <button class="btn btn-success px-4" data-bs-toggle="modal" data-bs-target="#departments-lab">اقسام التحاليل <i class="fa-solid fa-plus"></i></button>
    <!-- Modal departments lab -->
      <div class="modal fade" id="departments-lab" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" >اقسام التحليل</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row g-4">
                <div class="col-12 col-md-12">
                    <div class="inp-holder">
                        <label for="">{{__('admin.Main category')}}</label>
                        <select name="" id="" class="form-select">
                            <option value="">{{__('admin.Select main category')}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="inp-holder">
                        <label for="">قسم فرعي</label>
                        <select name="" id="" class="form-select">
                            <option value="">اختر القسم الفرعى</option>
                        </select>
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">الغاء</button>
              <button type="button" class="btn btn-primary btn-sm px-3">حفظ</button>
            </div>
          </div>
        </div>
      </div>
  </div>
  <table class="table main-table">
    <thead>
      <tr>
        <th>#</th>
        <th>رقم التحليل</th>
        <th>اسم التحليل</th>
        <th>{{ __('admin.amount') }}</th>
        <th>{{__('admin.category')}}</th>
        <th>{{__('admin.actions')}}</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th>0</th>
        <td>2004</td>
        <th>تحليل دم</th>
        <th>2000 {{ __('admin.R.S') }}</th>
        <th>قسم الدم</th>
        <td>
          <button class="btn btn-info btn-sm" href="">{{ __('admin.Update') }}</button>
          <button type="button" class="btn btn-danger btn-sm">
            {{ __('admin.Delete') }}
          </button>
        </td>
      </tr>
    </tbody>
  </table>

</div>
@endsection
