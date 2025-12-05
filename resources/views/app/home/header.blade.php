<!DOCTYPE html>
<html lang="fa" dir="rtl">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Blueberry - Multi Purpose eCommerce Template.">
    <meta name="keywords"
          content="eCommerce, mart, apparel, catalog, fashion, Tailwind, multipurpose, online store, shop, store, template">
    <title>@yield('title')</title>


    <!-- Site Favicon -->
    <link rel="icon" href="{{ asset($setting->favicon)}}" type="image/x-icon">

    <!-- Css All Plugins Files -->
    <link rel="stylesheet" href="{{ asset('app/css/vendor/remixicon.css')}}">
    <link rel="stylesheet" href="{{ asset('app/css/vendor/aos.css')}}">
    <link rel="stylesheet" href="{{ asset('app/css/vendor/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{ asset('app/css/vendor/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('app/css/vendor/slick.min.css')}}">
    <link rel="stylesheet" href="{{ asset('app/css/vendor/animate.min.css')}}">
    <link rel="stylesheet" href="{{ asset('app/css/vendor/jquery-range-ui.css')}}">

    <!-- tailwindcss -->
    <script src="{{ asset('app/js/vendor/tailwindcss3.4.5.js')}}"></script>

    <!-- Bootstrap css-->
    <link rel="stylesheet" href="{{ asset('app/css/vendor/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('app/css/vendor/bootstrap.css') }}">

    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('app/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('app/css/rtl.css')}}">
    {{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

</head>

<body>

<!-- Header -->
<header class="bb-header relative z-[5] border-b-[1px] border-solid border-[#eee]">


    <div class="bottom-header py-[20px] max-[991px]:py-[15px]">
        <div
            class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="inner-bottom-header flex justify-between max-[767px]:flex-col">
                        <div class="cols bb-logo-detail flex max-[767px]:justify-between">
                            <!-- Header Logo Start -->
                            <div class="header-logo flex items-center justify-center md:justify-start">
                                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                                    @if(!empty($setting?->logo) && file_exists(public_path($setting->logo)))
                                        <img src="{{ asset($setting->logo) }}" alt="footer logo"
                                             class="bb-footer-logo max-w-[115px] w-full h-auto rounded-md shadow-sm transition-transform duration-300 hover:scale-105 object-contain"
                                             loading="lazy">
                                    @else
                                        <span class="text-xl font-bold text-gray-800 dark:text-gray-100 group-hover:text-primary transition-colors duration-300">
                {{ $setting->store_name ?? 'فروشگاه من' }}
            </span>
                                    @endif
                                </a>
                            </div>



                            <!-- Header Logo End -->

                            <a href="javascript:void(0)"
                               class="bb-sidebar-toggle bb-category-toggle hidden max-[991px]:flex max-[991px]:items-center max-[991px]:ml-[20px] max-[991px]:border-[1px] max-[991px]:border-solid max-[991px]:border-[#eee] max-[991px]:w-[40px] max-[991px]:h-[40px] max-[991px]:rounded-[15px] justify-center transition-all duration-[0.3s] ease-in-out  text-[15px] text-[#686e7d] font-light ">
                                <svg class="svg-icon h-[30px] w-[30px] max-[991px]:w-[22px] max-[991px]:h-[22px]"
                                     viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <path class="fill-[#6c7fd8]"
                                          d="M384 928H192a96 96 0 0 1-96-96V640a96 96 0 0 1 96-96h192a96 96 0 0 1 96 96v192a96 96 0 0 1-96 96zM192 608a32 32 0 0 0-32 32v192a32 32 0 0 0 32 32h192a32 32 0 0 0 32-32V640a32 32 0 0 0-32-32H192zM784 928H640a96 96 0 0 1-96-96V640a96 96 0 0 1 96-96h192a96 96 0 0 1 96 96v144a32 32 0 0 1-64 0V640a32 32 0 0 0-32-32H640a32 32 0 0 0-32 32v192a32 32 0 0 0 32 32h144a32 32 0 0 1 0 64zM384 480H192a96 96 0 0 1-96-96V192a96 96 0 0 1 96-96h192a96 96 0 0 1 96 96v192a96 96 0 0 1-96 96zM192 160a32 32 0 0 0-32 32v192a32 32 0 0 0 32 32h192a32 32 0 0 0 32-32V192a32 32 0 0 0-32-32H192zM832 480H640a96 96 0 0 1-96-96V192a96 96 0 0 1 96-96h192a96 96 0 0 1 96 96v192a96 96 0 0 1-96 96zM640 160a32 32 0 0 0-32 32v192a32 32 0 0 0 32 32h192a32 32 0 0 0 32-32V192a32 32 0 0 0-32-32H640z" />
                                </svg>
                            </a>
                        </div>
                        <div class="cols flex justify-center">
                            <div
                                class="header-search w-[600px] max-[1399px]:w-[500px] max-[1199px]:w-[400px] max-[991px]:w-full max-[991px]:min-w-[300px] max-[767px]:py-[15px] max-[480px]:min-w-[auto]">
                                @yield('search')

                            </div>
                        </div>
                        <div class="cols bb-icons flex justify-center">
                            <div class="bb-flex-justify max-[575px]:flex max-[575px]:justify-between">
                                <div class="bb-header-buttons h-full flex justify-end items-center">
                                    <div class="bb-acc-drop relative">
                                        <a href="javascript:void(0)"
                                           class="bb-header-btn bb-header-user dropdown-toggle bb-user-toggle transition-all duration-[0.3s] ease-in-out relative flex w-[auto] items-center whitespace-nowrap ml-[30px] max-[1199px]:ml-[20px] max-[767px]:ml-[0]"
                                           title="حساب کاربری">
                                            <div class="header-icon relative flex">
                                                <svg class="svg-icon w-[30px] h-[30px] max-[1199px]:w-[25px] max-[1199px]:h-[25px] max-[991px]:w-[22px] max-[991px]:h-[22px]"
                                                     viewBox="0 0 1024 1024" version="1.1"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path class="fill-[#6c7fd8]"
                                                          d="M512.476 648.247c-170.169 0-308.118-136.411-308.118-304.681 0-168.271 137.949-304.681 308.118-304.681 170.169 0 308.119 136.411 308.119 304.681C820.594 511.837 682.645 648.247 512.476 648.247L512.476 648.247zM512.476 100.186c-135.713 0-246.12 109.178-246.12 243.381 0 134.202 110.407 243.381 246.12 243.381 135.719 0 246.126-109.179 246.126-243.381C758.602 209.364 648.195 100.186 512.476 100.186L512.476 100.186zM935.867 985.115l-26.164 0c-9.648 0-17.779-6.941-19.384-16.35-2.646-15.426-6.277-30.52-11.142-44.95-24.769-87.686-81.337-164.13-159.104-214.266-63.232 35.203-134.235 53.64-207.597 53.64-73.555 0-144.73-18.537-208.084-53.922-78 50.131-134.75 126.68-159.564 214.549 0 0-4.893 18.172-11.795 46.4-2.136 8.723-10.035 14.9-19.112 14.9L88.133 985.116c-9.415 0-16.693-8.214-15.47-17.452C91.698 824.084 181.099 702.474 305.51 637.615c58.682 40.472 129.996 64.267 206.966 64.267 76.799 0 147.968-23.684 206.584-63.991 124.123 64.932 213.281 186.403 232.277 329.772C952.56 976.901 945.287 985.115 935.867 985.115L935.867 985.115z" />
                                                </svg>
                                            </div>
                                            <div class="bb-btn-desc flex flex-col ml-[10px] max-[1199px]:hidden">
                                                    <span
                                                        class="bb-btn-title  transition-all duration-[0.3s] ease-in-out text-[12px] leading-[1] text-[#3d4750] mb-[4px]  capitalize font-medium whitespace-nowrap">حساب
                                                        کاربری</span>
                                                <span
                                                    class="bb-btn-stitle  transition-all duration-[0.3s] ease-in-out text-[14px] leading-[16px] font-semibold text-[#3d4750]   whitespace-nowrap">ورود</span>
                                            </div>
                                        </a>
                                        <ul class="bb-dropdown-menu min-w-[150px] py-[10px] px-[5px] transition-all duration-[0.3s] ease-in-out mt-[25px] absolute z-[16] text-left opacity-[0] right-[auto] bg-[#fff] border-[1px] border-solid border-[#eee] block rounded-[10px]">
                                            @guest
                                                <li class="py-[4px] px-[15px] m-[0] text-[15px] text-[#686e7d] font-light">
                                                    <a class="dropdown-item transition-all duration-[0.3s] ease-in-out text-[13px] hover:text-[#6c7fd8] leading-[22px] block w-full font-normal" href="{{ route('user.register') }}">ثبت‌نام</a>
                                                </li>
                                                <li class="py-[4px] px-[15px] m-[0] text-[15px] text-[#686e7d] font-light">
                                                    <a class="dropdown-item transition-all duration-[0.3s] ease-in-out text-[13px] hover:text-[#6c7fd8] leading-[22px] block w-full font-normal" href="{{ route('user.login') }}">ورود</a>
                                                </li>
                                            @endguest
                                            @auth

                                                @if(Auth::user()->isAdmin())
                                                    <li class=" text-right py-[4px] px-[15px] m-[0] text-[13px] text-[#686e7d] font-light">
                                                        <p>خوش امدی {{Auth::user()->name}}</p>
                                                    </li>
                                                    <li class="py-[4px] px-[15px] m-[0] text-[15px] text-[#686e7d] font-light">

                                                        <form action="{{ route('logout') }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="text-right dropdown-item transition-all duration-[0.3s] ease-in-out text-[13px] hover:text-[#6c7fd8] leading-[22px] block w-full font-normal text-left">خروج</button>
                                                        </form>
                                                    </li>
                                                @else
                                                    <li class="py-[4px] px-[15px] m-[0] text-[15px] text-[#686e7d] font-light">
                                                        <a class="dropdown-item transition-all duration-[0.3s] ease-in-out text-[13px] hover:text-[#6c7fd8] leading-[22px] block w-full font-normal" href="{{ route('user.profile') }}">پروفایل</a>
                                                    </li>
                                                    <li class="py-[4px] px-[15px] m-[0] text-[15px] text-[#686e7d] font-light">
                                                        <form action="{{ route('logout') }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item transition-all duration-[0.3s] ease-in-out text-[13px] hover:text-[#6c7fd8] leading-[22px] block w-full font-normal text-left">خروج</button>
                                                        </form>
                                                    </li>
                                                @endif
                                            @endauth
                                        </ul>
                                    </div>
                                    <a href="{{route('wishlist.index')}}"
                                       class="bb-header-btn bb-wish-toggle transition-all duration-[0.3s] ease-in-out relative flex w-[auto] items-center ml-[30px] max-[1199px]:ml-[20px]"
                                       title="مورد علاقه">
                                        <div class="header-icon relative flex">
                                            <svg class="svg-icon w-[30px] h-[30px] max-[1199px]:w-[25px] max-[1199px]:h-[25px] max-[991px]:w-[22px] max-[991px]:h-[22px]"
                                                 viewBox="0 0 1024 1024" version="1.1"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path class="fill-[#6c7fd8]"
                                                      d="M512 128l121.571556 250.823111 276.366222 39.111111-199.281778 200.504889L756.622222 896 512 769.536 267.377778 896l45.852444-277.617778-199.111111-200.504889 276.366222-39.111111L512 128m0-56.888889a65.962667 65.962667 0 0 0-59.477333 36.807111l-102.940445 213.703111-236.828444 35.214223a65.422222 65.422222 0 0 0-52.366222 42.979555 62.577778 62.577778 0 0 0 15.274666 64.967111l173.511111 173.340445-40.248889 240.355555a63.374222 63.374222 0 0 0 26.993778 62.577778 67.242667 67.242667 0 0 0 69.632 3.726222L512 837.290667l206.478222 107.605333a67.356444 67.356444 0 0 0 69.688889-3.726222 63.374222 63.374222 0 0 0 26.908445-62.577778l-40.277334-240.355556 173.511111-173.340444a62.577778 62.577778 0 0 0 15.246223-64.967111 65.422222 65.422222 0 0 0-52.366223-42.979556l-236.8-35.214222-102.968889-213.703111A65.848889 65.848889 0 0 0 512 71.111111z"
                                                      fill="#364C58" />
                                            </svg>
                                        </div>
                                        <div class="bb-btn-desc flex flex-col ml-[10px] max-[1199px]:hidden">
                                         <span class="bb-btn-title text-[12px] mb-[4px] capitalize font-medium whitespace-nowrap">
    @if($wishlistCount > 0)
                                                 <b class="bb-wishlist-count">{{ $wishlistCount }}</b> مورد
                                             @else
                                                 <span class="text-gray-500">موردی وجود ندارد </span>
                                             @endif
</span>

                                            <span
                                                class="bb-btn-stitle  transition-all duration-[0.3s] ease-in-out text-[14px] leading-[16px] font-semibold text-[#3d4750]   whitespace-nowrap">مورد
                                                    علاقه</span>
                                        </div>
                                    </a>
                                    <a href="{{route('cart.index')}}"
                                       class="bb-header-btn bb-wish-toggle transition-all duration-[0.3s] ease-in-out relative flex w-[auto] items-center ml-[30px] max-[1199px]:ml-[20px]"
                                       title="سبد خرید">
                                        <div class="header-icon relative flex">
                                            <svg class="svg-icon w-[30px] h-[30px] max-[1199px]:w-[25px] max-[1199px]:h-[25px] max-[991px]:w-[22px] max-[991px]:h-[22px]"
                                                 viewBox="0 0 24 24" version="1.1"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path class="fill-[#6c7fd8]"
                                                      d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM17 18c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zM2 2v2h1l3.6 7.59-1.35 2.44c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49A1.003 1.003 0 0 0 20 3H6.21l-.94-2H2zm16 2.43l-3.58 6.49c-.14.26-.43.41-.71.41H6.42l-2.83-6H18.43z"
                                                      fill="#364C58" />
                                            </svg>
                                        </div>
                                        <div class="bb-btn-desc flex flex-col ml-[10px] max-[1199px]:hidden">
                                           <span class="bb-btn-title text-[12px] mb-[4px] capitalize font-medium whitespace-nowrap">
    @if($cartCount > 0)
                                                   <b class="bb-cart-count">{{ $cartCount }}</b> مورد
                                               @else
                                                   <span class="text-gray-500">سبد خرید خالی است</span>
                                               @endif
</span>

                                            <span class="bb-btn-stitle transition-all duration-[0.3s] ease-in-out text-[14px] leading-[16px] font-semibold text-[#3d4750] whitespace-nowrap">
                                                سبد خرید
                                            </span>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)"
                                       class="bb-toggle-menu hidden max-[991px]:flex max-[991px]:ml-[20px]">
                                        <div class="header-icon">
                                            <i class="ri-menu-3-fill text-[22px] text-[#6c7fd8]"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        /* پدرها اجازه بدهند dropdown بیرون بیاید */
        .bb-main-menu-desk,
        .bb-main-menu {
            position: relative !important;
            overflow: visible !important;
            z-index: 15 !important;
            /* z-index: 50 !important; */

        }

        /* dropdown ها بالاتر از همه */
        .bb-dropdown-menu,
        .bb-mega-menu {
            z-index: 9999 !important;
        }

        /* انیمیشن قابل پیش‌بینی */
        .bb-dropdown-menu {
            top: 40px;
            transition: all 0.3s ease;
        }

        .bb-dropdown:hover .bb-dropdown-menu {
            opacity: 1;
            visibility: visible;
            top: 45px;
        }

        .bb-mega-menu {
            top: 0;
            transition: all 0.3s ease;
        }

        .bb-dropdown:hover .bb-dropdown-menu {
            opacity: 1 !important;
            visibility: visible !important;
        }

        .bb-mega-dropdown:hover .bb-mega-menu {
            opacity: 1 !important;
            visibility: visible !important;
        }
    </style>

    <div class="bb-main-menu-desk bg-white py-[5px] border-t border-[#eee] max-[991px]:hidden">
        <div class="flex flex-wrap justify-between items-center mx-auto
            min-[1400px]:max-w-[1320px]
            min-[1200px]:max-w-[1140px]
            min-[992px]:max-w-[960px]
            min-[768px]:max-w-[720px]
            min-[576px]:max-w-[540px]">

            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="bb-inner-menu-desk flex">

                        <div class="bb-main-menu flex flex-auto justify-start">
                            <ul class="navbar-nav flex flex-row flex-wrap">

                                <!-- خانه -->
                                <li class="nav-item flex items-center mr-[35px]">
                                    <a class="nav-link flex items-center text-[15px] font-medium text-[#3d4750] hover:text-[#6c7fd8] transition"
                                       href="{{ route('home') }}">
                                        خانه
                                    </a>
                                </li>

                                <!-- محصولات -->
                                <li class="nav-item flex items-center relative mr-[45px] bb-dropdown">
                                    <a class="nav-link flex items-center text-[15px] font-medium text-[#3d4750] hover:text-[#6c7fd8] transition"
                                       href="{{ route('offer.index') }}">
                                        محصولات
                                    </a>
                                </li>

                                <!-- دسته‌بندی‌ها -->
                                <li class="nav-item flex items-center relative mr-[45px] bb-dropdown">
                                    <a class="nav-link flex items-center text-[15px] font-medium text-[#3d4750] hover:text-[#6c7fd8] transition"
                                       href="javascript:void(0)">
                                        دسته‌بندی‌ها
                                    </a>

                                    <ul class="bb-dropdown-menu p-[10px] mt-[25px] absolute opacity-0 invisible
                                       bg-white border border-[#eee] rounded-[10px] min-w-[220px] shadow-lg">
                                        @foreach($headerCategories as $cat)
                                            <li class="relative py-[5px] px-[15px] bb-mega-dropdown group">
                                                <a class="bb-mega-item flex items-center text-[14px] text-[#686e7d] hover:text-[#6c7fd8]"
                                                   href="{{ route('app.category.show', $cat->slug) }}">
                                                    <span class="w-1 h-1 bg-[#6c7fd8] rounded-full ml-2 opacity-0 group-hover:opacity-100 transition"></span>
                                                    {{ $cat->title }}
                                                </a>

                                                @if($cat->children->count())
                                                    <ul class="bb-mega-menu p-[10px] absolute top-0 left-[200px]
                                                       opacity-0 invisible group-hover:opacity-100 group-hover:visible
                                                       bg-white border border-[#eee] rounded-[10px] min-w-[200px] shadow-lg">
                                                        @foreach($cat->children as $child)
                                                            <li class="relative py-[5px] px-[15px]">
                                                                <a class="dropdown-item text-[14px] text-[#686e7d] hover:text-[#6c7fd8]"
                                                                   href="{{ route('app.category.show', $child->slug) }}">
                                                                    {{ $child->title }}
                                                                </a>

                                                                @if($child->children->count())
                                                                    <ul class="bb-mega-menu p-[10px] absolute top-0 left-[200px]
                                                                       opacity-0 invisible hover:opacity-100 hover:visible
                                                                       bg-white border border-[#eee] rounded-[10px] min-w-[200px] shadow-lg">
                                                                        @foreach($child->children as $grandchild)
                                                                            <li class="py-[5px] px-[15px]">
                                                                                <a class="dropdown-item text-[14px] text-[#686e7d] hover:text-[#6c7fd8]"
                                                                                   href="{{ route('app.category.show', $grandchild->slug) }}">
                                                                                    {{ $grandchild->title }}
                                                                                </a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <!-- مقالات -->
                                <li class="nav-item flex items-center mr-[45px] bb-dropdown">
                                    <a class="nav-link flex items-center text-[15px] font-medium text-[#3d4750] hover:text-[#6c7fd8] transition"
                                       href="{{ route('app.blogs.index') }}">
                                        مقالات
                                    </a>

                                    <ul class="bb-dropdown-menu p-[10px] mt-[25px] absolute opacity-0 invisible
                                       bg-white border border-[#eee] rounded-[10px] min-w-[220px] shadow-lg">
                                        @foreach($headerBlogs as $blog)
                                            <li class="py-[5px] px-[15px]">
                                                <a class="dropdown-item text-[14px] text-[#686e7d] hover:text-[#6c7fd8]"
                                                   href="{{ route('blogs.singleBlog', $blog->slug) }}">
                                                    {{ $blog->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                        <li class="py-[5px] px-[15px] border-t border-[#eee] mt-2 pt-2">
                                            <a class="dropdown-item text-[14px] text-[#6c7fd8] font-medium"
                                               href="{{ route('app.blogs.index') }}">مشاهده همه مقالات</a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item flex items-center mr-[35px]">
                                    <a class="nav-link flex items-center text-[15px] font-medium text-[#3d4750] hover:text-[#6c7fd8] transition"
                                       href="{{ route('discountedproduct.index') }}">
                                        تخفیف ها
                                    </a>
                                </li>

                                <!-- درباره ما -->
                                <li class="nav-item flex items-center mr-[35px]">
                                    <a class="nav-link flex items-center text-[15px] font-medium text-[#3d4750] hover:text-[#6c7fd8] transition"
                                       href="{{ route('about.index') }}">
                                        درباره ما
                                    </a>
                                </li>

                                <!-- تماس با ما -->
                                <li class="nav-item flex items-center mr-[35px]">
                                    <a class="nav-link flex items-center text-[15px] font-medium text-[#3d4750] hover:text-[#6c7fd8] transition"
                                       href="{{ route('create-contact') }}">
                                        تماس با ما
                                    </a>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--mobile--}}
    <div class="bb-mobile-menu-overlay hidden w-full h-screen fixed top-[0] left-[0] bg-[#000000cc] z-[16]"></div>
    <div id="bb-mobile-menu"
         class="bb-mobile-menu transition-all duration-[0.3s] ease-in-out w-[340px] h-full pt-[15px] px-[20px] pb-[20px] fixed top-[0] right-[auto] right-[0] bg-[#fff] translate-x-[100%] flex flex-col z-[17] overflow-auto max-[480px]:w-[300px]">
        <div class="bb-menu-title w-full pb-[10px] flex flex-wrap justify-between">
            <span class="menu_title flex items-center text-[16px] text-[#3d4750] font-semibold leading-[26px]">منو</span>
            <button type="button" class="bb-close-menu relative border-[0] text-[30px] leading-[1] text-[#ff0000] bg-transparent">×</button>
        </div>

        <div class="bb-menu-inner">
            <div class="bb-menu-content">
                <ul>

                    <!-- خانه -->
                    <li class="relative">
                        <a href="{{ route('home') }}"
                           class="transition-all duration-[0.3s] ease-in-out mb-[12px] p-[12px] block capitalize text-[#686e7d] border-[1px] border-solid border-[#eee] rounded-[10px] text-[15px] font-medium">
                            خانه
                        </a>
                    </li>

                    <!-- محصولات -->
                    <li class="relative">
                        <a href="{{ route('offer.index') }}"
                           class="transition-all duration-[0.3s] ease-in-out mb-[12px] p-[12px] block capitalize text-[#686e7d] border-[1px] border-solid border-[#eee] rounded-[10px] text-[15px] font-medium">
                            محصولات
                        </a>
                    </li>

                    <!-- دسته‌بندی‌ها (داینامیک) -->
                    <li class="relative">
                        <a href="javascript:void(0)"
                           class="transition-all duration-[0.3s] ease-in-out mb-[12px] p-[12px] block capitalize text-[#686e7d] border-[1px] border-solid border-[#eee] rounded-[10px] text-[15px] font-medium">
                            دسته‌بندی‌ها
                        </a>

                        <ul class="sub-menu w-full min-w-[auto] p-[0] mb-[10px] static hidden">
                            @foreach($headerCategories as $cat)
                                <li class="relative">
                                    <a href="{{ route('app.category.show', $cat->slug) }}"
                                       class="transition-all duration-[0.3s] ease-in-out mb-[0] pl-[15px] pr-[0] py-[12px] capitalize block text-[14px] font-normal text-[#686e7d]">
                                        {{ $cat->title }}
                                    </a>

                                    @if($cat->children->count())
                                        <ul class="sub-menu w-full min-w-[auto] p-[0] mb-[10px] static hidden">
                                            @foreach($cat->children as $child)
                                                <li class="relative">
                                                    <a href="{{ route('app.category.show', $child->slug) }}"
                                                       class="transition-all duration-[0.3s] ease-in-out mb-[0] pl-[30px] pr-[0] py-[12px] capitalize block text-[14px] font-normal text-[#777]">
                                                        {{ $child->title }}
                                                    </a>

                                                    @if($child->children->count())
                                                        <ul class="sub-menu w-full min-w-[auto] p-[0] mb-[10px] static hidden">
                                                            @foreach($child->children as $grandchild)
                                                                <li class="relative">
                                                                    <a href="{{ route('app.category.show', $grandchild->slug) }}"
                                                                       class="transition-all duration-[0.3s] ease-in-out mb-[0] pl-[45px] pr-[0] py-[10px] capitalize block text-[13px] font-normal text-[#888]">
                                                                        {{ $grandchild->title }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <!-- مقالات -->
                    <li class="relative">
                        <a href="{{ route('app.blogs.index') }}"
                           class="transition-all duration-[0.3s] ease-in-out mb-[12px] p-[12px] block capitalize text-[#686e7d] border-[1px] border-solid border-[#eee] rounded-[10px] text-[15px] font-medium">
                            مقالات
                        </a>

                        <ul class="sub-menu w-full min-w-[auto] p-[0] mb-[10px] static hidden">
                            @foreach($headerBlogs as $blog)
                                <li class="relative">
                                    <a href="{{ route('blogs.singleBlog', $blog->slug) }}"
                                       class="transition-all duration-[0.3s] ease-in-out mb-[0] pl-[15px] pr-[0] py-[12px] capitalize block text-[14px] font-normal text-[#686e7d]">
                                        {{ $blog->title }}
                                    </a>
                                </li>
                            @endforeach
                            <li class="relative border-t border-[#eee] mt-[8px] pt-[8px]">
                                <a href="{{ route('app.blogs.index') }}"
                                   class="transition-all duration-[0.3s] ease-in-out mb-[0] pl-[15px] pr-[0] py-[10px] capitalize block text-[14px] font-medium text-[#6c7fd8]">
                                    مشاهده همه مقالات
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- درباره ما -->
                    <li class="relative">
                        <a href="{{ route('about.index') }}"
                           class="transition-all duration-[0.3s] ease-in-out mb-[12px] p-[12px] block capitalize text-[#686e7d] border-[1px] border-solid border-[#eee] rounded-[10px] text-[15px] font-medium">
                            درباره ما
                        </a>
                    </li>

                    <!-- تماس با ما -->
                    <li class="relative">
                        <a href="{{ route('contactus.create') }}"
                           class="transition-all duration-[0.3s] ease-in-out mb-[12px] p-[12px] block capitalize text-[#686e7d] border-[1px] border-solid border-[#eee] rounded-[10px] text-[15px] font-medium">
                            تماس با ما
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>


</header>
