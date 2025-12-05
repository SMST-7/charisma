@extends('app.home.master')
@section('title', 'علاقه‌مندی‌ها')

@section('content')
    <div class="container mx-auto px-4 py-6 max-w-3xl">
        <!-- Breadcrumb -->
        <div class="flex items-center justify-between mb-5 text-sm text-gray-500">
            <h2 class="font-bold text-gray-800">علاقه‌مندی‌ها</h2>
            <div class="flex items-center gap-1 text-xs">
                <a href="{{ route('home') }}" class="text-purple-600 hover:underline">خانه</a>
                <span>/</span>
                <span>علاقه‌مندی</span>
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-50 text-green-700 text-xs rounded-xl text-center animate-fade shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-3 bg-red-50 text-red-700 text-xs rounded-xl text-center animate-fade shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- Wishlist Vertical Cards -->
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($wishlists as $wishlist)
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 group">
                    <!-- Image -->
                    <div class="relative overflow-hidden">
                        <img src="{{ asset($wishlist->products->images->first()->image_path ?? 'panel/pictures/picture2.jpg') }}"
                             class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
                             alt="{{ $wishlist->products->name }}">

                        <!-- قلب قرمز (حذف) -->
                        <form action="{{ route('wishlist.remove', $wishlist->id) }}" method="post" class="absolute top-3 right-3">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="bg-white/80 backdrop-blur-sm p-2 rounded-full shadow-md text-red-500 hover:text-red-600 hover:bg-white transition-all active:scale-90">
                                <i class="ri-heart-fill text-xl"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-800 text-sm line-clamp-2 mb-2 leading-tight">
                            {{ $wishlist->products->name }}
                        </h3>
                        <p class="text-sm font-bold text-purple-600 mb-3">
                            {{ number_format($wishlist->products->price) }} تومان
                        </p>

                        <!-- افزودن به سبد -->
                        <form action="{{ route('cart.add') }}" method="post" class="w-full">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $wishlist->products->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit"
                                    class="w-full flex items-center justify-center gap-1.5 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 text-white text-xs font-medium rounded-xl hover:from-purple-700 hover:to-indigo-700 transition shadow-sm">
                                <i class="ri-shopping-cart-line"></i>
                                افزودن به سبد خرید
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-span-full text-center py-16 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-300">
                    <i class="ri-heart-3-line text-7xl text-gray-300 mb-4"></i>
                    <p class="text-gray-600 font-medium text-lg mb-3">علاقه‌مندی خالی است</p>
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-purple-600 text-white font-medium rounded-xl hover:bg-purple-700 transition shadow-sm">
                        <i class="ri-arrow-left-line"></i>
                        شروع خرید
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        .animate-fade {
            animation: fadeOut 0.5s ease-out forwards;
            animation-delay: 3s;
        }
        @keyframes fadeOut {
            to { opacity: 0; transform: translateY(-10px); }
        }

        /* انیمیشن قلب */
        .ri-heart-fill:active { transform: scale(0.85); }

        /* ریسپانسیو */
        @media (max-width: 640px) {
            .grid { grid-template-columns: 1fr; gap: 1rem; }
            .container { padding-left: 1rem; padding-right: 1rem; }
            img { height: 40vw; max-height: 200px; }
        }
    </style>

    <script>
        // محو شدن پیام‌ها
        setTimeout(() => {
            document.querySelectorAll('.animate-fade').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(-10px)';
                setTimeout(() => el.remove(), 500);
            });
        }, 3000);
    </script>
@endsection
