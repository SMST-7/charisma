@extends('panel.layouts.master')
@section('title','تاریخچه سفارشات')
@section('top_page')


    <!-- پیام فلش -->
    @if (session('success'))
        <div class="alert alert-success  p-[12px]" id="success-alert">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger  p-[12px]" id="error-alert">{{ session('error') }}</div>
    @endif
    <x-top-page title="تاریخچه سفارشات" :items="['فروشگاه','تاریخچه سفارشات  ']" homeUrl="/" />
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-header pb-0">
                        <h5>تاریخچه سفارشات</h5>
                    </div>

                    <div class="card-body">
                        <div class="order-history table-responsive">

                            <table class="table table-bordernone display" id="basic-1">
                                <thead>
                                <tr>
                                    <th class="text-center">نام محصول</th>
                                    <th>نام خریدار</th>
                                    <th>شماره تماس</th>
                                    <th>آدرس</th>
                                    <th>قیمت واحد</th>
                                    <th>تعداد</th>
                                    <th>قیمت کل</th>
                                    <th>کد سفارش</th>
                                    <th>تاریخ</th>
                                    <th><i class="fa fa-angle-down"></i></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($orderItems as $item)
                                    <tr>

                                        {{-- نام محصول --}}
                                        <td class="text-center">
                                            {{ $item->product->name ?? '---' }}
                                        </td>

                                        {{-- نام خریدار --}}
                                        <td>
                                            {{ $item->order->address->fname ?? '---' }}
                                        </td>

                                        {{-- شماره تماس --}}
                                        <td>
                                            {{ $item->order->address->phone ?? '---' }}
                                        </td>

                                        {{-- آدرس کامل --}}
                                        <td>
                                            {{ $item->order->address->province ?? '' }}
                                            {{ $item->order->address->city ?? '' }}
                                            - {{ $item->order->address->address ?? '' }}
                                        </td>

                                        {{-- قیمت واحد --}}
                                        <td>
                                            {{ number_format($item->price) }} تومان
                                        </td>

                                        {{-- تعداد --}}
                                        <td>
                                            {{ $item->quantity }}
                                        </td>

                                        {{-- قیمت کل آیتم --}}
                                        <td>
                                            {{ number_format($item->total) }} تومان
                                        </td>

                                        {{-- کد سفارش --}}
                                        <td>
                                            {{ $item->order_id }}
                                        </td>

                                        {{-- تاریخ --}}
                                        <td>
                                            {{ jdate($item->created_at)->format('Y/m/d') }}
                                        </td>

                                        {{-- آیکون --}}
                                        <td>
                                            <i data-feather="more-vertical"></i>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>

                            </table>

                            {{-- صفحه بندی --}}
                            <div class="mt-3">
                                {{ $orderItems->links() }}
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
