@extends('panel.layouts.master')
@section('title','بنر')

@section('top_page')
    <x-top-page title="فرم ایجاد بنر" :items="['فروشگاه','فرم ایجاد بنر']" homeUrl="/" />
@endsection

@section('content')

    <div class="col-sm-12 col-xl-8">

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>فرم بنر </h5>
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
                        <form class="theme-form" action="{{route('banner.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="title">عنوان بنر </label>
                                <input class="form-control" id="title" type="text" name="title" value="{{old('title')}}" aria-describedby="titleHelp"
                                       placeholder="عنوان را وارد کنید">
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="image"> تصویر<span class="text-danger">*</span></label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                <small class="form-text text-muted">فرمت‌های مجاز: jpg, jpeg, png</small>
                                @error('image') <small class="text-danger d-block">{{ $message }}</small> @enderror

                                <div class="mt-3 text-center">
                                    <img  class=" border rounded shadow-sm p-2" id="imagePreview" src="" alt="پیش‌نمایش تصویر" class="img-fluid rounded" style="max-width: 200px; display: none; max-height: 100px; object-fit: cover;">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="link"> لینک</label>
                                <input class="form-control" id="link" type="text" name="link" value="{{old('link')}}" aria-describedby="linkHelp">
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" type="submit">ایجاد</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        // پیش‌نمایش تصویر
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });
    </script>
@endsection
