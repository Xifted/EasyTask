<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <title> Todo Detail - {{ $taskDetails->title }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" />

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- quill -->
    <link href="../libs/quill/quill.snow.css" rel="stylesheet" type="text/css">

    <!-- Clockpicker -->
    <link rel="stylesheet" href="{{ asset('assets/libs/clockpicker/bootstrap-clockpicker.min.css') }}" type="text/css">

    <!-- Datepicker -->
    <link rel="stylesheet" href="{{ asset('assets/libs/datepicker/daterangepicker.css') }}" type="text/css">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}" type="text/css">

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
                <img width="100" src="../logo.png" alt="logo">
            </a>
            <!-- ./ Logo -->
            <div class="page-title">Task Detail</div>
        </div>
        <!-- ./ header -->

        <!-- content -->
        <div class="content ">

            <div class="card">
                <div class="card-body">
                    <a href="{{ url('dashboard/' . $taskDetails->task_id)}}"><-Back</a>
                    <div class="d-lg-flex justify-content-between mb-4">
                        <h3 class="mb-3 mb-lg-0">{{ $taskDetails->title }}</h3>
                    </div>
                    <div class="d-md-flex align-items-center mb-4">
                        <div class="mt-2 mt-md-0 d-flex align-items-center gap-3">
                            <span class="badge bg-primary badge-pill">{{ $taskDetails->status_name }}</span>
                            <span class="text-muted">Due at: {{ $taskDetails->deadline }}</span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p>{{ $taskDetails->description }}</p>
                    </div>
                    <button data-bs-toggle="modal" data-bs-target="#newTaskModal" class="btn btn-primary">Edit</button>
                </div>
            </div>

            <form action="{{ url('task-details/update/' . $taskDetailId) }}" method="POST">
                @csrf
                <div class="modal fade" id="newTaskModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Task</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form autocomplete="off">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Task title</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="title" class="form-control"
                                                value="{{ $taskDetails->title }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Deadline</label>
                                        <div class="col-sm-9">
                                            <input type="datetime-local" name="deadline" class="form-control"
                                                value="{{ \Carbon\Carbon::parse($taskDetails->deadline)->format('Y-m-d\TH:i') }}">
                                        </div>
                                    </div>                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Status</label>
                                        <div class="col-sm-9">
                                            <select class="form-select" name="status">
                                                @foreach ($taskStatus as $status)
                                                    <option value="{{ $status->id }}"
                                                        {{ $taskDetails->status_id == $status->id ? 'selected' : '' }}>
                                                        {{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" rows="6" name="description">{{ $taskDetails->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                </form>
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

    <!-- Quill -->
    <script src="{{ asset('assets/libs/quill/quill.js') }}"></script>

    <!-- Clockpicker -->
    <script src="{{ asset('assets/libs/clockpicker/bootstrap-clockpicker.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>

    <!-- Datepicker -->
    <script src="{{ asset('assets/libs/datepicker/daterangepicker.js') }}"></script>

    <!-- Examples -->
    <script src="{{ asset('assets/js/examples/todo-list.js') }}"></script>

    <!-- Main Javascript file -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
