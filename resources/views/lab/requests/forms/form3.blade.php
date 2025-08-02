 <div class="row">
     <div class="col-12">
         <div class="content mb-4">
             <div class="text align-items-center">
                 <h4 class="mb-0">الطفيليات الدم</h4>
             </div>
         </div>
         <table class=" mb-3">
             <tr>
                 <td><b>الاختبار</b></td>
                 <td><b>Trypanosoma</b></td>
                 <td><b>Anapisma</b></td>
                 <td><b>Babesia</b></td>
                 <td><b>Thieleria</b></td>
             </tr>
             <tr>
                 <td><b>النتائج</b></td>
                 <td>
                     <input type="text" {{ isset($analysis) ? 'disabled' : '' }}
                         wire:model="results.blood_parasites.trypanosoma" class="form-control w">
                 </td>
                 <td>
                     <input type="text" {{ isset($analysis) ? 'disabled' : '' }}
                         wire:model="results.blood_parasites.anapisma" class="form-control">
                 </td>
                 <td>
                     <input type="text" {{ isset($analysis) ? 'disabled' : '' }}
                         wire:model="results.blood_parasites.babesia" class="form-control">
                 </td>
                 <td>
                     <input type="text" {{ isset($analysis) ? 'disabled' : '' }}
                         wire:model="results.blood_parasites.thieleria" class="form-control">
                 </td>
             </tr>

         </table>
     </div>
 </div>
