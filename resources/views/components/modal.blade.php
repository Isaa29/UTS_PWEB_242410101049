@props(['id' => 'modal', 'title' => 'Modal'])

<div id="{{ $id }}" class="modal-wrap fixed inset-0 z-50 hidden items-center justify-center p-4">

    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md
                max-h-[90vh] overflow-y-auto"
        onclick="event.stopPropagation()">

        {{-- Header modal --}}
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center">
                    <span class="material-icons text-white text-[17px]">two_wheeler</span>
                </div>
                <h3 class="font-semibold text-slate-800 text-sm">{{ $title }}</h3>
            </div>
            <button onclick="tutupModal('{{ $id }}')"
                class="p-1 rounded-lg hover:bg-slate-100 transition-colors text-slate-400 hover:text-slate-600">
                <span class="material-icons text-[20px]">close</span>
            </button>
        </div>

        {{-- Isi modal --}}
        <div class="px-5 py-5">
            {{ $slot }}
        </div>

    </div>
</div>

@once
    @push('modal-scripts')
        <script>
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
            document.querySelectorAll('.modal-wrap').forEach(m => {
                m.addEventListener('click', () => tutupModal(m.id));
            });
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') {
                    document.querySelectorAll('.modal-wrap.flex').forEach(m => tutupModal(m.id));
                }
            });
        </script>
    @endpush
@endonce
