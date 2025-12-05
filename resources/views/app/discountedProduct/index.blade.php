@extends('app.home.master')
@section('title','تخفیف ها')

@section('search')
    <form class="bb-btn-group-form flex relative max-[991px]:ml-[20px] max-[767px]:m-[0]" id="searchForm" action="{{ route('discountedproduct.index') }}">
        <div class="inner-select border-r-[1px] border-solid border-[#eee] h-full px-[20px] flex items-center absolute top-[0] left-[0] max-[991px]:hidden">
            <div class="custom-select w-[100px] capitalize text-[#777] flex items-center justify-between transition-all duration-[0.2s] ease-in text-[14px] relative">
                <select name="cat_slug" id="categorySelect">
                    <option value="" selected>همه موارد</option>
                    @forelse($categories as $category)
                        <option value="{{ $category->slug }}">{{ $category->title }}</option>
                    @empty
                        <option value="">دسته‌بندی وجود ندارد</option>
                    @endforelse
                </select>
            </div>
        </div>
        <input
            class="form-control bb-search-bar bg-[#fff] block w-full min-h-[45px] h-[48px] py-[10px] pr-[10px] pl-[160px] max-[991px]:min-h-[40px] max-[991px]:h-[40px] max-[991px]:p-[10px] text-[14px] font-normal leading-[1] text-[#777] rounded-[10px] border-[1px] border-solid border-[#eee] " id="searchInput"
            placeholder="جستجوی محصولات..." type="text">
        <button
            class="submit absolute top-[0] left-[auto] right-[0] flex items-center justify-center w-[45px] h-full bg-transparent text-[#555] text-[16px] rounded-[0] outline-[0] border-[0] padding-[0]"
            type="submit">
            <i class="ri-search-line text-[18px] leading-[12px] text-[#555]"></i>
        </button>
    </form>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb mb-[50px] max-[1199px]:mb-[35px] border-b-[1px] border-solid border-[#eee] bg-[#f8f8fb]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="flex flex-wrap w-full bb-breadcrumb-inner m-[0] py-[20px] items-center">
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <h2 class="bb-breadcrumb-title font-Dana  leading-[1.2] text-[16px] font-bold text-[#3d4750] max-[767px]:text-center max-[767px]:mb-[10px]">صفحه فروشگاه</h2>
                        </div>
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                                <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a href="{{route('home')}}" class="font-Poppins text-[14px]  font-semibold text-[#686e7d]">خانه</a></li>
                                <li class="text-[14px] font-normal px-[5px]"><i class="ri-arrow-left-double-fill text-[14px] font-semibold"></i></li>
                                <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] font-normal  px-[5px] active">صفحه فروشگاه</li>
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
    <!-- Shop section -->
    <section class="section-shop pb-[50px] max-[1199px]:pb-[35px]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full px-[12px]">
                <div class="bb-shop-overlay hidden w-full h-screen fixed top-[0] left-[0] bg-[#000000cc] z-[17]"></div>
                <div class="w-full">
                    <div class="bb-shop-pro-inner">
                        <div class="w-full px-[12px]">
                            <div class="bb-pro-list-top mb-[24px] rounded-[20px] flex bg-[#f8f8fb] border-[1px] border-solid border-[#eee] justify-between">
                                <div class="flex flex-wrap w-full">
                                    <div class="w-[50%] px-[12px] max-[420px]:w-full">
                                        <div class="bb-bl-btn py-[10px] flex max-[420px]:justify-center">
                                            <button type="button" class="grid-btn btn-grid-100 h-[38px] w-[38px] flex justify-center items-center border-[0] p-[5px] bg-transparent mr-[5px] active" title="grid">
                                                <i class="ri-apps-line text-[20px]"></i>
                                            </button>
                                            <button type="button" class="grid-btn btn-list-100 h-[38px] w-[38px] flex justify-center items-center border-[0] p-[5px] bg-transparent" title="grid">
                                                <i class="ri-list-unordered text-[20px]"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="w-[50%] px-[12px] max-[420px]:w-full">
                                        <div class="bb-select-inner h-full py-[10px] flex items-center justify-end max-[420px]:justify-center">
                                            <div class="custom-select w-[130px] mr-[30px] flex justify-end text-[#777]  items-center text-[14px] relative max-[420px]:w-[100px] max-[420px]:justify-left">
                                                <div class="w-[130px] mr-[30px] flex justify-end items-center">
                                                    <select id="sortSelect" name="sort">
                                                        <option value="" {{ !request('sort') ? 'selected' : '' }}>نمایش بر اساس</option>
                                                        <option value="name_asc"   {{ request('sort') == 'name_asc'   ? 'selected' : '' }}>نام، صعودی</option>
                                                        <option value="name_desc"  {{ request('sort') == 'name_desc'  ? 'selected' : '' }}>نام، نزولی</option>
                                                        <option value="price_asc"  {{ request('sort') == 'price_asc'  ? 'selected' : '' }}>قیمت، کم به بالا</option>
                                                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>قیمت، بالا به پایین</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div id="productsContainer" class="flex flex-wrap mx-[-12px] mb-[-24px]">
                            @include('app.partials.discountedProduct')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--جستجو محصولات بر اساس دسته بندی--}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchForm         = document.getElementById('searchForm');
            const searchInput        = document.getElementById('searchInput');
            const searchInputMobile  = document.getElementById('searchInputMobile');
            const categorySelect     = document.getElementById('categorySelect');
            const sortSelect         = document.getElementById('sortSelect');
            const productsContainer   = document.getElementById('productsContainer');

            // اگر هیچ‌کدوم از این المنت‌ها نبود، خارج شو
            if (!productsContainer) return;

            // تابع اصلی که همیشه همه پارامترها رو می‌فرسته
            function loadProducts() {
                const searchTerm = (searchInput?.value?.trim() || '') || (searchInputMobile?.value?.trim() || '');

                const params = new URLSearchParams();
                if (searchTerm) params.set('search', searchTerm);
                if (categorySelect?.value) params.set('cat_slug', categorySelect.value);
                if (sortSelect?.value) params.set('sort', sortSelect.value);

                fetch('{{ route('discountedproduct.index') }}?' + params.toString(), {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html'
                    }
                })
                    .then(r => r.text())
                    .then(html => {
                        productsContainer.innerHTML = html;

                        // URL رو بدون رفرش آپدیت کن (خیلی مهمه برای بک/فوروارد و رفرش)
                        const newUrl = window.location.pathname + (params.toString() ? '?' + params : '');
                        history.replaceState(null, '', newUrl);
                    })
                    .catch(console.error);
            }

            // همه رویدادها به یک تابع وصل شدن
            searchForm?.addEventListener('submit', e => e.preventDefault() || loadProducts());

            searchInput?.addEventListener('input', () => {
                setTimeout(loadProducts, 400); // debounce ساده
            });

            if (searchInputMobile) {
                searchInputMobile.addEventListener('input', () => {
                    setTimeout(loadProducts, 400);
                });
            }

            categorySelect?.addEventListener('change', loadProducts);
            sortSelect?.addEventListener('change', loadProducts);  // این خط باعث میشه sort فوراً کار کنه

            // اگر صفحه با فیلتر لود شده بود (مثلاً از URL قبلی)، محصولات درست نشون داده بشن
            if (window.location.search) {
                loadProducts();
                // یکبار در ابتدا اجرا بشه
            }
        });
    </script>
@endsection
