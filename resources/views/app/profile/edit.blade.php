@extends('app.home.master')
@section('title',' پروفایل')
@section('content')

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
                                <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a href="index-2.html" class="font-Poppins text-[14px]  font-semibold text-[#686e7d]">خانه</a></li>
                                <li class="text-[14px] font-normal px-[5px]"><i class="ri-arrow-left-double-fill text-[14px] font-semibold"></i></li>
                                <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] font-normal  px-[5px] active">ثبت نام</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (session('success'))
        <div class="alert alert-success  p-[12px]" id="success-alert">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger  p-[12px]" id="error-alert">{{ session('error') }}</div>
    @endif


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
                                        <h2 class="bb-title font-Dana mb-[0] p-[0] text-[25px] font-bold text-[#3d4750] relative inline capitalize leading-[1]  max-[767px]:text-[23px]"> ویرایش</h2>
                                        <p class="font-Poppins max-w-[400px] mt-[10px] text-[14px] text-[#686e7d] leading-[18px] font-light  max-[991px]:mx-[auto]">برای ویرایش اطلاعات وارد کردن رمز عبور فعلی الزامی است</p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full px-[12px]">
                                <form action="{{route('user.profile.update',$user->id)}}" method="post" class="flex flex-wrap mx-[-12px]">
                                    @csrf
                                    @method('PUT')
                                    <div class="bb-register-wrap w-[50%] max-[575px]:w-full px-[12px] mb-[24px]">
                                        <label class="inline-block mb-[6px] text-[14px] leading-[18px] font-medium text-[#3d4750]">نام * </label>
                                        <input type="text" name="name" value="{{old('name',$user->name)}}" placeholder="نام" class="w-full p-[10px] text-[14px] font-normal text-[#686e7d] border-[1px] border-solid border-[#eee] outline-[0] leading-[26px] rounded-[10px]" required>
                                    </div>
                                    <div class="bb-register-wrap w-[50%] max-[575px]:w-full px-[12px] mb-[24px]">
                                        <label class="inline-block mb-[6px] text-[14px] leading-[18px] font-medium text-[#3d4750]"> نام کاربری *</label>
                                        <input type="text" name="username" value="{{old('username',$user->username)}}" placeholder="نام کاربری" class="w-full p-[10px] text-[14px] font-normal text-[#686e7d] border-[1px] border-solid border-[#eee] outline-[0] leading-[26px] rounded-[10px]" required>
                                    </div>

                                    <div class="bb-register-wrap w-[50%] max-[575px]:w-full px-[12px] mb-[24px]">
                                        <label class="inline-block mb-[6px] text-[14px] leading-[18px] font-medium text-[#3d4750]">پسورد فعلی*</label>
                                        <input type="password" name="current_password" placeholder="پسورد فعلی" class="w-full p-[10px] text-[14px] font-normal text-[#686e7d] border-[1px] border-solid border-[#eee] outline-[0] leading-[26px] rounded-[10px]" required>
                                    </div>
                                    <div class="bb-register-wrap w-[50%] max-[575px]:w-full px-[12px] mb-[24px]">
                                        <label class="inline-block mb-[6px] text-[14px] leading-[18px] font-medium text-[#3d4750]">پسورد*</label>
                                        <input type="password" name="password" placeholder="پسورد" class="w-full p-[10px] text-[14px] font-normal text-[#686e7d] border-[1px] border-solid border-[#eee] outline-[0] leading-[26px] rounded-[10px]" >
                                    </div>
                                    <div class="bb-register-wrap w-[50%] max-[575px]:w-full px-[12px] mb-[24px]">
                                        <label class="inline-block mb-[6px] text-[14px] leading-[18px] font-medium text-[#3d4750]">تکرار پسورد *</label>
                                        <input type="password" name="password_confirmation" placeholder="تکرار پسورد" class="w-full p-[10px] text-[14px] font-normal text-[#686e7d] border-[1px] border-solid border-[#eee] outline-[0] leading-[26px] rounded-[10px]" >
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

    <script>
        // مخفی کردن پیام‌های موفقیت و خطا پس از 3 ثانیه
        document.addEventListener('DOMContentLoaded', function () {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');

            if (successAlert) {
                setTimeout(() => {
                    successAlert.classList.add('fade-out');
                    setTimeout(() => {
                        successAlert.style.display = 'none';
                    }, 500); // مدت زمان انیمیشن محو شدن
                    successAlert.style.display = 'none';
                }, 3000);
            }

            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.classList.add('fade-out');
                    setTimeout(() => {
                        errorAlert.style.display = 'none';
                    }, 500); // مدت زمان انیمیشن محو شدن
                }, 3500); // 500 میلی‌ثانیه قبل از پایان 3 ثانیه
            }
        });
    </script>


    <style>
        /* استایل‌های بهبود یافته برای پیام‌های هشدار */
        .alert {
            padding: 15px 14px;
            margin: 14px 25px;
            border-radius: 12px;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 500;
            position: relative;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: opacity 0.5s ease-in-out;
            max-width: 40%; /* کاهش عرض پیام‌ها */
            width: 40%;
        }

        .alert-success {
            background-color: #e6f4ea;
            color: #2e7d32;
            border: 1px solid #a5d6a7;
        }

        .alert-danger {
            background-color: #fce4e4;
            color: #c62828;
            border: 1px solid #ef9a9a;
        }

        /* انیمیشن محو شدن */
        .alert.fade-out {
            opacity: 0;
        }

        /* اضافه کردن آیکون به پیام‌ها */
        /*.alert-success:before,*/
        /*.alert-danger:before {*/
        /*    font-family: 'RemixIcon'; !* فرض بر این است که از RemixIcon استفاده می‌کنید *!*/
        /*    position: absolute;*/
        /*    left: 20px;*/
        /*    top: 50%;*/
        /*    transform: translateY(-50%);*/
        /*    font-size: 18px;*/
        /*}*/

        /*.alert-success:before {*/
        /*    content: '\ea08'; !* کد آیکون موفقیت (چک‌مارک) در RemixIcon *!*/
        /*    color: #2e7d32;*/
        /*}*/

        /*.alert-danger:before {*/
        /*    content: '\ea0b'; !* کد آیکون خطا (هشدار) در RemixIcon *!*/
        /*    color: #c62828;*/
        /*}*/

        /* تنظیمات کلی جدول */
        /*.bb-cart-table {*/
        /*    width: 100%;*/
        /*    overflow-x: auto;*/
        /*}*/

        /*.bb-cart-table table {*/
        /*    border-collapse: collapse;*/
        /*    width: 100%;*/
        /*}*/

        /* ریسپانسیو کردن جدول برای صفحه‌نمایش‌های کوچک */
        @media screen and (max-width: 767px) {
            /*.bb-cart-table thead {*/
            /*    display: none;*/
            /*}*/

            /*.bb-cart-table tbody tr {*/
            /*    display: block;*/
            /*    margin-bottom: 15px;*/
            /*    border: 1px solid #eee;*/
            /*    border-radius: 10px;*/
            /*}*/

            /*.bb-cart-table tbody td {*/
            /*    display: block;*/
            /*    text-align: right;*/
            /*    padding: 10px;*/
            /*    position: relative;*/
            /*    border: none;*/
            /*}*/

            /*.bb-cart-table tbody td:before {*/
            /*    content: attr(data-label);*/
            /*    font-family: 'Poppins', sans-serif;*/
            /*    font-weight: 600;*/
            /*    color: #3d4750;*/
            /*    display: inline-block;*/
            /*    width: 40%;*/
            /*    padding-left: 10px;*/
            /*}*/

            /*.bb-cart-table tbody td .Product-cart {*/
            /*    display: flex;*/
            /*    align-items: center;*/
            /*}*/

            /*.bb-cart-table tbody td .qty-plus-minus {*/
            /*    margin: 0 auto;*/
            /*}*/

            /*.bb-cart-table tbody td .pro-remove {*/
            /*    text-align: center;*/
            /*}*/

            /* تنظیم پیام‌ها در موبایل */
            .alert {
                font-size: 14px;
                padding: 12px 18px;
            }
        }

        /* تنظیمات برای دسکتاپ */
        /*@media screen and (min-width: 768px) {*/
        /*    .bb-cart-table tbody tr {*/
        /*        display: table-row;*/
        /*    }*/

        /*    .bb-cart-table tbody td {*/
        /*        display: table-cell;*/
        /*        text-align: right;*/
        /*    }*/
        /*}*/
    </style>
@endsection
