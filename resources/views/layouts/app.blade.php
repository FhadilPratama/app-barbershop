<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'AdminLTE v4 | Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Vendor Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" crossorigin="anonymous">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">

    @stack('styles')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <div class="app-wrapper">
        @include('layouts.partials.header')
        @include('layouts.partials.sidebar')

        <main class="content-wrapper">
            @yield('content')
        </main>

        @include('layouts.partials.footer')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Session Success - Modern & Aesthetic
        @if(session('success'))
            Swal.fire({
                title: '<strong>🎉 Berhasil!</strong>',
                html: '{{ session('success') }}',
                icon: 'success',
                iconColor: '#4f46e5',
                showConfirmButton: true,
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#4f46e5',
                background: 'linear-gradient(135deg, #e0e7ff, #c7d2fe)',
                color: '#1f2937',
                customClass: {
                    popup: 'rounded-4 shadow-lg p-5 animate__animated animate__fadeInDown',
                    title: 'fw-bold fs-4 text-primary',
                    content: 'fs-6 text-gray-700',
                    confirmButton: 'btn btn-gradient px-4 py-2 rounded-pill fw-semibold shadow-sm'
                }
            });
        @endif

        // Validation Error Alert
        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal!',
                html: `
                    <ul style="text-align:left; font-size: 14px; color:#374151; padding-left: 1rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                confirmButtonColor: '#4f46e5',
                confirmButtonText: 'Oke',
                background: '#fff',
                color: '#111827',
                customClass: {
                    popup: 'rounded-4 shadow-lg p-4',
                    title: 'fw-bold text-primary',
                    content: 'text-secondary'
                }
            });
        @endif

        // Hapus confirmation
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form'); // ambil form terdekat
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    background: '#fff',
                    color: '#1f2937',
                    customClass: {
                        popup: 'rounded-4 shadow-lg p-4 animate__animated animate__fadeInDown',
                        title: 'fw-bold text-red-600',
                        content: 'text-gray-700',
                        confirmButton: 'btn btn-danger px-4 py-2 rounded-pill shadow-sm',
                        cancelButton: 'btn btn-light px-4 py-2 rounded-pill shadow-sm'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    @stack('scripts')
    @yield('scripts')
</body>
</html>
