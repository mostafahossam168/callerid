<section class="main-section users">

    <x-alert></x-alert>
    @include('front.units.modal')

    <div class="container">
        <h4 class="main-heading">{{ __('admin.units') }}</h4>
        <div class="section-content p-4 bg-white rounded-3 shadow">
            <div class="d-flex align-items-center flex-wrap gap-1 justify-content-between mb-3">
                @can('create_units')
                    <button type="button" class="btn-main-sm px-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        {{ __('admin.Add') }}
                    </button>
                @endcan
            </div>

            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('admin.name') }}</th>
                            <th scope="col">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($units as $unit)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $unit->name }}</td>

                                <td>
                                    @can('update_units')
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" wire:click="edit({{ $unit->id }})">
                                            {{ __('admin.Update') }}
                                        </button>
                                    @endcan

                                    @can('delete_units')
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $unit->id }}">
                                            {{ __('admin.Delete') }}
                                        </button>
                                        @include('front.units.delete')
                                    @endcan

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $units->links() }}
            </div>
        </div>
    </div>
</section>
