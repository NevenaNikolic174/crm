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
<!--end::Base Styles -->
{{-- <link rel="shortcut icon" href="assets/demo/default/media/img/logo/favicon.ico"  /> --}}
<link rel="shortcut icon" href="{{ URL::to('legacy/favicon2.ico') }}" />

<style type="text/css">
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

.m-login.m-login--1 .m-login__wrapper {
    overflow: hidden;
    padding: 25% 2rem 2rem 2rem !important;
}

#viewPassBtn {
    border-bottom: 1px solid #ebedf2;
    background: transparent;
    border-radius: unset;
    color: #36a3f7;
}

#viewPassBtn :hover {
    color: #2b5ba3;
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
            <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
                <div class="m-stack m-stack--hor m-stack--desktop">
                    <div class="m-stack__item m-stack__item--fluid">
                        <div class="m-login__wrapper">
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
                                        <select name="licenseCompany" class="form-control chosen-select" style="height: 100%;" id="licenseCompany">
                                            <option value="NONE" disabled selected>{{trans('legacy/Content/loginContent.login.Izaberite licencu')}}</option>
                                            @foreach($licenseCompany as $index => $c)
                                                <option value="{{ $c->licenseID }}">({{$c->licenseID}}) {{$c->companyNames}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="row m-login__form-sub">

                                    </div>
                                        <div class="m-login__form-action">

                                        <input type="hidden" name="chooseLicense" value="POST">
                                        <button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom  g-recaptcha" id="submitbtn" disabled>
                                            {{trans('legacy/Content/loginContent.login.logBtn')}}
                                        </button>
                                        
                                        
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    

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
                <div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1  m-login__content" style="background-color: #2b5ba3;">
                    <div class="m-grid__item m-grid__item--middle">
                        <h3 class="m-login__welcome text-center mb-5">
                            {{-- Kancelarko --}}
                            <img src="{{asset('legacy/assets/images/kancelarko_w.png')}}" alt="" class="shadowed">
                        </h3>
                        <div class="m-login__msg">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <span style="font-size: 20px; font-weight: bold;">
                                        {{-- Olakšajte vaše poslovanje --}}
                                        {{trans('legacy/Content/loginContent.login.Olakšajte vaše poslovanje')}}
                                    </span>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <!-- delovodnik -->
                                <div class="col-xl-3 mt-3">
                                    <span style="font-size: 16px; font-weight: bold;">
                                        {{-- e-Delovodnik --}}
                                        {{trans('legacy/Content/loginContent.login.e-Delovodnik')}}
                                    </span>
                                    <ul style="color: white;" class="mt-2">
                                        <li><i class="flaticon-interface-7"> </i>
                                            {{-- Knjige dokumenata --}}
                                            {{trans('legacy/Content/loginContent.login.Knjige dokumenata')}}
                                        </li>
                                        <li><i class="flaticon-calendar-3"> </i>
                                            {{-- Kalendar --}}
                                            {{trans('legacy/Content/loginContent.login.kalendar2')}}
                                        </li>
                                        <li><i class="flaticon-chat-1"> </i>
                                            {{-- Oglasna tabla --}}
                                            {{trans('legacy/Content/loginContent.login.Oglasna tabla')}}
                                        </li> 
                                        <li><i class="flaticon-file"> </i>
                                            {{-- Dokumenti --}}
                                            {{trans('legacy/Content/loginContent.login.Dokumenti')}}
                                        </li> 
                                        <li><i class="flaticon-users"> </i>
                                            {{-- Kontakti --}}
                                            {{trans('legacy/Content/loginContent.login.Kontakti')}}
                                        </li>
                                        <li><i class="flaticon-open-box"> </i>
                                            {{-- Kontakti --}}
                                            {{trans('legacy/Content/loginContent.login.Arhivska knjiga')}}
                                        </li>  
                                    </ul>
                                </div>
                                <!-- fakture -->
                                <div class="col-xl-3 mt-3">
                                    <span style="font-size: 16px; font-weight: bold;">
                                        {{-- e-Fakture --}}
                                        {{trans('legacy/Content/loginContent.login.e-Fakture')}}
                                    </span>
                                    <ul style="color: white;" class="mt-2">
                                        <li><i class="flaticon-folder-3"> </i>
                                            {{-- Slanje faktura --}}
                                            {{trans('legacy/Content/loginContent.login.Slanje faktura')}}
                                        </li>
                                        <li><i class="flaticon-folder-2"> </i>
                                            {{-- Primanje faktura --}}
                                            {{trans('legacy/Content/loginContent.login.Primanje faktura')}}
                                        </li>
                                        <li><i class="flaticon-folder-4"> </i>
                                            {{-- Pravljenje faktura --}}
                                            {{trans('legacy/Content/loginContent.login.Pravljenje faktura')}}
                                        </li>
                                        <li><i class="flaticon-list"> </i>
                                            {{trans('legacy/Content/loginContent.login.Odobravanje faktura')}}
                                        </li>
                                        <li><i class="flaticon-book"> </i>
                                            {{-- Adresar --}}
                                            {{trans('legacy/Content/loginContent.login.Adresar')}} 
                                        </li> 
                                    </ul>
                                </div>
                                <!-- postar -->
                                <div class="col-xl-3 mt-3">
                                    <span style="font-size: 16px; font-weight: bold;">
                                        {{trans('legacy/Content/loginContent.login.postar')}}
                                    </span>
                                    <ul style="color: white;" class="mt-2">
                                        <li><i class="flaticon-folder-3"> </i>
                                            {{trans('legacy/Content/loginContent.login.sdok')}}
                                        </li>
                                        <li><i class="flaticon-folder-2"> </i>
                                            {{trans('legacy/Content/loginContent.login.pdok')}}
                                        </li>
                                        <li><i class="flaticon-folder-4"> </i>
                                            {{trans('legacy/Content/loginContent.login.ppdok')}}
                                        </li>
                                        <li><i class="flaticon-list"> </i>
                                            {{trans('legacy/Content/loginContent.login.odok')}}
                                        </li> 
                                        <li><i class="flaticon-book"> </i>
                                            {{trans('legacy/Content/loginContent.login.Adresar')}}
                                        </li> 
                                    </ul>
                                </div>
                                <!-- principal -->
                                <div class="col-xl-3 mt-3">
                                    <span style="font-size: 16px; font-weight: bold;">
                                        {{trans('legacy/Content/loginContent.login.principal')}} - {{trans('legacy/Content/loginContent.login.tok')}}:
                                    </span>
                                    <ul style="color: white;" class="mt-2">
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
                                </div>
                            </div>                       
                            <br>
                            <a href="https://www.paragraf.rs/kancelarko/softver-za-administraciju-e-kancelarija-program-za-kancelariju.html" target="_blank" class="btn m-btn--pill m-btn m-btn--gradient-from-info m-btn--gradient-to-accent">
                                {{-- Šta je Kancelarko? --}}
                                {{trans('legacy/Content/loginContent.login.Šta je Kancelarko')}} ?
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
    <input type="hidden" id="localeJS" value="{{$locale}}">
    <!-- end:: Page -->
    <!--begin::Base Scripts -->
    <script src="{{ asset('legacy/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('legacy/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
    <!--end::Base Scripts -->   
    <!--begin::Page Snippets -->
    <script src="{{ asset('legacy/assets/snippets/pages/user/login.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function(){
            $("#licenseCompany").on('change', function() {
                if($("#licenseCompany option:selected").val() != 'NONE') {
                    $("#submitbtn").attr('disabled', false);
                }
            })
        })
    </script>
    <!--end::Page Snippets -->
</body>
<!-- end::Body -->
</html>
