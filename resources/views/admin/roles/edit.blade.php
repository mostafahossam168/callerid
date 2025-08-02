@extends('admin.layouts.admin')
@section('title')
    {{ __('Edit group') }}
@endsection
@section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href='{{ route('admin.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Edit group') }}</li>
        </ol>
    </nav>
    <div class="row w-100 mx-auto p-3 shadow rounded-3 bg-white">

        <form action="{{ route('admin.roles.update', $role) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="form-group ">
                        <p for="" class="mb-2">{{ __('admin.name') }}</p>
                        <div class="d-flex">
                            <input type="text" class=" form-control" name="name" value="{{ $role->name }}">
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
                                    class="small-heading d-block mb-0 fw-normal text-white text-start rounded p-2 title-bg-color">
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
                                                        {{ in_array($map . '_' . $name, $rolePermissions) ? 'checked' : '' }}
                                                        value="{{ $map . '_' . $name }}" id="{{ $map . '_' . $name }}">
                                                    <span class="slider round"></span>
                                                </label>
                                                <label for="{{ $map . '_' . $name }}"
                                                    class='title'>@lang($map)</label>
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
                <button class="btn-main-sm">{{ __('Save') }}</button>
            </div>
        </form>


    </div>
@endsection
