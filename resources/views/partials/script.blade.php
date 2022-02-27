<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery.bootstrap-touchspin.js') }}"></script>
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<script src="{{ asset('js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/jquery.scrollTo.js') }}"></script>
<script src="{{ asset('js/tilt.jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.paroller.min.js') }}"></script>
<script src="{{ asset('js/parallax.min.js') }}"></script>
<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('js/appear.js') }}"></script>
<script src="{{ asset('js/owl.js') }}"></script>
<script src="{{ asset('js/wow.js') }}"></script>
<script src="{{ asset('js/mixitup.js') }}"></script>
<script src="{{ asset('js/swiper.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>
<script src="{{ asset('js/axios-loader.js') }}"></script>
<script src="{{ asset('js/notiflix.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('js/nouislider.js') }}"></script>
<script src="{{ asset('sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>

<script>
    $('[x-ref="postLink"]').on('click', function() {
        localStorage.setItem('_x_currentTab', '"post"');
    });

    $('[x-ref="treadLink"]').on('click', function() {
        localStorage.setItem('_x_currentTab', '"tread"');
    });

    $('[x-ref="propertyLink"]').on('click', function() {
        localStorage.setItem('_x_currentTab', '"property"');
    });

    $('[x-ref="galleryLink"]').on('click', function() {
        localStorage.setItem('_x_currentTab', '"gallery"');
    });

    $('[x-ref="productLink"]').on('click', function() {
        localStorage.setItem('_x_currentTab', '"product"');
    });

    $('[x-ref="vendorLink"]').on('click', function() {
        localStorage.setItem('_x_currentTab', '"edit"');
    });

    $('[x-ref="orderLink"]').on('click', function() {
        localStorage.setItem('_x_currentTab', '"order"');
    });
</script>

<script type="text/javascript">
    window.addEventListener('show-form', event => {
        $('#form').modal('show');
    })
</script>
<script>
    @if(Session::has('messege'))
        var type="{{Session::get('alert-type','success')}}"
        switch(type){
            case 'info':
            Notiflix.Notify.Info("{{ Session::get('messege') }}");
                break;
            case 'success':
            Notiflix.Notify.Success("{{ Session::get('messege') }}");
                break;
            case 'warning':
            Notiflix.Notify.Warning("{{ Session::get('messege') }}");
                break;
            case 'error':
            Notiflix.Notify.Failure("{{ Session::get('messege') }}");
                break;
        }
    @endif
</script>

<script>
     $(function () {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            alwaysShowClose: true
        });
        });

        $('.filter-container').filterizr({gutterPixels: 3});
        $('.btn[data-filter]').on('click', function() {
        $('.btn[data-filter]').removeClass('active');
        $(this).addClass('active');
        });
    })
</script>

<script>
    $(document).ready(function () {
        toastr.options = {
            "positionClass": "toast-top-right",
            "progressBar": true
        }


        window.addEventListener('alert', event => {
          toastr.success(event.detail.message, 'Success!');
       });

       window.addEventListener('error', event => {
          toastr.error(event.detail.message, 'Failed!');
       });
    })
</script>


@stack('modals')
@stack('scripts')

{{-- Blade UI Kit --}}
@bukScripts(true)
