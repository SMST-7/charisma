@extends('panel.layouts.master')
@section('title','مقدار ویژگی ها')
@section('top_page')
    <x-top-page title="فرم مقدار ویژگی ها" :items="['فروشگاه','فرم مقدار ویژگی ها']" homeUrl="/" />

@endsection


        @section('content')


            <div class="col-sm-12 col-xl-8">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h5>فرم ارزش های ویژگی </h5>
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
                                <form class="theme-form" action="{{route('attribute_values.store')}}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="attribute_id">دسته‌بندی ویژگی<span class="text-danger">*</span></label>
                                        <select class="form-select digits" id="attribute_id" name="attribute_id" required>
                                            <option value="">انتخاب کنید:</option>
                                            @foreach($attributes as $attribute)
                                                <option value="{{ $attribute->id }}"
                                                    {{ (old('attribute_id') ?? request('attribute_id')) == $attribute->id ? 'selected' : '' }}>
                                                    {{ $attribute->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('attribute_id')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

{{--                                    <div class="mb-3">--}}
{{--                                        <label class="form-label" for="attribute_id">دسته‌بندی ویژگی<span class="text-danger">*</span></label>--}}
{{--                                        <select class="form-select digits" id="attribute_id" name="attribute_id" aria-describedby="attribute_idHelp" required>--}}
{{--                                            <option value=""> انتخاب کنید:</option>--}}
{{--                                            @foreach($attributes as $attribute)--}}
{{--                                                <option value="{{ $attribute->id }}" {{ old('attribute_id') == $attribute->id ? 'selected' : '' }}>{{ $attribute->name }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                        @error('attribute_id')--}}
{{--                                        <small class="text-danger" id="attribute_idHelp">{{ $message }}</small>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="value"> عنوان ویژگی<span class="text-danger">*</span></label>
                                        <input class="form-control" id="value" type="text" name="value" aria-describedby="valueHelp" placeholder="عنوان ویژگی را وارد کنید" value="{{ old('value') }}" required>
                                        @error('value')
                                        <small class="text-danger" id="valueHelp">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="card-footer text-end">
                                        <button class="btn btn-primary" type="submit">ایجاد ویژگی</button>
                                        <a href="{{ route('attribute_values.index') }}" class="btn btn-secondary">لغو</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
@endsection
