@extends('panel.layouts.master')
@section('title','مقاله')

@section('top_page')
    <x-top-page title="فرم ایجاد مقاله" :items="['مقالات','فرم ایجاد مقاله']" homeUrl="/" />
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
                        <h5>فرم مقاله</h5>
                    </div>
                    <div class="card-body">

                        <form class="theme-form" method="post" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="title">عنوان <span class="text-danger">*</span></label>
                                <input class="form-control" id="title" name="title" type="text" placeholder="عنوان پست" value="{{ old('title') }}" required>
                                @error('title')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="content">توضیحات <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="content" name="content" rows="4" placeholder="توضیحات پست" required>{{ old('content') }}</textarea>
                                @error('content')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">تصویر<span class="text-danger">*</span></label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                                <small class="form-text text-muted">فرمت‌های مجاز: jpg, jpeg, png</small>
                                @error('image') <small class="text-danger d-block">{{ $message }}</small> @enderror

                                <div class="mt-3 text-center">
                                    <img id="imagePreview" src="" alt="پیش‌نمایش تصویر" class=" border rounded shadow-sm p-2" style="max-width: 200px; display: none; max-height: 100px; object-fit: cover;">
                                </div>

                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="reference_name">نام کالای مرتبط</label>
                                <input class="form-control" id="reference_name" name="reference_name" type="text" placeholder="نام سایت یا مرجع" value="{{ old('reference_name') }}">
                                @error('reference_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="reference_url">آدرس کالای مرتبط (URL)</label>
                                <input class="form-control" id="reference_url" name="reference_url" type="text" placeholder="https://example.com" value="{{ old('reference_url') }}">
                                @error('reference_url')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">ثبت مقاله</button>
                                <a href="{{ route('blogs.index') }}" class="btn btn-secondary">لغو</a>
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
        const removeImageContainer = document.getElementById('removeImageContainer');
        const removeButton = document.getElementById('removeSelectedImage');

        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if(file){
                imagePreview.src = URL.createObjectURL(file);
                imagePreview.style.display = 'block';
                removeImageContainer.style.display = 'block';
            } else {
                imagePreview.src = '';
                imagePreview.style.display = 'none';
                removeImageContainer.style.display = 'none';
            }
        });

        removeButton.addEventListener('click', function(){
            imageInput.value = '';
            imagePreview.src = '';
            imagePreview.style.display = 'none';
            removeImageContainer.style.display = 'none';
        });
    </script>

@endsection
