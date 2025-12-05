@extends('panel.layouts.master')
@section('title','دسته بندی')

@section('top_page')
    <x-top-page title="ویرایش دسته بندی" :items="['فروشگاه','ویرایش دسته بندی']" homeUrl="/" />
@endsection

        @section('content')

            <div class="col-sm-12 col-xl-8">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h5>فرم دسته بندی</h5>
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
                                <form class="theme-form" action="{{route('category.update',$category->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="title">عنوان <span class="text-danger">*</span></label>
                                        <input class="form-control" id="title" type="text" name="title" value="{{ old('title', $category->title) }}" aria-describedby="titleHelp" placeholder="عنوان دسته‌بندی را وارد کنید" required>
                                        @error('title')
                                        <small class="text-danger" id="titleHelp">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- تصویر دسته‌بندی --}}
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="image">تصویر دسته‌بندی</label>
                                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                        <small class="form-text text-muted">فرمت‌های مجاز: jpg, jpeg, png</small>
                                        @error('image') <small class="text-danger d-block">{{ $message }}</small> @enderror

                                        {{-- بخش نمایش تصویر (فعلی یا جدید) --}}
                                        <div class="mt-3 text-center">
                                            <div id="imagePreviewContainer" class="d-inline-block border rounded shadow-sm p-2">
                                                @if ($category->image)
                                                    <img id="imagePreview" src="{{ asset('panel/pictures/' . $category->image) }}"
                                                         class="img-fluid rounded"
                                                         style="max-width: 200px; max-height: 100px; object-fit: cover;">
                                                @else
                                                    <span id="noImageText" class="text-muted">بدون تصویر</span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- گزینه حذف تصویر --}}
                                        @if ($category->image)
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="remove_image" id="removeImage" value="1">
                                                <label class="form-check-label" for="removeImage">حذف تصویر فعلی</label>
                                            </div>
                                        @endif
                                    </div>


                                    <div class="mb-3">
                                        <label class="form-label" for="parent_id">دسته‌بندی والد</label>
                                        <select class="form-select digits" id="parent_id" name="parent_id">
                                            <option value="">بدون والد</option>
                                        @foreach($categories as $cat)
                                            @if ($cat->id !== $category->id) <!-- جلوگیری از انتخاب خود دسته‌بندی -->
                                                <option value="{{ $cat->id }}" {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>{{ $cat->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('parent_id')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="card-footer text-end">
                                        <button class="btn btn-primary" type="submit">به‌روزرسانی</button>
                                        <a href="{{ route('category.index') }}" class="btn btn-secondary">لغو</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>


                </div>
            </div>

            <script>
                document.getElementById('image').addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    const preview = document.getElementById('imagePreview');
                    const noImageText = document.getElementById('noImageText');

                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            if (preview) {
                                preview.src = e.target.result; // تغییر تصویر موجود
                            } else {
                                // اگر قبلاً تصویری نبود، بسازش
                                const img = document.createElement('img');
                                img.id = 'imagePreview';
                                img.src = e.target.result;
                                img.className = 'img-fluid rounded';
                                img.style.maxWidth = '200px';
                                img.style.maxHeight = '100px';
                                img.style.objectFit = 'cover';

                                document.getElementById('imagePreviewContainer').innerHTML = '';
                                document.getElementById('imagePreviewContainer').appendChild(img);
                            }
                        };
                        reader.readAsDataURL(file);

                        if (noImageText) {
                            noImageText.style.display = 'none';
                        }
                    }
                });
            </script>



        @endsection
