@extends('panel.layouts.master')

        @section('content')
            <!-- Container-fluid starts-->
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
                                            <th scope="col">محصول</th>
                                            <th scope="col">نام محصول</th>
                                            <th scope="col">سایز</th>
                                            <th scope="col">رنگ</th>
                                            <th scope="col">کد سفارش</th>
                                            <th scope="col">تعداد</th>
                                            <th scope="col">قیمت</th>
                                            <th scope="col"><i class="fa fa-angle-down"></i></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><a href="product-page.html"><img class="img-fluid img-30"
                                                                                 src="../assets/images/product/1.png" alt="#"></a></td>
                                            <td>
                                                <div class="product-name"><a href="#">تاپ بلند</a>
                                                    <div class="order-process"><span class="order-process-circle"></span>در حال پردازش</div>
                                                </div>
                                            </td>
                                            <td>متوسط</td>
                                            <td>آبی</td>
                                            <td>4215738</td>
                                            <td>1</td>
                                            <td>21,000 تومان</td>
                                            <td><i data-feather="more-vertical"></i></td>
                                        </tr>
                                        <tr>
                                            <td><a href="product-page.html"><img class="img-fluid img-30"
                                                                                 src="../assets/images/product/13.png" alt="#"></a></td>
                                            <td>
                                                <div class="product-name"><a href="#">ساعت فانتزی</a>
                                                    <div class="order-process"><span class="order-process-circle"></span>در حال پردازش</div>
                                                </div>
                                            </td>
                                            <td>بزرگ</td>
                                            <td>آبی</td>
                                            <td>5476182</td>
                                            <td>1</td>
                                            <td>10,000 تومان</td>
                                            <td><i data-feather="more-vertical"></i></td>
                                        </tr>
                                        <tr>
                                            <td><img class="img-fluid img-30" src="../assets/images/product/4.png" alt="#"></td>
                                            <td>
                                                <div class="product-name"><a href="#">کفش مردانه</a>
                                                    <div class="order-process"><span class="order-process-circle"></span>در حال پردازش</div>
                                                </div>
                                            </td>
                                            <td>کوچک</td>
                                            <td>سیاه و سفید</td>
                                            <td>1756457</td>
                                            <td>1</td>
                                            <td>18,000 تومان</td>
                                            <td><i data-feather="more-vertical"></i></td>
                                        </tr>
                                        <tr>
                                            <td><a href="product-page.html"><img class="img-fluid img-30"
                                                                                 src="../assets/images/product/10.png" alt="#"></a></td>
                                            <td>
                                                <div class="product-name"><a href="#">کیف کناری لدیس</a>
                                                    <div class="order-process"><span class="order-process-circle shipped-order"></span>در حال
                                                        ارسال
                                                    </div>
                                                </div>
                                            </td>
                                            <td>خیلی بزرگ</td>
                                            <td>قهوه ای</td>
                                            <td>7451725</td>
                                            <td>1</td>
                                            <td>13,000 تومان</td>
                                            <td><i data-feather="more-vertical"></i></td>
                                        </tr>
                                        <tr>
                                            <td><a href="product-page.html"><img class="img-fluid img-30"
                                                                                 src="../assets/images/product/12.png" alt="#"></a></td>
                                            <td>
                                                <div class="product-name"><a href="#">دمپایی لدیس</a>
                                                    <div class="order-process"><span class="order-process-circle shipped-order"></span>در حال
                                                        ارسال
                                                    </div>
                                                </div>
                                            </td>
                                            <td>بزرگ</td>
                                            <td>قهوه ای و سفید</td>
                                            <td>4127421</td>
                                            <td>1</td>
                                            <td>60,000 تومان</td>
                                            <td><i data-feather="more-vertical"></i></td>
                                        </tr>
                                        <tr>
                                            <td><a href="product-page.html"><img class="img-fluid img-30"
                                                                                 src="../assets/images/product/3.png" alt="#"></a></td>
                                            <td>
                                                <div class="product-name"><a href="#">کاپشن لدیس فانتزی</a>
                                                    <div class="order-process"><span class="order-process-circle shipped-order"></span>در حال
                                                        ارسال
                                                    </div>
                                                </div>
                                            </td>
                                            <td>خیلی بزرگ</td>
                                            <td>خاکستری روشن</td>
                                            <td>3581714</td>
                                            <td>1</td>
                                            <td>24,000 تومان</td>
                                            <td><i data-feather="more-vertical"></i></td>
                                        </tr>
                                        <tr>
                                            <td><a href="product-page.html"><img class="img-fluid img-30"
                                                                                 src="../assets/images/product/2.png" alt="#"></a></td>
                                            <td>
                                                <div class="product-name"><a href="#">کیف دستی لدیس</a>
                                                    <div class="order-process"><span class="order-process-circle shipped-order"></span>در حال
                                                        ارسال
                                                    </div>
                                                </div>
                                            </td>
                                            <td>متوسط</td>
                                            <td>سیاه</td>
                                            <td>6748142</td>
                                            <td>1</td>
                                            <td>14,000 تومان</td>
                                            <td><i data-feather="more-vertical"></i></td>
                                        </tr>
                                        <tr>
                                            <td><a href="product-page.html"><img class="img-fluid img-30"
                                                                                 src="../assets/images/product/15.png" alt="#"></a></td>
                                            <td>
                                                <div class="product-name"><a href="#">موبایل آیفون </a>
                                                    <div class="order-process"><span class="order-process-circle cancel-order"></span>لغو شده
                                                    </div>
                                                </div>
                                            </td>
                                            <td>خیلی خیلی بزرگ</td>
                                            <td>مشکی</td>
                                            <td>5748214</td>
                                            <td>1</td>
                                            <td>250,000 تومان</td>
                                            <td><i data-feather="more-vertical"></i></td>
                                        </tr>
                                        <tr>
                                            <td><a href="product-page.html"><img class="img-fluid img-30"
                                                                                 src="../assets/images/product/14.png" alt="#"></a></td>
                                            <td>
                                                <div class="product-name"><a href="#">ساعت</a>
                                                    <div class="order-process"><span class="order-process-circle cancel-order"></span>لغو شده
                                                    </div>
                                                </div>
                                            </td>
                                            <td>کوچک</td>
                                            <td>قهوه ای</td>
                                            <td>2471254</td>
                                            <td>1</td>
                                            <td>120,000 تومان</td>
                                            <td><i data-feather="more-vertical"></i></td>
                                        </tr>
                                        <tr>
                                            <td><a href="product-page.html"><img class="img-fluid img-30"
                                                                                 src="../assets/images/product/11.png" alt="#"></a></td>
                                            <td>
                                                <div class="product-name"><a href="#">دمپایی</a>
                                                    <div class="order-process"><span class="order-process-circle cancel-order"></span>لغو شده
                                                    </div>
                                                </div>
                                            </td>
                                            <td>متوسط</td>
                                            <td>آبی</td>
                                            <td>8475112</td>
                                            <td>1</td>
                                            <td>60,000 تومان</td>
                                            <td><i data-feather="more-vertical"></i></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends -->



    <div class="card">
        <div class="card-header pb-0">
            <h5>تاریخچه سفارشات</h5>
        </div>
        <div class="card-body">
            <div class="order-history table-responsive">
                <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                    <div class="dataTables_length" id="basic-1_length"><label>نمایش <select name="basic-1_length"
                                aria-controls="basic-1" class="">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select> مورد</label></div>
                    <div id="basic-1_filter" class="dataTables_filter"><label>جستجو : <input type="search" class=""
                                placeholder="" aria-controls="basic-1"></label></div>
                    <table class="table table-bordernone display dataTable no-footer" id="basic-1" role="grid"
                        aria-describedby="basic-1_info">
                        <thead>
                            <tr role="row">
                                <th scope="col" class="sorting_asc text-center" tabindex="0" aria-controls="basic-1" rowspan="1"
                                    colspan="1" aria-sort="ascending" aria-label="محصول: activate to sort column descending"
                                    style="width: 85.35px;">نام محصول</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                    aria-label="نام محصول: activate to sort column ascending" style="width: 144.238px;">
                                    نام خریدار</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                    aria-label="سایز: activate to sort column ascending" style="width: 104.15px;">مشخصات محصول</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                    aria-label="رنگ: activate to sort column ascending" style="width: 98.8125px;">قیمت</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                    aria-label="کد سفارش: activate to sort column ascending" style="width: 106.6px;">کد
                                    سفارش</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                    aria-label="تعداد: activate to sort column ascending" style="width: 62.5375px;">تعداد
                                </th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                    aria-label="قیمت: activate to sort column ascending" style="width: 87.15px;">تاریخ</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                    aria-label=": activate to sort column ascending" style="width: 31.5625px;"><i
                                        class="fa fa-angle-down"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr role="row" class="odd">
                                <td>
                                    <div class="product-name text-center"><a>تاپ بلند</a>
                                    </div>
                                </td>
                                <td>متوسط</td>
                                <td>آبی</td>
                                <td>4215738</td>
                                <td>1</td>
                                <td>21,000 تومان</td>
                                <td>21,000 تومان</td>
                                <td><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-more-vertical">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="12" cy="5" r="1"></circle>
                                        <circle cx="12" cy="19" r="1"></circle>
                                    </svg></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="dataTables_info" id="basic-1_info" role="status" aria-live="polite">نمایش 1 تا 10 از 10 مورد
                    </div>
                    <div class="dataTables_paginate paging_simple_numbers" id="basic-1_paginate"><a
                            class="paginate_button previous disabled" aria-controls="basic-1" data-dt-idx="0" tabindex="0"
                            id="basic-1_previous">قبلی</a><span><a class="paginate_button current" aria-controls="basic-1"
                                data-dt-idx="1" tabindex="0"> | </a></span><a class="paginate_button next disabled"
                            aria-controls="basic-1" data-dt-idx="2" tabindex="0" id="basic-1_next">بعدی</a></div>
                </div>
            </div>
        </div>
@endsection
