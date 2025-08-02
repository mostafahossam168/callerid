<section class="main-section" wire:ignore.self>

    @section('title')
        {{ __('Accounts tree') }}
    @endsection
    <div class="container-fluid">
        <x-alert></x-alert>
        <div class="app-tree">
            <nav class="sidebar-app">
                <button data-active=".sidebar-app" class="tog-active close">
                    <i class="fas fa-xmark"></i>
                </button>
                <a class="item set-border" data-bs-toggle="collapse" href="#tree" class="collapsed" aria-expanded="true">
                    <div>
                        <i class="fa-solid fa-timeline icon"></i>
                        {{ __('Accounts tree') }}
                    </div>
                    <i class="fas fa-angle-right arrow"></i>
                </a>
                <div class="show item-collapse collapse" id="tree">
                    <div class="d-flex justify-content-center px-2">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#add_or_update"
                            class="btn w-100 btn-sm btn-success">@lang('Add')</button>
                    </div>
                    {{-- <div class="option-section">
                        @foreach ($parents as $account)
                        <a class="item" data-bs-toggle="collapse" href="#link-{{ $account->id }}">
                            <i class="fas fa-caret-down arrow-after"></i>
                            <i class="arrow-before fas fa-caret-left"></i>
                            <div class="content-item">
                                <i class="fa-solid fa-list"></i>
                                <span class="badge bg-dark">{{ $account->id }}</span>-{{ $account->name }}
                            </div>
                        </a>
                        <div class="collapse collapse-border" id="link-{{ $account->id }}">
                            <div class="mar-side">
                                @foreach ($account->kids as $kid)
                                <a class="item" data-bs-toggle="collapse" href="#link-{{ $kid->id }}">
                                    <i class="fas fa-caret-down arrow-after"></i>
                                    <i class="arrow-before fas fa-caret-left"></i>
                                    <div class="content-item">
                                        <i class="fa-solid fa-plus"></i>
                                        <span class="badge bg-dark">{{ $kid->id }}</span> -{{ $kid->name }}
                                    </div>
                                </a>
                                <div class="collapse collapse-border" id="link-{{ $kid->id }}">
                                    <div class="mar-side">
                                        @foreach ($kid->kids as $k)
                                        <a class="item" data-bs-toggle="collapse" href="#link-{{ $k->id }}">
                                            <i class="fas fa-caret-down arrow-after"></i>
                                            <i class="arrow-before fas fa-caret-left"></i>
                                            <div class="content-item">
                                                <i class="fa-solid fa-plus"></i>
                                                <span class="badge bg-dark">{{ $k->id }}</span> -{{ $k->name }}
                                            </div>
                                        </a>

                                        <div class="collapse collapse-border" id="link-{{ $k->id }}">
                                            <div class="mar-side">
                                                @foreach ($k->kids as $kk)
                                                <a class="item" data-bs-toggle="collapse" href="#link-{{ $kk->id }}">
                                                    <i class="fas fa-caret-down arrow-after"></i>
                                                    <i class="arrow-before fas fa-caret-left"></i>
                                                    <div class="content-item">
                                                        <i class="fa-solid fa-plus"></i>
                                                        {{ $loop->parent->parent->iteration }}{{ $loop->parent->iteration }}{{ $loop->iteration }}-{{ $kk->name }}
                                                    </div>
                                                </a>
                                                <div class="collapse collapse-border" id="link-{{ $kk->id }}">
                                                    <div class="mar-side">
                                                        @foreach ($kk->kids as $k3)
                                                        <a class="item">
                                                            <div class="content-item">
                                                                <i class="fa-solid fa-plus"></i>
                                                                {{ $loop->parent->parent->parent->iteration }}{{ $loop->parent->parent->iteration }}{{ $loop->parent->iteration }}-{{ $loop->iteration }}-{{ $k3->name }}
                                                            </div>
                                                        </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div> --}}

                    <div class="option-section">
                        @php
                            function renderNestedAccounts($assets, $level)
                            {
                                foreach ($assets as $asset) {
                                    echo '<div class="d-flex mb-2">';
                                    echo '<a class="item" data-bs-toggle="collapse" href="#link-' .
                                        $asset->id .
                                        '-' .
                                        $level .
                                        '">';
                                    echo '<i class="fas fa-caret-down arrow-after"></i>';
                                    echo '<i class="arrow-before fas fa-caret-left"></i>';
                                    echo '<div class="content-item">';
                                    echo '<i class="fas fa-list"></i>';
                                    echo $asset->id . ' - ' . $asset->name;
                                    echo '</div>';
                                    echo '</a>';
                                    echo '</div>';

                                    if ($asset->subAssets->isNotEmpty()) {
                                        echo '<div class="collapse collapse-border" id="link-' .
                                            $asset->id .
                                            '-' .
                                            $level .
                                            '">';
                                        echo '<div class="mar-side">';
                                        renderNestedAccounts($asset->subAssets, $level + 1);
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                }
                            }

                            $sidebarAssets = \App\Models\Account::Parents();
                        @endphp

                        @foreach ($sidebarAssets as $asset)
                            <div class="d-flex mb-2">
                                <a class="item" data-bs-toggle="collapse" href="#link-{{ $asset->id }}"> <i
                                        class="fas fa-caret-down arrow-after"></i>
                                    <i class="arrow-before fas fa-caret-left"></i>
                                    <div class="content-item">
                                        <i class="fas fa-list"></i>
                                        {{ $asset->id }} - {{ $asset->name }}
                                    </div>
                                </a>
                            </div>
                            @if ($asset->subAssets->isNotEmpty())
                                <div class="collapse collapse-border" id="link-{{ $asset->id }}">
                                    <div class="mar-side">
                                        @php
                                            renderNestedAccounts($asset->subAssets, 1);
                                        @endphp
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </nav>
            <button data-active=".sidebar-app" class="tog-active btn-sidebar">
                <i class="fas fa-bars"></i>
            </button>
            <div class="content-app">
                <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap  mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                            <i class="fas fa-angle-right"></i>
                        </a>
                        <h4 class="main-heading mb-0">{{ __('Accounts tree') }}</h4>
                    </div>
                    <div class="btn-holder d-flex align-items-center gap-1">
                        <a href="{{ route('front.vouchers.index') }}" class="btn-main-sm">
                            @lang('Daily restrictions')
                        </a>
                        <a href="{{ route('front.reception-restrictions') }}" class="btn-main-sm">
                            @lang('Reception restrictions')
                        </a>
                        <a href="{{ route('front.accounts-tree') }}" class="btn-main-sm">
                            @lang('Accounts tree')
                        </a>
                    </div>
                </div>

                <div class="p-4 bg-white rounded-3 shadow">
                    @if ($filter_id)
                        <button class="btn btn-primary btn-sm"
                            wire:click="$set('filter_id',null)">@lang('All Accounts')</button>
                    @endif
                    <div class="control-option d-flex flex-wrap align-items-center justify-content-end mb-2 gap-1">
                        <button class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#add_or_update">
                            @lang('Add a new section')
                            <i class="icon fa-solid fa-plus me-1"></i>
                        </button>
                        <!-- add or update Modal -->
                        <div class="modal fade" id="add_or_update" aria-labelledby="exampleModalLabel"
                            aria-hidden="true" wire:ignore.self>
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">@lang('Add a new section')</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-info">
                                            @lang('If the section is for employee revenues, an employee must be selected')
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6">
                                                <div class="inp-holder">
                                                    <label for="" class="small-label">@lang('Name')</label>
                                                    <input type="text" wire:model.defer="name" id=""
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="inp-holder">
                                                    <label for="" class="small-label">@lang('Main assets')</label>
                                                    <select wire:model.defer="parent_id" id=""
                                                        class="main-select w-100">
                                                        <option value="">@lang('Choose Main asset')</option>
                                                        @foreach ($parentAccounts as $a)
                                                            <option value="{{ $a->id }}">{{ $a->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    {{-- {{ $a->islastChild() ? 'disabled' : '' }} --}}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="branches"
                                                    class="fild-name ms-2">{{ __('All doctors') }}</label>
                                                <select class="form-control mb-3 mb-sm-0" wire:model="doctor_id"
                                                    id="">
                                                    <option value="">{{ __('Choose doctor') }}</option>
                                                    @foreach ($doctors as $doctor)
                                                        <option value="{{ $doctor->id }}">{{ $doctor->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="inp-holder">
                                                    <label for=""
                                                        class="small-label">@lang('Cost prices')</label>
                                                    <input type="number" wire:model.defer="cost" id=""
                                                        class="form-control">
                                                    <small class="text-danger fs-10px d-block">
                                                        @lang('If the section has a financial value')
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 d-flex align-items-center">
                                                <div class="inp-holder">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="" wire:model.defer='depreciable'>
                                                    <label class="small-label" for="">
                                                        @lang('Depreciable')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary px-3"
                                            data-bs-dismiss="modal">@lang('cancel')</button>
                                        <button class="btn btn-sm btn-success px-3" wire:click="submit"
                                            data-bs-dismiss="modal">@lang('Save')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table main-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Date created')</th>
                                    <th>@lang('Subsections')</th>
                                    <th>@lang('specialist')</th>
                                    <th class="not-print">@lang('actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $account->name }}</td>
                                        <td>{{ $account->created_at }}</td>
                                        <td>
                                            <button wire:click="$set('filter_id',{{ $account->id }})"
                                                class="btn btn-sm btn-primary">{{ $account->kids_count }}</button>
                                        </td>
                                        <td>
                                            {{ $account->doctor?->name }}
                                        </td>
                                        <td class="not-print">
                                            <div class="d-flex align-items-center justify-content-center gap-1">
                                                <button wire:click="edit({{ $account->id }})" data-bs-toggle="modal"
                                                    data-bs-target="#add_or_update"
                                                    class="btn btn-sm btn-info text-white py-1">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger py-1" data-bs-toggle="modal"
                                                    data-bs-target="#delete{{ $account->id }}">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                                <div class="modal fade" id="delete{{ $account->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">@lang('Delete')</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @lang('are sure of the deleting process?')
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-sm btn-danger"
                                                                    data-bs-dismiss="modal">@lang('cancel')</button>
                                                                <button class="btn btn-sm  btn-success"
                                                                    data-bs-dismiss="modal"
                                                                    wire:click="delete({{ $account->id }})">@lang('Yes')</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            // Click tog-active
            if (document.querySelector(".tog-active")) {
                let togglesShow = document.querySelectorAll(".tog-active");
                togglesShow.forEach((e) => {
                    e.addEventListener("click", (evt) => {
                        let divActive = document.querySelector(
                            e.getAttribute("data-active")
                        );
                        divActive.classList.toggle("active");
                    });
                });
            }
        </script>
    @endpush
</section>
