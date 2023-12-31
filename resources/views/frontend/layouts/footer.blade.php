<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.easing.min.js') }}"></script>
<script src="{{ asset('frontend/js/classy-nav.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/scrollup.js') }}"></script>
<script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('frontend/js/jarallax.min.js') }}"></script>
<script src="{{ asset('frontend/js/jarallax-video.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('frontend/js/wow.min.js') }}"></script>
<script src="{{ asset('frontend/js/active.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap-notify.js') }}"></script>

<script>
    @if (Session::has('success'))
        $.notify("Success: {{ Session::get('success') }}", {
            animate: {
                enter: 'animated fadeInRight',
                exit: 'animated fadeOutRight'
            }
        })
    @endif
    @php
        Session::forget('error')
    @endphp
    @if (Session::has('error'))
        $.notify("Sorry: {{ Session::get('error') }}", {
            animate: {
                enter: 'animated fadeInRight',
                exit: 'animated fadeOutRight'
            }
        })
    @endif
    @php
        Session::forget('error')
    @endphp
</script>
<script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel();
    });
</script>
<script>
    setTimeout(function() {
        $('#alert').slideUp();
    }, 4000);
</script>

@yield('scripts')
