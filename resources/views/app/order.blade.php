{{-- resources/views/checkout/index.blade.php --}}
@extends('app.home.master')

@section('content')
    <section class="section-checkout py-[70px] max-[1199px]:py-[50px] bg-[#f8f8fb]">
        <div class="flex flex-wrap justify-between relative items-start mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px] px-[15px]">
            <div class="flex flex-wrap w-full mb-[-40px]">

                {{-- ستون چپ - اطلاعات و آدرس (66%) --}}
                <div class="min-[992px]:w-[66.66%] w-full px-[12px] mb-[40px]">
                    <div class="bb-checkout-contact border-[1px] border-solid border-[#eee] bg-white p-[30px] rounded-[20px] shadow-sm"
                         data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">

                        {{-- عنوان اصلی --}}
                        <h3 class="font-Dana text-[28px] font-bold text-[#3d4750] mb-[30px]">تسویه حساب</h3>

                        {{-- فرم آدرس جدید یا انتخاب آدرس قبلی --}}
                        <div class="space-y-[30px]">

                            {{-- انتخاب آدرس موجود یا جدید --}}
                            <div>
                                <div class="flex flex-wrap gap-[20px] mb-[15px]">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="address_type" value="existing" checked class="w-[18px] h-[18px]">
                                        <span class="mr-[10px] text-[15px] text-[#3d4750] font-medium">استفاده از آدرس قبلی</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="address_type" value="new" class="w-[18px] h-[18px]">
                                        <span class="mr-[10px] text-[15px] text-[#3d4750] font-medium">آدرس جدید</span>
                                    </label>
                                </div>
                            </div>

                            {{-- آدرس‌های قبلی --}}
                            <div id="existingAddresses" class="space-y-5">
                                @forelse($addresses as $addr)
                                    <div class="relative bg-white border-2 border-gray-200 rounded-2xl overflow-hidden
                transition-all duration-300
                group/has-checked
                has-[:checked]:border-indigo-500
                has-[:checked]:ring-4 has-[:checked]:ring-indigo-100
                has-[:checked]:bg-indigo-50/30
                has-[:checked]:shadow-xl
                hover:border-indigo-500 hover:shadow-xl
                {{ $addr->default ? 'border-indigo-500 ring-4 ring-indigo-100 bg-indigo-50/30 shadow-xl' : '' }}">

                                        <!-- دکمه حذف -->
                                        <div class="absolute top-4 left-4 z-10">
                                            <form action="{{ route('address.destroy', $addr->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        onclick="return confirm('آیا از حذف این آدرس مطمئن هستید؟')"
                                                        class="flex items-center gap-2 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white
                               font-medium text-sm rounded-xl shadow-lg hover:shadow-red-500/30
                               transition-all duration-200 active:scale-95">
                                                    حذف
                                                </button>
                                            </form>
                                        </div>

                                        <!-- لیبل انتخاب آدرس -->
                                        <label class="flex items-start gap-5 p-6 pl-36 cursor-pointer select-none relative block">
                                            <!-- رادیو باتن -->
                                            <input type="radio"
                                                   name="address_id"
                                                   value="{{ $addr->id }}"
                                                   form="checkoutForm"
                                                   class="mt-1.5 w-5 h-5 text-indigo-600 focus:ring-indigo-500 rounded-full shrink-0"
                                                {{ $addr->default ? 'checked' : '' }}>

                                            <!-- محتوا -->
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between mb-3">
                                                    <div class="flex items-center gap-3">
                                                        <h3 class="text-xl font-bold text-gray-900">{{ $addr->fname }}</h3>
                                                        @if($addr->default)
                                                            <span class="px-3 py-1 text-xs font-bold text-indigo-700 bg-indigo-100 rounded-full shadow-sm">
                                پیش‌فرض
                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- بقیه محتوا مثل قبل... -->
                                                <div class="space-y-3 text-gray-700">
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-9 h-9 bg-gray-100 rounded-full flex items-center justify-center">
                                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                            </svg>
                                                        </div>
                                                        <span class="font-medium text-gray-900">{{ $addr->phone }}</span>
                                                    </div>

                                                    <div class="flex items-center gap-3">
                                                        <div class="w-9 h-9 bg-gray-100 rounded-full flex items-center justify-center">
                                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                            </svg>
                                                        </div>
                                                        <span class="text-gray-800">{{ $addr->province }} - {{ $addr->city }}</span>
                                                    </div>

                                                    <div class="pl-12 py-2 bg-indigo-50/50 rounded-lg border-l-4 border-indigo-300">
                                                        <p class="font-medium text-gray-900 leading-relaxed">{{ $addr->address }}</p>
                                                    </div>

                                                    <div class="pl-12 flex items-center gap-2">
                                                        <span class="text-sm text-gray-600">کد پستی:</span>
                                                        <span class="font-mono font-bold text-gray-900 tracking-wider">{{ $addr->postal_code }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- تیک بزرگ انتخاب شده -->
                                            <div class="absolute top-6 left-24 pointer-events-none opacity-0 has-[:checked]:opacity-100 transition-opacity">
                                                <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center shadow-xl">
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                @empty
                                    <div class="text-center py-16 bg-gradient-to-b from-gray-50 to-white rounded-3xl border-2 border-dashed border-gray-300">
                                        <div class="w-24 h-24 mx-auto mb-5 bg-gray-200 rounded-full flex items-center justify-center">
                                            <svg class="w-14 h-14 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                        <p class="text-xl font-bold text-gray-700">هیچ آدرسی ثبت نشده</p>
                                        <p class="text-gray-500 mt-2">برای ادامه خرید، ابتدا آدرس خود را اضافه کنید</p>
                                    </div>
                                @endforelse
                            </div>




                            {{-- فرم آدرس جدید (در ابتدا مخفی) --}}
                            <div id="newAddressForm" class="hidden">
                                <form method="POST" action="{{ route('address.store') }}" id="newAddressFormElement">
                                    @csrf
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-[20px]">
                                        <div class="input-item">
                                            <label class="block text-[14px] font-medium text-[#3d4750] mb-[8px]">نام *</label>
                                            <input type="text" name="fname" required placeholder="نام"
                                                   class="w-full p-[12px] text-[14px] border border-[#eee] rounded-[12px] focus:border-[#6c7fd8] outline-none transition">
                                        </div>
                                        <div class="input-item">
                                            <label class="block text-[14px] font-medium text-[#3d4750] mb-[8px]">شماره تماس *</label>
                                            <input type="text" name="phone" required placeholder="09xxxxxxxxx"
                                                   class="w-full p-[12px] text-[14px] border border-[#eee] rounded-[12px] focus:border-[#6c7fd8] outline-none transition">
                                        </div>
                                        <div class="input-item">
                                            <label class="block text-[14px] font-medium text-[#3d4750] mb-[8px]">استان *</label>
                                            <input type="text" name="province" required placeholder="مثال: تهران"
                                                   class="w-full p-[12px] text-[14px] border border-[#eee] rounded-[12px] focus:border-[#6c7fd8] outline-none transition">
                                        </div>
                                        <div class="input-item">
                                            <label class="block text-[14px] font-medium text-[#3d4750] mb-[8px]">شهر *</label>
                                            <input type="text" name="city" required placeholder="مثال: تهران"
                                                   class="w-full p-[12px] text-[14px] border border-[#eee] rounded-[12px] focus:border-[#6c7fd8] outline-none transition">
                                        </div>
                                        <div class="input-item md:col-span-2">
                                            <label class="block text-[14px] font-medium text-[#3d4750] mb-[8px]">آدرس کامل *</label>
                                            <input type="text" name="address" required placeholder="خیابان، پلاک، واحد و ..."
                                                   class="w-full p-[12px] text-[14px] border border-[#eee] rounded-[12px] focus:border-[#6c7fd8] outline-none transition">
                                        </div>
                                        <div class="input-item">
                                            <label class="block text-[14px] font-medium text-[#3d4750] mb-[8px]">کد پستی *</label>
                                            <input type="text" name="postal_code" required placeholder="1234567890"
                                                   class="w-full p-[12px] text-[14px] border border-[#eee] rounded-[12px] focus:border-[#6c7fd8] outline-none transition">
                                        </div>
                                    </div>
                                    <button type="submit"
                                            class="mt-[20px] bb-btn-2 py-[12px] px-[30px] text-[15px] font-medium text-white bg-[#6c7fd8] rounded-[12px] border border-[#6c7fd8] hover:bg-transparent hover:text-[#3d4750] transition">
                                        ثبت آدرس و ادامه
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ستون راست - سبد خرید و خلاصه پرداخت (33%) --}}
                <div class="min-[992px]:w-[33.33%] w-full px-[12px] mb-[40px]">
                    <div class="bb-checkout-sidebar space-y-[24px]">

                        {{-- لیست محصولات --}}
                        <div class="border border-[#eee] bg-white p-[25px] rounded-[20px]" data-aos="fade-up" data-aos-delay="400">
                            <h4 class="font-Dana text-[20px] font-bold text-[#3d4750] mb-[20px]">محصولات سبد خرید</h4>
                            <div class="space-y-[20px]">
                                @foreach($cart->items as $item)

                                    @php
                                        $original = $item->product->price;
                                        $final    = $item->product->finalPrice();
                                    @endphp

                                    <div class="flex items-center gap-[15px] pb-[20px] border-b border-[#eee] last:border-0 last:pb-0">
                                        <img src="{{ asset($item->product->images->first()->image_path ?? 'panel/pictures/picture2.jpg')}}"
                                             class="w-[80px] h-[80px] object-cover rounded-[15px] border border-[#eee]">

                                        <div class="flex-1">
                                            <h5 class="text-[15px] font-medium">{{ $item->product->name }}</h5>

                                            <div class="text-[13px] text-[#686e7d] mt-[4px]">
                                                @if($original != $final)
                                                    <span class="line-through text-red-500">{{ number_format($original) }} تومان</span>
                                                    <span class="text-green-600 font-bold">{{ number_format($final) }} تومان</span>
                                                @else
                                                    {{ number_format($final) }} تومان
                                                @endif
                                                × {{ $item->quantity }}
                                            </div>
                                        </div>

                                        <div class="text-[15px] font-bold text-[#3d4750]">
                                            {{ number_format($final * $item->quantity) }} تومان
                                        </div>
                                    </div>

                                @endforeach

                            </div>
                        </div>

                        {{-- خلاصه پرداخت --}}
                        <div class="border border-[#eee] bg-white p-[25px] rounded-[20px]" data-aos="fade-up" data-aos-delay="600">
                            <h4 class="font-Dana text-[20px] font-bold text-[#3d4750] mb-[20px]">خلاصه سفارش</h4>

                            <div class="space-y-[12px] text-[15px]">

                                {{-- جمع کل محصولات (بعد از تخفیف تکی هر محصول) --}}
                                <div class="flex justify-between">
                                    <span class="text-[#686e7d]">جمع کل محصولات</span>
                                    <span class="font-medium">{{ number_format($total) }} تومان</span>
                                </div>

                                {{-- تخفیف کوپن --}}
                                @if($discount > 0)
                                    <div class="flex justify-between text-green-600">
                <span>
                    تخفیف کوپن
