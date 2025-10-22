<aside class="app-sidebar bg-body-secondary shadow p-3" data-bs-theme="dark">
    <!-- Brand Logo -->
    <div class="sidebar-brand p-3 d-flex align-items-center">
        <a href="{{ route('admin.dashboard.index') }}" class="brand-link d-flex align-items-center text-decoration-none">
            <img src="{{ asset('dist/assets/img/AdminLTELogo.png') }}" 
                 alt="AdminLTE Logo"
                 class="brand-image me-2 rounded shadow"
                 style="width: 40px; height: 40px; object-fit: cover">
            <span class="brand-text fw-semibold fs-5 text-white">Barbershop Admin</span>
        </a>
    </div>

    <!-- Menu -->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav flex-column" role="menu">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard.index') }}" class="nav-link d-flex align-items-center px-3 py-2">
                        <i class="bi bi-speedometer2 me-2 fs-5"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Layanan -->
                <li class="nav-item">
                    <a href="{{ route('admin.layanan.index') }}" class="nav-link d-flex align-items-center px-3 py-2">
                        <i class="bi bi-scissors me-2 fs-5"></i>
                        <span>Layanan</span>
                    </a>
                </li>

                <!-- Booking -->
                <li class="nav-item">
                    <a href="{{ route('admin.booking.index') }}" class="nav-link d-flex align-items-center px-3 py-2">
                        <i class="bi bi-calendar-check me-2 fs-5"></i>
                        <span>Booking</span>
                    </a>
                </li>

                <!-- Pembayaran -->
                <li class="nav-item">
                    <a href="{{ route('admin.pembayaran.index') }}" class="nav-link d-flex align-items-center px-3 py-2">
                        <i class="bi bi-cash-stack me-2 fs-5"></i>
                        <span>Pembayaran</span>
                    </a>
                </li>

                <!-- Antrean -->
                <li class="nav-item">
                    <a href="{{ route('admin.antrean.index') }}" class="nav-link d-flex align-items-center px-3 py-2">
                        <i class="bi bi-people-fill me-2 fs-5"></i>
                        <span>Antrean</span>
                    </a>
                </li>

                <!-- Membership -->
                <li class="nav-item">
                    <a href="{{ route('admin.membership.index') }}" class="nav-link d-flex align-items-center px-3 py-2">
                        <i class="bi bi-person-badge me-2 fs-5"></i>
                        <span>Membership</span>
                    </a>
                </li>

                <!-- Promo -->
                <li class="nav-item">
                    <a href="{{ route('admin.promo.index') }}" class="nav-link d-flex align-items-center px-3 py-2">
                        <i class="bi bi-gift me-2 fs-5"></i>
                        <span>Promo</span>
                    </a>
                </li>

                <!-- Poin -->
                <li class="nav-item">
                    <a href="{{ route('admin.point.index') }}" class="nav-link d-flex align-items-center px-3 py-2">
                        <i class="bi bi-coin me-2 fs-5"></i>
                        <span>Poin</span>
                    </a>
                </li>

                <!-- Notifikasi -->
                <li class="nav-item">
                    <a href="{{ route('admin.notifikasi.index') }}" class="nav-link d-flex align-items-center px-3 py-2">
                        <i class="bi bi-bell me-2 fs-5"></i>
                        <span>Notifikasi</span>
                    </a>
                </li>

                <!-- Laporan -->
                <li class="nav-item">
                    <a href="{{ route('admin.laporan.index') }}" class="nav-link d-flex align-items-center px-3 py-2">
                        <i class="bi bi-graph-up me-2 fs-5"></i>
                        <span>Laporan</span>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
