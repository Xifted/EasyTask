<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <title> Todo List - EasyTask </title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" />

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- quill -->
    <link href="{{ asset('assets/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css">

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
    @include('layouts.menu');
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
            <a href="/dashboard" class="logo">
                <img width="100" src="{{ asset('assets/favicon.png')}}" alt="logo">
            </a>
            <!-- ./ Logo -->
            <div class="page-title">Task List</div>
            <form class="search-form" method="GET" action="{{ route('dashboard.index') }}">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search..."
                        aria-label="Example text with button addon" aria-describedby="button-addon1" value="{{ request('search') }}">
                    <input type="hidden" name="order_by" value="{{ request('order_by', 'created_at') }}">
                    <input type="hidden" name="sort_order" value="{{ request('sort_order', 'desc') }}">
                    <button class="btn btn-outline-light" type="submit" id="button-addon1">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>            
            <div class="col-md-2">
                <a href="#" data-bs-toggle="modal" data-bs-target="#newTaskModal" title="Add New Task"
                    class="btn btn-primary btn-icon">
                    <i class="bi bi-plus-circle"></i> Add Task
                </a>
            </div>
        </div>
        <!-- ./ header -->

        <!-- content -->
        <form id="delete-form" method="POST" action="{{ route('dashboard.destroy', ['dashboard' => 0]) }}">
            @csrf
            @method('DELETE')

            <div class="row mb-4">
                <div class="col-md-6 d-flex">
                    <div class="me-3">
                        <div class="input-group">
                            <div class="input-group-text bg-white">
                                <input class="form-check-input todo-check-all mt-0" type="checkbox"
                                    aria-label="Checkbox for following text input">
                            </div>
                            <button type="button" class="btn btn-light bg-white" id="delete-selected">
                                Delete Selected
                            </button>
                        </div>
                    </div>
                    <div class="dropdown me-3">
                        <a href="#" class="btn bg-white dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bi bi-list-ul me-2"></i> Order by:
                            {{ $orderBy == 'created_at' ? 'Date' : 'Name' }}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item"
                                href="{{ route('dashboard.index', array_merge(request()->query(), ['order_by' => 'created_at', 'sort_order' => $sortOrder])) }}">
                                Date
                            </a>
                            <a class="dropdown-item"
                                href="{{ route('dashboard.index', array_merge(request()->query(), ['order_by' => 'name', 'sort_order' => $sortOrder])) }}">
                                Name
                            </a>
                        </div>
                    </div>
                    
                    <div class="dropdown">
                        <a href="#" class="btn bg-white dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bi bi-arrow-down-up me-2"></i> Sort: {{ ucfirst($sortOrder) }}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item"
                                href="{{ route('dashboard.index', array_merge(request()->query(), ['sort_order' => 'asc', 'order_by' => $orderBy])) }}">
                                Ascending
                            </a>
                            <a class="dropdown-item"
                                href="{{ route('dashboard.index', array_merge(request()->query(), ['sort_order' => 'desc', 'order_by' => $orderBy])) }}">
                                Descending
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="todo-list">
                <ul class="list-group">
                    @foreach ($tasks as $task)
                        <li class="list-group-item gap-3">
                            <div class="flex-shrink-0">
                                <input class="form-check-input task-checkbox" type="checkbox" name="task_ids[]"
                                    value="{{ $task->id }}">
                            </div>
                            <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                <div class="text-truncate">{{ $task->name }}</div>
                                <div class="dropdown">
                                    <a href="#" class="btn btn-floating btn-sm" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="{{ url('dashboard/'.$task->id)}}">View Detail</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center mt-4">
                    {{ $tasks->appends(request()->query())->links('pagination::bootstrap-4') }}
                </ul>
            </nav>
        </form>
        <form action="{{route('dashboard.store')}}" method="POST">
            @csrf
            <div class="modal fade" id="newTaskModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Task</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form autocomplete="off">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Task title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" class="form-control">
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

    <!-- Clockpicker -->
    <script src="{{ asset('assets/libs/clockpicker/bootstrap-clockpicker.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>

    <!-- Datepicker -->
    <script src="{{ asset('assets/libs/datepicker/daterangepicker.js') }}"></script>

    <!-- JQuery ui -->
    <script src="{{ asset('assets/libs/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Examples -->
    <script src="{{ asset('assets/js/examples/todo-list.js') }}"></script>

    <!-- Main Javascript file -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
