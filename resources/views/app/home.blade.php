@extends('app.home.master')
@section('title','فروشگاه تجهیزات پزشکی کاریزما')

@section('content')

    <!-- Hero Section -->
    <section class="relative bg-[#f8f8fb] overflow-hidden" dir="rtl">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">

                @foreach($banners as $key => $banner)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <div class="relative w-full h-[500px] sm:h-[400px] lg:h-[650px]">

                            <!-- تصویر پس‌زمینه -->
                            <img src="{{ asset('panel/banner/' . $banner->image) }}"
                                 alt="banner"
                                 class="absolute inset-0 w-full h-full object-cover object-center">

                            <!-- گرادیان تیره -->
                            <div class="absolute inset-0 bg-gradient-to-l from-[#00000090] to-[#00000040]"></div>

                            <!-- متن بنر - کاملاً راست‌چین و وسط عمودی + فاصله از لبه -->
                            <div class="absolute inset-0 z-10 flex flex-col justify-center pe-24 ps-8 text-white text-right max-w-4xl ms-auto">
                                <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-extrabold leading-tight mb-4 drop-shadow-2xl">
                                    {{ $banner->title }}
                                </h1>
                                <p class="text-lg sm:text-xl lg:text-2xl mb-8 drop-shadow-lg opacity-90">
                                    بهترین انتخاب برای شما
                                </p>
                                <a href="{{ $banner->link }}"
                                   class="inline-block py-4 px-12 text-lg font-semibold bg-[#6c7fd8] rounded-xl shadow-xl transition-all duration-300 hover:bg-[#5a6cc7] hover:scale-105 self-start">
                                    خرید کنید
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>

            <!-- کنترل‌های راست و چپ (دور از متن) -->
            <button class="carousel-control-prev !left-4" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon !bg-white/70" aria-hidden="true"></span>
                <span class="visually-hidden">قبلی</span>
            </button>
            <button class="carousel-control-next !right-4" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon !bg-white/70" aria-hidden="true"></span>
                <span class="visually-hidden">بعدی</span>
            </button>

            <!-- دات‌ها - دقیقاً وسط پایین -->
            <div class="carousel-indicators !bottom-6 !left-1/2 !-translate-x-1/2 !m-0">
                @foreach($banners as $key => $banner)
                    <button type="button"
                            data-bs-target="#heroCarousel"
                            data-bs-slide-to="{{ $key }}"
                            class="{{ $key == 0 ? 'active' : '' }} w-3 h-3 rounded-full bg-white/60 !mx-1"
                            aria-current="{{ $key == 0 ? 'true' : 'false' }}"></button>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        /* راست‌چین کردن محتوای اسلایدر */
        #heroCarousel .carousel-inner {
            direction: rtl;
        }

        /* آیکون‌های کنترل بزرگ‌تر و شفاف */
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 50px !important;
            height: 50px !important;
            background-size: 60% !important;
            border-radius: 50%;
            transition: all 0.3s;
        }

        .carousel-control-prev-icon:hover,
        .carousel-control-next-icon:hover {
            background-color: rgba(255,255,255,0.9) !important;
        }

        /* دات‌های فعال آبی */
        .carousel-indicators .active {
            background-color: #6c7fd8 !important;
            opacity: 1;
        }

        /* در موبایل: دکمه‌ها کمی بالاتر و دات‌ها نزدیک‌تر */
        @media (max-width: 640px) {
            .carousel-control-prev { left: 8px !important; }
            .carousel-control-next { right: 8px !important; }
            .carousel-indicators { bottom: 12px !important; }
            .pe-24 { padding-right: 4rem !important; }
        }
    </style>


    <!-- Category -->
    <section class="section-category overflow-hidden py-[50px] max-[1199px]:py-[35px]">
        <div
            class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full mb-[-24px]">
                <div class="min-[992px]:w-[41.66%] w-full px-[12px] mb-[24px]">
                    <div class="bb-category-img relative max-[991px]:hidden">
                        <img src="{{asset('app\img\mainimage.jpg')}}" alt="category" class="w-full rounded-[30px]">
                    </div>
                </div>
                <div class="min-[992px]:w-[58.33%] w-full px-[12px] mb-[24px]">
                    <div class="bb-category-contact max-[991px]:mt-[-24px]">
                        <div class="category-title mb-[30px] max-[991px]:hidden" data-aos="fade-up"
                             data-aos-duration="1000" data-aos-delay="600">
                            <h2
                                class=" text-[124px] opacity-[0.15] font-bold leading-[1.2]  max-[1399px]:text-[95px] max-[1199px]:text-[70px] max-[767px]:text-[42px]">
                                محصولات <br>با کیفیت بالا </h2>
                        </div>


                            <div class="bb-category-block owl-carousel ml-[-150px] w-[calc(100%+150px)] pt-[30px] pl-[30px] bg-[#fff] rounded-tl-[30px] relative max-[991px]:ml-[0] max-[991px]:w-full max-[991px]:p-[0]">

                                @foreach($categories as $category)
                                    <div class="bb-category-box p-[30px] rounded-[20px] flex flex-col items-center text-center max-[1399px]:p-[20px] category-items-1 bg-[#fef1f1]"
                                         data-aos="flip-left" data-aos-duration="1000" data-aos-delay="200">

                                        <div class="category-image mb-[12px]">
                                            <a href="{{route('app.category.show',$category->slug)}}" class="text-[16px] font-medium leading-[1.2] text-[#3d4750] capitalize">
                                            <img src="{{ asset('panel/pictures/'.$category->image)}}" alt="category"
                                                 class="rounded w-[50px] h-[50px] max-[1399px]:h-[65px] max-[1399px]:w-[65px] max-[1199px]:h-[50px] max-[1199px]:w-[50px]">
                                            </a>
                                        </div>

                                        <div class="category-sub-contact">
                                            <h5 class="mb-[2px] text-[16px] text-[#3d4750] font-semibold leading-[1.2]">
                                                <a href="{{route('app.category.show',$category->slug)}}"
                                                   class="text-[16px] font-medium leading-[1.2] text-[#3d4750] capitalize">
                                                    {{ $category->title }}
                                                </a>
                                            </h5>
                                            <p class="dir-rtl text-[13px] text-[#686e7d] leading-[25px] font-light">
                                                {{ $category->products->count() }} محصول
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- محصولات پیشنهادی - کاملاً هماهنگ با بخش محصولات جدید -->
    <section class="section-product-tabs overflow-hidden py-[70px] max-[1199px]:py-[50px] bg-gradient-to-b from-gray-50 to-white">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">

            <!-- عنوان بخش + لیبل پیشنهاد ویژه (دقیقاً مثل بخش بالایی) -->
            <div class="w-full px-[12px]">
                <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="1000">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight">
                        محصولات
                        <span class="text-[#6c7fd8]">پیشنهادی</span>
                    </h2>

                    <!-- لیبل پیشنهاد ویژه - دقیقاً مثل بخش محصولات جدید -->
                    <div class="mt-4 inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-[#6c7fd8] to-purple-600 text-white font-medium rounded-full shadow-lg shadow-purple-500/30">
                        <span class="text-sm md:text-base">تخفیف ویژه</span>
                    </div>
                </div>
            </div>

            <!-- اسلایدر محصولات پیشنهادی (بدون تغییر در کارت‌ها - فقط ساختار کلی هماهنگ شد) -->
            <div class="w-full px-[12px]">
                <div class="bb-deal-slider m-[-12px]">
                    <div class="bb-deal-block owl-carousel">
                        @foreach($discountedProducts as $product)
                            <div class="bb-deal-card p-[12px]" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                                <div class="bb-pro-box bg-white border border-gray-200 rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">

                                    <!-- تصویر + تخفیف + اکشن‌ها -->
                                    <div class="bb-pro-img relative group">
                                        <!-- برچسب تخفیف -->
                                        <span class="absolute top-3 right-3 z-10 bg-red-500 text-white text-sm font-bold px-3 py-1.5 rounded-lg shadow-md">
                                        % {{ intval($product->discount_percentage) }}
                                تخفیف  
                                            

                                    </span>

                                        <a href="{{ route('offer.show', $product->slug) }}">
                                            <div class="inner-img relative overflow-hidden h-[280px] bg-gray-100">
                                                @if($product->images->count())
                                                    <div id="carousel{{ $product->id }}" class="carousel slide h-full" data-bs-ride="carousel">
                                                        <div class="carousel-inner h-full">
                                                            @foreach($product->images as $key => $image)
                                                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }} h-full">
                                                                    <img src="{{ asset($image->image_path) }}"
                                                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                                                         alt="{{ $product->name }}">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @else
                                                    <img src="{{ asset('panel/pictures/no-image.png') }}"
                                                         class="w-full h-full object-cover"
                                                         alt="{{ $product->name }}">
                                                @endif
                                            </div>
                                        </a>

                                        <!-- دکمه‌های هاور -->
                                        <ul class="bb-pro-actions absolute inset-x-0 bottom-4 flex justify-center gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20">
                                            <!-- علاقه‌مندی، مشاهده، سبد خرید -->
                                            <!-- (کدهای قبلی شما بدون تغییر باقی می‌مونه) -->
                                        </ul>
                                    </div>

                                    <!-- محتوا -->
                                    <div class="p-6">
                                        <div class="flex justify-between items-center mb-3">
                                            <a href="{{ route('app.category.show', $product->category->slug ?? '#') }}"
                                               class="text-sm text-gray-500 hover:text-[#6c7fd8] transition">
                                                {{ $product->category->title ?? 'دسته‌بندی' }}
                                            </a>
                                            <div class="flex">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="{{ $i <= round($product->reviews_avg_rating ?? 0) ? 'ri-star-fill text-yellow-400' : 'ri-star-line text-gray-300' }} text-sm"></i>
                                                @endfor
                                            </div>
                                        </div>

                                        <h4 class="text-lg font-bold text-gray-800 line-clamp-2 mb-3 hover:text-[#6c7fd8] transition">
                                            <a href="{{ route('offer.show', $product->slug) }}">{{ $product->name }}</a>
                                        </h4>

                                        <div class="flex items-center justify-between">
                                            <div class="text-right">
                                                <span class="text-sm text-gray-500 line-through">{{ number_format($product->price) }} تومان</span>
                                                <div class="text-xl font-bold text-[#6c7fd8]">
                                                    {{ number_format($product->price - ($product->price * $product->discount_percentage / 100)) }} تومان
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- New Product tab Area -->

    <section class="section-product-tabs overflow-hidden py-[50px] max-[1199px]:py-[35px]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="section-title mb-[20px] pb-[20px] z-[5] relative flex justify-between max-[991px]:pb-[0] max-[991px]:flex-col max-[991px]:justify-center max-[991px]:text-center"
                         data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                        <div class="section-detail max-[991px]:mb-[12px]" style="margin-bottom: 35px;">
                            <h2
                                class="bb-title mb-[0] p-[0] text-[25px] font-bold text-[#3d4750] relative inline capitalize leading-[1] max-[767px]:text-[23px]">
                                محصولات <span class="text-[#6c7fd8]">جدید</span></h2>
                        </div>
                        <div class="bb-pro-tab">
                            <ul class="bb-pro-tab-nav flex flex-wrap mx-[-20px] max-[991px]:justify-center"
                                id="ProductTab">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div id="products-container" class="flex flex-wrap w-full mb-[-24px]">
                @include('app.partials.new-products')
            </div>

        </div>
    </section>




    <!-- New Blog Articles Section - نسخه نهایی و حرفه‌ای -->
    <section class="section-articles overflow-hidden py-[50px] max-[1199px]:py-[35px] bg-gray-50/30">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">

            <!-- عنوان بخش -->
            <div class="w-full px-[12px] mb-[40px]">
                <div class="text-center" data-aos="fade-up" data-aos-duration="1000">
                    <h2 class="bb-title inline-block text-[28px] lg:text-[32px] font-extrabold text-[#3d4750] relative pb-3 max-[767px]:text-[24px]">
                        مجلات <span class="text-[#6c7fd8]">پزشکی</span>
                        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-24 h-1 bg-gradient-to-r from-[#6c7fd8] to-purple-600 rounded-full"></span>
                    </h2>
                </div>
            </div>

            <!-- کارت‌های مقالات -->
            <div class="flex flex-wrap w-full -mx-[12px]">
                @forelse($blogs as $blog)
                    <div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 px-[12px] mb-[30px]" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <article class="bb-blog-card group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 border border-gray-100 h-full flex flex-col">

                            <!-- تصویر مقاله -->
                            <div class="relative overflow-hidden h-[220px]">
                                <a href="{{ route('blogs.singleBlog', $blog->slug) }}" class="block h-full">
                                    <img src="{{ asset('uploads/blogs/' . $blog->image) }}"
                                         alt="{{ $blog->title }}"
                                         loading="lazy"
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                </a>

                                <!-- افکت گرادیانت روی تصویر در هاور -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            </div>

                            <!-- محتوا -->
                            <div class="p-6 flex flex-col flex-grow">
                                <h3 class="mb-3">
                                    <a href="{{ route('blogs.singleBlog', $blog->slug) }}"
                                       class="text-[18px] leading-tight font-bold text-[#3d4750] line-clamp-2 group-hover:text-[#6c7fd8] transition-colors duration-300">
                                        {{ $blog->title }}
                                    </a>
                                </h3>

                                <p class="text-[14px] leading-6 text-[#686e7d] font-light flex-grow mb-5 line-clamp-3">
                                    {{ Str::limit(strip_tags($blog->content), 120) }}
                                </p>

                                <!-- دکمه ادامه -->
                                <div class="mt-auto">
                                    <a href="{{ route('blogs.singleBlog', $blog->slug) }}"
                                       class="inline-flex items-center gap-2 text-[#6c7fd8] font-medium text-[15px] hover:gap-3 transition-all duration-300 group/btn">
                                        ادامه مطلب
                                        <svg class="w-5 h-5 transition-transform group-hover/btn:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <p class="text-[#686e7d] text-lg">مقاله جدیدی منتشر نشده است.</p>
                    </div>
                @endforelse
            </div>

            <!-- صفحه‌بندی -->
            <div class="w-full px-[12px] mt-8">
                <div class="flex justify-center">
                    {{ $blogs->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>

    </section>

    <style>
        /* بهبود خط پایین عنوان */
        .bb-title span::after {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
            width: 90px;
            height: 4px;
            background: linear-gradient(90deg, #6c7fd8, #a78bfa);
            border-radius: 2px;
        }

        /* انیمیشن نرم برای کارت‌ها */
        .bb-blog-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>




    {{-- Services Section - نسخه ساده‌تر و زیباتر تصویر --}}
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($services as $index => $service)
                    @if($service->is_active)
                        <div class="group text-center" data-aos="zoom-in-up" data-aos-delay="{{ $index * 100 }}">
                            <div class="relative p-8 bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3">
                                <!-- پس‌زمینه گرادیان هنگام هاور -->
                                <div class="absolute inset-0 bg-gradient-to-br from-[#6c7fd8]/5 to-purple-600/5 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                                <!-- آیکون / تصویر ساده‌تر -->
                                <div class="relative mb-6 flex justify-center">
                                    @if($service->image)
                                        <img
                                            src="{{ asset('panel/pictures/'.$service->image) }}"
                                            alt="{{ $service->title }}"
                                            class="w-16 h-16 object-cover rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    @else
                                        <div class="w-16 h-16 bg-gradient-to-br from-[#6c7fd8] to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <h4 class="text-xl font-bold text-gray-800 group-hover:text-[#6c7fd8] transition-colors duration-300">
                                    {{ $service->title }}
                                </h4>
                                <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                                    {{ Str::limit($service->description, 80) }}
                                </p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>





    <!-- Category Popup -->
    <div class="bb-category-sidebar transition-all duration-[0.3s] ease-in-out w-full h-full fixed top-[0] z-[17] hidden">
        <div class="bb-category-overlay hidden w-full h-screen fixed top-[0] left-[0] bg-[#00000080] z-[17]"></div>
        <div
            class="category-sidebar w-[calc(100%-30px)] max-[1199px]:h-[calc(100vh-60px)] max-w-[1200px] my-[15px] mx-[auto] py-[30px] px-[15px] text-[14px] font-normal transition-all duration-[0.5s] ease-in-out delay-[0s] bg-[#fff] overflow-auto rounded-[30px] z-[18] relative">
            <button type="button"
                    class="bb-category-close transition-all duration-[0.3s] ease-in-out w-[16px] h-[20px] absolute top-[-5px] right-[27px] bg-[#e04e4eb3] rounded-[10px] cursor-pointer hover:bg-[#e04e4e]"
                    title="Close"></button>
            <div class="w-full mx-auto">
                <div class="flex flex-wrap w-full mb-[-24px]">
                    <div class="w-full px-[12px]">
                        <div class="bb-category-tags mb-[24px]">
                            <div class="w-full">
                                <div class="flex flex-wrap w-full">
                                    <div class="w-full px-[12px]">
                                        <div class="sub-title mb-[20px] flex justify-between">
                                            <h4
                                                class="  leading-[1.2] text-[20px] font-bold text-[#3d4750] capitalize">
                                                کاوش دسته ها</h4>
                                        </div>
                                    </div>
                                    @forelse($categories as $category)
                                        <div
                                            class="min-[1200px]:w-[16.66%] min-[768px]:w-[33.33%] min-[576px]:w-[50%] w-full px-[12px] mb-[24px]">
                                            <div
                                                class="bb-category-box p-[30px] rounded-[20px] flex flex-col items-center text-center max-[1399px]:p-[20px] category-items-1 bg-[#fef1f1]">
                                                <div class="category-image mb-[12px]">
                                                    <img src="{{ asset('panel/pictures/'.$category->image)}}" alt="category"
                                                         class="w-[50px] h-[50px] max-[1399px]:h-[65px] max-[1399px]:w-[65px] max-[1199px]:h-[50px] max-[1199px]:w-[50px]">
                                                </div>
                                                <div class="category-sub-contact">
                                                    <h5
                                                        class="mb-[2px] text-[16px]  text-[#3d4750] font-semibold  leading-[1.2]">
                                                        <a href="{{route('app.category.show',$category->slug)}}"
                                                           class=" text-[16px] font-medium leading-[1.2]  text-[#3d4750] capitalize">{{$category->title}}</a>
                                                    </h5>
                                                    <p
                                                        class=" text-[13px] text-[#686e7d] leading-[25px] font-light  dir-rtl">
                                                        {{$category->products->count()}} محصول</p>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <span>دسته بندی وجود ندارد</span>
                                    @endforelse

                                </div>
                            </div>
                            <div class="w-full">
                                <div class="flex flex-wrap w-full">
                                    <div class="w-full px-[12px]">
                                        <div class="sub-title mb-[20px] flex justify-between">
                                            <h4
                                                class="  leading-[1.2] text-[20px] font-bold text-[#3d4750] capitalize">
                                                محصولات اخیر</h4>
                                        </div>
                                    </div>
                                    @forelse($newProducts as $product)
                                        @php
                                            $discount =$product->discounts->first();
                                            $hasDiscount= $discount ? true : false;
                                        @endphp
                                        <div class="min-[992px]:w-[33.33%] min-[576px]:w-[50%] w-full px-[12px] mb-[24px]">
                                            <div
                                                class="bb-category-cart p-[15px] overflow-hidden bg-[#f8f8fb] border-[1px] border-solid border-[#eee] rounded-[10px] flex max-[767px]:flex-col">
                                                @forelse($product->images as $key => $image)
                                                    <a href="javascript:void(0)"
                                                       class="pro-img mr-[12px] max-[767px]:mb-[15px] max-[767px]:mr-[0]">
                                                        <img src="{{asset($image->image_path)}}" alt="{{$product->name}}"
                                                             class="w-[80px] rounded-[10px] border-[1px] border-solid border-[#eee] max-[767px]:w-full">
                                                    </a>
                                                @empty
                                                    <span></span>
                                                @endforelse
                                                <div class="side-contact flex flex-col">
                                                    <h4 class="bb-pro-title text-[15px]">
                                                        <a href="{{route('offer.show',$product->slug)}}"
                                                           class="transition-all duration-[0.3s] ease-in-out flex  text-[15px]  font-medium text-[#3d4750]">{{$product->name}}</a>
                                                    </h4>
                                                    <span class="bb-pro-rating">
                                            @php $average = round($product->reviews_avg_rating ?? 0); @endphp
                                                        @for($i=0; $i<5; $i++)
                                                            <i
                                                                class="{{$i< $average ? 'ri-star-fill text-[#fea99a]' : 'ri-star-fill text-[#777]'}} text-[15px] mr-[3px] leading-[26px]"></i>
                                                        @endfor
                                        </span>
                                                    <div class="inner-price mx-[-3px] dir-rtl">
                                                        @if($hasDiscount && $product->discount_percentage)
                                                            <span
                                                                class="old-price px-[3px] text-[14px] text-[#686e7d] line-through">{{number_format($product->price)}} تومان</span>
                                                            <span
                                                                class="new-price px-[3px] text-[15px] text-[#686e7d] font-semibold">
                                                {{number_format($product->price - ($product->price * $product->discount_percentage / 100))}}تومان
                                            </span>
                                                        @else
                                                            <span
                                                                class="new-price px-[3px] text-[15px] text-[#686e7d] font-semibold">{{number_format($product->price)}} تومان</span>

                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <span>محصول جدید نداریم</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--    <script>--}}
{{--        document.addEventListener('DOMContentLoaded', function() {--}}
{{--            const tabs = document.querySelectorAll('#ProductTab .nav-link');--}}
{{--            const container = document.getElementById('products-container');--}}

{{--            tabs.forEach(tab => {--}}
{{--                tab.addEventListener('click', function(e) {--}}
{{--                    e.preventDefault();--}}
{{--                    tabs.forEach(t => t.classList.remove('active'));--}}
{{--                    this.classList.add('active');--}}
{{--                    const slug = this.dataset.slug;--}}
{{--                    fetch(`/get-products?category=${slug}`)--}}
{{--                        .then(response => response.text())--}}
{{--                        .then(html => {--}}
{{--                            container.innerHTML = html;--}}
{{--                        })--}}
{{--                        .catch(error => console.error('Error:', error));--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection
