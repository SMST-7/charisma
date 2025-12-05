@extends('panel.layouts.master')
@section('title','مقاله')

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
    <x-top-page title="لیست مقالات" :items="['مقالات','لیست مقالات']" homeUrl="/" />
@endsection

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>مقالات</h5>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>عنوان</th>
                        <th>توضیحات</th>
                        <th>تصویر</th>
                        <th>نام کالای مرتبط</th>
                        <th>آدرس کالای مرتبط</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody id="blogsTable">
                    @foreach($blogs as $blog)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $blog->title }}</td>
                            <td>{{ Str::limit($blog->content, 50) }}</td>
                            <td>
                                @if($blog->image)
                                    <img src="{{ asset('uploads/blogs/' . $blog->image) }}" alt="-" class="rounded shadow-sm"
                                         style="width: 100px; height: 60px; object-fit: cover;">
                                @else
                                    <span class="text-muted">بدون تصویر</span>
                                @endif
                            </td>
                            <td>{{ $blog->reference_name ?? '-' }}</td>
                            <td>
                                @if($blog->reference_url)
                                    <a href="{{ $blog->reference_url }}" target="_blank">{{ Str::limit($blog->reference_url, 30) }}</a>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td>
                                <div role="group">
                                    <a href="{{ route('blogs.edit', $blog->id) }}" class="badge bg-warning" title="ویرایش">
                                        <i data-feather="edit-2"></i>
                                    </a>
                                    <a class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#deleteModalCenter{{ $blog->id }}" title="حذف">
                                        <i data-feather="trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- مدال حذف -->
                        <div class="modal fade" id="deleteModalCenter{{ $blog->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">حذف مقاله</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p>آیا از حذف <strong>{{ $blog->title }}</strong> اطمینان دارید؟</p>
                                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
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
                <div class="row align-items-center mb-3 px-3">
                    <div class="col-auto">
                        <div class="dataTables_info" id="column-selector_info" role="status" aria-live="polite">
                            @if($blogs->count() > 0)
                                نمایش {{ $blogs->firstItem() }} تا {{ $blogs->lastItem() }} از {{ $blogs->total() }} مورد
                            @else
                                <p>رکوردی وجود ندارد</p>
                            @endif
                        </div>
                    </div>

                    @if ($blogs->hasPages())
                        <div class="col">
                            <ul class="pagination justify-content-end mb-0">
                                {{-- دکمه قبلی --}}
                                <li class="paginate_button page-item {{ $blogs->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $blogs->previousPageUrl() }}">قبلی</a>
                                </li>

                                {{-- شماره صفحات --}}
                                @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                                    <li class="paginate_button page-item {{ $page == $blogs->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                {{-- دکمه بعدی --}}
                                <li class="paginate_button page-item {{ $blogs->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $blogs->nextPageUrl() }}">بعدی</a>
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
            const rows = document.querySelectorAll('#blogsTable tr');
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

