<section>
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href='{{ route('admin.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">الأسئلة</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        @include('admin.faqs.modal')
        <button type="button" class="btn mb-3 btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            {{ __('admin.Add') }}
        </button>
        <table class="table main-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">السؤال</th>
                    <th scope="col">الترتيب</th>
                    <th scope="col">{{ __('admin.managers') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($faqs as $faq)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->sort }}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" wire:click="edit({{ $faq->id }})">
                                {{ __('admin.Update') }}
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#delete{{ $faq->id }}">
                                {{ __('admin.Delete') }}
                            </button>
                            @include('admin.faqs.delete')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $faqs->links() }}

    </div>
</section>
