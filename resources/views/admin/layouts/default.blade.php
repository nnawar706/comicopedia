<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Laravel</title>

        <!-- custom fonts -->
        <link href="{{ asset('assets/css/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- stylesheet -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/pages.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/shuffle.css') }}" rel="stylesheet">
    </head>

    <body id="page-top">

        <div id="wrapper">

            <!-- Sidebar -->
            @include('admin.includes.general.sidebar')

            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <!-- Topbar -->
                    @include('admin.includes.general.topbar')

                    <!-- Page Content -->
                    @yield('content')

                </div>

                <footer class="container">
                    @include('admin.includes.general.footer')
                </footer>
            </div>

        </div>

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('assets/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- jsPDF -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.7.107/pdf.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>

        <!-- Custom scripts -->
        <script src="{{ asset('assets/js/admin-main.min.js') }}"></script>

        @stack('scripts')

        <script>
            window.onload = (event) => {
                let myAlert = document.querySelector('.toast');
                let bsAlert = new bootstrap.Toast(myAlert);

                setTimeout(function () {
                    bsAlert.show();
                }, 5000);
            };

            function showDiscount() {
                document.getElementById("releaseDiv").style.display = "none";
                document.getElementById("discountDiv").style.display = "block";
            }

            function showRelease() {
                document.getElementById("discountDiv").style.display = "none";
                document.getElementById("releaseDiv").style.display = "block";
            }

            function hideAll() {
                document.getElementById("discountDiv").style.display = "none";
                document.getElementById("releaseDiv").style.display = "none";
            }
        </script>
    </body>
</html>
