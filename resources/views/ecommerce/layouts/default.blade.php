<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Laravel</title>

        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- stylesheet -->
        <link href="{{ asset('assets/css/ecommerce.css') }}" rel="stylesheet">

        @yield('styles')
    </head>

    <body>

        @if (isset($message))
        <div class="toast show fixed-bottom ms-auto text-bg-danger" style="--bs-bg-opacity: .8;" animation="true" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ $message }}
                </div>
            </div>
        </div>
        @endif

        <!-- Topbar -->
        @include('ecommerce.includes.general.topbar')

        <!-- Page Content -->
        @yield('content')

        <!-- Footer -->
        @include('ecommerce.includes.general.footer')

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

        @stack('scripts')

        <!-- Template Javascript -->
        <script src="{{ asset('assets/js/ecommerce.js') }}"></script>
        <script src="{{ asset('assets/js/easing/easing.min.js') }}"></script>
        <script src="{{ asset('assets/js/owlcarousel/owl.carousel.min.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

        <script>
            window.onload = (event) => {
                let myAlert = document.querySelector('.toast');
                let bsAlert = new bootstrap.Toast(myAlert);

                setTimeout(function () {
                    bsAlert.show();
                }, 5000);
            };
        </script>
    </body>
</html>
