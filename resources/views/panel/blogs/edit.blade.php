@extends('panel.layouts.master')
@section('title','مقاله')

@section('top_page')
    <x-top-page title="ویرایش مقاله" :items="['مقالات','ویرایش مقاله']" homeUrl="/" />



        <!-- پیام فلش -->
        @if (session('success'))
            <div class="alert alert-success  p-[12px]" id="success-alert">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger  p-[12px]" id="error-alert">{{ session('error') }}</div>
        @endif
@endsection

@section('content')
    <div class="col-sm-12 col-xl-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>فرم ویرایش مقاله</h5>
                    </div>
                    <div class="card-body">

                        <form class="theme-form" action="{{ route('blogs.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- عنوان --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="title">عنوان مقاله <span class="text-danger">*</span></label>
                                <input class="form-control" id="title" type="text" name="title"
                                       value="{{ old('title', $blog->title) }}" placeholder="عنوان مقاله را وارد کنید" required>
                                @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- توضیحات --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="content">توضیحات <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="content" name="content" rows="4" required
                                          placeholder="توضیحات مقاله را وارد کنید">{{ old('content', $blog->content) }}</textarea>
                                @error('content') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- تصویر --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="image">تصویر مقاله</label>
                                <input class="form-control" id="image" type="file" name="image" accept="image/*">
                                <small class="form-text text-muted">فقط فایل‌های تصویری (jpg, png, jpeg) مجاز هستند.</small>
                                @error('image') <small class="text-danger">{{ $message }}</small> @enderror

                                <div class="mt-3 text-center">
                                    {{-- اگر قبلاً عکس ذخیره شده --}}
                                    @if ($blog->image)
                                        <div id="imagePreviewContainer" class="d-inline-block border rounded shadow-sm p-2">
                                            <img id="imagePreview"
                                                 src="{{ asset('uploads/blogs/' . $blog->image) }}"
                                                 class="img-fluid rounded"
                                                 style="max-width: 200px; max-height: 100px; object-fit: cover;" required>
                                        </div>
                                    @else
                                        {{-- اگر عکس نداشت، فقط جای خالی برای پیش‌نمایش انتخابی --}}
                                        <div id="imagePreviewContainer" class="d-inline-block border rounded shadow-sm p-2" style="display:none;">
                                            <img id="imagePreview"
                                                 class="img-fluid rounded"
                                                 style="max-width: 200px; max-height: 100px; object-fit: cover; display:none;">
                                        </div>
                                    @endif
                                </div>
                            </div>



                            {{-- نام مرجع --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="reference_name">نام کالا مرتبط</label>
                                <input class="form-control" id="reference_name" type="text" name="reference_name"
                                       value="{{ old('reference_name', $blog->reference_name) }}" placeholder="نام کالا ">
                                @error('reference_name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- آدرس مرجع --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="reference_url">آدرس کالا (URL)</label>
                                <input class="form-control" id="reference_url" type="text" name="reference_url"
                                       value="{{ old('reference_url', $blog->reference_url) }}" placeholder="https://example.com">
                                @error('reference_url') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- دکمه‌ها --}}
                            <div class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">به‌روزرسانی</button>
                                <a href="{{ route('blogs.index') }}" class="btn btn-secondary">لغو</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- اسکریپت‌ها --}}
    <script>
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const imageContainer = document.getElementById('imagePreviewContainer');
        const removeImageCheckbox = document.getElementById('removeImage');

        // پیش‌نمایش تصویر جدید
        imageInput?.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                imagePreview.src = URL.createObjectURL(file);
                imagePreview.style.display = 'block';
            }
        });

        // خاکستری کردن تصویر وقتی "حذف" انتخاب بشه
        removeImageCheckbox?.addEventListener('change', function() {
            if (this.checked) {
                imageContainer.style.opacity = '0.5';
                imagePreview.style.filter = 'grayscale(100%)';
            } else {
                imageContainer.style.opacity = '1';
                imagePreview.style.filter = 'none';
            }
        });

        // نمایش پیش‌نمایش عکس انتخابی
        imageInput?.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
            imagePreview.src = URL.createObjectURL(file);
            imagePreview.style.display = 'block';
            imageContainer.style.display = 'inline-block';
        } else {
            imagePreview.src = '';
            imagePreview.style.display = 'none';
            imageContainer.style.display = 'none';
        }
        });

        // خاکستری کردن عکس وقتی "حذف" تیک بخوره
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
@endsection
