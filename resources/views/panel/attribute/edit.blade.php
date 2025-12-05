@extends('panel.layouts.master')
@section('title','ویژگی ها')
@section('top_page')
    <x-top-page title="فرم ویرایش ویژگی ها" :items="['فروشگاه','فرم ویرایش ویژگی ها']" homeUrl="/" />
@endsection

        @section('content')

            <div class="col-sm-12 col-xl-8">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h5>فرم محصول </h5>
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
                                <form class="theme-form" action="{{route('attribute.update',$attribute->id)}}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="name">عنوان <span class="text-danger">*</span></label>
                                        <input class="form-control" id="name" type="text" name="name" value="{{ old('name', $attribute->name) }}" aria-describedby="nameHelp" placeholder="عنوان ویژگی را وارد کنید" required>
                                        @error('name')
                                        <small class="text-danger" id="nameHelp">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="card-footer text-end">
                                        <button class="btn btn-primary" type="submit">به‌روزرسانی</button>
                                        <a href="{{ route('attribute.index') }}" class="btn btn-secondary">لغو</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
@endsection
