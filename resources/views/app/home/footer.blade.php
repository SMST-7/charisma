{{--<!-- Footer -->--}}
<footer class="bb-footer mt-[50px] max-[1199px]:mt-[35px] bg-[#f8f8fb] text-[#fff]">
    <div class="footer-container border-t-[1px] border-solid border-[#eee]">
        <div class="footer-top py-[50px] max-[1199px]:py-[35px]">
            <div class="flex flex-wrap justify-between relative items-center mx-auto
                        min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px]
                        min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">

                <div class="flex flex-wrap w-full max-[991px]:mb-[-30px]" data-aos="fade-up"
                     data-aos-duration="1000" data-aos-delay="200">

                    {{-- لوگو و توضیحات فروشگاه --}}
                    @if(!empty($setting->logo) || !empty($footer->description))
                        <div class="min-[992px]:w-[25%] max-[991px]:w-full w-full px-[12px] bb-footer-toggle bb-footer-cat">
                            <div class="bb-footer-widget bb-footer-company flex flex-col max-[991px]:mb-[24px]">
                                @if(!empty($setting->logo))
                                    <div class="bb-footer-logo-wrapper mb-[30px] flex justify-center md:justify-start">
                                        <img src="{{ asset($setting->logo) }}" alt="footer logo"
                                             class="bb-footer-logo max-w-[144px] w-full h-auto rounded-md shadow-sm transition-transform duration-300 hover:scale-105 object-contain"
                                             loading="lazy">
                                    </div>
                                @endif
                                @if(!empty($footer->description))
                                    <p class="bb-footer-detail text-[#686e7d] text-[14px] leading-[27px]">
                                        {{ $footer->description }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- دسته‌بندی‌های اصلی در فوتر - فقط ۵ تای اول والد --}}
                    @if($categories->where('parent_id', null)->count())
                        <div class="min-[992px]:w-[16.66%] max-[991px]:w-full w-full px-[12px] bb-footer-toggle bb-footer-info">
                            <div class="bb-footer-widget">
                                <h4 class="bb-footer-heading text-[18px] font-bold mb-[20px] text-[#3d4750] pb-[15px] border-b border-[#eee] capitalize max-[991px]:text-[16px]">
                                    دسته‌بندی محصولات
                                </h4>

                                <div class="bb-footer-links bb-footer-dropdown hidden max-[991px]:mb-[35px]">
                                    <ul class="space-y-3">
                                        @foreach($categories->where('parent_id', null)->take(5) as $category)
                                            <li class="bb-footer-link">
                                                <a href="{{ url('/category/' . $category->slug) }}"
                                                   class="text-[#686e7d] hover:text-[#6c7fd8] transition-colors duration-200">
                                                    {{ $category->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif


                    {{-- فروشگاه --}}
                    <div class="min-[992px]:w-[16.66%] max-[991px]:w-full w-full px-[12px] bb-footer-toggle bb-footer-account">
                        <div class="bb-footer-widget">
                            <h4 class="bb-footer-heading leading-[1.2] text-[18px] font-bold mb-[20px] text-[#3d4750] relative block w-full pb-[15px] capitalize border-b-[1px] border-solid border-[#eee] max-[991px]:text-[14px]">
                                فروشگاه
                            </h4>
                            <div class="bb-footer-links bb-footer-dropdown hidden max-[991px]:mb-[35px]">
                                <ul class="align-items-center">
                                    <li class="bb-footer-link leading-[1.5] flex items-center mb-[16px] max-[991px]:mb-[15px]">
                                        <a href="{{ route('about.index') }}" class="transition-all duration-[0.3s] ease-in-out text-[14px] leading-[20px] text-[#686e7d] hover:text-[#6c7fd8] mb-[0] inline-block break-all font-normal">
                                            درباره ما
                                        </a>
                                    </li>
                                    <li class="bb-footer-link leading-[1.5] flex items-center mb-[16px] max-[991px]:mb-[15px]">
                                        <a href="{{ route('app.blogs.index') }}" class="transition-all duration-[0.3s] ease-in-out text-[14px] leading-[20px] text-[#686e7d] hover:text-[#6c7fd8] mb-[0] inline-block break-all font-normal">
                                            مقالات
                                        </a>
                                    </li>
                                    <li class="bb-footer-link leading-[1.5] flex items-center mb-[16px] max-[991px]:mb-[15px]">
                                        <a href="{{ route('create-contact') }}" class="transition-all duration-[0.3s] ease-in-out text-[14px] leading-[20px] text-[#686e7d] hover:text-[#6c7fd8] mb-[0] inline-block break-all font-normal">
                                            تماس با ما
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- حساب کاربری --}}
                    <div class="min-[992px]:w-[16.66%] max-[991px]:w-full w-full px-[12px] bb-footer-toggle bb-footer-service">
                        <div class="bb-footer-widget">
                            <h4 class="bb-footer-heading leading-[1.2] text-[18px] font-bold mb-[20px] text-[#3d4750] relative block w-full pb-[15px] capitalize border-b-[1px] border-solid border-[#eee] max-[991px]:text-[14px]">
                                حساب کاربری
                            </h4>
                            <div class="bb-footer-links bb-footer-dropdown hidden max-[991px]:mb-[35px]">
                                <ul class="align-items-center">
                                    @guest
                                        <li class="bb-footer-link leading-[1.5] flex items-center mb-[16px] max-[991px]:mb-[15px]">
                                            <a href="{{ route('user.login') }}" class="transition-all duration-[0.3s] ease-in-out text-[14px] leading-[20px] text-[#686e7d] hover:text-[#6c7fd8]">
                                                ورود
                                            </a>
                                        </li>
                                        <li class="bb-footer-link leading-[1.5] flex items-center mb-[16px] max-[991px]:mb-[15px]">
                                            <a href="{{ route('user.register') }}" class="transition-all duration-[0.3s] ease-in-out text-[14px] leading-[20px] text-[#686e7d] hover:text-[#6c7fd8]">
                                                ثبت نام
                                            </a>
                                        </li>
                                    @endguest
                                    @auth
                                        <li class="bb-footer-link leading-[1.5] flex items-center mb-[16px] max-[991px]:mb-[15px]">
                                            <a href="{{ route('user.profile') }}" class="transition-all duration-[0.3s] ease-in-out text-[14px] leading-[20px] text-[#686e7d] hover:text-[#6c7fd8]">
                                                پروفایل من
                                            </a>
                                        </li>
                                        <li class="bb-footer-link leading-[1.5] flex items-center mb-[16px] max-[991px]:mb-[15px]">
                                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="transition-all duration-[0.3s] ease-in-out text-[14px] leading-[20px] text-[#686e7d] hover:text-[#6c7fd8]">
                                                    خروج
                                                </button>
                                            </form>
                                        </li>
                                    @endauth
                                    <li class="bb-footer-link leading-[1.5] flex items-center mb-[16px] max-[991px]:mb-[15px]">
                                        <a href="{{ route('cart.index') }}" class="transition-all duration-[0.3s] ease-in-out text-[14px] leading-[20px] text-[#686e7d] hover:text-[#6c7fd8]">
                                            مشاهده سبد خرید
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- تماس و شبکه‌های اجتماعی --}}
                    @if(!empty($footer->address) || !empty($footer->phone) || !empty($footer->phone2) || !empty($footer->email) || !empty($footer->instagram) || !empty($footer->telegram))
                        <div class="min-[992px]:w-[25%] max-[991px]:w-full w-full px-[12px] bb-footer-toggle bb-footer-cont-social">
                            <div class="bb-footer-contact mb-[30px]">
                                <div class="bb-footer-widget">
                                    <h4 class="bb-footer-heading leading-[1.2] text-[18px] font-bold mb-[20px] text-[#3d4750] relative block w-full pb-[15px] capitalize border-b-[1px] border-solid border-[#eee] max-[991px]:text-[14px]">
                                        تماس
                                    </h4>
                                    <div class="bb-footer-links bb-footer-dropdown hidden max-[991px]:mb-[35px]">
                                        <ul class="align-items-center">
                                            @if(!empty($footer->address))
                                                <li class="bb-footer-link bb-foo-location flex items-start mb-[16px]">
                                                    <span class="mt-[5px] w-[25px]"><i class="ri-map-pin-line text-[18px] text-[#6c7fd8]"></i></span>
                                                    <p class="text-[14px] text-[#686e7d] font-normal">{{ $footer->address }}</p>
                                                </li>
                                            @endif
                                            @if(!empty($footer->phone) || !empty($footer->phone2))
                                                <li class="bb-footer-link bb-foo-call flex items-start mb-[16px]">
                                                    <span class="w-[25px]"><i class="ri-whatsapp-line text-[18px] text-[#6c7fd8]"></i></span>
                                                    <a href="tel:{{ $footer->phone }}" class="text-[14px] text-[#686e7d] hover:text-[#6c7fd8]">{{ $footer->phone }}</a>

                                                    @if(!empty($footer->phone) && !empty($footer->phone2))
                                                        <span class="text-[14px] text-[#686e7d] mx-2">_</span> <!-- خط فاصله بین شماره ها -->
                                                    @endif
                                                    <a href="tel:{{ $footer->phone2 }}" class="text-[14px] text-[#686e7d] hover:text-[#6c7fd8]">{{ $footer->phone2 }}</a>
                                                </li>
                                            @endif
                                            @if(!empty($footer->email))
                                                <li class="bb-footer-link bb-foo-mail flex">
                                                    <span class="w-[25px]"><i class="ri-mail-line text-[18px] text-[#6c7fd8]"></i></span>
                                                    <a href="mailto:{{ $footer->email }}" class="text-[14px] text-[#686e7d] hover:text-[#6c7fd8]">{{ $footer->email }}</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            {{-- شبکه‌های اجتماعی --}}
                            @if(!empty($footer->instagram) || !empty($footer->telegram))
                                <div class="bb-footer-social">
                                    <div class="bb-footer-widget">
                                        <div class="bb-footer-links bb-footer-dropdown hidden max-[991px]:mb-[35px]">
                                            <ul class="flex flex-wrap items-center">
                                                @if(!empty($footer->instagram))
                                                    <li class="pr-[5px]">
                                                        <a href="{{ $footer->instagram }}" target="_blank" class="transition-all duration-[0.3s] ease-in-out w-[30px] h-[30px] rounded-[5px] bg-[#3d4750] hover:bg-[#6c7fd8] flex items-center justify-center">
                                                            <i class="ri-instagram-line text-[16px] text-[#fff]"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if(!empty($footer->telegram))
                                                    <li class="pr-[5px]">
                                                        <a href="{{ $footer->telegram }}" target="_blank" class="transition-all duration-[0.3s] ease-in-out w-[30px] h-[30px] rounded-[5px] bg-[#3d4750] hover:bg-[#6c7fd8] flex items-center justify-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240" class="w-5 h-5 fill-white">
                                                                <path d="M120 0C53.7 0 0 53.7 0 120s53.7 120 120 120 120-53.7 120-120S186.3 0 120 0zm58.9 78.7l-18.7 88.6c-1.4 6.3-5.1 7.8-10.3 4.9l-28.4-20.9-13.7 13.2c-1.5 1.5-2.7 2.7-5.5 2.7l2-27.3 49.7-44.8c2.2-1.9-.5-3-3.3-1.1l-61.3 38.6-26.5-8.3c-5.7-1.8-5.8-5.7 1.2-8.4l103.3-39.8c4.7-1.7 8.9 1.1 7.9 8z"/>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                @endif

                                                    @if(!empty($footer->eitaa))
                                                        <li class="pr-[5px]">
                                                            <a href="{{ $footer->eitaa }}" target="_blank"
                                                               class="transition-all duration-[0.3s] ease-in-out w-[30px] h-[30px] rounded-[5px]
              bg-[#3d4750] hover:bg-[#6c7fd8] flex items-center justify-center">

                                                                <!-- لوگوی محلی ایتا با رنگ سفید اجباری -->
                                                                <img src="{{ asset('app/img/Eitaa.svg') }}"
                                                                     alt="Eitaa"
                                                                     class="w-5 h-5 brightness-0 invert">
                                                            </a>
                                                        </li>
                                                    @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    @endif

                </div>
            </div>
        </div>

        {{-- فوتر پایین --}}
        <div class="footer-bottom py-[10px] border-t-[1px] border-solid border-[#eee] max-[991px]:py-[15px]">
            <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
                <div class="flex flex-wrap w-full">
                    <div class="bb-bottom-info w-full flex flex-row items-center justify-between max-[991px]:flex-col px-[12px]">
                        <div class="footer-copy max-[991px]:mb-[15px]">
                            <div class="footer-bottom-copy max-[991px]:text-center">
                                <div class="bb-copy text-[#686e7d] text-[13px] text-center font-normal leading-[2]">
                                    Copyright © <span id="copyright_year"></span>
                                    <a class="site-name transition-all duration-[0.3s] ease-in-out font-medium text-[#6c7fd8] hover:text-[#3d4750] text-[15px]" href="{{ url('/') }}">
                                        کاریزما
                                    </a> تمام حقوق محفوظ است
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</footer>


<!-- Back to top  -->
<a href="index-2.html#Top"
   class="back-to-top result-placeholder transition-all duration-[0.3s] ease-in-out w-[38px] h-[38px] hidden fixed left-[15px] bottom-[15px] z-[10] rounded-[20px] cursor-pointer bg-[#fff] text-[#6c7fd8] border-[1px] border-solid border-[#6c7fd8] text-center text-[22px] leading-[1.6]">
    <i class="ri-arrow-up-line text-[20px]"></i>
    <div class="back-to-top-wrap active-progress">
        <svg viewBox="-1 -1 102 102" class="w-[36px] h-[36px] fixed left-[16px] bottom-[16px]">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                  class="fill-transparent stroke-[5px] stroke-[#6c7fd8]"></path>
        </svg>
    </div>
</a>

<!-- Plugins -->
<script src="{{ asset('app/js/vendor/jquery.min.js')}}"></script>
<script src="{{ asset('app/js/vendor/jquery.zoom.min.js')}}"></script>
<script src="{{ asset('app/js/vendor/aos.js')}}"></script>
<script src="{{ asset('app/js/vendor/swiper-bundle.min.js')}}"></script>
<script src="{{ asset('app/js/vendor/smoothscroll.min.js')}}"></script>
{{--<script src="{{ asset('app/js/vendor/countdownTimer.js')}}"></script>--}}
<script src="{{ asset('app/js/vendor/owl.carousel.min.js')}}"></script>
<script src="{{ asset('app/js/vendor/slick.min.js')}}"></script>
<script src="{{ asset('app/js/vendor/jquery-range-ui.min.js')}}"></script>

<script src="{{ asset('app/js/vendor/bootstrap.bundle.min.js') }}"></script>

<!-- main-js -->
<script src="{{ asset('app/js/main.js')}}"></script>
</body>
</html>
