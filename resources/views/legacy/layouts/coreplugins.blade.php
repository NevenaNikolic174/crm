@if (session('realRole') == 'ADMIN' or session('realRole') == 'SADMIN')

    <style>
        /*#dynamicVideoContent .col-md-6 {*/
        /*	background: url(/img/tail-spin.svg) center center no-repeat;*/
        /*	filter: invert(100%);*/
        /*	width: 100%;*/
        /*	height: 330px;*/
        /*}*/
        /*#dynamicVideoContent .col-md-12 {*/
        /*	background: url(/img/tail-spin.svg) center center no-repeat;*/
        /*	filter: invert(100%);*/
        /*	width: 100%;*/
        /*	height: 330px;*/
        /*}*/
        /*.dynamicVideoContent  {*/
        /*	background: url(/img/tail-spin.svg) center center no-repeat;*/
        /*	filter: invert(100%);*/
        /*	width: 100%;*/
        /*	height: 330px;*/
        /*}*/

        #shareWithFirentsEmail-c {
            display: none;
            margin-top: 25px;
        }

        #emailError {
            color: red;
            margin-left: 15px;
        }

        .delEmail,
        .cantSentToEmail {
            display: inline-block;
        }

        .delEmail:hover {
            text-decoration: underline;
            cursor: pointer;
            color: red;
        }

        .subActive {
            color: #5867dd !important;
        }
    </style>

    <!--modal za menjanje privilegije -->
    <div class="modal fade" id="changeUserRole" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="{{ url('saveuserrole') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        @php
                            if (session('userRole') == 'SADMIN'):
                                // $userRole = "Super administrator";
                                $userRole = trans('legacy/Header/user.Super administrator');
                                // $userRole = "Administrator";
                                // $userRole = "Korisnik";
                            elseif (session('userRole') == 'ADMIN'):
                                $userRole = trans('legacy/Header/user.Administrator');
                            else:
                                $userRole = trans('legacy/Header/user.Korisnik');
                            endif;
                        @endphp

                        <h5 class="modal-title">
                            {{-- Nivo pristupa -  --}}
                            {{ trans('legacy/Header/user.Nivo pristupa') }}
                            {{ $userRole }} {{ session('username') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">

                            </span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>
                                {{-- Promenite nivo pristupa --}}
                                {{ trans('legacy/Header/user.Promenite nivo pristupa') }}
                            </label>
                            <select data-autofocus="true" class="form-control m-input" name="userRole"
                                    id="selectUserRole" data-live-search="true" title="Odaberite nivo">
                                <option value="USER">
                                    {{-- Korisnik --}}
                                    {{ trans('legacy/Header/user.Korisnik') }}
                                </option>
                                <option value="ADMIN">
                                    {{-- Administrator --}}
                                    {{ trans('legacy/Header/user.Administrator') }}
                                </option>
                                @if (session('realRole') == 'SADMIN')
                                    <option value="SADMIN">
                                        {{-- Super administrator --}}
                                        {{ trans('legacy/Header/user.Super administrator') }}
                                    </option>
                                @endif
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label class="m-checkbox">
                                <input type="checkbox" name="localSaveUserRole">
                                Sačuvajte nivo pristupa na računaru
                                <span></span>
                            </label>
                        </div> --}}
                        <p><b>
                                {{-- Objašnjenje --}}
                                {{ trans('legacy/Header/user.Objašnjenje') }} :
                            </b></p>

                        <div id="infoSADMIN"
                             class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline  alert alert-brand alert-dismissible fade show roleinfo"
                             role="alert">
                            <div class="m-alert__icon">
                                <i class="flaticon-exclamation-1"></i>
                                <span></span>
                            </div>
                            <div class="m-alert__text">
                                {{--
                                <strong>
                                    Super administrator:
                                </strong>
                                Ima sve privilegije i mogućnosti u Kancelarku.
                                --}}
                                {!! trans('legacy/Header/user.Objašnjenje Sadmin') !!}
                            </div>
                        </div>

                        <div id="infoADMIN"
                             class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline  alert alert-brand alert-dismissible fade show roleinfo"
                             role="alert">
                            <div class="m-alert__icon">
                                <i class="flaticon-exclamation-1"></i>
                                <span></span>
                            </div>
                            <div class="m-alert__text">
                                {{--
                                <strong>
                                    Administrator:
                                </strong>
                                Korisnik sa ovim nivoom pristupa ima privilegiju da administrira
                                podešavanja u Kancelarku. Na ovaj nivo utiču i postavljene privilegije za korisnički nalog.
                                --}}
                                {!! trans('legacy/Header/user.Objašnjenje Admin') !!}
                            </div>
                        </div>



                        <div id="infoUSER"
                             class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline  alert alert-brand alert-dismissible fade show roleinfo"
                             role="alert">
                            <div class="m-alert__icon">
                                <i class="flaticon-exclamation-1"></i>
                                <span></span>
                            </div>
                            <div class="m-alert__text">
                                {{--
                                <strong>
                                    Korisnik:
                                </strong>
                                Korisnik sa ovim nivoom pristupa ima privilegije koje
                                su mu dodeljene od strane administratora, a podrazumevano vidi samo poslovne informacije u Kancelarku.
                                --}}
                                {!! trans('legacy/Header/user.Objašnjenje User') !!}
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <div class="alert alert-info roleinfo" style="display: none;" id="infoUSER">
                                <i class="flaticon-information"> </i>Korisnik sa ovim nivoom pristupa ima privilegije koje su mu dodeljene od strane administratora, a podrazumevano vidi samo poslovne informacije u Kadroviku.
                            </div>
                            <div class="alert alert-info roleinfo" style="display: none;" id="infoADMIN">
                                <i class="flaticon-information"> </i>Korisnik sa ovim nivoom pristupa ima privilegiju da administrira podešavanja u Kancelarku. Na ovaj nivo utiču i postavljene privilegije za korisnički nalog.
                            </div>
                            <div class="alert alert-info roleinfo" style="display: none;" id="infoSADMIN">
                                <i class="flaticon-information"> </i>Ima sve privilegije i mogućnosti u Kancelarku.
                            </div>
                        </div>
                         --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {{-- Odustani --}}
                            {{ trans('legacy/Header/user.Odustani') }}
                        </button>
                        <button type="submit" class="btn btn-success">
                            {{-- Sačuvaj --}}
                            {{ trans('legacy/Header/user.Sačuvaj') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endif


<!-- modal za podatke o licenci -->
<div class="modal fade" id="podaciOLicenci" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{-- Podaci o licenci --}}
                    {{ trans('legacy/Header/podaciOLicenciModal.Podaci o licenci') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <p>
                            {{-- Ime i prezime --}}
                            {{ trans('legacy/Header/podaciOLicenciModal.Ime i prezime') }}:
                            <b>{{ session('firstname') }} {{ session('lastname') }}</b>
                        </p>

                        @switch(session("userRole"))
                            @case('USER')
                                <p>
                                    {{-- Nivo pristupa: <b>Korisnik</b> --}}
                                    {!! trans('legacy/Header/podaciOLicenciModal.NivoPristupaKorisnik') !!}
                                </p>
                                <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline  alert alert-brand alert-dismissible fade show roleinfo"
                                     role="alert" style="">
                                    <div class="m-alert__icon">
                                        <i class="flaticon-exclamation-1"></i>
                                        <span></span>
                                    </div>
                                    <div class="m-alert__text">
                                        {{--
                                        <strong>
                                            Korisnik:
                                        </strong>
                                        Korisnik sa ovim nivoom pristupa ima privilegije koje
                                        su mu dodeljene od strane administratora, a podrazumevano vidi samo poslovne informacije u Kancelarku.
                                        --}}
                                        {!! trans('legacy/Header/podaciOLicenciModal.NivoPristupaKorisnikInfo') !!}
                                    </div>
                                </div>
                                @break

                            @case('ADMIN')
                                <p>
                                    {{-- Nivo pristupa: <b>Administrator</b> --}}
                                    {!! trans('legacy/Header/podaciOLicenciModal.NivoPristupaAdmin') !!}
                                </p>
                                <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline  alert alert-brand alert-dismissible fade show roleinfo"
                                     role="alert" style="display: none;">
                                    <div class="m-alert__icon">
                                        <i class="flaticon-exclamation-1"></i>
                                        <span></span>
                                    </div>
                                    <div class="m-alert__text">
                                        {{--
                                        <strong>
                                            Administrator:
                                        </strong>
                                        Korisnik sa ovim nivoom pristupa ima privilegiju da administrira
                                        podešavanja u Kancelarku. Na ovaj nivo utiču i postavljene privilegije za korisnički nalog.
                                        --}}
                                        {!! trans('legacy/Header/podaciOLicenciModal.NivoPristupaAdminInfo') !!}
                                    </div>
                                </div>
                                @break

                            @case('SADMIN')
                                <p>
                                    {{-- Nivo pristupa: <b>Super Administrator</b> --}}
                                    {!! trans('legacy/Header/podaciOLicenciModal.NivoPristupaSadmin') !!}
                                </p>
                                <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline  alert alert-brand alert-dismissible fade show roleinfo"
                                     role="alert" style="display: none;">
                                    <div class="m-alert__icon">
                                        <i class="flaticon-exclamation-1"></i>
                                        <span></span>
                                    </div>
                                    <div class="m-alert__text">
                                        {{--
                                        <strong>
                                            Super administrator:
                                        </strong>
                                        Ima sve privilegije i mogućnosti u Kancelarku.
                                        --}}
                                        {!! trans('legacy/Header/podaciOLicenciModal.NivoPristupaSadminInfo') !!}
                                    </div>
                                </div>
                                @break

                            @default
                        @endswitch
                        <p>
                            {{-- ID Licence  --}}
                            {{ trans('legacy/Header/podaciOLicenciModal.ID Licence') }}:
                            <strong>{{ session('licenseid') }}</strong>
                            <br>
                            {{-- Aplikacioni kod --}}
                            {{ trans('legacy/Header/podaciOLicenciModal.Aplikacioni kod') }}:
                            <strong>{{ session('licenseapp') }}</strong>
                            <br>
                            {{-- Nosilac licence --}}
                            {{ trans('legacy/Header/podaciOLicenciModal.Nosilac licence') }}:
                            <strong>{{ session('subscriberData') }} </strong>
                        </p>
                        <p>

						{{-- Moduli --}}
						{{trans('legacy/Header/podaciOLicenciModal.Moduli')}}:
						<br>
						{{-- Principal --}}
						{{trans('legacy/Header/podaciOLicenciModal.Principal')}}:

						@if (checkmodule('MODULE_PRINCIPAL') && !empty(session('licenseModule')['P_DATES']['endDate']))

							@if (!isset(session('licenseModule')['P_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['P_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['P_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['P_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{-- Neaktivan --}}
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif

						<br>
						{{-- e-Delovodnik --}}
						{{trans('legacy/Header/podaciOLicenciModal.e-Delovodnik')}}:

						@if (checkmodule('MODULE_DELOVODNIK') && !empty(session('licenseModule')['D_DATES']['endDate']))
							@if (!isset(session('licenseModule')['D_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['D_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['D_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['D_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{-- Neaktivan --}}
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif
						<br>

						{{-- e-Arhiviranje --}}
						{{trans('legacy/Header/podaciOLicenciModal.e-Arhiviranje')}}:

						@if (checkmodule('MODULE_DELOVODNIK_ARHIVIRANJE') && !empty(session('licenseModule')['D_ARCHIVING_DATES']['endDate']))
							@if (!isset(session('licenseModule')['D_ARCHIVING_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['D_ARCHIVING_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['D_ARCHIVING_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['D_ARCHIVING_DATES']['endDate']))}})
								</span>
							@endif
							<p class="mb-0">{{ trans('legacy/Header/podaciOLicenciModal.stanjeVremenskihZigova') }}:</p>
							<div class="ml-3">
								<p class="mb-0">{{ trans('legacy/Header/podaciOLicenciModal.ukupnoKredita') }}: <span id="ukupnoKredita"></span></p>
								<p class="mb-0">{{ trans('legacy/Header/podaciOLicenciModal.istrosenoKredita') }}: <span id="istrosenoKredita"></span></p>
								<p class="mb-0">{{ trans('legacy/Header/podaciOLicenciModal.preostaloKredita') }}: <span id="preostaloKredita"></span></p>
							</div>
						@else
							<span style="color: red; font-weight: bold;">
								{{-- Neaktivan --}}
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif

						<br>
						{{-- e-Fakture --}}
						{{trans('legacy/Header/podaciOLicenciModal.e-Fakture')}}:

						@if (checkmodule('MODULE_SELFADMIN') && !empty(session('licenseModule')['S_DATES']['endDate']))
							@if (!isset(session('licenseModule')['S_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['S_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['S_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['S_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{-- Neaktivan --}}
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif

						{{-- DEL-9617 korisniku se nije prikazivao modul fakture lite, konsultovao s ilijom  --}}
						@if (true)
						<br>
						{{trans('legacy/Header/showModuleName.e-Fakture-lite')}}:
						@if (checkmodule('MODULE_SELFADMIN_LITE') && (!empty(session('licenseModule')['SL_DATES']['endDate'])))
							@if (!isset(session('licenseModule')['SL_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['SL_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['SL_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['SL_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif
						@endif

						<br>

						{{-- e-Otpremnice --}}
						{{trans('legacy/Header/podaciOLicenciModal.e-Otpremnice')}}:
						@if (checkmodule('MODULE_OTPREMNICE') && (!empty(session('licenseModule')['OTPREMNICE_DATES']['endDate'])))
							@if (!isset(session('licenseModule')['OTPREMNICE_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['OTPREMNICE_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['OTPREMNICE_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['OTPREMNICE_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif

						<br>

						{{-- e-Fiskalna kasa --}}
						e-Fiskalna kasa:

						@if (checkmodule('MODULE_FISKALNI') && !empty(session('licenseModule')['FISKALNI_DATES']['endDate']))
							@if (!isset(session('licenseModule')['FISKALNI_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y',
									strtotime(session('licenseModule')['FISKALNI_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y',
									strtotime(session('licenseModule')['FISKALNI_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y',
									strtotime(session('licenseModule')['FISKALNI_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{-- Neaktivan --}}
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif

						<br>
						{{trans('legacy/Header/podaciOLicenciModal.e-Poštar')}}:
						@if (checkmodule('MODULE_POSTMAN') && (!empty(session('licenseModule')['S_DATES']['endDate']) || !empty(session('licenseModule')['POSTMAN_DATES']['endDate'])))
							@if (!isset(session('licenseModule')['POSTMAN_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['POSTMAN_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['POSTMAN_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['POSTMAN_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif

						{{-- Kadrovik --}}
						<br>
						@if (checkmodule('MODULE_KADROVIK') && !empty(session('licenseModule')['KADROVIK_DATES']['endDate']))
						{{trans('legacy/Header/podaciOLicenciModal.Kadrovik')}}:
							@if (!isset(session('licenseModule')['KADROVIK_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['KADROVIK_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['KADROVIK_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['KADROVIK_DATES']['endDate']))}})
								</span>
							@endif
						@elseif(checkmodule('MODULE_KADROVIK_LITE') && !empty(session('licenseModule')['KADROVIK_LITE_DATES']['endDate']))
						{{trans('legacy/Header/podaciOLicenciModal.Kadrovik')}} lite:
							@if (!isset(session('licenseModule')['KADROVIK_LITE_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['KADROVIK_LITE_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['KADROVIK_LITE_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['KADROVIK_LITE_DATES']['endDate']))}})
								</span>
							@endif
						@else
						{{trans('legacy/Header/podaciOLicenciModal.Kadrovik')}}:
							<span style="color: red; font-weight: bold;">
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif

						<br>
						{{trans('legacy/Header/showModuleName.Robno')}}:
						@if (checkmodule('MODULE_RP') && checkmodule('MODULE_RP_SETTINGS') && (!empty(session('licenseModule')['RP_DATES']['endDate'])))
							@if (!isset(session('licenseModule')['RP_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['RP_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['RP_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['RP_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif

						<br>
						{{trans('legacy/Header/showModuleName.Procedure')}}:
						@if (checkmodule('MODULE_PROCEDURE') && !empty(session('licenseModule')['PROCEDURE_DATES']['endDate']))

							@if (!isset(session('licenseModule')['PROCEDURE_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['PROCEDURE_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['PROCEDURE_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['PROCEDURE_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{-- Neaktivan --}}
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif

						<br>
						OCR:
						@if (checkmodule('MODULE_OCR') && !empty(session('licenseModule')['OCR_DATES']['endDate']))

							@if (!isset(session('licenseModule')['OCR_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['OCR_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['OCR_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['OCR_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{-- Neaktivan --}}
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif

						<br>
						Resursi:
						@if (checkmodule('MODULE_RESORSI') && (!empty(session('licenseModule')['RESORSI_DATES']['endDate'])))
							@if (!isset(session('licenseModule')['RESORSI_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['RESORSI_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['RESORSI_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['RESORSI_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif

						<br>
						e-Obrada izvoda:
						@if (checkmodule('MODULE_OBRADA_IZVODA') && (!empty(session('licenseModule')['OI_DATES']['endDate'])))
							@if (!isset(session('licenseModule')['OI_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['OI_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['OI_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['OI_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif
						<br>
						Preuzimanje podataka CompanyWall:
						@if (checkmodule('MODULE_PREUZIMANJE_PODATAKA') && (!empty(session('licenseModule')['PREUZIMANJE_PODATAKA_DATES']['endDate'])))
							@if (!isset(session('licenseModule')['PREUZIMANJE_PODATAKA_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['PREUZIMANJE_PODATAKA_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['PREUZIMANJE_PODATAKA_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['PREUZIMANJE_PODATAKA_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif
						<br>
						Stručni tekstovi:
						@if (checkmodule('MODULE_TEXTS') && (!empty(session('licenseModule')['TEXTS_DATES']['endDate'])))
							@if (!isset(session('licenseModule')['TEXTS_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['TEXTS_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['TEXTS_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['TEXTS_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif
						<br>
						Browser ekstenzija:
						@if (checkmodule('MODULE_BROWSER_EXTENSION') && (!empty(session('licenseModule')['BROWSER_EXTENSION_DATES']['endDate'])))
							@if (!isset(session('licenseModule')['BROWSER_EXTENSION_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['BROWSER_EXTENSION_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['BROWSER_EXTENSION_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['BROWSER_EXTENSION_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif

						<br>
						e-Tiketi:
						@if (checkmodule('MODULE_TICKETING') && (!empty(session('licenseModule')['TICKETING_DATES']['endDate'])))
							@if (!isset(session('licenseModule')['TICKETING_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['TICKETING_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['TICKETING_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['TICKETING_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif

						<br>
						Troškovnik:
						@if (checkmodule('MODULE_TROSKOVNIK') && (!empty(session('licenseModule')['TROSKOVNIK_DATES']['endDate'])))
							@if (!isset(session('licenseModule')['TROSKOVNIK_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['TROSKOVNIK_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['TROSKOVNIK_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['TROSKOVNIK_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif

						<br>
						MailJohny:
						@if (checkmodule('MODULE_ELMS') && (!empty(session('licenseModule')['ELMS_DATES']['endDate'])))
							@if (!isset(session('licenseModule')['ELMS_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['ELMS_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['ELMS_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['ELMS_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif
						<br>
						{{-- Obrasci --}}
                        e-Obrasci:

                        @if (checkmodule('MODULE_OBRASCI') && !empty(session('licenseModule')['OBRASCI_DATES']['endDate']))
                            @if (!isset(session('licenseModule')['OBRASCI_DATES']['expirationDate']))
                                <span style="color: green; font-weight: bold;">
                                        {{-- Aktivan do  --}}
                                    {{ trans('legacy/Header/podaciOLicenciModal.Modul aktivan do') }}
                                    {{ date('d.m.Y', strtotime(session('licenseModule')['OBRASCI_DATES']['endDate'])) }}
                                    </span>
                            @else
                                {{-- ako je produzeno trajanje modula --}}
                                <span style="color: green; font-weight: bold;">
                                        {{ trans('legacy/Header/podaciOLicenciModal.Modul aktivan do') }}
                                    {{ date('d.m.Y', strtotime(session('licenseModule')['OBRASCI_DATES']['expirationDate'])) }}
                                    </span>
                                <span style="color: red; font-weight: bold; padding-left: 5px;">
                                        {{-- Neaktivan --}}
                                        ({{ trans('legacy/Header/podaciOLicenciModal.Istekao') }}
                                    {{ date('d.m.Y', strtotime(session('licenseModule')['OBRASCI_DATES']['endDate'])) }})
                                    </span>
                            @endif
                        @else
                            <span style="color: red; font-weight: bold;">
                                    {{-- Neaktivan --}}
                                {{ trans('legacy/Header/podaciOLicenciModal.Modul neaktivan') }}
                                </span>
                        @endif
						<br>
						{{-- Dogadjaji --}}
						Događaji:
						@if (checkmodule('MODULE_DOGADJAJI') )
							@if (!isset(session('licenseModule')['DOGADJAJI_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['DOGADJAJI_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['DOGADJAJI_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['DOGADJAJI_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif

						<br>
						Email zavođenje:
						@if (checkmodule('MODULE_EMAIL_ZAVODJENJE') && (!empty(session('licenseModule')['EMAIL_ZAVODJENJE_DATES']['endDate'])))
							@if (!isset(session('licenseModule')['EMAIL_ZAVODJENJE_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{-- Aktivan do  --}}
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['EMAIL_ZAVODJENJE_DATES']['endDate']))}}
								</span>
							@else
								{{-- ako je produzeno trajanje modula --}}
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['EMAIL_ZAVODJENJE_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									{{-- Neaktivan --}}
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['EMAIL_ZAVODJENJE_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif
                        <br>
                        Povezivanje propisa — Pravna baza:
                    	@if (checkmodule('MODULE_POVEZIVANJE_PROPISA_PRAVNA_BAZA') && (!empty(session('licenseModule')['POVEZIVANJE_PROPISA_PRAVNA_BAZA_DATES']['endDate'])))
							@if (!isset(session('licenseModule')['POVEZIVANJE_PROPISA_PRAVNA_BAZA_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['POVEZIVANJE_PROPISA_PRAVNA_BAZA_DATES']['endDate']))}}
								</span>
							@else
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['POVEZIVANJE_PROPISA_PRAVNA_BAZA_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['POVEZIVANJE_PROPISA_PRAVNA_BAZA_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif
						<br>

						Paragraf AI:
						@if (checkmodule('MODULE_PARAGRAF_AI') && (!empty(session('licenseModule')['PARAGRAF_AI_DATES']['endDate'])))
							@if (!isset(session('licenseModule')['PARAGRAF_AI_DATES']['expirationDate']))
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['PARAGRAF_AI_DATES']['endDate']))}}
								</span>
							@else
								<span style="color: green; font-weight: bold;">
									{{trans('legacy/Header/podaciOLicenciModal.Modul aktivan do')}} {{date('d.m.Y', strtotime(session('licenseModule')['PARAGRAF_AI_DATES']['expirationDate']))}}
								</span>
								<span style="color: red; font-weight: bold; padding-left: 5px;">
									({{trans('legacy/Header/podaciOLicenciModal.Istekao')}} {{date('d.m.Y', strtotime(session('licenseModule')['PARAGRAF_AI_DATES']['endDate']))}})
								</span>
							@endif
						@else
							<span style="color: red; font-weight: bold;">
								{{trans('legacy/Header/podaciOLicenciModal.Modul neaktivan')}}
							</span>
						@endif
						<br>

                                </p>

                                <?php
                                $stSize = getUsage();
                                ?>

                                {{-- Iskorišćenost prostora na licenci  --}}
                                @if ($stSize > 0)
                                    {{ trans('legacy/Header/podaciOLicenciModal.Iskorišćenost') }} :
                                    <strong>{{ formatDiskSize($stSize) }}</strong>
                                @else
                                    {{ trans('legacy/Header/podaciOLicenciModal.Nema potrosnje') }}
                                @endif

                                {{-- <small>
                                            Info! Iskorišćenost prostora se računa na svaka dva sata
                                            {{trans('legacy/Header/podaciOLicenciModal.IskorišćenostInfo')}}.
                                        </small> --}}
                                <hr>
                                <h5>
                                    {{-- Korisnik ima sledeće privilegije --}}
                                    {{ trans('legacy/Header/podaciOLicenciModal.KorisnikPrivilegije') }}:
                                </h5>

                                {{-- @if (session('userRole') == 'SADMIN')
                                            <p>Pregled ostalih informacija kod zaposlenih (osim poslovnih koje vide svi)</p>
                                            <p>Dodaje / menja zaposlene</p>
                                            <p>Dodaje / menja kontakte</p>
                                            <p>Finansije</p>
                                            <p>Vidi fakture i uplate</p>
                                            <p>Dodaje / menja nadležne organe</p>
                                            <p>Dodaje / menja lokacije</p>
                                            <p>Dodaje / menja resurse</p>
                                            <p>Pregled statistike zaposlenih</p>
                                            <p>Dodaje novu delovodnu knjigu</p>
                                            <p>Administracija foldera u zajedničkim dokumentima</p>
                                            <p>Dodavanje dokumenata u zajedničkim dokumentima</p>
                                            <p>e-Fakture: Može da šalje</p>
                                            <p>e-Fakture: Vidi primljene</p>
                                        @else --}}
                                <p>
                                    {{-- Pregled ostalih informacija kod zaposlenih (osim poslovnih koje vide svi) --}}
                                    {{ trans('legacy/Header/podaciOLicenciModal.PregledOstalih') }}
                                </p>



							{{-- modul  svi--}}
							@if (session("employeeChange") == 1)
								<p>
									{{-- Dodaje / menja zaposlene --}}
									{{trans('legacy/Header/podaciOLicenciModal.DodajeMenjaZaposlene')}}
								</p>
							@endif

							{{-- modul  svi--}}
							@if (session("contactChange") == 1)
								<p>
									{{-- Dodaje / menja kontakte --}}
									{{trans('legacy/Header/podaciOLicenciModal.DodajeMenjaKontakte')}}
								</p>
							@endif

							{{-- modul Principal --}}
							@if (session("finances") == 1 && checkmodule("MODULE_PRINCIPAL") == true)
								<p>
									{{-- Finansije (pravi i briše fakture i evidentira uplate po fakturi za sve predmete) --}}
									{{trans('legacy/Header/podaciOLicenciModal.Finansije')}}
								</p>
							@endif

							{{-- modul Principal --}}
							@if (session("faktureUplatePriv") == 1 && checkmodule("MODULE_PRINCIPAL") == true)
								<p>
									{{-- Vidi fakture i uplate --}}
									{{trans('legacy/Header/podaciOLicenciModal.VidiFakture')}}
								</p>
							@endif

							{{-- modul Principal --}}
							@if (session("institutions") == 1 && checkmodule("MODULE_PRINCIPAL") == true)
								<p>
									{{-- Dodaje / menja nadležne organe --}}
									{{trans('legacy/Header/podaciOLicenciModal.DodajeMenjaOrgane')}}

								</p>
							@endif

							{{-- modul Principal --}}
							@if (session("locationAdd") == 1 && checkmodule("MODULE_PRINCIPAL") == true)
								<p>
									{{-- Dodaje / menja lokacije --}}
									{{trans('legacy/Header/podaciOLicenciModal.DodajeMenjaLokacije')}}
								</p>
							@endif

							{{-- modul Principal --}}
							@if (session("resourcePriv") == 1 && checkmodule("MODULE_PRINCIPAL") == true)
								<p>
									{{-- Dodaje / menja resurse --}}
									{{trans('legacy/Header/podaciOLicenciModal.DodajeMenjaResurse')}}
								</p>
							@endif

							{{-- modul Principal --}}
							@if (session("statisticsPriv") == 1 && checkmodule("MODULE_PRINCIPAL") == true)
								<p>
									{{-- Pregled statistike zaposlenih --}}
									{{trans('legacy/Header/podaciOLicenciModal.PregledStatistike')}}
								</p>
							@endif

							{{-- modul Delovodnik --}}
							@if (session("newDelovodnik") == 1 && checkmodule("MODULE_DELOVODNIK") == true)
								<p>
									{{-- Dodaje novu knjigu dokumenata --}}
									{{trans('legacy/Header/podaciOLicenciModal.DodajeKnjiguDokumenata')}}
								</p>
							@endif

							{{-- modul Delovodnik --}}
							@if (session("newFolder") == 1 && checkmodule("MODULE_DELOVODNIK") == true)
								<p>
									{{-- Administracija foldera u zajedničkim dokumentima --}}
									{{trans('legacy/Header/podaciOLicenciModal.AdministracijaFoldera')}}
								</p>
							@endif

							{{-- modul Delovodnik --}}
							@if (session("newDocument") == 1 && checkmodule("MODULE_DELOVODNIK") == true)
								<p>
									{{-- Dodavanje dokumenata u zajedničkim dokumentima --}}
									{{trans('legacy/Header/podaciOLicenciModal.DodavanjeDokumenata')}}
								</p>
							@endif

							{{-- modul e-Fakture --}}
							@if (session("saMozeDaSalje") == 1 && checkmodule("MODULE_SELFADMIN") == true)
								<p>
									{{-- Fakture: Može da šalje --}}
									- {{trans('legacy/Header/podaciOLicenciModal.FaktureŠalje')}}
								</p>
							@endif

							{{-- modul e-Fakture --}}
							@if (session("saVidiPrimljene") == 1 && checkmodule("MODULE_SELFADMIN") == true)
								<p>
									{{-- Fakture: Vidi primljene --}}
									- {{trans('legacy/Header/podaciOLicenciModal.FakturePrima')}}
								</p>
							@endif
						{{-- @endif --}}

						<hr>

						<h5>
							{{-- Lista svih super administratora i administratora --}}
							{{trans('legacy/Header/podaciOLicenciModal.AllAdminList')}}:
						</h5>

                                @foreach ((session('allAdminOrSadmin') ?? []) as $item)
                                    @if ($item->role == 'SADMIN')
                                        {{-- {!! '<strong>Super Administrator</strong>' . " : " . $item->firstname.' '.$item->lastname.' ('.$item->username.')' !!}<br/> --}}
                                        {!! trans('legacy/Header/podaciOLicenciModal.SadminLoop') .
                                            ' : ' .
                                            $item->firstname .
                                            ' ' .
                                            $item->lastname .
                                            ' (' .
                                            $item->username .
                                            ')' !!}<br />
                                    @else
                                        {{-- {!! '<strong>Administrator</strong>' . " : " . $item->firstname.' '.$item->lastname.' ('.$item->username.')' !!}<br/> --}}
                                        {!! trans('legacy/Header/podaciOLicenciModal.AdminLoop') .
                                            ' : ' .
                                            $item->firstname .
                                            ' ' .
                                            $item->lastname .
                                            ' (' .
                                            $item->username .
                                            ')' !!}<br />
                                    @endif
                                @endforeach

                        @if(checkmodule('MODULE_KADROVIK') == 'Kadrovik' || checkmodule('MODULE_KADROVIK_LITE'))
						<hr>

						<h5>
							{{-- Lista svih korisnika sa HR privilegijama --}}
							Lista korisnika sa HR privilegijama
						</h5>
							@foreach((session("usersWithHRPrivileges") ?? []) as $item)
								@if($item->role == "SADMIN")
									{!! "Super Administrator" . " : " . $item->firstname . ' ' . $item->lastname . ' ('.$item->username.')' . (isset($item->archived) ? ($item->archived == 1 ? ('(' . trans('legacy/Content/ispravke.Settings.Arhiviran') . ')') : '') : '') !!}<br/>
								@elseif($item->role == "ADMIN")
									{!! "Administrator" . " : " . $item->firstname . ' ' . $item->lastname . ' ('.$item->username.')' . (isset($item->archived) ? ($item->archived == 1 ? ('(' . trans('legacy/Content/ispravke.Settings.Arhiviran') . ')') : '') : '') !!}<br/>
								@else
									{!! "Korisnik" . " : " . $item->firstname . ' ' . $item->lastname . ' ('.$item->username.')' . (isset($item->archived) ? ($item->archived == 1 ? ('(' . trans('legacy/Content/ispravke.Settings.Arhiviran') . ')') : '') : '') !!}<br/>
								@endif
							@endforeach
						@endif

						@if(checkmodule('MODULE_KADROVIK') == 'Kadrovik' || checkmodule('MODULE_KADROVIK_LITE'))
						<hr>

						<h5>
							{{-- Lista svih nadzornika za ulogovanog korisnika --}}
							Lista nadzornika
						</h5>
							@foreach((session("supervisors") ?? []) as $supervisorCollection)
								@foreach($supervisorCollection as $supervisor)
									{!! "Nadzornik" . " : " . $supervisor->firstname . ' ' . $supervisor->lastname . ' ('.$supervisor->defaultEmail.')' .  (isset($supervisor->archived) ? ($supervisor->archived == 1 ? ('(' . trans('legacy/Content/ispravke.Settings.Arhiviran') . ')') : '') : '') !!}<br/>
								@endforeach
							@endforeach

						@endif

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{-- Zatvori --}}
                    {{ trans('legacy/Header/podaciOLicenciModal.Zatvori') }}
                </button>
            </div>
        </div>
    </div>
</div>




<script>
    window.validateDefaultMessage = {
        required: "{{ trans('legacy/Content/ispravke.sveJSispravke.contactPreviewJS.obaveznoPolje') }}",
        email: "{{ trans('legacy/Content/ispravke.sveJSispravke.contactPreviewJS.obaveznoEmail') }}"
    };
    // jezik licence za js (session('CountryCode'))
    window.licenceCountryCode = "{{ strtolower(session('CountryCode')) }}";
    window.roundCut = false;
</script>
@if (config('legacy.app_server_production') == 'Principal')
    {{-- <script src="{{ asset('legacy/assets/js/header/header.js') }}" type="text/javascript"></script> --}}
    {{-- @vite('resources/js/header.js') --}}
@elseif(config('legacy.app_server_production') == 'Delovodnik')
    {{--    <input id="delLocaleJS" type="hidden" value="{{json_encode(trans('legacy/Header/kontaktFeedbackModal.locale'), JSON_UNESCAPED_UNICODE)}}"> --}}
    {{--    <script src="{{asset('legacy/assets/js/header/header_kancelarko.js') }}" type="text/javascript"></script> --}}
@endif
{{-- <script src="{{asset('legacy/assets/js/plugins/chosen/bootstrap-chosen.js') }}" type="text/javascript"></script> --}}

{{-- <script src="{{asset('legacy/assets/js/bootstrap-datepicker.sr-latin.js')}}" type="text/javascript"></script> --}}
<!-- <script>
    /**
     * Serbian latin translation for bootstrap-datetimepicker
     * Bojan Milosavlević <milboj@gmail.com>
     */
    ;
    (function($) {
        $.fn.datetimepicker.dates['rs'] = {

            days: ["{{ trans('legacy/dateTimePicker.days.Nedelja') }}",
                "{{ trans('legacy/dateTimePicker.days.Ponedeljak') }}",
                "{{ trans('legacy/dateTimePicker.days.Utorak') }}", "{{ trans('legacy/dateTimePicker.days.Sreda') }}",
                "{{ trans('legacy/dateTimePicker.days.Četvrtak') }}",
                "{{ trans('legacy/dateTimePicker.days.Petak') }}", "{{ trans('legacy/dateTimePicker.days.Subota') }}",
                "{{ trans('legacy/dateTimePicker.days.Nedelja') }}"
            ],
            daysShort: ["{{ trans('legacy/dateTimePicker.daysShort.Ned') }}",
                "{{ trans('legacy/dateTimePicker.daysShort.Pon') }}",
                "{{ trans('legacy/dateTimePicker.daysShort.Uto') }}",
                "{{ trans('legacy/dateTimePicker.daysShort.Sre') }}",
                "{{ trans('legacy/dateTimePicker.daysShort.Čet') }}",
                "{{ trans('legacy/dateTimePicker.daysShort.Pet') }}",
                "{{ trans('legacy/dateTimePicker.daysShort.Sub') }}",
                "{{ trans('legacy/dateTimePicker.daysShort.Ned') }}"
            ],
            daysMin: ["{{ trans('legacy/dateTimePicker.daysMin.N') }}", "{{ trans('legacy/dateTimePicker.daysMin.Po') }}",
                "{{ trans('legacy/dateTimePicker.daysMin.U') }}", "{{ trans('legacy/dateTimePicker.daysMin.Sr') }}",
                "{{ trans('legacy/dateTimePicker.daysMin.Č') }}", "{{ trans('legacy/dateTimePicker.daysMin.Pe') }}",
                "{{ trans('legacy/dateTimePicker.daysMin.Su') }}", "{{ trans('legacy/dateTimePicker.daysMin.N') }}"
            ],
            months: ["{{ trans('legacy/dateTimePicker.months.Januar') }}",
                "{{ trans('legacy/dateTimePicker.months.Februar') }}",
                "{{ trans('legacy/dateTimePicker.months.Mart') }}",
                "{{ trans('legacy/dateTimePicker.months.April') }}",
                "{{ trans('legacy/dateTimePicker.months.Maj') }}", "{{ trans('legacy/dateTimePicker.months.Jun') }}",
                "{{ trans('legacy/dateTimePicker.months.Jul') }}",
                "{{ trans('legacy/dateTimePicker.months.Avgust') }}",
                "{{ trans('legacy/dateTimePicker.months.Septembar') }}",
                "{{ trans('legacy/dateTimePicker.months.Oktobar') }}",
                "{{ trans('legacy/dateTimePicker.months.Novembar') }}",
                "{{ trans('legacy/dateTimePicker.months.Decembar') }}"
            ],
            monthsShort: ["{{ trans('legacy/dateTimePicker.monthsShort.Jan') }}",
                "{{ trans('legacy/dateTimePicker.monthsShort.Feb') }}",
                "{{ trans('legacy/dateTimePicker.monthsShort.Mar') }}",
                "{{ trans('legacy/dateTimePicker.monthsShort.Apr') }}",
                "{{ trans('legacy/dateTimePicker.monthsShort.Maj') }}",
                "{{ trans('legacy/dateTimePicker.monthsShort.Jun') }}",
                "{{ trans('legacy/dateTimePicker.monthsShort.Jul') }}",
                "{{ trans('legacy/dateTimePicker.monthsShort.Avg') }}",
                "{{ trans('legacy/dateTimePicker.monthsShort.Sep') }}",
                "{{ trans('legacy/dateTimePicker.monthsShort.Okt') }}",
                "{{ trans('legacy/dateTimePicker.monthsShort.Nov') }}",
                "{{ trans('legacy/dateTimePicker.monthsShort.Dec') }}"
            ],
            today: "{{ trans('legacy/dateTimePicker.today') }}",
            suffix: [],
            meridiem: [],
            clear: "{{ trans('legacy/dateTimePicker.clear') }}"
        };
    }(jQuery));
</script> -->

@if (session('module') == 'Delovodnik')
@endif



@if (session('realRole') == 'ADMIN' or session('realRole') == 'SADMIN')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#selectUserRole").val('{{ session('userRole') }}');
            $(".roleinfo").hide();
            $("#info{{ session('userRole') }}").show();
            $("#selectUserRole").change(function() {
                $(".roleinfo").hide();
                $("#info" + $(this).val()).show();
            });
        });
    </script>
@endif


@if (!empty(session('gost')))
    <script>
        $(".hidePlus").css({
            "background": "gray",
            "border": "1px solid gray",
            "opacity": "0.4",
        });

        $(".hideFromUser").addClass("disabled disableLinksEksterni");
    </script>
@endif

<script src="{{asset('legacy/assets/js/plugins/chosen/bootstrap-chosen.js') }}" type="text/javascript"></script>

<script src="{{asset('legacy/assets/js/global.js')}}" type="text/javascript"></script>
<script src=" {{ asset('legacy/assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('legacy/assets/js/kancelarkoNotifications.js')}}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


