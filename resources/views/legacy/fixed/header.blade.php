{{--@php--}}
{{--    // TEMPORARY HARDCODE - remove after testing--}}
{{--    session([--}}
{{--        'module' => 'Otpremnice',--}}
{{--        'userRole' => 'USER',--}}
{{--        'realRole' => 'SADMIN',--}}
{{--        'isOwner' => true,--}}
{{--        'gost' => 0,--}}
{{--        'licenseid' => 2,--}}
{{--        'devModules' => true,--}}
{{--        'hrMozeDaMenjaKadrovik' => 0,--}}
{{--        'supManagePresence' => 1,--}}
{{--        'supManageORV' => 1,--}}
{{--        'grantCalendarAccess' => null,--}}
{{--        'licenseModule' => [--}}
{{--            'MODULE_PRINCIPAL' => 1,--}}
{{--            'P_DATES' => ['startDate' => '2021-01-16', 'endDate' => '2026-12-31'],--}}
{{--            'MODULE_DELOVODNIK' => 1,--}}
{{--            'D_DATES' => ['startDate' => '2021-01-16', 'endDate' => '2026-12-31'],--}}
{{--            'MODULE_DELOVODNIK_ARHIVIRANJE' => 1,--}}
{{--            'D_ARCHIVING_DATES' => ['startDate' => '2025-04-15', 'endDate' => '2026-12-31'],--}}
{{--            'MODULE_SELFADMIN' => 1,--}}
{{--            'S_DATES' => ['startDate' => '2021-01-16', 'endDate' => '2026-12-31'],--}}
{{--            'MODULE_SELFADMIN_LITE' => 1,--}}
{{--            'SL_DATES' => ['startDate' => '2019-12-31', 'endDate' => '2023-12-31'],--}}
{{--            'MODULE_OBRADA_IZVODA' => 1,--}}
{{--            'OI_DATES' => ['startDate' => '2023-12-31', 'endDate' => '2024-12-31'],--}}
{{--            'MODULE_POSTMAN' => 1,--}}
{{--            'POSTMAN_DATES' => ['startDate' => '2021-01-16', 'endDate' => '2026-12-31'],--}}
{{--            'MODULE_KADROVIK' => 0,--}}
{{--            'KADROVIK_DATES' => ['startDate' => '2019-12-31', 'endDate' => '2024-12-31'],--}}
{{--            'MODULE_KADROVIK_LITE' => 1,--}}
{{--            'KADROVIK_LITE_DATES' => ['startDate' => '2025-01-01', 'endDate' => '2030-12-31'],--}}
{{--            'MODULE_RP' => 0,--}}
{{--            'RP_DATES' => ['startDate' => null, 'endDate' => null],--}}
{{--            'MODULE_RESORSI' => 1,--}}
{{--            'RESORSI_DATES' => ['startDate' => '2024-12-03', 'endDate' => '2026-12-31'],--}}
{{--            'MODULE_PROCEDURE' => 1,--}}
{{--            'PROCEDURE_DATES' => ['startDate' => '2025-06-27', 'endDate' => '2026-12-31'],--}}
{{--            'MODULE_PREUZIMANJE_PODATAKA' => 1,--}}
{{--            'PREUZIMANJE_PODATAKA_DATES' => ['startDate' => '2019-12-31', 'endDate' => '2025-12-31'],--}}
{{--            'MODULE_TEXTS' => 0,--}}
{{--            'TEXTS_DATES' => ['startDate' => null, 'endDate' => null],--}}
{{--            'MODULE_OCR' => 0,--}}
{{--            'OCR_DATES' => ['startDate' => null, 'endDate' => null],--}}
{{--            'MODULE_BROWSER_EXTENSION' => 0,--}}
{{--            'BROWSER_EXTENSION_DATES' => ['startDate' => null, 'endDate' => null],--}}
{{--            'MODULE_DOGADJAJI' => 1,--}}
{{--            'DOGADJAJI_DATES' => ['startDate' => '2019-12-31', 'endDate' => '2025-12-31'],--}}
{{--            'MODULE_ELMS' => 1,--}}
{{--            'ELMS_DATES' => ['startDate' => '2024-10-01', 'endDate' => '2026-12-31'],--}}
{{--            'MODULE_FISKALNI' => 1,--}}
{{--            'FISKALNI_DATES' => ['startDate' => '2026-01-01', 'endDate' => '2026-12-31'],--}}
{{--            'MODULE_TROSKOVNIK' => 1,--}}
{{--            'TROSKOVNIK_DATES' => ['startDate' => '2024-09-17', 'endDate' => '2026-12-31'],--}}
{{--            'MODULE_TICKETING' => 1,--}}
{{--            'TICKETING_DATES' => ['startDate' => '2025-12-01', 'endDate' => '2026-12-31'],--}}
{{--            'MODULE_OBRASCI' => 1,--}}
{{--            'OBRASCI_DATES' => ['startDate' => '2019-12-31', 'endDate' => '2025-12-31'],--}}
{{--            'MODULE_OTPREMNICE' => 1,--}}
{{--            'OTPREMNICE_DATES' => ['startDate' => '2025-12-01', 'endDate' => '2026-12-31'],--}}
{{--            'MODULE_EMAIL_ZAVODJENJE' => 1,--}}
{{--            'EMAIL_ZAVODJENJE_DATES' => ['startDate' => '2025-11-01', 'endDate' => '2026-12-31'],--}}
{{--            'MODULE_TOTAL' => 0,--}}
{{--            'MODULE_RP_SETTINGS' => 0,--}}
{{--        ],--}}
{{--    ]);--}}
{{--@endphp--}}
<!-- BEGIN: Header -->
<style>
    #aplikacijaHeder {
        width: fit-content;
        display: inline-block;
        white-space: nowrap;
        padding: 4px 8px;
    }
    .topSpace {
        top: 0 !important;
    }

    .m-dropdown__body {
        white-space: normal;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .savetovanja-link {
		box-sizing: border-box;
		color: rgb(173, 91, 235);
		cursor: pointer;
		text-align: center;
		white-space: nowrap;
		padding: 0;
		display: flex !important;
		align-items: center;
		justify-content: center;
	}

    .test {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1049;
    }

    #aplikacijaHeder .kancelarko_desktop {
        margin-left: 0 !important;
    }

    /* sve je ovo zbog napomene */

    #m_header {
        top: 70px;
    }

    #m_aside_left {
        padding-top: 70px;
    }

    .gold-logo-image {
		width: 70px;
	}
    .m-grid__item.m-grid__item--fluid {
        padding-top: 70px;
    }

    .SEFinfo {
        font-size: 11px;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 10;
        padding: 14px;

        width: 100%;
        min-height: 70px;
        max-height: 100px;
    }

    .infoRed {
        background: #842029;
        color: #f8d7da;
    }

    .adaptive-menu {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* dva stupca */
        column-gap: 20px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .adaptive-menu.single-column-scroll {
        display: grid;
        grid-template-columns: 1fr !important;
        max-height: none;
        overflow-y: auto;
        box-sizing: border-box;
        padding-right: 10px;
    }

    .infoPink {
        background: #EE9DB2;
        color: #4E4E4E;
    }

    .infoYellow {
        background: #DFDD58;
        color: #181818;
    }

    /* .infoGreen{
        background: #0f5132;
        color: #d1e7dd;
    } */

    .infoGreen {
        display: none;
    }

    .infoLightGreen {
        background: #87a922;
        color: #d1e7dd;
    }

    .kancelarko_desktop {
        margin-left: 0;
    }

    /* staviti na row kada su u pitanju stranice sa porukama (unauthorized...) */
    .napomena-alert .trenutno-pad-fix {
        padding-top: 90px;
    }

    .header-list .m-nav__item {
        padding: 0 6px !important;
    }

    .savetovanja-link {
        box-sizing: border-box;
        color: rgb(173, 91, 235);
        cursor: pointer;
        text-align: center;
        white-space: nowrap;
        padding: 0;
        display: flex !important;
        align-items: center;
        justify-content: center;
    }

    @media only screen and (min-width: 1800px) {
        .kancelarko_desktop {
            margin-left: 100px;
        }
    }

    @media only screen and (max-width: 1240px) {
        #m_header {
            top: 80px;
        }

        #m_aside_left {
            padding-top: 80px;
        }

        .m-grid__item.m-grid__item--fluid.m-wrapper {
            padding-top: 80px;
        }

        #m_header_menu {
            padding-top: 80px;
        }

    }

    @media only screen and (max-width: 800px) {

        /* .SEFinfo {
            height:100px;
        } */
        #m_header {
            top: 90px;
        }

        #m_aside_left {
            padding-top: 100px;
        }

        .m-grid__item.m-grid__item--fluid.m-wrapper {
            padding-top: 100px;
        }

        #m_header_menu {
            padding-top: 100px;
        }

    }

    /* end sve je ovo zbog napoemne */

    .eArhiviranje span.m-menu__link-text:hover {
        cursor: default !important;
    }

    .eArhiviranje .m-menu__link-icon:hover {
        cursor: default !important;
    }

    .name-initials > span {
        border-radius: 50%;
        width: 32px;
        height: 32px;
        padding: 6px;
        border: 1px solid #5867dd;
        color: #5867dd;
        text-align: center;
        font: 17px;
        font-weight: 400;
    }

    .discount-btn .m-nav__link {
        display: flex !important;
		align-items: center !important;
		justify-content: center !important;
	}

	.discount-btn .m-nav__link-icon {
		display: flex !important;
		gap: 8px;
		align-items: center;
		vertical-align: center;
		width: auto !important;
		height: auto !important;
		border: 3px solid #7266f0;
		border-radius: 30px;
		padding: 3px 16px !important;
	}

	.discount-btn .m-nav__link-icon i {
		font-size: 2rem !important;
	}

	.discount-btn .m-nav__link-icon .discount-text {
		font-weight: 600;
		font-size: 16px;
		color: #000 !important;
	}

	.paragraf-ai-client-btn {
		border-radius: 8px;
		padding: 5px 8px !important;
		transition: box-shadow 0.2s ease, background-color 0.2s ease;
		display: inline-flex !important;
		align-items: center;
	}
	.paragraf-ai-client-btn:hover {
		box-shadow: 0 2px 10px rgba(0, 0, 0, 0.35);
		background-color: rgba(255, 255, 255, 0.08);
	}

    .unreadnotificationlist {
	    background-color: #e3deff;
    }

    .notificationwordbreak {
        word-break: break-word !important;
    }

    .read_unread_span{
        margin-left: 294px;
        vertical-align: super;
    }

    .checkbox-mark-read{
        margin-left: 38px;
        vertical-align: super;
    }

    .checkbox-mark-unread{
        margin-left: 23px;
        vertical-align: super;
    }

    .m-list-timeline__time{
        vertical-align: top !important;
    }

    #markalllink_read, #markalllink_unread{
        margin: 0 !important;
    }

    .color-white {
        color :white !important;
    }

    .text-right {
        text-align: right !important;
    }

    .padding-check {
        padding-left: 33px !important;
    }

    .preview-table-row{
        border-bottom: 1px solid #ddd3ef;
        padding-top: 10px;
    }

    .preview-table-row .la{
        color: #c2a5f7;
        cursor: pointer;
    }

    .preview-table-row label{
        font-weight: bold;
    }

    #notificationsDropdown {
        z-index: 500 !important;
        width: 620px !important;
        max-width: calc(100vw - 24px) !important;
        margin-left: 0 !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
    }

    @media (max-width: 768px) {
        #notificationsDropdown {
            width: 100vw !important;
            left: 0 !important;
            transform: none !important;
        }
    }
 
</style>

@if (!in_array( session("module"), ["Selfadmin","SelfadminLite"]))

    <style>
        #m_header {
            top: 0px;
        }

        #m_aside_left {
            padding-top: 0px;
        }

        .m-grid__item.m-grid__item--fluid {
            padding-top: 0px;
        }

        @media only screen and (max-width: 1240px) {
            #m_header {
                top: 0px;
            }

            #m_aside_left {
                padding-top: 0px;
            }

            .m-grid__item.m-grid__item--fluid {
                padding-top: 0px;
            }

            #m_header_menu {
                padding-top: 0px;
            }
        }

        @media only screen and (max-width: 800px) {
            #m_header {
                top: 0px;
            }

            #m_aside_left {
                padding-top: 0px;
            }

            .m-grid__item.m-grid__item--fluid {
                padding-top: 0px;
            }

            #m_header_menu {
                padding-top: 0px;
            }
        }

    </style>
@else
    @if(config('legacy.sef_pink') == true && config('legacy.sef') == true)
    @elseif(config('legacy.sef') == false)
    @else
        <style>
            #m_heade

            /
            /
            ... existing code ...
            color: #5867dd

            ;
            text-align: center

            ;
            font-size:

            17
            px

            ;
            font-weight:

            400
            ;
            }
        </style>
        // ... existing code ...: 0px;
        }

        #m_aside_left {
        padding-top: 0px;
        }
        .m-grid__item.m-grid__item--fluid {
        padding-top: 0px;
        }

        @media only screen and (max-width: 1240px) {
        #m_header {
        top: 0px;
        }
        #m_aside_left {
        padding-top: 0px;
        }
        .m-grid__item.m-grid__item--fluid {
        padding-top: 0px;
        }
        #m_header_menu {
        padding-top: 0px;
        }
        }

        @media only screen and (max-width: 800px) {
        #m_header {
        top: 0px;
        }

        #m_aside_left {
        padding-top: 0px;
        }
        .m-grid__item.m-grid__item--fluid {
        padding-top: 0px;
        }

        #m_header_menu {
        padding-top: 0px;
        }
        }

        </style>
    @endif
@endif

{{--@dd(--}}
{{--session('module'),--}}
{{--      session('userRole'),--}}
{{--      session('realRole'),--}}
{{--      session('isOwner'),--}}
{{--      session('gost'),--}}
{{--      session('licenseModule'),--}}
{{--      session('licenseid'),--}}
{{--      session('devModules'),--}}
{{--      session('hrMozeDaMenjaKadrovik'),--}}
{{--      session('supManagePresence'),--}}
{{--      session('supManageORV'),--}}
{{--      session('grantCalendarAccess'),--}}
{{--)--}}

@if (session("module") == "Selfadmin" || session("module") == "SelfadminLite")

    <div
        class="SEFinfo @if(config('legacy.sef_pink') == true && config('legacy.sef') == true) infoPink @elseif(config('legacy.sef') == false) infoRed @else infoGreen @endif">
        <!--
        <center>Poštovani korisnici, obaveštavamo vas da je Kancelarko povezan sa SEF. <b>Kako je produkciona verzija SEF još uvek podložna čestim izmenama od strane Min. finansija</b>,
        daćemo sve od sebe da ispratimo sve izmene i omogućimo nesmetano korišćenje Kancelarka.
        Molimo vas da nam sve probleme u korišćenju što pre prijavite putem opcije „Kontakt-Feedback“ kako bismo ih hitno rešili.</center>
        -->
        @if(config('legacy.sef'))
            @if(config('legacy.sef_pink'))
                <center><b>SEF ima poteškoća u funkcionisanju putem API pristupa (ovo se ne odnosi na direktno logovanje
                        na SEF).</b><br/>
                    Mogu se očekivati: greške prilikom slanja faktura, duže vreme slanja/primanja, nemogućnost
                    odobravanja/odbijanja/storniranja kao i pregleda SEF pdf dokumenata i sl. Molimo Vas da periodično
                    refreshujete ovu stranicu kako bi se ova poruka ažurirala sa najnovijom informacijom o radu SEF.
                </center>

                {{-- <center style="font-size:15px;"><b>Obaveštavamo korisnike da SEF, zbog neophodnih infrastrukturnih ažuriranja, neće biti dostupan od 22 sata u subotu 23. marta.</b><br>
                Očekujemo da SEF ponovo postane dostupan u nedelju 24. marta u ranim jutarnjim časovima.
                <a href="https://www.efaktura.gov.rs/vest/2520/najava-sef-nece-biti-dostupan-u-subotu-uvece.php">Vest možete videti ovde.</a>
                </center> --}}
            @else
                <center><b>Sistem elektronskih faktura (SEF) je u funkciji i aktivan.</b><br/>
                    U slučaju da imate poteškoća u slanju ili primanju faktura, pišite nam na
                    <b>kancelarko@paragraf.rs</b> a
                    Molimo Vas da periodično refreshujete ovu stranicu kako bi se ova poruka ažurirala sa najnovijom
                    informacijom o radu SEF.
                </center>
            @endif

        @else
            <center><b>SEF trenutno nije u funkciji putem API pristupa (ovo se ne odnosi na direktno logovanje na
                    SEF).</b> <br/>Kancelarko je iz tog razloga privremeno onesposobio slanje na SEF.
                Kada SEF bude ponovo aktivan, ova poruka će biti sklonjena. Do tada, fakture možete kreirati u delu
                spremne za slanje.
                Molimo Vas da periodično refreshujete ovu stranicu kako bi se ova poruka ažurirala sa najnovijom
                informacijom o radu SEF.
            </center>
        @endif


    </div>

@endif

{{-- @if(session("module") == "Selfadmin" || session("module") == "SelfadminLite")
	<div class="SEFinfo infoPink">
		<center>Zbog nove verzije SEF-a, određeni broj faktura znatno kasni. Dok SEF ne reši situaciju, molimo korisnike da dodatno proveravaju fakture i na SEF-u. Hvala na razumevanju.</center>
		<center><b>SEF ima poteškoća u funkcionisanju putem API pristupa (ovo se ne odnosi na direktno logovanje na SEF).</b><br/>
			Mogu se očekivati: greške prilikom slanja faktura, duže vreme slanja/primanja, nemogućnost odobravanja/odbijanja/storniranja kao i pregleda SEF pdf dokumenata i sl. Molimo Vas da periodično refreshujete ovu stranicu kako bi se ova poruka ažurirala sa najnovijom informacijom o radu SEF.
		</center>
	</div>
@endif --}}


{{-- <div class="SEFinfo infoYellow " style="margin-top:70px;"> --}}
{{-- <center style="margin-top:10px;" class>
    <i class="la la-info "></i>
    Poštovani korisnici, zbog planiranih radova na održavanju i unapređenju sistema Kancelarko isti neće biti dostupan u periodu od petka 25.11.2022 od 22h najkasnije do ponedeljka 28.11.2022 do 4h ujutru.
</center> --}}

{{-- </div>   --}}


