<!DOCTYPE html>
<html>
<head>
    <title>Agency</title>
    <meta charset="utf-8">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/css/font-awesome.css"/>
    <link rel="stylesheet" href="/css/owl.carousel.css"/>
    <link rel="stylesheet" href="/css/animate.css"/>
    <link rel="stylesheet" href="/css/lightbox.min.css">
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="icon" href="/images/favicon.png" sizes="32x32"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
          integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    @push('style')
        <style>
            .s-icon tr td {
                padding: 2px 5px;
            }
        </style>
    @endpush
    @stack('style')
</head>
<body>
@include('_partials.header')

<div class="content">
    @yield('content')
</div>


@include('_partials.footer')
<div class="bottom_icons">

    <a href="https://wa.me/{{common_content('whatsapp_number')}}"
       class="whatspp_bottom"><img src="/images/whatspp.png"/></a>
    <a href="javascript:void(0);" class="back_top"><i class="fa fa-angle-up"></i></a>
</div>
<script src="/js/jquery.min.js"></script>


<script src="/js/bootstrap.min.js"></script>
<script src="/js/owl.carousel.js"></script>
<script src="/js/wow.js"></script>

<script src="/js/lightbox.min.js"></script>
<script src="/js/custom_script.js"></script>

@stack('script')
</body>
</html>
