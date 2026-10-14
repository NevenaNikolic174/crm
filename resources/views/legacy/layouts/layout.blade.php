
<!DOCTYPE html>
<html lang="en" >
<!-- begin::Head -->
<head>

    <meta charset="utf-8" />
    <title>
        @yield("title")
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Web font -->
    @if (config('legacy.app_server_production') == 'Principal')
        <link rel="shortcut icon" href="{{ asset('legacy/favicon.ico') }}"/>
    @else
        <link rel="shortcut icon" href="{{ asset('legacy/kancelarko-favicon.ico') }}"/>
    @endif

    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="{{ asset('legacy/assets/css/bootstrap.min.css') }}"></link>
    <link href="{{ asset('legacy/assets/css/global.css') }}"></link>
    <link href="{{ asset('legacy/assets/demo/default/base/style.bundle.css') }}"></link>
    <link href="{{ asset('legacy/assets/vendors/base/vendors.bundle.css') }}"></link>
    {{-- <link href="{{ asset('legacy/assets/vendors/base/style.bundle.css') }}"></link> --}}

    <script src="{{asset('legacy/assets/vendors/custom/jquery-ui/jquery-ui.bundle.js')}}" type="text/javascript"></script>
    <link href="{{asset('legacy/assets/vendors/custom/jquery-ui/jquery-ui.bundle.css')}}" rel="stylesheet" type="text/css">
    {{-- <script src="{{ asset('legacy/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script> --}}

    <script src="{{ asset('legacy/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
    <link href="{{ asset('legacy/assets/js/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet" type="text/css"/>
    <script src="{{asset('legacy/chosen/chosen-jquery.js')}}" type="text/javascript"></script>
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
    <!--begin::Page Vendors -->

    <!--end::Page Vendors -->

  @include('legacy.fixed.styles')
  <style>
        .no-privilege-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 500px;
            padding: 40px 20px;
        }

        .no-privilege-box {
            background: #2c3e50;
            color: #ffffff;
            padding: 40px 60px;
            border-radius: 8px;
            text-align: center;
            max-width: 600px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .no-privilege-box h3 {
            color: #ffffff;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            line-height: 1.4;
        }

        .no-privilege-box p {
            color: #ecf0f1;
            font-size: 16px;
            line-height: 1.6;
            margin: 0;
        }
    </style>
    <!--end::Base Styles -->
</head>
<!-- end::Head -->
<!-- end::Body -->
<body  class="m-footer--fixed m-page--fluid {{Cookie::get("sidebar-class")}}  m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default napomena-alert"  >
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <!-- BEGIN: Header -->
        @if(!isset($hideLayout) || !$hideLayout)
            @include('legacy.fixed.header')
        @endif
        <!-- END: Header -->
        <!-- begin::Body -->
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
            <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
                <i class="la la-close"></i>
            </button>

            @if(!isset($hideLayout) || !$hideLayout)
                @include('legacy.layouts.sidenav')
            @endif

            <div class="m-grid__item m-grid__item--fluid m-wrapper">
                <div style="width: 100%; position: relative;">
                    <div class="app-loader-div">
                        <div class="wrapper">
                        <!-- <h4> Učitava se</h4> -->
                        @if (config('legacy.app_server_production') == 'Principal')
                            <div class="spinners-loader">
                                <div class="m-spinner m-spinner--primary m-spinner--lg"></div>
                                <div class="m-spinner m-spinner--primary m-spinner--lg"></div>
                                <div class="m-spinner m-spinner--primary m-spinner--lg"></div>
                            </div>
                        @else
                            {{-- <img src="{{asset('legacy/assets/images/loader_logo.gif')}}" alt=""> --}}
                            <video autoplay loop muted playsinline>
                              <source src="{{asset('legacy/assets/images/loader_logo.mp4')}}" type="video/mp4">
                              <source src="{{asset('legacy/assets/images/loader_logo.webm')}}" type="video/webm">
                            </video>
                        @endif

                        </div>
                    </div>
                    @yield('content')
                   <!-- @if(isset($hasPrivilege) && !$hasPrivilege)
                        <div class="no-privilege-container">
                            <div class="no-privilege-box">
                                <h3>Niste ovlašćeni da pristupite stranici</h3>
                                <p>Nemate privilegije za pristup modulu e-Otpremnice. Obratite se Administratoru. Listu svih Administratora i Super administratora možete videti u delu Moj Nalog/Podaci o licenci.</p>
                            </div>
                        </div>
                    @else -->
                    <!-- @endif -->
                </div>
            </div>
        </div>
        <!-- end:: Body -->
        <!-- begin::Footer -->
        {{-- @include('legacy.fixed.footer') --}}
        <!-- end::Footer -->
    </div>
    <!-- end:: Page -->

    <!--begin::Page Vendors -->
    @include('legacy.modals.listLegendModal')
    @include('legacy.fixed.scripts')
    @include('legacy.layouts.coreplugins')
    <script type="module" src="{{ asset('legacy/build/assets/app-DPqRHEjM.js') }}"></script>
     <div id="vue-feedback-modal"
         data-translations="{{ json_encode([
            'kontakt' => trans('legacy/Content/eFakture/contacts.Kontakt'),
            'korisnickaPodrska' => trans('legacy/Header/kontaktFeedback.Korisnicka podrska'),
            'feedbackTitle' => trans('legacy/Header/kontaktFeedback.Kontakt - Feedback'),
            'brojTelefonaKontakt' => trans('legacy/Header/kontaktFeedbackModal.brojTelefonaKontakt'),
            'tooltip' => 'Broj možete uneti u sledećim formatima: +38164/1234-567 0038164/1234-567 064-1234-567',
            'poruka' => trans('legacy/Header/kontaktFeedbackModal.Poruka'),
            'info' => trans('legacy/Header/kontaktFeedbackModal.info'),
            'zatvori' => trans('legacy/Header/kontaktFeedbackModal.Zatvori'),
            'posalji' => trans('legacy/Header/kontaktFeedbackModal.Pošalji'),
            'successMessage' => 'Uspešno ste poslali poruku',
            'errorMessage' => 'Došlo je do greške prilikom slanja poruke.'
         ]) }}"
         data-feedback-info="{{ config('legacy.app_server_production') == 'Principal' ? trans('legacy/Header/kontaktFeedbackModal.KfModalContentPrincipal') : trans('legacy/Header/kontaktFeedbackModal.KfModalContentElse') }}">
    </div>
    <script type="module" src="{{ asset('legacy/build/assets/app-DPqRHEjM.js') }}"></script>
<link href="{{ asset('legacy/build/assets/feedback-B-Y1npnk.css') }}" rel="stylesheet" type="text/css"/>
<script type="module" src="{{ asset('legacy/build/assets/feedback-BSYISyOt.js') }}"></script>
    @yield('footerjs')
    <!--end::Page Snippets -->
</body>


<!-- end::Body -->
</html>
