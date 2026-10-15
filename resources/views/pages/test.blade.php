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
                    Test
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
        @foreach ($tables as $table)
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ $table['title'] }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <table id="tabela-{{ $table['id'] }}" class="table table-striped table-bordered table-hover table-checkable" data-order="{{ json_encode($table['order']) }}">
                        <thead>
                            <tr>
                                @foreach ($table['columns'] as $label)
                                    <th>{{ $label }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($table['rows'] as $row)
                                <tr>
                                    @foreach ($table['columns'] as $column => $label)
                                        <td>{{ $row[$column] ?? '' }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('footerjs')
<script type="text/javascript">
    var tabelaTest = function() {
        var initTable = function(selector) {
            var table = $(selector);
            table.DataTable({
                scrollX: true,
                responsive: false,
                "order": table.data('order'),
                "language": {
                    "lengthMenu": "Prikaži _MENU_ redova po strani",
                    "zeroRecords": "Nema pronađenih redova!",
                    "info": "Prikazano _START_ do _END_ od _TOTAL_ unosa",
                    "infoEmpty": "Nema unosa",
                    "infoFiltered": "(filtrirano od _MAX_ unosa)",
                    "sSearch": "Pretraga:",
                    "processing": "Molimo sačekajte ...",
                    "paginate": {
                        "first": "Prva",
                        "last": "Poslednja",
                        "next": "Sledeća",
                        "previous": "Prethodna"
                    }
                }
            });
        };
        return {
            init: function() {
                initTable('#tabela-otpremnice');
                initTable('#tabela-subjekti');
            }
        };
    }();

    jQuery(document).ready(function() {
        tabelaTest.init();
    });
</script>
@endsection
