@extends('app.home.master')
@section('title', $product->slug)
@section('content')

    <!-- Breadcrumb -->
    <section class="section-breadcrumb mb-[50px] max-[1199px]:mb-[35px] border-b-[1px] border-solid border-[#eee] bg-[#f8f8fb]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="flex flex-wrap w-full bb-breadcrumb-inner m-[0] py-[20px] items-center">
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <h2 class="bb-breadcrumb-title font-Dana leading-[1.2] text-[16px] font-bold text-[#3d4750] max-[767px]:text-center max-[767px]:mb-[10px]">صفحه محصول</h2>
                        </div>
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                                <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]">
                                    <a href="{{ route('home') }}" class="font-Poppins text-[14px] font-semibold text-[#686e7d]">خانه</a>
                                </li>
                                <li class="text-[14px] font-normal px-[5px]">
                                    <i class="ri-arrow-left-double-fill text-[14px] font-semibold"></i>
                                </li>
                                <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] font-normal px-[5px] active">صفحه محصول</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (session('success'))
        <div class="alert alert-success  p-[12px]" id="success-alert">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger  p-[12px]" id="error-alert">{{ session('error') }}</div>
    @endif
    <!-- Product page -->
    <section class="section-product py-[50px] max-[1199px]:py-[35px]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full">
                    <div class="bb-single-pro mb-12">
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">

                            <!-- بخش تصاویر (40%) -->
                            <div class="lg:col-span-5">
                                <div class="sticky top-6 p-3 bg-white rounded-3xl border border-gray-100 shadow-sm">

                                    <!-- تصویر اصلی -->
                                    @php $mainImage = $product->images->firstWhere('is_main', 1); @endphp
                                    <div class="relative overflow-hidden rounded-2xl mb-4 group cursor-zoom-in">
                                        <img
                                            src="{{ $mainImage ? asset($mainImage->image_path) : asset('panel/pictures/default.jpg') }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-110">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl"></div>
                                    </div>

                                    <!-- تصاویر کوچک -->
                                    @if($product->images->where('is_main', 0)->count() > 0)
                                        <div class="grid grid-cols-4 gap-2">
                                            @foreach($product->images->where('is_main', 0) as $image)
                                                <div class="group/thumb cursor-pointer overflow-hidden rounded-xl border-2 border-transparent hover:border-[#6c7fd8] transition-all duration-300">
                                                    <img
                                                        src="{{ asset($image->image_path) }}"
                                                        alt="{{ $product->name }}"
                                                        class="w-full h-20 object-cover group-hover/thumb:scale-110 transition-transform duration-300">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- بخش اطلاعات (60%) -->
                            <div class="lg:col-span-7 space-y-6">

                                <!-- نام محصول -->
                                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 font-Dana leading-tight">
                                    {{ $product->name }}
                                </h1>

                                <!-- امتیاز و نظرات -->
                                @php
                                    $average = round($product->reviews_avg_rating ?? 0);
                                    $reviewsCount = $product->reviews()->count();
                                @endphp
                                <div class="flex items-center gap-3">
                                    <div class="flex text-amber-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="ri-star{{ $i <= $average ? '-fill' : '-line' }} text-lg"></i>
                                        @endfor
                                    </div>
                                    <a href="#reviews" class="text-sm text-[#6c7fd8] hover:underline font-medium">
                                        {{ $reviewsCount }} نظر
                                    </a>
                                </div>

                                <!-- قیمت و موجودی -->
                                <div class="flex flex-wrap items-end justify-between gap-4 py-2 border-b border-gray-100 pb-6">
                                    <div class="space-y-1">
                                        @if($product->discounts->isNotEmpty())
                                            @php $discount = $product->discounts->first(); @endphp
                                            <div class="flex items-center gap-3">
                                                <p class="text-lg text-gray-500 line-through font-Dana">{{ number_format($product->price) }} تومان</p>
                                                <span class="px-2 py-1 text-xs font-bold text-white bg-red-500 rounded-full">
                                {{ round((($product->price - $discount->getDiscountedPrice()) / $product->price) * 100) }}% تخفیف
                            </span>
                                            </div>
                                            <p class="text-3xl font-extrabold text-gray-900 font-Dana">{{ number_format($discount->getDiscountedPrice()) }} تومان</p>
                                        @else
                                            <p class="text-3xl font-extrabold text-gray-900 font-Dana">{{ number_format($product->price) }} تومان</p>
                                        @endif
                                    </div>

                                    <div class="text-right">
                                        <p class="text-sm text-gray-600">موجودی</p>
                                        <p class="text-xl font-bold text-[#6c7fd8]">{{ $product->stock }} عدد</p>
                                    </div>
                                </div>

                                <!-- فرم انتخاب ویژگی + افزودن به سبد -->
                                <form action="{{ route('cart.add') }}" method="post" class="space-y-6">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    <!-- ویژگی‌ها (متن همیشه واضح و دیده می‌شود) -->
                                    @if($product->attributeValues->isNotEmpty())
                                        <div class="space-y-6">
                                            @foreach($product->attributeValues->groupBy('attribute_id') as $attribute_id => $values)
                                                @php
                                                    $attribute = $values->first()->attribute;
                                                    $attributeName = $attribute->name ?? 'ویژگی';
                                                    $isColor = in_array(strtolower($attributeName), ['رنگ', 'color']);
                                                @endphp

                                                <div>
                                                    <label class="block text-sm font-bold text-gray-800 mb-3">
                                                        {{ $attributeName }} <span class="text-red-500">*</span>
                                                    </label>

                                                    <div class="flex flex-wrap gap-3">
                                                        @foreach($values as $value)
                                                            @php
                                                                $isHexColor = $isColor && preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/i', trim($value->value));
                                                                $color = $isHexColor ? trim($value->value) : null;
                                                                $isLight = false;
                                                                if ($color) {
                                                                    $color = ltrim($color, '#');
                                                                    $r = hexdec(substr($color, 0, 2));
                                                                    $g = hexdec(substr($color, 2, 2));
                                                                    $b = hexdec(substr($color, 4, 2));
                                                                    $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;
                                                                    $isLight = $luminance > 0.7;
                                                                }
                                                            @endphp

                                                            <label class="cursor-pointer group">
                                                                <input type="radio" name="attributes[{{ $attribute_id }}]" value="{{ $value->id }}" class="sr-only peer" required>

                                                                @if($isColor && $isHexColor)
                                                                    <!-- دکمه رنگی -->
                                                                    <div class="relative w-12 h-12 rounded-full border-4 border-white shadow-md
                                                                       ring-2 ring-transparent peer-checked:ring-[#6c7fd8]
                                                                       transition-all duration-300 group-hover:scale-110
                                                                       flex items-center justify-center overflow-hidden"
                                                                         style="background-color: {{ $color }}" title="{{ $value->value }}">

                                                                        <span class="absolute inset-0 flex items-center justify-center opacity-0 peer-checked:opacity-100 transition-opacity duration-200">
                                                                            <i class="ri-check-line text-2xl font-bold drop-shadow
                                                                                      {{ $isLight ? 'text-gray-900' : 'text-white' }}"></i>
                                                                        </span>

                                                                        @if($isLight)
                                                                            <div class="absolute inset-1 rounded-full border-2 border-gray-300 opacity-40"></div>
                                                                        @endif
                                                                    </div>
                                                                @else
                                                                    <!-- دکمه متنی — متن همیشه واضح و پررنگ -->
                                                                    <div class="px-5 py-3 bg-white border-2 border-gray-300 rounded-xl
                                                                         text-sm font-bold text-gray-700 whitespace-nowrap
                                                                         peer-checked:border-[#6c7fd8] peer-checked:bg-[#6c7fd8]
                                                                          peer-checked:shadow-md
                                                                         transition-all duration-300 group-hover:border-[#6c7fd8]
                                                                         group-hover:shadow-sm group-active:scale-95
                                                                         flex items-center justify-center min-w-[48px]">
                                                                        <span class=" peer-checked:font-semibold">
                                                                            {{ $value->value }}
                                                                        </span>
                                                                    </div>

                                                                @endif
                                                            </label>
                                                        @endforeach
                                                    </div>

                                                    <!-- پیام خطا -->
                                                    <p class="mt-2 text-xs text-red-600 opacity-0 transition-opacity"
                                                       id="error-attribute-{{ $attribute_id }}">
                                                        لطفاً {{ $attributeName }} را انتخاب کنید.
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <!-- تعداد + دکمه -->
                                    <div class="flex flex-col sm:flex-row gap-3 items-stretch">
                                        <div class="flex items-center border border-gray-300 rounded-xl overflow-hidden w-full sm:w-auto">
                                            <button type="button" onclick="this.parentNode.querySelector('input').stepDown()" class="p-3 text-gray-600 hover:bg-gray-50 transition">-</button>
                                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                                   class="w-20 px-2 py-3 text-center font-medium focus:outline-none">
                                            <button type="button" onclick="this.parentNode.querySelector('input').stepUp()" class="p-3 text-gray-600 hover:bg-gray-50 transition">+</button>
                                        </div>

                                        <button type="submit"
                                                class="flex-1 px-8 py-3 bg-gradient-to-r from-[#6c7fd8] to-[#5a6bc7] hover:from-[#5a6bc7] hover:to-[#4a58b0] text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2 text-lg">
                                            <i class="ri-shopping-cart-line"></i>
                                            افزودن به سبد خرید
                                        </button>
                                    </div>
                                </form>

                                <form action="{{ route('wishlist.toggle', $product->id) }}" method="post" class="inline-block">
                                    @csrf
                                    <button type="submit"
                                            class="flex items-center gap-2 text-gray-600 hover:text-[#6c7fd8] transition-colors group">
                                        <div class="w-11 h-11 flex items-center justify-center
            {{ $isInWishlist ? 'bg-red-500 border-red-500' : 'bg-white border-gray-200' }}
            border-2 rounded-xl group-hover:border-[#6c7fd8] group-hover:bg-[#6c7fd8] transition-all">
                                            <i class="{{ $isInWishlist ? 'ri-heart-fill text-white' : 'ri-heart-line text-gray-400' }} text-xl transition-colors"></i>
                                        </div>

                                        <span class="text-sm font-medium">
            {{ $isInWishlist ? 'حذف از علاقه‌مندی‌ها' : 'افزودن به علاقه‌مندی‌ها' }}
        </span>
                                    </button>
                                </form>


                            </div>
                        </div>
                    </div>

                    <!-- اسکریپت اعتبارسنجی -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const form = document.querySelector('form[action*="cart.add"]');
                            if (!form) return;

                            form.addEventListener('submit', function (e) {
                                let isValid = true;
                                document.querySelectorAll('.attribute-group, [name^="attributes"]').forEach(el => {
                                    const group = el.closest('div');
                                    if (group && !group.querySelector('input[type="radio"]:checked')) {
                                        const error = group.querySelector('p[id^="error-attribute"]');
                                        if (error) error.classList.remove('opacity-0');
                                        isValid = false;
                                    }
                                });

                                if (!isValid) {
                                    e.preventDefault();
                                    document.querySelector('p[id^="error-attribute"]:not(.opacity-0)')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                }
                            });

                            document.querySelectorAll('input[type="radio"]').forEach(radio => {
                                radio.addEventListener('change', () => {
                                    const error = radio.closest('div').querySelector('p[id^="error-attribute"]');
                                    if (error) error.classList.add('opacity-0');
                                });
                            });
                        });
                    </script>
                    <!-- Accordion: Details & Reviews -->
                    <div class="w-full px-[12px]">
                        <div class="bey-single-accordion border-[1px] border-solid border-[#eee] p-[15px] rounded-[20px]">
                            <div class="bb-accordion style-1 mb-[-24px]">

                                <!-- Product Details -->
                                <div class="bb-accordion-item overflow-hidden mb-[24px]">
                                    <h4 class="accordion-head active-arrow m-0 py-[1rem] px-[1.25rem] text-[#4b5966] text-[16px] leading-[20px] font-medium relative rounded-[15px] border-[1px] border-solid border-[#eee] font-Poppins cursor-pointer max-[767px]:text-[15px]">
                                        جزئیات محصول
                                    </h4>
                                    <div class="accordion-body p-[1.25rem]">
                                        <div class="bb-details">
                                            <p class="mb-[12px] font-Poppins text-[#686e7d] font-light">{{ $product->description }}</p>
                                            <div class="details-info">
                                                <ul class="list-disc pl-[20px] mb-[0]">
                                                    @if($product->attributeValues->isNotEmpty())
                                                        <ul class="list-disc pl-[20px] mb-0">
                                                            @foreach($product->attributeValues->groupBy('attribute_id') as $attribute_id => $values)
                                                                <li class="py-[5px] text-[15px] text-[#686e7d] font-Poppins font-light">
                                                                    {{ $values->first()->attribute->name ?? 'ویژگی' }}:
                                                                    {{ $values->pluck('value')->implode(', ') }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                    @if($product->image_description)
                                                        <div class="mt-4">
                                                            <img src="{{ asset('panel/pictures/'.$product->image_description) }}" alt="{{ $product->name }}" class="rounded-[15px] w-1/2 mx-auto">
                                                        </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Reviews -->
                                <div class="bb-accordion-item overflow-hidden mb-[24px]">
                                    <h4 class="accordion-head m-0 py-[1rem] px-[1.25rem] text-[#4b5966] text-[16px] leading-[20px] font-medium relative rounded-[15px] border-[1px] border-solid border-[#eee] font-Poppins cursor-pointer max-[767px]:text-[15px]">
                                        مشاهده
                                    </h4>
                                    <div class="accordion-body p-[1.25rem] hidden" id="reviews">
                                        @forelse($product->reviews as $review)
                                            <div class="reviews-bb-box flex mb-[24px] max-[575px]:flex-col">
                                                <div class="inner-contact">
                                                    <h4 class="font-Dana text-[16px] font-bold mb-[5px]">{{ $review->user->name ?? 'کاربر' }}</h4>
                                                    <div class="bb-pro-rating flex mb-[5px]">
                                                        @for($i=1; $i<=5; $i++)
                                                            <i class="ri-star-fill text-[15px] mr-[3px] {{ $i <= $review->rating ? 'text-[#fea99a]' : 'text-[#777]' }}"></i>
                                                        @endfor
                                                    </div>
                                                    <p class="font-Poppins text-[14px] font-light text-[#686e7d]">{{ $review->comment }}</p>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-[#777] font-Poppins">هنوز نظری ثبت نشده است.</p>
                                        @endforelse

                                        <!-- Add Review Form -->
                                        <div class="mt-[20px]">
                                            @auth
                                                <form action="{{ route('products.comments.store', $product->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                                    <div class="mb-4">
                                                        <label for="comment" class="block text-[#4b5966] font-Poppins mb-2">نظر شما</label>
                                                        <textarea name="comment" id="comment" rows="4" required class="w-full p-3 border border-[#eee] rounded-lg text-[#686e7d] font-Poppins"></textarea>
                                                    </div>

                                                    <div class="mb-4">
                                                        <label class="block text-[#4b5966] font-Poppins mb-2">امتیاز شما</label>
                                                        <div class="flex" id="star-rating">
                                                            @for($i=1; $i<=5; $i++)
                                                                <button type="button" class="star-btn text-[#777] text-2xl mr-1" data-value="{{ $i }}">
                                                                    <i class="ri-star-fill"></i>
                                                                </button>
                                                            @endfor
                                                            <input type="hidden" id="rating" name="rating" value="0">
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="bb-btn-2 bg-[#6c7fd8] hover:bg-[#3d4750] text-white px-6 py-2 rounded-lg">ثبت نظر</button>
                                                </form>
                                            @else
                                                <p class="text-red-500 font-Poppins text-[14px]">
                                                    برای ثبت نظر باید <a href="{{ route('user.login') }}" class="text-blue-500 underline">وارد سایت شوید</a>.
                                                </p>
                                            @endauth
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
