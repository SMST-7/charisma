@if ($paginator->hasPages())
    <div class="w-full px-[12px]">
        <div class="bb-pro-pagination mb-[24px] flex justify-between max-[575px]:flex-col max-[575px]:items-center">
            <p class="font-Poppins text-[15px] text-[#686e7d] font-light max-[575px]:mb-[10px]">
                {{-- مثلا نمایش شماره صفحه فعلی --}}
                صفحه {{ $paginator->currentPage() }} از {{ $paginator->lastPage() }}
            </p>

            <ul class="flex">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="leading-[28px] mr-[6px] opacity-50 cursor-not-allowed">
                        <span class="transition-all duration-[0.3s] ease-in-out w-[auto] h-[32px] px-[13px] font-light text-[#777] leading-[30px] bg-[#f8f8fb] font-Poppins text-[15px] flex justify-center items-center rounded-[10px] border border-solid border-[#eee]">
                            قبلی
                        </span>
                    </li>
                @else
                    <li class="leading-[28px] mr-[6px]">
                        <a href="{{ $paginator->previousPageUrl() }}" class="transition-all duration-[0.3s] ease-in-out w-[auto] h-[32px] px-[13px] font-light text-[#fff] leading-[30px] bg-[#3d4750] font-Poppins text-[15px] flex justify-center items-center rounded-[10px] border border-solid border-[#eee]">
                            قبلی
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="leading-[28px] mr-[6px]">
                            <span class="text-[#777] px-[10px]">{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="leading-[28px] mr-[6px] active">
                                    <span class="transition-all duration-[0.3s] ease-in-out w-[32px] h-[32px] font-light text-[#fff] leading-[32px] bg-[#3d4750] font-Poppins text-[15px] flex justify-center items-center rounded-[10px] border border-solid border-[#3d4750]">
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                                <li class="leading-[28px] mr-[6px]">
                                    <a href="{{ $url }}" class="transition-all duration-[0.3s] ease-in-out w-[32px] h-[32px] font-light text-[#777] leading-[32px] bg-[#f8f8fb] font-Poppins text-[15px] flex justify-center items-center rounded-[10px] border border-solid border-[#eee] hover:bg-[#3d4750] hover:text-[#fff]">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="leading-[28px]">
                        <a href="{{ $paginator->nextPageUrl() }}" class="next transition-all duration-[0.3s] ease-in-out w-[auto] h-[32px] px-[13px] font-light text-[#fff] leading-[30px] bg-[#3d4750] font-Poppins text-[15px] flex justify-center items-center rounded-[10px] border border-solid border-[#eee]">
                            بعدی <i class="ri-arrow-left-s-line ml-[10px] text-[16px] w-[8px] text-[#fff]"></i>
                        </a>
                    </li>
                @else
                    <li class="leading-[28px] opacity-50 cursor-not-allowed">
                        <span class="transition-all duration-[0.3s] ease-in-out w-[auto] h-[32px] px-[13px] font-light text-[#777] leading-[30px] bg-[#f8f8fb] font-Poppins text-[15px] flex justify-center items-center rounded-[10px] border border-solid border-[#eee]">
                            بعدی
                        </span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
@endif
