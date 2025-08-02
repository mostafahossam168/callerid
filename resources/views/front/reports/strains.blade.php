@extends('front.layouts.front')
@section('title')
{{__("admin.Types of breeds")}}
@endsection
@section('content')
<section class="main-section pt-5">
    <div class="container">
        <div class="d-flex mb-3 gap-3 align-items-center ">
            <a href="{{ route('front.reports') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
            <h4 class="main-heading m-0">{{__("admin.Types of breeds")}}</h4>
        </div>
        <div class="bg-white p-4 rounded-2 shadow">
            <div class=" d-flex justify-content-between gap-2 flex-wrap mb-3">
                <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                    <form action="" method="GET" id="searchForm">
                        <select onchange="document.getElementById('searchForm').submit()" name="category" class="main-select w-100" id="">
                            <option {{ request()->get('category') == 'all' ? 'selected' : '' }} value="all">{{__("admin.All")}}</option>
                            {{-- <option value="">قسم1</option>
                            <option value="">قسم2</option> --}}
                            @foreach (App\Models\Category::all() as $category)
                            <option {{ request()->get('category') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <button class="btn btn-sm btn-warning" id="btn-prt-content">
                    <i class="fa-solid fa-print"></i>
                    <span>{{ __('admin.print') }}</span>
                </button>
            </div>
            <div id="prt-content" class="table-print">
                <x-header-invoice></x-header-invoice>
                <div class="table-responsive">
                    <table class="table main-table" id="data-table">
                        <thead>
                            <tr>
                                <th>{{__('admin.category')}}</th>
                                <th>{{__('admin.Pet strain')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $strains = App\Models\Strain::where(function($q){
                            if(request()->has('category') && request()->get('category') != 'all'){
                            $q->where('category_id',request()->get('category'));
                            }
                            })->paginate(5);
                            @endphp
                            @forelse ($strains as $strain)
                            <tr>
                                <td>{{ $strain->name }}</td>
                                <td>{{ $strain->category?->name }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td>{{ __('admin.Sorry, there are no results') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ App\Models\Strain::paginate(5)->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection