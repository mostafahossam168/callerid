 <div class="ayada main-section">
     <div class="pic-con">
         <img src="{{ asset('img/pic.png') }}" class="pic1" alt="">
         <img src="{{ asset('img/pic.png') }}" class="pi2" alt="">
     </div>
     <div class="pic-con2">
         <img src="{{ asset('img/pic.png') }}" class="pic1" alt="">
         <img src="{{ asset('img/pic.png') }}" class="pi2" alt="">
     </div>
     <div class="pic-con3">
         <img src="{{ asset('img/pic.png') }}" class="pic1" alt="">
         <img src="{{ asset('img/pic.png') }}" class="pi2" alt="">
     </div>
     <div class="pic-con4">
         <img src="{{ asset('img/pic.png') }}" class="pic1" alt="">
         <img src="{{ asset('img/pic.png') }}" class="pi2" alt="">
     </div>
     <section>

         <div class="page container ">
             <div class="mb-3">
                 <label>اختر النموذج</label>
                 <select wire:model="form" class="form-control">
                     <option value="">اختر</option>
                     <option value="form1">نموذج 1</option>
                     <option value="form2">نموذج 2</option>
                     <option value="form3">نموذج 3</option>
                     <option value="form4">نموذج 4</option>
                 </select>
                 @error('form')
                     <div class="text-danger">{{ $message }}</div>
                 @enderror
             </div>
             @if ($form)
                 @include('lab.requests.forms.' . $form)
             @endif

             <div class="text-center mt-3">
                 <button type="button" wire:click="save" class="btn btn-sm btn-success">حفظ</button>
             </div>
         </div>
     </section>
 </div>
