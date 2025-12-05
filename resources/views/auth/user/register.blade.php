@extends('app.home.master')
@section('title','ثبت نام')
@section('content')

    @if (session('error'))
        <div class="alert alert-success">
            {{ session('error') }}
        </div>
    @endif
    <!-- Breadcrumb -->
    <section class="section-breadcrumb mb-[50px] max-[1199px]:mb-[35px] border-b-[1px] border-solid border-[#eee] bg-[#f8f8fb]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="flex flex-wrap w-full bb-breadcrumb-inner m-[0] py-[20px] items-center">
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <h2 class="bb-breadcrumb-title font-Dana  leading-[1.2] text-[16px] font-bold text-[#3d4750] max-[767px]:text-center max-[767px]:mb-[10px]">ثبت نام</h2>
                        </div>
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                                <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a href="{{route('home')}}" class="font-Poppins text-[14px]  font-semibold text-[#686e7d]">خانه</a></li>
                                <li class="text-[14px] font-normal px-[5px]"><i class="ri-arrow-left-double-fill text-[14px] font-semibold"></i></li>
                                <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] font-normal  px-[5px] active">ثبت نام</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Register -->
    <section class="section-register py-[50px] max-[1199px]:py-[35px]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full">
                    <div class="bb-register border-[1px] border-solid p-[30px] rounded-[20px]" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                        <div class="flex flex-wrap">
                            <div class="w-full px-[12px]">
                                <div class="section-title mb-[20px] pb-[20px] z-[5] relative flex flex-col items-center text-center max-[991px]:pb-[0]">
                                    <div class="section-detail max-[991px]:mb-[12px]">
                                        <h2 class="bb-title font-Dana mb-[0] p-[0] text-[25px] font-bold text-[#3d4750] relative inline capitalize leading-[1]  max-[767px]:text-[23px]">ثبت نام</h2>
                                        <p class="font-Poppins max-w-[400px] mt-[10px] text-[14px] text-[#686e7d] leading-[18px] font-light  max-[991px]:mx-[auto]">بهترین مکان برای خرید و فروش تجهیزات پزشکی</p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full px-[12px]">
                                <form action="{{route('user.register.store')}}" method="post" class="flex flex-wrap mx-[-12px]">
                                    @csrf
                                    <div class="bb-register-wrap w-[50%] max-[575px]:w-full px-[12px] mb-[24px]">
                                        <label class="inline-block mb-[6px] text-[14px] leading-[18px] font-medium text-[#3d4750]">نام و نام خانوادگی * </label>
                                        <input type="text" name="name" placeholder="نام و نام خانوادگی" class="w-full p-[10px] text-[14px] font-normal text-[#686e7d] border-[1px] border-solid border-[#eee] outline-[0] leading-[26px] rounded-[10px]" required>
                                    </div>
                                    <div class="bb-register-wrap w-[50%] max-[575px]:w-full px-[12px] mb-[24px]">
                                        <label class="inline-block mb-[6px] text-[14px] leading-[18px] font-medium text-[#3d4750]"> نام کاربری *</label>
                                        <input type="text" name="username" placeholder="نام کاربری" class="w-full p-[10px] text-[14px] font-normal text-[#686e7d] border-[1px] border-solid border-[#eee] outline-[0] leading-[26px] rounded-[10px]" required>
                                    </div>

                                    <div class="bb-register-wrap w-[50%] max-[575px]:w-full px-[12px] mb-[24px]">
                                        <label class="inline-block mb-[6px] text-[14px] leading-[18px] font-medium text-[#3d4750]">رمز عبور *</label>
                                        <input type="password" name="password" placeholder="رمز عبور" class="w-full p-[10px] text-[14px] font-normal text-[#686e7d] border-[1px] border-solid border-[#eee] outline-[0] leading-[26px] rounded-[10px]" required>
                                    </div>
                                    <div class="bb-register-wrap w-[50%] max-[575px]:w-full px-[12px] mb-[24px]">
                                        <label class="inline-block mb-[6px] text-[14px] leading-[18px] font-medium text-[#3d4750]">تکرار رمز عبور *</label>
                                        <input type="password" name="password_confirmation" placeholder="تکرار رمز عبور" class="w-full p-[10px] text-[14px] font-normal text-[#686e7d] border-[1px] border-solid border-[#eee] outline-[0] leading-[26px] rounded-[10px]" required>
                                    </div>
                                    <div class="bb-register-button w-full flex justify-center">
                                        <button type="submit" class="bb-btn-2 transition-all duration-[0.3s] ease-in-out font-Poppins  py-[4px] px-[20px] text-[14px] font-normal text-[#fff] bg-[#6c7fd8] rounded-[10px] border-[1px] border-solid border-[#6c7fd8] hover:bg-transparent hover:border-[#3d4750] hover:text-[#3d4750]">ثبت نام</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
