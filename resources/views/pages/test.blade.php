@extends('legacy.layouts.layout')

@section('title')
    {{ config('app.name') }} - Test
@endsection

@section('content')
<div class="m-grid__item m-grid__item--fluid">
    <div class="m-subheader">
        <div class="d-lg-flex d-xl-flex align-items-lg-center align-items-xl-center">
            <div class="mr-auto col-sm-12 col-md-12 col-auto col-xl-auto col-lg-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Test strana
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item">
                        <a href="{{ route('test') }}" class="m-nav__link">
                            <span class="m-nav__link-text nlBlue">
                                Test
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="m-content">
    </div>
</div>
@endsection

@section('footerjs')
@endsection
