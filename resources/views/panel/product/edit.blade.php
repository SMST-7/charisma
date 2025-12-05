@extends('panel.layouts.master')
@section('title','محصولات')

@section('top_page')

    <!-- پیام فلش -->
    @if (session('success'))
        <div class="alert alert-success  p-[12px]" id="success-alert">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger  p-[12px]" id="error-alert">{{ session('error') }}</div>
    @endif

    <x-top-page title="ویرایش محصول" :items="['فروشگاه','ویرایش محصول']" homeUrl="/" />
@endsection
@section('content')
    <div class="col-sm-12 col-xl-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>فرم ویرایش محصول</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="theme-form" action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- نام --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="name">عنوان <span class="text-danger">*</span></label>
                                <input class="form-control" id="name" type="text" name="name"
                                       value="{{ old('name', $product->name) }}"
                                       placeholder="عنوان محصول را وارد کنید" required>
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- دسته بندی --}}
                            <div class="mb-3">
                                <label class="form-label" for="cat_id">دسته‌بندی</label>
                                <select class="form-select digits" id="cat_id" name="cat_id">
                                    <option value="{{ $product->cat_id }}" selected>{{ $product->category->title }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('cat_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- تصاویر --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="images">تصاویر جدید</label>
                                <input class="form-control" id="images" type="file" name="images[]" accept="image/*" multiple>
                                <small class="form-text text-muted">فقط فایل‌های تصویری (jpg, png, jpeg) مجاز هستند.</small>

                                {{-- پیش‌نمایش تصاویر قبلی --}}
                                <div class="mt-3 d-flex flex-wrap gap-2" id="oldImagesContainer">
                                    @foreach ($product->images as $image)
                                        <img src="{{ asset($image->image_path) }}"
                                             class="img-fluid rounded old-image border shadow-sm"
                                             style="width: 150px; height: 100px; object-fit: cover;"
                                             alt="تصویر محصول">
                                    @endforeach
                                </div>

                                {{-- حذف همه تصاویر قبلی --}}
                                @if ($product->images->count())
                                    <div class="form-check mt-2">
                                        <input type="checkbox" name="remove_images" value="1" class="form-check-input" id="removeImages">
                                        <label class="form-check-label" for="removeImages">حذف تمام تصاویر قبلی</label>
                                    </div>
                                @endif

                                {{-- پیش‌نمایش تصاویر جدید --}}
                                <div id="newImagesPreview" class="mt-3 d-flex flex-wrap gap-2"></div>
                            </div>
                            {{-- توضیحات --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="description">توضیحات <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="description" name="description" required>{{ old('description', $product->description) }}</textarea>
                                @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- تصویر توضیحات --}}
                            <div class="mb-3">
                                <label for="image" class="form-label">تصویر توضیحات</label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                <small class="form-text text-muted">فرمت‌های مجاز: jpg, jpeg, png</small>
                                @error('image') <small class="text-danger d-block">{{ $message }}</small> @enderror

                                <div class="mt-3 text-center">
                                    @if ($product->image_description)
                                        <div id="imagePreviewContainer" class="d-inline-block border rounded shadow-sm p-2">
                                            <img id="imagePreview" src="{{ asset('panel/pictures/' . $product->image_description) }}"
                                                 class="img-fluid rounded" style="max-width: 200px; max-height: 100px; object-fit: cover;">
                                        </div>
                                </div>
                                <div class="mt-2">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="remove_image" id="removeImage" value="1">
                                        <label class="form-check-label" for="removeImage">حذف تصویر فعلی</label>
                                    </div>

                                    @else
                                        <div id="imagePreviewContainer" class="d-inline-block border rounded shadow-sm p-2" style="display: none;">
                                            <img id="imagePreview" src="" class="img-fluid rounded" style="max-width: 250px; max-height: 150px; object-fit: cover;">
                                        </div>
                                        <span class="text-muted">بدون تصویر</span>
                                    @endif
                                </div>
                            </div>
                            {{-- قیمت --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="price">قیمت <span class="text-danger">*</span></label>
                                <input class="form-control" id="price" type="text" name="price"
                                       value="{{ old('price', $product->price) }}" required>
                                @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- موجودی --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="stock">تعداد <span class="text-danger">*</span></label>
                                <input class="form-control" id="stock" type="text" name="stock"
                                       value="{{ old('stock', $product->stock) }}" required>
                                @error('stock') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            {{-- ویژگی‌ها --}}
                            {{-- ویژگی‌ها --}}
                            <div class="mb-3">
                                <label class="form-label" for="attribute_value">انتخاب ویژگی:</label>

                                @php
                                    // گروه‌بندی attribute_value ها براساس عنوان ویژگی
                                    $groupedValues = $attribute_values->groupBy(function($item) {
                                        return $item->attribute->name;
                                    });
                                @endphp

                                <select class="form-select digits" id="attribute_value" name="attribute_value[]" multiple>

                                    @foreach($groupedValues as $attributeName => $values)
                                        <optgroup
                                            label="{{ $attributeName }} :"
                                            style="font-weight: 900; color:#1a1a1a; font-size:15px; padding:8px 0;"
                                        >
                                            @foreach($values as $attribute_value)
                                                <option
                                                    value="{{ $attribute_value->id }}"
                                                    {{ $product->attributeValues->contains('id', $attribute_value->id) ? 'selected' : '' }}
                                                >
                                                    {{ $attribute_value->value }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach

                                </select>

                                @error('attribute_value')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>



                            {{--                            <div class="mb-3">--}}
{{--                                <label class="form-label" for="attribute_value">انتخاب ویژگی:</label>--}}
{{--                                <select class="form-select digits" id="attribute_value" name="attribute_value[]" multiple>--}}
{{--                                    @foreach($attribute_values as $attribute_value)--}}
{{--                                        <option value="{{ $attribute_value->id }}"--}}
{{--                                            {{ $product->attributeValues->contains('id', $attribute_value->id) ? 'selected' : '' }}>--}}
{{--                                            {{ $attribute_value->attribute->name . ': ' . $attribute_value->value }}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                @error('attribute_value') <small class="text-danger">{{ $message }}</small> @enderror--}}
{{--                            </div>--}}

                            <div class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">به‌روزرسانی</button>
                                <a href="{{ route('product.index') }}" class="btn btn-secondary">لغو</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--  استایل مقادیر ویژگی  --}}
    <style>
        /* ظاهر کلی select */
        #attribute_value {
            height: 220px; /* ارتفاع دلخواه */
            border-radius: 8px;
            padding: 6px;
            font-size: 14px;
        }

        /* ظاهر optgroup */
        #attribute_value optgroup {
            font-weight: bold;
            color: #333;
            background: #f5f5f5;
            padding: 4px 8px;
            margin-top: 6px;
            border-radius: 4px;
        }

        /* گزینه‌های هر optgroup */
        #attribute_value optgroup option {
            padding: 6px 10px;
            margin: 2px 0;
            border-radius: 4px;
        }

        /* hover روی گزینه‌ها */
        #attribute_value optgroup option:hover {
            background-color: #e8f0fe;
        }

        /* ظاهر گزینه انتخاب‌شده */
        #attribute_value optgroup option:checked {
            background-color: #cfe2ff !important;
            color: #000;
        }

        /* اسکرول نرم‌تر */
        #attribute_value {
            scrollbar-width: thin;
            scrollbar-color: #ccc #f5f5f5;
        }
        #attribute_value::-webkit-scrollbar {
            width: 6px;
        }
        #attribute_value::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 8px;
        }

    </style>

    {{-- اسکریپت‌ها --}}
    <script>
        // پیش‌نمایش تصاویر جدید
        const imagesInput = document.getElementById('images');
        const newImagesPreview = document.getElementById('newImagesPreview');

        imagesInput?.addEventListener('change', function(event) {
            newImagesPreview.innerHTML = ''; // پاک کردن قبلی
            Array.from(event.target.files).forEach(file => {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.className = 'img-fluid rounded border shadow-sm';
                img.style.width = '150px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                newImagesPreview.appendChild(img);
            });
        });

        // پیش‌نمایش تصویر توضیحات
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const imageContainer = document.getElementById('imagePreviewContainer');
        const removeImageCheckbox = document.getElementById('removeImage');

        imageInput?.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                imagePreview.src = URL.createObjectURL(file);
                imagePreview.style.display = 'block';
                imageContainer.style.opacity = '1';
                imagePreview.style.filter = 'none';
                if (removeImageCheckbox) removeImageCheckbox.checked = false;
            }
        });

        // خاکستری کردن هنگام حذف تصویر توضیحات
        removeImageCheckbox?.addEventListener('change', function() {
            if (this.checked) {
                imageContainer.style.opacity = '0.5';
                imagePreview.style.filter = 'grayscale(100%)';
            } else {
                imageContainer.style.opacity = '1';
                imagePreview.style.filter = 'none';
            }
        });

        // خاکستری کردن همه تصاویر قبلی
        const removeAllImagesCheckbox = document.getElementById('removeImages');
        const oldImages = document.querySelectorAll('.old-image');

        removeAllImagesCheckbox?.addEventListener('change', function () {
            oldImages.forEach(img => {
                if (this.checked) {
                    img.style.opacity = '0.5';
                    img.style.filter = 'grayscale(100%)';
                } else {
                    img.style.opacity = '1';
                    img.style.filter = 'none';
                }
            });
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
