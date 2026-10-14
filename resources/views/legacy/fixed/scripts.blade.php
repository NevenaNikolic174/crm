
{{-- <script src="{{ asset('legacy/assets/js/jquery.min.js') }}"></script> --}}
{{-- <script src="{{ asset('legacy/assets/js/webfont.js') }}"></script> --}}
{{-- <script src="{{ asset('legacy/assets/js/sweetalert2.js') }}"></script> --}}
{{-- <script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> --}}

<script src="{{ asset('legacy/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('legacy/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>

{{-- DataTables --}}
<script src="{{ asset('legacy/assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('legacy/assets/demo/default/custom/crud/datatables/advanced/column-visibility.js') }}" type="text/javascript"></script>

{{-- Bootstrap Chosen --}}
{{-- <script src="{{ asset('legacy/assets/js/plugins/chosen/bootstrap-chosen.js') }}" type="text/javascript"></script> --}}

{{-- Bootstrap Datepicker --}}
<script src="{{ asset('legacy/assets/js/bootstrap-datepicker.sr-latin.js') }}" type="text/javascript"></script>


{{-- Vue and my app scripts --}}
{{-- <script src="{{ mix('js/app.js') }}"></script> --}}
{{-- @vite(['resources/js/header.js', 'resources/js/app.js']) --}}

<script type="text/javascript">
    $(window).on('load', function() {
        $('.app-loader-div').remove();
    });    
</script> 
