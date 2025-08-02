<section class="main-section users">

    @if ($screen == 'index')
        <div class="container">
            <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
                <h4 class="main-heading mb-0">@lang('sections')</h4>
            </div>
            <div class="bg-white shadow p-4 rounded-3">
                <div class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                    <div class="buttons-holder gap-1 d-flex align-items-center flex-wrap">
                        @can('create_packages')
                            <button wire:click="$set('screen','add')" class="btn-main-sm">
                                @lang('Add')
                                <i class="icon fa-solid fa-plus"></i>
                            </button>
                        @endcan
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('name')</th>
                                <th>@lang('Breed')</th>
                                <th>@lang('Number of Analysis')</th>
                                <th class="text-center not-print">@lang('actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($packages as $package)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-nowrap">{{ $package->name }}</td>
                                    <td class="text-nowrap">{{ $package->breed?->name }}</td>
                                    <td class="text-nowrap"><a
                                            href="{{ route('front.mkhtbr-analysis', ['package_id' => $package->id]) }}"
                                            class="btn btn-sm btn-warning text-white">
                                            {{ $package->analyses->count() }}
                                        </a></td>
                                    <td class="not-print">
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <a href="{{ route('front.packages.show', $package->id) }}"
                                                class="btn btn-sm btn-primary text-white">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            @can('update_packages')
                                                <a wire:click='edit({{ $package->id }})'
                                                    class="btn btn-sm btn-info text-white">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                            @endcan
                                            @can('create_packages')
                                                <a wire:click='copy({{ $package->id }})' title="@lang('admin.copy')"
                                                    class="btn btn-sm btn-dark text-white">
                                                    <i class="fa-solid fa-copy"></i>
                                                </a>
                                            @endcan
                                            @can('delete_packages')
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#delete" wire:click='packageId({{ $package->id }})'>
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $packages->links() }}
                    @include('livewire.front.packages.delete')
                </div>
            </div>
        </div>
    @else
        @include('livewire.front.packages.form')
    @endif
</section>
