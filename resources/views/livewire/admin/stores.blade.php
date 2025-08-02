<section>
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href='{{ route('admin.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">المخازن</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        @include('admin.stores.modal')
        <button type="button" class="btn mb-3 btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            {{ __('admin.Add') }}
        </button>
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
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" wire:click="edit({{ $store->id }})">
                                {{ __('admin.Update') }}
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete{{ $store->id }}">
                                {{ __('admin.Delete') }}
                            </button>
                        @include('admin.stores.delete')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $stores->links() }}

    </div>
</section>
