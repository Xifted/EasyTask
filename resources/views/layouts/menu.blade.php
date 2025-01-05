<div class="menu">
    <div class="menu-header">
        <a href="./dashboard.html" class="menu-header-logo">
            <img src="{{ asset('assets/favicon.png') }}" alt="logo">
            <span>EasyTask</span>
        </a>
        <a href="#" class="btn btn-sm menu-close-btn">
            <i class="bi bi-x"></i>
        </a>
    </div>
    <div class="menu-body">
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center" data-bs-toggle="dropdown">
                <div class="avatar me-3">
                    <img src="{{ Auth::User()->img_url }}" class="rounded-circle" alt="image">
                </div>
                <div>
                    <div class="fw-bold">{{ Auth::User()->name }}</div>
                    <small class="text-muted">{{ Auth::User()->level_id === 1 ? 'Admin' : 'User' }}</small>
                </div>
            </a>

            <div class="dropdown-menu dropdown-menu-end">
                <a href="#" class="dropdown-item d-flex align-items-center">
                    <i class="bi bi-person dropdown-item-icon"></i> Profile
                </a>
                <a href="#" class="dropdown-item d-flex align-items-center">
                    <i class="bi bi-envelope dropdown-item-icon"></i> Inbox
                </a>
                <a href="#" class="dropdown-item d-flex align-items-center" data-sidebar-target="#settings">
                    <i class="bi bi-gear dropdown-item-icon"></i> Settings
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="dropdown-item d-flex align-items-center text-danger"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right dropdown-item-icon"></i> Logout
                </a>
            </div>
        </div>
        <ul>
            <li>
                <a href="/dashboard" class="{{ Request::path() == 'dashboard' || Request::path() == 'todo' || Request::path() == 'task' ? 'active' : '' }}">
                    <span class="nav-link-icon">
                        <i class="bi bi-check-circle"></i>
                    </span>
                    <span>Task List</span>
                </a>
            </li>
            <li>
                <a href="/profile" class="{{ Request::path() == 'profile' ? 'active' : '' }}">
                    <span class="nav-link-icon">
                        <i class="bi bi-gear"></i>
                    </span>
                    <span>Profile</span>
                </a>
            </li>

            {{-- Admin Only --}}
            @if (Auth::user()->isAdmin())
                <li>
                    <a href="/user-list" class="{{ Request::path() == 'user-list' ? 'active' : '' }}">
                        <span class="nav-link-icon">
                            <i class="bi bi-person-circle"></i>
                        </span>
                        <span>User List</span>
                    </a>
                </li>
            @endif

        </ul>
    </div>
</div>