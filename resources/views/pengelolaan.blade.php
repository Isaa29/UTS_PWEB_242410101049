@extends('layouts.app')

@section('title', 'Pengelolaan - Rental Motor Jaya')
@section('page-title', 'Pengelolaan Data')

@section('content')

    @if (session('success'))
        <div
            class="flex items-center gap-2 bg-green-50 border border-green-200
                text-green-700 px-4 py-3 rounded-xl mb-4 text-sm">
            <span class="material-icons text-[18px]">check_circle_outline</span>
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
        <div>
            <h1 class="text-lg font-bold text-slate-800">Pengelolaan Data</h1>
            <p class="text-sm text-slate-400">Motor, customer, dan transaksi rental</p>
        </div>

        <x-button icon="add" onclick="bukaModal('modalTambahMotor')">
            Tambah Motor
        </x-button>
    </div>

    <div class="flex border-b border-slate-200 mb-4 overflow-x-auto">
        @php
            $tabs = [
                ['id' => 'motor', 'label' => 'Data Motor', 'icon' => 'two_wheeler', 'jml' => count($dataMotor)],
                ['id' => 'customer', 'label' => 'Data Customer', 'icon' => 'people', 'jml' => count($dataCustomer)],
                ['id' => 'transaksi', 'label' => 'Transaksi', 'icon' => 'receipt_long', 'jml' => count($dataTransaksi)],
            ];
        @endphp

        @foreach ($tabs as $tab)
            <button onclick="gantiTab('{{ $tab['id'] }}')" id="tab-btn-{{ $tab['id'] }}"
                class="flex items-center gap-1.5 px-4 py-3 text-sm font-medium
                       text-slate-500 border-b-2 border-transparent whitespace-nowrap
                       transition-all hover:text-blue-600
                       {{ $loop->first ? 'border-blue-600 text-blue-600' : '' }}">
                <span class="material-icons text-[17px]">{{ $tab['icon'] }}</span>
                {{ $tab['label'] }}
                <span
                    class="bg-slate-100 text-slate-500 text-[11px] font-bold
                         px-1.5 py-0.5 rounded-full ml-0.5">
                    {{ $tab['jml'] }}
                </span>
            </button>
        @endforeach
    </div>

    {{-- DATA MOTOR --}}
    <div id="panel-motor">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-5 py-3.5 border-b border-slate-100 flex items-center justify-between">
                <h2 class="font-semibold text-sm text-slate-800">Daftar Motor</h2>
                <div class="flex gap-2 text-xs">
                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full font-semibold">
                        {{ collect($dataMotor)->where('status', 'Tersedia')->count() }} Tersedia
                    </span>
                    <span class="bg-amber-100 text-amber-700 px-2 py-1 rounded-full font-semibold">
                        {{ collect($dataMotor)->where('status', 'Disewa')->count() }} Disewa
                    </span>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-left">
                            <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wide">No</th>
                            <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wide">Nama Motor</th>
                            <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wide">Nomor Plat</th>
                            <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wide">Merk</th>
                            <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wide">Tahun</th>
                            <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wide">Harga/Hari</th>
                            <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wide">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($dataMotor as $i => $motor)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-5 py-3 text-slate-400 font-medium">{{ $i + 1 }}</td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center gap-2.5">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                                            <span class="material-icons text-blue-600 text-[17px]">two_wheeler</span>
                                        </div>
                                        <span class="font-semibold text-slate-800">{{ $motor['nama'] }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-3">
                                    <span
                                        class="bg-slate-100 text-slate-700 text-xs font-bold
                                             px-2 py-1 rounded font-mono tracking-wide">
                                        {{ $motor['nomor'] }}
                                    </span>
                                </td>
                                <td class="px-5 py-3 text-slate-600">{{ $motor['merk'] }}</td>
                                <td class="px-5 py-3 text-slate-600">{{ $motor['tahun'] }}</td>
                                <td class="px-5 py-3 font-bold text-blue-700">
                                    Rp {{ number_format($motor['harga'], 0, ',', '.') }}
                                </td>
                                <td class="px-5 py-3">
                                    @if ($motor['status'] === 'Tersedia')
                                        <span
                                            class="inline-flex items-center gap-1 bg-green-100
                                                 text-green-700 text-xs font-semibold
                                                 px-2.5 py-1 rounded-full">
                                            <span class="material-icons text-[12px]">fiber_manual_record</span>
                                            Tersedia
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 bg-amber-100
                                                 text-amber-700 text-xs font-semibold
                                                 px-2.5 py-1 rounded-full">
                                            <span class="material-icons text-[12px]">fiber_manual_record</span>
                                            Disewa
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- DATA CUSTOMER --}}
    <div id="panel-customer" class="hidden">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-5 py-3.5 border-b border-slate-100">
                <h2 class="font-semibold text-sm text-slate-800">Daftar Customer</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-left">
                            <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wide">ID</th>
                            <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wide">Nama</th>
                            <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wide">No HP</th>
                            <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wide">Alamat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($dataCustomer as $cust)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-5 py-3">
                                    <span class="bg-blue-50 text-blue-700 text-xs font-bold px-2 py-1 rounded">
                                        {{ $cust['id'] }}
                                    </span>
                                </td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center gap-2.5">
                                        <div
                                            class="w-8 h-8 rounded-full bg-purple-100 flex items-center
                                                justify-center text-purple-700 text-xs font-bold flex-shrink-0">
                                            {{ strtoupper(substr($cust['nama'], 0, 1)) }}
                                        </div>
                                        <span class="font-semibold text-slate-800">{{ $cust['nama'] }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-3 text-slate-500">
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-icons text-slate-400 text-[15px]">call</span>
                                        {{ $cust['no_hp'] }}
                                    </div>
                                </td>
                                <td class="px-5 py-3 text-slate-500">
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-icons text-slate-400 text-[15px]">location_on</span>
                                        {{ $cust['alamat'] }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- PANEL: TRANSAKSI --}}
    <div id="panel-transaksi" class="hidden">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-5 py-3.5 border-b border-slate-100">
                <h2 class="font-semibold text-sm text-slate-800">Transaksi Penyewaan</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-left">
                            <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wide">ID</th>
                            <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wide">Customer</th>
                            <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wide">Motor</th>
                            <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wide">Tgl Sewa</th>
                            <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wide">Tgl Kembali</th>
                            <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wide">Total</th>
                            <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wide">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($dataTransaksi as $tr)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-5 py-3">
                                    <span class="bg-blue-50 text-blue-700 text-xs font-bold px-2 py-1 rounded font-mono">
                                        {{ $tr['id'] }}
                                    </span>
                                </td>
                                <td class="px-5 py-3 font-medium text-slate-800">{{ $tr['customer'] }}</td>
                                <td class="px-5 py-3 text-slate-500">{{ $tr['motor'] }}</td>
                                <td class="px-5 py-3 text-slate-400 text-xs">{{ $tr['tgl_sewa'] }}</td>
                                <td class="px-5 py-3 text-slate-400 text-xs">{{ $tr['tgl_kembali'] }}</td>
                                <td class="px-5 py-3 font-bold text-blue-700">{{ $tr['total'] }}</td>
                                <td class="px-5 py-3">
                                    @if ($tr['status'] === 'Disewa')
                                        <span
                                            class="bg-amber-100 text-amber-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                                            Disewa
                                        </span>
                                    @else
                                        <span
                                            class="bg-orange-100 text-orange-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                                            {{ $tr['status'] }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- TAMBAH MOTOR --}}
    <x-modal id="modalTambahMotor" title="Tambah Motor Baru">

        <form action="{{ route('tambah.motor', ['username' => $username]) }}" method="POST" class="space-y-4">
            @csrf

            {{-- Nama motor --}}
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1.5">
                    Nama Motor
                </label>
                <div class="relative">
                    <span
                        class="material-icons absolute left-2.5 top-1/2 -translate-y-1/2
                             text-slate-400 text-[18px]">two_wheeler</span>
                    <input type="text" name="nama" placeholder="contoh: Honda Beat Sport" required
                        class="w-full pl-9 pr-4 py-2.5 border border-slate-200 rounded-lg text-sm
                              bg-slate-50 focus:outline-none focus:border-blue-500
                              focus:ring-2 focus:ring-blue-100 focus:bg-white transition-all">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">

                {{-- Nomor plat --}}
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1.5">
                        Nomor Plat
                    </label>
                    <input type="text" name="nomor" placeholder="P 1234 AB" required
                        style="text-transform: uppercase"
                        class="w-full px-3 py-2.5 border border-slate-200 rounded-lg text-sm
                              bg-slate-50 focus:outline-none focus:border-blue-500
                              focus:ring-2 focus:ring-blue-100 focus:bg-white transition-all uppercase">
                </div>

                {{-- Merk --}}
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1.5">
                        Merk
                    </label>
                    <select name="merk" required
                        class="w-full px-3 py-2.5 border border-slate-200 rounded-lg text-sm
                               bg-slate-50 focus:outline-none focus:border-blue-500
                               focus:ring-2 focus:ring-blue-100 focus:bg-white transition-all">
                        <option value="">Pilih merk</option>
                        <option value="Honda">Honda</option>
                        <option value="Yamaha">Yamaha</option>
                        <option value="Suzuki">Suzuki</option>
                        <option value="Kawasaki">Kawasaki</option>
                    </select>
                </div>

                {{-- Tahun --}}
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1.5">
                        Tahun
                    </label>
                    <input type="number" name="tahun" placeholder="2023" min="2000" max="2026" required
                        class="w-full px-3 py-2.5 border border-slate-200 rounded-lg text-sm
                              bg-slate-50 focus:outline-none focus:border-blue-500
                              focus:ring-2 focus:ring-blue-100 focus:bg-white transition-all">
                </div>

                {{-- Harga --}}
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1.5">
                        Harga / Hari (Rp)
                    </label>
                    <div class="relative">
                        <span
                            class="absolute left-3 top-1/2 -translate-y-1/2
                                 text-xs font-bold text-slate-400">Rp</span>
                        <input type="number" name="harga" placeholder="100000" min="0" required
                            class="w-full pl-8 pr-3 py-2.5 border border-slate-200 rounded-lg text-sm
                                  bg-slate-50 focus:outline-none focus:border-blue-500
                                  focus:ring-2 focus:ring-blue-100 focus:bg-white transition-all">
                    </div>
                </div>
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">
                    Status Motor
                </label>
                <div class="flex gap-3">
                    <label
                        class="flex-1 flex items-center gap-2.5 border border-slate-200 rounded-lg
                              px-3 py-2.5 cursor-pointer hover:border-blue-400 transition-all
                              has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50">
                        <input type="radio" name="status" value="Tersedia" checked class="accent-blue-600">
                        <div>
                            <p class="text-sm font-semibold text-slate-700">Tersedia</p>
                            <p class="text-[11px] text-slate-400">Siap disewa</p>
                        </div>
                    </label>
                    <label
                        class="flex-1 flex items-center gap-2.5 border border-slate-200 rounded-lg
                              px-3 py-2.5 cursor-pointer hover:border-amber-400 transition-all
                              has-[:checked]:border-amber-400 has-[:checked]:bg-amber-50">
                        <input type="radio" name="status" value="Disewa" class="accent-amber-500">
                        <div>
                            <p class="text-sm font-semibold text-slate-700">Disewa</p>
                            <p class="text-[11px] text-slate-400">Sedang disewa</p>
                        </div>
                    </label>
                </div>
            </div>

            <div class="flex justify-end gap-2.5 pt-2 border-t border-slate-100">
                <x-button type="secondary" onclick="tutupModal('modalTambahMotor')">
                    Batal
                </x-button>
                <x-button type="primary" icon="check" :submit="true">
                    Simpan Motor
                </x-button>
            </div>

        </form>
    </x-modal>

@endsection

@section('extra-js')
    <script>
        const panels = ['motor', 'customer', 'transaksi'];

        function gantiTab(aktif) {
            panels.forEach(id => {
                const panel = document.getElementById('panel-' + id);
                const btn = document.getElementById('tab-btn-' + id);

                if (id === aktif) {
                    panel.classList.remove('hidden');
                    btn.classList.add('border-blue-600', 'text-blue-600');
                    btn.classList.remove('border-transparent', 'text-slate-500');
                } else {
                    panel.classList.add('hidden');
                    btn.classList.remove('border-blue-600', 'text-blue-600');
                    btn.classList.add('border-transparent', 'text-slate-500');
                }
            });
        }

        function bukaModal(id) {
            const el = document.getElementById(id);
            el.classList.remove('hidden');
            el.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function tutupModal(id) {
            const el = document.getElementById(id);
            el.classList.add('hidden');
            el.classList.remove('flex');
            document.body.style.overflow = '';
        }

        document.getElementById('modalTambahMotor').addEventListener('click', function(e) {
            if (e.target === this) tutupModal('modalTambahMotor');
        });

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') tutupModal('modalTambahMotor');
        });
    </script>
@endsection
