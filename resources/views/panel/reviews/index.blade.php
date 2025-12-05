@extends('panel.layouts.master')
@section('title',' نظرات')

@section('search')
    <input class="form-control" type="text" id="searchInput" placeholder="جستجو بر اساس عنوان ..." aria-label="جستجوی ویژگی ها">
@endsection

@section('search-mobile')
    <input class="form-control" type="text" id="searchInputMobile" placeholder="اینجا جستجو کنید ...">
@endsection


@section('top_page')
    <!-- پیام فلش -->
    @if (session('success'))
        <div class="alert alert-success  p-[12px]" id="success-alert">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger  p-[12px]" id="error-alert">{{ session('error') }}</div>
    @endif
    <x-top-page title="مدیریت نظرات" :items="['داشبورد','نظرات']" homeUrl="/" />
@endsection

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>لیست نظرات کاربران</h5>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>کاربر</th>
                        <th>محصول</th>
                        <th>امتیاز</th>
                        <th>نظر</th>
                        <th>وضعیت</th>
                    </tr>
                    </thead>
                    <tbody id="reviewsTable">
                    @foreach($reviews as $review)
                        <tr>
                            <td>{{ $review->id }}</td>
                            <td>{{ $review->user?->name ?? 'مهمان' }}</td>
                            <td>{{ $review->product?->name ?? '---' }}</td>
                            <td>
                                @if($review->rating)
                                    ⭐ {{ $review->rating }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ \Illuminate\Support\Str::limit($review->comment, 30) }}</td>
                            <td>
                                <form action="{{ route('reviews.toggleStatus', $review->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm
                                        @if($review->status == 'approved') btn-success
                                        @elseif($review->status == 'pending') btn-warning
                                        @else btn-danger @endif">
                                        {{ $review->status == 'approved' ? 'تأیید شده' : ($review->status == 'pending' ? 'در انتظار' : 'رد شده') }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('reviews.show', $review->id) }}" target="_blank" class="text-decoration-none text-primary">
                                    <i data-feather="external-link" class="me-1"></i> مشاهده
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <br>

                <div class="row align-items-center mb-3 px-3">
                    <!-- اطلاعات نمایش رکوردها -->
                    <div class="col-auto">
                        <div class="dataTables_info" role="status" aria-live="polite">
                            @if($reviews->count() > 0)
                                نمایش {{ $reviews->firstItem() }} تا {{ $reviews->lastItem() }} از {{ $reviews->total() }} مورد
                            @else
                                <p>رکوردی وجود ندارد</p>
                            @endif
                        </div>
                    </div>

                    <!-- Pagination -->
                    @if ($reviews->hasPages())
                        <div class="col text-end">
                            <ul class="pagination mb-0">
                                <!-- دکمه قبلی -->
                                <li class="paginate_button page-item {{ $reviews->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $reviews->previousPageUrl() }}">قبلی</a>
                                </li>

                                <!-- شماره صفحات -->
                                @foreach ($reviews->getUrlRange(1, $reviews->lastPage()) as $page => $url)
                                    <li class="paginate_button page-item {{ $page == $reviews->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                <!-- دکمه بعدی -->
                                <li class="paginate_button page-item {{ $reviews->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $reviews->nextPageUrl() }}">بعدی</a>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // تابع جستجوی بلادرنگ
        function performSearch(searchTerm) {
            const rows = document.querySelectorAll('#reviewsTable tr');
            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                if (name.includes(searchTerm.toLowerCase())) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // اضافه کردن رویداد به input دسکتاپ
        document.getElementById('searchInput').addEventListener('input', function() {
            performSearch(this.value);
        });

        // اضافه کردن رویداد به input موبایل
        document.getElementById('searchInputMobile').addEventListener('input', function() {
            performSearch(this.value);
        });
    </script>

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
            margin: 20px 25px;
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


        /* ریسپانسیو کردن جدول برای صفحه‌نمایش‌های کوچک */
        @media screen and (max-width: 767px) {
            /* تنظیم پیام‌ها در موبایل */
            .alert {
                font-size: 14px;
                padding: 12px 18px;
            }
        }

    </style>
@endsection
