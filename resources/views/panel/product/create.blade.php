@extends('panel.layouts.master')
@section('title','محصولات')

@section('top_page')
    <x-top-page title="فرم ایجاد محصول" :items="['فروشگاه','فرم ایجاد محصول']" homeUrl="/" />
@endsection

@section('content')
    <div class="col-sm-12 col-xl-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>فرم محصول</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="theme-form" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            {{-- نام محصول --}}
                            <div class="mb-3">
                                <label for="name" class="col-form-label pt-0">اسم محصول <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="عنوان را وارد کنید" value="{{ old('name') }}">
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- دسته‌بندی --}}
                            <div class="mb-3">
                                <label for="cat_id" class="form-label">انتخاب دسته‌بندی</label>
                                <select class="form-select digits" id="cat_id" name="cat_id">
                                    <option value="" disabled selected>انتخاب کنید</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('cat_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('cat_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- تصاویر چندگانه --}}
                            <div class="mb-3">
                                <label for="images" class="col-form-label pt-0">تصاویر محصول</label>
                                <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple>
                                <small class="form-text text-muted">فرمت‌های مجاز: jpg, jpeg, png</small>
                                <div id="imagesPreview" class="mt-3 d-flex flex-wrap gap-2"></div>
                            </div>

                            {{-- توضیحات --}}
                            <div class="mb-3">
                                <label for="description" class="col-form-label pt-0">توضیحات <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- تصویر توضیحات --}}
                            <div class="mb-3">
                                <label for="image_description" class="col-form-label pt-0">تصویر توضیحات</label>
                                <input type="file" class="form-control" id="image_description" name="image_description" accept="image/*">
                                <small class="form-text text-muted">فرمت‌های مجاز: jpg, jpeg, png</small>

                                <div class="mt-3 text-center" id="imageDescriptionContainer">
                                    <img id="image_descriptionPreview" src="" alt="پیش‌نمایش تصویر توضیحات"
                                         class="img-fluid rounded border shadow-sm"
                                         style="max-width:200px; max-height:100px; object-fit:cover; display:none;">
                                </div>
                            </div>


                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="price">قیمت <span class="text-danger">*</span></label>
                                <input class="form-control" id="price" type="text" name="price"
                                       value="{{ old('price') }}" required>
                                @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- موجودی --}}
                            <div class="mb-3">
                                <label for="stock" class="col-form-label pt-0">تعداد <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="stock" name="stock" value="{{ old('stock') }}">
                                @error('stock') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- ویژگی‌ها --}}
                            <div class="mb-3">
                                <label for="attribute_value" class="form-label">انتخاب ویژگی</label>
                                <select class="form-select digits" id="attribute_value" name="attribute_value[]" multiple>

                                    @php
                                        // گروه بندی ویژگی‌ها
                                        $grouped = $attribute_values->groupBy(function($item) {
                                            return $item->attribute->name;
                                        });
                                    @endphp

                                    @foreach ($grouped as $attributeName => $values)
                                        <optgroup
                                            style="
                                                    font-weight: 900;
                                                    color: #1a1a1a;
                                                    font-size: 15px;
                                                    padding: 6px 0;
                                                "
                                            label="{{ $attributeName }} : ">
                                            @foreach ($values as $attribute_value)
                                                <option value="{{ $attribute_value->id }}"
                                                    {{ in_array($attribute_value->id, old('attribute_value', [])) ? 'selected' : '' }}>
                                                    {{ $attribute_value->value }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach

                                </select>
                                @error('attribute_value') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>


                            {{--                            <div class="mb-3">--}}
{{--                                <label for="attribute_value" class="form-label">انتخاب ویژگی</label>--}}
{{--                                <select class="form-select digits" id="attribute_value" name="attribute_value[]" multiple>--}}
{{--                                    @foreach ($attribute_values as $attribute_value)--}}
{{--                                        <option value="{{ $attribute_value->id }}"--}}
{{--                                            {{ in_array($attribute_value->id, old('attribute_value', [])) ? 'selected' : '' }}>--}}
{{--                                            {{ $attribute_value->attribute->name . ': ' . $attribute_value->value }}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                @error('attribute_value') <small class="text-danger">{{ $message }}</small> @enderror--}}
{{--                            </div>--}}

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">ایجاد</button>
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
        // پیش‌نمایش تصاویر چندگانه
        document.getElementById('images')?.addEventListener('change', function(e) {
            const preview = document.getElementById('imagesPreview');
            preview.innerHTML = '';
            Array.from(e.target.files).forEach(file => {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.className = 'img-fluid rounded border shadow-sm';
                img.style.width = '150px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                preview.appendChild(img);
            });
        });

        // پیش‌نمایش تصویر توضیحات
        document.getElementById('image_description')?.addEventListener('change', function(e) {
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
    </script>
@endsection
