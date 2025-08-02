<div class="modal fade" id="restore{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.users.destroy',$user) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    {{ __('admin.are sure of the restoring process?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">{{ __('No') }}</button>
                    <button class="btn btn-sm  btn-danger" type="submit" data-bs-dismiss="modal">{{ __('Yes') }}</button>
                </div>
            </form>
        </div>

    </div>
</div>
