<nav class="app-header navbar navbar-expand-lg bg-white shadow-sm border-bottom py-2">
    <div class="container-fluid px-4">
        <!-- Logo / Judul -->
        <a class="navbar-brand fw-semibold text-primary d-flex align-items-center gap-2" href="{{ route('admin.dashboard.index') }}">
            <i class="bi-terminal-dash"></i>
            Panel Admin
        </a>

        <!-- Toggle responsive -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTop"
            aria-controls="navbarTop" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu kanan -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarTop">
            <ul class="navbar-nav align-items-center gap-2">

                <!-- Fullscreen toggle -->
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="#" data-lte-toggle="fullscreen" title="Toggle Fullscreen">
                        <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen fs-5"></i>
                        <i data-lte-icon="minimize" class="bi bi-fullscreen-exit fs-5" style="display: none;"></i>
                    </a>
                </li>

                <!-- User Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-secondary" href="#" id="navbarUserDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle fs-5 me-1"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navbarUserDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person-lines-fill me-2"></i> Profil
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <!-- Logout menggunakan POST agar Laravel menerima request -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>
