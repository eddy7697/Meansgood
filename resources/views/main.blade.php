<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        @yield('custom-meta')

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="{{SiteMetaView::keyword()}}">
        <meta name="description" content="{{SiteMetaView::description()}}">
        <link rel="alternate" href="https://www.meansgood.com.tw/" hreflang="zh-TW" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">



        {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
        <title>{{ SiteMetaView::title() }}</title>

        <link rel="shortcut icon" href="{{ SiteMetaView::shortcut() }}">

        <!-- Fonts -->
        <link href="{{ asset('css/frontend.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/js/plugins/AOS/aos.css">

        <!-- Styles -->
        <style>
        .paytest {
            display: block;
            font-size: 50pt;
        }
        </style>

        {{-- Custom stylesheet --}}
        @yield('custom-style')

        <!-- Facebook Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window,document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
         fbq('init', '575169966178996');
        fbq('track', 'PageView');
        </script>
        <noscript>
         <img height="1" width="1"
        src="https://www.facebook.com/tr?id=575169966178996&ev=PageView
        &noscript=1"/>
        </noscript>
        <!-- End Facebook Pixel Code -->

    </head>
    <body>
        <div class="loading-bar">
            <img src="/img/icon/default-loading.svg">
        </div>

        @unless (Auth::guest())
            @if (Auth::user()->role == 'ADMIN')
                <div class="container-fluid admin-bar">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="/cyberholic-system/admin">後台入口</a>
                        </div>
                    </div>
                </div>
            @endif
        @endunless
        <a href="#" class="scrollToTop"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
        {{-- 頁首橫幅區塊 --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 top-header">
                    {{SiteMetaView::pageTopContent()}} <a href="{{SiteMetaView::pageTopLink()}}">{{SiteMetaView::pageTopButton()}}</a>
                </div>
            </div>
        </div>



        <div class="container">
            <div class="row mg-header">
                <div class="col-md-6 mg-logo-section">
                    <a href="{{ url('/') }}">
                        <img class="mg-logo" src="/img/MeansGood 01-PNG.png" alt="">
                    </a>
                    <div class="nav-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <div class="col-md-6 mg-account-section">
                    @if (Auth::guest())
                        <a class="login-btn pull-right" href="{{ url('/login') }}">登入</a>
                        {{-- <button class="login-btn pull-right">登入</button> --}}
                    @else
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="login-btn pull-right">登出</a>
                        <span class="pull-right" style="margin-top: 26px;margin-right: 10px; color: #999; font-weight: bold">您好，{{Auth::user()->name}}，累積購物金：{{UserView::point()}}元</span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @endif
                </div>
                <div class="col-md-10 mg-nav-section">
                    <div class="nav-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <a href="{{ url('/') }}">
                        <img class="mg-mobile-logo" src="/img/MeansGood 01-PNG.png" alt="">
                    </a>
                    <ul class="main-nav">
                        <li>
                            <a href="#">關於明谷</a>&nbsp;&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i>
                            <ul>
                                <li><a href="{{ route('about') }}">品牌故事</a></li>
                                <li><a href="{{ route('professional') }}">品牌專業</a></li>
                                <li><a href="{{ route('certificate') }}">品牌認證</a></li>
                                <li><a href="{{ route('cordyceps') }}">蟲草介紹</a></li>
                                <li><a href="{{ route('isaria') }}">蟬花介紹</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('/product-all') }}">系列商品</a>&nbsp;&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i>
                            <ul>
                                @foreach (CategoryView::product() as $item)
                                    @if (count(ProductView::getByCategory($item->guid)) !== 0)
                                        <li><a id="link-{{$item->id}}" href="/product-all#section-{{$item->id}}">{{$item->title}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('user') }}">會員專區</a>&nbsp;&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i>
                            @unless (Auth::guest())
                                <ul>
                                    <li><a href="{{ url('user') }}">我的訂單</a></li>
                                    <li><a href="{{ url('user/address') }}">聯絡資訊</a></li>
                                    <li><a href="{{ url('user/information') }}">會員資訊</a></li>
                                    <li><a href="{{route('notice')}}">購物須知</a></li>
                                    <li><a href="{{route('privacy')}}">隱私權政策</a></li>
                                </ul>
                            @else
                                <ul>
                                    <li><a href="{{ url('/register') }}">會員註冊</a></li>
                                    <li><a href="{{url('check-order')}}">訂單查詢</a></li>
                                    <li><a href="{{route('notice')}}">購物須知</a></li>
                                    <li><a href="{{route('privacy')}}">隱私權政策</a></li>
                                </ul>
                            @endunless
                        </li>
                        <li>
                            <a href="{{ url('/cart') }}">購物車</a>
                        </li>
                        @if (false)
                            <li>
                                <a href="#">試用包索取</a>
                            </li>
                        @endif
                        {{-- {{count(PostView::all())}} --}}
                        @if (count(PostView::all()))
                            <li>
                                <a href="{{route('blog')}}">部落格</a>
                            </li>
                        @endif
                        {{-- <li>
                            <a href="{{route('store')}}">銷售據點</a>
                        </li> --}}
                    </ul>
                    <div class="mobile-account-section">
                        @if (Auth::guest())
                            <a class="login-btn" href="{{ url('/login') }}">登入</a>
                        @else
                            <span class="" style="margin-top: 26px;margin-right: 10px; color: #999; font-weight: bold">您好，{{Auth::user()->name}}</span><br>
                            <span class="" style="margin-top: 26px;margin-right: 10px; color: #999; font-weight: bold">累積購物金：{{UserView::point()}}元</span>
                            <br>
                            <br>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();" class="login-btn">登出</a>
                            <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        @endif
                    </div>
                </div>

                <div class="col-md-2 mg-function-section" id="cart-panel">
                    {{-- <a class="cart pull-right" href="{{ url('/cart') }}" style="color: rgb(99, 107, 111)">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </a> --}}
                    <div class="mobile-account-section">
                        @if (Auth::guest())
                            <a class="login-btn" href="{{ url('/login') }}">登入</a>
                        @else
                            <span class="" style="margin-top: 26px;margin-right: 10px; color: #999; font-weight: bold">您好，{{Auth::user()->name}}</span>
                            <span class="" style="margin-top: 26px;margin-right: 10px; color: #999; font-weight: bold">累積購物金：{{UserView::point()}}元</span>

                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();" class="login-btn">登出</a>
                            <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        @endif
                    </div>
                    <cart-panel></cart-panel>
                    <button class="search pull-right" id="toogle-search-form">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>

                <div id="search-section">
                    <form class="" action="/search-option" method="post">
                        {{csrf_field()}}
                        <label for="search-input"><i class="fa fa-search" aria-hidden="true"></i></label>
                        <input type="text" id="search-input" name="key-word" placeholder="請輸入關鍵字">
                    </form>
                </div>
            </div>
        </div>

        {{--麵包屑--}}
        @if ($isThumbShow)
            <div class="container-fluid mg-site-thumbnail">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12" style="padding: 0 20px;">
                                <span>{!! $thumb !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{--頁面內容--}}
        @yield('content')

        {{--頁尾--}}
        <div class="container-fluid footer">
            <div class="row">
                <div class="col-md-12 footer-1">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <img class="footer-logo" src="/img/MeansGood 01-PNG.png" alt="">
                            </div>
                            <div class="col-md-2 footer-map">
                                <ul> <h5>購買</h5>
                                    @foreach (CategoryView::product() as $item)
                                        @if (count(ProductView::getByCategory($item->guid)) !== 0)
                                            <li><a href="/product-all#section-{{$item->guid}}">{{$item->title}}</a></li>
                                        @endif
                                    @endforeach
                                    {{-- <li><a href="{{url('product-all#section-CNRoQptBhsjeRbsV4FCnqVnohV4q2ox4UnWPkGJlfe')}}">優惠組合</a></li>
                                    <li><a href="{{url('product-all#section-lZu2943Eu5lalo6kImRNnpBL2NnVfOmMVBAfliHEKO')}}">草本茶飲</a></li>
                                    <li><a href="{{url('product-all#section-497zcpoR1BDn15quzippqyDLCfN5sP7P4i7VKdJfcq')}}">肌膚呵護</a></li> --}}
                                </ul>
                            </div>
                            <div class="col-md-2 footer-map">
                                <ul> <h5>介紹</h5>
                                    <li>
                                        <a href="{{url('about')}}">品牌故事</a></li>
                                    <li>
                                        <a href="{{url('about/cordyceps')}}">蟲草介紹</a></li>
                                    <li>
                                        <a href="{{url('about/isaria')}}">蟬花介紹</a></li>
                                </ul>
                            </div>
                            <div class="col-md-2 footer-map">
                                <ul> <h5>服務</h5>
                                    <li><a href="{{url('check-order')}}">訂單查詢</a></li>
                                    <li><a href="{{route('notice')}}">購物須知</a></li>
                                    <li><a href="{{route('privacy')}}">隱私權政策</a></li>
                                </ul>
                            </div>
                            <div class="col-md-2 footer-map">
                                <ul> <h5>尋找</h5>
                                    <li><a href="{{route('blog')}}">部落格</a></li>
                                    {{-- <li><a href="{{route('store')}}">銷售據點</a></li> --}}
                                </ul>
                            </div>
                            <div class="col-md-2 social-section">
                                <a href="https://www.facebook.com/MeansGood/" target="_blank"><img width="35" src="/img/icon/fb.svg" alt=""></a>
                                {{-- <a href="#"><img width="35" src="/img/icon/line.svg" alt=""></a> --}}
                                <a href="mailto:hi@meansgood.com.tw"><img width="35" src="/img/icon/tel.svg" alt=""></a>
                                <ul>
                                    <li>食藥用真菌的專家</li>
                                    <li>只種自己敢吃的蟲草</li>
                                    <li>將蟲草的好分享給全世界</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-12 footer-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                Copyright 2017 © 明谷生機
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;30844 新竹縣寶山鄉園區二路356巷51-7號
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;客服資訊：(03)567-9463 週一至週五 09:00 ～ 16:30
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/frontend.js') }}"></script>

        <script src="{{ asset('js/CH-lib.js') }}"></script>

        <script src="{{ asset('js/cart-panel.js') }}"></script>

        <script src="{{ asset('js/plugins/AOS/aos.js') }}" charset="utf-8"></script>

        <script type="text/javascript">
            AOS.init();
        </script>

        {{-- Custom scripts --}}
        @yield('custom-script')

        @if(config('app.env') == 'local')
            <script src="http://localhost:35729/livereload.js"></script>
        @endif

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-110216165-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-110216165-1');
        </script>


    </body>
</html>
