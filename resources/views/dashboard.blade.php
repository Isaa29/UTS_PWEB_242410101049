@extends('layouts.app')

@section('title', 'Dashboard - Rental Motor Jaya')
@section('page-title', 'Dashboard')

@section('content')

    <div
        class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl p-5 mb-5
            flex flex-col sm:flex-row items-center justify-between gap-4 relative overflow-hidden">

        <div class="text-white relative z-10">
            <p class="text-blue-200 text-sm mb-0.5">Selamat datang kembali,</p>
            <h1 class="text-2xl font-bold mb-1">{{ $username }}</h1>
            <p class="text-blue-200 text-sm flex items-center gap-1">
                <span class="material-icons text-[16px]">event</span>
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </p>
        </div>

        <div class="relative z-10 opacity-80">
            <svg width="110" height="65" viewBox="0 0 110 65" fill="none">
                <circle cx="24" cy="50" r="12" stroke="white" stroke-width="3.5" fill="none" />
                <circle cx="86" cy="50" r="12" stroke="white" stroke-width="3.5" fill="none" />
                <path d="M36 50 L46 50 L46 34 L62 30 L76 30 L74 50 M46 34 L32 34 L28 46" stroke="white" stroke-width="3.5"
                    stroke-linecap="round" stroke-linejoin="round" />
                <path d="M62 30 L66 22 L78 22" stroke="white" stroke-width="3" stroke-linecap="round" />
                <path d="M76 30 L88 40 L86 50" stroke="white" stroke-width="3.5" stroke-linecap="round" />
            </svg>
        </div>

        <div class="absolute -right-8 -top-8 w-40 h-40 rounded-full bg-white/5"></div>
        <div class="absolute -left-4 -bottom-8 w-32 h-32 rounded-full bg-white/5"></div>
    </div>

    <div class="grid grid-cols-2 gap-3 mb-5">
        @php
            $cards = [
                [
                    'icon' => 'motorcycle',
                    'label' => 'Motor Tersedia',
                    'value' => $statistik['motor_tersedia'],
                    'bg' => 'bg-emerald-500',
                ],
                [
                    'icon' => 'check_circle',
                    'label' => 'Sedang Disewa',
                    'value' => $statistik['motor_disewa'],
                    'bg' => 'bg-amber-500',
                ],
                [
                    'icon' => 'receipt_long',
                    'label' => 'Transaksi Hari',
                    'value' => $statistik['transaksi_hari'],
                    'bg' => 'bg-teal-600',
                ],
                [
                    'icon' => 'payments',
                    'label' => 'Pendapatan Hari',
                    'value' => $statistik['pendapatan_hari'],
                    'bg' => 'bg-rose-500',
                ],
            ];
        @endphp

        @foreach ($cards as $card)
            <div
                class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm
                    hover:-translate-y-1 transition-transform duration-200">
                <div class="{{ $card['bg'] }} w-9 h-9 rounded-lg flex items-center justify-center mb-3">
                    <span class="material-icons text-white text-[20px]">{{ $card['icon'] }}</span>
                </div>
                <p class="text-2xl font-bold text-slate-800">{{ $card['value'] }}</p>
                <p class="text-xs text-slate-500 mt-0.5">{{ $card['label'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

        {{-- Motor paling sering disewa --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <h2 class="font-semibold text-slate-800 flex items-center gap-2 mb-4">
                <span class="material-icons text-amber-500 text-[20px]">emoji_events</span>
                Motor Paling Sering Disewa
            </h2>

            <div class="space-y-3">
                @foreach ($motorPopuler as $i => $motor)
                    <div class="flex items-center gap-3">
                        <div
                            class="w-7 h-7 rounded-full flex items-center justify-center
                                text-white text-xs font-bold flex-shrink-0
                                {{ $i === 0 ? 'bg-amber-400' : ($i === 1 ? 'bg-slate-400' : ($i === 2 ? 'bg-orange-400' : 'bg-slate-300')) }}">
                            {{ $i + 1 }}
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-slate-700">{{ $motor['nama'] }}</span>
                                <span class="text-sm text-slate-400">{{ $motor['disewa'] }}x</span>
                            </div>
                            <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-500 rounded-full" style="width: {{ $motor['persen'] }}%">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Aktivitas terbaru --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-semibold text-slate-800 flex items-center gap-2">
                    <span class="material-icons text-blue-600 text-[20px]">history</span>
                    Aktivitas Terbaru
                </h2>
            </div>

            <div class="space-y-1">
                @foreach ($aktivitasTerbaru as $tr)
                    <div
                        class="flex items-center justify-between py-2.5
                            border-b border-slate-50 last:border-0">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center">
                                <span class="material-icons text-blue-600 text-[17px]">person</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-700">{{ $tr['customer'] }}</p>
                                <p class="text-xs text-slate-400">{{ $tr['motor'] }} &bull; {{ $tr['id'] }}</p>
                            </div>
                        </div>
                        @php
                            $cls =
                                $tr['status'] === 'Disewa'
                                    ? 'bg-amber-100 text-amber-700'
                                    : 'bg-orange-100 text-orange-700';
                        @endphp
                        <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $cls }}">
                            {{ $tr['status'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

@endsection
