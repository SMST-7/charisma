@extends('app.home.master')
@section('content')


    <section
        class="section-breadcrumb mb-[50px] max-[1199px]:mb-[35px] border-b-[1px] border-solid border-[#eee] bg-[#f8f8fb]">
        <div
            class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="flex flex-wrap w-full bb-breadcrumb-inner m-[0] py-[20px] items-center">
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]"><h2
                                class="bb-breadcrumb-title font-Dana leading-[1.2] text-[16px] font-bold text-[#3d4750] max-[767px]:text-center max-[767px]:mb-[10px]">
                                بلاگ</h2></div>
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                                <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a href="{{ route('home') }}"
                                                                                                   class="font-Poppins text-[14px] font-semibold text-[#686e7d]">خانه</a>
                                </li>
                                <li class="text-[14px] font-normal px-[5px]"><i
                                        class="ri-arrow-left-double-fill text-[14px] font-semibold"></i></li>
                                <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] font-normal px-[5px] active">
                                    بلاگ
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-blog py-[50px] max-[1199px]:py-[35px]">
        <div
            class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full mb-[-24px]">
                @foreach($blogs as $blog)
                    <div class="min-[992px]:w-[33.33%] min-[768px]:w-[50%] w-full px-[12px] mb-[24px]"
                         data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                        <div class="bb-blog-card bg-[#f8f8fb] border-[1px] border-solid border-[#eee] rounded-[20px]">
                            <div class="blog-image">
                                <img src="{{ asset('uploads/blogs/' . $blog->image) }}"
                                     alt="{{ $blog->title }}"
                                     class="w-full h-[250px] object-cover rounded-tl-[20px] rounded-tr-[20px]">
                            </div>
                            <div class="blog-contact p-[20px]">
                                <h5 class="mb-[12px] text-[18px] leading-[1.2]">
                                    <a href="{{ route('blogs.singleBlog', $blog->slug) }}"
                                       class="font-Poppins text-[18px] font-medium text-[#3d4750]">
                                        {{ $blog->title }}
                                    </a>
                                </h5>
                                <p class="font-Poppins mb-[12px] text-[14px] leading-[26px] font-light">
                                    {{ Str::limit($blog->content, 50) }}
                                </p>
                                <div class="blog-btn flex">
                                    <a href="{{ route('blogs.singleBlog', $blog->slug) }}"
                                       class="bb-btn-2 transition-all duration-[0.3s] ease-in-out font-Poppins py-[2px] px-[14px] text-[14px] font-normal text-[#fff] bg-[#6c7fd8] rounded-[10px] border-[1px] border-solid border-[#6c7fd8] hover:bg-transparent hover:border-[#3d4750] hover:text-[#3d4750]">
                                        ادامه...
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="w-full px-[12px]">
                    {{ $blogs->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </section>
@endsection





