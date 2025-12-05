@extends('panel.layouts.master')
@section('title','ارتباط با ما')

@section('top_page')
    <x-top-page title="ارتباط با ما" :items="['ارتباط با ما' , 'نمایش پیام']" homeUrl="/" />
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
        <div style="width: 400px;">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">نام و نام خانوادگی</h5>
                    <p class="card-text">{{ $message->fname }}</p>
                    <hr>
                    <h5 class="card-title mb-3">شماره تماس</h5>
                    <p class="card-text">{{ $message->phone }}</p>
                    <hr>
                    <h5 class="card-title mb-3">متن پیام</h5>
                    <p class="card-text">{{ $message->message }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
