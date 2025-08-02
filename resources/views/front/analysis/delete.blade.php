<div class="modal fade" id="delete{{$analysis->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- <form action="{{ route('admin.analysis.destroy',$role) }}" method="POST"> --}}
            @csrf
            @method('DELETE')
            <div class="modal-body">
                @lang('admin.Are you sure about the deletion?')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">@lang('admin.No')</button>
                <button class="btn btn-sm  btn-danger" type="button" wire:click='delete' data-bs-dismiss="modal">@lang('Delete')</button>
            </div>
            {{-- </form> --}}
        </div>

    </div>
</div>
