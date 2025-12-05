@forelse($products as $product)
    @php
        $mainImage = $product->images->firstWhere('is_main', true);
        $hoverImage = $product->images->firstWhere('is_main', false);
        $discount = $product->discounts->first();
        $hasDiscount = $discount ? true : false;
    @endphp

    <div class="min-[1200px]:w-[25%] min-[768px]:w-[33.33%] w-[50%] max-[480px]:w-full px-[12px] mb-[24px]" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
        <div class="bb-pro-box bg-[#fff] border-[1px] border-solid border-[#eee] rounded-[20px] relative">
            @if($hasDiscount && $product->discount_percentage)
                <span class="absolute top-[10px] right-[6px] z-[5] bg-red-500 px-2 py-1 rounded text-[14px] text-white font-medium">
                                             {{ intval($discount->discount_percentage) }}%
                    تخفیف
                                        </span>
            @endif

            <div class="bb-pro-img overflow-hidden relative border-b-[1px] border-solid border-[#eee] z-[4]">
                <a href="{{ route('offer.show', $product->slug) }}">
                    <div class="relative overflow-hidden group rounded-t-[20px] h-[250px] sm:h-[200px] lg:h-[230px]">
                        <img src="{{ $mainImage ? asset($mainImage->image_path) : asset('panel/pictures/no-image.png') }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-all duration-300 group-hover:opacity-0 rounded-t-[20px]">
                        @if($hoverImage)
                            <img src="{{ asset($hoverImage->image_path) }}" alt="{{ $product->name }}" class="absolute top-0 left-0 w-full h-full object-cover opacity-0 transition-all duration-300 group-hover:opacity-100 rounded-t-[20px]">
                        @endif
                    </div>
                </a>
            </div>

            <div class="bb-pro-contact p-[20px]">
                <div class="bb-pro-subtitle mb-[8px] flex flex-wrap justify-between">
                    <span class="text-[13px] leading-[16px] text-[#777] font-light">{{ $product->category->title ?? 'دسته‌بندی' }}</span>
                    <span class="bb-pro-rating">
                                                @for($i=0;$i<5;$i++)
                            <i class="{{ $i < round($product->reviews_avg_rating ?? 0) ? 'ri-star-fill text-[#fea99a]' : 'ri-star-line text-[#777]' }} text-[15px] mr-[3px] leading-[18px]"></i>
                        @endfor
                                            </span>
                </div>
                <h4 class="bb-pro-title mb-[8px] text-[16px] leading-[18px]">
                    <a href="{{ route('offer.show', $product->slug) }}" class="block whitespace-nowrap overflow-hidden text-ellipsis text-[#3d4750] font-semibold">{{ $product->name }}</a>
                </h4>
                <div class="bb-price flex flex-wrap justify-between">
                    <div class="inner-price mx-[-3px] dir-rtl">
                        @if($hasDiscount)
                            <span class="old-price px-[3px] text-[14px] text-[#6c7fd8] line-through">{{ number_format($product->price) }} تومان</span>
                            <span class="new-price px-[3px] text-[16px] text-[#686e7d] font-bold">{{ number_format($product->price - ($product->price * $product->discount_percentage / 100)) }} تومان</span>
                        @else
                            <span class="new-price px-[3px] text-[16px] text-[#686e7d] font-bold">{{ number_format($product->price) }} تومان</span>
                        @endif
                    </div>
                    <small class="text-[#777] text-[12px]">({{ $product->reviews()->count() }} نظر)</small>
                </div>
            </div>
        </div>
    </div>
@empty
    <p class="text-center w-full">محصولی موجود نیست</p>
@endforelse
