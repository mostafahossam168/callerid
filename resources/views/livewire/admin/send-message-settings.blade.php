<section>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <div class="alert alert-info">
            قم بأستخدام التعابير الاتية لطباعة المحتوي الخاص بها
            <ul>
                <li>
                    {userName} : إسم المالك
                </li>
                <li>
                    {appointmentNumber} : رقم الميعاد
                </li>
                <li>
                    {date} : تاريخ الموعد
                </li>
                <li>
                    {time} : وقت الموعد
                </li>
                <li>
                    {doctor} : الطبيب
                </li>
                <li>
                    {animal} : الأليف
                </li>
                <li>
                    {product} : الخدمة
                </li>
                <li>
                    {clinic} : العيادة
                </li>
            </ul>

        </div>
        <x-message-admin></x-message-admin>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="d-flex gap-2 mb-2">
                        <input type="checkbox" wire:model.defer='befor_appointment_message_status'>
                        <label for="">تفعيل رسالة تذكير قبل الموعد</label>
                    </div>
                    <textarea class="form-control" wire:model.defer='befor_appointment_message' id="" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div>
                        <input type="checkbox" wire:model.defer='create_appointment_message_status'>
                        <label for="">تفعيل رسالة حجز الموعد</label>
                    </div>
                    <textarea class="form-control" wire:model.defer='create_appointment_message' id="" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div>
                        <input type="checkbox" wire:model.defer='cancel_appointment_message_status'>
                        <label for="">تفعيل رسالة إلغاء الموعد</label>
                    </div>
                    <textarea class="form-control" wire:model.defer='cancel_appointment_message' id="" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div>
                        <input type="checkbox" wire:model.defer='new_patient_message_status'>
                        <label for="">تفعيل رسالة تسجيل جديد</label>
                    </div>
                    <textarea class="form-control" wire:model.defer='new_patient_message' id="" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="col-md-12  mb-3">
                <button wire:click='save' class="btn btn-primary">حفظ</button>
            </div>
        </div>

    </div>
</section>
