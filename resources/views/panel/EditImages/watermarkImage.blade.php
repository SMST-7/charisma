@extends('panel.layouts.master')
@section('title','ادیت تصویر')

@section('top_page')
    <x-top-page title="فرم ایجاد دسته بندی" :items="['فروشگاه','فرم ایجاد دسته بندی']" homeUrl="/" />
@endsection

@section('content')

    <div class="col-sm-12 col-xl-8">

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>فرم ادیت تصویر</h5>
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
                        <form class="theme-form" action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="title">عنوان <span class="text-danger">*</span></label>
                                <input class="form-control" id="title" type="text" name="title" aria-describedby="titleHelp" placeholder="عنوان دسته‌بندی را وارد کنید" value="{{ old('title') }}" required>
                                @error('title')
                                <small class="text-danger" id="titleHelp">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="image">تصویر</label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                <small class="form-text text-muted">فرمت‌های مجاز: jpg, jpeg, png</small>
                                @error('image') <small class="text-danger d-block">{{ $message }}</small> @enderror

                                <div class="mt-3 d-flex justify-content-center">
                                    <img id="imagePreview"
                                         src=""
                                         alt="پیش‌نمایش تصویر"
                                         class="img-fluid border rounded shadow-sm p-2"
                                         style="max-width: 200px; max-height: 100px; object-fit: cover; display: none;">
                                </div>


                                <!-- اینجا اول مخفی میکنیم -->
                                <div class="mt-2" id="removeImageContainer" style="display: none;">
                                    <div class="form-check mt-2">
                                        <button type="button"class="btn btn-danger"  id="removeSelectedImage" style="display:none;">حذف تصویر فعلی</button>

                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="parent_id">دسته‌بندی والد</label>
                                <select class="form-select digits" id="parent_id" name="parent_id">
                                    <option value="">بدون والد</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">ایجاد دسته‌بندی</button>
                                <a href="{{ route('category.index') }}" class="btn btn-secondary">لغو</a>
                            </div>

                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>
    <script>
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const imageContainer = document.getElementById('imagePreviewContainer');
        const removeImageCheckbox = document.getElementById('removeImage');
        const removeImageContainer = document.getElementById('removeImageContainer');

        // پیش‌نمایش تصویر و نمایش گزینه حذف
        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                imagePreview.src = URL.createObjectURL(file);
                imagePreview.style.display = 'block';
                removeImageContainer.style.display = 'block'; // وقتی عکس انتخاب شد، نمایش بده
            } else {
                imagePreview.src = '';
                imagePreview.style.display = 'none';
                removeImageContainer.style.display = 'none'; // اگه پاک کرد، دوباره مخفی شه
            }
        });

        // افکت محو پیش‌نمایش در صورت انتخاب حذف
        removeImageCheckbox?.addEventListener('change', function() {
            if (this.checked) {
                imageContainer.style.opacity = '0.5';
                imagePreview.style.filter = 'grayscale(100%)';
            } else {
                imageContainer.style.opacity = '1';
                imagePreview.style.filter = 'none';
            }
        });

        const removeButton = document.getElementById('removeSelectedImage'); // یه دکمه کوچک برای حذف

        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if(file){
                imagePreview.src = URL.createObjectURL(file);
                imagePreview.style.display = 'block';
                removeButton.style.display = 'inline-block'; // دکمه حذف نمایش داده بشه
            }
        });

        removeButton.addEventListener('click', function(){
            imageInput.value = ''; // فایل پاک میشه
            imagePreview.src = '';
            imagePreview.style.display = 'none';
            removeButton.style.display = 'none';
        });

    </script>

@endsection
