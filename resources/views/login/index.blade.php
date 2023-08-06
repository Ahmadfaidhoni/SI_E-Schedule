<!DOCTYPE html>
<html class="h-100" lang="en">

<style>
    body {
        font-family: "Helvetica Neue", "Open sans", sans-serif;
        background: #BE93C5;
        /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #7BC6CC, #BE93C5);
        /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #7BC6CC, #BE93C5);
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    .gradient-custom-2 {
        background: #BE93C5;
        /* fallback for old browsers */
        background: -webkit-linear-gradient(to left, #7BC6CC, #BE93C5);
        /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to left, #7BC6CC, #BE93C5);
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    @media (min-width: 768px) {
        .gradient-form {
            height: 100vh !important;
        }
    }

    @media (min-width: 769px) {
        .gradient-custom-2 {
            border-top-right-radius: .3rem;
            border-bottom-right-radius: .3rem;
        }
    }

</style>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login E-Schedule</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="h-100">
    @include('sweetalert::alert')
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-11">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-7 d-flex align-items-center gradient-custom-2">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                <img src="images/logo/logo1.png" width="400" height="400">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="card-body pt-5">
                                <div class="text-center">
                                    <h4>Login Form</h4>
                                    {{-- <img src="images/logo/logo.png" width="200px" height="200px"> --}}
                                </div>
                                {{-- @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (session()->has('loginError'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('loginError') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif --}}
                                <form action="/login" method="post" class="mt-4 mb-4 login-input">
                                    @csrf
                                    <div class="form-group">
                                        <input type="login" name="login" id="login"
                                            class="form-control @error('login') is-invalid @enderror"
                                            placeholder="Email or NIP" value="{{ old('login') }}" autofocus required>
                                        @error('login')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Password" required>
                                        @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <button class="btn login-form__btn submit w-100 mt-2">Sign In</button>
                                </form>
                                {{-- <p class="mt-5 login-form__footer">Dont have account?
                                    <a href="/register" class="text-primary">Sign Up</a> now
                                </p> --}}
                                <p class="mt-5 login-form__footer">
                                    {{-- button to open modal --}}
                                    <a href="#" data-toggle="modal" data-target="#exampleModal">
                                        Forgot Password
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
                    <button type="button" class="btn-close btn" data-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <p class="text-center font-weight-bold">Contact admin to reset your password </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary text-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
</body>

</html>
