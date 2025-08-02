@extends('front.layouts.front')
@section('title')
    {{ $package->name }}
@endsection
@section('content')
    <section class="main-section users">
        <section class="addPatient-section py-5">
            <div class="container">
                <div class="p-4 bg-white rounded-3 shadow">
                    <div
                        class="holder mb-3 flex-column-reverse flex-sm-row d-flex align-items-start align-items-sm-center justify-content-between gap-2 ">
                        <h4 class="main-heading mb-0">عرض</h4>
                        <a href="{{ route('front.packages') }}" class="btn btn-sm  me-auto px-3 btn-secondary">@lang('back') <i
                                class="fa-solid fa-arrow-left-long"></i></a>
                    </div>
                    <div class="addPatient-content ">
                        <h4 class="section-title px-2 py-3 fs-18px rounded-3 mb-4 text-center">
                            {{ $package->name }}
                        </h4>
                        <div class="row g-3 Patient-form-data">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Unit')</th>
                                        <th>@lang('Natural ratio')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($package->package_departments()->orderBy('sort')->get() as $item)
                                        <tr>
                                            <td>{{ $item->analysis_department->name_ar . ' - ' . $item->analysis_department->name_en }}
                                            </td>
                                            <td>{{ $item->analysis_department->unit }}</td>
                                            <td>{{ $item->range }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
