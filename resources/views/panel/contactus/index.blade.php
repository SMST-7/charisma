@extends('panel.layouts.master')
@section('title','ارتباط با ما')

@section('top_page')
    <!-- پیام فلش -->
    @if (session('success'))
        <div class="alert alert-success  p-[12px]" id="success-alert">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger  p-[12px]" id="error-alert">{{ session('error') }}</div>
    @endif
    <x-top-page title="ارتباط با ما" :items="['داشبورد','ارتباط با ما']" homeUrl="/" />
@endsection
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
<h5>ارتباط با ما</h5>
            </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">نام و نام خانوادگی</th>
                <th scope="col">شماره همراه</th>
                <th scope="col">پیام</th>
                <th scope="col">عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($messages as $message)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{$message->fname}}</td>
                <td>{{$message->phone}}</td>
                <td>{{ \Illuminate\Support\Str::limit($message->message, 20) }}</td>
                <td>
                    <form action="{{ route('contactus.toggleStatus', $message->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm {{ $message->status ? 'btn-success' : 'btn-secondary' }}">
                            {{ $message->status ? 'خوانده شده' : 'خوانده نشده' }}
                        </button>
                    </form>
                </td>
                <td> <a href="{{ route('contactus.show', $message->id) }}" target="_blank" class="text-decoration-none text-primary">
                        <i data-feather="external-link" class="me-1"></i> مشاهده
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <br>

        <div class="row align-items-center mb-3 px-3">
            <!-- اطلاعات نمایش رکوردها -->
            <div class="col-auto">
                <div class="dataTables_info" role="status" aria-live="polite">
                    @if($messages->count() > 0)
                        نمایش {{ $messages->firstItem() }} تا {{ $messages->lastItem() }} از {{ $messages->total() }} مورد
                    @else
                        <p>رکوردی وجود ندارد</p>
                    @endif
                </div>
            </div>

            <!-- Pagination -->
            @if ($messages->hasPages())
                <div class="col text-end">
                    <ul class="pagination mb-0">
                        <!-- دکمه قبلی -->
                        <li class="paginate_button page-item {{ $messages->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $messages->previousPageUrl() }}">قبلی</a>
                        </li>

                        <!-- شماره صفحات -->
                        @foreach ($messages->getUrlRange(1, $messages->lastPage()) as $page => $url)
                            <li class="paginate_button page-item {{ $page == $messages->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        <!-- دکمه بعدی -->
                        <li class="paginate_button page-item {{ $messages->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $messages->nextPageUrl() }}">بعدی</a>
                        </li>
                    </ul>
                </div>
            @endif
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
