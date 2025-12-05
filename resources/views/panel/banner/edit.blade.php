@extends('panel.layouts.master')
@section('title','بنر')

@section('top_page')
    <x-top-page title="ویرایش بنر" :items="['فروشگاه','ویرایش بنر']" homeUrl="/" />
@endsection
@section('content')
    <div class="col-sm-12 col-xl-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>فرم ویرایش بنر</h5>
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

                        <form class="theme-form" action="{{ route('banner.update', $banner->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- نام --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="title">عنوان بنر</label>
                                <input class="form-control" id="title" type="text" name="title"
                                       value="{{ old('title', $banner->title) }}"
                                       placeholder="عنوان بنر را وارد کنید">
                            </div>


                            {{-- تصویر  --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="image"> تصویر<span class="text-danger">*</span></label>
                                <input class="form-control" id="image" type="file" name="image" accept="image/*">
                                <small class="form-text text-muted">فقط فایل‌های تصویری (jpg, png, jpeg) مجاز هستند.</small>
                                @error('image') <small class="text-danger">{{ $message }}</small> @enderror

                                <div class="mt-3 text-center">
                                    @if ($banner->image)

                                        <div id="imagePreviewContainer" class="d-inline-block border rounded shadow-sm p-2">
                                            <img id="imagePreview" src="{{ asset('panel/banner/' . $banner->image) }}"
                                                 class="img-fluid rounded" style="max-width: 200px; max-height: 100px; object-fit: cover;">
                                        </div>
                                </div>

                                <div class="mt-2">


                                @else
                                        <span class="text-muted">بدون تصویر</span>
                                    @endif
                                </div>
                            </div>








                            {{-- قیمت --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="link">لینک </label>
                                <input class="form-control" id="link" type="text" name="link"
                                       value="{{ old('link', $banner->link) }}" >
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">به‌روزرسانی</button>
                                <a href="{{ route('banner.index') }}" class="btn btn-secondary">لغو</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- اسکریپت‌ها --}}
    <script>

        // پیش‌نمایش تصویر توضیحات
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        });



    </script>
@endsection
