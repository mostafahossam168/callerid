<section class="main-section users">

    <x-alert></x-alert>
    @include('front.kinds.modal')

    <div class="container">
        <h4 class="main-heading">مستودع العيادة / الاقسام</h4>
        <div class="section-content p-4 bg-white rounded-3 shadow">
            <div class="btn-holder d-flex align-items-center justify-content-end flex-wrap gap-2 mb-3">
                <button type="button" class="btn-main-sm px-4" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                    {{ __('admin.Add') }}
                    <i class="fas fa-plus"></i>
                </button>
                <a href="{{ route('front.supplies') }}" class="btn btn-sm btn-secondary px-3">@lang('kinds') <i class="fas fa-arrow-left-long"></i></a>
            </div>
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">القسم الرئيسي</th>
                        <th scope="col">القسم الفرعي</th>
                        <th>@lang('kinds')</th>
                        <th scope="col">{{ __('admin.managers') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($kinds as $kind)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $kind->name }}</td>
                            <td>{{ $kind->main?->name ?? '-' }}</td>
                            <td>{{$kind->supplies->count()}}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal"
                                        wire:click="edit({{ $kind->id }})">
                                    {{ __('admin.Update') }}
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $kind->id }}">
                                    {{ __('admin.Delete') }}
                                </button>
                                @include('front.kinds.delete')
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
