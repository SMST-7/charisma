@extends('app.home.master')
@section('title','ورود')
@section('content')

<!-- Breadcrumb -->
<section class="section-breadcrumb mb-[50px] max-[1199px]:mb-[35px] border-b-[1px] border-solid border-[#eee] bg-[#f8f8fb]">
    <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
        <div class="flex flex-wrap w-full">
            <div class="w-full px-[12px]">
                <div class="flex flex-wrap w-full bb-breadcrumb-inner m-[0] py-[20px] items-center">
                    <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                        <h2 class="bb-breadcrumb-title font-Dana  leading-[1.2] text-[16px] font-bold text-[#3d4750] max-[767px]:text-center max-[767px]:mb-[10px]">ورود</h2>
                    </div>
                    <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                        <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                            <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a href="{{route('home')}}" class="font-Poppins text-[14px]  font-semibold text-[#686e7d]">خانه</a></li>
                            <li class="text-[14px] font-normal px-[5px]"><i class="ri-arrow-left-double-fill text-[14px] font-semibold"></i></li>
                            <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] font-normal  px-[5px] active">ورود</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Login -->
<section class="section-login py-[50px] max-[1199px]:py-[35px]">
    <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
        <div class="flex flex-wrap w-full">
            <div class="w-full px-[12px]">
                <div class="section-title mb-[20px] pb-[20px] relative flex flex-col items-center text-center max-[991px]:pb-[0]" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="section-detail max-[991px]:mb-[12px]">
                        <h2 class="bb-title font-Dana mb-[0] p-[0] text-[25px] font-bold text-[#3d4750] relative inline capitalize leading-[1]  max-[767px]:text-[23px]"> <span class="text-[#6c7fd8]">ورود</span></h2>
                        <p class="font-Poppins max-w-[400px] mt-[10px] text-[14px] text-[#686e7d] leading-[18px] font-light  max-[991px]:mx-[auto]">بهترین مکان برای خرید و فروش تجهیزات پزشکی </p>
                    </div>
                </div>
            </div>
            <div class="w-full px-[12px]">
                <div class="bb-login-contact max-w-[500px] m-[auto] border-[1px] border-solid border-[#eee] p-[30px] rounded-[20px]" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                    <form action="{{route('user.login.store')}}" method="post">
                        @csrf
                        <div class="bb-login-wrap mb-[24px]">
                            <label for="username" class="inline-block font-Poppins text-[15px] font-normal text-[#686e7d] leading-[26px] " >نام کاربری *</label>
                            <input type="text" id="username" name="username" placeholder="نام کاربری" class="w-full p-[10px] text-[14px] font-normal text-[#686e7d] border-[1px] border-solid border-[#eee] outline-[0] leading-[26px] rounded-[10px]" required>
                        </div>
                        <div class="bb-login-wrap mb-[24px]">
                            <label for="email" class="inline-block font-Poppins text-[15px] font-normal text-[#686e7d] leading-[26px] ">رمز عبور *</label>
                            <input type="password" id="password" name="password" placeholder="رمز عبور" class="w-full p-[10px] text-[14px] font-normal text-[#686e7d] border-[1px] border-solid border-[#eee] outline-[0] leading-[26px] rounded-[10px]" required>
                        </div>
                        <div class="bb-login-wrap mb-[24px]">
                            <a href="javascript:void(0)" class="font-Poppins  text-[14px] font-medium text-[#777]">فراموشی رمز عبور</a>
                        </div>
                        <div class="bb-login-button m-[-5px] flex justify-between">
                            <button class="bb-btn-2 transition-all duration-[0.3s] ease-in-out font-Poppins  m-[5px] py-[4px] px-[20px] text-[14px] font-normal text-[#fff] bg-[#6c7fd8] rounded-[10px] border-[1px] border-solid border-[#6c7fd8] hover:bg-transparent hover:border-[#3d4750] hover:text-[#3d4750]" type="submit">ورود</button>
                            <a href="{{route('user.register')}}" class="h-[36px] m-[5px] flex items-center font-Poppins text-[15px] text-[#686e7d] font-light ">ثبت نام</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