<span class="text-xs">({{ $coupon->value }}% تخفیف)</span>
                </span>
                                        <span class="font-semibold">{{ number_format($discount) }} - تومان</span>
                                    </div>
                                @endif

                                {{-- هزینه ارسال --}}
                                <div class="flex justify-between">
                                    <span class="text-[#686e7d]">هزینه ارسال</span>
                                    <span class="font-medium">{{ number_format($shipping?->cost ?? 0) }} تومان</span>
                                </div>

                                <hr class="my-[15px] border-[#eee]">

                                {{-- مبلغ قابل پرداخت نهایی --}}
                                <div class="flex justify-between text-[18px] font-bold text-[#3d4750]">
                                    <span>مبلغ قابل پرداخت</span>
                                    <span>{{ number_format($finalTotal) }} تومان</span>
                                </div>

                                {{-- دکمه پرداخت --}}
                                <form id="checkoutForm" action="{{ route('payment.zarinpal.start') }}" method="POST" class="mt-[25px]">
                                    @csrf
                                    <button type="submit"
                                            class="w-full bb-btn-2 py-[14px] text-[16px] font-medium text-white bg-[#6c7fd8] rounded-[12px] border border-[#6c7fd8] hover:bg-transparent hover:text-[#3d4750] transition">
                                        ثبت نهایی سفارش
                                    </button>
                                </form>

                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
        // نمایش/مخفی کردن فرم آدرس جدید
        document.querySelectorAll('input[name="address_type"]').forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'new') {
                    document.getElementById('existingAddresses').classList.add('hidden');
                    document.getElementById('newAddressForm').classList.remove('hidden');
                } else {
                    document.getElementById('existingAddresses').classList.remove('hidden');
                    document.getElementById('newAddressForm').classList.add('hidden');
                }
            });
        });
    </script>
@endsection
