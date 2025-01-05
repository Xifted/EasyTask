<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - EasyTask</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" />

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Main style file -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" type="text/css" />
</head>

<body class="auth">

    <!-- begin::preloader-->
    @include('layouts.preloader')
    <!-- end::preloader -->


    <div class="form-wrapper">
        <div class="container">
            <div class="card">
                <div class="row g-0">
                    <div class="col">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <div class="ltf-block-logo d-block d-lg-none text-center text-lg-start">
                                    <img width="60" src="{{ asset('assets/logo.svg')}}" alt="logo">
                                </div>
                                <div class="my-5 text-center text-lg-start">
                                    <h1 class="display-8">Create Account</h1>
                                    <p class="text-muted">You can create a free account now</p>
                                </div>
                                <form class="mb-5" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter fullname" autofocus required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Enter email" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Enter password" required>
                                    </div>
                                    <div class="text-center text-lg-start">
                                        <button class="btn btn-primary" type="submit">Sign Up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col d-none d-lg-flex border-start align-items-center justify-content-between flex-column text-center">
                        <div class="logo">
                            <img width="60" src="{{ asset('assets/favicon.png')}}" alt="logo">
                        </div>
                        <div>
                            <h3 class="fw-bold">Welcome to EasyTask</h3>
                            <p class="lead my-5">Do you already have an account?</p>
                            <a href="/login" class="btn btn-primary">Sign In</a>
                        </div>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#">Privacy Policy</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">Terms & Conditions</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- JQuery -->
    <script src="{{ asset('assets/libs/jquery-3.7.1.min.js') }}"></script>

    <!-- Main Javascript file -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>