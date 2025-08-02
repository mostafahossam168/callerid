<div>
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">ارسال الرسائل</li>
        </ol>
    </nav>
    <x-message-admin></x-message-admin>
    <div class="row g-3">
        <div wire:ignore class="col-12 col-md-4 col-lg-3">
            <label for="">اختر المريض</label>

                <select wire:model="patient_id" id="patient_id" class="form-control select2">
                </select>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <label for="">حدد نوع الرسالة</label>
            <select wire:model.live="msg_type" class="form-control">
                <option value="">أختر</option>
                <option value="1">نصية</option>
                <option value="2">صورة</option>
            </select>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <label for="">أختر من مكتبة الرسائل</label>
            <select wire:model="message_id" class="form-control">
                <option value="">أختر</option>
                @foreach ($msgs as $m)
                    <option value="{{ $m->id }}">{{ $m->content }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-md-4 col-lg-3">
            <label for=""> ارسل سابقا</label>
            <input type="checkbox" wire:model="prev">
        </div>
        <div class="col-12">
            <div class="btn-holder">
                <button type="button"  class="btn btn-success px-4" wire:click='submit'>ارسال</button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        function select2init() {
            $(document).ready(function () {

                $('.select2').each(function () {
                    $(this).select2({
                        allowClear: true,

                        ajax: {
                            url: `/select2-patients`,
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                    search: params.term || '',
                                    page: params.page || 1
                                }
                            },
                            cache: true,
                            pagination: {
                                more: true
                            }
                        }
                    });

                    $(this).on('change', function () {
                        var data = $(this).val();
                        var name = $(this).attr('id');
                        @this.set(name, data);
                    });

                });


            })

        }

        $(document).ready(function () {
            select2init();
        });
        document.addEventListener('refreshSelect2', () => {
            select2init();
        });

    </script>

@endpush
