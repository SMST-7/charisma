@extends('app.home.master')
@section('title','ارتباط با ما')

@section('content')


    <section class="section-contact py-[50px] max-[1199px]:py-[35px]">
        <div class="w-full max-w-[600px] mx-auto px-[12px]">


            <!-- Alerts -->
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-50 text-green-700 text-xs rounded-xl text-center animate-fade shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-3 bg-red-50 text-red-700 text-xs rounded-xl text-center animate-fade shadow-sm">
                    {{ session('error') }}
                </div>
        @endif
            <!-- عنوان -->
            <div class="text-center mb-[30px]" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <h2 class="font-Dana text-[25px] font-bold text-[#3d4750] leading-[1] relative inline-block max-[767px]:text-[23px]">
                    با ما <span class="text-[#6c7fd8]">در ارتباط باشید</span>
                </h2>
                <p class="font-Poppins max-w-[400px] mx-auto mt-[10px] text-[14px] text-[#686e7d] leading-[22px] font-light">
                    اگر آنچه را که نیاز دارید پیدا نکردید، فرم تماس با ما را پر کنید.
                </p>
            </div>

            <!-- فرم -->
            <div class="bb-contact-form border border-[#eee] rounded-[20px] p-[30px] shadow-sm bg-white">
                <form method="post" action="{{ route('submit-contact') }}">

                    @csrf
                    <!-- نام -->
                    <div class="mb-[20px]">
                        <label class="block mb-[6px] text-[14px] font-medium text-[#3d4750]">
                            نام و نام خانوادگی <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="fname" value="{{ old('fname') }}"
                               class="w-full h-[50px] px-[15px] border border-[#ddd] rounded-[10px] text-[14px] text-[#3d4750]
                               focus:outline-none focus:border-[#6c7fd8] focus:ring-2 focus:ring-[#6c7fd8]/30 transition"
                               >
                        @error('fname')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- شماره -->
                    <div class="mb-[20px]">
                        <label class="block mb-[6px] text-[14px] font-medium text-[#3d4750]">
                            شماره همراه <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               class="w-full h-[50px] px-[15px] border border-[#ddd] rounded-[10px] text-[14px] text-[#3d4750]
                               focus:outline-none focus:border-[#6c7fd8] focus:ring-2 focus:ring-[#6c7fd8]/30 transition"
                               >
                        @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- پیام -->
                    <div class="mb-[20px]">
                        <label class="block mb-[6px] text-[14px] font-medium text-[#3d4750]">
                            پیام <span class="text-red-500">*</span>
                        </label>
                        <textarea name="message" rows="5"
                                  class="w-full px-[15px] py-[10px] border border-[#ddd] rounded-[10px] text-[14px] text-[#3d4750]
                                  focus:outline-none focus:border-[#6c7fd8] focus:ring-2 focus:ring-[#6c7fd8]/30 transition"
                                  >{{ old('message') }}</textarea>
                        @error('message')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- دکمه -->
                    <div class="text-center">
                        <button class="py-[12px] px-[40px] text-[14px] font-medium rounded-[10px]
                                       text-white bg-[#6c7fd8] border border-[#6c7fd8] transition
                                       hover:bg-transparent hover:text-[#3d4750] hover:border-[#3d4750]">
                            ارسال پیام
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </section>

    <script>
        // محو شدن پیام‌ها
        setTimeout(() => {
            document.querySelectorAll('.animate-fade').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(-10px)';
                setTimeout(() => el.remove(), 500);
            });
        }, 3000);
    </script>
@endsection
