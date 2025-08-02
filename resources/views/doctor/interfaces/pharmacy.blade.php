<section class="row g-3">
    <div class="col-md-6">
        <div class="content b-border p-2">
            <div class="form-group">
                <label class="small-label">{{ __('service') }}</label>
                <input type="text" wire:model="drug_key" class="form-control" id="">
            </div>
            @if ($searched_drugs)
                <div class="btn-holder text-start mt-3 mb-2">
                    <div class="btn btn-sm btn-danger px-3" data-bs-toggle="collapse" data-bs-target="#collapseExample"
                        aria-expanded="false">{{ __('admin.Close') }}</div>
                </div>
                <div class="collapse show" id="collapseExample">
                    <div class="card card-body">
                        <div class="d-flex flex-column gap-2">
                            @foreach ($searched_drugs as $drug)
                                <p
                                    class="d-flex align-items-center justify-content-between full-bottom-border gap-2 m-0 fs-13px">
                                    {{ $drug->name_ar }} {{ $drug->name_en }}<button
                                        class="btn btn-xs btn-primary text-white"
                                        wire:click='selectDrug({{ $drug }})'>اختيار</button></p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="table-responsive">
            <table class="table main-table">
                <tr>
                    <td>{{ __('Medicine') }}</td>
                    <td>{{__('admin.quantity')}}</td>
                </tr>
                @forelse($selected_drugs as $request)
                    <tr>
                        <td>
                            {{ $request['name_ar'] }}
                        </td>
                        <td>
                            {{ isset($request['quantity']) ? $request['quantity'] : '1' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">{{ __('Add some medicine') }}</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
    <div class="col-12 col-md-12">
        <div class="form-group">
            <label class="small-label">{{ __('Description and exchange notes') }}</label>
            <textarea wire:model.defer="dr_content" class="form-control" style="height: 50px;"></textarea>
        </div>
    </div>
    <div class="col-12 d-flex justify-content-end">
        <button wire:click='drug_request' class="btn btn-sm trans-btn w-25">
            {{ __('send request') }}
        </button>
    </div>


    {{-- @push('js')
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
  $(function() {
    function matchStart(params, data) {
      // If there are no search terms, return all of the data
      if ($.trim(params.term) === '') {
        return data;
      }

      // Skip if there is no 'children' property
      if (typeof data.children === 'undefined') {
        return null;
      }

      // `data.children` contains the actual options that we are matching against
      var filteredChildren = [];
      $.each(data.children, function(idx, child) {
        if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
          filteredChildren.push(child);
        }
      });

      // If we matched any of the timezone group's children, then set the matched children on the group
      // and return the group object
      if (filteredChildren.length) {
        var modifiedData = $.extend({}, data, true);
        modifiedData.children = filteredChildren;

        // You can return modified objects from here
        // This includes matching the `children` how you want in nested data sets
        return modifiedData;
      }

      // Return `null` if the term should not be displayed
      return null;
    }

    $(".select2").select2({
      cure: true,
      closeOnSelect: false,
      minimumResultsForSearch: Infinity,
      matcher: matchStart
    });
  });
  </script>

  @endpush --}}
</section>
