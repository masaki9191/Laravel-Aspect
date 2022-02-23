<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,user-scalable=yes" />
    <meta name="format-detection" content="telephone=no">
    <meta name="keywords" content="アセットマネジメント業務,不動産管理業務,自己投資物件業務,エイペスト" />
    <meta name="description"
        content="私たちエイペストは、「不動産オーナーによる、不動産オーナーのためのアセットマネジメント」を通じて、「安全な不動産投資」「高度な不動産管理」「信頼できる不動産業界」の実現に貢献します。" />
    <meta property="og:title" content="APEST 取扱管理物件紹介｜投資家とともに歩む　株式会社エイペスト">
    <meta property="og:description"
        content="私たちエイペストは、「不動産オーナーによる、不動産オーナーのためのアセットマネジメント」を通じて、「安全な不動産投資」「高度な不動産管理」「信頼できる不動産業界」の実現に貢献します。">
    <title>APEST 取扱管理物件紹介｜投資家とともに歩む　株式会社エイペスト</title>
    <link rel="canonical" href="https://apest.co.jp/result/" />
    <link rel="stylesheet" type="text/css" href="{{asset('common/images/favicon.ico')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('common/styles/reset.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('common/styles/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/styles/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/styles/media.css')}}">
</head>

<body>
    
    @include('frontend.layout.topbar')

    <div id="main">
        @yield('content')       

        <footer>
            <p id="copyright"><small>copyright&copy;&nbsp;APEST Co.,LTD</small></p>
        </footer>

    </div>

    <script src="{{asset('common/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('common/js/script.js')}}"></script>
    <script src="{{asset('common/js/delighters.js')}}"></script>
    <script src="{{asset('common/js/jquery.stickystack.min.js')}}"></script>
</body>

</html>