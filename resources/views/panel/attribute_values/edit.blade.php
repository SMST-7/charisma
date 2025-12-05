@extends('panel.layouts.master')
@section('title','مقدار ویژگی ها')
@section('top_page')

    <!-- پیام فلش -->
    @if (session('success'))
        <div class="alert alert-success  p-[12px]" id="success-alert">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger  p-[12px]" id="error-alert">{{ session('error') }}</div>
    @endif

    <x-top-page title="ویرایش مقدار ویژگی ها" :items="['فروشگاه','ویرایش مقدار ویژگی ها']" homeUrl="/" />
@endsection

        @section('content')

            <div class="col-sm-12 col-xl-8">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h5>فرم ارزش های ویژگی</h5>
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
                                <form class="theme-form" action="{{route('attribute_values.update',$attribute_value->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label class="form-label" for="attribute_id">دسته‌بندی ویژگی<span class="text-danger">*</span></label>
                                        <select class="form-select digits" id="attribute_id" name="attribute_id" aria-describedby="attribute_idHelp" required>
                                            <option value="{{old('attribute_id',$attribute_value->attribute_id)}}" selected>{{$attribute_value->attribute->name}}</option>
                                            @foreach($attributes as $attribute)
                                                <option value="{{ $attribute->id }}"
                                                    {{ old('attribute_id') == $attribute->id ? 'selected' : '' }}
                                                >{{ $attribute->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('attribute_id')
                                        <small class="text-danger" id="attribute_idHelp">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="value"> عنوان ویژگی<span class="text-danger">*</span></label>
                                        <input class="form-control" id="value" type="text" name="value" aria-describedby="valueHelp" placeholder="عنوان ویژگی را وارد کنید" value="{{ old('value',$attribute_value->value) }}" required>
                                        @error('value')
                                        <small class="text-danger" id="valueHelp">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="card-footer text-end">
                                        <button class="btn btn-primary" type="submit">به‌روزرسانی</button>
                                        <a href="{{ route('attribute_values.index') }}" class="btn btn-secondary">لغو</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>


                </div>
            </div>

            <script>
                // مخفی کردن پیام‌های موفقیت و خطا پس از 3 ثانیه
                document.addEventListener('DOMContentLoaded', function () {
                    const successAlert = document.getElementById('success-alert');
                    const errorAlert = document.getElementById('error-alert');

                    if (successAlert) {
                        setTimeout(() => {
                            successAlert.classList.add('fade-out');
                            setTimeout(() => {
                                successAlert.style.display = 'none';
                            }, 500); // مدت زمان انیمیشن محو شدن
                            successAlert.style.display = 'none';
                        }, 3000);
                    }

                    if (errorAlert) {
                        setTimeout(() => {
                            errorAlert.classList.add('fade-out');
                            setTimeout(() => {
                                errorAlert.style.display = 'none';
                            }, 500); // مدت زمان انیمیشن محو شدن
                        }, 3500); // 500 میلی‌ثانیه قبل از پایان 3 ثانیه
                    }
                });
            </script>


            <style>
                /* استایل‌های بهبود یافته برای پیام‌های هشدار */
                .alert {
                    padding: 15px 14px;
                    margin: 20px 25px;
                    border-radius: 12px;
                    text-align: center;
                    font-family: 'Poppins', sans-serif;
                    font-size: 15px;
                    font-weight: 500;
                    position: relative;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    transition: opacity 0.5s ease-in-out;
                    max-width: 40%; /* کاهش عرض پیام‌ها */
                    width: 40%;
                }

                .alert-success {
                    background-color: #e6f4ea;
                    color: #2e7d32;
                    border: 1px solid #a5d6a7;
                }

                .alert-danger {
                    background-color: #fce4e4;
                    color: #c62828;
                    border: 1px solid #ef9a9a;
                }

                /* انیمیشن محو شدن */
                .alert.fade-out {
                    opacity: 0;
                }


                /* ریسپانسیو کردن جدول برای صفحه‌نمایش‌های کوچک */
                @media screen and (max-width: 767px) {
                    /* تنظیم پیام‌ها در موبایل */
                    .alert {
                        font-size: 14px;
                        padding: 12px 18px;
                    }
                }

            </style>
@endsection
