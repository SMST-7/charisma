@extends('panel.layouts.master')
@section('title','تنظیمات سایت')

@section('top_page')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <x-top-page title="ویرایش تنظیمات سایت" :items="['پنل مدیریت','تنظیمات']" homeUrl="/" />
@endsection

@section('content')
    <div class="col-sm-12 col-xl-9 mx-auto">
        <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
            <div class="card-header bg-gradient-primary text-white py-4">
                <h5 class="mb-0 text-center text-lg-start">
                    تنظیمات سایت
                </h5>
            </div>

            <div class="card-body p-5">
                @if ($errors->any())
                    <div class="alert alert-danger rounded-3 border-0 mb-4">
                        <strong>خطا در ورود اطلاعات:</strong>
                        <ul class="mt-2 mb-0 text-dark">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('setting.update') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf @method('PUT')

                    <!-- تنظیمات عمومی -->
                    <div class="bg-light rounded-3 p-4 mb-5 border">
                        <h6 class="text-primary fw-bold mb-4 d-flex align-items-center">
                            تنظیمات عمومی
                        </h6>

                        <!-- لوگو -->
                        <div class="row align-items-center mb-4">
                            <div class="col-md-6">
                                <label for="logo" class="form-label fw-bold text-dark">لوگو سایت</label>
                                <input type="file" id="logo" name="logo" class="form-control form-control-lg" accept="image/*">
                                <small class="text-dark fw-medium">فرمت‌های مجاز: PNG, JPG, JPEG, SVG</small>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="preview-box p-3 bg-white rounded-3 shadow-sm">
                                    @if($setting->logo)
                                        <img src="{{ asset($setting->logo) }}" class="img-thumbnail" style="height:110px; width:auto;">
                                        <p class="small text-success mt-2 mb-0 fw-semibold">لوگوی فعلی</p>
                                    @else
                                        <div class="text-dark py-4 fw-medium">لوگو انتخاب نشده</div>
                                    @endif
                                    <img id="logoPreview" src="" class="img-thumbnail mt-3 d-none" style="height:110px;">
                                </div>
                            </div>
                        </div>

                        <!-- فاوآیکن -->
                        <div class="row align-items-center mb-4">
                            <div class="col-md-6">
                                <label for="favicon" class="form-label fw-bold text-dark">فاوآیکن (Favicon)</label>
                                <input type="file" id="favicon" name="favicon" class="form-control" accept=".png,.ico">
                                <small class="text-dark fw-medium">توصیه: ۳۲×۳۲ یا ۶۴×۶۴ پیکسل</small>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="preview-box p-3 bg-white rounded-3 shadow-sm">
                                    @if($setting->favicon)
                                        <img src="{{ asset($setting->favicon) }}" class="img-thumbnail" style="height:70px;">
                                        <p class="small text-success mt-2 mb-0 fw-semibold">فاوآیکن فعلی</p>
                                    @else
                                        <div class="text-dark py-3 fw-medium">فاوآیکن انتخاب نشده</div>
                                    @endif
                                    <img id="faviconPreview" src="" class="img-thumbnail mt-3 d-none" style="height:70px;">
                                </div>
                            </div>
                        </div>

                        <!-- متا -->
                        <div class="mb-4">
                            <label for="meta_description" class="form-label fw-bold text-dark">توضیحات متا (Meta Description)</label>
                            <textarea name="meta_description" id="meta_description" rows="4" class="form-control"
                                      placeholder="توضیح کوتاه سایت برای موتورهای جستجو (حداکثر ۱۶۰ کاراکتر)...">{{ old('meta_description', $setting->meta_description) }}</textarea>
                        </div>
                    </div>

                    <!-- فوتر -->
                    <div class="bg-light rounded-3 p-4 mb-5 border">
                        <h6 class="text-primary fw-bold mb-4 d-flex align-items-center">
                            اطلاعات فوتر
                        </h6>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">توضیحات فوتر</label>
                                <textarea name="description" rows="3" class="form-control" placeholder="متن نمایش داده شده در پایین سایت">{{ old('description', $footer->description) }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">آدرس</label>
                                <input type="text" name="address" class="form-control" placeholder="آدرس کامل شرکت یا فروشگاه" value="{{ old('address', $footer->address) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">شماره تماس 1</label>
                                <input type="text" name="phone" class="form-control" placeholder="مثال: 021-12345678" value="{{ old('phone', $footer->phone) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">شماره تماس 2</label>
                                <input type="text" name="phone2" class="form-control" placeholder="مثال: 021-12345678" value="{{ old('phone2', $footer->phone2) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">ایمیل</label>
                                <input type="email" name="email" class="form-control" placeholder="example@domain.com" value="{{ old('email', $footer->email) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">اینستاگرام</label>
                                <input type="text" name="instagram" class="form-control" placeholder="@username یا لینک کامل" value="{{ old('instagram', $footer->instagram) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">تلگرام</label>
                                <input type="text" name="telegram" class="form-control" placeholder="لینک کانال یا بات" value="{{ old('telegram', $footer->telegram) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">ایتا</label>
                                <input type="text" name="eitaa" class="form-control" placeholder="لینک کانال ایتا" value="{{ old('eitaa', $footer->eitaa) }}">
                            </div>
                        </div>
                    </div>

                    <!-- حمل و نقل -->
                    <div class="bg-light rounded-3 p-4 border">
                        <h6 class="text-primary fw-bold mb-4 d-flex align-items-center">
                            تنظیمات حمل و نقل
                        </h6>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">نام روش ارسال</label>
                                <input type="text" name="shipping_name" class="form-control" placeholder="مثال: پست پیشتاز، تیپاکس" value="{{ old('shipping_name', optional($shipping)->name) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">هزینه ارسال (تومان)</label>
                                <input type="number" name="shipping_cost" class="form-control" placeholder="مثال: 45000" value="{{ old('shipping_cost', optional($shipping)->cost) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">زمان تحویل</label>
                                <input type="text" name="delivery_time" class="form-control" placeholder="مثال: ۲ تا ۴ روز کاری" value="{{ old('delivery_time', optional($shipping)->delivery_time) }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold text-dark">توضیحات حمل و نقل</label>
                                <textarea name="shipping_description" rows="3" class="form-control" placeholder="جزئیات ارسال، شرایط رایگان شدن، مناطق تحت پوشش و...">{{ old('shipping_description', optional($shipping)->description) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- دکمه ذخیره -->
                    <div class="text-center mt-5 pt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-lg px-5 py-3 shadow">
                            به‌روزرسانی تنظیمات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- اسکریپت پیش‌نمایش تصاویر --}}
    <script>
        function preview(inputId, previewId) {
            document.getElementById(inputId)?.addEventListener('change', function() {
                const file = this.files[0];
                const preview = document.getElementById(previewId);
                if (file) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                    }
                    reader.readAsDataURL(file);
                } else {
                    preview.classList.add('d-none');
                }
            });
        }

        preview('logo', 'logoPreview');
        preview('favicon', 'faviconPreview');
    </script>

    <style>
        .preview-box { transition: all 0.3s ease; }
        .preview-box:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1)!important; }
        .bg-gradient-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }

        /* اطمینان از خوانایی کامل متن‌ها */
        .text-dark { color: #212529 !important; }
        .form-label { color: #212529 !important; }
        small, .form-text { color: #212529 !important; opacity: 0.9; }
        ::placeholder { color: #555 !important; opacity: 0.8; }
    </style>
@endsection
