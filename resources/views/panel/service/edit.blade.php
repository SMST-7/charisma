@extends('panel.layouts.master')
@section('title','سرویس')

@section('top_page')
    <x-top-page title="ویرایش سرویس" :items="['فروشگاه','ویرایش سرویس']" homeUrl="/" />
@endsection

@section('content')
    <div class="col-sm-12 col-xl-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>فرم ویرایش سرویس</h5>
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

                        <form class="theme-form" action="{{ route('service.update', $service->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- عنوان --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="title">عنوان <span class="text-danger">*</span></label>
                                <input class="form-control" id="title" type="text" name="title"
                                       value="{{ old('title', $service->title) }}"
                                       placeholder="عنوان سرویس را وارد کنید" required>
                                @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- توضیحات --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="description">توضیحات <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $service->description) }}</textarea>
                                @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- تصویر --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="image">تصویر</label>
                                <input class="form-control" id="image" type="file" name="image" accept="image/*">
                                <small class="form-text text-muted">فرمت‌های مجاز: jpg, jpeg, png</small>

                                <div class="mt-3 text-center" id="imagePreviewContainer">
                                    @if ($service->image)
                                        <img id="imagePreview"
                                             class="d-inline-block border rounded shadow-sm p-2"
                                             src="{{ asset('panel/pictures/' . $service->image) }}"
                                             alt="پیش‌نمایش تصویر"
                                             style="max-width: 200px; max-height: 100px; object-fit: cover;">
</div>                                        <div class="mt-2">
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="remove_image" id="removeImage" value="1">
                                                <label class="form-check-label" for="removeImage">حذف تصویر فعلی</label>
                                            </div>

                                            @else
                                        <img id="imagePreview"
                                             class="d-inline-block border rounded shadow-sm p-2"
                                             src="{{ asset('panel/pictures/' . $service->image) }}"
                                             alt="پیش‌نمایش تصویر"
                                             style="max-width: 200px; max-height: 100px; object-fit: cover;">
                                        <div class="mt-2">
                                                <span class="text-muted">بدون تصویر</span></div>
                                            @endif
                                        </div>
                                </div>
                            {{-- وضعیت --}}
                            <div class="mb-3">
                                <label class="form-label" for="is_active">وضعیت</label>
                                <select class="form-select" id="is_active" name="is_active">
                                    <option value="1" {{ old('is_active', $service->is_active) == 1 ? 'selected' : '' }}>فعال</option>
                                    <option value="0" {{ old('is_active', $service->is_active) == 0 ? 'selected' : '' }}>غیرفعال</option>
                                </select>
                                <br>
                                <small class="form-text text-muted">
                                    وضعیت فعلی:
                                    <span class="{{ $service->is_active ? 'badge bg-success' : 'badge bg-danger' }}">
                                        {{ $service->is_active ? 'فعال' : 'غیرفعال' }}
                                    </span>
                                </small>
                                @error('is_active') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">به‌روزرسانی</button>
                                <a href="{{ route('service.index') }}" class="btn btn-secondary">لغو</a>
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
        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                imagePreview.src = URL.createObjectURL(file);
                imagePreview.style.display = 'block';
            } else {
                imagePreview.src = '';
                imagePreview.style.display = 'none';
            }
        });

        // خاکستری کردن هنگام انتخاب حذف تصویر
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
