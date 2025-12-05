
@forelse($newProducts as $product)
    @php
        $discount = $product->discounts->first(); // اولین تخفیف محصول
        $hasDiscount = $discount ? true : false;
    @endphp
    <div class="min-[1200px]:w-[25%] min-[768px]:w-[33.33%] w-[50%] max-[480px]:w-full px-[12px] mb-[24px]"
         data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
        <div class="bb-pro-box bg-[#fff] border-[1px] border-solid border-[#eee] rounded-[20px] relative">

            <!-- تخفیف -->
            @if($hasDiscount && $product->discount_percentage)
                <span class="absolute top-[10px] right-[6px] z-[5] bg-red-500 px-2 py-1 rounded text-[14px] text-white font-medium">
                        {{ intval($discount->discount_percentage) }} %تخفیف
                    </span>
        @endif

        <!-- تصویر محصول -->
            <div class="bb-pro-img overflow-hidden relative border-b-[1px] border-solid border-[#eee] z-[4]">
                <a href="{{ route('offer.show', $product->slug) }}">
                    <div class="inner-img relative block overflow-hidden pointer-events-none rounded-t-[20px] h-[250px] sm:h-[200px] lg:h-[230px]">
                        @if($product->images->count())
                            <div id="carousel{{ $product->id }}" class="carousel slide h-full" data-bs-ride="carousel">
                                <div class="carousel-inner h-full">
                                    @foreach($product->images as $key => $image)
                                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }} h-full">
                                            <img src="{{ asset($image->image_path) }}"
                                                 class="d-block w-full h-full object-cover rounded-t-[20px]"
                                                 alt="{{ $product->name }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <img src="{{ asset('panel/pictures/no-image.png') }}"
                                 class="w-full h-full object-cover rounded-t-[20px]"
                                 alt="{{ $product->name }}">
                        @endif
                    </div>
                </a>
            </div>

            <!-- نام، دسته‌بندی و امتیاز -->
            <div class="bb-pro-contact p-[20px]">
                <div class="bb-pro-subtitle mb-[8px] flex flex-wrap justify-between">
                        <span class="text-[13px] leading-[16px] text-[#777] font-light">
                            {{ $product->category->title ?? 'دسته‌بندی' }}
                        </span>
                    <span class="bb-pro-rating">
                            @php $average = round($product->reviews_avg_rating ?? 0); @endphp
                        @for($i=0; $i<5; $i++)
                            <i class="{{ $i < $average ? 'ri-star-fill text-[#fea99a]' : 'ri-star-line text-[#777]' }} text-[15px] mr-[3px] leading-[18px]"></i>
                        @endfor
                        </span>
                </div>

                <h4 class="bb-pro-title mb-[8px] text-[16px] leading-[18px]">
                    <a href="{{ route('offer.show', $product->slug) }}"
                       class="block whitespace-nowrap overflow-hidden text-ellipsis text-[#3d4750] font-semibold">
                        {{ $product->name }}
                    </a>
                </h4>
                <!-- قیمت -->
                <div class="bb-price flex flex-wrap justify-between">
                    <div class="inner-price mx-[-3px] dir-rtl">
                        @if($hasDiscount && $product->discount_percentage)
                            <span class="old-price px-[3px] text-[14px] text-[#686e7d] line-through">
                {{ number_format($product->price) }}
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
                    <small class="text-[#777] text-[12px]">({{ $product->reviews()->count() }} نظر)</small>
                </div>

            </div>
        </div>
    </div>
@empty
    <p class="text-center w-full">محصول جدیدی موجود نیست</p>
@endforelse
