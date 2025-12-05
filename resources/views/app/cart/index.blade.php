@extends('app.home.master')
@section('title', 'لیست سبد خرید')

@section('content')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb mb-8 border-b border-gray-200 bg-gray-50 py-4">
        <div class="container mx-auto px-4 flex items-center justify-between text-sm">
            <h2 class="font-bold text-gray-800">سبد خرید</h2>
            <ul class="flex items-center gap-2 text-gray-500">
                <li><a href="{{ route('home') }}" class="text-purple-600 hover:underline">خانه</a></li>
                <li>></li>
                <li class="text-gray-700">سبد خرید</li>
            </ul>
        </div>
    </section>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success max-w-md mx-auto mb-4 p-3 bg-green-50 text-green-700 text-sm rounded-lg text-center animate-fade shadow-sm">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger max-w-md mx-auto mb-4 p-3 bg-red-50 text-red-700 text-sm rounded-lg text-center animate-fade shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <!-- محاسبه مجموع -->


    <section class="section-cart py-8">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-3 gap-6">
                <div class="lg:col-span-1">
                    <div class="border border-[#eee] bg-white p-[25px] rounded-[20px] sticky top-6" data-aos="fade-up" data-aos-delay="600">

                        <h4 class="font-Dana text-[20px] font-bold text-[#3d4750] mb-[20px]">خلاصه سفارش</h4>

                        <div class="space-y-[12px] text-[15px]">

                            {{-- جمع کل --}}
                            <div class="flex justify-between">
                                <span class="text-[#686e7d]">جمع کل محصولات</span>
                                <span class="font-medium">{{ number_format($total) }} تومان</span>
                            </div>

                            {{-- تخفیف کوپن --}}
                            @if($discount > 0)
                                <div class="flex justify-between text-green-600">
                    <span>
                        تخفیف کوپن
                        @if(isset($percentage))
                            <span class="text-xs">({{ $percentage }}%)</span>
                        @endif
                    </span>
                                    <span class="font-semibold">{{ number_format($discount) }} - تومان</span>
                                </div>
                            @endif

                            {{-- هزینه ارسال --}}
                            <div class="flex justify-between">
                                <span class="text-[#686e7d]">هزینه ارسال</span>
                                <span class="font-medium">{{ number_format($shipping?->cost ?? 0) }} تومان</span>
                            </div>

                            {{-- کد تخفیف --}}
                            <div class="flex justify-between items-center">
                                <span class="text-[#686e7d]">کد تخفیف</span>
                                <button onclick="toggleCoupon()" class="text-red-600 text-xs hover:underline">
                                    ثبت کد
                                </button>
                            </div>

                            {{-- فرم وارد کردن کوپن --}}
                            <div id="coupon-box" class="hidden">
                                <form action="{{ route('cart.verifyCouponCode') }}" method="POST" class="flex gap-2 mt-2">
                                    @csrf
                                    <input type="text" name="coupon_code"
                                           placeholder="کد تخفیف"
                                           class="flex-1 px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-purple-500 outline-none">
                                    <button type="submit"
                                            class="px-4 py-2 bg-purple-600 text-white rounded-lg text-xs hover:bg-purple-700 transition">
                                        ثبت
                                    </button>
                                </form>
                            </div>

                            <hr class="my-[15px] border-[#eee]">

                            {{-- مبلغ قابل پرداخت --}}
                            <div class="flex justify-between text-[18px] font-bold text-[#3d4750]">
                                <span>مبلغ قابل پرداخت</span>
                                <span>{{ number_format($finalTotal) }} تومان</span>
                            </div>

                            {{-- دکمه پرداخت --}}
                            <form action="{{ route('checkout.index') }}" method="GET" class="mt-[25px]">
                                @csrf
                                <button type="submit"
                                        class="w-full py-[14px] text-[16px] font-medium text-white bg-[#6c7fd8]
                        rounded-[12px] border border-[#6c7fd8] hover:bg-transparent hover:text-[#3d4750] transition">
                                    پرداخت
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

                <script>
                    function toggleCoupon() {
                        document.getElementById('coupon-box').classList.toggle('hidden')
                    }
                </script>

                <!-- آیتم‌های سبد -->
                <div class="lg:col-span-2">
                    <div class="bb-cart-table border border-gray-200 rounded-xl overflow-hidden">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="p-4 text-right text-sm font-semibold text-gray-700">محصول</th>
                                <th class="p-4 text-right text-sm font-semibold text-gray-700">تعداد</th>
                                <th class="p-4 text-right text-sm font-semibold text-gray-700">قیمت</th>
                                <th class="p-4 text-right text-sm font-semibold text-gray-700">ویژگی‌ها</th>
                                <th class="p-4 text-right text-sm font-semibold text-gray-700">حذف</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                            @if($cart && $cart->items->count() > 0)
                                @foreach($cart->items as $item)

                                    @php
                                        $original = $item->product->price;
                                        $final    = $item->product->finalPrice();
                                    @endphp
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="p-4" data-label="محصول">
                                            <div class="flex items-center gap-3">
                                                <img src="{{ asset($item->product->images->first()->image_path ?? 'panel/pictures/picture2.jpg') }}"
                                                     class="w-14 h-14 object-cover rounded-lg border" alt="">
                                                <span class="text-sm font-medium text-gray-700 line-clamp-2">
                                                        {{ $item->product->name }}
                                                    </span>
                                            </div>
                                        </td>

                                        <td class="p-4" data-label="تعداد">
                                            <form action="{{ route('cart.update', $item->id) }}" method="post" class="flex items-center gap-1">
                                                @csrf @method('PUT')
                                                <button type="button" onclick="decrement(this)" class="w-8 h-8 bg-gray-100 rounded hover:bg-gray-200 transition flex items-center justify-center">-</button>
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" class="w-12 text-center border rounded text-sm focus:ring-2 focus:ring-purple-500 outline-none" min="1" onchange="this.form.submit()">
                                                <button type="button" onclick="increment(this)" class="w-8 h-8 bg-gray-100 rounded hover:bg-gray-200 transition flex items-center justify-center">+</button>
                                            </form>
                                        </td>

                                        <td class="p-4 font-semibold text-gray-800" data-label="قیمت">
                                            @if($original != $final)
                                                <span class="line-through text-red-500">{{ number_format($original) }} تومان</span>
                                                <span class="text-green-600 font-bold">{{ number_format($final) }} تومان</span>
                                            @else
                                                {{ number_format($final) }} تومان
                                            @endif
                                            × {{ $item->quantity }}
                                        </td>

                                        <!-- ویژگی‌ها -->
                                        <td class="p-4 text-xs" data-label="ویژگی‌ها">
                                            @if(is_array($item->attributes) && !empty($item->attributes))
                                                @foreach($item->attributes as $attrId => $valueId)
                                                    <span class="inline-block bg-blue-50 text-blue-700 px-2 py-0.5 rounded mr-1 mb-1 text-xs">
                                                            {{ \App\Models\Attribute::find($attrId)->name ?? 'نامشخص' }}:
                                                            {{ \App\Models\AttributeValue::find($valueId)->value ?? 'نامشخص' }}
                                                        </span>
                                                @endforeach
                                            @else
                                                <span class="text-gray-400 italic">بدون ویژگی</span>
                                            @endif
                                        </td>

                                        <!-- حذف با تأیید -->
                                        <td class="p-4" data-label="حذف">
                                            <form action="{{ route('cart.remove', $item->id) }}" method="post" onsubmit="return confirm('آیا از حذف مطمئنید؟')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 transition p-1">
                                                    <i class="ri-delete-bin-line text-lg"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="p-12 text-center">
                                        <i class="ri-shopping-cart-2-line text-6xl text-gray-300 mb-3"></i>
                                        <p class="text-gray-500">سبد خرید خالی است</p>
                                        <a href="{{ route('home') }}" class="inline-block mt-4 px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                                            ادامه خرید
                                        </a>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // محو شدن پیام‌ها
        setTimeout(() => {
            document.querySelectorAll('.animate-fade').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(-8px)';
                setTimeout(() => el.remove(), 500);
            });
        }, 3000);

        // نمایش/مخفی کردن کد تخفیف
        function toggleCoupon() {
            const box = document.getElementById('coupon-box');
            box.classList.toggle('hidden');
        }

        // + و - تعداد
        function increment(btn) {
            const input = btn.parentNode.querySelector('input');
            input.stepUp();
            input.form.submit();
        }
        function decrement(btn) {
            const input = btn.parentNode.querySelector('input');
            if (input.value > 1) {
                input.stepDown();
                input.form.submit();
            }
        }
    </script>
    <script>
        function increment(btn) {
            const input = btn.parentNode.querySelector('input[name="quantity"]');
            input.stepUp();           // مقدار +1
            input.form.submit();      // ارسال فرم
        }

        function decrement(btn) {
            const input = btn.parentNode.querySelector('input[name="quantity"]');
            if (input.value > 1) {
                input.stepDown();     // مقدار -1
                input.form.submit();  // ارسال فرم
            }
        }
    </script>
    <style>
        .line-clamp-2 { overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }
        .animate-fade { animation: fadeOut 0.5s ease-out forwards; animation-delay: 3s; }
        @keyframes fadeOut { to { opacity: 0; transform: translateY(-8px); } }

        /* ریسپانسیو موبایل */
        @media (max-width: 767px) {
            thead { display: none; }
            tbody tr { display: block; margin-bottom: 1rem; padding: 1rem; border: 1px solid #eee; border-radius: 1rem; background: #fff; }
            tbody td { display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0; border: none; }
            tbody td:before { content: attr(data-label); font-weight: 600; color: #374151; min-width: 80px; }
            .flex.items-center.gap-3 { gap: 0.75rem; }
        }
    </style>
@endsection


