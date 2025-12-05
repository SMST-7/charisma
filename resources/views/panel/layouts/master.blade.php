@include('panel.layouts.header')


<!-- Page Body Start-->
<div class="page-body-wrapper">

    @include('panel.layouts.sidebar')

    <div class="page-body">
        <div class="container-fluid">

            <!-- Page Sidebar Ends-->
        @yield('top_page')

        <!-- Container-fluid starts-->
            <div class="container-fluid default-dash">
                <div class="row">
                    <!-- Website Analytics -->
                    @yield('content')

                </div>


                <!-- Root element of PhotoSwipe. Must have class pswp.-->
                <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="pswp__bg"></div>
                    <div class="pswp__scroll-wrap">
                        <div class="pswp__container">
                            <div class="pswp__item"></div>
                            <div class="pswp__item"></div>
                            <div class="pswp__item"></div>
                        </div>
                        <div class="pswp__ui pswp__ui--hidden">
                            <div class="pswp__top-bar">
                                <div class="pswp__counter"></div>
                                <button class="pswp__button pswp__button--close" title="بستن (Esc)"></button>
                                <button class="pswp__button pswp__button--share" title="اشتراک گذاری"></button>
                                <button class="pswp__button pswp__button--fs" title="تغییر فول اسکرین"></button>
                                <button class="pswp__button pswp__button--zoom" title="بزرگ نمایی/کوچک نمایی"></button>
                                <div class="pswp__preloader">
                                    <div class="pswp__preloader__icn">
                                        <div class="pswp__preloader__cut">
                                            <div class="pswp__preloader__donut"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                <div class="pswp__share-tooltip"></div>
                            </div>
                            <button class="pswp__button pswp__button--arrow--left" title="قبلی (جهت چپ)"></button>
                            <button class="pswp__button pswp__button--arrow--right" title="بعدی (جهت راست)"></button>
                            <div class="pswp__caption">
                                <div class="pswp__caption__center"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
</div>

@include('panel.layouts.footer')
