 <form class="my-1 my-xl-0" action="{{ route('doctor.notifications.bulk_delete', 'ids') }}" method="post"
     style="display: inline-block;" autocomplete="off">
     @csrf
     @method('delete')
     <div class="modal fade" id="bulkdelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('admin.Delete all')}}</h1>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     {{__('admin.Do you want to clear all notifications?')}}
                     <input type="hidden" id="delete_all" name="delete_select_id" value="">
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('admin.Close') }}</button>
                     <button type="submit" class="btn btn-primary">{{__('admin.Yes')}}</button>
                 </div>
             </div>
         </div>
     </div>
 </form>
