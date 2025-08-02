{{-- <div class="d-flex justify-content-end gap-1 mb-3">
    <button class="btn btn-sm btn-primary">
        نموذج 1
    </button>
    <button class="btn btn-sm btn-primary">
        نموذج 2
    </button>
    <button class="btn btn-sm btn-primary">
        نموذج 3
    </button>
    <button class="btn btn-sm btn-primary">
        نموذج 4
    </button>
</div> --}}
<div class="table-responsive">
    <table class="table main-table">
        <tr>
            <td>#</td>
            <td>الحيوان</td>
            <td>التحليل</td>
            <td>الفني</td>
            <td></td>
        </tr>
        @forelse($analyses as $analysis)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $analysis->animal?->name }}</td>
                <td>{{ $analysis->product?->name }}</td>
                <td>{{ $analysis->user?->name }}</td>

                <td>
                    <a target="_blank" class="btn btn-sm btn-success"
                        href="{{ route('front.analysis.show', $analysis->id) }}">عرض
                        النتائج</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">{{ __('There are no requests') }}</td>
            </tr>
        @endforelse
    </table>
    {{ $analyses->links() }}
</div>
