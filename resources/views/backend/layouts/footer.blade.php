<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('backend/js/jquery.easing.min.js') }}"></script>
<!-- Custom scripts for all pages-->
<script src="{{ asset('backend/js/sb-admin-2.js') }}"></script>
<!-- Page level plugins -->
<script src="{{ asset('backend/js/Chart.min.js') }}"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('backend/js/chart-area-demo.js') }}"></script>
<script src="{{ asset('backend/js/chart-pie-demo.js') }}"></script>
<script src="{{ asset('backend/js/datatable.js') }}"></script>
<script src="{{ asset('backend/js/table.js') }}"></script>
<!-- summernote -->
<script src="{{ asset('backend/summernote/summernote.js') }}"></script>

@yield('scripts')

<script>
    setTimeout(function() {
        $('#alert').slideUp();
    }, 4000);
</script>