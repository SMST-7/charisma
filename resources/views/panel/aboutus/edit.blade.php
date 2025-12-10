@extends('panel.layouts.master')
@section('title','درباره ما')

@section('top_page')


    <!-- پیام فلش -->
    @if (session('success'))
        <div class="alert alert-success  p-[12px]" id="success-alert">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger  p-[12px]" id="error-alert">{{ session('error') }}</div>
    @endif
    <x-top-page title="ویرایش درباره ما" :items="['پنل مدیریت','درباره ما']" homeUrl="/" />
@endsection

@section('content')
    <div class="col-sm-12 col-xl-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>فرم درباره ما</h5>
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

                        {{-- پیام موفقیت --}}
                        @if(session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form class="theme-form" method="post" action="{{ route('about.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- عنوان --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="title">عنوان <span class="text-danger">*</span></label>
                                <input class="form-control" id="title" type="text" name="title"
                                       value="{{ old('title', $about->title) }}" placeholder="عنوان را وارد کنید" required>
                                @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- توضیحات --}}
                            <div class="mb-3">
                                <label class="form-label" for="description">توضیحات <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="description" name="description" rows="4"
                                          placeholder="توضیحات درباره ما">{{ old('description', $about->description) }}</textarea>
                                @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- تصویر --}}
                            <div class="mb-3">
                                <label for="image" class="form-label">تصویر درباره ما</label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                <small class="form-text text-muted">فرمت‌های مجاز: jpg, jpeg, png</small>
                                @error('image') <small class="text-danger d-block">{{ $message }}</small> @enderror


                                    <div class="mt-3 text-center" id="imageDescriptionContainer">
                                        <img id="image_descriptionPreview" src="" alt="پیش‌نمایش تصویر توضیحات"
                                             class=" img-fluid rounded border shadow-sm p-2"
                                             style="width: 200px; mheight: 120px;  object-fit:cover; display:none;">
                                    </div>
                                </div>

                            <label for="image" class="form-label">تصویر فعلی:</label>

                                @if ($about->image)
                                    <div class="mt-3 text-center">
                                        <img src="{{ asset('panel/pictures/' . $about->image) }}"
                                             class=" border rounded shadow-sm p-2"
                                             style="width: 200px; mheight: 120px; object-fit: cover;" alt="تصویر فعلی">
                                    </div>
                                @endif
                            </div>



                            <div class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">به‌روزرسانی</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- اسکریپت پیش‌نمایش تصویر --}}
    <script>
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const imageContainer = document.getElementById('imagePreviewContainer');
        const removeImageCheckbox = document.getElementById('removeImage');

        // پیش‌نمایش تصویر جدید
        // imageInput.addEventListener('change', function(event) {
        //     const file = event.target.files[0];
        //     if (file) {
        //         imagePreview.src = URL.createObjectURL(file);
        //         imagePreview.style.display = 'block';
        //     } else {
        //         imagePreview.src = '';
        //         imagePreview.style.display = 'none';
        //     }
        // });
        // پیش‌نمایش تصویر توضیحات
        document.getElementById('image')?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('image_descriptionPreview');
            const container = document.getElementById('imageDescriptionContainer');
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
                container.style.opacity = '1';
                preview.style.filter = 'none';
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });
        // خاکستری کردن تصویر فعلی هنگام انتخاب حذف
        removeImageCheckbox?.addEventListener('change', function() {
            if (this.checked) {
                imageContainer.style.opacity = '0.5';
                imagePreview.style.filter = 'grayscale(100%)';
            } else {
                imageContainer.style.opacity = '1';
                imagePreview.style.filter = 'none';
            }
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
