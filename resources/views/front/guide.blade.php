@extends('front.layouts.front')
@section('title')
{{ __('admin.Users Manual') }}
@endsection
@section('content')
<section class="main-section section-guide">
    <div class="container">
        <div class="d-flex align-items-center gap-2 felx-wrap mb-3">
            <h4 class="main-heading mb-0">{{ __('admin.Users Manual') }}</h4>
            <div class="d-flex align-items-center gap-1 mx-auto">
                <a href="{{ route('front.program-update') }}" class="btn btn-info">
                    {{ __('admin.Software updates') }}
                </a>
                <a href="{{ route('front.guide') }}" class="btn btn-info">
                    {{ __('admin.Users Manual') }}
                </a>
            </div>
        </div>
        <div class="bg-white shadow p-4 rounded-3">
            <p>
                {{__('admin.Essay questions')}}
            </p>
            <div class="accordion mt-3" id="accordionExample">

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-video-1" aria-expanded="false">
                            {{__('admin.Explanation of the control panel')}}
                        </button>
                    </h2>
                    <div id="collapse-collapse-video-1" class="accordion-collapse show collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <iframe class="w-100" height="200" src="https://www.youtube.com/embed/LvfoFV2Xpp4"></iframe>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-video-1" aria-expanded="false">
                            {{__('admin.Explanation of the receptionists interface')}}
                        </button>
                    </h2>
                    <div id="collapse-collapse-video-1" class="accordion-collapse show collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <iframe class="w-100" height="200" src="https://www.youtube.com/embed/LvfoFV2Xpp4"></iframe>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-video-2" aria-expanded="false">
                            {{__('admin.Explanation of the doctors interface')}}
                        </button>
                    </h2>
                    <div id="collapse-collapse-video-2" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <iframe class="w-100" height="200" src="https://www.youtube.com/embed/KQmUCKWqYy4"></iframe>
                        </div>
                    </div>
                </div>
                @foreach( $questions as $question )
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$question->id}}" aria-expanded="false">
                            {{ $question->title }}
                        </button>
                    </h2>
                    <div id="collapse-{{$question->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            {!! $question->answers[0] !!}
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-video-1" aria-expanded="false">
                            شرح طريقة المختبر
                        </button>
                    </h2>
                    <div id="collapse-collapse-video-1" class="accordion-collapse show collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul class="p-3">
                                <li class="p-1">
                                    الخطوة الأولى : يتم تحويل المريض للطبيب الذى بدوره يقوم بالتشخيص وعمل فاتورة بالخدمة أو الخدمات ويقوم بالحفظ وانهاء الجلسة
                                </li>
                                <li class="p-1">
                                    الخطوة الثانية : يظهر الطلب للأدمن او الاستقبال من خلال تابة تسديد زيارة
                                </li>
                                <li class="p-1">
                                    الخطوة الثالثة : بعد التسديد يظهر الطلب لفنى المختبر الذى يقوم باختيار نموذج تحليل من 4 نماذج موجودة ويضع النتائج بالنموذج ويقوم بالحفظ ومن ثم تعرض عند الأدمن وفى بروفايل المريض أيضا
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
@endsection
