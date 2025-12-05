<!DOCTYPE html>
<html lang="fa" dir="rtl">
<style>
    body {
        color: #212529 !important; /* رنگ متن اصلی */
    }
    .form-control,
    .form-label,
    .card-body,
    .input-group-text{
        color: #212529 !important; /* متن‌های ورودی و لیبل */
    }
    ::placeholder {
        color: #6c757d !important; /* رنگ placeholder خاکستری ملایم */
        opacity: 1;
    }
    .btn-close {
        filter: none !important; /* دکمه بستن alert قابل دیدن باشه */
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به پنل مدیریت</title>
    <link rel="icon" href="{{ asset('panel/images/logo/favicon-icon.png') }}" type="image/x-icon">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('panel/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/css/vendors/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/css/color-1.css') }}">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="col-md-4 col-lg-3">
    <div class="card shadow border-0">
        <div class="card-body p-4">

            <h4 class="text-center mb-3 fw-bold">ورود</h4>
            <p class="text-muted text-center mb-4 small">خوش آمدید! لطفاً وارد حساب کاربری شوید</p>

            {{-- نمایش خطاها --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                    <ul class="mt-2 mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="بستن"></button>
                </div>
            @endif

            {{-- فرم ورود --}}
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                {{-- نام کاربری --}}
                <div class="mb-3">
                    <label for="username" class="form-label">نام کاربری</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input id="username" type="text" name="username" class="form-control"
                               value="{{ old('username') }}" required autofocus placeholder="نام کاربری خود را وارد کنید">
                    </div>
                </div>

                {{-- رمز عبور --}}
                <div class="mb-3">
                    <label for="password" class="form-label">رمز عبور</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        <input id="password" type="password" name="password" class="form-control"
                               required placeholder="رمز عبور خود را وارد کنید" autocomplete="current-password">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                </div>
                {{-- دکمه ورود --}}
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">وارد شوید</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="{{ asset('panel/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script>
    // دکمه نمایش/مخفی کردن رمز عبور
    const togglePassword = document.querySelector("#togglePassword");
    const passwordField = document.querySelector("#password");

    togglePassword.addEventListener("click", () => {
        const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);

        togglePassword.innerHTML =
            type === "password"
                ? '<i class="fa fa-eye"></i>'
                : '<i class="fa fa-eye-slash"></i>';
    });
</script>
</body>
</html>
