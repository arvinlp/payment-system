<!-- partial:partials/_footer.html -->
<footer
    class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
    <p class="text-muted mb-1 mb-md-0">@lang('Developed By Arvin Loripour')</a>.
    </p>
</footer>
<!-- partial -->

</div>
</div>
<!-- core:js -->
<script src="{{ asset('panel/vendors/core/core.js') }}"></script>
<!-- endinject -->
<!-- Vira -->

<!-- End Vira -->
<!-- Plugin js for this page -->
<script src="{{ asset('panel/vendors/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('panel/vendors/apexcharts/apexcharts.min.js') }}"></script>
<!-- End plugin js for this page -->

<!-- inject:js -->

<script src="{{ asset('panel/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ asset('panel/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('panel/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('panel/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('panel/js/persian-date-0.1.8.min.js') }}"></script>
<script src="{{ asset('panel/js/persian-datepicker-0.4.5.min.js') }}"></script>
<script src="{{ asset('panel/js/template.js') }}"></script>
<!-- endinject -->

<!-- Custom js for this page -->
<script src="{{ asset('panel/js/dashboard-light.js') }}"></script>
<!-- End custom js for this page -->
@yield('js')
<script>
    $(document).ready(function() {
        $('.page-wrapper>.page-content>.container-fluid').addClass('d-block');
        $('#SMMSpinner').addClass('d-none');
    });
</script>
</body>

</html>
