@extends('panel.layouts.master')
@section('title',' نطرات')

@section('top_page')
    <x-top-page title="نظرات" :items="['نظرات' , 'نمایش نظر']" homeUrl="/" />
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
        <div style="width: 500px;">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">کاربر</h5>
                    <p class="card-text">{{ $review->user?->name ?? 'مهمان' }}</p>
                    <hr>
                    <h5 class="card-title mb-3">محصول</h5>
                    <p class="card-text">{{ $review->product?->name ?? '---' }}</p>
                    <hr>
                    <h5 class="card-title mb-3">امتیاز</h5>
                    <p class="card-text">{{ $review->rating ?? '-' }}</p>
                    <hr>
                    <h5 class="card-title mb-3">وضعیت</h5>
                    <p class="card-text">
                        @if($review->status == 'approved')
                            <span class="badge bg-success">تأیید شده</span>
                        @elseif($review->status == 'pending')
                            <span class="badge bg-warning">در انتظار</span>
                        @else
                            <span class="badge bg-danger">رد شده</span>
                        @endif
                    </p>
                    <hr>
                    <h5 class="card-title mb-3">متن پیام</h5>
                    <p class="card-text">{{ $review->comment }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
