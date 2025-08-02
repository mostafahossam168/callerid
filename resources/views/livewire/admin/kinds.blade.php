<section>
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href='{{ route('admin.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">الأصناف</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        @include('admin.kinds.modal')
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
                @foreach ($kinds as $kind)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>{{ $kind->name }}</td>
                    <td>{{ $kind->main?->name ?? '-' }}</td>
                    <td>
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" wire:click="edit({{ $kind->id }})">
                                {{ __('admin.Update') }}
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete{{ $kind->id }}">
                                {{ __('admin.Delete') }}
                            </button>
                        @include('admin.kinds.delete')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $kinds->links() }}

    </div>
</section>
