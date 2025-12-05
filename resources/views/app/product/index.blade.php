@extends('app.home.master')
@section('title','محصولات')

@section('search')

<form
    class="bb-btn-group-form flex relative max-[991px]:ml-[20px] max-[767px]:m-[0]"
    id="searchForm" action="{{ route('offer.index') }}">

    <input
        class="form-control bb-search-bar bg-[#fff] block w-full min-h-[45px] h-[48px] py-[10px] pr-[10px] pl-[15px]
        max-[991px]:min-h-[40px] max-[991px]:h-[40px] max-[991px]:p-[10px]
        text-[14px] font-normal leading-[1] text-[#777]
        rounded-[10px] border-[1px] border-solid border-[#eee]"
        id="searchInput"
        placeholder="جستجوی نام محصول..."
        name="search"
        value="{{ request('search') }}"
    >

    <button
        class="submit absolute top-[0] right-[0] flex items-center justify-center w-[45px] h-full
        bg-transparent text-[#555] text-[16px] rounded-[0] outline-[0] border-[0]"
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

    <!-- Category section -->
    <section class="section-category pt-[50px] max-[1199px]:pt-[35px] mb-[24px]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="bb-category-6-colum owl-carousel">
                        @forelse($categories as $category)
                            <a href="{{ route('home.show', $category->slug) }}" class="bb-category-box p-[30px] rounded-[20px] flex flex-col items-center text-center max-[1399px]:p-[20px] category-items-1 bg-[#fef1f1] transition-all duration-300 hover:shadow-lg hover:scale-105" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="200">
                                <div class="category-image mb-[12px]">
                                    <img src="{{ asset('panel/pictures/'.$category->image) }}" alt="{{ $category->title }}" class="rounded w-[50px] h-[50px] max-[1399px]:h-[65px] max-[1399px]:w-[65px] max-[1199px]:h-[50px] max-[1199px]:w-[50px] object-cover">
                                </div>
                                <div class="category-sub-contact">
                                    <h5 class="mb-[2px] text-[16px] font-Dana text-[#3d4750] font-semibold leading-[1.2]">
                                        {{ $category->title }}
                                    </h5>
                                    <p class="font-Poppins text-[13px] text-[#686e7d] leading-[25px] font-light">
                                        {{ $category->products->count() }} مورد
                                    </p>
                                </div>
                            </a>
                        @empty
                            <p class="text-center w-full text-[#686e7d] font-medium py-[20px]">دسته‌بندی دیگری وجود ندارد</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                            @include('app.partials.products')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--جستجو محصولات--}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchForm         = document.getElementById('searchForm');
    const searchInput        = document.getElementById('searchInput');
    const searchInputMobile  = document.getElementById('searchInputMobile');
    const sortSelect         = document.getElementById('sortSelect');
    const productsContainer = document.getElementById('productsContainer');

    if (!productsContainer) return;

    let typingTimer = null;

    function loadProducts() {

        const searchTerm =
            (searchInput?.value?.trim() || '') ||
            (searchInputMobile?.value?.trim() || '');

        const params = new URLSearchParams();

        if (searchTerm) params.set('search', searchTerm);
        if (sortSelect?.value) params.set('sort', sortSelect.value);

        const requestUrl = `{{ route('offer.index') }}?${params.toString()}`;

        fetch(requestUrl, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        })
        .then(res => res.text())
        .then(html => {
            productsContainer.innerHTML = html;

            const newUrl = window.location.pathname + (params.toString() ? `?${params.toString()}` : '');
            history.replaceState(null, '', newUrl);
        })
        .catch(err => console.error('Ajax Error:', err));
    }

    // ارسال فرم
    searchForm?.addEventListener('submit', function (e) {
        e.preventDefault();
        loadProducts();
    });

    // تایپ دسکتاپ
    searchInput?.addEventListener('input', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(loadProducts, 400);
    });

    // تایپ موبایل
    searchInputMobile?.addEventListener('input', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(loadProducts, 400);
    });

    // مرتب‌سازی
    sortSelect?.addEventListener('change', loadProducts);

    // اگر با پارامتر باز شده بود
    if (window.location.search) {
        loadProducts();
    }

});
</script>


@endsection
