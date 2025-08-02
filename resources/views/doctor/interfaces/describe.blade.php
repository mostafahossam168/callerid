<section class="">
    @if(!setting()->main_pharmacy_warehouse_id)
        <div class="alert alert-warning">يجب تحديد مستودع الصيدلية من الاعدادات اولا</div>
    @else
        <div class="row g-3">
            <div class="col-12">
                <table class="table main-table">
                    <thead>
                    <tr>
                        <th class="d-flex align-items-center justify-content-between">
                            الادوية
                        </th>
                        <th></th>
                        <th></th>
                        <th>
                            <button wire:click.prevent="addMedicine" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </th>
                        <th> الاجمالي : {{$prescription_total ?? 0}}</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($medicines as $key => $medicine)
                        <tr style="border-bottom: 2px solid #ccc !important;">
                            <td colspan="4">
                                <select wire:change="calculatePrescriptionTotal"
                                        wire:model="medicines.{{ $key }}.pharmacy_medicine_id" id=""
                                        class="form-select select2 w-100">
                                    <option value="">اختر الدواء</option>
                                    @foreach(\App\Models\PharmacyMedicine::get() as $ph_medicine)
                                        <option value="{{$ph_medicine->id}}">{{$ph_medicine->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" wire:change="calculatePrescriptionTotal"
                                       wire:model="medicines.{{ $key }}.quantity" id="" class="form-control"
                                       placeholder="الجرعة">
                            </td>
                            <td>
                                <input type="text" wire:model="medicines.{{ $key }}.repetition" id="" class="form-control"
                                       placeholder="التكرار/المعدل">
                            </td>
                            <td>
                                <input type="text" wire:model="medicines.{{ $key }}.duration" id="" class="form-control"
                                       placeholder="المدة">
                            </td>

                            <td>
                                <input type="text" disabled wire:model="medicines.{{ $key }}.total" id=""
                                       class="form-control" placeholder="الاجمالي">
                            </td>

                            <td style="vertical-align: middle;">
                                @if ($key != 0)
                                    <button class="btn btn-danger btn-sm" wire:click.prevent="removeMedicine({{ $key }})"><i
                                            class="fa fa-trash"></i></button>
                                @endif
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
                <button class="btn btn-success" wire:click="addPrescription">حفظ</button>
            </div>
        </div>
    @endif
</section>
