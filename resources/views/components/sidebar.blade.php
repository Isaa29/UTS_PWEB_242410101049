<aside id="sidebar"
    class="fixed top-0 left-0 h-full w-60 bg-white z-40 flex flex-col
           border-r border-slate-200 shadow-sm
           transform -translate-x-full lg:translate-x-0 transition-transform duration-300">

    <div class="flex items-center gap-3 px-5 h-14 border-b border-slate-200 bg-blue-600 flex-shrink-0">
        <span class="material-icons text-white text-xl">two_wheeler</span>
        <div>
            <p class="text-white text-sm font-bold leading-tight">Rental Motor</p>
            <p class="text-blue-200 text-[10px]">Jaya</p>
        </div>
    </div>

    <nav class="flex-1 py-3 overflow-y-auto">
        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-4 mb-2">
            Menu
        </p>

        <a href="{{ route('dashboard', ['username' => $username ?? 'Admin']) }}"
            class="nav-item flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 transition-all
                  {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="material-icons text-slate-400 text-[20px]">dashboard</span>
            Dashboard
        </a>

        <a href="{{ route('pengelolaan', ['username' => $username ?? 'Admin']) }}"
            class="nav-item flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 transition-all
                  {{ request()->routeIs('pengelolaan') ? 'active' : '' }}">
            <span class="material-icons text-slate-400 text-[20px]">manage_accounts</span>
            Pengelolaan
        </a>

        <a href="{{ route('profile', ['username' => $username ?? 'Admin']) }}"
            class="nav-item flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 transition-all
                  {{ request()->routeIs('profile') ? 'active' : '' }}">
            <span class="material-icons text-slate-400 text-[20px]">person</span>
            Profil
        </a>
    </nav>

    <div class="p-4 border-t border-slate-100 flex-shrink-0">
        <div class="flex items-center gap-2.5 mb-3">
            <div
                class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center
                        text-white text-xs font-bold flex-shrink-0">
                {{ strtoupper(substr($username ?? 'A', 0, 1)) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-sm font-semibold text-slate-800 truncate">{{ $username ?? 'Admin' }}</p>
                <p class="text-[11px] text-slate-400">Administrator</p>
            </div>
        </div>

        <a href="{{ route('logout') }}"
            class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-red-500
                  hover:bg-red-50 transition-colors w-full">
            <span class="material-icons text-[18px]">logout</span>
            Logout
        </a>
    </div>
</aside>

<div id="overlay" class="fixed inset-0 bg-black/40 z-30 lg:hidden hidden" onclick="bukaMenu()"></div>
