<section class="main-section users">

    <x-alert></x-alert>
    @include('front.purchase-categories.modal')

    <div class="container">
        <h4 class="main-heading">{{ __('admin.kinds') }}</h4>
        <div class="section-content p-4 bg-white rounded-3 shadow">
            <div class="btn-holder d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                <button type="button" class="btn btn-primary btn-sm px-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    {{ __('admin.Add') }}
                </button>
                <a href="{{ route('front.purchases.index') }}" class="btn-main-sm px-4">{{ __('admin.purchases') }}</a>
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
                        @foreach ($kinds as $kind)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $kind->name }}</td>
                            <td>{{ $kind->parent?->name ?? '-' }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" wire:click="edit({{ $kind->id }})">
                                    {{ __('admin.Update') }}
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete{{ $kind->id }}">
                                    {{ __('admin.Delete') }}
                                </button>
                                @include('front.purchase-categories.delete')
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $kinds->links() }}

            </div>
        </div>
        <!-- All Modal -->
        <!-- Modal repeat -->
    </div>
</section>
