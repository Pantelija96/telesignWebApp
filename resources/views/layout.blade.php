<!DOCTYPE html>
<html lang="en" data-color-theme="dark">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Telesign app - @yield('title')</title>

    <!-- Global stylesheets -->
    <link href="{{asset('/')}}assets/fonts/inter/inter.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}assets/icons/phosphor/styles.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}assets/css/all.min.css" id="stylesheet" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}assets/css/custom.css" id="stylesheet" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{asset('/')}}assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/notifications/noty.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/notifications/sweet_alert.min.js"></script>
    <script src="{{asset('/')}}assets/js/jquery/jquery.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    @yield('additionalThemeJS')
    <script src="{{asset('/')}}assets/js/app.js"></script>
    @yield('additionalPageJS')
<!-- /theme JS files -->

</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-dark navbar-expand-lg navbar-static border-bottom border-bottom-white border-opacity-10">
    <div class="container-fluid">
        <div class="d-flex d-lg-none me-2">
            <button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill">
                <i class="ph-list"></i>
            </button>
        </div>

        <div class="navbar-brand flex-1 flex-lg-0">
            <a href="{{url('/home/1')}}" class="d-inline-flex align-items-center">
                <img src="{{asset('/')}}assets/img/telesignBlueLogo.png" alt="Telesign blue logo" class="iconSize">
            </a>
        </div>



        <ul class="nav flex-row justify-content-end order-1 order-lg-2">

            <li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
                <a href="#" class="navbar-nav-link align-items-center rounded-pill p-1" data-bs-toggle="dropdown">
                    <i class="ph-user-square ph-2x me-1"></i><span class="d-lg-inline-block mx-lg-2">{{session()->get('user')->name." ".session()->get('user')->last_name}}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <a href="{{url('/profile')}}" class="dropdown-item @yield('profile')">
                        <i class="ph-user-circle me-2"></i>
                        My profile
                    </a>
                    <a href="{{url('/unsaved/1')}}" class="dropdown-item">
                        <i class="ph-warning-circle me-2"></i>
                        Unsaved projects
                        <span class="badge @if(session()->get('user')->unsaved_projects > 0) bg-warning @else bg-success @endif rounded-pill ms-auto">{{session()->get('user')->unsaved_projects}}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{url('/logout')}}" class="dropdown-item">
                        <i class="ph-sign-out me-2"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->


<!-- Page content -->
<div class="page-content">

    <!-- Main sidebar -->
    <div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

        <!-- Sidebar content -->
        <div class="sidebar-content">

            <!-- Sidebar header -->
            <div class="sidebar-section">
                <div class="sidebar-section-body d-flex justify-content-center">
                    <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navigation</h5>

                    <div>
                        <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                            <i class="ph-arrows-left-right"></i>
                        </button>

                        <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                            <i class="ph-x"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- /sidebar header -->


            <!-- Main navigation -->
            <div class="sidebar-section">
                <ul class="nav nav-sidebar" data-nav-type="accordion">

                    <!-- Main -->
                    <li class="nav-item">
                        <a href="{{url('/home/1')}}" class="nav-link @yield('homePage')">
                            <i class="ph-house"></i><span>Home</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('/newProject')}}" class="nav-link @yield('project')">
                            <i class="ph-list-plus"></i><span>New project</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('/unsaved/1')}}" class="nav-link @yield('unsaved')">
                            <i class="ph-archive"></i><span>Unsaved projects</span>
                            <span class="badge @if(session()->get('user')->unsaved_projects > 0) bg-warning @else bg-success @endif rounded-pill ms-auto">{{session()->get('user')->unsaved_projects}}</span>
                        </a>
                    </li>

                    @yield('tempMenuItem')
                </ul>
            </div>
            <!-- /main navigation -->

        </div>
        <!-- /sidebar content -->

    </div>
    <!-- /main sidebar -->


    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Inner content -->
        <div class="content-inner">

            <!-- Page header -->
            <div class="page-header page-header-light shadow">
                <div class="page-header-content d-lg-flex">
                    <div class="d-flex">
                        <h4 class="page-title mb-0">
                            @yield('pageTitle')
                        </h4>
                    </div>
                </div>

                <div class="page-header-content d-lg-flex border-top">
                    <div class="d-flex">
                        <div class="breadcrumb py-2">
                            <a href="{{url('/home/1')}}" class="breadcrumb-item"><i class="ph-house"></i></a>
                            @yield('breadcrumb')
                        </div>
                    </div>

                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">
                @yield('content')
            </div>
            <!-- /content area -->


            <!-- Footer -->
            <div class="navbar navbar-sm navbar-footer border-top">
                <div class="container-fluid">
                    <span>&copy; 2024 by <a href="https://www.s2d2.rs" target="_blank"><button class="s2d2-btn">S2D2</button></a></span>
                </div>
            </div>
            <!-- /footer -->

        </div>
        <!-- /inner content -->

    </div>
    <!-- /main content -->

</div>
<!-- /page content -->

@if(session('error'))
    <script>
        var errorMsg = "{{ session('error') }}";

        document.addEventListener('DOMContentLoaded', function() {
            Noty.overrideDefaults({
                theme: 'limitless',
                layout: 'topRight',
                type: 'alert',
                timeout: 2500
            });

            new Noty({
                text: errorMsg,
                type: 'error',
                modal: true
            }).show();
        });

    </script>
@endif
@if(session('errors'))

    <script>
        @foreach ($errors->all() as $error)
        document.addEventListener('DOMContentLoaded', function() {
            Noty.overrideDefaults({
                theme: 'limitless',
                layout: 'topRight',
                type: 'alert',
                timeout: 2500
            });

            new Noty({
                text: "{{ $error }}",
                type: 'error',
                modal: true
            }).show();
        });
        @endforeach
    </script>

@endif
@if(session('success'))
    <script>
        var errorMsg = "{{ session('success') }}";

        document.addEventListener('DOMContentLoaded', function() {
            Noty.overrideDefaults({
                theme: 'limitless',
                layout: 'topRight',
                type: 'alert',
                timeout: 2500
            });

            new Noty({
                text: errorMsg,
                type: 'success',
                modal: true
            }).show();
        });

    </script>
@endif
</body>
</html>
