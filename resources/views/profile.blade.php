@extends('layouts.app')

@section('title', 'Profil - Rental Motor Jaya')
@section('page-title', 'Profil Admin')

@section('content')

    <div class="max-w-4xl mx-auto">

        <div
            class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl p-6 mb-5
                relative overflow-hidden">
            <div class="flex items-center gap-5 relative z-10">
                <div
                    class="w-16 h-16 rounded-2xl bg-white/20 border-2 border-white/30
                        flex items-center justify-center text-white text-2xl font-bold flex-shrink-0">
                    {{ strtoupper(substr($username, 0, 1)) }}
                </div>
                <div class="text-white">
                    <h1 class="text-xl font-bold">{{ $username }}</h1>
                    <p class="text-blue-200 text-sm flex items-center gap-1 mt-0.5">
                        <span class="material-icons text-[15px]">verified_user</span>
                        {{ $profil['role'] }}
                    </p>
                    <p class="text-blue-200 text-xs mt-0.5">Bergabung sejak {{ $profil['bergabung'] }}</p>
                </div>
            </div>
            <div class="absolute -right-8 -top-8 w-40 h-40 rounded-full bg-white/5"></div>
            <div class="absolute -left-4 -bottom-8 w-28 h-28 rounded-full bg-white/5"></div>
        </div>

        <div class="grid grid-cols-1 gap-4">

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
                <h2 class="font-semibold text-slate-800 text-sm flex items-center gap-2 mb-4">
                    <span class="material-icons text-blue-600 text-[18px]">badge</span>
                    Informasi Akun
                </h2>

                @php
                    $info = [
                        ['icon' => 'person', 'label' => 'Username', 'val' => $username],
                        ['icon' => 'email', 'label' => 'Email', 'val' => $profil['email']],
                        ['icon' => 'call', 'label' => 'No HP', 'val' => $profil['no_hp']],
                        ['icon' => 'location_on', 'label' => 'Alamat', 'val' => $profil['alamat']],
                    ];
                @endphp

                <div class="space-y-3">
                    @foreach ($info as $item)
                        <div class="flex gap-3">
                            <div
                                class="w-8 h-8 rounded-lg bg-blue-50 flex items-center
                                    justify-center flex-shrink-0">
                                <span class="material-icons text-blue-600 text-[17px]">{{ $item['icon'] }}</span>
                            </div>
                            <div>
                                <p class="text-[11px] text-slate-400 font-medium">{{ $item['label'] }}</p>
                                <p class="text-sm text-slate-700 font-semibold">{{ $item['val'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
