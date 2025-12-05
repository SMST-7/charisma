@extends('panel.layouts.master')
@section('title','کوپن')

@section('search')
    <input class="form-control" type="text" id="searchInput" placeholder="جستجو بر اساس عنوان ..." aria-label="جستجوی ویژگی ها">
@endsection

@section('search-mobile')
    <input class="form-control" type="text" id="searchInputMobile" placeholder="اینجا جستجو کنید ...">
@endsection
<style>

    /* دکمه‌ها دایره‌ای، وسط تصویر */
    .custom-carousel-btn {
        top: 50%;
        transform: translateY(50%);
        background: rgba(0,0,0,0.5);
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.2s ease;
    }

    .custom-carousel-btn i {
        color: #fff;
        width: 18px;
        height: 18px;
    }


    .custom-carousel-btn:hover {
        background: rgba(0,0,0,0.8);
    }



</style>
@section('top_page')

    <!-- پیام فلش -->
    @if (session('success'))
        <div class="alert alert-success  p-[12px]" id="success-alert">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger  p-[12px]" id="error-alert">{{ session('error') }}</div>
    @endif
    <x-top-page title="لیست کوپن" :items="['فروشگاه','لیست کوپن']" homeUrl="/" />
@endsection

@section('content')

    <div class="col-sm-12">
        <div class="card shadow-sm rounded-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>لیست کوپن</h5>
                <a class="btn btn-outline-primary" href="{{route('coupon.create')}}">ایجاد</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>کد کوپن</th>
                        <th>نوع تخفیف</th>
                        <th>مقدار تخفیف </th>
                        <th>حداقل مبلغ خرید</th>
                        <th>سقف استفاده</th>
                        <th>تاریخ شروع</th>
                        <th>تاریخ پایان</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody id="couponTable">
                    @foreach($coupons as $coupon)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ $coupon->type == 'percent' ? 'درصدی' : 'مبلغ ثابت' }}</td>
                            <td>{{ number_format($coupon->value, 0) }} {{ $coupon->type == 'percent' ? '%' : 'تومان' }}</td>
                            <td>{{ $coupon->min_order_amount ? number_format($coupon->min_order_amount, 0) . ' تومان' : '-' }}</td>
                            <td>{{ $coupon->usage_limit ?? '-' }}</td>
                            <td>{{ $coupon->start_date ? \Morilog\Jalali\Jalalian::fromDateTime($coupon->start_date)->format('Y/m/d H:i') : '-' }}</td>
                            <td>{{ $coupon->end_date ? \Morilog\Jalali\Jalalian::fromDateTime($coupon->end_date)->format('Y/m/d H:i') : '-' }}</td>
                            <td>

                                <form method="post" action="{{ route('coupon.toggle', $coupon->id) }}">
                                    @csrf
                                    @method('patch')
                                    <button
                                        class="btn {{$coupon->active ? 'btn-success' : 'btn-danger'}}">
                                        <span>{{$coupon->active ? 'فعال' : 'غیر فعال'}}</span>
                                    </button>
                                </form>

                            </td>


                            <td>

                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('coupon.edit', $coupon->id) }}"
                                       class="badge bg-warning"
                                       title="ویرایش">
                                        <i data-feather="edit-2"></i>
                                    </a>

                                    <a href="#" class="badge bg-danger"
                                       data-bs-toggle="modal"
                                       data-bs-target="#deleteModal{{$coupon->id}}"
                                       title="حذف">
                                        <i data-feather="trash"></i>
                                    </a>
                                </div>
                            </td>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{$coupon->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">حذف محصول</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <p>آیا از حذف <strong>{{$coupon->code}}</strong> اطمینان دارید؟</p>

                                            <form action="{{ route('coupon.destroy', $coupon->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button class="btn btn-danger">حذف</button>
                                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">لغو</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    @endforeach
                    </tbody>
                </table>
                <br>

{{--                <div class="row align-items-center mb-3 px-3">--}}
{{--                    <!-- اطلاعات نمایش رکوردها -->--}}
{{--                    <div class="col-auto">--}}
{{--                        <div class="dataTables_info" role="status" aria-live="polite">--}}
{{--                            @if($coupons->count() > 0)--}}
{{--                                نمایش {{ $coupons->firstItem() }} تا {{ $coupons->lastItem() }} از {{ $coupons->total() }} مورد--}}
{{--                            @else--}}
{{--                                <p>رکوردی وجود ندارد</p>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <!-- Pagination -->--}}
{{--                    @if ($coupons->hasPages())--}}
{{--                        <div class="col text-end">--}}
{{--                            <ul class="pagination mb-0">--}}
{{--                                <!-- دکمه قبلی -->--}}
{{--                                <li class="paginate_button page-item {{ $coupons->onFirstPage() ? 'disabled' : '' }}">--}}
{{--                                    <a class="page-link" href="{{ $coupons->previousPageUrl() }}">قبلی</a>--}}
{{--                                </li>--}}

{{--                                <!-- شماره صفحات -->--}}
{{--                                @foreach ($coupons->getUrlRange(1, $coupons->lastPage()) as $page => $url)--}}
{{--                                    <li class="paginate_button page-item {{ $page == $coupons->currentPage() ? 'active' : '' }}">--}}
{{--                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>--}}
{{--                                    </li>--}}
{{--                            @endforeach--}}

{{--                            <!-- دکمه بعدی -->--}}
{{--                                <li class="paginate_button page-item {{ $coupons->hasMorePages() ? '' : 'disabled' }}">--}}
{{--                                    <a class="page-link" href="{{ $coupons->nextPageUrl() }}">بعدی</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
            </div>
        </div>
    </div>

    <script>
        // تابع جستجوی بلادرنگ
        function performSearch(searchTerm) {
            const rows = document.querySelectorAll('#couponTable tr');
            rows.forEach(row => {
                const code = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const type = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

                if (code.includes(searchTerm.toLowerCase()) || type.includes(searchTerm.toLowerCase())) {
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
