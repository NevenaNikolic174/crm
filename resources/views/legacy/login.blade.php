<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->

{{-- 
<html lang="en"> 
--}}
<html lang="{{ app()->getLocale() }}"> 

<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>
        {{ config('app.name') }} - {{trans('legacy/Content/loginContent.login.login')}}
    </title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
      WebFont.load({
        google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
        active: function() {
            sessionStorage.fonts = true;
        }
    });
</script>
<!--end::Web font -->
<!--begin::Base Styles -->
<!-- lokalizacija za vendors.bundle.js (default poruke za validator) -->
<script>
    window.validateDefaultMessage = {
        required: "{{trans('legacy/Content/ispravke.sveJSispravke.contactPreviewJS.obaveznoPolje')}}",
        email: "{{trans('legacy/Content/ispravke.sveJSispravke.contactPreviewJS.obaveznoEmail')}}"
    };
</script>
<link href="{{ asset('legacy/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('legacy/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('legacy/assets/js/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet" type="text/css"/>

<!--end::Base Styles -->
{{-- <link rel="shortcut icon" href="assets/demo/default/media/img/logo/favicon.ico"  /> --}}
<link rel="shortcut icon" href="{{ URL::to('legacy/favicon2.ico') }}" />

<style type="text/css">
    .m-login.m-login--1 .m-login__wrapper {
        padding: 0% 2rem 2rem 2rem !important;
    }

    p.m-login__msg li {
        list-style:none;
        background-image:none;
        background-repeat:none;
        background-position:0; 
    }
    ul
    {
        list-style-type:none;
        padding:0px;
        margin:0px;
    }
    li
    {
        background-image:url(sqpurple.gif);
        background-repeat:no-repeat;
        background-position:0px 5px; 
        padding-left:14px;
    }

    /* .m-login.m-login--1 .m-login__wrapper {
        overflow: hidden;
        padding: 25% 2rem 2rem 2rem !important;
    } */

    #viewPassBtn {
        border-bottom: 1px solid #ebedf2;
        background: transparent;
        border-radius: unset;
        color: #36a3f7;
    }

    #viewPassBtn :hover {
        color: #2b5ba3;
    }
    .error-text {
        font-weight: normal !important;
    }

    #selectLicense {
        height: 42px !important;
        cursor: pointer;
        padding: 5px 0;
    }

    #selectLicense option {
        cursor: pointer;
    }
    .search-choice {
        background: #ebedf2 !important;
        border: 1px solid #ebedf2 !important;
    }

    .search-choice .search-choice-close,
    .chosen-single .search-choice-close{
        background: none !important;
        top: 5px !important;
    }

    .chosen-single .search-choice-close:after  {
        position: absolute;
        top: -5px;
        right: 5px;
    }

    .search-choice-close:after {
        content: "\f191";
        font-family: LineAwesome;
        font-size: 14px;
        text-decoration: inherit;
        text-rendering: optimizeLegibility;
        text-transform: none;
    }

    .chosen-results .active-result.highlighted {
        background-color: #36a3f7 !important;
    }

    .chosen-container-active .chosen-choices {
        border: 1px solid #ebedf2;
    }

    .chosen-container .chosen-results li {
        padding: 8px !important;
    }

    .chosen-container .chosen-drop {
        border: 1px solid #ebedf2;
    }

    .chosen-results {
        padding: 0;
        margin-right: 0;
    }

    .chosen-search input:focus {outline-color: #36a3f7 !important;}

    .chosen-container-active.chosen-with-drop .chosen-single {
        border: 1px solid #ebedf2;
    }

    .plusic {
        color: #D8D8D8;
        float: right;
        margin-top: 2px;
        margin-left: 3px !important;
        cursor: pointer;
    }

    .green-button-lg{
        background: rgb(69,175,117);

        background: -moz-linear-gradient(0deg, rgba(69,175,117,1) 19%, rgba(77,224,144,1) 100%);

        background: -webkit-linear-gradient(0deg, rgba(69,175,117,1) 19%, rgba(77,224,144,1) 100%);

        background: linear-gradient(0deg, rgba(69,175,117,1) 19%, rgba(77,224,144,1) 100%);

        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#45af75",endColorstr="#4de090",GradientType=1);

        color:white;
    }

    .otpremnice-container {
        width: 100%;
        height: 100%;
        background: rgba(80, 51, 143);
        padding: 10px;
    }

    .kadrovik-container {
        width: 100%;
        height: 100%;
        background: rgb(30, 120, 65);
        padding: 10px;
    }
    .delovodnik-container {
        width: 100%;
        height: 100%;
        background: #0075BB;
        padding: 10px;
    }
    .fakture-container {
        width: 100%;
        height: 100%;
        background: #D3A925;
        padding: 10px;
    }
    .postar-container {
        width: 100%;
        height: 100%;
        background: #949599;
        padding: 10px;
    }
    .principal-container {
        width: 100%;
        height: 100%;
        background: #D95332;
        padding: 10px;
    }

    .rightContainer {
        padding-top: 20px !important;
    }

</style>

@php
    if(isset($_GET['forget'])){
        $klasa = 'm-login--forget-password';
    } else {
        $klasa = 'm-login--signin';
    }

    $locale = json_encode(trans('legacy/Content/loginContent.login'), JSON_UNESCAPED_UNICODE);
    //dd($locale)
    //dd(trans('legacy/Content/loginContent.login.username'));
    
@endphp       

</head>
<!-- end::Head -->
<!-- end::Body -->
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 <?php echo $klasa; ?>" id="m_login">
            <div class="m-grid__item m-grid__item--order-tablet-and-mobile-1 m-login__aside">
                <div class="m-stack m-stack--hor m-stack--desktop">
                    <div class="m-stack__item m-stack__item--fluid">
                        <div class="m-login__wrapper" style="overflow: inherit;">
                            <div class="m-login__logo">
                                <a href="#">
                                    @if(config('legacy.app_server_production') == 'Principal')
                                    <img src="{{ URL::to('legacy/img/logo/adro-logo-index-principal.png') }}" width="100%">
                                    @else 
                                    <img src="{{ URL::to('legacy/img/logo/adro-logo-index.png') }}" width="100%">
                                    @endif
                                </a>
                            </div>
                            <div class="m-login__signin">
                                <div class="m-login__head">
                                    {{-- <h3 class="m-login__title">
                                        Advokatski Rokovnik
                                    </h3> --}}
                                </div>
                                @if($errors->has('2faError'))
                                    <div class="alert alert-danger alert-dismissible fade show m-alert m-alert--square m-alert--air" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="zatvori"></button>
                                        {!! $errors->first('2faError') !!}
                                    </div>
                                @endif
                                @if(session()->has('fail'))
                                    <div class="alert alert-danger alert-dismissible fade show m-alert m-alert--square m-alert--air" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="zatvori"></button>
                                            {!! session()->get('fail') !!}
                                    </div>
                                @endif
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong>
                                            {{-- Morate da čekirate da niste robot! --}}
                                            {{trans('legacy/Content/loginContent.login.robot')}}
                                        </strong>
                                    </span>
                                @endif
                                @if(session()->has('success'))
                                    <div class="alert alert-info alert-dismissible _autoClose fade show m-alert m-alert--square m-alert--air" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="zatvori"></button>
                                            {!! session()->get('success') !!}
                                    </div>
                                @endif
                                <form method="POST" id="loginform" class="m-login__form m-form" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group m-form__group">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} px-2" placeholder="{{trans('legacy/Content/loginContent.login.username')}} ({{trans('legacy/Content/loginContent.login.email')}})" name="username" value="{{ old('username') }}" required autofocus>

                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                        
                                    </div>

                                    <div class="form-group m-form__group">
                                        <div class="input-group">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} px-2" placeholder="{{trans('legacy/Content/loginContent.login.password')}}" name="password" required>
                                            <div class="input-group-append">
                                                <a href="javascript:void(0)"class="btn" id="viewPassBtn"><i class="flaticon-eye"></i></a>
                                            </div>
                                        </div> 

                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                        
                                    </div>

                                    <div class="row m-login__form-sub">
                                        <div class="col m--align-left">
                                            <label class="m-checkbox m-checkbox--focus">
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{trans('legacy/Content/loginContent.login.remember')}}
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col m--align-right">
                                            <a href="{{ rtrim(config('legacy.kancelarko_url'), '/') }}/login?forget=1" class="m-link">
                                                {{trans('legacy/Content/loginContent.login.zabLozinka')}}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="m-login__form-action">
                                       
                                        <button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom  g-recaptcha" id="submitbtn" >
                                            {{trans('legacy/Content/loginContent.login.logBtn')}}
                                        </button>
                                        <button type="button" class="btn btn-focus m-btn m-btn--pill   g-recaptcha" id="viberBtn"  style="padding-left:20px; padding-right:20px;">
                                            <img src="{{ asset('legacy/img/viber_icon.png') }}" style="width:25px; height:25px;">
                                        </button>

                                        <div class="m-stack__item m-stack__item--center mt-5">
                                            <div class="m-login__account">
                                                <a href="{{ rtrim(config('legacy.kancelarko_url'), '/') }}/reg" class="m-link m-link--focus m-login__account-link" id="regLink">
                                                    {{trans('legacy/Content/loginContent.login.reg')}}
                                                </a>
                                                <br><br>
                                                <button href="" class="btn btn-focus m-btn m-btn--pill   g-recaptcha" id="podrskaLink" style="background-color:#51cd63; border:0px;">
                                                    <span class="fa fa-phone" aria-hidden="true"></span>&nbsp;&nbsp;{{trans('legacy/Content/loginContent.login.podrska')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <hr/>
                        <div class="link-container">                            
                            <h4><a href="https://www.paragraf.rs/kancelarko/obuka-programa.html" target="_blank" class="m-link">Obuka za Kancelarka ></a></h4>
                        </div>
                        <hr/>
                        <div class="link-container">                            
                            <h4><a href="https://www.paragraf.rs/kancelarko/gold-paket-kancelarko.html" target="_blank" class="m-link">Kancelarko Gold i Silver paketi ></a></h4>
                        </div>
                        <hr/>
                    </div>
                    <input type="hidden" id="csrf" value="{{csrf_token()}}">
                </div>
            </div>
            @if(config('legacy.app_server_production') == 'Principal')
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1  m-login__content" style="background-color: #cb2e31;">
                <div class="m-grid__item m-grid__item--middle">
                    <h3 class="m-login__welcome">
                        
                            {{trans('legacy/Content/loginContent.login.principal')}} | {{trans('legacy/Content/loginContent.login.rokovnik')}} 
                        
                    </h3>
                    <p class="m-login__msg">
                        <strong>
                            {{-- Uvek budite u toku sa Vašim --}}
                            {{trans('legacy/Content/loginContent.login.tok')}} 
                        </strong>
                        <ul style="color: white;">
                            <li><i class="flaticon-calendar-3"> </i>
                                {{-- Kalendarom --}}
                                {{trans('legacy/Content/loginContent.login.kalendar')}} 
                            </li>
                            <li><i class="flaticon-file"> </i>
                                {{-- Predmetima --}}
                                {{trans('legacy/Content/loginContent.login.predmet')}} 
                            </li>
                            <li><i class="flaticon-diagram"> </i>
                                {{-- Finansijama --}}
                                {{trans('legacy/Content/loginContent.login.finansije')}} 
                            </li>
                            <li><i class="flaticon-list-3"> </i>
                                {{-- Obavezama --}}
                                {{trans('legacy/Content/loginContent.login.obaveze')}} 
                            </li>
                            <li><i class="flaticon-users"> </i>
                                {{-- Klijentima --}}
                                {{trans('legacy/Content/loginContent.login.klijent')}} 
                            </li>
                        </ul>
                        <br>
                        <a href="https://www.paragraf.rs/principal/advokatski-rokovnik.html" target="_blank" class="btn m-btn--pill m-btn m-btn--gradient-from-info m-btn--gradient-to-accent">
                            {{-- Šta je Principal? --}}
                            {{trans('legacy/Content/loginContent.login.sPrincipal')}} ?
                        </a>

                    </p>
                    <p>
                        <div class="alert alert-primary" role="alert">
                            <strong>
                                {{-- Info! --}}
                                {{trans('legacy/Content/loginContent.login.Info')}}!
                            </strong>
                            {{-- Preporučujemo da prilikom korišćenja aplikacije Principal koristite Google Chrome  --}}
                            {{trans('legacy/Content/loginContent.login.Preporučujemo da prilikom korišćenja aplikacije Principal koristite Google Chrome')}} 
                            <img style="width: 25px;" src="{{ URL::to('legacy/img/chrome.png') }}"> . 
                            {{-- Ne preporučuje se korišćenje Internet Explorer-a. --}}
                            {{trans('legacy/Content/loginContent.login.Ne preporučuje se korišćenje Internet Explorer-a')}}.
                        </div>
                    </p>
                    {{-- <p style="text-align: right; color: white;"><i>Adro, zna gde su Vaša dokumenta</i></p> --}}
                    <p style="text-align: left; color: white; margin-top: 25px;"><i>
                        {{-- powered by --}}
                        {{trans('legacy/Content/loginContent.login.powered by')}} 
                        <strong><a href="https://www.paragraf.rs" target="_blank" style="text-decoration: none; color: white !important;"> Paragraf Lex</strong></i> <img style="margin-left: 20px; width: 60px;" src="{{ URL::to('legacy/img/logo/principal-logo-paragraf.png') }}"></a>
                    </p>
                
                </div>
                <span style="bottom: 10px;display: block;float: right;position: relative;right: 10px;text-align: right;margin-top: 70px;">
                    <a href="{{ rtrim(config('legacy.kancelarko_url'), '/') }}/opsta-pravila" target="_blank" style="text-decoration: none;color: white;">
                        {{-- Opšta pravila i uslovi korišćenja --}}
                        {{trans('legacy/Content/loginContent.login.Opšta pravila i uslovi korišćenja')}}
                    </a>
                    <br>
                    <a href="{{ rtrim(config('legacy.kancelarko_url'), '/') }}/opsta-pravila" target="_blank" style="text-decoration: none;color: #fdb4b6;font-size: 11px;display: inline-block;">
                        {{-- Terms, Privacy Policy and Data Policy --}}
                        {{trans('legacy/Content/loginContent.login.Terms, Privacy Policy and Data Policy')}}
                    </a>
                </span>
                
            </div>
            @endif
            @if(config('legacy.app_server_production') == 'Delovodnik')
                <style>
                    .m-login.m-login--1 .m-login__aside {
                        max-width: 500px;
                        padding: 2rem 1rem;
                    }

                    .m-login.m-login--1 .m-login__content {
                        padding: 5rem 2rem 10rem 2rem;
                    }

                    .m-btn--custom {
                        background-color: #36a3f7;
                        border: 0;
                        -webkit-box-shadow: none !important;
                        -moz-box-shadow: none !important;
                        box-shadow: none !important;
                    }

                    
                    .m-btn--custom:hover {
                        background-color: #2b5ba3;
                    }

                    .m-btn--custom.btn-focus:not(:disabled):not(.disabled):active {
                        background-color: #2b5ba3;
                    }

                    .m-btn--custom.btn-outline-focus {
                        color: #36a3f7;
                        border: 1px solid #36a3f7;
                        background-color: transparent;
                    }

                    .m-btn--custom.btn-outline-focus:hover {
                        background-color: #36a3f7;
                    }

                    .m-btn--custom.btn-outline-focus:not(:disabled):not(.disabled):active {
                        background-color: #36a3f7;
                    }

                    #regLink {
                        color: #53b0f8;
                    }

                    .m-login__content {
                        background: url('{{asset("legacy/assets/images/kanc_login.jpg")}}');
                        background-position: center top;
                    }
                    @media only screen and (max-width: 1024px) {

                        .m-login.m-login--1 .m-login__content {
                            padding: 5rem 10rem 10rem 10rem;
                        }
                    }

                    .shadowed {
                        -webkit-filter: drop-shadow(5px 5px 5px rgba(0,0,0,0.3));
                        -ms-filter: "progid:DXImageTransform.Microsoft.Dropshadow(OffX=5, OffY=5, Color='#444')";
                        filter:         drop-shadow(5px 5px 5px rgba(0,0,0,0.3)); 
                        
                    }

                </style>
                <div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1  m-login__content rightContainer" style="background-color: #2b5ba3;">
                    <div class="m-grid__item m-grid__item--middle">
                        <h3 class="m-login__welcome text-center mb-4">
                            {{-- Kancelarko --}}
                            <img src="{{asset('legacy/assets/images/kancelarko_w.png')}}" alt="" class="shadowed">
                        </h3>
                        
                        <div class="m-login__msg">
                            {{-- <!-- <div class="row">
                                <div class="col-md-12 text-center pb-4">
                                    <div class="card" style="border-color: red !important;">
                                        <div class="card-body">
                                            <h4 class="card-title" style="color:red;">Akcija 40% popusta </h4>
                                            <h5 class="card-text" style="margin-bottom: 20px; color: black">Obuka za program Kancelarko</h5>
                                            <a href="https://www.paragraf.rs/kancelarko/obuka-programa.html" target="_blank" class="btn btn-warning">Naručite paket ›</a>
                                        </div>
                                    </div>
                                </div>
                            </div> --> --}}
                            
                            <div class="row">
                                <div class="col-12 text-center">
                                    <span style="font-size: 20px; font-weight: bold;">
                                        {{-- Olakšajte vaše poslovanje --}}
                                        {{trans('legacy/Content/loginContent.login.Olakšajte vaše poslovanje')}} 
                                    </span>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <!-- e-otpremnice -->
                                <div class="col-xl-4 my-3 mw-100">
                                    <div class="otpremnice-container">
                                        <span style="font-size: 16px; font-weight: bold;">
                                            e-Otpremnice
                                        </span>
                                        <ul style="color: white;" class="mt-2">
                                            <li><i class="flaticon-notes"> </i>
                                                slanje i prijem e-Otpremnica
                                            </li>
                                            <li><i class="flaticon-interface-5"> </i>
                                                e-Prijemnice
                                            </li> 
                                            <li><i class="flaticon-search"> </i>
                                                jasan pregled statusa dokumenata
                                            </li>
                                            <li><i class="flaticon-interface-9"> </i>
                                                usklađenost sa propisima
                                            </li>  
                                        </ul>
                                    </div>
                                </div>
                                <!-- kadrovik -->
                                <div class="col-xl-4 my-3 mw-100">
                                    <div class="kadrovik-container">
                                        <span style="font-size: 16px; font-weight: bold;">
                                            Kadrovik
                                        </span>
                                        <ul style="color: white;" class="mt-2">
                                            <li><i class="flaticon-users"> </i>
                                                Kadrovska evidencija
                                            </li>
                                            <li><i class="flaticon-search"> </i>
                                                Jasan HR pregled
                                            </li> 
                                            <li><i class="flaticon-calendar-3"> </i>
                                                Zahtevi bez papira
                                            </li>
                                            <li><i class="flaticon-interface-6"> </i>
                                                Prati zakon o radu
                                            </li>  
                                        </ul>
                                    </div>
                                </div>
                                <!-- delovodnik -->
                                <div class="col-xl-4 my-3 mw-100">
                                    <div class="delovodnik-container">
                                        <span style="font-size: 16px; font-weight: bold;">
                                            {{-- e-Delovodnik --}}
                                            {{trans('legacy/Content/loginContent.login.e-Delovodnik')}}
                                        </span>
                                        <ul style="color: white;" class="mt-2">
                                            <li><i class="flaticon-interface-7"> </i>
                                                {{-- Knjige dokumenata --}}
                                                {{trans('legacy/Content/loginContent.login.Knjige dokumenata')}}
                                            </li>
                                            <li><i class="flaticon-chat-1"> </i>
                                                {{-- Oglasna tabla --}}
                                                {{trans('legacy/Content/loginContent.login.Oglasna tabla')}}
                                            </li> 
                                            <li><i class="flaticon-folder-1"> </i>
                                                Elektronsko Arhiviranje
                                            </li>
                                            <li><i class="flaticon-open-box"> </i>
                                                {{-- Kontakti --}}
                                                {{trans('legacy/Content/loginContent.login.Arhivska knjiga')}}
                                            </li>  
                                        </ul>
                                    </div>
                                </div>
                                <!-- fakture -->
                                <div class="col-xl-4 my-3 mw-100">
                                    <div class="fakture-container">
                                        <span style="font-size: 16px; font-weight: bold;">
                                            {{-- e-Fakture --}}
                                            {{trans('legacy/Content/loginContent.login.e-Fakture')}}
                                        </span>
                                        <ul style="color: white;" class="mt-2">
                                            <li><i class="flaticon-interface-9"> </i>
                                                Integracija sa SEF
                                            </li>
                                            <li><i class="flaticon-list-3"> </i>
                                                Masovno slanje faktura
                                            </li>
                                            <li><i class="flaticon-folder-3"> </i>
                                                Evidencija PDV u SEF
                                            </li>
                                            <li><i class="flaticon-book"> </i>
                                                {{-- Adresar --}}
                                                {{trans('legacy/Content/loginContent.login.Adresar')}} 
                                            </li> 
                                        </ul>
                                    </div>
                                </div>
                                <!-- postar -->
                                <div class="col-xl-4 my-3 mw-100">
                                    <div class="postar-container">
                                        <span style="font-size: 16px; font-weight: bold;">
                                            {{trans('legacy/Content/loginContent.login.postar')}}
                                        </span>
                                        <ul style="color: white;" class="mt-2">
                                            <li><i class="flaticon-folder-1"> </i>
                                                Izvodi otvorenih stavki (IOS)
                                            </li>
                                            <li><i class="flaticon-interface-5"> </i>
                                                Slanje / primanje / odobravanje
                                            </li>
                                            <li><i class="flaticon-folder-2"> </i>
                                                Potvrda prijema dokumenta
                                            </li>
                                            <li><i class="flaticon-book"> </i>
                                                {{trans('legacy/Content/loginContent.login.Adresar')}}
                                            </li> 
                                        </ul>
                                    </div>
                                </div>
                                <!-- principal -->
                                <div class="col-xl-4 my-3 mw-100">
                                    <div class="principal-container">
                                        <span style="font-size: 16px; font-weight: bold;">
                                            {{trans('legacy/Content/loginContent.login.principal')}}
                                        </span>
                                        <ul style="color: white;" class="mt-2">
                                            <li><i class="flaticon-more-v6"> </i>
                                                Advokatski/poslovni
                                            </li>
                                            <li><i class="flaticon-book"> </i>
                                                e-Rokovnik
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>                       
                            <br>
                            {{-- <a href="https://www.paragraf.rs/kancelarko/softver-za-administraciju-e-kancelarija-program-za-kancelariju.html" target="_blank" class="btn m-btn--pill m-btn m-btn--gradient-from-info m-btn--gradient-to-accent">
                                
                                {{trans('Content/loginContent.login.Šta je Kancelarko')}} ?
                            </a>
                            <br><br> --}}                            
                            <a href="https://www.paragraf.rs/kancelarko/softver-za-administraciju-e-kancelarija-program-za-kancelariju.html#forma-za-registraciju-principal

                            " target="_blank" class=" green-button-lg  btn m-btn--pill m-btn btn-lg">

                               

                              Zakažite besplatnu prezentaciju →

                            </a>

                        </div>
                        <p class="mt-5">
                            <div class="alert alert-info" role="alert" style="background-color: rgba(80,203,98,0.28); border-color: #51cd63;">
                                <strong>
                                    {{-- Info! --}}
                                    {{trans('legacy/Content/loginContent.login.Info')}}!
                                </strong>
                                {{-- Preporučujemo da prilikom korišćenja aplikacije Kancelarko koristite Google Chrome  --}}
                                {{trans('legacy/Content/loginContent.login.Preporučujemo da prilikom korišćenja aplikacije Kancelarko koristite Google Chrome')}} 
                                <img style="width: 25px;" src="{{ URL::to('legacy/img/chrome.png') }}"> . 
                                {{-- Ne preporučuje se korišćenje Internet Explorer-a. --}}
                                {{trans('legacy/Content/loginContent.login.Ne preporučuje se korišćenje Internet Explorer-a')}} .
                            </div>
                        </p>
                        <div class="row">
                                <div class="col-lg-6">
                                    <p style="text-align: left; color: white; margin-top: 10px;"><i>
                                        {{-- powered by  --}}
                                        {{trans('legacy/Content/loginContent.login.powered by')}}
                                        <strong><a href="https://www.paragraf.rs" target="_blank" style="text-decoration: none; color: white !important;"> Paragraf Lex</strong></i> <img style="margin-left: 20px; width: 60px;" src="{{ URL::to('legacy/img/logo/principal-logo-paragraf.png') }}"></a></p>
                                </div>
                                <div class="col-lg-6 text-lg-right pt-3">
                                    <a href="{{ rtrim(config('legacy.kancelarko_url'), '/') }}/opsta-pravila" target="_blank" style="text-decoration: none;color: white;">
                                        {{-- Opšta pravila i uslovi korišćenja --}}
                                        {{trans('legacy/Content/loginContent.login.Opšta pravila i uslovi korišćenja')}}
                                    </a>
                                    <br>
                                    <a href="{{ rtrim(config('legacy.kancelarko_url'), '/') }}/opsta-pravila" target="_blank" style="text-decoration: none;color: #8ff0fd;font-size: 11px;display: inline-block;">
                                        {{-- Terms, Privacy Policy and Data Policy --}}
                                        {{trans('legacy/Content/loginContent.login.Terms, Privacy Policy and Data Policy')}}
                                    </a>
                                </div>
                            </div>
                        {{-- <p style="text-align: right; color: white;"><i>Adro, zna gde su Vaša dokumenta</i></p> --}}
                        
                    
                    </div>
                    
                </div>
            @endif
        </div>
    </div>

    <div id="infoModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">Kancelarko korisnička podrška</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Phone Numbers with Icons -->
                    <div class="row text-center" style="font-size:18px;">
                        <div class="col-xs-6" style="margin-left:40px;">
                            <span class="fa fa-phone" aria-hidden="true"></span> <a href="tel:+381606304489">060 6304 489</a>
                        </div>
                        <div class="col-xs-6" style="margin-left:120px;">
                            <span class="fa fa-phone" aria-hidden="true"></span> <a href="tel:+381603370125">060 3370 125</a>
                        </div>
                    </div>
                    <div class="row text-center" style="margin-top: 10px; font-size:18px;">
                        <div class="col-xs-6" style="margin-left:40px;">
                            <span class="fa fa-phone" aria-hidden="true"></span> <a href="tel:+381628007442">062 8007 442</a>
                        </div>
                        <div class="col-xs-6" style="margin-left:120px;">
                            <span class="fa fa-phone" aria-hidden="true"></span> <a href="tel:+381603370128">060 3370 128</a>
                        </div>
                    </div>
                    
                    <!-- Email Section -->
                    <div class="text-center" style="margin-top: 20px; font-size:18px;">
                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <a href="mailto:info@example.com">kancelarko@paragraf.rs</a>
                    </div>

                    <!-- Note Section -->
                    <div class="text-center" style="margin-top: 10px; font-size:18px;">
                        <small>Napomena: ukoliko nismo u mogućnosti da vam se javimo, ostavite poruku ili nam pošaljite email na gore navedenu email adresu sa Vašim brojem telefona i neko će Vas ubrzo pozvati.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viberZajednicaModal" tabindex="-1" role="dialog" aria-labelledby="viberZajednicaModal" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Pridružite nam se</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Kancelarko Viber zajednica</h4>
                    <img src="{{ asset('legacy/img/viber_qr_code.png') }}" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="localeJS" value="{{$locale}}">
    <!-- end:: Page -->
    <!--begin::Base Scripts -->
    <script src="{{ asset('legacy/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('legacy/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
    <!--end::Base Scripts -->   
    <!--begin::Page Snippets -->
    <script src="{{ asset('legacy/assets/snippets/pages/user/login.js') }}" type="text/javascript"></script>
    <script src="{{asset('legacy/assets/js/plugins/chosen/bootstrap-chosen.js') }}" type="text/javascript"></script>
    <!--end::Page Snippets -->
</body>
<!-- end::Body -->
</html>
