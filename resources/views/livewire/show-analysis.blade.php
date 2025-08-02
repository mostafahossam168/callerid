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
            @include('lab.requests.forms.' . $analysis->form)
        </div>
    </section>
</div>
