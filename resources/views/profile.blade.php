<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <title>Profile - {{ Auth::User()->name }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" />

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">


    <!-- Main style file -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" type="text/css">
</head>

<body>
    <!-- preloader -->
    @include('layouts.preloader')
    <!-- ./ preloader -->

    <!-- menu -->
    @include('layouts.menu')
    <!-- ./  menu -->

    <!-- layout-wrapper -->
    <div class="layout-wrapper">

        <!-- header -->
        <div class="header">
            <div class="menu-toggle-btn"> <!-- Menu close button for mobile devices -->
                <a href="#">
                    <i class="bi bi-list"></i>
                </a>
            </div>
            <!-- Logo -->
            <a href="./dashboard.html" class="logo">
                <img width="100" src="{{ asset('assets/logo.png') }}" alt="logo">
            </a>
            <!-- ./ Logo -->
            <div class="page-title">Profile</div>
        </div>
        <!-- ./ header -->

        <!-- content -->
        <div class="content ">
        <form action="{{ route('profile.update', $user->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row flex-column-reverse flex-md-row">
                <div class="col-md-12">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel"
                            aria-labelledby="profile-tab">
                            <div class="mb-4">
                                <div class="d-flex flex-column align-items-center flex-md-row text-center text-md-start mb-3">
                                    <figure class="me-4 flex-shrink-0">
                                        <img width="50" class="rounded-pill" src="{{ $user->img_url }}"
                                            alt="...">
                                    </figure>
                                    <div class="flex-fill">
                                        <h5 class="mb-3">{{ $user->name }}</h5>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                    <small class="ms-3 mt-3">{{ session('success') }}</small>
                                    <div class="card-body">
                                        <h6 class="card-title mb-4">Basic Information</h6>
                                        <div class="row">
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Image URL</label>
                                                <input type="text" name="img_url" class="form-control" value="{{ old('img_url', $user->img_url) }}">
                                                <p class="small text-muted mt-3">*We still using url because we don't have cloud storage yet. So just upload your image to a cloud storage, then paste the image link here.</p>
                                                @error('img_url') <span>{{ $message }}</span> @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                                @error('name') <span>{{ $message }}</span> @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                                @error('email') <span>{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <button class="btn btn-success btn-icon" type="submit">
                                            <i class="bi bi-check-circle"></i> Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
        <!-- ./ content -->

        <!-- content-footer -->
        @include('layouts.footer')
        <!-- ./ content-footer -->

    </div>
    <!-- ./ layout-wrapper -->

    <!-- JQuery -->
    <script src="{{ asset('assets/libs/jquery-3.7.1.min.js') }}"></script>

    <!-- Nicescroll -->
    <script src="{{ asset('assets/libs/nicescroll.js') }}"></script>


    <!-- Main Javascript file -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
