@extends('app.home.master')
@section('title',' مقاله : '.$blog->slug)
@section('content')

    <!-- Breadcrumb -->
    <section class="section-breadcrumb mb-[50px] max-[1199px]:mb-[35px] border-b-[1px] border-solid border-[#eee] bg-[#f8f8fb]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="flex flex-wrap w-full bb-breadcrumb-inner m-[0] py-[20px] items-center">
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <h2 class="bb-breadcrumb-title font-Dana  leading-[1.2] text-[16px] font-bold text-[#3d4750] max-[767px]:text-center max-[767px]:mb-[10px]">بلاگ</h2>
                        </div>
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                                <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a href="{{route('home')}}" class="font-Poppins text-[14px]  font-semibold text-[#686e7d]">خانه</a></li>
                                <li class="text-[14px] font-normal px-[5px]"><i class="ri-arrow-left-double-fill text-[14px] font-semibold"></i></li>
                                <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] font-normal  px-[5px] active">بلاگ</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog-جزئیات -->
    <section class="section-blog-details py-[50px] max-[1199px]:py-[35px]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap mb-[-24px]">
                <div class="min-[1200px]:w-[66.66%] min-[992px]:w-[58.33%] w-full px-[12px] mb-[24px]">
                    <div class="bb-blog-details-contact" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                        <div class="inner-blog-details-image mb-[24px]">
                            @if($blog->image)
                                <img src="{{ asset('uploads/blogs/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full rounded-[15px]">
                            @endif
                        </div>
                        <div class="inner-blog-details-contact mb-[30px]">
                            <span class="font-Poppins mb-[6px] text-[15px] leading-[26px] font-light  text-[#777]"> {{ $blog->updated_at }}</span>
                            <h4 class="sub-title font-Dana  leading-[1.2] mb-[12px] text-[22px] font-bold text-[#3d4750] max-[575px]:text-[20px]">{{$blog->title}}</h4>
                            <p class="mb-[16px] font-Poppins text-[19px] text-[#686e7d] font-light text-justify">{!! nl2br(e($blog->content)) !!} </p>
                        </div>
                    </div>
                </div>
                <div class="min-[1200px]:w-[33.33%] min-[992px]:w-[41.66%] w-full px-[12px] mb-[24px]">
                    <div class="bb-blog-sidebar mb-[-24px]">
                        <div class="blog-inner-contact p-[30px] border-[1px] border-solid border-[#eee] mb-[24px] rounded-[20px] max-[575px]:p-[15px]" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                            <div class="blog-sidebar-title mb-[20px]">
                                <h4 class="font-Dana  leading-[1.2] text-[20px] font-bold text-[#3d4750] max-[575px]:text-[18px]">مقالات اخیر</h4>
                            </div>
                            @forelse($recentBlogs as $recentBlog)
                            <div class="blog-sidebar-card mb-[24px] p-[15px] bg-[#f8f8fb] border-[1px] border-solid border-[#eee] rounded-[20px] flex max-[991px]:flex-row max-[360px]:flex-col">
                                <div class="inner-image mr-[15px] max-[991px]:mr-[20px] max-[991px]:mb-[0] max-[360px]:mr-[0] max-[360px]:mb-[15px]">
                                    @if($recentBlog->image)
                                    <img src="{{ asset('uploads/blogs/' . $recentBlog->image) }}" alt="{{ $recentBlog->title }}" class="max-w-[80px] rounded-[20px] max-[360px]:max-w-full">
                                    @endif
                                </div>
                                <div class="blog-sidebar-contact">
                                    <h4 class="text-[15px] mb-[8px] leading-[1.2]"><a href="{{ route('blogs.singleBlog', $recentBlog->slug) }}" class="font-Poppins  text-[15px] font-medium leading-[18px] text-[#3d4750]">{{$recentBlog->title}}</a></h4>
                                    <p class="font-Poppins  text-[13px] leading-[16px] font-light text-[#686e7d]">{{$recentBlog->updated_at}}</p>
                                </div>
                            </div>
                            @empty
                                <span>مقاله موجود نیست</span>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
