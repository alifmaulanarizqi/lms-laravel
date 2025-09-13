<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dashboard</title>
    <!-- CSS files -->
    <link href="{{ asset('admin/assets/dist/css/tabler.min.css?169287048') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/dist/css/demo.min.css?1692870487') }}" rel="stylesheet" />
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
    @vite(['resources/css/admin.css', 'resources/js/admin/admin.js'])
</head>

<body>
    <script src="{{ asset('admin/assets/dist/js/demo-theme.min.js?1692870487') }}"></script>
    <div class="page">

        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Navbar -->
        @include('admin.layouts.header')

        <div class="page-wrapper">
            <!-- Content -->
            @yield('content')

            <!-- Footer -->
            @include('admin.layouts.footer')

        </div>
    </div>
    <!-- Modals -->
    @include('admin.layouts.delete-modal')

    <!-- Tabler Core -->
    <script src="{{ asset('admin/assets/dist/js/tabler.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('admin/assets/dist/js/demo.min.js?1692870487') }}" defer></script>

    <!--jquery library js-->
    <script src="{{ asset('frontend/assets/js/jquery-3.7.1.min.js') }}"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Toast Notifications -->
    <script>
        // Configure toastr options
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        // Show toast notifications from Laravel session (with back button prevention)
        function showToastOnce(type, message, sessionKey) {
            // Create a unique key for this toast based on timestamp and message
            const toastKey = sessionKey + '_' + Date.now();

            // Check if we've already shown a toast for this session
            const lastToastKey = sessionStorage.getItem('lastToast_' + sessionKey);

            // Only show if this is a new toast (different timestamp/session)
            if (!lastToastKey || performance.navigation.type !== 2) { // type 2 = back/forward navigation
                toastr[type](message);
                sessionStorage.setItem('lastToast_' + sessionKey, toastKey);
            }
        }

        // Initialize toasts when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                showToastOnce('success', '{{ session('success') }}', 'success');
            @endif

            @if (session('error'))
                showToastOnce('error', '{{ session('error') }}', 'error');
            @endif

            @if (session('info'))
                showToastOnce('info', '{{ session('info') }}', 'info');
            @endif

            @if (session('warning'))
                showToastOnce('warning', '{{ session('warning') }}', 'warning');
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    console.log('Validation error found:', '{{ $error }}'); // Debug log
                    showToastOnce('error', '{{ $error }}', 'validation_error_{{ $loop->index }}');
                @endforeach
            @endif
        });
    </script>
</body>

</html>
