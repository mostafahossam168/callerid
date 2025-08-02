<section>
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href='{{ route('admin.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">المواد</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        @include('admin.supplies.modal')


        <button type="button" class="btn mb-3 btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            {{ __('admin.Add') }}
        </button>
        <table class="table main-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{__('admin.name')}}</th>
                    <th scope="col">{{__('admin.Main category')}}</th>
                    <th scope="col">{{__('admin.Subcategory')}}</th>
                    <th scope="col">{{__('admin.quantity')}}</th>
                    <th scope="col">{{__('admin.cost_price')}}</th>
                    <th scope="col">{{ __('admin.managers') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($supplies as $supply)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $supply->name }}</td>
                        <td>{{ $supply->kind?->name ?? '-' }}</td>
                        <td>{{ $supply->kind->main?->name ?? '-' }}</td>
                        <td>{{ $supply->quantity }}</td>
                        <td>{{ $supply->purchase_price }}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" wire:click="edit({{ $supply->id }})">
                                {{ __('admin.Update') }}
                            </button>

                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#delete{{ $supply->id }}">
                                {{ __('admin.Delete') }}
                            </button>
                            @include('admin.supplies.delete')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $supplies->links() }}

    </div>
</section>
