<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Flexy lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Flexy admin lite design, Flexy admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Flexy Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Dashboard</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/Flexy-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('absen') }}/assets/images/favicon.png">
    <!-- Custom CSS -->
    <link href="{{ asset('absen') }}/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="{{ asset('absen') }}/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css"
        rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <link href="{{ asset('absen') }}/dist/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
</head>
<style>
    .sidebar-nav ul .sidebar-item.selected>.sidebar-link {
        background-color: #4cb162;
    }
</style>

<body>


    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" data-logobg="skin6">

                    <a class="navbar-brand" href="{{ url('/') }}">
                        <!-- Logo icon -->
                        <b class="logo-icon" style="text-align: center;">
                            <!-- Dark Logo icon -->
                            <img src="../assets/images/logo_absen-removebg-preview.png" alt="homepage" class="dark-logo"
                                style="width: 80px; height: auto;" />
                        </b>



                    </a>

                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="mdi mdi-menu"></i></a>
                </div>

                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">

                    <ul class="navbar-nav float-start me-auto">


                    </ul>

                    <ul class="navbar-nav float-end">


                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/') }}"
                                aria-expanded="false">
                                <i class="fas fa-tachometer-alt ps-3" style="font-size: 20px; margin-right: 10px;"></i>
                                <span class="hide-menu" style="margin-left: 5px;">Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/absensi') }}"
                                aria-expanded="false">
                                <i class="fas fa-file-lines ps-3" style="font-size: 20px; margin-right: 10px;"></i>
                                <span class="hide-menu" style="margin-left: 5px;">Data Absen</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/siswa') }}"
                                aria-expanded="false">
                                <i class="fa fa-plus ps-3" style="font-size: 20px; margin-right: 10px;"></i>
                                <span class="hide-menu" style="margin-left: 5px;">Tambah Data Siswa</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            {{-- <a class="sidebar-link waves-effect waves-dark sidebar-link" href="login.html"
                                aria-expanded="false">
                                <i class=" fa fa-sign-out ps-3"
                                    style="font-size: 20px; margin-right: 10px;"></i>
                                <span class="hide-menu" style="margin-left: 5px;">Logout</span>
                            </a> --}}
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="sidebar-link waves-effect waves-dark sidebar-link"
                                    aria-expanded="false">
                                    <i class=" fa fa-sign-out ps-3" style="font-size: 20px; margin-right: 10px;"></i>
                                    <span class="hide-menu" style="margin-left: 5px;">Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>

                </nav>

            </div>

        </aside>

        <div class="page-wrapper">

            <div class="container-fluid">
                @yield('content')
            </div>

            <footer class="footer text-center">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-center small text-center">
                        <div class="text-muted">Copyright &copy; PPLG Programmer Team. All rights reserved.</div>
                    </div>
                </div>
            </footer>

        </div>


    </div>

    <script src="{{ asset('absen') }}/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('absen') }}/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('absen') }}/dist/js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="{{ asset('absen') }}/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('absen') }}/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('absen') }}/dist/js/custom.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="{{ asset('absen') }}/assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="{{ asset('absen') }}/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="{{ asset('absen') }}/dist/js/pages/dashboards/dashboard1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $('#table').DataTable()
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> --}}
</body>

</html>
