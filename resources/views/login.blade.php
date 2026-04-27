<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rental Motor Jaya</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .input-field {
            width: 100%;
            padding: 10px 40px 10px 38px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            background: #f8fafc;
            color: #334155;
            transition: all 0.2s;
        }

        .input-field:focus {
            outline: none;
            border-color: #2563eb;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .btn-login {
            width: 100%;
            padding: 11px;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-login:hover {
            background: #1d4ed8;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
            transform: translateY(-1px);
        }

        .slide-up {
            animation: slideUp 0.4s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body
    class="min-h-screen bg-gradient-to-br from-blue-800 via-blue-700 to-blue-500
             flex items-center justify-center p-4">

    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-2xl overflow-hidden flex slide-up">

        {{-- Panel kiri --}}
        <div
            class="hidden md:flex w-5/12 flex-col justify-between p-8
                bg-gradient-to-b from-blue-700 to-blue-900 text-white">
            <div>
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center">
                        <span class="material-icons text-white text-[20px]">two_wheeler</span>
                    </div>
                    <div>
                        <p class="font-bold text-sm leading-tight">Rental Motor Jaya</p>
                        <p class="text-blue-200 text-[11px]">#BebasKemanaAja</p>
                    </div>
                </div>

                <h2 class="text-2xl font-bold leading-snug mb-2">
                    Panel Admin<br>Rental Motor
                </h2>
                <p class="text-blue-200 text-sm leading-relaxed mb-8">
                    Kelola motor, transaksi, dan data customer dari satu tempat.
                </p>

                <div class="space-y-2.5">
                    @php
                        $fitur = [
                            ['icon' => 'two_wheeler', 'label' => 'Kelola Motor'],
                            ['icon' => 'people', 'label' => 'Manajemen Customer'],
                            ['icon' => 'receipt_long', 'label' => 'Transaksi & Laporan'],
                        ];
                    @endphp

                    @foreach ($fitur as $f)
                        <div class="flex items-center gap-3 bg-white/10 rounded-lg px-3 py-2.5">
                            <span class="material-icons text-[18px] text-blue-200">{{ $f['icon'] }}</span>
                            <span class="text-sm text-blue-100">{{ $f['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Panel kanan --}}
        <div class="flex-1 px-7 py-10 flex flex-col justify-center">

            <div class="flex items-center gap-2 mb-6 md:hidden">
                <span class="material-icons text-blue-600 text-[24px]">two_wheeler</span>
                <span class="font-bold text-slate-800">Rental Motor Jaya</span>
            </div>

            <h1 class="text-2xl font-bold text-slate-800 mb-1">Selamat Datang</h1>
            <p class="text-sm text-slate-400 mb-6">Masuk ke halaman admin Rental Motor Jaya</p>

            @if (session('error'))
                <div
                    class="flex items-center gap-2 bg-red-50 border border-red-200
                        text-red-600 px-4 py-3 rounded-xl mb-4 text-sm">
                    <span class="material-icons text-[18px]">error_outline</span>
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div
                    class="flex items-center gap-2 bg-green-50 border border-green-200
                        text-green-600 px-4 py-3 rounded-xl mb-4 text-sm">
                    <span class="material-icons text-[18px]">check_circle_outline</span>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('proses.login') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Username --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Username
                    </label>
                    <div class="relative">
                        <span
                            class="material-icons absolute left-2.5 top-1/2 -translate-y-1/2
                                 text-slate-400 text-[20px]">
                            person_outline
                        </span>
                        <input type="text" name="username" class="input-field" placeholder="Masukkan username..."
                            value="{{ old('username') }}" autocomplete="off" required>
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Password
                    </label>
                    <div class="relative">
                        <span
                            class="material-icons absolute left-2.5 top-1/2 -translate-y-1/2
                                 text-slate-400 text-[20px]">
                            lock_outline
                        </span>
                        <input type="password" name="password" id="password" class="input-field"
                            placeholder="Masukkan password..." required>
                        <button type="button" onclick="togglePwd()"
                            class="absolute right-3 top-1/2 -translate-y-1/2
                                   text-slate-400 hover:text-slate-600">
                            <span class="material-icons text-[20px]" id="eyeIcon">visibility</span>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <span class="material-icons text-[19px]">login</span>
                    Masuk ke Dashboard
                </button>
            </form>

            <div class="mt-5 bg-amber-50 border border-amber-200 rounded-xl px-4 py-3 flex gap-2">
                <span class="material-icons text-amber-500 text-[18px] flex-shrink-0 mt-0.5">
                    info_outline
                </span>
                <p class="text-xs text-amber-700">
                    Isi username bebas, password minimal 1 karakter
                </p>
            </div>

        </div>
    </div>

    <script>
        function togglePwd() {
            const pwd = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                pwd.type = 'password';
                icon.textContent = 'visibility';
            }
        }
    </script>

</body>

</html>
