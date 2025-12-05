@extends('app.home.master')
@section('title','درباره ما')

@section('content')

    <section class="section-about py-[50px] max-[1199px]:py-[35px]">
        <div
            class="flex flex-wrap justify-between items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full mb-[-24px]">
                <div class="min-[992px]:w-[50%] w-full px-[12px] mb-[24px]">
                    <div class="relative group max-w-[600px] mx-auto rounded-2xl overflow-hidden shadow-xl">
                        <img src="{{ asset('panel/pictures/' . $about->image) }}"
                             alt="about-one"
                             class="w-full h-[400px] object-cover transition-transform duration-500 group-hover:scale-105">

                        <!-- لایه شفاف برای جلوه -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent opacity-70 group-hover:opacity-50 transition duration-500"></div>
                    </div>

                </div>
                <div class="min-[992px]:w-[50%] w-full mb-[24px]">
                    <div class="bb-about-contact h-full flex flex-col justify-center">
                        <div class="section-title pb-[12px] px-[12px] flex justify-start max-[991px]:flex-col max-[991px]:justify-center max-[991px]:text-center"
                             data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                            <div class="section-detail max-[991px]:mb-[12px]">
                                <h1
                                    class="bb-title font-Dana  mb-[0] p-[0] text-[25px] font-bold text-[#3d4750] inline capitalize leading-[1] max-[767px]:text-[23px]">
                                    {{ $about->title }}</h1>
                            </div>
                        </div>

                        <div class="about-inner-contact px-3 mb-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                            <div class="prose prose-lg prose-gray max-w-none text-justify">
                                {!! nl2br(e($about->description)) !!}
                            </div>
                        </div>

                        {{--                        <div class="about-inner-contact px-[12px] mb-[14px]" data-aos="fade-up" data-aos-duration="1000"--}}
{{--                             data-aos-delay="400">--}}
{{--                              <h6>{!! nl2br(e($about->description)) !!}</h6>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
