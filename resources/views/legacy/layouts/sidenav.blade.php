<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
    <div
        id="m_ver_menu"
        class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
        m-menu-vertical="1"
        m-menu-scrollable="0" m-menu-dropdown-timeout="500"
    >
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
            <li title="Test strana" class="m-menu__item {{ (Request::is('test')) ? ' m-menu__item--active' : '' }}" aria-haspopup="true" >
                <a href="{{ route('test') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon fa flaticon-list-3"></i>
                    <span class="m-menu__link-text">
                        <span class="sidebar-text menu" data-type="">
                            Test strana
                        </span>
                    </span>
                </a>
            </li>
            <li title="{{trans('legacy/Header/kontaktFeedback.Kontakt - Feedback')}}" class="m-menu__item" aria-haspopup="true" >
                <a href="javascript:;" onclick="window.dispatchEvent(new CustomEvent('open-feedback-modal'))" class="m-menu__link showToGuest feedback-trigger">
                    <i class="m-menu__link-icon flaticon-support"></i>
                    <span class="m-menu__link-text sidebar-text">
                        {{trans('legacy/Header/kontaktFeedback.Kontakt - Feedback')}}
                    </span>
                </a>
            </li>

            <li class="m-menu__item" m-menu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true" id="videoUputstvaShow">
                <a href="javascript:;" class="m-menu__link m-menu__toggle showToGuest feedback-trigger">
                    <i class="m-menu__link-icon fa fa-youtube-play" aria-hidden="true"></i>
                    <span class="m-menu__link-text sidebar-text">
                        {{trans('legacy/Header/kontaktFeedback.Video uputstva')}}
                    </span>
                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item" aria-haspopup="true">
                            <span class="m-menu__link">
                                <a href="https://www.youtube.com/watch?v=8oaMT9Ef7RA" target="_blank" class="m-menu__link" id="eArhUputstva">
                                    <span class="m-menu__link-text sidebar-text">
                                        {{trans('legacy/Header/kontaktFeedback.uputstvaElektronskoArhiviranje')}}
                                    </span>
                                </a>
                            </span>
                        </li>
                        <li class="m-menu__item" aria-haspopup="true">
                            <span class="m-menu__link">
                                <a href="https://www.paragraf.rs/kancelarko/uputstvo-za-pocetak-rada-kancelarko.html" target="_blank" class="m-menu__link " id="eFakUputstva">
                                    <span class="m-menu__link-text">
                                        {{trans('legacy/Header/kontaktFeedback.uputstvaFakture')}}
                                    </span>
                                </a>
                            </span>
                        </li>
                        <li class="m-menu__item" aria-haspopup="true">
                            <span class="m-menu__link">
                                <a href="https://www.paragraf.rs/kancelarko/uputstvo-za-pocetak-rada-kancelarko.html#pocetak-rada-edelovodnik" target="_blank" class="m-menu__link " id="eDelUputstva">
                                    <span class="m-menu__link-text">
                                        {{trans('legacy/Header/kontaktFeedback.uputstvaDelovodnik')}}
                                    </span>
                                </a>
                            </span>
                        </li>
                        <li class="m-menu__item "  aria-haspopup="true">
                            <a href="https://www.paragraf.rs/kancelarko/uputstvo-za-pocetak-rada-kancelarko.html#pocetak-rada-kadrovik" target="_blank"  class="m-menu__link ">
                                <span class="m-menu__link-text">
                                    {{trans('legacy/Header/kontaktFeedback.uputstvaKadrovik')}}
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item" aria-haspopup="true">
                            <span class="m-menu__link">
                                <a href="javascript:" class="m-menu__link " id="videoUputstva">
                                    <span class="m-menu__link-text">
                                        {{trans('legacy/Header/kontaktFeedback.uputstvaStranica')}}
                                    </span>
                                </a>
                            </span>
                        </li>

                        <li class="m-menu__item "  aria-haspopup="true">
                            <a  href="https://www.youtube.com/watch?v=OYZWDYr7FAE" target="_blank"  class="m-menu__link "  id="eArhUputstva">
                                <span class="m-menu__link-text">
                                    {{trans('legacy/Header/kontaktFeedback.uputstvaArhivskaKnjiga')}}
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item "  aria-haspopup="true">
                            <a  href="https://www.youtube.com/watch?v=qvGXT-OBIpU" target="_blank"  class="m-menu__link "  id="eArhObuka">
                                <span class="m-menu__link-text">
                                    {{trans('legacy/Header/kontaktFeedback.obukaElArhiv')}}
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li title="Kancelarko Viber Community" class="m-menu__item" aria-haspopup="true" id="kancelarkoViber">
                <a href="https://invite.viber.com/?g2=AQBjMlT5Yos8Rk0yujbyIJNI8cuKnB4BzCtbKHbsSrjM7OF%2B84RlGnsE%2BmiiPWYI" class="m-menu__link " target="_blank">
                    <img style="width: 100%;" src="{{ asset('legacy/assets/images/Viber-zajednica-reklama-FB-2.jpg') }}" alt="Sidebar/all.Kancelarko viber community" />
                </a>
            </li>
        </ul>
    </div>
</div>
