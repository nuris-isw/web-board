<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">Manajemen PPDB</h2>
                <p class="text-sm text-gray-500 mt-1">Pengaturan penerimaan siswa baru per tahun ajaran.</p>
            </div>
            <a href="{{ route('admin.ppdb.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest shadow-lg shadow-indigo-100 transition-all">
                Buka Tahun Ajaran Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @forelse($ppdbs as $ppdb)
            <div class="bg-white rounded-[2.5rem] border border-gray-100 p-8 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002-2z"></path></svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-3">
                                <h3 class="text-xl font-black text-gray-800">Tahun Ajaran {{ $ppdb->academic_year }}</h3>
                                @if($ppdb->is_active)
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase tracking-widest rounded-full">Aktif</span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-400 mt-1">{{ $ppdb->periods_count }} Gelombang Pendaftaran Tercatat</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 w-full md:w-auto">
                        <a href="{{ route('admin.ppdb.edit', $ppdb->id) }}" class="flex-1 md:flex-none text-center px-6 py-3 bg-gray-50 hover:bg-indigo-50 text-gray-600 hover:text-indigo-600 rounded-2xl text-xs font-bold transition-colors">Kelola Gelombang & Data</a>
                        <form action="{{ route('admin.ppdb.destroy', $ppdb->id) }}" method="POST" onsubmit="return confirm('Hapus semua data PPDB tahun ini?')">
                            @csrf @method('DELETE')
                            <button class="p-3 text-red-400 hover:text-red-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-[2.5rem] p-20 text-center border-2 border-dashed border-gray-100">
                <p class="text-gray-400 italic">Belum ada data pendaftaran. Silahkan buat pengaturan tahun ajaran baru.</p>
            </div>
            @endforelse
        </div>
    </div>
</x-app-layout>