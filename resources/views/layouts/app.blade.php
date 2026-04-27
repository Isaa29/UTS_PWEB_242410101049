<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rental Motor Jaya')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        .nav-item.active {
            background-color: #eff6ff;
            color: #2563eb;
            border-right: 3px solid #2563eb;
        }
        .nav-item.active .material-icons { color: #2563eb; }
        .nav-item:not(.active):hover { background-color: #f8fafc; }

        .page-enter { animation: enterPage 0.3s ease; }
        @keyframes enterPage {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

        .modal-wrap { background: rgba(0,0,0,0.5); }
    </style>

    @yield('extra-css')
</head>

<body class="bg-slate-100 text-slate-700 min-h-screen">
<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    @include('components.sidebar')

    <div class="flex-1 flex flex-col min-h-screen lg:ml-60">

        {{-- NAVBAR --}}
        <x-navbar :username="$username ?? 'Admin'" />

        <main class="flex-1 p-5 lg:p-6 mt-14 page-enter">
            @yield('content')
        </main>

        {{-- FOOTER --}}
        <x-footer />

    </div>
</div>

<script>
    function bukaMenu() {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
        document.getElementById('overlay').classList.toggle('hidden');
    }
</script>

@yield('extra-js')
</body>
</html>
