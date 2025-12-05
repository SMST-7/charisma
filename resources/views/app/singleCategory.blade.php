@extends('app.home.master')
@section('title',' دسته بندی : '.$category->slug)
@section('content')

    <!-- Breadcrumb -->
    <section class="section-breadcrumb mb-[50px] max-[1199px]:mb-[35px] border-b-[1px] border-solid border-[#eee] bg-[#f8f8fb]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="flex flex-wrap w-full bb-breadcrumb-inner m-[0] py-[20px] items-center">
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <h2 class="bb-breadcrumb-title font-Dana  leading-[1.2] text-[16px] font-bold text-[#3d4750] max-[767px]:text-center max-[767px]:mb-[10px]">صفحه فروشگاه</h2>
                        </div>
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                                <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a href="{{route('home')}}" class="font-Poppins text-[14px]  font-semibold text-[#686e7d]">خانه</a></li>
                                <li class="text-[14px] font-normal px-[5px]"><i class="ri-arrow-left-double-fill text-[14px] font-semibold"></i></li>
                                <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] font-normal  px-[5px] active">صفحه فروشگاه</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Category section -->
    <section class="section-category pt-[50px] max-[1199px]:pt-[35px] mb-[24px]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="bb-category-6-colum owl-carousel">
                        @forelse($categories as $category)
                            <a href="{{ route('home.show', $category->slug) }}" class="bb-category-box p-[30px] rounded-[20px] flex flex-col items-center text-center max-[1399px]:p-[20px] category-items-1 bg-[#fef1f1] transition-all duration-300 hover:shadow-lg hover:scale-105" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="200">
                                <div class="category-image mb-[12px]">
                                    <img src="{{ asset('panel/pictures/'.$category->image) }}" alt="{{ $category->title }}" class="rounded w-[50px] h-[50px] max-[1399px]:h-[65px] max-[1399px]:w-[65px] max-[1199px]:h-[50px] max-[1199px]:w-[50px] object-cover">
                                </div>
                                <div class="category-sub-contact">
                                    <h5 class="mb-[2px] text-[16px] font-Dana text-[#3d4750] font-semibold leading-[1.2]">
                                        {{ $category->title }}
                                    </h5>
                                    <p class="font-Poppins text-[13px] text-[#686e7d] leading-[25px] font-light">
                                        {{ $category->products->count() }} مورد
                                    </p>
                                </div>
                            </a>
                        @empty
                            <p class="text-center w-full text-[#686e7d] font-medium py-[20px]">دسته‌بندی دیگری وجود ندارد</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Shop section -->
    <section class="section-shop pb-[50px] max-[1199px]:pb-[35px]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full px-[12px]">
                <div class="bb-shop-overlay hidden w-full h-screen fixed top-[0] left-[0] bg-[#000000cc] z-[17]"></div>
                <div class="w-full">
                    <div class="bb-shop-pro-inner">
                        <div class="flex flex-wrap mx-[-12px] mb-[-24px]">
                            <div class="w-full px-[12px]">
                                <div class="bb-pro-list-top mb-[24px] rounded-[20px] flex bg-[#f8f8fb] border-[1px] border-solid border-[#eee] justify-between">
                                    <div class="flex flex-wrap w-full">
                                        <div class="w-[50%] px-[12px] max-[420px]:w-full">
                                            <div class="bb-bl-btn py-[10px] flex max-[420px]:justify-center">
                                                <button type="button" class="grid-btn btn-grid-100 h-[38px] w-[38px] flex justify-center items-center border-[0] p-[5px] bg-transparent mr-[5px] active" title="grid">
                                                    <i class="ri-apps-line text-[20px]"></i>
                                                </button>
                                                <button type="button" class="grid-btn btn-list-100 h-[38px] w-[38px] flex justify-center items-center border-[0] p-[5px] bg-transparent" title="grid">
                                                    <i class="ri-list-unordered text-[20px]"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="w-[50%] px-[12px] max-[420px]:w-full">
                                            <div class="bb-select-inner h-full py-[10px] flex items-center justify-end max-[420px]:justify-center">
                                                <div class="custom-select w-[130px] mr-[30px] flex justify-end text-[#777]  items-center text-[14px] relative max-[420px]:w-[100px] max-[420px]:justify-left">
                                                    <div class="w-[130px] mr-[30px] flex justify-end items-center">
                                                        <select id="sortSelect" class="w-full text-[#777] text-[14px]">
                                                            <option disabled selected>نمایش بر اساس</option>
                                                            <option value="name_asc">نام، صعودی</option>
                                                            <option value="name_desc">نام، نزولی</option>
                                                            <option value="price_asc">قیمت، کم به بالا</option>
                                                            <option value="price_desc">قیمت، بالا به پایین</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap w-full mb-[-24px]">
                                @forelse($products as $product)
                                    @php
                                        $mainImage = $product->images->firstWhere('is_main', true);
                                        $hoverImage = $product->images->firstWhere('is_main', false);
                                        $discount = $product->discounts->first(); // اولین تخفیف
                                        $hasDiscount = $discount ? true : false;
                                        $average = round($product->reviews_avg_rating ?? 0);
                                        $reviewsCount = $product->reviews()->count();
                                    @endphp

                                    <div class="min-[1200px]:w-[25%] min-[768px]:w-[33.33%] w-[50%] max-[480px]:w-full px-[12px] mb-[24px]" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                                        <div class="bb-pro-box bg-[#fff] border-[1px] border-solid border-[#eee] rounded-[20px] relative">

                                            <!-- درصد تخفیف -->
                                            @if($hasDiscount && $product->discount_percentage)
                                                <span class="absolute top-[10px] right-[6px] z-[5] bg-red-500 px-2 py-1 rounded text-[14px] text-white font-medium">
                        % {{ intval($discount->discount_percentage) }} تخفیف
                    </span>
                                            @endif

                                            <!-- تصویر محصول -->
                                            <div class="bb-pro-img overflow-hidden relative border-b-[1px] border-solid border-[#eee] z-[4]">
                                                <a href="{{ route('offer.show', $product->slug) }}">
                                                    <div class="inner-img relative block overflow-hidden pointer-events-none rounded-t-[20px] h-[250px] sm:h-[200px] lg:h-[230px]">
                                                        <img class="main-img transition-all duration-[0.3s] ease-in-out w-full h-full object-cover rounded-t-[20px]"
                                                             src="{{ $mainImage ? asset($mainImage->image_path) : asset('panel/pictures/no-image.png') }}"
                                                             alt="{{ $product->name }}">
                                                        @if($hoverImage)
                                                            <img class="hover-img transition-all duration-[0.3s] ease-in-out absolute top-0 left-0 w-full h-full object-cover rounded-t-[20px] opacity-0"
                                                                 src="{{ asset($hoverImage->image_path) }}"
                                                                 alt="{{ $product->name }}">
                                                        @endif
                                                    </div>
                                                </a>

                                                <ul class="bb-pro-actions absolute left-0 right-0 bottom-0 flex justify-center items-center opacity-0 transition-all duration-[0.3s]">
                                                    <li class="bb-btn-group w-[35px] h-[35px] mx-[2px] flex items-center justify-center border-[1px] border-solid border-[#eee] rounded-[10px] bg-[#fff]">
                                                        <a href="javascript:void(0)" title="مورد علاقه" class="flex items-center justify-center w-full h-full">
                                                            <i class="ri-heart-line text-[18px] text-[#777]"></i>
                                                        </a>
                                                    </li>
                                                    <li class="bb-btn-group w-[35px] h-[35px] mx-[2px] flex items-center justify-center border-[1px] border-solid border-[#eee] rounded-[10px] bg-[#fff]">
                                                        <a href="javascript:void(0)" title="افزودن به سبد خرید" class="flex items-center justify-center w-full h-full">
                                                            <i class="ri-shopping-bag-4-line text-[18px] text-[#777]"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <!-- نام، دسته‌بندی و امتیاز -->
                                            <div class="bb-pro-contact p-[20px]">
                                                <div class="bb-pro-subtitle mb-[8px] flex flex-wrap justify-between">
                                                    <span class="text-[13px] leading-[16px] text-[#777] font-light">{{ $product->category->name ?? 'دسته‌بندی' }}</span>
                                                    <span class="bb-pro-rating">
                            @for($i=0; $i<5; $i++)
                                                            <i class="{{ $i < $average ? 'ri-star-fill text-[#fea99a]' : 'ri-star-line text-[#777]' }} text-[15px] mr-[3px] leading-[18px]"></i>
                                                        @endfor
                        </span>
                                                </div>

                                                <h4 class="bb-pro-title mb-[8px] text-[16px] leading-[18px]">
                                                    <a href="{{ route('offer.show', $product->slug) }}" class="block whitespace-nowrap overflow-hidden text-ellipsis text-[#3d4750] font-semibold">
                                                        {{ $product->name }}
                                                    </a>
                                                </h4>

                                                <!-- قیمت -->
                                                <div class="bb-price flex flex-wrap justify-between">
                                                    <div class="inner-price mx-[-3px] dir-rtl">
                                                        @if($hasDiscount && $product->discount_percentage)
                                                            <span class="old-price px-[3px] text-[14px] text-[#6c7fd8] line-through">
                                    {{ number_format($product->price) }} تومان
                                </span>
                                                            <span class="new-price px-[3px] text-[16px] text-[#686e7d] font-bold">
                                    {{ number_format($product->price - ($product->price * $product->discount_percentage / 100)) }} تومان
                                </span>
                                                        @else
                                                            <span class="new-price px-[3px] text-[16px] text-[#686e7d] font-bold">
                                    {{ number_format($product->price) }} تومان
                                </span>
                                                        @endif
                                                    </div>
                                                    <small class="text-[#777] text-[12px]">({{ $reviewsCount }} نظر)</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center w-full">محصولی موجود نیست</p>
                                @endforelse
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- JS for Star Rating & Alerts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Star Rating
            const stars = document.querySelectorAll('#star-rating .star-btn');
            const ratingInput = document.getElementById('rating');
            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const val = star.dataset.value;
                    ratingInput.value = val;
                    stars.forEach(s => s.classList.toggle('text-[#fea99a]', s.dataset.value <= val));
                });
            });

            // Flash Messages Fade
            ['success-alert','error-alert'].forEach(id => {
                const el = document.getElementById(id);
                if(el) setTimeout(()=> el.style.display='none', 3000);
            });
        });
    </script>

    <script>
        // مخفی کردن پیام‌های موفقیت و خطا پس از 3 ثانیه
        document.addEventListener('DOMContentLoaded', function () {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');

            if (successAlert) {
                setTimeout(() => {
                    successAlert.classList.add('fade-out');
                    setTimeout(() => {
                        successAlert.style.display = 'none';
                    }, 500); // مدت زمان انیمیشن محو شدن
                    successAlert.style.display = 'none';
                }, 3000);
            }

            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.classList.add('fade-out');
                    setTimeout(() => {
                        errorAlert.style.display = 'none';
                    }, 500); // مدت زمان انیمیشن محو شدن
                }, 3500); // 500 میلی‌ثانیه قبل از پایان 3 ثانیه
            }
        });
    </script>


    <style>
        /* استایل‌های بهبود یافته برای پیام‌های هشدار */
        .alert {
            padding: 15px 14px;
            margin: 14px 25px;
            border-radius: 12px;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 500;
            position: relative;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: opacity 0.5s ease-in-out;
            max-width: 40%; /* کاهش عرض پیام‌ها */
            width: 40%;
        }

        .alert-success {
            background-color: #e6f4ea;
            color: #2e7d32;
            border: 1px solid #a5d6a7;
        }

        .alert-danger {
            background-color: #fce4e4;
            color: #c62828;
            border: 1px solid #ef9a9a;
        }

        /* انیمیشن محو شدن */
        .alert.fade-out {
            opacity: 0;
        }

        @media screen and (max-width: 767px) {

            .alert {
                font-size: 14px;
                padding: 12px 18px;
            }
        }


    </style>
@endsection
