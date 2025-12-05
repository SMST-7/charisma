@extends('panel.layouts.master')

@section('title', 'پروفایل کاربری')

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

    <x-top-page title="پروفایل کاربری" :items="['فروشگاه','پروفایل']" homeUrl="/" />
@endsection

@section('content')
    <div class="col-xl-9 col-lg-10 mx-auto">
        <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
            <div class="card-header bg-gradient-primary text-white py-4">
                <h5 class="mb-0 text-center text-lg-start">
                    <i class="fa fa-user-edit me-2"></i> ویرایش پروفایل
                </h5>
            </div>

            <div class="card-body p-5">
                <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-2xl p-5 mb-5 shadow-sm">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center">
                            <i class="fa fa-shield-alt text-2xl text-amber-600"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-amber-900 mb-1 flex items-center gap-2">
                                <i class="fa fa-exclamation-circle"></i>
                                امنیت حساب شما مهم است
                            </h4>
                            <p class="text-amber-800 leading-relaxed">
                                برای اعمال هرگونه تغییر در پروفایل، تأیید هویت با وارد کردن
                                <strong class="text-amber-900">رمز عبور فعلی</strong> الزامی است.
                            </p>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger rounded-3 border-0 mb-4">
                        <strong>خطا در ورود اطلاعات:</strong>
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update', $user->id) }}" class="needs-validation" novalidate>
                     @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <!-- نام و نام کاربری -->
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold">نام کامل</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg"
                                   value="{{ old('name', $user->name) }}" required>
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="username" class="form-label fw-semibold">نام کاربری</label>
                            <input type="text" name="username" id="username" class="form-control form-control-lg"
                                   value="{{ old('username', $user->username) }}" required>
                            @error('username') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- رمز عبور فعلی (الزامی برای تغییر) -->
                        <div class="col-md-6">
                            <label for="current_password" class="form-label fw-semibold">
                                رمز عبور فعلی <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="password" name="current_password" id="current_password"
                                       class="form-control form-control-lg" placeholder="برای اعمال تغییرات وارد کنید" required>
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                            @error('current_password') <small class="text-danger d-block">{{ $message }}</small> @enderror
                        </div>

                        <!-- رمز جدید -->
                        <div class="col-md-6">
                            <label for="password" class="form-label fw-semibold">رمز عبور جدید (اختیاری)</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password"
                                       class="form-control form-control-lg" placeholder="خالی بگذارید = بدون تغییر">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fa fa-eye-slash"></i>
                                </button>
                            </div>
                            @error('password') <small class="text-danger d-block">{{ $message }}</small> @enderror
                        </div>

                        <!-- تکرار رمز -->
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label fw-semibold">تکرار رمز عبور جدید</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="form-control form-control-lg" placeholder="رمز جدید را تکرار کنید">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fa fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- دکمه‌ها -->
                    <div class="text-center mt-5 pt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-lg px-5 py-3 shadow me-3">
                            <i class="fa fa-save me-2"></i>
                            ذخیره تغییرات
                        </button>
                        <button type="reset" class="btn btn-light btn-lg px-5 py-3">
                            <i class="fa fa-undo me-2"></i>
                            لغو تغییرات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- اسکریپت نمایش/مخفی کردن رمز عبور --}}
    <script>
        document.querySelectorAll('.toggle-password').forEach(btn => {
            btn.addEventListener('click', function () {
                const input = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            });
        });
    </script>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .toggle-password {
            cursor: pointer;
        }
        .alert-warning {
            background: linear-gradient(90deg, #fff8e1, #fff3e0);
            border-left: 5px solid #ffb300;
        }
    </style>
@endsection
