 <section class="p-3">
     <section class="form-group mb-3 ">
         <label for="exampleFormControlTextarea1" class="mb-2"> {{__('admin.Attach files')}}</label>
         <input type="file" wire:model.defer='file' class="form-control w-auto">
     </section>
     <section class="form-group mb-3 ">
         <label for="exampleFormControlTextarea1" class="mb-2">{{__('admin.Doctor report')}}</label>
         <textarea class="form-control" rows="3" wire:model.defer="dr_content"></textarea>
     </section>
     {{-- <section class="form-group mb-3 ">
         <label for="exampleFormControlTextarea1" class="mb-2 d-block">خدمة الاشعة</label>
         <select wire:model.defer="scan_product_id" class="main-select w-auto" id="">
             <option value="">اختر خدمة الاشعة</option>
             <option value="">اختر الخدمة</option>
             @foreach ($scan_products as $product)
             <option value="{{ $product->id }}">{{ $product->name }}</option>
     @endforeach
     </select>
 </section> --}}
 <button type="button" class="btn btn-sm btn-primary" wire:click='saveScan'>{{ __('admin.save') }}</button>
 <section class="table-responsive mt-4">
     <table class="table main-table m-0">
         <thead>
             <tr>
                 <th>{{ __('admin.animal') }}</th>
                 <th>{{__('admin.Diagnosis')}}</th>
                 <th>{{ __('admin.File') }}</th>
                 <th>{{__('admin.Date')}}</th>
                 <th class="text-center not-print">{{ __('admin.managers') }}</th>
             </tr>
         </thead>
         <tbody>
             @forelse($patient->scans()->where('animal_id',$animal->id)->get() as $scan)
             <tr>
                 <td>{{ $scan->animal?->name }}</td>
                 <td>{{ $scan->file_name }}</td>
                 @if($scan->file_path)
                 <a target="_blank" href="{{ display_file($scan->file_path) }}">عرض الملف</a>
                 @endif
                 <td>{{ $scan->created_at->diffForHumans() }}</td>
                 <td>
                     <div class="btn_holder d-flex align-items-center justify-content-center gap-2">
                         @if ($scan->file)
                         <a target="_blank" href="{{ display_file($scan->file) }}" class="btn btn-sm btn-info text-white">
                             <i class="fa-solid fa-eye"></i>
                         </a>
                         @endif
                     </div>
                 </td>
             </tr>
             @empty
             @endforelse
         </tbody>
     </table>
 </section>
 </section>
