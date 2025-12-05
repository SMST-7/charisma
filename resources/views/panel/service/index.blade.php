@extends('panel.layouts.master')
@section('title','سرویس')

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
    <x-top-page title="لیست سرویس" :items="['فروشگاه','لیست سرویس']" homeUrl="/" />
@endsection

@section('content')
    <div class="col-sm-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>سرویس‌ها</h5>
                <a class="btn btn-outline-primary" href="{{ route('service.create') }}">ایجاد سرویس</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">عنوان</th>
                        <th scope="col">توضیحات</th>
                        <th scope="col">عکس</th>
                        <th scope="col">وضعیت</th>
                        <th scope="col">عملیات</th>
                    </tr>
                    </thead>
                    <tbody id="serviceTable">
                    @foreach($services as $service)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $service->title }}</td>
                            <td>{{ $service->description }}</td>
                            <td>
                                @if ($service->image)
                                    <img src="{{ asset('panel/pictures/' . $service->image) }}"
                                         class="rounded shadow-sm"
                                         style="width: 100px; height: 60px; object-fit: cover;"
                                         alt="تصویر سرویس">
                                @else
                                    <span class="text-muted">بدون تصویر</span>
                                @endif
                            </td>
                            <td>
                                <form method="post" action="{{ route('service.toggle', $service->id) }}">
                                    @csrf
                                    @method('patch')
                                    <button
                                        class="btn {{$service->is_active ? 'btn-success' : 'btn-danger'}}">
                                        <span>{{$service->is_active ? 'فعال' : 'غیر فعال'}}</span>
                                    </button>
                                </form>
{{--                                @if ($service->is_active)--}}
{{--                                    <span class="badge bg-success">فعال</span>--}}
{{--                                @else--}}
{{--                                    <span class="badge bg-danger">غیرفعال</span>--}}
{{--                                @endif--}}
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('service.edit', $service->id) }}"
                                       class="badge bg-warning" title="ویرایش">
                                        <i data-feather="edit-2"></i>
                                    </a>
                                    <a class="badge bg-danger"
                                       data-bs-toggle="modal"
                                       data-bs-target="#deleteModalCenter{{ $service->id }}"
                                       title="حذف">
                                        <i data-feather="trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal حذف -->
                        <div class="modal fade" id="deleteModalCenter{{ $service->id }}" tabindex="-1"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">حذف سرویس</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p>آیا از حذف <strong>{{ $service->title }}</strong> مطمئن هستید؟</p>
                                        <form action="{{ route('service.destroy',$service->id) }}" method="post">
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
            </div>
        </div>
    </div>
    <script>
        // تابع جستجوی بلادرنگ
        function performSearch(searchTerm) {
            const rows = document.querySelectorAll('#serviceTable tr');
            rows.forEach(row => {
                const title = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                if (title.includes(searchTerm.toLowerCase())) {
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
