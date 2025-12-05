@extends('panel.layouts.master')
@section('title','سرویس')

@section('top_page')
    <x-top-page title="فرم ایجاد سرویس " :items="['فروشگاه','فرم ایجاد سرویس ']" homeUrl="/" />
@endsection

@section('content')

    <div class="col-sm-12 col-xl-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>فرم سرویس </h5>
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

                        <form class="theme-form" action="{{route('service.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="title">عنوان <span class="text-danger">*</span></label>
                                <input class="form-control" id="title" type="text" name="title"
                                       placeholder="عنوان سرویس را وارد کنید" value="{{ old('title') }}" required>
                                @error('title')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="description">توضیح <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="description" rows="3" name="description">{{ old('description') }}</textarea>
                                @error('description')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="image">تصویر (اختیاری)</label>
                                <input class="form-control" id="image" type="file" name="image" accept="image/*">
                                <small class="form-text text-muted">فقط فایل‌های تصویری (jpg, png, jpeg) مجاز هستند.</small>
                                <div class="mt-3 text-center">
                                    <img id="imagePreview"
                                         class=" border rounded shadow-sm p-2"
                                         src=""
                                         alt="پیش‌نمایش تصویر"
                                         style="max-width: 200px; max-height: 100px; object-fit: cover; display: none;">
                                </div>
                            </div>

                            <div class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">ایجاد سرویس</button>
                                <a href="{{ route('service.index') }}" class="btn btn-secondary">لغو</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // پیش‌نمایش تصویر
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });
    </script>
@endsection
