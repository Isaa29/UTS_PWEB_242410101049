@props(['username' => 'Admin'])

<header
    class="fixed top-0 right-0 left-0 lg:left-60 h-14 bg-white border-b border-slate-200
               z-30 flex items-center px-4 lg:px-5 gap-3 shadow-sm">

    <button onclick="bukaMenu()" class="lg:hidden p-1.5 rounded-lg hover:bg-slate-100 transition-colors">
        <span class="material-icons text-slate-500 text-[22px]">menu</span>
    </button>

    <div class="flex-1">
        <p class="text-sm font-semibold text-slate-800">@yield('page-title', 'Rental Motor Jaya')</p>
        <p class="text-[11px] text-slate-400 hidden sm:block">
            {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
        </p>
    </div>

    <div class="flex items-center gap-2 bg-blue-50 border border-blue-100 rounded-lg px-3 py-1.5">
        <span class="material-icons text-blue-600 text-[18px]">account_circle</span>
        <span class="text-sm font-medium text-blue-700 hidden sm:inline">{{ $username }}</span>
    </div>

</header>
