<div class="flex flex-wrap w-full mb-[-24px]">
                                @forelse($products as $product)
                                    <div class="min-[1400px]:w-[16.66%] min-[992px]:w-[25%] min-[768px]:w-[33.33%] w-[50%] max-[480px]:w-full px-[12px] mb-[24px] pro-bb-content" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                                        <div class="bb-pro-box bg-[#fff] border-[1px] border-solid border-[#eee] rounded-[20px]">
                                            <div class="bb-pro-img overflow-hidden relative border-b-[1px] border-solid border-[#eee] z-[4]">
                                                <a href="{{ route('offer.show', $product->slug) }}">
                                                    <div class="inner-img relative block overflow-hidden pointer-events-none rounded-t-[20px]">
                                                        @php
                                                            $mainImage = $product->images->firstWhere('is_main', true);
                                                            $hoverImage = $product->images->firstWhere('is_main', false);
                                                        @endphp

                                                        <img class="main-img transition-all duration-[0.3s] ease-in-out w-full rounded-t-[20px]"
                                                             src="{{ $mainImage ? asset($mainImage->image_path) : asset('panel/pictures/picture2.jpg') }}"
                                                             alt="{{ $product->name }}">

                                                        @if($hoverImage)
                                                            <img class="hover-img transition-all duration-[0.3s] ease-in-out absolute z-[2] top-[0] left-[0] opacity-[0] w-full rounded-t-[20px]"
                                                                 src="{{ asset($hoverImage->image_path) }}"
                                                                 alt="{{ $product->name }}">
                                                        @endif
                                                    </div>
                                                </a>
                                                <ul class="bb-pro-actions transition-all duration-[0.3s] ease-in-out my-[0] mx-[auto] absolute z-[9] left-[0] right-[0] bottom-[0] flex flex-row items-center justify-center opacity-[0]">
                                                    <li class="bb-btn-group w-[35px] h-[35px] mx-[2px] flex items-center justify-center border-[1px] border-solid border-[#eee] rounded-[10px] bg-[#fff]">
                                                        <a href="javascript:void(0)" title="مورد علاقه" class="w-[35px] h-[35px] flex items-center justify-center">
                                                            <i class="ri-heart-line text-[18px] text-[#777]"></i>
                                                        </a>
                                                    </li>
                                                    <li class="bb-btn-group w-[35px] h-[35px] mx-[2px] flex items-center justify-center border-[1px] border-solid border-[#eee] rounded-[10px] bg-[#fff]">
                                                        <a href="javascript:void(0)" title="افزودن به سبد خرید" class="w-[35px] h-[35px] flex items-center justify-center">
                                                            <i class="ri-shopping-bag-4-line text-[18px] text-[#777]"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="bb-pro-contact p-[20px]">
                                                <div class="bb-pro-subtitle mb-[8px] flex flex-wrap justify-between">
                                                    <span class="text-[13px] leading-[16px] text-[#777] font-light">{{ $product->category->name ?? 'دسته‌بندی' }}</span>

                                                     ستاره‌ها
                                                    @php
                                                        $average = round($product->reviews_avg_rating ?? 0);
                                                        $reviewsCount = $product->reviews()->count();
                                                    @endphp
                                                    <span class="bb-pro-rating">
                            @for($i=0; $i<5; $i++)
                                                            <i class="{{ $i < $average ? 'ri-star-fill text-[#fea99a]' : 'ri-star-line text-[#777]' }} float-left text-[15px] mr-[3px] leading-[18px]"></i>
                                                        @endfor
                        </span>
                                                </div>

                                                <h4 class="bb-pro-title mb-[8px] text-[16px] leading-[18px]">
                                                    <a href="{{ route('offer.show', $product->slug) }}"
                                                       class="block whitespace-nowrap overflow-hidden text-ellipsis text-[15px] leading-[18px] text-[#3d4750] font-semibold">
                                                        {{ $product->name }}
                                                    </a>
                                                </h4>

                                                <div class="bb-price flex flex-wrap justify-between">
                                                    <div class="inner-price mx-[-3px] dir-rtl">
                                                        <span class="new-price px-[3px] text-[16px] text-[#686e7d] font-bold">{{ number_format($product->price) }} تومان</span>
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
