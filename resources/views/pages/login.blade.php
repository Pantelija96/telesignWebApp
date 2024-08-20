<!-- Does not have a parent layout -->
<!DOCTYPE html>
<html lang="en" dir="ltr" data-color-theme="dark">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Telesign web app 2.0</title>

    <!-- Global stylesheets -->
    <link href="{{asset('/')}}assets/fonts/inter/inter.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}assets/icons/phosphor/styles.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}assets/css/all.min.css" id="stylesheet" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}assets/css/custom.css" id="stylesheet" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{asset('/')}}assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/notifications/noty.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{asset('/')}}assets/js/app.js"></script>
    <!-- /theme JS files -->
</head>

<body>
<!-- Main navbar -->
<div class="navbar navbar-static py-2" style="background-color: #202125;">
    <div class="container-fluid">

        <div class="d-flex justify-content-end align-items-center ms-auto">
            <ul class="navbar-nav flex-row">
                <li class="nav-item">
                    <a href="#" class="navbar-nav-link navbar-nav-link-icon rounded ms-1">
                        <div class="d-flex align-items-center mx-md-1">
                            <i class="ph-lifebuoy"></i>
                            <span class="d-none d-md-inline-block ms-2">Support</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /main navbar -->


<!-- Page content -->
<div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Inner content -->
        <div class="content-inner">


            <!-- Content area -->
            <div class="content d-flex justify-content-center align-items-center">

                <!-- Login form -->
                <form class="login-form" action="{{route('log.in')}}" method="POST">
                    {{csrf_field()}}
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
                                    <img src="{{asset('/')}}assets/img/telesignBlueLogo.png" class="h-48px" alt="">
                                </div>
                                <h3 class="mb-0">Login to your account</h3>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="text" name="email" class="form-control" placeholder="Email">
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-envelope text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="password" name="password" class="form-control" placeholder="•••••••••••">
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-lock text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-telesign w-100">Sign in</button>
                            </div>

                            <div class="text-center">
                                <a href="#">Forgot password?</a>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /login form -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /inner content -->

    </div>

</div>

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
</body>
</html>
