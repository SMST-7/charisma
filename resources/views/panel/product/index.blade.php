@extends('panel.layouts.master')
@section('title','محصولات')

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
    <x-top-page title="لیست محصولات" :items="['فروشگاه','لیست محصولات']" homeUrl="/" />
@endsection

@section('content')

    <div class="col-sm-12">
        <div class="card shadow-sm rounded-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>لیست محصولات</h5>
                <a class="btn btn-outline-primary" href="{{route('product.create')}}">ایجاد</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>اسم محصول</th>
                        <th>اسلاگ</th>
                        <th>دسته بندی</th>
                        <th>تصاویر</th>
                        <th>توضیحات</th>
                        <th>تصویر توضیحات</th>
                        <th>قیمت</th>
                        <th>تعداد</th>
                        <th>ویژگی‌ها</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody id="productTable">
                    @foreach($products as $product)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->slug ?? 'N/A'}}</td>
                            <td>{{ optional($product->category)->title ?? 'بدون دسته بندی' }}</td>


                            <!-- تصاویر محصول با اسلایدر -->
                            <td>
                                @if($product->images->isNotEmpty())
                                    <div id="carousel{{$product->id}}" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach($product->images as $key => $image)
                                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                    <img src="{{ asset($image->image_path) }}"
                                                         class="img-fluid rounded shadow-sm" style="width: 140px;height: 80px;object-fit: cover;border-radius: 10px;"
                                                         alt="تصویر محصول">
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- دکمه قبلی -->
                                        <button class="carousel-control-prev custom-carousel-btn" type="button"
                                                data-bs-target="#carousel{{$product->id}}" data-bs-slide="prev">
                                            <i data-feather="chevron-left"></i>
                                        </button>

                                        <!-- دکمه بعدی -->
                                        <button class="carousel-control-next custom-carousel-btn" type="button"
                                                data-bs-target="#carousel{{$product->id}}" data-bs-slide="next">
                                            <i data-feather="chevron-right"></i>
                                        </button>
                                    </div>

                                @else
                                    <span class="text-muted">بدون تصویر</span>
                                @endif
                            </td>

                            <!-- ستون توضیحات با قابلیت نمایش کامل در مودال -->
                            <td>
                                @if($product->description)
                                    <span class="description-short text-muted cursor-pointer"
                                          data-bs-toggle="modal"
                                          data-bs-target="#descModal{{ $product->id }}"
                                          style="max-width: 150px; display: inline-block;"
                                          title="کلیک کنید تا توضیحات کامل نمایش داده شود">
                                          {{ Str::limit($product->description, 10, '...') }}
                                    </span>

                                    <!-- مودال توضیحات کامل -->
                                    <div class="modal fade" id="descModal{{ $product->id }}" tabindex="-1" aria-labelledby="descModalLabel{{$product->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content border-0 shadow-lg">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="descModalLabel{{ $product->id }}">
                                                        توضیحات کامل: {{ $product->name }}
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="بستن"></button>
                                                </div>
                                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto; line-height: 1.8;">
                                                    <p class="text-dark">{!! nl2br(e($product->description)) !!}</p>
                                                </div>
                                                <div class="modal-footer bg-light">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-muted">بدون توضیحات</span>
                                @endif
                            </td>

                            <!-- تصویر توضیحات ساده -->
                            <td>
                                @if ($product->image_description)
                                    <img src="{{ asset('panel/pictures/' . $product->image_description) }}" class="img-fluid rounded shadow-sm" style="width: 100px;height: 60px;" alt="تصویر توضیحات">
                                @else
                                    <span class="text-muted">بدون تصویر</span>
                                @endif
                            </td>

                            <td>{{number_format($product->price)}} تومان</td>
                            <td>{{$product->stock}}</td>

                            <td>

                                @forelse($product->attributeValues as $productAttributeValue)
                                    <span class="badge bg-light text-dark">
                                        {{$productAttributeValue->attribute->name}}: {{$productAttributeValue->value}}
                                    </span><br>
                                @empty
                                    <p class="text-muted">N/A</p>
                                @endforelse


                            </td>


                            <td>

                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('product.edit', $product->slug) }}"
                                       class="badge bg-warning"
                                       title="ویرایش">
                                        <i data-feather="edit-2"></i>
                                    </a>
                                    <a href="#" class="badge bg-danger"
                                       data-bs-toggle="modal"
                                       data-bs-target="#deleteModal{{$product->id}}"
                                       title="حذف">
                                        <i data-feather="trash"></i>
                                    </a>
                                </div>
                            </td>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{$product->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">حذف محصول</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <p>آیا از حذف <strong>{{$product->name}}</strong> اطمینان دارید؟</p>

                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST">
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
                    <!-- اطلاعات نمایش رکوردها -->
                    <div class="col-auto">
                        <div class="dataTables_info" role="status" aria-live="polite">
                            @if($products->count() > 0)
                                نمایش {{ $products->firstItem() }} تا {{ $products->lastItem() }} از {{ $products->total() }} مورد
                            @else
                                <p>رکوردی وجود ندارد</p>
                            @endif
                        </div>
                    </div>

                    <!-- Pagination -->
                    @if ($products->hasPages())
                        <div class="col text-end">
                            <ul class="pagination mb-0">
                                <!-- دکمه قبلی -->
                                <li class="paginate_button page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $products->previousPageUrl() }}">قبلی</a>
                                </li>

                                <!-- شماره صفحات -->
                                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                    <li class="paginate_button page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                <!-- دکمه بعدی -->
                                <li class="paginate_button page-item {{ $products->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $products->nextPageUrl() }}">بعدی</a>
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
            const rows = document.querySelectorAll('#productTable tr');
            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const slug = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                if (name.includes(searchTerm.toLowerCase())) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
                if (slug.includes(searchTerm.toLowerCase())) {
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



{{-- استایل برای توضیحات--}}
    <style>
        .cursor-pointer {
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .cursor-pointer:hover {
            color: #0d6efd !important;
            text-decoration: underline;
        }

        /* کمی فاصله برای سه‌نقطه */
        .description-short {
            font-size: 0.9rem;
        }
    </style>
@endsection
