@extends('panel.layouts.master')
@section('title','درباره ما')

@section('top_page')


        <!-- نمایش پیام‌های فلش -->
        @if (session('insert') || session('update') || session('delete') || session('error'))
            <div class="alert alert-dismissible fade show my-3" role="alert"
                 style="{{ session('error') ? 'background-color: #f8d7da; color: #721c24; border-color: #f5c6cb;' : 'background-color: #d4edda; color: #155724; border-color: #c3e6cb;' }}">
                <strong>
                    {{ session('insert') ?? session('update') ?? session('delete') ?? session('error') }}
                </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="بستن"></button>
            </div>
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
@endsection