<header id="m_header" class="m-grid__item m-header" m-minimize-offset="200" m-minimize-mobile-offset="200">
    <div class="m-container m-container--fluid m-container--full-height">

        <div class="m-stack m-stack--ver m-stack--desktop" style="background: white">
            <!-- BEGIN: Brand -->
            <div class="m-stack__item m-brand  m-brand--skin-dark ">
                <div class="m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-stack__item--middle m-brand__logo">
                        @if(config('legacy.app_server_production') == 'Principal')
                            <img src="{{asset("img/beta.png")}}" alt="Beta" id="beta-banner">
                        @endif
                        {{-- Poštovani, ovo je prva verzija našeg novog programa; online advokatski rokovnik Principal. Iako smo je detaljno testirali,
                                     postoji mogućnost pojavljivanja bagova (grešaka u radu programa) te Vas pozivamo da ukoliko na iste naiđete
                                     ili imate neke druge svoje ideje ili predloge, da nam ih prijavite na <a href='mailto:principal@paragraf.rs'>principal@paragraf.rs</a>
                                      kako bismo ih što pre ispravili ili novine inkorporirali.
                                       Iz tog razloga, program novi oznaku „beta“, što označava program koji je zvanično objavljen i trenutno je u fazi isprobavanja od
                                        strane finalnih korisnika. Molimo Vas da takođe imate razumevanja kako prema ovoj novonastaloj aplikaciji, tako i prema našim zaposlenima
                                         koji ulažu značajan trud da Principal uvrste u svoje dnevne aktivnosti i upoznaju se s njim u potpunosti. --}}
                        <a href="{{url('/')}}" class="m-brand__logo-wrapper float-left">
                            {{-- <img alt="" src="{{ asset('legacy/assets/demo/default/media/img/logo/logo_default_dark.png') }}"/> --}}
                            @if(config('legacy.app_server_production') == 'Principal')
                                <img alt="" src="{{ URL::to('legacy/img/logo/logo_default_dark.png') }}"
                                     style="width: 155px !important"/>
                            @elseif(config('legacy.app_server_production') == 'Delovodnik')
                                <img alt="" src="{{ URL::to('legacy/assets/images/kancelarko_w.png') }}"
                                     style="width: 155px !important"/>
                            @endif
                        </a>
                    </div>
                    <div class="m-stack__item m-stack__item--middle m-brand__tools">
                        <!-- BEGIN: Left Aside Minimize Toggle -->
                        <a href="javascript:collapseToggle();" id="m_aside_left_minimize_toggle"
                           class="{{Cookie::get('sidebar-button-class')}} m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block">
                            <span></span>
                        </a>
                        <!-- END -->
                        <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                        <a href="javascript:;" id="m_aside_left_offcanvas_toggle"
                           class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>
                        <!-- END -->
                        <!-- BEGIN: Responsive Header Menu Toggler -->
                        <a id="m_aside_header_menu_mobile_toggle" href="javascript:;"
                           class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>
                        <!-- END -->
                        <!-- BEGIN: Topbar Toggler -->
                        <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;"
                           class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                            <i class="flaticon-more"></i>
                        </a>
                        <!-- BEGIN: Topbar Toggler -->
                    </div>
                </div>
            </div>
            <!-- END: Brand -->
            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                <!-- BEGIN: Horizontal Menu -->
                <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark "
                        id="m_aside_header_menu_mobile_close_btn">
                    <i class="la la-close"></i>
                </button>
                <div id="m_header_menu"
                     class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">


                    @if(config('legacy.app_server_production') == 'Principal')
                        <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                            <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"
                                m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-add"></i>
                                    <span class="m-menu__link-text">
									{{-- Rokovnik --}}
                                        {{trans('legacy/Header/principalSubs.Rokovnik')}}
								</span>
                                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </a>
                                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                    <ul class="m-menu__subnav">
                                        @if(config('legacy.displayWtime') === true)
                                            <li class="m-menu__item " aria-haspopup="true">
                                                <a href="{{route('newwtime')}}" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-file"></i>


                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														{{-- Novo vreme rada --}}
                                                        {{trans('legacy/Header/principalSubs.Novo vreme rada')}}
													</span>
													<span class="m-menu__link-badge">
														{{-- <span id="unreadWtBadgeHeader" class="m-badge m-badge--warning" title="Nepročitana vremena rada" style="display: none;"> --}}
														<span id="unreadWtBadgeHeader" class="m-badge m-badge--warning"
                                                              title="{{trans('legacy/Header/PrincipalSubs.Nepročitana vremena rada')}}"
                                                              style="display: none;">
															...
														</span>
													</span>
												</span>
											</span>


                                                </a>
                                            </li>
                                        @endif
                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                            <a href="{{route('newtask')}}" class="m-menu__link ">
                                                <i class="m-menu__link-icon flaticon-list-3"></i>
                                                <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														{{-- Nova obaveza --}}
                                                        {{trans('legacy/Header/principalSubs.Nova obaveza')}}
													</span>
													<span class="m-menu__link-badge">
														{{-- <span id="newRokBadgeHeader" class="m-badge m-badge--danger" title="Zahtevi na čekanju (novi rok, završetak, odustanak)" style="display: none;"> --}}
														<span id="newRokBadgeHeader" class="m-badge m-badge--danger"
                                                              title="{{trans('legacy/Header/PrincipalSubs.Zahtevi na čekanju (novi rok, završetak, odustanak)')}}"
                                                              style="display: none;">
															...
														</span>
														{{-- <span id="unreadBadgeHeader" class="m-badge m-badge--warning" title="Nove obaveze / nepročitani komentari" style="display: none;"> --}}
														<span id="unreadBadgeHeader" class="m-badge m-badge--warning"
                                                              title="{{trans('legacy/Header/PrincipalSubs.Nove obaveze / nepročitani komentari')}}"
                                                              style="display: none;">
															...
														</span>
													</span>
												</span>
											</span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                            <a href="{{route('newcase')}}" class="m-menu__link ">
                                                <i class="m-menu__link-icon flaticon-file"></i>
                                                <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														{{-- Novi predmet --}}
                                                        {{trans('legacy/Header/principalSubs.Novi predmet')}}
													</span>
													<span class="m-menu__link-badge">
														{{-- <span id="unreadCaseBadgeHeader" class="m-badge m-badge--warning" title="Novi predmeti / nepročitani komentari" style="display: none;"> --}}
														<span id="unreadCaseBadgeHeader"
                                                              class="m-badge m-badge--warning"
                                                              title="{{trans('legacy/Header/PrincipalSubs.Novi predmeti / nepročitani komentari')}}"
                                                              style="display: none;">
															...
														</span>
													</span>
												</span>
											</span>
										</a>
									</li>
								</ul>
							</div>
						</li>


                            <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"
                                m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="false">
                                <a href="javascript:" class="m-menu__link m-menu__toggle showToGuest"
                                   id="shareWithFirentsOpenModal">
								<span class="m-menu__link-text showToGuest" style="color: #5961d8;">
									<i class="fa fa-envelope-o" aria-hidden="true"></i>
									{{-- Podeli --}}
                                    {{trans('legacy/Header/kontaktFeedback.podeli')}}
								</span>
                                </a>
                            </li>

                            <!-- video lilnkovi -->
                            <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"
                                m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="false"
                                id="videoUputstvaLI" style="display: none;">
                                <a href="javascript:" class="m-menu__link m-menu__toggle showToGuest"
                                   id="videoUputstva">
								<span class="m-menu__link-text showToGuest" style="color: #5961d8;">
									<i class="fa fa-youtube-play" aria-hidden="true"></i>
									{{trans('legacy/Header/kontaktFeedback.Video uputstva')}}
								</span>
                                </a>
                            </li>

                            {{-- <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true" id="videoUputstvaShow">
                                <a  href="javascript:;" class="m-menu__link m-menu__toggle showToGuest">
                                    <span class="m-menu__link-text showToGuest" style="color: #5961d8;">
                                        <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                        {{trans('legacy/Header/kontaktFeedback.Video uputstva')}}
                                    </span>
                                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </a>
                                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item "  aria-haspopup="true">
                                            <a  href="javascript:" class="m-menu__link " id="eFakUputstva">
                                                <i class="m-menu__link-icon fa fa-play-circle-o"></i>
                                                <span class="m-menu__link-text">
                                                                {{trans('legacy/Header/kontaktFeedback.uputstvaFakture')}}
                                                            </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item "  aria-haspopup="true">
                                            <a  href="javascript:" class="m-menu__link "  id="eDelUputstva">
                                                <i class="m-menu__link-icon fa fa-play-circle-o"></i>
                                                <span class="m-menu__link-text">
                                                                {{trans('legacy/Header/kontaktFeedback.uputstvaDelovodnik')}}
                                                            </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item "  aria-haspopup="true">
                                            <a  href="javascript:" class="m-menu__link "  id="videoUputstva">
                                                <i class="m-menu__link-icon fa fa-play-circle-o"></i>
                                                <span class="m-menu__link-text">
                                                                {{trans('legacy/Header/kontaktFeedback.uputstvaStranica')}}
                                                            </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item "  aria-haspopup="true" style="text-align: right;padding-right: 5px">
                                                <span class="m-menu__link-text">
                                                                <label class="m-checkbox m-checkbox--air m-checkbox--solid">
                                                                            <input type="checkbox" id="videoUputstvaShowCheck">
                                                                {{trans('legacy/Header/kontaktFeedback.Ne prikazuj više')}}
                                                                            <span></span>
                                                                </label>
                                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </li> --}}

                            <li class="m-menu__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width"
                                m-dropdown-toggle="click"
                                m-dropdown-persistent="1">
                                <a href="javascript:" class="m-nav__link m-dropdown__toggle showToGuest"
                                   id="m_topbar_kancelarko_poruke_icon">
                                    {{trans('legacy/Header/notification.Kancelarko poruke')}}
                                    <span class="m-nav__link-badge">
									<span id="kancelarkoPorukeCount" class="m-badge m-badge--danger"
                                          style="display: none;"></span>
								</span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                    <div class="m-dropdown__inner" style="margin-right:27px">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="topbar_kancelarko_poruke"
                                                         role="tabpanel">
                                                        <div class="m-scrollable" data-scrollable="true"
                                                             data-max-height="250" data-mobile-max-height="200">
                                                            <div class="m-list-timeline m-list-timeline--skin-light">
                                                                <div class="m-list-timeline__items"
                                                                     id="kancelarkoPorukeList"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#" class="btn m-btn--pill m-btn--air btn-outline-info"
                                                   style="text-align: center; width: 100%; margin-top: 15px;">
                                                    {{trans('legacy/Header/notification.Sve poruke')}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>


                            <!-- Tips and Tricks -->
                            <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"
                                m-menu-submenu-toggle="click" data-toggle="modal" data-target="#tipsAndTricksModal"
                                m-menu-link-redirect="1" aria-haspopup="false" id="tipsAndTricksLI"
                                style="display:none;">
                                <a href="javascript:" class="m-menu__link m-menu__toggle showToGuest"
                                   id="tipsAndTricks">
								<span class="m-menu__link-text showToGuest" style="color: #5961d8;">
									<i class="fa fa-eye" aria-hidden="true"></i>
									{{trans('legacy/Content/ispravke.tipsAndTricks.Tips and Tricks')}}
                                    {{-- Tips and Tricks --}}
								</span>
                                </a>
                            </li>
                            <!-- Tips and Tricks disabled -->
                            <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" aria-haspopup="false"
                                id="disabledTipsAndTricksLI" style="display:none">
                                <a href="javascript:" class="m-menu__link m-menu__toggle showToGuest disabled"
                                   id="disabledTipsAndTricks">
								<span class="m-menu__link-text showToGuest" style="color: #898b96;">
									<i class="fa fa-eye" aria-hidden="true"></i>
									{{trans('legacy/Content/ispravke.tipsAndTricks.Tips and Tricks')}}
                                    {{-- Tips and Tricks --}}
									<div id="tricksLoader" class="m-loader m-loader--primary"
                                         style="width: 30px; display: inline-block;margin-bottom: 5px;"></div>
								</span>
                                </a>
                            </li>
                        </ul>
                    @endif
                    @if(config('legacy.app_server_production') == 'Delovodnik')
                        <!-- atila 1	 -->

                        <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                            <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"
                                m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                    @if (session("module") == 'Principal')
                                        <span
                                            style="width: 33px; height: 30px; display: table-cell; vertical-align: middle;">
									<img
                                        src="{{url(asset('legacy/assets/app/media/img/module-logos/principal-logo-400.jpg'))}}"
                                        style="width: 33px; height: 30px; display: table-cell; vertical-align: middle;"
                                        alt="">
								</span>
                                    @else
                                        <i class="m-menu__link-icon flaticon-add"></i>
                                    @endif

                                    <span class="m-menu__link-text">

									@php
                                        $showModuleName = session("module");

                                        if (session("module") == "Selfadmin") {
                                        //$showModuleName = "e-Fakture";
                                        $showModuleName = trans('legacy/Header/showModuleName.e-Fakture');
                                        }

                                        if (session("module") == "SelfadminLite") {
                                        $showModuleName = trans('legacy/Header/showModuleName.e-Fakture-lite');
                                        }

                                        if (session("module") == "Delovodnik") {
                                        //$showModuleName = "e-Delovodnik";
                                        $showModuleName = trans('legacy/Header/showModuleName.e-Delovodnik');
                                        }
                                        if (session("module") == "Principal") {
                                        $showModuleName = trans('legacy/Header/showModuleName.Principal');
                                        }
                                        if (session("module") == "Postman") {
                                        $showModuleName = trans('legacy/Header/showModuleName.e-Poštar');
                                        }

                                        if (session("module") == "Kadrovik") {
                                        $showModuleName = trans('legacy/Header/showModuleName.Kadrovik').' (beta)';
                                        }

                                        if (session("module") == "Robno poslovanje") {
                                        $showModuleName = trans('legacy/Header/showModuleName.Robno').' (beta)';
                                        }

                                        if (session("module") == "Resorsi") {
                                        $showModuleName = 'Resursi (beta)';
                                        }

                                        if (session("module") == "Procedure") {
                                        $showModuleName = trans('legacy/Header/showModuleName.e-Procedure').' (beta)';
                                        }

                                    @endphp

                                        {{ $showModuleName }}
								</span>
                                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </a>
                                <div class="m-menu__submenu m-menu__submenu--classic"
                                     style="min-width: 450px; max-width: 90vw; width: auto; left: 50%; transform: translateX(-50%);">
                                    <span class="m-menu__arrow"></span>
                                    <ul class="m-menu__subnav adaptive-menu">
                                        <li class="m-menu__item m-menu__item--submenu" m-menu-submenu-toggle="hover"
                                            m-menu-link-redirect="1" aria-haspopup="true">
                                            @if (checkmodule('MODULE_PRINCIPAL') && !empty(session('licenseModule')['P_DATES']['endDate']) && empty(session("gost")))

                                                <a href="{{route('switchModul')}}?module=Principal"
                                                   class="m-menu__link ">
												<span
                                                    style="width: 33px; height: 30px; display: table-cell; vertical-align: middle;">
													<img
                                                        src="{{url(asset('legacy/assets/app/media/img/module-logos/principal-logo-400.jpg'))}}"
                                                        style="transform: translateX(-5px); width: 33px; height: 30px; display: table-cell; vertical-align: middle;"
                                                        alt="">
												</span>
                                                    <span class="m-menu__link-title">
													<span class="m-menu__link-wrap">
														<span class="m-menu__link-text">
															{{-- Principal --}}
                                                            {{trans('legacy/Header/showModuleName.Principal')}}
														</span>
														<i class="m-menu__hor-arrow la la-angle-down"></i>
														<i class="m-menu__ver-arrow la la-angle-right"></i>
													</span>
												</span>
                                                </a>
                                            @endif
                                            @if (checkmodule('MODULE_PRINCIPAL') && !empty(session('licenseModule')['P_DATES']['endDate']) && empty(session("gost")))
                                                <div
                                                    class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                    <span class="m-menu__arrow"></span>
                                                    <ul class="m-menu__subnav">
                                                        <li class="m-menu__item " m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            <a href="{{route('switchModul')}}?module=Principal&cases=1"
                                                               class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-file"></i>
                                                                <span class="m-menu__link-text">
																{{-- Predmeti (principalSubs) --}}
                                                                    {{trans('legacy/Header/principalSubs.Predmeti')}}
															</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item " m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            <a href="{{route('switchModul')}}?module=Principal&tasks=1"
                                                               class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-list-3"></i>
                                                                <span class="m-menu__link-text">
																{{-- Obaveze (principalSubs) --}}
                                                                    {{trans('legacy/Header/principalSubs.Obaveze')}}
															</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item " m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            <a href="{{route('switchModul')}}?module=Principal&alarms=1"
                                                               class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-bell"></i>
                                                                <span class="m-menu__link-text">
																{{-- Alarmi (principalSubs) --}}
                                                                    {{trans('legacy/Header/principalSubs.Alarmi')}}
															</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </li><!-- Test push -->


                                        <li class="m-menu__item m-menu__item--submenu" m-menu-submenu-toggle="hover"
                                            m-menu-link-redirect="1" aria-haspopup="true">
                                            @if (checkmodule('MODULE_DELOVODNIK') && !empty(session('licenseModule')['D_DATES']['endDate']))
                                                <a href="{{route('switchModul')}}?module=Delovodnik&dels=1"
                                                   class="m-menu__link ">

                                                    <i class="m-menu__link-icon flaticon-interface-7"></i>
                                                    <span class="m-menu__link-title">
													<span class="m-menu__link-wrap">
														<span class="m-menu__link-text">
															{{-- e-Delovodnik --}}
                                                            {{trans('legacy/Header/showModuleName.e-Delovodnik')}}
														</span>
														<i class="m-menu__hor-arrow la la-angle-down"></i>
														<i class="m-menu__ver-arrow la la-angle-right"></i>
													</span>
												</span>
                                                </a>
                                            @endif
                                            @if (checkmodule('MODULE_DELOVODNIK') && !empty(session('licenseModule')['D_DATES']['endDate']))
                                                <div
                                                    class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                    <span class="m-menu__arrow"></span>
                                                    <ul class="m-menu__subnav">
                                                        <li class="m-menu__item " m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            <a href="{{route('switchModul')}}?module=Delovodnik&dels=1"
                                                               class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-interface-7"></i>
                                                                <span class="m-menu__link-text">
																{{-- Delovodne knjige (eDelovodnikSubs) --}}
                                                                    {{trans('legacy/Header/eDelovodnikSubs.Delovodne knjige')}}
															</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item " m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            <a href="{{route('switchModul')}}?module=Delovodnik&archival=1"
                                                               class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-open-box"></i>
                                                                <span class="m-menu__link-text">
																{{-- Delovodne knjige (eDelovodnikSubs) --}}
                                                                    {{trans('legacy/Sidebar/all.Arhivska knjiga')}}
															</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item " m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            <a href="{{route('switchModul')}}?module=Delovodnik&docouments=1"
                                                               class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-file"></i>
                                                                <span class="m-menu__link-text">
																{{-- Dokumenti (eDelovodnikSubs)  --}}
                                                                    {{trans('legacy/Header/eDelovodnikSubs.Moji dokumenti')}}
															</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item " m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            <a href="{{route('switchModul')}}?module=Delovodnik&allDocument=1"
                                                               class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-folder"></i>
                                                                <span class="m-menu__link-text">
																{{-- Dokumenti (eDelovodnikSubs)  --}}
                                                                    {{trans('legacy/Header/eDelovodnikSubs.Zajednički folderi')}}
															</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item " m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            <a href="{{route('switchModul')}}?module=Delovodnik&mass=1"
                                                               class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-paper-plane"></i>
                                                                <span class="m-menu__link-text">
																{{-- Dokumenti (eDelovodnikSubs)  --}}
                                                                    {{trans('legacy/Header/eDelovodnikSubs.Exp')}}
															</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </li>

                                        <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover"
                                            m-menu-link-redirect="1" aria-haspopup="true">
                                            @if (checkmodule('MODULE_SELFADMIN') && !empty(session('licenseModule')['S_DATES']['endDate']))
                                                <a href="{{route('switchModul')}}?module=Selfadmin&sent=1"
                                                   class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														{{-- e-Fakture --}}
                                                        {{trans('legacy/Header/showModuleName.e-Fakture')}}
													</span>
													<i class="m-menu__hor-arrow la la-angle-down"></i>
													<i class="m-menu__ver-arrow la la-angle-right"></i>
												</span>
											</span>
                                                </a>
                                            @endif
                                            @if (checkmodule('MODULE_SELFADMIN') && !empty(session('licenseModule')['S_DATES']['endDate']))
                                                <div
                                                    class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                    <span class="m-menu__arrow"></span>
                                                    <ul class="m-menu__subnav">
                                                        {{-- Fakture --}}
                                                        <li class="m-menu__item m-menu__item--submenu"
                                                            m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            {{-- <a  href="javascript:;" class="m-menu__link m-menu__toggle"> del 7093--}}
                                                            <a href="{{route('switchModul')}}?module=Selfadmin&sent=1"
                                                               class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                                <span class="m-menu__link-text">
															{{trans('legacy/Header/eFaktureSubs.Fakture')}}
															</span>
                                                                <i class="m-menu__hor-arrow la la-angle-right"></i>
                                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                            </a>
                                                            <div
                                                                class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                                <span class="m-menu__arrow "></span>
                                                                <ul class="m-menu__subnav">
                                                                    <li class="m-menu__item m-menu__item--submenu"
                                                                        m-menu-submenu-toggle="hover"
                                                                        m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module=Selfadmin&sent=1"
                                                                           class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-folder-3"></i>
                                                                            <span class=" m-menu__link-text">
																			{{-- Poslate fakture (eFaktureSubs) --}}
                                                                                {{trans('legacy/Header/eFaktureSubs.Poslate fakture')}}
																		</span>
                                                                            @if(\App\Legacy\SelfAdmin::getNacinOdobravanja()->tip_odobrenja != 1 && \App\Legacy\SelfAdmin::getNacinOdobravanja()->tip_odobrenja != 2 && \App\Legacy\SelfAdmin::getNacinOdobravanja()->tip_odobrenja != 4)
                                                                                <i class="m-menu__hor-arrow la la-angle-right"></i>
                                                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                            @endif
                                                                        </a>
                                                                        @if(\App\Legacy\SelfAdmin::getNacinOdobravanja()->tip_odobrenja != 1 && \App\Legacy\SelfAdmin::getNacinOdobravanja()->tip_odobrenja != 2 && \App\Legacy\SelfAdmin::getNacinOdobravanja()->tip_odobrenja != 4)
                                                                            <div
                                                                                class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                                                <span class="m-menu__arrow "></span>
                                                                                <ul class="m-menu__subnav"
                                                                                    style="padding: 15px;">
                                                                                    <li class="m-menu__item "
                                                                                        m-menu-link-redirect="1"
                                                                                        aria-haspopup="true">
                                                                                        {{-- <a href="{{route('switchModul')}}?module=Selfadmin&sent=1" class="m-menu__link ">
                                                                                            <i class="m-menu__link-icon flaticon-folder-3""></i>
                                                                                            <span class=" m-menu__link-text">
                                                                                                {{trans('legacy/Header/eFaktureSubs.Poslate fakture')}}
                                                                                            </span>
                                                                                        </a> --}}
                                                                                        <a @if(!session("isOwner")) disabled
                                                                                           @endif style="width: 100%;"
                                                                                           title="{{trans('legacy/Content/eFakture/poslateFakture.listActionModals.sendNewInvoiceModal.Faktura')}}"
                                                                                           href="{{(rtrim(config('legacy.kancelarko_url'), '/').'/selfAdmin/sendNewInvoice')}}"
                                                                                           class="btn btn-info m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill mt-3">
                                                                                            <span
                                                                                                style="margin: 0 auto;"
                                                                                                class="button-legend">+ {{trans('legacy/Content/eFakture/poslateFakture.listActionModals.sendNewInvoiceModal.Faktura')}}</span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li class="m-menu__item "
                                                                                        m-menu-link-redirect="1"
                                                                                        aria-haspopup="true">
                                                                                        <a @if(!session("isOwner")) disabled
                                                                                           @endif
                                                                                           style="width: 100%;"
                                                                                           title="{{trans('legacy/Content/eFakture/izvodi.Avansna faktura')}}"
                                                                                           href="{{(rtrim(config('legacy.kancelarko_url'), '/').'/selfAdmin/ava/sendNewInvoice')}}"
                                                                                           class="btn btn-info m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill mt-3"
                                                                                        >
																					<span style="margin: 0 auto;"
                                                                                          class="button-legend">
																						+ {{trans('legacy/Content/eFakture/izvodi.Avansna faktura')}}
																					</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class="m-menu__item "
                                                                                        m-menu-link-redirect="1"
                                                                                        aria-haspopup="true">
                                                                                        <a @if(!session("isOwner")) disabled
                                                                                           @endif style="width: 100%;"
                                                                                           title="{{trans('legacy/Content/eFakture/poslateFakture.listActionModals.sendNewInvoiceModal.Konačna faktura')}}"
                                                                                           href="{{(rtrim(config('legacy.kancelarko_url'), '/').'/selfAdmin/sendNewInvoice').'?konacna'}}"
                                                                                           class="btn btn-info m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill mt-3">
                                                                                            <span
                                                                                                style="margin: 0 auto;"
                                                                                                class="button-legend">+ {{trans('legacy/Content/eFakture/poslateFakture.listActionModals.sendNewInvoiceModal.Konačna faktura')}}</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class="m-menu__item "
                                                                                        m-menu-link-redirect="1"
                                                                                        aria-haspopup="true">
                                                                                        <a @if(!session("isOwner")) disabled
                                                                                           @endif style="width: 100%;"
                                                                                           title="{{trans('legacy/Content/eFakture/poslateFakture.listActionModals.sendNewInvoiceModal.Ućitivanje iz fajla')}}"
                                                                                           href="{{(rtrim(config('legacy.kancelarko_url'), '/').'/selfAdmin/upload/file')}}"
                                                                                           class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill mt-3">
                                                                                            <span
                                                                                                style="margin: 0 auto;"
                                                                                                class="button-legend">+ {{trans('legacy/Content/eFakture/poslateFakture.listActionModals.sendNewInvoiceModal.Ućitivanje iz fajla')}}</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    @if(session('licenseid') == 43)
                                                                                        <li class="m-menu__item "
                                                                                            m-menu-link-redirect="1"
                                                                                            aria-haspopup="true">
                                                                                            <a @if(!session("isOwner")) disabled
                                                                                               @endif style="width: 100%;"
                                                                                               title="{{trans('legacy/Content/eFakture/poslateFakture.listActionModals.sendNewInvoiceModal.Direktno slanje na SEF')}}"
                                                                                               href="{{(rtrim(config('legacy.kancelarko_url'), '/').'/selfAdmin/upload/file/sef')}}"
                                                                                               class="btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill mt-3">
                                                                                                <span
                                                                                                    style="margin: 0 auto;"
                                                                                                    class="button-legend">+ {{trans('legacy/Content/eFakture/poslateFakture.listActionModals.sendNewInvoiceModal.Direktno slanje na SEF')}}</span>
                                                                                            </a>
                                                                                        </li>
                                                                                    @endif
                                                                                    <li class="m-menu__item "
                                                                                        m-menu-link-redirect="1"
                                                                                        aria-haspopup="true">
                                                                                        <a @if(!session("isOwner")) disabled
                                                                                           @endif style="width: 100%;"
                                                                                           title="{{trans('legacy/Content/eFakture/poslateFakture.listActionModals.sendNewInvoiceModal.Slanje gotovih faktura')}}"
                                                                                           href="{{(rtrim(config('legacy.kancelarko_url'), '/').'/selfAdmin/sent/mass')}}"
                                                                                           class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill mt-3">
                                                                                            <span
                                                                                                style="margin: 0 auto;"
                                                                                                class="button-legend">+ {{trans('legacy/Content/eFakture/poslateFakture.listActionModals.sendNewInvoiceModal.Slanje gotovih faktura')}}</span>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        @endif
                                                                    </li>
                                                                    <li class="m-menu__item " m-menu-link-redirect="1"
                                                                        aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module=Selfadmin&received=1"
                                                                           class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-folder-2"></i>
                                                                            <span class="m-menu__link-text">
																			{{-- Primljene fakture (eFaktureSubs) --}}
                                                                                {{trans('legacy/Header/eFaktureSubs.Primljene fakture')}}
																		</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item " m-menu-link-redirect="1"
                                                                        aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module=Selfadmin&done=1"
                                                                           class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                                            <span class="m-menu__link-text">
																			{{-- Fakture spremne za slanje (eFaktureSubs) --}}
                                                                                {{trans('legacy/Header/eFaktureSubs.Fakture spremne za slanje')}}
																		</span>
                                                                        </a>
                                                                    </li>
                                                                    {{-- del 7090 --}}
                                                                    <li class="m-menu__item " m-menu-link-redirect="1"
                                                                        aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module=Selfadmin&approving=1"
                                                                           class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-interface-1"></i>
                                                                            <span class="m-menu__link-text">
																			{{trans('legacy/Sidebar/all.Fakture za odobravanje')}}
																		</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item " m-menu-link-redirect="1"
                                                                        aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module=Selfadmin&blueprints=1"
                                                                           class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                                            <span class="m-menu__link-text">
																			{{-- Nacrti --}}
                                                                                {{trans('legacy/Header/eFaktureSubs.Nacrti')}}
																		</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        {{-- Profakture --}}
                                                        <li class="m-menu__item m-menu__item--submenu"
                                                            m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            {{-- <a  href="javascript:;" class="m-menu__link m-menu__toggle"> del 7093--}}
                                                            <a href="{{route('switchModul')}}?module=Selfadmin&proSent=1"
                                                               class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-interface-6"></i>
                                                                <span class="m-menu__link-text">
															{{trans('legacy/Header/eFaktureSubs.Profakture')}}
															</span>
                                                                <i class="m-menu__hor-arrow la la-angle-right"></i>
                                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                            </a>
                                                            <div
                                                                class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                                <span class="m-menu__arrow "></span>
                                                                <ul class="m-menu__subnav">
                                                                    <li class="m-menu__item " m-menu-link-redirect="1"
                                                                        aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module=Selfadmin&proSent=1"
                                                                           class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-folder-3""></i>
                                                                            <span class=" m-menu__link-text">
																			{{-- Poslate fakture (eFaktureSubs) --}}
                                                                                {{trans('legacy/Header/eFaktureSubs.Poslate profakture')}}
																			</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item " m-menu-link-redirect="1"
                                                                        aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module=Selfadmin&proReceived=1"
                                                                           class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-folder-2"></i>
                                                                            <span class="m-menu__link-text">
																			{{-- Primljene fakture (eFaktureSubs) --}}
                                                                                {{trans('legacy/Header/eFaktureSubs.Primljene profakture')}}
																		</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item " m-menu-link-redirect="1"
                                                                        aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module=Selfadmin&proDone=1"
                                                                           class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                                            <span class="m-menu__link-text">
																			{{-- Fakture spremne za slanje (eFaktureSubs) --}}
                                                                                {{trans('legacy/Header/eFaktureSubs.Profakture spremne za slanje')}}
																		</span>
                                                                        </a>
                                                                    </li>
                                                                    {{-- del 7090 --}}
                                                                    <li class="m-menu__item " m-menu-link-redirect="1"
                                                                        aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module=Selfadmin&proApproving=1"
                                                                           class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-interface-1"></i>
                                                                            <span class="m-menu__link-text">
																			{{trans('legacy/Sidebar/all.Profakture za odobravanje')}}
																		</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        {{-- Dokumenti o smanjenju i povećanju --}}
                                                        <li class="m-menu__item m-menu__item--submenu"
                                                            m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            {{-- <a  href="javascript:;" class="m-menu__link m-menu__toggle"> del 7093 --}}
                                                            <a href="{{route('switchModul')}}?module=Selfadmin&kokzSent=1"
                                                               class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-list-2"></i>
                                                                <span class="m-menu__link-text">
																{{trans('legacy/Header/eFaktureSubs.Dokumenti o smanjenju i povećanju')}}
															</span>
                                                                <i class="m-menu__hor-arrow la la-angle-right"></i>
                                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                            </a>
                                                            <div
                                                                class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                                <span class="m-menu__arrow "></span>
                                                                <ul class="m-menu__subnav">
                                                                    <li class="m-menu__item " m-menu-link-redirect="1"
                                                                        aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module=Selfadmin&kokzSent=1"
                                                                           class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-folder-3""></i>
                                                                            <span class=" m-menu__link-text">
																			{{trans('legacy/Header/eFaktureSubs.Poslata dokumenta o smanjenju i povećanju')}}
																			</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item " m-menu-link-redirect="1"
                                                                        aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module=Selfadmin&kokzReceived=1"
                                                                           class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-folder-2"></i>
                                                                            <span class="m-menu__link-text">
																			{{trans('legacy/Header/eFaktureSubs.Primljena dokumenta o smanjenju i povećanju')}}
																		</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item " m-menu-link-redirect="1"
                                                                        aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module=Selfadmin&kokzDone=1"
                                                                           class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                                            <span class="m-menu__link-text">
																			{{trans('legacy/Header/eFaktureSubs.Dokumenta o smanjenju i povećanju spremna za slanje')}}
																		</span>
                                                                        </a>
                                                                    </li>
                                                                    {{-- del 7090 --}}
                                                                    <li class="m-menu__item " m-menu-link-redirect="1"
                                                                        aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module=Selfadmin&kokzApproving=1"
                                                                           class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-interface-1"></i>
                                                                            <span class="m-menu__link-text">
																			{{trans('legacy/Sidebar/all.Dokumenta o smanjenju i povećanju za odobravanje')}}
																		</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        {{-- fakture - objedinjeno --}}
                                                        <li class="m-menu__item m-menu__item--submenu"
                                                            m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            {{-- <a  href="javascript:;" class="m-menu__link m-menu__toggle"> del 7093--}}
                                                            <a href="{{route('switchModul')}}?module=Selfadmin&allSent=1"
                                                               class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-folder-1"></i>
                                                                <span class="m-menu__link-text">
																{{trans('legacy/Sidebar/all.Fakture - objedinjeno')}}
															</span>
                                                                <i class="m-menu__hor-arrow la la-angle-right"></i>
                                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                            </a>
                                                            <div
                                                                class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                                <span class="m-menu__arrow "></span>
                                                                <ul class="m-menu__subnav">
                                                                    <li class="m-menu__item " m-menu-link-redirect="1"
                                                                        aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module=Selfadmin&allSent=1"
                                                                           class="m-menu__link ">
                                                                            <i class="m-menu__link-icon fa fa-sign-out"></i>
                                                                            <span class=" m-menu__link-text">
																			{{trans('legacy/Sidebar/all.Poslate')}}
																			</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item " m-menu-link-redirect="1"
                                                                        aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module=Selfadmin&allReceived=1"
                                                                           class="m-menu__link ">
                                                                            <i class="m-menu__link-icon fa fa-sign-in"></i>
                                                                            <span class="m-menu__link-text">
																			{{trans('legacy/Sidebar/all.Primljene')}}
																		</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </li>

                                        @if (true)
                                            <li class="m-menu__item  m-menu__item--submenu"
                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                aria-haspopup="true">
                                                @if (checkmodule('MODULE_SELFADMIN_LITE') && !empty(session('licenseModule')['SL_DATES']['endDate']))
                                                    <a href="{{route('switchModul')}}?module=SelfadminLite&dashborad=1"
                                                       class="m-menu__link ">
                                                        <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                        <span class="m-menu__link-title">
													<span class="m-menu__link-wrap">
														<span class="m-menu__link-text">
															{{-- e-Fakture --}}
                                                            {{trans('legacy/Header/showModuleName.e-Fakture-lite')}} (beta)
														</span>
														<i class="m-menu__hor-arrow la la-angle-down"></i>
														<i class="m-menu__ver-arrow la la-angle-right"></i>
													</span>
												</span>
                                                    </a>
                                                @endif
                                                @if (checkmodule('MODULE_SELFADMIN_LITE') && !empty(session('licenseModule')['SL_DATES']['endDate']))
                                                    <div
                                                        class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                        <span class="m-menu__arrow "></span>
                                                        <ul class="m-menu__subnav">
                                                            <li class="m-menu__item " m-menu-link-redirect="1"
                                                                aria-haspopup="true">
                                                                <a href="{{route('switchModul')}}?module=SelfadminLite&dashborad=1"
                                                                   class="m-menu__link ">
                                                                    <i class="m-menu__link-icon fa fa-tachometer"></i>
                                                                    <span class="m-menu__link-text">
																{{-- Fakture spremne za slanje (eFaktureSubs) --}}
                                                                        {{trans('legacy/Header/eFaktureSubs.Komandna tabla')}}
															</span>
                                                                </a>
                                                            </li>

                                                            <li class="m-menu__item " m-menu-link-redirect="1"
                                                                aria-haspopup="true">
                                                                <a href="{{route('switchModul')}}?module=SelfadminLite&sent=1"
                                                                   class="m-menu__link ">
                                                                    <i class="m-menu__link-icon fa fa-sign-out"></i>
                                                                    <span class="m-menu__link-text">
																{{trans('legacy/Header/eFaktureSubs.Prodaja')}}
															</span>
                                                                </a>
                                                            </li>

                                                            <li class="m-menu__item " m-menu-link-redirect="1"
                                                                aria-haspopup="true">
                                                                <a href="{{route('switchModul')}}?module=SelfadminLite&received=1"
                                                                   class="m-menu__link ">
                                                                    <i class="m-menu__link-icon fa fa-sign-in"></i>
                                                                    <span class="m-menu__link-text">
																{{trans('legacy/Header/eFaktureSubs.Nabavka')}}
															</span>
                                                                </a>
                                                            </li>

                                                            <li class="m-menu__item " m-menu-link-redirect="1"
                                                                aria-haspopup="true">
                                                                <a href="{{route('switchModul')}}?module=SelfadminLite&zbirnaEvidencijaPdv=1"
                                                                   class="m-menu__link ">
                                                                    <i class="m-menu__link-icon fa fa-percent"
                                                                       style="font-size: 16px"></i>
                                                                    <span class="m-menu__link-text">
																{{trans('legacy/Header/eFaktureSubs.Zbirna evidencija PDV')}}
															</span>
                                                                </a>
                                                            </li>

                                                            <li class="m-menu__item " m-menu-link-redirect="1"
                                                                aria-haspopup="true">
                                                                <a href="{{route('switchModul')}}?module=SelfadminLite&pojedinacnaEvidencijaPdv=2"
                                                                   class="m-menu__link ">
                                                                    <i class="m-menu__link-icon fa fa-percent"
                                                                       style="font-size: 16px"></i>
                                                                    <span class="m-menu__link-text">
																{{trans('legacy/Header/eFaktureSubs.Pojedinačna evidencija PDV')}}
															</span>
                                                                </a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                @endif
                                            </li>
                                        @endif

                                        {{-- @if (session('devModules'))  --}}
                                        <li class="m-menu__item m-menu__item--submenu" m-menu-submenu-toggle="hover"
                                            m-menu-link-redirect="1" aria-haspopup="true">
                                            @if ( (checkmodule('MODULE_KADROVIK') && !empty(session('licenseModule')['KADROVIK_DATES']['endDate'])) || (checkmodule('MODULE_KADROVIK_LITE') && !empty(session('licenseModule')['KADROVIK_LITE_DATES']['endDate'])))

                                                    <?php
                                                    $kadrovikModule_type = checkmodule('MODULE_KADROVIK') ? 'Kadrovik' : 'Kadrovik-lite';
                                                    ?>
                                                <a href="{{route('switchModul')}}?module={{$kadrovikModule_type}}"
                                                   class="m-menu__link ">

                                                    <i class="m-menu__link-icon flaticon-tool"></i>
                                                    <span class="m-menu__link-title">
													<span class="m-menu__link-wrap">
														<span class="m-menu__link-text">
															{{-- Kadrovik --}}
                                                            {{ checkmodule('MODULE_KADROVIK') ? (trans('legacy/Header/showModuleName.Kadrovik').' (beta)') : trans('legacy/Header/showModuleName.Kadrovik (lite)')}}
													</span>
													@if ((checkmodule('MODULE_KADROVIK') || checkmodule('MODULE_KADROVIK_LITE')) && empty(session("gost")))
                                                            <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                        @endif
												</span>
												</span>
                                                </a>
                                            @endif
                                            @if ( (checkmodule('MODULE_KADROVIK') && !empty(session('licenseModule')['KADROVIK_DATES']['endDate']) || checkmodule('MODULE_KADROVIK_LITE') && !empty(session('licenseModule')['KADROVIK_LITE_DATES']['endDate']) ) && empty(session("gost")))
                                                <div
                                                    class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                    <span class="m-menu__arrow"></span>
                                                    <ul class="m-menu__subnav">
                                                        {{-- Dnevna evidencija rada --}}
                                                        {{-- @if (session('userRole') == 'SADMIN' || session('hrMozeDaMenjaKadrovik') == 1 || session('supManagePresence') == 1) --}}
                                                        <li class="m-menu__item m-menu__item--submenu"
                                                            m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                                                <i class="m-menu__link-icon flaticon-users"></i>
                                                                <span class="m-menu__link-text">
																	{{ trans('legacy/Sidebar/all.Dnevna evidencija rada') }}
																</span>
                                                                <i class="m-menu__hor-arrow la la-angle-right"></i>
                                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                            </a>
                                                            <div
                                                                class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                                <span class="m-menu__arrow "></span>
                                                                <ul class="m-menu__subnav">
                                                                    @if(session('userRole') == 'SADMIN' || session('hrMozeDaMenjaKadrovik') == 1 || session('supManagePresence') == 1)
                                                                        <li class="m-menu__item "
                                                                            m-menu-link-redirect="1"
                                                                            aria-haspopup="true">
                                                                            <a href="{{route('switchModul')}}?module={{$kadrovikModule_type}}&nereseniIzostanci=1"
                                                                               class="m-menu__link ">
                                                                                <i class="m-menu__link-icon flaticon-users"></i>
                                                                                <span class="m-menu__link-text">
																					{{ trans('legacy/Sidebar/all.Nerešeni izostanci') }}
																				</span>
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                    <li class="m-menu__item " m-menu-link-redirect="1"
                                                                        aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module={{$kadrovikModule_type}}&evidencijaPrisutnosti=1"
                                                                           class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-users"></i>
                                                                            <span class="m-menu__link-text">
																				{{ trans('legacy/Sidebar/all.Evidencija prisutnosti') }}
																			</span>
                                                                        </a>
                                                                    </li>
                                                                    @if( checkmodule('MODULE_KADROVIK') && (session('userRole') == 'SADMIN' || session('hrMozeDaMenjaKadrovik') == 1 || session('supManagePresence') == 1))
                                                                        <li class="m-menu__item "
                                                                            m-menu-link-redirect="1"
                                                                            aria-haspopup="true">
                                                                            <a href="{{route('switchModul')}}?module=Kadrovik&prekovremeniOstvareniSati=1"
                                                                               class="m-menu__link ">
                                                                                <i class="m-menu__link-icon flaticon-users"></i>
                                                                                <span class="m-menu__link-text">
																					{{ trans('legacy/Sidebar/all.Prekovremeni/višak ostvarenih sati') }}
																				</span>
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                    @if(session('userRole') == 'SADMIN' || session('hrMozeDaMenjaKadrovik') == 1 || session('supManagePresence') == 1)
                                                                        <li class="m-menu__item "
                                                                            m-menu-link-redirect="1"
                                                                            aria-haspopup="true">
                                                                            <a href="{{route('switchModul')}}?module=Kadrovik&neplaniraniRad=1"
                                                                               class="m-menu__link ">
                                                                                <i class="m-menu__link-icon flaticon-users"></i>
                                                                                <span class="m-menu__link-text">
																					{{ trans('legacy/Sidebar/all.neplaniraniRad') }}
																				</span>
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                    @if( checkmodule('MODULE_KADROVIK') && (session('userRole') == 'SADMIN' || session('hrMozeDaMenjaKadrovik') == 1 || session('supManagePresence') == 1))
                                                                        <li class="m-menu__item"
                                                                            m-menu-link-redirect="1"
                                                                            aria-haspopup="true">
                                                                            <a href="{{route('switchModul')}}?module=Kadrovik&administracijaRasporedaUProslosti=1"
                                                                               class="m-menu__link ">
                                                                                <i class="m-menu__link-icon flaticon-users"></i>
                                                                                <span class="m-menu__link-text">
																					{{ trans('legacy/Sidebar/all.administracijaRasporedaUProslosti') }}
																				</span>
                                                                            </a>
                                                                        </li>

                                                                        {{-- Administracija prijava unapred --}}
                                                                        <li class="m-menu__item"
                                                                            m-menu-link-redirect="1"
                                                                            aria-haspopup="true">
                                                                            <a href="{{route('switchModul')}}?module=Kadrovik&administracijaPrijavaUnapred=1"
                                                                               class="m-menu__link ">
                                                                                <i class="m-menu__link-icon flaticon-users"></i>
                                                                                <span class="m-menu__link-text">
																					Administracija prijava unapred
																				</span>
                                                                            </a>
                                                                        </li>
                                                                        {{-- KRAJ: Administracija prijava unapred --}}
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        {{-- @endif --}}
                                                        {{-- KRAJ Dnevna evidencija rada --}}

                                                        {{-- Izvestaji --}}
                                                        @if((session('userRole') == 'SADMIN' || session('hrMozeDaMenjaKadrovik') == 1 || session('supManagePresence') == 1))
                                                            <li class="m-menu__item m-menu__item--submenu"
                                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                                aria-haspopup="true">
                                                                <a href="javascript:;"
                                                                   class="m-menu__link m-menu__toggle">
                                                                    <i class="m-menu__link-icon flaticon-file"></i>
                                                                    <span class="m-menu__link-text">
																{{ trans('legacy/Sidebar/all.Izvestaji') }}
															</span>
                                                                    <i class="m-menu__hor-arrow la la-angle-right"></i>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </a>
                                                                <div
                                                                    class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                                    <span class="m-menu__arrow "></span>
                                                                    <ul class="m-menu__subnav">

                                                                        @if (session('userRole') == 'SADMIN' || session('hrMozeDaMenjaKadrovik') == 1 || session('supManageORV') == 1)
                                                                            @if(checkmodule('MODULE_KADROVIK'))
                                                                                {{-- Izvestaji odsustva --}}
                                                                                <li class="m-menu__item "
                                                                                    m-menu-link-redirect="1"
                                                                                    aria-haspopup="true">
                                                                                    <a href="{{route('switchModul')}}?module={{$kadrovikModule_type}}&izvestajiOdsustva=1"
                                                                                       class="m-menu__link ">
                                                                                        <i class="m-menu__link-icon flaticon-file"></i>
                                                                                        <span class="m-menu__link-text">
																				{{ trans('legacy/Sidebar/all.Odsustva') }}
																			</span>
                                                                                    </a>
                                                                                </li>
                                                                                {{-- KRAJ: Izvestaji odsustva --}}
                                                                            @endif

                                                                            {{-- Izvestaj javni prevoz --}}
                                                                            <li class="m-menu__item "
                                                                                m-menu-link-redirect="1"
                                                                                aria-haspopup="true">
                                                                                <a href="{{route('switchModul')}}?module={{$kadrovikModule_type}}&izvestajiJavniPrevoz=1"
                                                                                   class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-file"></i>
                                                                                    <span class="m-menu__link-text">
																			{{ trans('legacy/Sidebar/all.javniPrevoz') }}
																		</span>
                                                                                </a>
                                                                            </li>
                                                                            {{-- KRAJ: Izvestaj javni prevoz --}}

                                                                            {{-- Izvestaj kašnjenja --}}
                                                                            <li class="m-menu__item "
                                                                                m-menu-link-redirect="1"
                                                                                aria-haspopup="true">
                                                                                <a href="{{route('switchModul')}}?module={{$kadrovikModule_type}}&izvestajiKasnjenja=1"
                                                                                   class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-file"></i>
                                                                                    <span class="m-menu__link-text">
																			{{ trans('legacy/Sidebar/all.kasnjenja') }}
																		</span>
                                                                                </a>
                                                                            </li>
                                                                            {{-- KRAJ: Izvestaj kašnjenja --}}
                                                                        @endif
                                                                        @if (session('userRole') == 'SADMIN' || session('hrMozeDaMenjaKadrovik') == 1)
                                                                            {{-- Izvestaj zaposleni --}}
                                                                            <li class="m-menu__item "
                                                                                m-menu-link-redirect="1"
                                                                                aria-haspopup="true">
                                                                                <a href="{{route('switchModul')}}?module={{$kadrovikModule_type}}&izvestajiZaposleniAngazovani=1"
                                                                                   class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-file"></i>
                                                                                    <span class="m-menu__link-text">
																				{{ trans('legacy/Sidebar/all.zaposleniAngazovani') }}
																			</span>
                                                                                </a>
                                                                            </li>
                                                                            {{-- KRAJ: Izvestaj zaposleni --}}
                                                                        @endif
                                                                        @if (session('userRole') == 'SADMIN' || session('hrMozeDaMenjaKadrovik') == 1)
                                                                            {{-- Izvestaj zaposleni --}}
                                                                            <li class="m-menu__item "
                                                                                m-menu-link-redirect="1"
                                                                                aria-haspopup="true">
                                                                                <a href="{{route('switchModul')}}?module={{$kadrovikModule_type}}&pausesReport=1"
                                                                                   class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-file"></i>
                                                                                    <span class="m-menu__link-text">
																				{{ trans('legacy/Sidebar/all.pauze') }}
																			</span>
                                                                                </a>
                                                                            </li>
                                                                            {{-- KRAJ: Izvestaj zaposleni --}}
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        @endif

                                                        {{-- KRAJ Izvestaji --}}

                                                        <!-- orv -->
                                                        <li class="m-menu__item m-menu__item--submenu"
                                                            m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                                                <i class="m-menu__link-icon fa fa-calendar-o"></i>
                                                                <span class="m-menu__link-text">
																{{ trans('legacy/Sidebar/all.Organizacija radnog vremena') }}
															</span>
                                                                <i class="m-menu__hor-arrow la la-angle-right"></i>
                                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                            </a>
                                                            <div
                                                                class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                                <span class="m-menu__arrow "></span>
                                                                <ul class="m-menu__subnav">
                                                                    @if (session('userRole') == 'SADMIN' || session('hrMozeDaMenjaKadrovik') == 1 || session('supManageORV') == 1)
                                                                        <li class="m-menu__item "
                                                                            m-menu-link-redirect="1"
                                                                            aria-haspopup="true">
                                                                            <a href="{{route('switchModul')}}?module={{$kadrovikModule_type}}&orv=1"
                                                                               class="m-menu__link ">
                                                                                <i class="m-menu__link-icon flaticon-event-calendar-symbol"></i>
                                                                                <span class="m-menu__link-text">
																			{{ trans('legacy/Sidebar/all.Redovno radno vreme') }}
																		</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="m-menu__item "
                                                                            m-menu-link-redirect="1"
                                                                            aria-haspopup="true">
                                                                            <a href="{{route('switchModul')}}?module={{$kadrovikModule_type}}&orvDnevna=1"
                                                                               class="m-menu__link ">
                                                                                <i class="m-menu__link-icon flaticon-calendar-3"></i>
                                                                                <span class="m-menu__link-text">
																			{{ trans('legacy/Sidebar/all.Vanredno radno vreme') }}
																		</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="m-menu__item "
                                                                            m-menu-link-redirect="1"
                                                                            aria-haspopup="true">
                                                                            <a href="{{route('switchModul')}}?module={{$kadrovikModule_type}}&prekovremenoRV=1"
                                                                               class="m-menu__link ">
                                                                                <i class="m-menu__link-icon fa fa-calendar-check-o"></i>
                                                                                <span class="m-menu__link-text">
																			{{ trans('legacy/Sidebar/all.Prekovremeno radno vreme') }}
																		</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="m-menu__item "
                                                                            m-menu-link-redirect="1"
                                                                            aria-haspopup="true">
                                                                            <a href="{{route('switchModul')}}?module={{$kadrovikModule_type}}&preraspodelaRadnogVremena=1"
                                                                               class="m-menu__link ">
                                                                                <i class="m-menu__link-icon fa fa-calendar-check-o"></i>
                                                                                <span class="m-menu__link-text">
																			{{ trans('legacy/Sidebar/all.Preraspodela radnog vremena') }}
																		</span>
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                    <li class="m-menu__item " m-menu-link-redirect="1"
                                                                        aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module={{$kadrovikModule_type}}&trenutnoRV=1"
                                                                           class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-calendar-3"></i>
                                                                            <span class="m-menu__link-text">
																			{{ trans('legacy/Sidebar/all.Trenutno radno vreme') }}
																		</span>
                                                                        </a>
                                                                    </li>
                                                                    {{-- KAD - 935 planirani rad prebacen u Trenutno radno vreme --}}
                                                                    {{-- <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="{{route('switchModul')}}?module={{$kadrovikModule_type}}&planiraniRad=1" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-calendar-3"></i>
                                                                            <span class="m-menu__link-text">
                                                                                {{ trans('legacy/Sidebar/all.Planirani rad') }}
                                                                            </span>
                                                                        </a>
                                                                    </li> --}}
                                                                    @if (session('userRole') == 'SADMIN' || session('hrMozeDaMenjaKadrovik') == 1 || session('supManageORV') == 1)
                                                                        <li class="m-menu__item "
                                                                            m-menu-link-redirect="1"
                                                                            aria-haspopup="true">
                                                                            <a href="{{route('switchModul')}}?module={{$kadrovikModule_type}}&latenessEarlyDeparture=1"
                                                                               class="m-menu__link ">
                                                                                <i class="m-menu__link-icon flaticon-clock"></i>
                                                                                <span class="m-menu__link-text">
																				{{ trans('legacy/Sidebar/all.Kašnjenje/Ranije odjave') }}
																			</span>
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </li>

                                                        @if (checkmodule('MODULE_KADROVIK'))
                                                            {{-- Odsustva --}}
                                                            <li class="m-menu__item m-menu__item--submenu"
                                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                                aria-haspopup="true">
                                                                <a href="javascript:;"
                                                                   class="m-menu__link m-menu__toggle">
                                                                    <i class="m-menu__link-icon flaticon-calendar-3"></i>
                                                                    <span class="m-menu__link-text">
																{{ trans('legacy/Sidebar/all.Odsustva') }}
															</span>
                                                                    <i class="m-menu__hor-arrow la la-angle-right"></i>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </a>
                                                                <div
                                                                    class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                                    <span class="m-menu__arrow "></span>
                                                                    <ul class="m-menu__subnav">
                                                                        <li class="m-menu__item "
                                                                            m-menu-link-redirect="1"
                                                                            aria-haspopup="true">
                                                                            <a href="{{route('switchModul')}}?module=Kadrovik&zahtevi=1"
                                                                               class="m-menu__link ">
                                                                                <i class="m-menu__link-icon flaticon-calendar-3"></i>
                                                                                <span class="m-menu__link-text">
																			{{ trans('legacy/Sidebar/all.Zahtevi') }}
																		</span>
                                                                            </a>
                                                                        </li>
                                                                        {{-- @if (session('userRole') == 'SADMIN' || session('hrMozeDaMenjaKadrovik') == 1 || isSupervisor()) --}}
                                                                        <li class="m-menu__item "
                                                                            m-menu-link-redirect="1"
                                                                            aria-haspopup="true">
                                                                            <a href="{{route('switchModul')}}?module=Kadrovik&resenja=1"
                                                                               class="m-menu__link ">
                                                                                <i class="m-menu__link-icon flaticon-calendar-3"></i>
                                                                                <span class="m-menu__link-text">
																				{{ trans('legacy/Sidebar/all.Rešenja') }}
																			</span>
                                                                            </a>
                                                                        </li>
                                                                        {{-- @endif --}}
                                                                        @if (session('userRole') == 'SADMIN' || session('hrMozeDaMenjaKadrovik') == 1 || isSupervisor())
                                                                            <li class="m-menu__item "
                                                                                m-menu-link-redirect="1"
                                                                                aria-haspopup="true">
                                                                                <a href="{{route('switchModul')}}?module=Kadrovik&odsustvaPregled=1"
                                                                                   class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-calendar-3"></i>
                                                                                    <span class="m-menu__link-text">
																			{{ trans('legacy/Sidebar/all.Raspoloživost') }}
																		</span>
                                                                                </a>
                                                                            </li>
                                                                        @endif
                                                                        @if (session('userRole') == 'SADMIN' || session('hrMozeDaMenjaKadrovik') == 1)
                                                                            <li class="m-menu__item "
                                                                                m-menu-link-redirect="1"
                                                                                aria-haspopup="true">
                                                                                <a href="{{route('switchModul')}}?module=Kadrovik&odsustvaIzuzeci=1"
                                                                                   class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-calendar-3"></i>
                                                                                    <span class="m-menu__link-text">
																			{{ trans('legacy/Sidebar/all.Izuzeci') }}
																		</span>
                                                                                </a>
                                                                            </li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        @endif
                                                        {{-- KRAJ Odsustva --}}
                                                        @if( !checkmodule('MODULE_KADROVIK'))
                                                            <li class="m-menu__item" m-menu-link-redirect="1"
                                                                aria-haspopup="true">
                                                                <a href="{{ route('modulesInfo', ['moduleId' => 'kadrovik']) }}"
                                                                   class="m-menu__link">
                                                                    <i class="m-menu__link-icon flaticon-tool"
                                                                       style="color: rgb(30, 120, 65) !important;"></i>
                                                                    <span class="m-menu__link-text">
																	<b style="color: rgb(30, 120, 65) !important;">{{ trans('legacy/Header/showModuleName.Kadrovik') }}</b>
																</span>
                                                                </a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                                @endif
                                                </a>
                                        </li>

                                        <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover"
                                            m-menu-link-redirect="1" aria-haspopup="true">
                                            @if(checkmodule('MODULE_FISKALNI'))
                                                <a href="{{checkmodule('MODULE_FISKALNI') && !empty(session('licenseModule')['FISKALNI_DATES']['endDate'])  ? route('switchModul') . "?module=Fiskalni&izdatiFiskalni=1" : "#"}}"
                                                   class="m-menu__link">
                                                    <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														e-Fiskalna kasa
													</span>
													<i class="m-menu__hor-arrow la la-angle-down"></i>
													<i class="m-menu__ver-arrow la la-angle-right"></i>
												</span>
											</span>
                                                </a>

                                                @if (checkmodule('MODULE_FISKALNI') && !empty(session('licenseModule')['FISKALNI_DATES']['endDate']))
                                                    <div
                                                        class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                        <span class="m-menu__arrow "></span>
                                                        <ul class="m-menu__subnav">
                                                            <li class="m-menu__item " m-menu-link-redirect="1"
                                                                aria-haspopup="true">
                                                                <a href="{{route('switchModul')}}?module=Fiskalni&izdatiFiskalni=1"
                                                                   class="m-menu__link ">
                                                                    <i class="m-menu__link-icon flaticon-folder-2"></i>
                                                                    <span class="m-menu__link-text">
															Izdati fiskalni
														</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item " m-menu-link-redirect="1"
                                                                aria-haspopup="true">
                                                                <a href="{{route('switchModul')}}?module=Fiskalni&prometProdaja=1"
                                                                   class="m-menu__link ">
                                                                    <i class="m-menu__link-icon flaticon-folder-3""></i>
                                                                    <span class=" m-menu__link-text">
															Fiskalna kasa
														</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            @endif
                                        </li>

                                        <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover"
                                            m-menu-link-redirect="1" aria-haspopup="true">
                                            @if (checkmodule('MODULE_POSTMAN')
                                            && (!empty(session('licenseModule')['S_DATES']['endDate']) || !empty(session('licenseModule')['POSTMAN_DATES']['endDate'])) && empty(session("gost")))
                                                <a href="{{route('switchModul')}}?module=Postman&sent=1"
                                                   class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-mail"></i>
                                                    <span class="m-menu__link-title">
													<span class="m-menu__link-wrap">
														<span class="m-menu__link-text">
															{{trans('legacy/Header/showModuleName.e-Poštar')}}
														</span>
														<i class="m-menu__hor-arrow la la-angle-down"></i>
														<i class="m-menu__ver-arrow la la-angle-right"></i>
													</span>
												</span>
                                                </a>
                                            @endif
                                            @if (checkmodule('MODULE_POSTMAN')
                                            && (!empty(session('licenseModule')['S_DATES']['endDate']) || !empty(session('licenseModule')['POSTMAN_DATES']['endDate'])) && empty(session("gost")))
                                                <div
                                                    class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                    <span class="m-menu__arrow"></span>
                                                    <ul class="m-menu__subnav">
                                                        <li class="m-menu__item " m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            <a href="{{route('switchModul')}}?module=Postman&sent=1"
                                                               class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-folder-3""></i>
                                                                <span class=" m-menu__link-text">
																{{trans('legacy/Header/showModuleName.postmanHeaderSub.Poslati')}}
																</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item " m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            <a href="{{route('switchModul')}}?module=Postman&receive=1"
                                                               class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-folder-2"></i>
                                                                <span class="m-menu__link-text">
																{{trans('legacy/Header/showModuleName.postmanHeaderSub.Primljeni')}}
															</span>
                                                            </a>
                                                        </li>
                                                        <li title="{{trans('legacy/Sidebar/all.Dokumenti spremni za slanje')}}"
                                                            class="m-menu__item" aria-haspopup="true">
                                                            <a href="{{route('switchModul')}}?module=Postman&forSent=1"
                                                               class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-folder-3"></i>
                                                                <span class="m-menu__link-text"
                                                                      style="font-size: 14px;">
																{{trans('legacy/Sidebar/all.Dokumenti spremni za slanje')}}
															</span>
                                                            </a>
                                                        </li>
                                                        <li title="{{trans('legacy/Sidebar/all.Dokumenti za odobrenje')}}"
                                                            class="m-menu__item" aria-haspopup="true">
                                                            <a href="{{route('switchModul')}}?module=Postman&approving=1"
                                                               class="m-menu__link ">
                                                                <i class="m-menu__link-icon la la-clipboard"></i>
                                                                <span class="m-menu__link-text sidebar-text">
																{{trans('legacy/Sidebar/all.Dokumenti za odobrenje')}}
															</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </li>

                                        <!-- resorsi -->
                                        {{-- @if (session('devModules'))  --}}
                                        <li class="m-menu__item m-menu__item--submenu" m-menu-submenu-toggle="hover"
                                            m-menu-link-redirect="1" aria-haspopup="true">
                                            @if (checkmodule('MODULE_RESORSI') && !empty(session('licenseModule')['RESORSI_DATES']['endDate']))
                                                <a href="{{route('switchModul')}}?module=Resorsi&listaReservarionResursi=1"
                                                   class="m-menu__link">
                                                    <i class="m-menu__link-icon fa fa-bar-chart" aria-hidden="true"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														Resursi	(beta)
													</span>
												</span>
											</span>
                                                </a>
                                                <div
                                                    class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                    <span class="m-menu__arrow "></span>
                                                    <ul class="m-menu__subnav">
                                                        <li class="m-menu__item m-menu__item--submenu"
                                                            m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            <a href="{{route('switchModul')}}?module=Resorsi&resorsi=1"
                                                               class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-folder-3"></i>
                                                                <span class=" m-menu__link-text">
															{{-- Poslate fakture (eFaktureSubs) --}}
															Moji resursi
														</span>
                                                            </a>
                                                        </li>

                                                        <li class="m-menu__item m-menu__item--submenu"
                                                            m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            <a href="{{route('switchModul')}}?module=Resorsi&listaReservarionResursi=1"
                                                               class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-folder-3"></i>
                                                                <span class=" m-menu__link-text">
															{{-- Poslate fakture (eFaktureSubs) --}}
															Resursi - rezervacije
														</span>
                                                            </a>
                                                        </li>

                                                        <li class="m-menu__item m-menu__item--submenu"
                                                            m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            <a href="{{route('switchModul')}}?module=Resorsi&listaResursaPodesavanje=1"
                                                               class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-folder-3"></i>
                                                                <span class=" m-menu__link-text">
															{{-- Poslate fakture (eFaktureSubs) --}}
															Resursi - podešavanje
														</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </li>
                                        {{-- @endif --}}

                                        <!-- troskovnik -->
                                        {{-- @if (session('devModules'))  --}}
                                        <li class="m-menu__item m-menu__item--submenu" m-menu-submenu-toggle="hover"
                                            m-menu-link-redirect="1" aria-haspopup="true">
                                            @if (checkmodule('MODULE_TROSKOVNIK') && (!empty(session('licenseModule')['S_DATES']['endDate']) || !empty(session('licenseModule')['TROSKOVNIK_DATES']['endDate'])) && empty(session("gost")))
                                                <a href="{{route('switchModul')}}?module=Troskovnik&troskovnici=1" class="m-menu__link ">
                                                {{-- <a href="/redirectModule/{{App\Legacy\Module\AppModuleHasher::getRedirectHash(['route' => '/', 'module_url' => config('legacy.troskovnik_url')])}}" --}}
                                                    <i class="m-menu__link-icon fa fa-bar-chart" aria-hidden="true"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														Troškovnik	(beta)
													</span>
												</span>
											</span>
                                                </a>
                                                {{-- Zakomentarisano za sada (TASK DEL-10481) --}}
                                                {{-- <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                    <span class="m-menu__arrow "></span>
                                                    <ul class="m-menu__subnav">
                                                        <li class="m-menu__item m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a href="{{route('switchModul')}}?module=Troskovnik&troskovnici=1" class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-folder-3"></i>
                                                                <span class=" m-menu__link-text">
                                                                    Troškovnici
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div> --}}
                                            @endif
                                        </li>
                                        {{-- @endif --}}

                                        @if (session('devModules') || (checkmodule('MODULE_DOGADJAJI') && (!empty(session('licenseModule')['S_DATES']['endDate']) || !empty(session('licenseModule')['DOGADJAJI_DATES']['endDate'])) && empty(session("gost"))))
                                            <!-- link do  dogadjaja ddl-->
                                            <li class="m-menu__item  m-menu__item--submenu"
                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                aria-haspopup="true">
                                                <a href="/redirectModule/{{App\Legacy\Module\AppModuleHasher::getRedirectHash(['route' => '/dogadjaji', 'module_url' => config('legacy.dogadjaji_url')])}}"
                                                   class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-route"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
															Događaji (beta)
													</span>
														<i class="m-menu__hor-arrow la la-angle-down"></i>
														<i class="m-menu__ver-arrow la la-angle-right"></i>
													</span>
												</span>
                                                </a>
                                                <div
                                                    class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                    <span class="m-menu__arrow"></span>
                                                    <ul class="m-menu__subnav">

                                                        <li class="m-menu__item m-menu__item--submenu"
                                                            m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            <a href="/redirectModule/{{App\Legacy\Module\AppModuleHasher::getRedirectHash(['route' => '/prijave', 'module_url' => config('legacy.dogadjaji_url')])}}"
                                                               class="m-menu__link">
                                                                <i class="m-menu__link-icon fa fa-bar-chart"></i>
                                                                <span class="m-menu__link-text">
																Poslednje prijave
															</span>
                                                            </a>
                                                        </li>

                                                        <li class="m-menu__item m-menu__item--submenu"
                                                            m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            <a href="/redirectModule/{{App\Legacy\Module\AppModuleHasher::getRedirectHash(['route' => '/dogadjaji', 'module_url' => config('legacy.dogadjaji_url')])}}"
                                                               class="m-menu__link">
                                                                <i class="m-menu__link-icon fa fa-bar-chart"></i>
                                                                <span class="m-menu__link-text">
																Događaji
															</span>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>

                                            </li>
                                        @endif


                                        {{--									@if (session('devModules') || (checkmodule('MODULE_PROCEDURE') && (!empty(session('licenseModule')['S_DATES']['endDate']) || !empty(session('licenseModule')['PROCEDURE_DATES']['endDate'])) && empty(session("gost"))))--}}
                                        {{--										<!-- link do  dogadjaja ddl-->--}}
                                        {{--										<li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">--}}
                                        {{--											<a href="/redirectModule/{{App\Legacy\Module\AppModuleHasher::getRedirectHash(['route' => '/procedures/active', 'module_url' => config('legacy.procedure_url')])}}" class="m-menu__link ">--}}
                                        {{--												<i class="m-menu__link-icon flaticon-route"></i>--}}
                                        {{--												<span class="m-menu__link-title">--}}
                                        {{--												<span class="m-menu__link-wrap">--}}
                                        {{--													<span class="m-menu__link-text">--}}
                                        {{--															Procedure odvojeni repooooooooo--}}
                                        {{--													</span>--}}
                                        {{--														<i class="m-menu__hor-arrow la la-angle-down"></i>--}}
                                        {{--														<i class="m-menu__ver-arrow la la-angle-right"></i>--}}
                                        {{--													</span>--}}
                                        {{--												</span>--}}
                                        {{--											</a>--}}
                                        {{--											<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">--}}
                                        {{--												<span class="m-menu__arrow"></span>--}}
                                        {{--												<ul class="m-menu__subnav">--}}

                                        {{--													<li class="m-menu__item m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">--}}
                                        {{--														<a href="/redirectModule/{{App\Legacy\Module\AppModuleHasher::getRedirectHash(['route' => '/prijave', 'module_url' => config('legacy.dogadjaji_url')])}}" class="m-menu__link">--}}
                                        {{--															<i class="m-menu__link-icon fa fa-bar-chart" ></i>--}}
                                        {{--															<span class="m-menu__link-text">--}}
                                        {{--																Poslednje prijave--}}
                                        {{--															</span>--}}
                                        {{--														</a>--}}
                                        {{--													</li>--}}

                                        {{--													<li class="m-menu__item m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">--}}
                                        {{--														<a href="/redirectModule/{{App\Legacy\Module\AppModuleHasher::getRedirectHash(['route' => '/dogadjaji', 'module_url' => config('legacy.dogadjaji_url')])}}" class="m-menu__link">--}}
                                        {{--															<i class="m-menu__link-icon fa fa-bar-chart" ></i>--}}
                                        {{--															<span class="m-menu__link-text">--}}
                                        {{--																Događaji--}}
                                        {{--															</span>--}}
                                        {{--														</a>--}}
                                        {{--													</li>--}}

                                        {{--												</ul>--}}
                                        {{--											</div>--}}

                                        {{--										</li>--}}
                                        {{--									@endif--}}


                                        @if (session('devModules'))
                                            <!-- link do  dogadjaja ddl-->
                                            <li class="m-menu__item  m-menu__item--submenu"
                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                aria-haspopup="true">
                                                @if (checkmodule('MODULE_ELMS') && (!empty(session('licenseModule')['S_DATES']['endDate']) || !empty(session('licenseModule')['ELMS_DATES']['endDate'])) && empty(session("gost")))
                                                    <a href="/redirectModule/{{App\Legacy\Module\AppModuleHasher::getRedirectHash(['route' => '/', 'module_url' => config('legacy.elms_url')])}}"
                                                       class="m-menu__link ">
                                                        <i class="m-menu__link-icon flaticon-route"></i>
                                                        <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
															MailJohny (beta)
													</span>
														<i class="m-menu__hor-arrow la la-angle-down"></i>
														<i class="m-menu__ver-arrow la la-angle-right"></i>

													</span>
												</span>
                                                    </a>
                                                @endif
                                                @if (checkmodule('MODULE_ELMS') && !empty(session('licenseModule')['ELMS_DATES']['endDate']) && empty(session("gost")))
                                                    <div
                                                        class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                        <span class="m-menu__arrow"></span>
                                                        <ul class="m-menu__subnav">

                                                            <li class="m-menu__item m-menu__item--submenu"
                                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                                aria-haspopup="true">
                                                                <a href="/redirectModule/{{App\Legacy\Module\AppModuleHasher::getRedirectHash(['route' => '/administracija-grupa', 'module_url' => config('legacy.elms_url')])}}"
                                                                   class="m-menu__link">
                                                                    <i class="m-menu__link-icon fa fa-bar-chart"></i>
                                                                    <span class="m-menu__link-text">
																Administracija grupa
															</span>
                                                                </a>
                                                            </li>

                                                            <li class="m-menu__item m-menu__item--submenu"
                                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                                aria-haspopup="true">
                                                                <a href="/redirectModule/{{App\Legacy\Module\AppModuleHasher::getRedirectHash(['route' => '/administracija-radnih-naloga', 'module_url' => config('legacy.elms_url')])}}"
                                                                   class="m-menu__link">
                                                                    <i class="m-menu__link-icon fa fa-bar-chart"></i>
                                                                    <span class="m-menu__link-text">
																Radni nalozi
															</span>
                                                                </a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                @endif


                                            </li>
                                        @endif

                                        <li class="m-menu__item m-menu__item--submenu" m-menu-submenu-toggle="hover"
                                            m-menu-link-redirect="1" aria-haspopup="true">
                                            <a href="javascript:void(0)" class="m-menu__link ">
                                                <i class="m-menu__link-icon flaticon-diagram"></i>
                                                <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														{{trans('legacy/Header/showModuleName.Kalkulatori')}}
													</span>
													<i class="m-menu__hor-arrow la la-angle-down"></i>
													<i class="m-menu__ver-arrow la la-angle-right"></i>
												</span>
											</span>
                                            </a>
                                            <div
                                                class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                <span class="m-menu__arrow"></span>
                                                <ul class="m-menu__subnav">
                                                    <!-- link do kamatnog kalkulatora -->
                                                    <li class="m-menu__item " m-menu-link-redirect="1"
                                                        aria-haspopup="true">
                                                        <a href="{{config('legacy.kamate_login_srv')}}?username={{session('username')}}&u={{session('firstname')}}&l={{session('lastname')}}&t={{md5(session('username') . date('Y-m-d'))}}"
                                                           class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-diagram"></i>
                                                            <span class="m-menu__link-text">
															{{trans('legacy/Header/showModuleName.Kamatni kalkulator')}}
														</span>
                                                        </a>
                                                    </li>
                                                    <!-- link do kalkulatora zarada -->
                                                    <li class="m-menu__item " m-menu-link-redirect="1"
                                                        aria-haspopup="true">
                                                        <a href="{{config('legacy.zarade_login_srv')}}?username={{session('username')}}&u={{session('firstname')}}&l={{session('lastname')}}&t={{md5(session('username') . date('Y-m-d'))}}"
                                                           class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-diagram"></i>
                                                            <span class="m-menu__link-text">
															{{trans('legacy/Header/showModuleName.Kalkulator zarada')}}
														</span>
                                                        </a>
                                                    </li>
                                                    <!-- link do kalkulatora sudskih taksi -->
                                                    <li class="m-menu__item " m-menu-link-redirect="1"
                                                        aria-haspopup="true">
                                                        <a href="{{config('legacy.sudske_takse_srv')}}?username={{session('username')}}&u={{session('firstname')}}&l={{session('lastname')}}&t={{md5(session('username') . date('Y-m-d'))}}"
                                                           class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-diagram"></i>
                                                            <span class="m-menu__link-text">
															{{trans('legacy/Header/showModuleName.Kalkulator sudskih praksi')}}
														</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        @if (checkmodule('MODULE_TICKETING') && (!empty(session('licenseModule')['TICKETING_DATES']['endDate']) || !empty(session('licenseModule')['TICKETING_DATES']['endDate'])) && empty(session("gost")))
                                            <li class="m-menu__item  m-menu__item--submenu"
                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                aria-haspopup="true">
                                                <a href="/redirectModule/{{App\Legacy\Module\AppModuleHasher::getRedirectHash(['route' => '/', 'module_url' => config('legacy.ticketing_url')])}}"
                                                    class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-chat-1"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
															e-Tiketi (beta)

													</span>
														<i class="m-menu__hor-arrow la la-angle-down"></i>
														<i class="m-menu__ver-arrow la la-angle-right"></i>
												</span>
											</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if (checkmodule('MODULE_OBRASCI') && (!empty(session('licenseModule')['OBRASCI_DATES']['endDate']) || !empty(session('licenseModule')['OBRASCI_DATES']['endDate'])) && empty(session("gost")))
                                            <li class="m-menu__item  m-menu__item--submenu"
                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                aria-haspopup="true">
                                                <a href="/redirectModule/{{App\Legacy\Module\AppModuleHasher::getRedirectHash(['route' => '/', 'module_url' => config('legacy.obrasci_url')])}}"
                                                   class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-chat-1"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
															e-Obrasci (beta)
													</span>
														<i class="m-menu__hor-arrow la la-angle-down"></i>
														<i class="m-menu__ver-arrow la la-angle-right"></i>
												</span>
											</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if (checkmodule('MODULE_OTPREMNICE')
                                            && (!empty(session('licenseModule')['S_DATES']['endDate']) || !empty(session('licenseModule')['OTPREMNICE_DATES']['endDate'])) && empty(session("gost")))

                                            <li class="m-menu__item  m-menu__item--submenu"
                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                aria-haspopup="true">
                                                <a href="/redirectModule/{{App\Legacy\Module\AppModuleHasher::getRedirectHash(['route' => '/', 'module_url' => config('legacy.otpremnice_url')])}}"
                                                   class="m-menu__link ">

                                                    <i class="m-menu__link-icon flaticon-truck"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														{{trans('legacy/Header/showModuleName.e-Otpremnice')}}

													</span>

												</span>
											</span>
                                                </a>
                                            </li>
                                        @endif



                                        {{-- neaktivni moduli. Pravi se novi <li> zbog razlicitog resporeda kada moduli nisu aktivni --}}

                                        @if (!checkmodule('MODULE_KADROVIK') && !checkmodule('MODULE_KADROVIK_LITE'))
                                            <li class="m-menu__item  m-menu__item--submenu"
                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                aria-haspopup="true">
                                                <a href="{{ route('modulesInfo', ['moduleId' => 'kadrovik']) }}"
                                                   target="_blank" class="m-menu__link">
                                                    <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														<span style="color: #bfc1c7 !important; "
                                                              title="{{trans('legacy/Header/disabledModules.Nemate pristup ovom modulu')}}">
															{{trans('legacy/Header/showModuleName.Kadrovik')}}
														</span>
													</span>
												</span>
											</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if (!checkmodule('MODULE_PRINCIPAL'))
                                            <li class="m-menu__item  m-menu__item--submenu"
                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                aria-haspopup="true">
                                                <a href="{{ route('modulesInfo', ['moduleId' => 'principal']) }}"
                                                   class="m-menu__link">
											<span
                                                style="width: 33px; height: 30px; display: table-cell; vertical-align: middle;">
												<img
                                                    src="{{url(asset('legacy/assets/app/media/img/module-logos/principal-logo-400.jpg'))}}"
                                                    style="transform: translateX(-5px); width: 33px; height: 30px; display: table-cell; vertical-align: middle;"
                                                    alt="">
											</span>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														<span style="color: #bfc1c7 !important; "
                                                              title="{{trans('legacy/Header/disabledModules.Nemate pristup ovom modulu')}}">
															{{trans('legacy/Header/showModuleName.Principal')}}
														</span>
													</span>
												</span>
											</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if (!checkmodule('MODULE_DELOVODNIK'))
                                            <li class="m-menu__item  m-menu__item--submenu"
                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                aria-haspopup="true">
                                                <a href="{{ route('modulesInfo', ['moduleId' => 'delovodnik']) }}"
                                                   class="m-menu__link">
                                                    <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														<span style="color: #bfc1c7 !important; "
                                                              title="{{trans('legacy/Header/disabledModules.Nemate pristup ovom modulu')}}">
															{{trans('legacy/Header/showModuleName.e-Delovodnik')}}
														</span>
													</span>
												</span>
											</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if (!checkmodule('MODULE_SELFADMIN'))
                                            <li class="m-menu__item  m-menu__item--submenu"
                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                aria-haspopup="true">
                                                <a href="{{ route('modulesInfo', ['moduleId' => 'fakture']) }}"
                                                   class="m-menu__link">
                                                    <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														<span style="color: #bfc1c7 !important; "
                                                              title="{{trans('legacy/Header/disabledModules.Nemate pristup ovom modulu')}}">
															{{trans('legacy/Header/showModuleName.e-Fakture')}}
														</span>
													</span>
												</span>
											</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if (!checkmodule('MODULE_SELFADMIN_LITE'))
                                            <li class="m-menu__item  m-menu__item--submenu"
                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                aria-haspopup="true">
                                                <a href="{{ route('modulesInfo', ['moduleId' => 'faktureLite']) }}"
                                                   class="m-menu__link">
                                                    <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														<span style="color: #bfc1c7 !important; "
                                                              title="{{trans('legacy/Header/disabledModules.Nemate pristup ovom modulu')}}">
															{{trans('legacy/Header/showModuleName.e-Fakture-lite')}} (beta)
														</span>
													</span>
												</span>
											</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if (!checkmodule('MODULE_FISKALNI'))
                                            <li class="m-menu__item  m-menu__item--submenu"
                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                aria-haspopup="true">
                                                <a href="{{ route('modulesInfo', ['moduleId' => 'fiskalni']) }}"
                                                   class="m-menu__link">
                                                    <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														<span style="color: #bfc1c7 !important; "
                                                              title="{{trans('legacy/Header/disabledModules.Nemate pristup ovom modulu')}}">
															e-Fiskalna kasa
														</span>
													</span>
												</span>
											</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if (!checkmodule('MODULE_POSTMAN'))
                                            <li class="m-menu__item  m-menu__item--submenu"
                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                aria-haspopup="true">
                                                <a href="{{ route('modulesInfo', ['moduleId' => 'postman']) }}"
                                                   class="m-menu__link">
                                                    <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														<span style="color: #bfc1c7 !important; "
                                                              title="{{trans('legacy/Header/disabledModules.Nemate pristup ovom modulu')}}">
															{{trans('legacy/Header/showModuleName.e-Poštar')}}
														</span>
													</span>
												</span>
											</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if (!checkmodule('MODULE_RP'))
                                            <li class="m-menu__item  m-menu__item--submenu"
                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                aria-haspopup="true">
                                                <a href="{{ route('modulesInfo', ['moduleId' => 'rp']) }}"
                                                   class="m-menu__link">
                                                    <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														<span style="color: #bfc1c7 !important; "
                                                              title="{{trans('legacy/Header/disabledModules.Nemate pristup ovom modulu')}}">
															{{trans('legacy/Header/showModuleName.Robno')}} (beta)
														</span>
													</span>
												</span>
											</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if (!checkmodule('MODULE_RESORSI'))
                                            <li class="m-menu__item  m-menu__item--submenu"
                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                aria-haspopup="true">
                                                <a href="{{ route('modulesInfo', ['moduleId' => 'resursi']) }}"
                                                   class="m-menu__link">
                                                    <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														<span style="color: #bfc1c7 !important; "
                                                              title="{{trans('legacy/Header/disabledModules.Nemate pristup ovom modulu')}}">
															Resursi	(beta)
														</span>
													</span>
												</span>
											</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if (!checkmodule('MODULE_TROSKOVNIK'))
                                            <li class="m-menu__item  m-menu__item--submenu"
                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                aria-haspopup="true">
                                                <a href="{{ route('modulesInfo', ['moduleId' => 'troskovnik']) }}"
                                                   class="m-menu__link">
                                                    <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														<span style="color: #bfc1c7 !important; "
                                                              title="{{trans('legacy/Header/disabledModules.Nemate pristup ovom modulu')}}">
															Troškovnik (beta)
														</span>
													</span>
												</span>
											</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if (!checkmodule('MODULE_PROCEDURE'))
                                            <li class="m-menu__item  m-menu__item--submenu"
                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                aria-haspopup="true">
                                                <a href="{{ route('modulesInfo', ['moduleId' => 'procedure']) }}"
                                                   class="m-menu__link">
                                                    <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														<span style="color: #bfc1c7 !important; "
                                                              title="{{trans('legacy/Header/disabledModules.Nemate pristup ovom modulu')}}">
															{{trans('legacy/Header/showModuleName.e-Procedure')}} (beta)
														</span>
													</span>
												</span>
											</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if (session('devModules'))
                                            @if (!checkmodule('MODULE_DOGADJAJI'))
                                                <li class="m-menu__item  m-menu__item--submenu"
                                                    m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                    aria-haspopup="true">
                                                    <a href="{{ route('modulesInfo', ['moduleId' => 'dogadjaji']) }}"
                                                       class="m-menu__link">
                                                        <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                        <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														<span style="color: #bfc1c7 !important; "
                                                              title="{{trans('legacy/Header/disabledModules.Nemate pristup ovom modulu')}}">
															Događaji (beta)
														</span>
													</span>
												</span>
											</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endif

                                        @if (session('devModules'))
                                            @if (!checkmodule('MODULE_ELMS'))
                                                <li class="m-menu__item  m-menu__item--submenu"
                                                    m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                    aria-haspopup="true">
                                                    <a class="m-menu__link" @disabled(true)>
                                                        <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                        <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														<span style="color: #bfc1c7 !important; "
                                                              title="{{trans('legacy/Header/disabledModules.Nemate pristup ovom modulu')}}">
															MailJohny (beta)
														</span>
													</span>
												</span>
											</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endif

                                        @if (!checkmodule('MODULE_TICKETING'))
                                            <li class="m-menu__item  m-menu__item--submenu"
                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                aria-haspopup="true">
                                                <a href="{{ route('modulesInfo', ['moduleId' => 'ticketing']) }}"
                                                   class="m-menu__link">
                                                    <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														<span style="color: #bfc1c7 !important; "
                                                              title="{{trans('legacy/Header/disabledModules.Nemate pristup ovom modulu')}}">
															e-Tiketi (beta)
														</span>
													</span>
												</span>
											</span>
                                                </a>
                                            </li>
                                        @endif


                                        @if (!checkmodule('MODULE_OBRASCI'))
                                            <li class="m-menu__item  m-menu__item--submenu"
                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                aria-haspopup="true">
                                                <a href="{{ route('modulesInfo', ['moduleId' => 'obrasci']) }}"
                                                   class="m-menu__link">
                                                    <i class="m-menu__link-icon flaticon-interface-5"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														<span style="color: #bfc1c7 !important; "
                                                              title="{{trans('legacy/Header/disabledModules.Nemate pristup ovom modulu')}}">
															Obrasci (beta)
														</span>
													</span>
												</span>
											</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if (!checkmodule('MODULE_OTPREMNICE'))
                                            <li class="m-menu__item  m-menu__item--submenu"
                                                m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                aria-haspopup="true">
                                                <a href="{{ route('modulesInfo', ['moduleId' => 'otpremnice']) }}"
                                                   class="m-menu__link">
                                                    <i class="m-menu__link-icon flaticon-truck"></i>
                                                    <span class="m-menu__link-title">
													<span class="m-menu__link-wrap">
														<span class="m-menu__link-text">
															<span style="color: #bfc1c7 !important; "
                                                                  title="{{trans('legacy/Header/disabledModules.Nemate pristup ovom modulu')}}">
																{{trans('legacy/Header/showModuleName.e-Otpremnice')}}
															</span>
														</span>
													</span>
												</span>
                                                </a>
                                            </li>
                                        @endif



                                        <!-- modul robno poslovanje -->
                                        <li class="m-menu__item m-menu__item--submenu" m-menu-submenu-toggle="hover"
                                            m-menu-link-redirect="1" aria-haspopup="true">
                                            @if (checkmodule('MODULE_RP') && checkmodule('MODULE_RP_SETTINGS') && !empty(session('licenseModule')['RP_DATES']['endDate']))
                                                <a href="{{route('switchModul')}}?module=robno&magacini=1"
                                                   class="m-menu__link ">
                                                    @elseif(checkmodule('MODULE_RP') && !checkmodule('MODULE_RP_SETTINGS') && !empty(session('licenseModule')['RP_DATES']['endDate']))
                                                        <!-- ako je cekiran modul robno, a nije izabran subjekt -->
                                                        {{-- <a href="{{(rtrim(config('legacy.kancelarko_url'), '/').'/robno/settings/opsta')}}" class="m-menu__link"></a> --}}
                                                        <a href="{{ config('legacy.kancelarko_url').'/robno/settings/opsta' }}" class="m-menu__link">
                                                            @endif
                                                            @if(checkmodule('MODULE_RP'))
                                                                <i class="m-menu__link-icon flaticon-transport"></i>
                                                                <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														@if (checkmodule('MODULE_RP') && checkmodule('MODULE_RP_SETTINGS') && !empty(session('licenseModule')['RP_DATES']['endDate']) && empty(session("gost")))
                                                            {{trans('legacy/Header/showModuleName.Robno')}} (beta)
                                                        @elseif(checkmodule('MODULE_RP') && !checkmodule('MODULE_RP_SETTINGS') && !empty(session('licenseModule')['RP_DATES']['endDate']))
                                                            <!-- ako je cekiran modul robno, a nije izabran subjekt -->
                                                            {{trans('legacy/Header/showModuleName.Robno')}} (beta)
                                                        @endif
													</span>
													@if (checkmodule('MODULE_RP') && empty(session("gost")))
                                                        <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    @endif
												</span>
											</span>
                                                            @endif
                                                        </a>
                                                        @if (checkmodule('MODULE_RP') && checkmodule('MODULE_RP_SETTINGS') && !empty(session('licenseModule')['RP_DATES']['endDate']) && empty(session("gost")))
                                                            <div
                                                                class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                                <span class="m-menu__arrow"></span>
                                                                <ul class="m-menu__subnav">

                                                                    <li title="{{trans('legacy/Sidebar/all.Magacini')}}"
                                                                        class="m-menu__item {{ Request::is('magacini*') ? ' m-menu__item--active' : '' }}"
                                                                        aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module=robno&magacini=1"
                                                                           class="m-menu__link">
                                                                            <i class="m-menu__link-icon flaticon-truck"></i>
                                                                            <span class="m-menu__link-text">
																{{trans('legacy/Sidebar/all.Magacini')}}
                                                                                <!-- <span style="margin-left: -10px" class="sidebar-text">
																	{{-- @lang('legacy/sidebar.folderDoc') --}}

                                                                                </span> -->
															</span>
                                                                        </a>
                                                                    </li>

                                                                    <li title="{{trans('legacy/Sidebar/all.Artikli')}}"
                                                                        class="m-menu__item {{ Request::is('robno/articles') ? ' m-menu__item--active' : '' }}"
                                                                        aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module=robno&artikli=1"
                                                                           class="m-menu__link">
                                                                            <i class="m-menu__link-icon flaticon-layers"></i>
                                                                            <span class="m-menu__link-text">
																{{trans('legacy/Sidebar/all.Artikli')}}
                                                                                <!-- <span style="margin-left: -10px" class="sidebar-text">
																	{{-- @lang('legacy/sidebar.folderDoc') --}}

                                                                                </span> -->
															</span>
                                                                        </a>
                                                                    </li>

                                                                    <li title="{{trans('legacy/Sidebar/all.Artikli')}}"
                                                                        class="m-menu__item  m-menu__item--submenu {{ (Request::is('robno/articles/ulazi'))  ? ' m-menu__item--active' : '' }}"
                                                                        aria-haspopup="true"
                                                                        data-menu-submenu-toggle="hover">
                                                                        <a href="{{(rtrim(config('legacy.kancelarko_url'), '/').'/robno/articles/ulazi')}}"
                                                                           class="m-menu__link">
                                                                            <i class="m-menu__link-icon flaticon-folder-2"></i>
                                                                            <span class="m-menu__link-text">
																<span style="margin-left: -5px" class="sidebar-text">
																	{{ trans('legacy/Content/robnoPodesavanja.ulazi') }}
																</span>
															</span>
                                                                        </a>
                                                                    </li>


                                                                    <li title="{{trans('legacy/Sidebar/all.Artikli')}}"
                                                                        class="m-menu__item  m-menu__item--submenu {{ (Request::is('robno/articles/izlazi'))  ? ' m-menu__item--active' : '' }}"
                                                                        aria-haspopup="true"
                                                                        data-menu-submenu-toggle="hover">
                                                                        <a href="{{(rtrim(config('legacy.kancelarko_url'), '/').'/robno/articles/izlazi')}}"
                                                                           class="m-menu__link">
                                                                            <i class="m-menu__link-icon flaticon-folder-3"></i>
                                                                            <span class="m-menu__link-text">
																<span style="margin-left: -5px" class="sidebar-text">
																	{{ trans('legacy/Content/robnoPodesavanja.izlazi') }}
																</span>
															</span>
                                                                        </a>
                                                                    </li>


                                                                    <li title="{{trans('legacy/Sidebar/all.Porudzbenice')}}"
                                                                        class="m-menu__item {{ Request::is('robno/porudzbenice*') ? ' m-menu__item--active' : '' }}"
                                                                        aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module=robno&porudzbenice=1"
                                                                           class="m-menu__link">
                                                                            <i class="m-menu__link-icon flaticon-list"></i>
                                                                            <span class="m-menu__link-text">
																{{trans('legacy/Sidebar/all.Porudzbenice')}}
                                                                                <!-- <span style="margin-left: -10px" class="sidebar-text">
																	{{-- @lang('legacy/sidebar.folderDoc') --}}

                                                                                </span> -->
															</span>
                                                                        </a>
                                                                    </li>

                                                                    {{-- <li class="m-menu__item m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                        @if (checkmodule('MODULE_RP') && !empty(session('licenseModule')['RP_DATES']['endDate']))
                                                                        <a href="javascript:;" class="m-menu__link ">
                                                                            @else
                                                                            <a href="#" class="m-menu__link">
                                                                                @endif
                                                                                <i class="m-menu__link-icon flaticon-diagram  s1"></i>
                                                                                <span class="m-menu__link-title">
                                                                                    <span class="m-menu__link-wrap">
                                                                                        <span class="m-menu__link-text">
                                                                                            {{trans('legacy/Sidebar/all.Finansije')}}
                                                                                        </span>
                                                                                        @if (checkmodule('MODULE_RP') && empty(session("gost")))
                                                                                        <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                                        @endif
                                                                                    </span>
                                                                                </span>
                                                                            </a>
                                                                            @if (checkmodule('MODULE_RP') && !empty(session('licenseModule')['RP_DATES']['endDate']) && empty(session("gost")))
                                                                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                                                <span class="m-menu__arrow"></span>
                                                                                <ul class="m-menu__subnav">



                                                                                    <li class="m-menu__item {{ (Request::is('robno/finansije/dobavljac')) ? ' m-menu__item--active' : '' }}" aria-haspopup="true">
                                                                                        <a href="{{ (rtrim(config('legacy.kancelarko_url'), '/').'/robno/finansije/dobavljac') }}" class="m-menu__link ">
                                                                                            <span class="m-menu__link-text" class="sidebar-text">
                                                                                                {{trans('legacy/Sidebar/all.Finansije dobavljač')}}
                                                                                            </span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class="m-menu__item {{ (Request::is('robno/finansije/kupac')) ? ' m-menu__item--active' : '' }}" aria-haspopup="true">
                                                                                        <a href="{{ (rtrim(config('legacy.kancelarko_url'), '/').'/robno/finansije/kupac') }}" class="m-menu__link ">
                                                                                            <span class="m-menu__link-text" class="sidebar-text">
                                                                                                {{trans('legacy/Sidebar/all.Finansije kupac')}}
                                                                                            </span>
                                                                                        </a>
                                                                                    </li>




                                                                                </ul>
                                                                            </div>
                                                                            @endif
                                                                    </li> --}}


                                                                    {{-- <li title="{{trans('legacy/Sidebar/all.Proizvodjaci')}}" class="m-menu__item {{ Request::is('proizvodjaci*') ? ' m-menu__item--active' : '' }}" aria-haspopup="true">
                                                                        <a href="{{route('switchModul')}}?module=robno&proizvodjaci=1" class="m-menu__link">
                                                                            <i class="m-menu__link-icon flaticon-network"></i>
                                                                            <span class="m-menu__link-text">
                                                                                {{trans('legacy/Sidebar/all.Proizvodjaci')}}

                                                                            </span>
                                                                        </a>
                                                                    </li> --}}

                                                                    <li title="{{trans('legacy/Sidebar/all.raspored')}}"
                                                                        class="m-menu__item {{ Request::is('robno/raspored*') ? ' m-menu__item--active' : '' }}"
                                                                        aria-haspopup="true">
                                                                        <a href="{{ (rtrim(config('legacy.kancelarko_url'), '/').'/robno/raspored') }}"
                                                                           class="m-menu__link">
                                                                            <i class="m-menu__link-icon flaticon-tool"></i>
                                                                            <span class="m-menu__link-text">

																	{{trans('legacy/Sidebar/all.raspored')}}

															</span>
                                                                        </a>
                                                                    </li>
                                                                    {{--
                                                                    <li title="{{trans('legacy/Sidebar/all.akcije')}}" class="m-menu__item {{ Request::is('robno/akcije*') ? ' m-menu__item--active' : '' }}" aria-haspopup="true">
                                                                        <a href="{{ (rtrim(config('legacy.kancelarko_url'), '/').'/robno/akcije') }}" class="m-menu__link">
                                                                            <i class="m-menu__link-icon flaticon-tool"></i>
                                                                            <span class="m-menu__link-text">

                                                                                    {{trans('legacy/Sidebar/all.akcije')}}
                                                                                </span>

                                                                        </a>
                                                                    </li> --}}

                                                                    {{-- <li title="{{trans('legacy/Sidebar/all.resursi')}}" class="m-menu__item  m-menu__item--submenu {{ (Request::is('robno/settings/vozila*')) ? ' m-menu__item--open m-menu__item--expanded' : '' }}" aria-haspopup="true" data-menu-submenu-toggle="hover">
                                                                        <a href="{{ (rtrim(config('legacy.kancelarko_url'), '/').'/robno/settings/vozila')}}" class="m-menu__link">
                                                                            <i class="m-menu__link-icon flaticon-puzzle"></i>
                                                                            <span class="m-menu__link-text">


                                                                                    {{trans('legacy/Sidebar/all.resursi')}}
                                                                                </span>
                                                                            </span>

                                                                        </a>

                                                                    </li> --}}

                                                                </ul>
                                                            </div>
                                                        @endif
                                                </a>
                                        </li>

                                        <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover"
                                            m-menu-link-redirect="1" aria-haspopup="true">
                                            @if (checkmodule('MODULE_PROCEDURE')
                                            && (!empty(session('licenseModule')['S_DATES']['endDate']) || !empty(session('licenseModule')['PROCEDURE_DATES']['endDate'])) && empty(session("gost")))
                                                <a href="/redirectModule/{{App\Legacy\Module\AppModuleHasher::getRedirectHash(['route' => '/procedures/active', 'module_url' => config('legacy.procedure_url')])}}"
                                                   class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-route"></i>
                                                    <span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														{{-- e-Fakture --}}
                                                        {{trans('legacy/Header/showModuleName.e-Procedure')}} (beta)

													</span>
													<i class="m-menu__hor-arrow la la-angle-down"></i>
													<i class="m-menu__ver-arrow la la-angle-right"></i>
												</span>
											</span>
                                                </a>
                                            @endif
                                            @if (checkmodule('MODULE_PROCEDURE') && !empty(session('licenseModule')['PROCEDURE_DATES']['endDate']) && empty(session("gost")))
                                                <div
                                                    class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                    <span class="m-menu__arrow"></span>
                                                    <ul class="m-menu__subnav">

                                                        <li class="m-menu__item m-menu__item--submenu"
                                                            m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            <a href="/redirectModule/{{App\Legacy\Module\AppModuleHasher::getRedirectHash(['route' => '/procedures/active', 'module_url' => config('legacy.procedure_url')])}}"
                                                               class="m-menu__link">
                                                                <i class="m-menu__link-icon fa fa-bar-chart"></i>
                                                                <span class="m-menu__link-text">
																{{ trans('legacy/Content/eProcedure/eProcedureBase.Aktivne procedure') }}
															</span>
                                                            </a>
                                                        </li>

                                                        <li class="m-menu__item m-menu__item--submenu"
                                                            m-menu-submenu-toggle="hover" m-menu-link-redirect="1"
                                                            aria-haspopup="true">
                                                            <a href="/redirectModule/{{App\Legacy\Module\AppModuleHasher::getRedirectHash(['route' => '/procedures/all', 'module_url' => config('legacy.procedure_url')])}}"
                                                               class="m-menu__link">
                                                                <i class="m-menu__link-icon fa fa-list-alt"></i>
                                                                <span class="m-menu__link-text">
																{{ trans('legacy/Content/eProcedure/eProcedureBase.Sve procedure') }}
															</span>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            @endif
								</ul>
							</div>
						</li>


                            {{-- <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="false">
                                <a href="javascript:" class="m-menu__link m-menu__toggle showToGuest" id="shareWithFirentsOpenModal">
                                    <span class="m-menu__link-text showToGuest" style="color: #5961d8;">
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i> --}}
                            {{-- Podeli --}}
                            {{-- {{trans('legacy/Header/kontaktFeedback.podeli')}}
                        </span>
                    </a>
                </li> --}}

                            <!-- video lilnkovi -->
                            {{-- <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="false" id="videoUputstvaLI" style="display: none;">
                                <a href="javascript:" class="m-menu__link m-menu__toggle showToGuest" id="videoUputstva">
                                    <span class="m-menu__link-text showToGuest" style="color: #5961d8;">
                                        <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                        {{trans('legacy/Header/kontaktFeedback.Video uputstva')}}
                                    </span>
                                </a>
                            </li> --}}

                            <li class="m-menu__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width"
                                m-dropdown-toggle="click"
                                m-dropdown-persistent="1">
                                {{-- <a href="javascript:" class="m-nav__link m-dropdown__toggle showToGuest" id="m_topbar_kancelarko_poruke_icon">
                                    {{trans('legacy/Header/notification.Kancelarko poruke')}}
                                    <span class="m-nav__link-badge">
                                        <span id="kancelarkoPorukeCount" class="m-badge m-badge--danger" style="display: none;"></span>
                                    </span>
                                </a> --}}
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                    <div class="m-dropdown__inner" style="margin-right:27px">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="topbar_kancelarko_poruke"
                                                         role="tabpanel">
                                                        <div class="m-scrollable" data-scrollable="true"
                                                             data-max-height="250" data-mobile-max-height="200">
                                                            <div class="m-list-timeline m-list-timeline--skin-light">
                                                                <div class="m-list-timeline__items"
                                                                     id="kancelarkoPorukeList"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#" class="btn m-btn--pill m-btn--air btn-outline-info"
                                                   style="text-align: center; width: 100%; margin-top: 15px;">
                                                    {{trans('legacy/Header/notification.Sve poruke')}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>


                            <li class="m-menu__item m-menu__item--submenu m-menu__item--rel">
                                <a href="{{ config('legacy.kancelarko_url') . '/gold-paket' }}"
                                target="_blank"
                                class="m-menu__link showToGuest"
                                id="gold-page-redirect"  style="margin-left: -35px;">

                                    <span class="m-menu__link-text showToGuest" style="color: #5961d8;">
                                        <img class="gold-logo-image"
                                            src="{{ URL::to('legacy/assets/images/gold/zlatni-okrvir-kancelarko.svg') }}"
                                            title="{{ checkmodule('MODULE_PREUZIMANJE_PODATAKA') ? 'Saznajte više...' : 'Postanite korisnik gold paketa' }}"
                                            alt="Gold logo">
                                    </span>
                                </a>
                            </li>



                            {{-- <li class="m-menu__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width">
                                <a target="_blank" href="https://invite.viber.com/?g2=AQBjMlT5Yos8Rk0yujbyIJNI8cuKnB4BzCtbKHbsSrjM7OF%2B84RlGnsE%2BmiiPWYI" class="m-nav__link m-dropdown__toggle showToGuest" id="m_topbar_kancelarko_viber_icon">
                                    {{trans('legacy/Header/kontaktFeedback.Viber zajednica')}}
                                </a>
                            </li>
{{--
                            <li class="m-menu__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width">
                                <a target="_blank"
                                   href="https://www.paragraf.rs/kancelarko/download-program-kancelarko.html"
                                   class="m-nav__link m-dropdown__toggle showToGuest kancelarko_desktop"
                                   title="{{trans('legacy/Header/kontaktFeedback.Preuzmite Kancelarko desktop aplikaciju')}}">
                                    <i style=""
                                       class="fa fa-download" aria-hidden="true">
                                    </i> Kancelarko klijent
                                </a>
                            </li> --}}


                            <!-- Tips and Tricks -->
                            <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"
                                m-menu-submenu-toggle="click" data-toggle="modal" data-target="#tipsAndTricksModal"
                                m-menu-link-redirect="1" aria-haspopup="false" id="tipsAndTricksLI"
                                style="display:none;">
                                <a href="javascript:" class="m-menu__link m-menu__toggle showToGuest"
                                   id="tipsAndTricks">
								<span class="m-menu__link-text showToGuest" style="color: #5961d8;">
									<i class="fa fa-eye" aria-hidden="true"></i>
									{{trans('legacy/Content/ispravke.tipsAndTricks.Tips and Tricks')}}
                                    {{-- Tips and Tricks --}}
								</span>
                                </a>
                            </li>

                            <!-- Tips and Tricks disabled -->
                            <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" aria-haspopup="false"
                                id="disabledTipsAndTricksLI" style="display:none">
                                <a href="javascript:" class="m-menu__link m-menu__toggle showToGuest disabled"
                                   id="disabledTipsAndTricks">
								<span class="m-menu__link-text showToGuest" style="color: #898b96;">
									<i class="fa fa-eye" aria-hidden="true"></i>
									{{trans('legacy/Content/ispravke.tipsAndTricks.Tips and Tricks')}}
                                    {{-- Tips and Tricks --}}
									<div id="tricksLoader" class="m-loader m-loader--primary"
                                         style="width: 30px; display: inline-block;margin-bottom: 5px;"></div>
								</span>
                                </a>
                            </li>
                        </ul>
                    @endif
                </div>

                <!-- END: Horizontal Menu -->
                <!-- BEGIN: Topbar -->
                <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
                    <div class="m-stack__item m-topbar__nav-wrapper">
                        <ul class="m-topbar__nav m-nav m-nav--inline header-list">

                            {{-- <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1">
                                <a href="#" class="m-nav__link m-dropdown__toggle showToGuest" id="notificationHelp"> --}}
                            {{-- <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span> --}}
                            {{-- <span class="m-nav__link-icon"  title="Pomoć za desktop notifikacije"> --}}
                            {{-- <span class="m-nav__link-icon" title="{{trans('legacy/Header/notificationHelp.Pomoć za desktop notifikacije')}}">
                                <i class="flaticon-information"></i>
                            </span>
                        </a>
                    </li> --}}
                            <li class="m-nav__item">
                                <a href="{{ url(config('legacy.kancelarko_url') . '/paragraf-ai') }}?module_from_url=Otpremnice" target="_blank"
                                    class="m-nav__link paragraf-ai-client-btn">
                                    <span>
                                        <img id="mag-texts-link"
                                            src="https://www.paragraf.rs/paragraf-ai/paragraf-ai-logo-invert.png"
                                            style="width: 128px;" alt="Paragraf AI">
                                    </span>
                                </a>
                            </li>

                            <li class="m-nav__item">
                                <a href="{{ config('legacy.kancelarko_url') . '/gold-paket-pogodnosti' }}" target="_blank"
                                   class="m-nav__link savetovanja-link">
									<span style="font-size: 16px; font-weight: 300;">
										Edukacije/vebinari
									</span>
                                </a>
                            </li>


							<li class="m-nav__item discount-btn">
								<a href="https://www.paragraf.rs/partneri/nasi-partneri.html" target="_blank" class="m-nav__link">
									<span class="m-nav__link-icon">
										<i class="fa fa-gift" aria-hidden="true"></i>
										<span class="discount-text">Popusti</span>
									</span>
								</a>
							</li>

							<li id="aplikacijaHeder" class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width m-dropdown--hover" m-dropdown-toggle="hover" m-dropdown-persistent="1">
								<a href="#" class="m-nav__link m-dropdown__toggle showToGuest">
									{{-- <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span> --}}
									<span class="m-nav__link-icon" style="font-size: 16px">
										<i class="la la-arrow-down"></i>
										Dodatne aplikacije
									</span>
								</a>
								<div class="m-dropdown__wrapper">
									<span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
									<div class="m-dropdown__inner" style="margin-right:27px">
										<div class="m-dropdown__header m--align-center" style="background: url({{asset('legacy/assets/app/media/img/misc/notification_bg.jpg')}}); background-size: cover;">
											<span class="m-dropdown__header-title">
												{{-- Dodatne aplikacije --}}
												Dodatne aplikacije
											</span>
										</div>
										<div class="m-dropdown__body">
											<div class="m-dropdown__content">
												<ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">

												</ul>
												<div class="tab-content">
													<div class="tab-pane active" role="tabpanel">
														<ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
															<li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width">
																<a target="_blank" href="https://www.paragraf.rs/kancelarko/download-program-kancelarko.html" class="m-nav__link showToGuest kancelarko_desktop"  title="Preuzmite Kancelarko desktop aplikaciju">
																	<span class="m-nav__link-icon" title="Pomoć za desktop notifikacije">
																		<i title="Kancelarko desktop ručno eArhiviranje i masovno potpisivanje" class="fa fa-download"></i>
																	</span>
																	Kancelarko desktop ručno eArhiviranje i masovno potpisivanje
																</a>
															</li>
															<li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width">
																<a  href="#" class="m-nav__link showToGuest"  title="Generiši uplatnicu" data-toggle="modal" data-target="#generatePaymentModal">

																	<span class="m-nav__link-icon" title="Pomoć za desktop notifikacije">
																	<i class="fa fa-credit-card-alt" aria-hidden="true"></i>																	</span>
																	Generiši uplatnicu
																</a>
															</li>
															<li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width">
																<a  href="{{ config('legacy.kancelarko_url').'/signature-validation' }}" class="m-nav__link showToGuest"  title="Validacija potpisa">
																	<span class="m-nav__link-icon" title="Pomoć za desktop notifikacije">
																		<i class="fa fa-pencil" aria-hidden="true"></i>
																	</span>
																	Validacija potpisa
																</a>
															</li>
															<li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width">
																<a  href="{{ config('legacy.kancelarko_url').'/browser-extension' }}/" class="m-nav__link showToGuest"  title="Browser ekstenzija">
																	<span class="m-nav__link-icon" title="Pomoć za desktop notifikacije">
																		<i class="fa fa-puzzle-piece" aria-hidden="true"></i>
																	</span>
																	Browser ekstenzija
																</a>
															</li>
														</ul>

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>

                            <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1">
                                <a href="#" class="m-nav__link m-dropdown__toggle showToGuest" id="notificationHelp">
                                    {{-- <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span> --}}
                                    {{-- <span class="m-nav__link-icon"  title="Pomoć za desktop notifikacije"> --}}
                                    <span class="m-nav__link-icon" title="Pomoć za desktop notifikacije">
                                        <i class="flaticon-information"></i>
                                    </span>
                                </a>
                            </li>

                            <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width"
                                m-dropdown-toggle="click" m-dropdown-persistent="1">
                                <a href="#" class="m-nav__link m-dropdown__toggle showToGuest"
                                   id="m_topbar_notification_icon">
                                    {{-- <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span> --}}
                                    <span class="m-nav__link-icon zvonce">
										<i class="flaticon-music-2"></i>
									</span>
                                    <span class="m-nav__link-badge">
										<span id="noreadnotificationcount" class="m-badge m-badge--danger"
                                              style="display: none;">

										</span>
									</span>

                                </a>
                                <div class="m-dropdown__wrapper" id="notificationsDropdown">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                    <div class="m-dropdown__inner" style="margin-right:27px">
                                        <div class="m-dropdown__header m--align-center"
                                             style="background: url({{asset('legacy/assets/app/media/img/misc/notification_bg.jpg')}}); background-size: cover;">
											<span class="m-dropdown__header-title">
												{{-- Notifikacije  --}}
                                                {{trans('legacy/Header/notification.Notifikacije')}}&nbsp;
												<a href="{{url(config('legacy.kancelarko_url') . '/profile')}}" style="vertical-align: middle;"><i class="fa fa-gear"
                                                                                                      style="font-size:1.2em; color: #fff;"></i></a>
											</span>
                                            {{-- <span class="m-dropdown__header-subtitle">
                                                    Notifikacija
                                                </span> --}}
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                {{--												<a href="{{route('notifications')}}" class="btn m-btn--pill m-btn--air btn-outline-info" style="text-align: center; width: 100%; margin-top: 0px;">--}}
                                                <a href="{{ config('legacy.kancelarko_url').'/notifications' }}"
                                                   class="btn m-btn--pill m-btn--air btn-outline-info"
                                                   style="text-align: center; width: 100%; margin-top: 0px;">
                                                    {{-- Sve notifikacije --}}
                                                    {{trans('legacy/Header/notification.Sve notifikacije')}}
                                                </a>
                                                <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand"
                                                    role="tablist">
                                                    <li id="markalllink_read" class="nav-item m-tabs__item"
                                                        style="padding: 10px 2px 10px 2px; display: none;">
                                                        {{-- Obeleži sve notifikacije kao pročitane --}}
                                                        {{trans('legacy/Header/notification.Pročitane')}}
                                                        <label class="m-checkbox checkbox-mark-read">
                                                            <input type="checkbox" id="markRead"
                                                                   class="markAllNotification">
                                                            <span></span>
                                                        </label>
                                                    </li>
                                                    <li id="markalllink_unread" class="nav-item m-tabs__item"
                                                        style="padding: 10px 2px 10px 2px; display: none;">
                                                        {{-- Obeleži sve notifikacije kao nepročitane --}}
                                                        {{trans('legacy/Header/notification.Nepročitane')}}
                                                        <label class="m-checkbox checkbox-mark-unread">
                                                            <input type="checkbox" id="markUnread"
                                                                   class="markAllNotification">
                                                            <span></span>
                                                        </label>
                                                    </li>
                                                    {{-- <li class="nav-item m-tabs__item">
                                                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_events" role="tab">
                                                                Poslednje
                                                            </a>
                                                        </li>  --}}
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="topbar_notifications_notifications"
                                                         role="tabpanel">
                                                        <div class="m-scrollable" data-scrollable="true"
                                                             data-max-height="250" data-mobile-max-height="200">
                                                            <div class="m-list-timeline m-list-timeline--skin-light">
                                                                <div class="m-list-timeline__items"
                                                                     id="headnotificationlist">

                                                                </div>
                                                            </div>
                                                            <button id="loadmorenotification" type="button"
                                                                    class="btn m-btn--pill m-btn--air         btn-outline-info"
                                                                    style="text-align: center; width: 100%; margin-top: 10px;">
                                                                <i class="fa fa-arrow-down"></i>
                                                            </button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width">
                                <a href="{{ config('legacy.kancelarko_url').'/texts/kancelarko-messages' }}"
                                   class="m-nav__link m-dropdown__toggle" target="_blank"
                                   title="{{trans('legacy/Header/notification.Kancelarko poruke')}}">
									<span class="m-nav__link-icon">
										<i id="kanc-msgs" class="fa fa-envelope" alt=""></i>
									</span>
                                    <i id="unread-kanc-msgs-icon" class="m-badge m-badge--danger d-none"
                                       style="position: absolute; top: 8px; right: -5px;"></i>
                                </a>
                            </li>
                            @if (checkmodule('MODULE_TEXTS')
                            && (!empty(session('licenseModule')['S_DATES']['endDate']) || !empty(session('licenseModule')['TEXTS_DATES']['endDate'])) && empty(session("gost")))
                                <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width">
                                    <a href="{{route('switchModul')}}?module=Tekstovi" class="m-nav__link m-dropdown__toggle" target="_blank" title="{{trans('legacy/Header/showModuleName.Strucni tekstovi')}}">
                                        <span class="m-nav__link-icon">
                                            <i class="fa fa-book fa-xs"></i>
                                        </span>
                                    </a>
                                </li> 
                                <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width">
                                    <a href="#disabled"
                                       class="m-nav__link m-dropdown__toggle showToGuest kancelarko_desktop"
                                       title="Nemate pristup stručnim tekstovima">
										<span class="m-nav__link-icon">
											<img
                                                src="https://www.paragraf.rs/kancelarko/images/kancelarko-casopis-ico.png"
                                                style="width: 24px; height:24px" alt="">
										</span>
                                    </a>
                                </li>
                            @else
                                {{-- <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width">
                                    <a href="#disabled" class="m-nav__link m-dropdown__toggle showToGuest kancelarko_desktop" title="{{trans('legacy/Header/disabledModules.Nemate pristup strucnim tekstovima')}}">
                                        <span class="m-nav__link-icon">
                                            <i class="fa fa-book fa-xs"></i>
                                        </span>
                                    </a>
                                </li> --}}
                                <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width">
                                    <a href="#disabled"
                                       class="m-nav__link m-dropdown__toggle showToGuest kancelarko_desktop"
                                       title="Nemate pristup stručnim tekstovima">
										<span class="m-nav__link-icon">
											<img
                                                src="https://www.paragraf.rs/kancelarko/images/kancelarko-casopis-ico.png"
                                                style="width: 24px; height:24px" alt="">
										</span>
                                    </a>
                                </li>
                            @endif

                            @if (checkmodule('MODULE_DELOVODNIK'))
                                <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width"
                                    m-dropdown-toggle="click" m-dropdown-persistent="1">
                                    <a href="#" class="m-nav__link m-dropdown__toggle showToGuest"
                                       id="loadLastReadDocuments">
                                        {{-- <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span> --}}
                                        <span class="m-nav__link-icon">
										<i class="flaticon-interface-9"></i>
									</span>
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                        <div class="m-dropdown__inner" style="margin-right:27px">
                                            <div class="m-dropdown__header m--align-center"
                                                 style="background: url({{asset('legacy/assets/app/media/img/misc/notification_bg.jpg')}}); background-size: cover;">
											<span class="m-dropdown__header-title">
												{{-- Poslednje korišćeni dokumenti --}}
                                                {{trans("Header/pkDokumenti.pkDokumenti")}}
											</span>
                                                {{-- <span class="m-dropdown__header-subtitle">
                                                        Notifikacija
                                                    </span> --}}
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand"
                                                        role="tablist">

                                                        {{-- <li class="nav-item m-tabs__item">
                                                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_events" role="tab">
                                                                    Poslednje
                                                                </a>
                                                            </li>  --}}
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" role="tabpanel">
                                                            <div class="m-scrollable" data-scrollable="true"
                                                                 data-max-height="250" data-mobile-max-height="200">
                                                                <div
                                                                    class="m-list-timeline m-list-timeline--skin-light">
                                                                    <div class="m-list-timeline__items"
                                                                         id="lastReadDocuments">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @php
                                $wdata = json_decode(Cookie::get('wheather'));
                                if($wdata){
                                $sky = $wdata->weather[0]->description;
                                switch ($sky) {
                                case 'clear sky':
                                $wcardclass = '';
                                $wcardtitle = 'Vedro';
                                break;

                                case 'light rain':
                                $wcardclass = 'rain';
                                $wcardtitle = 'Slaba kiša';
                                break;

                                case 'scattered clouds':
                                $wcardclass = 'cloudy';
                                $wcardtitle = 'Oblačno';
                                break;

                                default:
                                $wcardclass = 'top';
                                $wcardtitle = 'Vedro';
                                break;
                                }


                                $v = $wdata->dt * 1000;
                                $vreme = date('H:i', $wdata->dt);
                                $w = 1;
                                }
                                else {
                                $w = 0;
                                }
                            @endphp
                            @if($w == 1)
                                <li class="m-nav__item m-topbar__quick-actions m-topbar__quick-actions--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light"
                                    m-dropdown-toggle="click">

                                    <a href="#" class="m-nav__link m-dropdown__toggle">

                                        {{-- <span class="m-nav__link-badge m-badge m-badge--dot m-badge--info m--hide">{{$wdata->main->temp}}</span> --}}
                                        {{-- <span class="m-nav__link-icon"> --}}

                                        <img src="http://openweathermap.org/img/w/{{$wdata->weather[0]->icon}}.png"
                                             style="margin-right: 0px;">{{round($wdata->main->temp)}} °C
                                        {{-- <i class="flaticon-share"></i> --}}

                                        {{-- </span> --}}
                                        {{-- <span class="m-nav__link-badge">
                                                <span id="noreadnotificationcount" class="m-badge m-badge--secondary">
                                                    {{round($wdata->main->temp)}}
                                        </span>
                                        </span> --}}

                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <div class="row">
                                            <div class="col">
                                                <div class="weather-card one {{$wcardclass}}">
                                                    <div class="top">
                                                        <div class="wrapper">
                                                            <div class="mynav">
                                                                <a href="javascript:;"><span
                                                                        class="lnr lnr-chevron-left"></span></a>
                                                                <a href="javascript:;"><span class="lnr lnr-cog"></span></a>
                                                            </div>
                                                            <h1 class="heading">{{$wcardtitle}}</h1>
                                                            {{-- <h3 class="location">Beograd, Srbija</h3> --}}
                                                            <p class="temp">
                                                                <span
                                                                    class="temp-value">{{round($wdata->main->temp)}}</span>
                                                                <span class="deg">0</span>
                                                                <a href="#"
                                                                   style="text-decoration: none; cursor: auto !important;"><span
                                                                        class="temp-type">C</span></a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="bottom">
                                                                                <div class="wrapper">
                                                                                    <ul class="forecast">
                                                                                        <a href="javascript:;"><span class="lnr lnr-chevron-up go-up"></span></a>
                                                                                        <li class="active">
                                                                                            <span class="date">Yesterday</span>
                                                                                            <span class="lnr lnr-sun condition">
                                                                                                <span class="temp">23<span class="deg">0</span><span class="temp-type">C</span></span>
                                                                                            </span>
                                                                                        </li>
                                                                                        <li>
                                                                                            <span class="date">Tomorrow</span>
                                                                                            <span class="lnr lnr-cloud condition">
                                                                                                <span class="temp">21<span class="deg">0</span><span class="temp-type">C</span></span>
                                                                                            </span>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div> --}}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </li>
                            @endif
                            <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                m-dropdown-toggle="click">
                                <a href="#" class="m-nav__link m-dropdown__toggle showToGuest">
                                    <?php
                                    $name = explode(" ", Session::get('firstname'));
                                    $initials = "";

                                    foreach ($name as $w) {
                                        $initials .= strtoupper($w[0]);
                                    }
                                    $lastname = explode(" ", Session::get('lastname'));

                                    foreach ($lastname as $w) {
                                        $initials .= strtoupper(mb_substr($w, 0, 1));
                                    }

                                    ?>
                                    <span class="m-topbar__userpic name-initials">
										<!-- <span>{{$initials}}</span> -->
                                        {{-- <img src="{{ asset('legacy/assets/app/media/img/users/user2.jpg') }}" class="m--img-rounded m--marginless m--img-centered" alt=""/> --}}
                                        @if(Session::has('gavatar'))
                                            <img src="{{session('gavatar')}}"
                                                 class="m--img-rounded m--marginless m--img-centered" alt=""/>
                                        @else
                                            <span>{{$initials}}</span>
                                        @endif
									</span>
                                    @if(Session::has('gavatar'))
                                        <img src="{{url('/legacy/img/icon-file/gdrive-transparent.png')}}" width='18'
                                             height='18' style="margin-left: -12px;">
                                    @endif
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span
                                        class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center"
                                             style="background: url({{ asset('legacy/assets/app/media/img/misc/user_profile_bg.jpg') }}); background-size: cover;">
                                            <div class="m-card-user m-card-user--skin-dark">

                                                <div class="m-card-user__details">
													<span class="m-card-user__name m--font-weight-500">
														{{Session::get('firstname')}} {{Session::get('lastname')}}
													</span>
                                                    <span class="m-card-user__email m--font-weight-300">
														{{session('username')}}
                                                        @if(Session::has('gusername'))
                                                            <br>{{session('gusername')}} <img
                                                                src="{{url('/legacy/img/icon-file/gdrive-transparent.png')}}"
                                                                width='15' height='15'>
                                                        @endif
													</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav m-nav--skin-light">
                                                    <li class="m-nav__section m--hide">
														<span class="m-nav__section-text">
															...
														</span>
                                                    </li>
                                                    @if (session('realRole') == 'ADMIN' or session('realRole') == 'SADMIN')

                                                        <li class="m-nav__item">
                                                            <a href="#" class="m-nav__link" data-toggle="modal"
                                                               data-target="#changeUserRole">
                                                                <i class="m-nav__link-icon flaticon-refresh"></i>
                                                                <span class="m-nav__link-text">
																@switch(session('userRole'))
                                                                        @case('SADMIN')
                                                                            {{-- Ulogovani ste kao <strong>Super administrator</strong>
                                                                                                    <br>Promena nivoa pristupa --}}
                                                                            {!! trans('legacy/Header/user.Sadmin') !!}
                                                                            @break;
                                                                        @case('ADMIN')
                                                                            {{-- Ulogovani ste kao <strong>Administrator</strong>
                                                                                                    <br>Promena nivoa pristupa --}}
                                                                            {!! trans('legacy/Header/user.Admin') !!}
                                                                            @break;
                                                                        @case('USER')
                                                                            {{-- Ulogovani ste kao <strong>Korisnik</strong>
                                                                                                    <br>Promena nivoa pristupa --}}
                                                                            {!! trans('legacy/Header/user.User') !!}
                                                                            @break;
                                                                    @endswitch
															</span>

                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li class="m-nav__item">
                                                        <a href="{{ config('legacy.kancelarko_url').'/profile' }}"
                                                           class="m-nav__link hideFromUser">
                                                            <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                            <span class="m-nav__link-title">
																<span class="m-nav__link-wrap">
																	<span class="m-nav__link-text">
																		{{-- Moj profil --}}
                                                                        {{trans('legacy/Header/user.Moj profil')}}
																	</span>
																	{{-- <span class="m-nav__link-badge">
																						<span class="m-badge m-badge--success">
																							2
																						</span>
																					</span> --}}
																</span>
															</span>
                                                        </a>
                                                    </li>

                                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                                    <li class="m-nav__item">
                                                        <a href="#" class="m-nav__link hideFromUser" data-toggle="modal"
                                                           data-target="#podaciOLicenci">
                                                            <i class="m-nav__link-icon fa fa-info-circle"></i>
                                                            <span class="m-nav__link-text">
																{{-- Podaci o licenci --}}
                                                                {{trans('legacy/Header/user.Podaci o licenci')}}
															</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="#" class="m-nav__link hideFromUser" data-toggle="modal"
                                                           data-target="#pomocOprogramu">
                                                            <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                            <span class="m-nav__link-text">
																{{-- Pomoć (O programu) --}}
                                                                {{trans('legacy/Header/user.Pomoć (O programu)')}}
															</span>
                                                        </a>
                                                    </li>
                                                    {{-- Samo ako je u env-u true --}}
                                                    @if (config('legacy.googleapi'))

                                                        @if(Session::has('gname'))
                                                            <li class="m-nav__item">
                                                                <a href="{{(rtrim(config('legacy.kancelarko_url'), '/').'/login/google')}}?backurl={{url()->current()}}"
                                                                   class="m-nav__link">
                                                                    <i class="m-nav__link-icon fa fa-google"></i>
                                                                    <span class="m-nav__link-text">
																{{-- Google promena korisnika --}}
                                                                        {{trans('legacy/Header/user.Google promena korisnika')}}
															</span>
                                                                </a>
                                                            </li>
                                                        @else
                                                            <li class="m-nav__item">
                                                                <a href="{{(rtrim(config('legacy.kancelarko_url'), '/').'/login/google')}}?backurl={{url()->current()}}"
                                                                   class="m-nav__link hideFromUser">
                                                                    <i class="m-nav__link-icon fa fa-google"></i>
                                                                    <span class="m-nav__link-text">
																{{-- Google prijava --}}
                                                                        {{trans('legacy/Header/user.Google prijava')}}
															</span>
                                                                </a>
                                                            </li>
                                                        @endif

                                                    @endif

                                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
																			document.getElementById('logout-form').submit();"
                                                           class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
                                                            {{-- Izlaz --}}
                                                            {{trans('legacy/Header/user.Izlaz')}}
                                                        </a>
                                                        {{-- Samo ako je u env-u true --}}
                                                        @if (config('legacy.googleapi'))
                                                            @if(Session::has('gname'))
                                                                <a href="{{ route('googlelogout') }}?backurl={{url()->current()}}"
                                                                   class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder pull-right">
                                                                    <img src="{{url('/legacy/img/icon-file/gdrive.png')}}"
                                                                         width='15' height='15'>
                                                                    {{-- Izlaz --}}
                                                                    {{trans('legacy/Header/user.Izlaz')}}
                                                                </a>
                                                            @endif
                                                        @endif
                                                        {{-- samo ako imaju kadrovik --}}
                                                        @if(checkmodule('MODULE_KADROVIK') && !session('grantCalendarAccess'))
                                                            <a href="{{ config('legacy.kancelarko_url').'/calendar' }}"
                                                               onclick="toggleAbsenceAcces(event)"
                                                               class="preventDefault btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder pull-right">
                                                                <i class="fa fa-calendar" style="color: #716aca;"></i>
                                                            </a>
                                                        @endif
                                                        @if(checkmodule('MODULE_KADROVIK') && session('grantCalendarAccess'))
                                                            <button
                                                                class="preventDefault btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder pull-right disabled">
                                                                <i class="fa fa-calendar" style="color: green;"></i>
                                                            </button>
                                                        @endif

                                                        <form id="logout-form" action="{{ route('logout') }}"
                                                              method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </li>
                                                </ul>

                                                {{-- pristup absence kalendaru start --}}

                                                @if(checkmodule('MODULE_KADROVIK'))
                                                    <div class="preventDefault">
                                                        <form id="checkAccessStringFrom">
                                                            <div class="form-group m-form__group mt-4"
                                                                 id="accessStringContainer" style="display: none;">
                                                                <div class="input-group">
                                                                    <input type="password" class="form-control"
                                                                           id="accessStringInput"
                                                                           style="border-color: #ebedf2;">
                                                                    <div class="input-group-append togglePassText">
                                                                        <a href="javascript:void(0)"
                                                                           class="btn btn-secondary"
                                                                           data-id="accessStringInput"><i
                                                                                class="flaticon-eye"
                                                                                data-id="accessStringInput"></i></a>
                                                                    </div>
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-success" type="button"
                                                                                id="checkAccessStringSubmit">
                                                                            {{trans('legacy/Content/Kadrovik/kadrovikPodesavanja.headerSifra.U redu')}}
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <span id="accessStringInputErr"
                                                                      style="color: red; display: none;">{{trans('legacy/Content/Kadrovik/kadrovikPodesavanja.headerSifra.Molimo Vas unesite šifru')}}</span>
                                                            </div>
                                                        </form>

                                                        @if(session('userRole') == 'SADMIN')
                                                            <div class="m-checkbox-inline mt-4"
                                                                 id="changeStringContainer"
                                                                 onclick="toggleChangeAccess(event)"
                                                                 style="display: none;">
                                                                <label class="m-checkbox"
                                                                       style="color: #6f727d; font-weight: 400;">
                                                                    <input type="checkbox" id="changeStringCb">
                                                                    {{trans('legacy/Content/Kadrovik/kadrovikPodesavanja.headerSifra.IzmeniDodaj')}}
                                                                    <span></span>
                                                                </label>
                                                            </div>

                                                            <form id="insertEditAccessStringForm">
                                                                <div class="form-group m-form__group mt-4"
                                                                     id="newStringContainer" style="display: none;">
                                                                    <label for="newStringInput"
                                                                           style="color: #6f727d; font-weight: 400;">{{trans('legacy/Content/Kadrovik/kadrovikPodesavanja.headerSifra.Unesite novu šifru')}}</label>
                                                                    <div class="input-group">
                                                                        <input type="password" class="form-control"
                                                                               name="newStringInput" id="newStringInput"
                                                                               style="border-color: #ebedf2;">
                                                                        <div class="input-group-append togglePassText">
                                                                            <a href="javascript:void(0)"
                                                                               class="btn btn-secondary"
                                                                               data-id="newStringInput"><i
                                                                                    class="flaticon-eye"
                                                                                    data-id="newStringInput"></i></a>
                                                                        </div>
                                                                    </div>
                                                                    <span id="newStringInputErr"
                                                                          style="color: red; display: none;">{{trans('legacy/Content/Kadrovik/kadrovikPodesavanja.headerSifra.Molimo Vas unesite novu šifru')}}</span>
                                                                </div>

                                                                <div class="form-group m-form__group mt-4"
                                                                     id="confrimStringContainer" style="display: none;">
                                                                    <label for="confirmStringInput"
                                                                           style="color: #6f727d; font-weight: 400;">{{trans('legacy/Content/Kadrovik/kadrovikPodesavanja.headerSifra.Ponovite šifru')}}</label>
                                                                    <div class="input-group">
                                                                        <input type="password" class="form-control"
                                                                               name="confirmStringInput"
                                                                               id="confirmStringInput"
                                                                               style="border-color: #ebedf2;">
                                                                        <div class="input-group-append togglePassText">
                                                                            <a href="javascript:void(0)"
                                                                               class="btn btn-secondary"
                                                                               data-id="confirmStringInput"><i
                                                                                    class="flaticon-eye"
                                                                                    data-id="confirmStringInput"></i></a>
                                                                        </div>
                                                                    </div>
                                                                    <span id="confirmStringInputErr"
                                                                          style="color: red; display: none;">{{trans('legacy/Content/Kadrovik/kadrovikPodesavanja.headerSifra.Šifre se ne poklapaju')}}</span>
                                                                </div>
                                                                <div class="form-group m-form__group mt-4"
                                                                     id="submitStringContainer" style="display: none;">
                                                                    <button class="btn btn-success" type="button"
                                                                            id="insertEditAccessStringSubmit">
                                                                        {{trans('legacy/Content/Kadrovik/kadrovikPodesavanja.headerSifra.U redu')}}
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        @endif
                                                    </div>
                                                @endif

                                                {{-- pristup absence kalendaru end --}}

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="m-nav__item">
                                @php
                                    if (session('userRole') != 'ADMIN' && session('userRole') != 'SADMIN'){
                                    if (session('realRole') == 'ADMIN' || session('realRole') == 'SADMIN'){
                                    //$roleswitch = '<br><br>Za promenu nivoa pristupa kliknite na ikonicu podešavanja';
                                    $roleswitch = trans('legacy/Header/user.roleswitch');
                                    }
                                    else {
                                    $roleswitch = '';
                                    }


                                    $href = '#';
                                    $bdisabled = 'style="background: #C1BFD0 !important; border: none !important"';
                                    //$infobdisabled = ' id="clikchangeuserrole" data-container="body" data-toggle="m-tooltip" data-html="true" data-placement="bottom" title="" data-original-title="Pristup podešavanjima ima samo <strong>Administrator i Super Administrator</strong>'.$roleswitch.'"';
                                    $infobdisabled = ' id="clikchangeuserrole" data-container="body" data-toggle="m-tooltip" data-html="true" data-placement="bottom" title="" data-original-title="' . trans('legacy/Header/user.tooltip') . $roleswitch.'"';
                                    }
                                    else {
                                    $href = route('navigatesettings').'?collapse=true';
                                    $bdisabled = '';
                                    $infobdisabled = '';
                                    }
                                @endphp
                                <a href="{{$href}}" class="m-nav__link m-dropdown__toggle">
									<span class="m-nav__link-icon">
										<button type="button"
                                                class="btn btn-primary btn-sm" {!!$bdisabled!!} {!!$infobdisabled!!}><i
                                                class="flaticon-settings mlem"> </i></button>
									</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END: Topbar -->
            </div>
        </div>
    </div>
</header>


<div class="modal fade" id="generatePaymentModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" style="min-width: 1180px; margin-left: -100px;">
			<div class="modal-header">
				<h5 class="modal-title">
					{{-- Pomoć (O programu) --}}
					Uplatnica
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						@include('legacy.uplatnica')
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success mr-auto" onclick="openModalPaymentSlipList()">Lista šablona</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">
					{{-- Zatvori --}}
					Zatvori
				</button>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="paymentSlipListModal" tabindex="-1" role="dialog" aria-labelledby="savePaymentSlipTemplateModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="savePaymentSlipTemplateModal">Sačuvaj kao šablon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <table class="table" id="paymentSlipTable">
					<thead>
						<th>Naziv šablona</th>
						<th>QR kod</th>
						<th>Akcije</th>
					</thead>
					<tfoot>
						<th>Naziv šablona</th>
						<th>QR kod</th>
						<th>Akcije</th>
					</tfoot>
				</table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="qrCodeModalGenerate" tabindex="-1" role="dialog" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrCodeModalLabel">Nalog za plaćanje QR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div id="qrCodeImageGenerate"></div>
                <div id="qrCodeErrorGenerate"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="openModalSaveAsPaymentSlipTemplate()" id="openModalSaveAsPaymentSlipTemplateBtn">Sačuvaj kao šablon</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="savePaymentSlipTemplateModal" tabindex="-1" role="dialog" aria-labelledby="savePaymentSlipTemplateModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sačuvaj kao šablon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="form-group">
					<input type="text" class="form-control redBorderInputCl" name="paymentSlipTemplateName" id="paymentSlipTemplateName" value="">
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="saveAsPaymentSlipTemplate()">Sačuvaj</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sendToEmailModal" tabindex="-1" role="dialog" aria-labelledby="sendToEmailModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pošalji na email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="form-group">
					<input type="text" class="form-control redBorderInputCl" placeholder="Unesite email" id="sendToEmail" value="">
					<input type="hidden" id="qrId">
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="sendQRToEmail()">Pošalji</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="notificationHelpModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog " role="document">

            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title">Uključivanje desktop notifikacija</h5> --}}
					<h5 class="modal-title">Uključivanje desktop notifikacija</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">

	                    </span>
                    </button>
                </div>
                <div class="modal-body">
					{{-- <div id="notificationDenied" class="notificationDenied alert alert-info alert-dismissible pull-left" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
						<strong> --}}
							{{-- Info! (notificationHelp) --}}
							{{-- Info
						</strong> --}}
						{{-- Ukoliko želite da primate notifikacije na ovom browseru, neophodno je da ih dozvolite. Pomoć: --}}
						{{-- Pomoć
					</div> --}}

					<?php
						$ua = isset($_SERVER['HTTP_USER_AGENT']) ? strtolower($_SERVER['HTTP_USER_AGENT']) : "";
						if(stripos($ua,'android') !== false) { // && stripos($ua,'mobile') !== false) {

							?>

							<img src="{{asset('legacy/assets/images/notificationAndroid.gif')}}" alt="" style="width: 100%">

							<?php
						}	else{
							?>

								@if(config('legacy.app_server_production') == 'Principal')
								<img src="{{asset('legacy/assets/images/notificationgifp.gif')}}" alt="" style="width: 100%">
								@elseif(config('legacy.app_server_production') == 'Delovodnik')
								{{-- <img src="{{asset('legacy/assets/images/notificationgif.gif')}}" alt="" style="width: 100%"> --}}
								<video autoplay loop muted playsinline style="width: 100%">
  									<source src="{{asset('legacy/assets/images/notificationgif.webm')}}" type="video/webm">
  									<source src="{{asset('legacy/assets/images/notificationgif.mp4')}}" type="video/mp4">
								</video>
								@endif

							<?php
						}

					?>

                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button> --}}
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                </div>
            </div>
    </div>
</div>

    <!-- END: Header -->
@include('legacy.layouts.coreplugins')
