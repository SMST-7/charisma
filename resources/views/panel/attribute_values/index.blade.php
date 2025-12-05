@extends('panel.layouts.master')
@section('title','مقدار ویژگی ها')
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
                <x-top-page title="لیست مقدار ویژگی" :items="['فروشگاه','لیست مقدار ویژگی']" homeUrl="/" />
            @endsection
        @section('content')
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>مقادیر ویژگی </h5>
{{--                        <a class="btn btn-outline-primary" href="{{route('attribute_values.create')}}">ایجاد</a>--}}
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ویژگی</th>
                                <th scope="col">مقادیر ویژگی</th>
                                <th scope="col">عملیات</th>
                            </tr>
                            </thead>
                            <tbody id="attributeValuesTable">
                            @forelse($grouped_values as $index => $group)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td><strong>{{ $group['attribute']->name }}</strong></td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach($group['value_objects'] as $value)
                                                <span class="badge bg-light text-dark border d-flex align-items-center gap-1">
                        {{ $value->value }}
                        <a href="{{ route('attribute_values.edit', $value->id) }}"
                           class="text-warning ms-1" title="ویرایش">
                            <i data-feather="edit-3" width="14"></i>
                        </a>
                        <a href="#" class="text-danger" title="حذف"
                           data-bs-toggle="modal"
                           data-bs-target="#deleteModal{{ $value->id }}">
                            <i data-feather="trash-2" width="14"></i>
                        </a>
                    </span>

                                                <!-- مودال حذف -->
                                                <div class="modal fade" id="deleteModal{{ $value->id }}" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger text-white">
                                                                <h5 class="modal-title">حذف مقدار ویژگی</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <p>آیا از حذف مقدار <strong>{{ $value->value }}</strong> اطمینان دارید؟</p>
                                                                <form action="{{ route('attribute_values.destroy', $value->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">بله، حذف کن</button>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">خیر</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('attribute_values.create', ['attribute_id' => $group['attribute']->id]) }}"
                                           class="btn btn-sm btn-success" title="اضافه کردن مقدار جدید">
                                            <i data-feather="plus"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">هیچ مقداری ثبت نشده است.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <script>
                // تابع جستجوی بلادرنگ
                function performSearch(searchTerm) {
                    const rows = document.querySelectorAll('#attributeValuesTable tr');
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


                .badge {
                    font-size: 0.9em;
                    padding: 0.4em 0.6em;
                }
                .badge i {
                    cursor: pointer;
                }

            </style>
@endsection
