<!DOCTYPE html>
<html lang="fa" dir="rtl">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
        <meta name="description" content="ای می قالب چند منظوره برای ارائه دهندگان میزبانی وب" />
        <meta property="og:site_name" content="emyUI" />
        <meta property="og:url" content="https://designesia.ir" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="ایمی یو آی" />
        <meta name="author" content="designesia.ir (Amin Chavepour)" />
        <title>ای می | قالب چند منظوره برای ارائه دهندگان میزبانی وب</title>

        <!-- favicon -->
        <link rel="shortcut icon" href="{{ asset('web/image/favicon/favicon.png') }}" type="image/x-icon"/>

        <!-- Bootstrap & icons  -->
        <link rel="stylesheet" href="{{ asset('web/css/bootstrap.css') }}" />
        <link rel="stylesheet" href="{{ asset('web/fonts/fontawesome-5/css/all.css') }}" />
        <!-- Plugin'stylesheets  -->
        <link rel="stylesheet" href="{{ asset('web/plugins/slick/slick.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('web/plugins/fancybox/jquery.fancybox.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('web/plugins/aos/aos.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('web/plugins/nice-select/nice-select.min.css') }}" />

        <!-- Vendor stylesheets  -->
        <link rel="stylesheet" href="{{ asset('web/css/main.css') }}" />

        <!-- you can add your custom stylesheet in this file -->
        <link rel="stylesheet" href="{{ asset('web/css/custom.css') }}" />
    </head>

    <body>
        <!-- DELETE THIS IF YOU WANT TO REMOVE PAGELOADER ANIMATION -->
        <div class="preloader">
            <div class="preloader-container">
                <div class="lds-ring">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <span data-i18n="[html]genaral.loading" class="coodiv-text-10 color-blackish-blue"></span>
            </div>
        </div>
        <!-- DELETE THIS IF YOU WANT TO REMOVE PAGELOADER ANIMATION -->

        <!-- START site wrapper -->
        <div class="site-wrapper overflow-hidden">
            <!-- START template header -->
            <header class="site-header header-with-right-menu dark-mode-texts site-header--absolute fixed-header-layout">
                <div class="container">
                    <!-- START navbar -->
                    <nav class="navbar site-navbar offcanvas-active navbar-expand-lg px-0">
                        <!-- START Logo header -->
                        <div class="brand-logo mr-8">
                            <a href="index.html">
                                <!-- light version logo (logo must be black)-->
                                <img src="{{ asset('web/image/logo-main-black.png') }}" alt="" class="light-version-logo" />
                                <!-- Dark version logo (logo must be White)-->
                                <img src="{{ asset('web/image/logo-main-white.png') }}" alt="" class="dark-version-logo" />
                            </a>
                        </div>
                        <!-- END Logo header -->

                        <!-- START language area header -->
                        <div id="languagesystem" class="header-lang dropdown show position-static coodiv-z-index-1">
                            <a class="coodiv-text-10 btn-header-lang position-relative" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="feather icon-globe mr-2"></i><span data-i18n="[html]systems.langname"></span>
                            </a>
                            <div id="languagesystem-slector" class="header-lang-container dropdown-menu px-8 py-7 px-lg-15 py-lg-15 overflow-scroll-y" aria-labelledby="dropdownMenuLink"></div>
                        </div>
                        <!-- END language area header -->

                        <!-- START header main navbar -->
                        <div class="collapse navbar-collapse" id="mobile-menu">
                            <div class="navbar-nav-wrapper">
                                <ul id="header-navbar-links-vpn" class="navbar-nav main-menu"></ul>
                                <!-- Main header navbar -->
                            </div>
                        </div>
                        <!-- END header main navbar -->

                        <!-- START header left buttons -->
                        <div class="header-btn ml-auto ml-lg-10 mr-5 d-none d-xs-block position-relative">
                            <a class="btn btn-outline-light btn-auto-min-width px-7 coodiv-text-9 mr-2" href="#">ورود</a>
                            <a class="btn btn-warning btn-auto-min-width px-7 coodiv-text-9" href="#">شروع کنید</a>
                        </div>
                        <!-- START header left buttons -->

                        <!-- Mobile Menu Buttons-->
                        <button
                            class="navbar-toggler btn-close-off-canvas hamburger-icon border-0"
                            type="button"
                            data-toggle="collapse"
                            data-target="#mobile-menu"
                            aria-controls="mobile-menu"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                        >
                            <span class="hamburger hamburger--squeeze js-hamburger">
                                <span class="hamburger-box">
                                    <i class="feather icon-menu"></i>
                                    <i class="feather icon-x"></i>
                                </span>
                            </span>
                        </button>
                        <!--/ END Mobile Menu Buttons -->
                    </nav>
                    <!-- end navbar -->
                </div>
            </header>
            <!-- END template header -->

            <!-- START HERO AREA -->
            <div class="hero-area-coodiv vpn-version position-relative overflow-hidden pb-0 shadow">
                <!-- START hero area animations -->
                <div class="header-hero-backgrounds">
                    <div class="vpn-space-bg"><img src="{{ asset('web/image/header/vpn-version/bg.jpg') }}" alt="" /></div>

                    <div id="particles-bg"></div>

                    <div class="animated__header__items__inner" id="js-scene">
                        <div class="items__layer layer vpn-space-rocks-img" data-depth="0.2"><img src="{{ asset('web/image/header/vpn-version/space-men-rocks.svg') }}" alt="" /></div>
                        <div class="items__layer layer t-first" data-depth="0.1"><img src="{{ asset('web/image/header/sunset-version/moon.png') }}" alt="" /></div>
                    </div>
                    <div class="vpn-space-men-img"><img src="{{ asset('web/image/header/vpn-version/space-men.svg') }}" alt="" /></div>
                    <span class="vpn-version-ovellay-background"></span>
                </div>

                <div class="shape-1 coodiv-abs-tr" data-aos="fade-up" data-aos-duration="500" data-aos-once="true"><img src="{{ asset('web/image/header/helf-circle-01.png') }}" alt="" /></div>
                <div class="shape-2 coodiv-abs-tr" data-aos="fade-down-left" data-aos-duration="800" data-aos-delay="300" data-aos-once="true"><img src="{{ asset('web/image/header/helf-circle-02.png') }}" alt="" /></div>
                <div class="shape-3 coodiv-abs-tr" data-aos="fade-down-left" data-aos-duration="1100" data-aos-delay="600" data-aos-once="true"><img src="{{ asset('web/image/header/helf-circle-03.png') }}" alt="" /></div>
                <!-- END hero area animations -->

                <div class="container position-relative coodiv-z-index-2">
                    <!-- END HERO MAIN CONTENTS -->
                    <div class="row justify-content-start">
                        <!-- row -->
                        <div class="col-md-9 col-lg-7 col-xl-7">
                            <!-- column -->
                            <!-- START MAIN CONTENTS -->
                            <div class="hero-content dark-mode-texts text-left py-15 mb-lg-12">
                                <h4 class="coodiv-text-12 text-uppercase mb-3 coodiv-color-green-opacity-7">با ایمی یو آی</h4>
                                <h1 class="coodiv-text-3 text-white d-block mb-10">سریع ترین شبکه تولید محتوا.</h1>
                                <p class="coodiv-text-9 mb-0 coodiv-color-white-opacity-9 mb-10">
                                    با نسل بعدی CDN، ذخیره‌سازی لبه و سرویس بهینه‌سازی سریع‌تر از سریع‌ترین‌ها پیش بروید. ما عملکرد سریع رعد و برق را در هر مقیاسی ساده تر از همیشه می کنیم.
                                </p>

                                <div class="hero-btns d-flex flex-column flex-md-row justify-content-start mt-11">
                                    <a href="#" class="btn btn-red coodiv-hover-y mb-6 mb-md-0 rounded-25">14 روز به صورت رایگان امتحان کنید</a>
                                </div>
                            </div>
                            <!-- END MAIN CONTENTS -->
                        </div>
                        <!-- END column -->
                    </div>
                    <!-- END row -->
                </div>
                <!-- END hero MAIN CONTENTS -->

                <div class="rating-header-section py-9 coodiv-bg-blackish-blue-opacity-opacity-9 position-relative">
                    <div class="container">
                        <div class="row align-items-center dark-mode-texts">
                            <div class="col-lg-8">
                                <div class="section-title rating-header-text pr-lg-5 text-lg-left text-center">
                                    <h2 class="coodiv-text-8 mb-2 text-right">به +900.000 وب سایتی که قبلاً توسط راه اندازی شده اند بپیوندید</h2>
                                    <p class="coodiv-text-11 mb-0">تعهد ما به کیفیت اعتماد بسیاری از برندهای معروف را در صنایع خود جلب کرده است.</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xl-4 d-flex justify-content-lg-end justify-content-center mt-lg-0 mt-10">
                                <div class="reviews-overview text-center">
                                    <p class="coodiv-text-11 mb-1">بر اساس <strong>3,432 بررسی</strong></p>
                                    <span class="reviews-stars">
                                        <i class="feather icon-star-on"></i> <i class="feather icon-star-on"></i> <i class="feather icon-star-on"></i> <i class="feather icon-star-on"></i> <i class="feather icon-star-on"></i>
                                    </span>
                                    <p class="coodiv-text-11 mb-0">به ما <strong>4.89</strong>از 5 امتیاز <strong>داده شده است</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END HERO AREA -->

            <div class="why-section-companies pt-11 pb-9 pt-lg-24 pb-lg-24 bg-default-6">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-10-col-lg-9 col-xl-8">
                            <div class="section-title text-center mb-7 mb-lg-11">
                                <h2 class="title coodiv-text-4 mb-9">ما به شرکت های شگفت انگیز کمک کرده ایم تا سریعتر رشد کنند!</h2>
                                <p class="coodiv-text-8 px-lg-8 mb-0">
                                   بهینه ساز به طور خودکار فایل های استاتیک شما را کوچک، فشرده و بهینه می کند و یک API پردازش تصویر قدرتمند برای تغییر اندازه، برش و دستکاری تصاویر در زمان واقعی ارائه می کند.
                                </p>
                                <p></p>
                            </div>
                        </div>
                        <div class="col-12 col-md-11 col-lg-10 col-xl-9">
                            <div class="brand-logos d-flex justify-content-center align-items-center mx-n9 flex-wrap">
                                <div class="single-brand mx-9 py-7 coodiv-opacity-8 aos-init aos-animate" data-aos="zoom-in-right" data-aos-duration="500" data-aos-once="true">
                                    <img src="{{ asset('web/image/demo/customers/logo-01.png') }}" alt="#" />
                                </div>
                                <div class="single-brand mx-9 py-7 coodiv-opacity-8 aos-init aos-animate" data-aos="zoom-in-right" data-aos-duration="700" data-aos-once="true">
                                    <img src="{{ asset('web/image/demo/customers/logo-02.png') }}" alt="#" />
                                </div>
                                <div class="single-brand mx-9 py-7 coodiv-opacity-8 aos-init aos-animate" data-aos="zoom-in-right" data-aos-duration="900" data-aos-once="true">
                                    <img src="{{ asset('web/image/demo/customers/logo-03.png') }}" alt="#" />
                                </div>
                                <div class="single-brand mx-9 py-7 coodiv-opacity-8 aos-init aos-animate" data-aos="zoom-in-right" data-aos-duration="1100" data-aos-once="true">
                                    <img src="{{ asset('web/image/demo/customers/logo-04.png') }}" alt="#" />
                                </div>
                                <div class="single-brand mx-9 py-7 coodiv-opacity-8 aos-init aos-animate" data-aos="zoom-in-right" data-aos-duration="1300" data-aos-once="true">
                                    <img src="{{ asset('web/image/demo/customers/logo-05.png') }}" alt="#" />
                                </div>
                                <div class="single-brand mx-9 py-7 coodiv-opacity-8 aos-init aos-animate" data-aos="zoom-in-right" data-aos-duration="1500" data-aos-once="true">
                                    <img src="{{ asset('web/image/demo/customers/logo-06.png') }}" alt="#" />
                                </div>
                                <div class="single-brand mx-9 py-7 coodiv-opacity-8 aos-init aos-animate" data-aos="zoom-in-right" data-aos-duration="1500" data-aos-once="true">
                                    <img src="{{ asset('web/image/demo/customers/logo-07.png') }}" alt="#" />
                                </div>
                                <div class="single-brand mx-9 py-7 coodiv-opacity-8 aos-init aos-animate" data-aos="zoom-in-right" data-aos-duration="1500" data-aos-once="true">
                                    <img src="{{ asset('web/image/demo/customers/logo-08.png') }}" alt="#" />
                                </div>
                                <div class="single-brand mx-9 py-7 coodiv-opacity-8 aos-init aos-animate" data-aos="zoom-in-right" data-aos-duration="1500" data-aos-once="true">
                                    <img src="{{ asset('web/image/demo/customers/logo-09.png') }}" alt="#" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="our-vpn-main-features pt-11 pb-9 pt-lg-24 pb-lg-24 rounded-25 mx-lg-15 mx-7">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7 col-md-12">
                            <div class="text-center mb-15">
                                <h4 class="pre-title coodiv-text-12 text-green text-uppercase mb-0">خدمات ما</h4>
                                <h3 class="review-text coodiv-text-5">ارزش های مشترک ما را در ارتباط نگه می دارند و ما را به عنوان یک تیم راهنمایی می کنند</h3>
                                <p class="coodiv-text-9 text-center">
                                    ما در حال ساختن نوع متفاوتی از شرکت هستیم، شرکتی که بر باز کردن پتانسیل مشتریانمان به سمت مناطق دارای ارزش افزوده بیشتر متمرکز است.. تحول دیجیتال یک سفر است و ما در کنار شما خواهیم بود و به شما کمک خواهیم کرد
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <div class="our-vpn-main-feature-item white-bg rounded-10 shadow-2 py-10 px-8 coodiv-hover-y mb-lg-0 mb-7">
                                <lord-icon src="{{ asset('web/https://cdn.lordicon.com/lupuorrc.json') }}" trigger="morph" colors="primary:#090e4e,secondary:#ffd583" style="width: 70px; height: 70px;"></lord-icon>
                                <h4 class="coodiv-text-8 mt-8">امکانات نامحدود</h4>
                                <p class="coodiv-text-10">این یک نوشته آزمایشی است که به طراحان</p>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="our-vpn-main-feature-item white-bg rounded-10 shadow-2 py-10 px-8 coodiv-hover-y mb-lg-0 mb-7">
                                <lord-icon src="{{ asset('web/https://cdn.lordicon.com/gqzfzudq.json') }}" trigger="morph" colors="primary:#090e4e,secondary:#ffd583" style="width: 70px; height: 70px;"></lord-icon>
                                <h4 class="coodiv-text-8 mt-8">آپتایم بالا</h4>
                                <p class="coodiv-text-10">این یک نوشته آزمایشی است که به طراحان</p>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="our-vpn-main-feature-item white-bg rounded-10 shadow-2 py-10 px-8 coodiv-hover-y mb-lg-0 mb-7">
                                <lord-icon src="{{ asset('web/https://cdn.lordicon.com/qhgmphtg.json') }}" trigger="morph" colors="primary:#090e4e,secondary:#ffd583" style="width: 70px; height: 70px;"></lord-icon>
                                <h4 class="coodiv-text-8 mt-8">سایت ساز</h4>
                                <p class="coodiv-text-10">این یک نوشته آزمایشی است که به طراحان</p>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="our-vpn-main-feature-item white-bg rounded-10 shadow-2 py-10 px-8 coodiv-hover-y mb-0">
                                <lord-icon src="{{ asset('web/https://cdn.lordicon.com/rqqkvjqf.json') }}" trigger="morph" colors="primary:#090e4e,secondary:#ffd583" style="width: 70px; height: 70px;"></lord-icon>
                                <h4 class="coodiv-text-8 mt-8">بهترین امنیت</h4>
                                <p class="coodiv-text-10">این یک نوشته آزمایشی است که به طراحان</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="light-mode-texts pt-13 pt-md-25 pb-13 pb-md-25">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 col-lg-6 mb-lg-n15 mb-6 mb-lg-0" data-aos="zoom-in-down" data-aos-duration="1100" data-aos-once="true">
                            <div class="content-img-svg-with-bg text-left pr-xl-13 ml-lg-n8 position-relative">
                                <span></span>
                                <img src="{{ asset('web/image/stubborn/svg/illustration-1.svg') }}" alt="" class="w-100 position-relative" />
                            </div>
                        </div>
                        <div class="col-xs-11 col-sm-12 col-md-6 col-lg-5 col-xl-5">
                            <div class="pl-lg-3 pl-xl-12 mt-12 mt-md-0 text-center text-lg-left">
                                <h4 class="pre-title coodiv-text-12 text-green text-uppercase mb-0">شبکه تحویل محتوا</h4>
                                <h2 class="title coodiv-text-4 mb-7">بهینه سازی و تبدیل تصاویر خود را در پرواز.</h2>
                                <p class="coodiv-text-8 coodiv-text-color-opacity">
                                    بهینه ساز به طور خودکار فایل های استاتیک شما را کوچک، فشرده و بهینه می کند و یک API پردازش تصویر قدرتمند برای تغییر اندازه، برش و دستکاری تصاویر در زمان واقعی ارائه می کند.
                                </p>
                                <div class="pt-7">
                                    <a href="" class="btn btn-warning with-icon text-white coodiv-text-9 px-10 font-weight-bold rounded-20">بیشتر بدانید<i class="feather icon-arrow-right font-weight-bold"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-section pt-18 pb-30 pt-lg-21 pb-lg-30">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-5 pr-lg-9 col-sm-10">
                            <div class="content-text text-center text-lg-left">
                                <h4 class="pre-title coodiv-text-12 text-green text-uppercase mb-0">ذخیره سازی لبه</h4>
                                <h2 class="coodiv--text-4 mb-8">فایل های خود را در لبه کپی و ذخیره کنید!</h2>
                                <p class="coodiv--text-8 pr-4 mb-11">به لطف تکرار جهانی در 4 قاره، ذخیره سازی لبه در مقایسه با ذخیره سازی ابری سنتی تا 5 برابر سرعت دانلود و تأخیر بیشتری را ارائه می دهد..</p>
                                <div class="content-btn">
                                    <a href="" class="btn btn-warning with-icon text-white coodiv-text-9 px-10 font-weight-bold rounded-20">اطلاعات بیشتر<i class="feather icon-arrow-right font-weight-bold"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 offset-lg-1 col-sm-10 mt-20 mt-lg-0">
                            <div class="content-img-svg-with-bg-2 img-coodiv-oup-1 position-relative px-lg-0 px-10" data-aos="zoom-in" data-aos-duration="500" data-aos-once="true">
                                <span></span>
                                <img src="{{ asset('web/image/stubborn/svg/illustration-10.svg') }}" alt="" class="w-100 position-relative" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="trusted-section overflow-hidden py-13 py-lg-25 pb-lg-35 bg-default-2 bg-pattern pattern-4 position-relative">
                <svg class="bg-wave-box-end-z1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path
                        fill="#ffffff"
                        fill-opacity="1"
                        d="M0,160L26.7,170.7C53.3,181,107,203,160,229.3C213.3,256,267,288,320,293.3C373.3,299,427,277,480,229.3C533.3,181,587,107,640,106.7C693.3,107,747,181,800,208C853.3,235,907,213,960,186.7C1013.3,160,1067,128,1120,106.7C1173.3,85,1227,75,1280,64C1333.3,53,1387,43,1413,37.3L1440,32L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z"
                    ></path>
                </svg>

                <div class="container">
                    <div class="row justify-content-center mb-15">
                        <div class="col-md-7 aos-init aos-animate" data-aos="fade-up" data-aos-duration="800" data-aos-once="true">
                            <div class="section-title text-center pr-lg-7 mb-0 light-mode-texts">
                                <h2 class="title coodiv-text-4 mb-3">مورد اعتماد بیش از 18000 مشتری</h2>
                                <div class="reviews-overview text-center">
                                    <span class="reviews-stars">
                                        <i class="feather icon-star-on"></i> <i class="feather icon-star-on"></i> <i class="feather icon-star-on"></i> <i class="feather icon-star-on"></i> <i class="feather icon-star-on"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden position-relative">
                    <div class="reviews-boxes full-width-review-box-container reviews-row-1 d-block d-lg-flex mt-10">
                        <div class="review-box white-bg rounded-20 shadow-2 py-8 px-10 position-relative mx-6">
                            <div class="rating d-flex justify-content-between">
                                <span class="stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                                <span class="date coodiv-text-11">5 آبان 1402</span>
                            </div>
                            <div class="review-box-body position-relative h-100">
                                <h5 class="coodiv-text-9">بهترین CDN در دنیا</h5>
                                <p class="coodiv-text-11">" خدمات عالی به خصوص قیمت بسیار عالی. من از example.net به عنوان CDN و ذخیره سازی فایل برنامه خود استفاده می کنم. تا اینجا سرعت (آپلود/دانلود) خوب به نظر می رسد. "</p>
                                <strong class="coodiv-text-11">— مهران دانی</strong>
                            </div>
                        </div>

                        <div class="review-box white-bg rounded-20 shadow-2 py-8 px-10 position-relative mx-6">
                            <div class="rating d-flex justify-content-between">
                                <span class="stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                                <span class="date coodiv-text-11">5 آبان 1402</span>
                            </div>
                            <div class="review-box-body position-relative h-100">
                                <h5 class="coodiv-text-9">بهترین CDN در دنیا</h5>
                                <p class="coodiv-text-11">" خدمات عالی به خصوص قیمت بسیار عالی. من از example.net به عنوان CDN و ذخیره سازی فایل برنامه خود استفاده می کنم. تا اینجا سرعت (آپلود/دانلود) خوب به نظر می رسد. "</p>
                                <strong class="coodiv-text-11">— مهران دانی</strong>
                            </div>
                        </div>

                        <div class="review-box white-bg rounded-20 shadow-2 py-8 px-10 position-relative mx-6">
                            <div class="rating d-flex justify-content-between">
                                <span class="stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                                <span class="date coodiv-text-11">5 آبان 1402</span>
                            </div>
                            <div class="review-box-body position-relative h-100">
                                <h5 class="coodiv-text-9">بهترین CDN در دنیا</h5>
                                <p class="coodiv-text-11">" خدمات عالی به خصوص قیمت بسیار عالی. من از example.net به عنوان CDN و ذخیره سازی فایل برنامه خود استفاده می کنم. تا اینجا سرعت (آپلود/دانلود) خوب به نظر می رسد. "</p>
                                <strong class="coodiv-text-11">— مهران دانی</strong>
                            </div>
                        </div>

                        <div class="review-box white-bg rounded-20 shadow-2 py-8 px-10 position-relative mx-6">
                            <div class="rating d-flex justify-content-between">
                                <span class="stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                                <span class="date coodiv-text-11">5 آبان 1402</span>
                            </div>
                            <div class="review-box-body position-relative h-100">
                                <h5 class="coodiv-text-9">بهترین CDN در دنیا</h5>
                                <p class="coodiv-text-11">" خدمات عالی به خصوص قیمت بسیار عالی. من از example.net به عنوان CDN و ذخیره سازی فایل برنامه خود استفاده می کنم. تا اینجا سرعت (آپلود/دانلود) خوب به نظر می رسد. "</p>
                                <strong class="coodiv-text-11">— مهران دانی</strong>
                            </div>
                        </div>

                        <div class="review-box white-bg rounded-20 shadow-2 py-8 px-10 position-relative mx-6">
                            <div class="rating d-flex justify-content-between">
                                <span class="stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                                <span class="date coodiv-text-11">5 آبان 1402</span>
                            </div>
                            <div class="review-box-body position-relative h-100">
                                <h5 class="coodiv-text-9">بهترین CDN در دنیا</h5>
                                <p class="coodiv-text-11">" خدمات عالی به خصوص قیمت بسیار عالی. من از example.net به عنوان CDN و ذخیره سازی فایل برنامه خود استفاده می کنم. تا اینجا سرعت (آپلود/دانلود) خوب به نظر می رسد. "</p>
                                <strong class="coodiv-text-11">— مهران دانی</strong>
                            </div>
                        </div>

                        <div class="review-box white-bg rounded-20 shadow-2 py-8 px-10 position-relative mx-6">
                            <div class="rating d-flex justify-content-between">
                                <span class="stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                                <span class="date coodiv-text-11">5 آبان 1402</span>
                            </div>
                            <div class="review-box-body position-relative h-100">
                                <h5 class="coodiv-text-9">بهترین CDN در دنیا</h5>
                                <p class="coodiv-text-11">" خدمات عالی به خصوص قیمت بسیار عالی. من از example.net به عنوان CDN و ذخیره سازی فایل برنامه خود استفاده می کنم. تا اینجا سرعت (آپلود/دانلود) خوب به نظر می رسد. "</p>
                                <strong class="coodiv-text-11">— مهران دانی</strong>
                            </div>
                        </div>
                    </div>

                    <div class="reviews-boxes full-width-review-box-container reviews-row-2 d-none d-lg-flex mt-10">
                        <div class="review-box white-bg rounded-20 shadow-2 py-8 px-10 position-relative mx-6">
                            <div class="rating d-flex justify-content-between">
                                <span class="stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                                <span class="date coodiv-text-11">5 آبان 1402</span>
                            </div>
                            <div class="review-box-body position-relative h-100">
                                <h5 class="coodiv-text-9">بهترین CDN در دنیا</h5>
                                <p class="coodiv-text-11">" خدمات عالی به خصوص قیمت بسیار عالی. من از example.net به عنوان CDN و ذخیره سازی فایل برنامه خود استفاده می کنم. تا اینجا سرعت (آپلود/دانلود) خوب به نظر می رسد. "</p>
                                <strong class="coodiv-text-11">— مهران دانی</strong>
                            </div>
                        </div>

                        <div class="review-box white-bg rounded-20 shadow-2 py-8 px-10 position-relative mx-6">
                            <div class="rating d-flex justify-content-between">
                                <span class="stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                                <span class="date coodiv-text-11">5 آبان 1402</span>
                            </div>
                            <div class="review-box-body position-relative h-100">
                                <h5 class="coodiv-text-9">بهترین CDN در دنیا</h5>
                                <p class="coodiv-text-11">" خدمات عالی به خصوص قیمت بسیار عالی. من از example.net به عنوان CDN و ذخیره سازی فایل برنامه خود استفاده می کنم. تا اینجا سرعت (آپلود/دانلود) خوب به نظر می رسد. "</p>
                                <strong class="coodiv-text-11">— مهران دانی</strong>
                            </div>
                        </div>

                        <div class="review-box white-bg rounded-20 shadow-2 py-8 px-10 position-relative mx-6">
                            <div class="rating d-flex justify-content-between">
                                <span class="stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                                <span class="date coodiv-text-11">5 آبان 1402</span>
                            </div>
                            <div class="review-box-body position-relative h-100">
                                <h5 class="coodiv-text-9">بهترین CDN در دنیا</h5>
                                <p class="coodiv-text-11">" خدمات عالی به خصوص قیمت بسیار عالی. من از example.net به عنوان CDN و ذخیره سازی فایل برنامه خود استفاده می کنم. تا اینجا سرعت (آپلود/دانلود) خوب به نظر می رسد. "</p>
                                <strong class="coodiv-text-11">— مهران دانی</strong>
                            </div>
                        </div>

                        <div class="review-box white-bg rounded-20 shadow-2 py-8 px-10 position-relative mx-6">
                            <div class="rating d-flex justify-content-between">
                                <span class="stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                                <span class="date coodiv-text-11">5 آبان 1402</span>
                            </div>
                            <div class="review-box-body position-relative h-100">
                                <h5 class="coodiv-text-9">بهترین CDN در دنیا</h5>
                                <p class="coodiv-text-11">" خدمات عالی به خصوص قیمت بسیار عالی. من از example.net به عنوان CDN و ذخیره سازی فایل برنامه خود استفاده می کنم. تا اینجا سرعت (آپلود/دانلود) خوب به نظر می رسد. "</p>
                                <strong class="coodiv-text-11">— مهران دانی</strong>
                            </div>
                        </div>

                        <div class="review-box white-bg rounded-20 shadow-2 py-8 px-10 position-relative mx-6">
                            <div class="rating d-flex justify-content-between">
                                <span class="stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                                <span class="date coodiv-text-11">5 آبان 1402</span>
                            </div>
                            <div class="review-box-body position-relative h-100">
                                <h5 class="coodiv-text-9">بهترین CDN در دنیا</h5>
                                <p class="coodiv-text-11">" خدمات عالی به خصوص قیمت بسیار عالی. من از example.net به عنوان CDN و ذخیره سازی فایل برنامه خود استفاده می کنم. تا اینجا سرعت (آپلود/دانلود) خوب به نظر می رسد. "</p>
                                <strong class="coodiv-text-11">— مهران دانی</strong>
                            </div>
                        </div>

                        <div class="review-box white-bg rounded-20 shadow-2 py-8 px-10 position-relative mx-6">
                            <div class="rating d-flex justify-content-between">
                                <span class="stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                                <span class="date coodiv-text-11">5 آبان 1402</span>
                            </div>
                            <div class="review-box-body position-relative h-100">
                                <h5 class="coodiv-text-9">بهترین CDN در دنیا</h5>
                                <p class="coodiv-text-11">" خدمات عالی به خصوص قیمت بسیار عالی. من از example.net به عنوان CDN و ذخیره سازی فایل برنامه خود استفاده می کنم. تا اینجا سرعت (آپلود/دانلود) خوب به نظر می رسد. "</p>
                                <strong class="coodiv-text-11">— مهران دانی</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-section bg-default-1 pt-13 pt-lg-15 pb-13 pb-lg-21 border-bottom">
                <div class="container">
                    <div class="row justify-content-center mb-15">
                        <div class="col-md-7 aos-init aos-animate" data-aos="fade-up" data-aos-duration="800" data-aos-once="true">
                            <div class="section-title text-center pr-lg-7 mb-0 light-mode-texts">
                                <h2 class="title coodiv-text-4 mb-3">بهترین تیم متخصص در خدمت شما</h2>
                                <p class="coodiv-text-9 mb-4">پشت نام ما یک تیم پرشور ایستاده است. ما عاشق عملکرد و کمک به موفقیت شما هستیم، حتی زمانی که این به معنای بیرون رفتن از منطقه راحتی ما باشد.</p>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-6">
                            <div class="content-img-group text-center mb-8 mb-lg-0 pr-lg-13">
                                <div class="main-image w-xs-75 w-lg-85 w-xl-75 mx-auto position-relative coodiv-z-index-1">
                                    <img class="rounded-10 w-100" src="{{ asset('web/image/stubborn/svg/illustration-14.svg') }}" alt="" />
                                </div>
                            </div>
                        </div>

                        <div class="col-10 col-lg-6">
                            <div class="section-title content-text mb-13">
                                <h2 class="title coodiv-text-7 mb-6">ارزش های مشترک ما را در ارتباط نگه می دارند و ما را به عنوان یک تیم راهنمایی می کنند.</h2>
                                <p class="coodiv-text-9">ما در حال ساختن نوع متفاوتی از شرکت هستیم، شرکتی که بر باز کردن پتانسیل مشتریانمان به سمت مناطق دارای ارزش افزوده بیشتر متمرکز است..</p>
                            </div>
                            <div class="content-widget">
                                <div class="row mb-n9">
                                    <div class="col-md-6 col-lg-9 col-xl-10 aos-init aos-animate" data-aos="fade-right" data-aos-duration="500" data-aos-once="true">
                                        <div class="single-widget mb-13">
                                            <h3 class="w-title coodiv-text-8">بهترین پلن میزبانی وب</h3>
                                            <p class="coodiv-text-11 mb-0">ما تکنولوژیست، طراح، بازاریاب و مربی هستیم، اما قبل از هر چیز.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="free-trial-section py-12 py-lg-30 dark-mode-texts bg-mirage bg-pattern pattern-6 position-relative">
                <div class="vpn-space-men-img-section"><img src="{{ asset('web/image/header/vpn-version/space-men.svg') }}" alt="" /></div>
                <div class="container">
                    <div class="row align-items-center align-items-center position-relative coodiv-z-index-2">
                        <div class="col-lg-6">
                            <div class="section-title free-trial-text pr-lg-5 text-lg-left text-center">
                                <h2 class="coodiv-text-5 mb-7">دوره آزمایشی خود را شروع کنید</h2>
                                <p class="coodiv-text-8 mb-0 text-right">به بیش از 18000 مشتری راضی که قبلاً از example.net استفاده می‌کنند بپیوندید و محتوای خود را سریع‌تر بارگیری کنید.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 offset-xl-1 col-xl-5 mt-lg-0 mt-10">
                            <div class="mt-5 mt-lg-0 text-lg-right text-center">
                                <a href="#" class="btn btn-red with-icon coodiv-hover-y rounded-25 mb-5">شروع 14 روز به صورت رایگان <i class="feather icon-arrow-right font-weight-bold"></i></a>
                                <p class="coodiv-text-9">بدون نیاز به کارت اعتباری - در چند ثانیه شروع کنید..</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dark-mode-texts footer-gradient-default-2 overflow-hidden bg-pattern pattern-5 position-relative pt-lg-25 pt-5">
                <span class="footer-with-svg-buttom-illustration"></span>
                <svg class="bg-wave-box-end" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path
                        fill="#414f7b"
                        fill-opacity="1"
                        d="M0,64L80,101.3C160,139,320,213,480,213.3C640,213,800,139,960,117.3C1120,96,1280,128,1360,144L1440,160L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"
                    ></path>
                </svg>
                <div class="container">
                    <!-- container -->
                    <div class="footer-section light-mode-texts">
                        <!-- footer section -->
                        <div id="footer-wrap-links" class="footer-top pt-15 pt-lg-5 pb-lg-19"></div>
                        <!-- footer wrap -->
                        <!-- footer Copyright section -->
                        <div class="bottom-footer-area pt-9 pb-8">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <p class="copyright-text coodiv-text-11 mb-6 mb-lg-0 coodiv-text-color-opacity text-center text-lg-left">
                                        طراحی و توسعه داده شده توسط آروین لری پور
                                        <i class="icon icon-heart-2-2 text-sky-blue align-middle ml-2"></i>
                                    </p>
                                </div>
                                <div class="col-lg-4 text-center text-lg-right">
                                    <ul class="payment-getway list-unstyled mb-0">
                                        <li class="ml-1"><img src="{{ asset('web/image/payment/sepehr.png') }}" alt="" /></li>
                                        <li class="ml-1"><img src="{{ asset('web/image/payment/sadad.png') }}" alt="" /></li>
                                        <li class="ml-1"><img src="{{ asset('web/image/payment/behpardakht.png') }}" alt="" /></li>
                                        <li class="ml-1"><img src="{{ asset('web/image/payment/pasargad.png') }}" alt="" /></li>
                                        <li class="ml-1"><img src="{{ asset('web/image/payment/saman.png') }}" alt="" /></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- END footer Copyright section -->
                    </div>
                    <!-- END footer section -->
                </div>
                <!-- END container -->
            </div>
            <!-- END template footer -->
        </div>
        <!-- END site wrapper -->

        <!-- Vendor Scripts -->
        <script src="{{ asset('web/js/vendor.min.js') }}"></script>
        <!-- Plugin's Scripts -->
        <script src="{{ asset('web/plugins/fancybox/jquery.fancybox.min.js') }}"></script>
        <script src="{{ asset('web/plugins/nice-select/jquery.nice-select.min.js') }}"></script>
        <script src="{{ asset('web/plugins/aos/aos.min.js') }}"></script>
        <script src="{{ asset('web/plugins/slick/slick.min.js') }}"></script>
        <script src="{{ asset('web/plugins/typed/typed.min.js') }}"></script>
        <script src="{{ asset('web/plugins/waypoints/jquery.waypoints.min.js') }}"></script>

        <script src="{{ asset('web/plugins/particles/particles-code.js') }}"></script>
        <script src="{{ asset('web/plugins/particles/particles.js') }}"></script>
        <script src="{{ asset('web/plugins/parallax/parallax.js') }}"></script>

        <script src="{{ asset('web/plugins/smoothscroll/smoothscroll.js') }}"></script>

        <script src="{{ asset('web/plugins/lordicon/lord-icon-2.1.0.min.js') }}"></script>

        <!-- Translate Scripts -->
        <script src="{{ asset('web/plugins/i18next/i18next.min.js') }}"></script>
        <script src="{{ asset('web/plugins/i18next/i18nextXHRBackend.min.js') }}"></script>
        <script src="{{ asset('web/plugins/i18next/jquery-i18next.min.js') }}"></script>

        <!-- Activation Script -->
        <script src="{{ asset('web/js/custom.js') }}"></script>

        <script>
            $(document).ready(function () {
                $scene = $("#js-scene");

                $scene.parallax();
            });
        </script>
    </body>
</html>
