<section class="main-section users">

    <x-alert></x-alert>
    @include('front.stores.modal')

    <div class="container">
        <h4 class="main-heading">{{ __('admin.stores') }}</h4>
        <div class="section-content p-4 bg-white rounded-3 shadow">
            <div class="d-flex align-items-center flex-wrap gap-1 justify-content-end mb-3">
                <button type="button" class="btn btn-sm px-4 btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    {{ __('admin.Add') }}
                </button>
            </div>
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('admin.name') }}</th>
                            <th scope="col">{{ __('admin.sub of') }}</th>
                            <th scope="col">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stores as $store)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $store->name }}</td>
                                <td>{{ $store->main?->name ?? '-' }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" wire:click="edit({{ $store->id }})">
                                        {{ __('admin.Update') }}
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $store->id }}">
                                        {{ __('admin.Delete') }}
                                    </button>
                                    @include('front.stores.delete')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $stores->links() }}

            </div>
        </div>
        <!-- All Modal -->
        <!-- Modal repeat -->
    </div>
</section>
