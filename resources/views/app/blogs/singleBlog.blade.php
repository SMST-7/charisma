@extends('app.home.master')
@section('title',' مقاله : '.$blog->slug)
@section('content')

    <section class="section-breadcrumb mb-12 border-b border-gray-200 bg-gray-50">
        <div class="container mx-auto flex flex-wrap justify-between items-center py-5 px-4">
            <div class="w-full md:w-1/2">
                <h2 class="text-lg md:text-xl font-bold text-gray-800">مقالات</h2>
            </div>
            <div class="w-full md:w-1/2">
                <ul class="flex justify-end md:justify-end items-center space-x-2 text-gray-600 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-blue-600 font-medium">خانه</a></li>
                    <li><i class="ri-arrow-left-double-fill mx-1"></i></li>
                    <li class="font-medium text-gray-700"> مقالات کاریزما</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="section-blog-details py-12">
        <div class="container mx-auto px-4">
            <div class="bg-white shadow-md rounded-lg p-6">

                {{-- تصویر مقاله --}}
                @if($blog->image)
                    <div class="mb-6 flex justify-center">
                        <img src="{{ asset('uploads/blogs/' . $blog->image) }}"
                             alt="{{ $blog->title }}"
                             class="w-full max-w-md h-auto rounded-lg object-cover shadow-sm">
                    </div>
                @endif

                {{-- تاریخ و عنوان --}}
                <div class="mb-4 text-gray-500 text-sm">
                    {{ $blog->updated_at }}
                </div>
{{--                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">{{ $blog->title }}</h1>--}}

                <h1  class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-6 tracking-tight">{{ $blog->title }}</h1>

                {{-- محتوا --}}
                <p class="text-gray-700 leading-relaxed mb-6 text-justify">{!! nl2br(e($blog->content)) !!}</p>
{{--                <p class="text-gray-700 leading-relaxed mb-6">{{ $blog->content }}</p>--}}

                @if($blog->reference_name)
                    <div class="border-t pt-4 mt-6">
                        <h5 class="text-lg font-semibold text-gray-800 mb-2"> کالای مرتبط</h5>
                        <a href="{{ $blog->reference_url }}" target="_blank" rel="noopener noreferrer"
                           class="text-blue-600 hover:underline font-medium">
                            {{ $blog->reference_name ?: $blog->reference_url }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection
