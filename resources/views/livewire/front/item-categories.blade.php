<section class="main-section home">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="small-heading mb-3">@lang('admin.item_categories')</h4>
            <div class="d-flex gap-1 flex-column flex-md-row">
                <a href="{{ route('front.orders.create') }}" class="btn-main-sm px-4">شاشة البيع</a>
                <a href="{{ route('front.items') }}" class="btn-main-sm px-4">@lang('admin.Products')</a>
                <a href="{{ route('front.item-categories') }}" class="btn-main-sm px-4">اقسام المنتجات</a>
                <a href="{{ route('front.warehouses') }}" class="btn-main-sm px-4">المستودعات</a>
            </div>
            <div class="d-flex">
                <button wire:click="resetForm" type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                    data-bs-target="#type">
                    @lang('Add')
                </button>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="type" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('Add type')</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="collectData-box mb-2">
                                    <label for="" class="small-label mb-1">@lang('name')</label>
                                    <input wire:model="name" type="text" id="" class="w-100 form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="collectData-box mb-2">
                                    <label for="" class="small-label mb-1">القسم الرئيسي (اختياري)</label>

                                    <select class="form-select" wire:model='parent_id'>
                                        <option value="">--اختر--</option>
                                        @foreach($parents as $parent)
                                        <option value="{{ $parent->id }}">{{$parent->name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('back')</button>
                        <button wire:click="submit" data-bs-dismiss="modal"
                            class="btn btn-success">@lang('Save')</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="latestAppointments-content bg-white p-3 rounded-2 shadow">
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <th>#</th>
                        <th>@lang('name')</th>
                        <th>القسم الرئيسي</th>
                        <th>@lang('actions')</th>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->parent?->name ?? '--'}}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button data-bs-toggle="modal" wire:click="edit({{$category->id}})"
                                        data-bs-target="#type" class="btn btn-info btn-sm"><i
                                            class="fa-solid fa-pen"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#delete{{$category->id}}">
                                        <i class="fas fa-trash "></i>
                                    </button>
                                    @include('deleteModal',['item' => $category])
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
