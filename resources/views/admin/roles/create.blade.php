@extends('admin.layouts.admin')
@section('title')
    {{ __('admin.Add group') }}
@endsection
@section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href='{{ route('admin.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Add group') }}</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <b>{{ __('admin.Add group') }}</b>
        <hr>
        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="form-group ">
                        <p class="mb-2">{{ __('admin.name') }}</p>
                        <div class="d-flex">
                            <input type="text" class=" form-control" name="name">
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table-role table table-bordered">
                    @foreach ($groups as $name => $m_groups)
                        <tr>
                            <th colspan="12">
                                <label
                                    class="small-heading d-block fw-normal mb-0 text-white text-start rounded p-2 title-bg-color">
                                    {{ __($name) }}
                                </label>
                            </th>
                        </tr>
                        <tbody>
                            @foreach ($m_groups as $name => $group)
                                <tr>
                                    <th> @lang($name) </th>
                                    @foreach ($group as $map)
                                        <td>
                                            <div class="toggle">
                                                <label class="switch">
                                                    <input type="checkbox" name="permissions[]"
                                                        value="{{ $map . '_' . $name }}" id="{{ $map . '_' . $name }}">
                                                    <span class="slider round"></span>
                                                </label>
                                                <label for="{{ $map . '_' . $name }}"
                                                    class='title'>{{ __($map) }}</label>
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    @endforeach
                </table>
            </div>

            <div class="btn-holder mt-3 d-flex justify-content-end ">
                <button class="btn btn-primary">حفظ</button>
            </div>
        </form>


    </div>
@endsection
