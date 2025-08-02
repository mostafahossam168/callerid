<section class="main-section users">

    <x-alert></x-alert>
    @include('front.cost_centers.modal')

    <div class="container">
        <div class="section-content p-4 bg-white rounded-3 shadow">
            <div class="d-flex align-items-center flex-wrap gap-1 justify-content-between mb-3">
                <button type="button" class="btn-main-sm px-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    {{ __('admin.Add') }}
                </button>
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
                        @foreach ($centers as $cost_center)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $cost_center->name }}</td>

                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" wire:click="edit({{ $cost_center->id }})">
                                        {{ __('admin.Update') }}
                                    </button>

                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $cost_center->id }}">
                                        {{ __('admin.Delete') }}
                                    </button>
                                    @include('front.cost_centers.delete')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $centers->links() }}
            </div>
        </div>
    </div>
</section>
