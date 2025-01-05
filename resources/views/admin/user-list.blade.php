<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <title>User List - EasyTask</title>

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
            <div class="page-title">Users</div>
        </div>
        <!-- ./ header -->

        <!-- content -->
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex gap-4 align-items-center">
                        <div class="d-none d-md-flex">All Users</div>
                        <div class="d-md-flex gap-4 align-items-center">
                            <form class="mb-3 mb-md-0" method="GET" action="{{ route('user-list.index') }}">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <select class="form-select" name="sort_order" onchange="this.form.submit()">
                                            <option value="asc"
                                                {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Asc</option>
                                            <option value="desc"
                                                {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Desc</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-select" name="per_page" onchange="this.form.submit()">
                                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10
                                            </option>
                                            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20
                                            </option>
                                            <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30
                                            </option>
                                            <option value="40" {{ request('per_page') == 40 ? 'selected' : '' }}>40
                                            </option>
                                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search"
                                                value="{{ request('search') }}" placeholder="Search">
                                            <button class="btn btn-outline-light" type="submit">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="users" class="table table-custom table-lg">
                    <thead>
                        <tr>
                            <th>
                                <input class="form-check-input select-all" type="checkbox"
                                    data-select-all-target="#users" id="defaultCheck1">
                            </th>
                            <th>Image</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <input class="form-check-input" type="checkbox">
                                </td>
                                <td>
                                    <a href="#">
                                        <figure class="avatar me-3">
                                            <img src="{{ $user->img_url }}" class="rounded-circle" alt="avatar">
                                        </figure>
                                    </a>
                                </td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->level->name_level }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td class="text-end">
                                    <form action="{{ route('user-list.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="level_id" class="form-select" onchange="this.form.submit()">
                                            @foreach ($userLevels as $level)
                                                <option value="{{ $level->id }}"
                                                    {{ $user->level_id == $level->id ? 'selected' : '' }}>
                                                    {{ $level->name_level }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <nav class="mt-4" aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    {{ $users->links('pagination::bootstrap-4') }}
                </ul>
            </nav>

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

    <!-- Examples -->
    <script src="{{ asset('assets/js/examples/users.js') }}"></script>

    <!-- Main Javascript file -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
