<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">Direktori Guru & Staf</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola data tenaga pendidik dan kependidikan.</p>
            </div>
            <a href="{{ route('admin.teacher.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest shadow-lg shadow-indigo-100 transition-all">
                Tambah Personel
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex items-center justify-between mb-8">
                <div class="flex space-x-2 bg-gray-100/50 p-1 rounded-xl border border-gray-200">
                    <a href="{{ route('admin.teacher.index') }}" 
                       class="px-5 py-2 rounded-lg text-xs font-bold uppercase tracking-widest transition-all {{ !request('type') ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">Semua</a>
                    <a href="{{ route('admin.teacher.index', ['type' => 'guru']) }}" 
                       class="px-5 py-2 rounded-lg text-xs font-bold uppercase tracking-widest transition-all {{ request('type') == 'guru' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">Guru</a>
                    <a href="{{ route('admin.teacher.index', ['type' => 'staf']) }}" 
                       class="px-5 py-2 rounded-lg text-xs font-bold uppercase tracking-widest transition-all {{ request('type') == 'staf' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">Staf</a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($teachers as $person)
                    <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden group">
                        <div class="p-6 text-center">
                            <div class="relative inline-block mb-4">
                                <img src="{{ $person->photo ? asset('storage/' . $person->photo) : 'https://ui-avatars.com/api/?name='.urlencode($person->name).'&background=EEF2FF&color=4F46E5' }}" 
                                     class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md mx-auto group-hover:scale-105 transition-transform">
                                <span class="absolute bottom-0 right-0 w-4 h-4 rounded-full border-2 border-white {{ $person->is_active ? 'bg-emerald-500' : 'bg-gray-300' }}"></span>
                            </div>
                            
                            <h3 class="font-bold text-gray-800 leading-tight">{{ $person->name }}</h3>
                            <p class="text-[10px] font-black text-indigo-600 uppercase tracking-widest mt-1">{{ $person->position }}</p>
                            <p class="text-[10px] text-gray-400 mt-2 italic">NIP: {{ $person->nip ?? '-' }}</p>
                        </div>

                        <div class="bg-gray-50/50 px-6 py-4 flex items-center justify-between border-t border-gray-50">
                            <span class="text-[10px] font-bold text-gray-400 uppercase">Urutan: {{ $person->order }}</span>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.teacher.edit', $person->id) }}" class="p-2 text-indigo-600 hover:bg-white hover:shadow-sm rounded-lg transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.teacher.destroy', $person->id) }}" method="POST" onsubmit="return confirm('Hapus personel ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-white hover:shadow-sm rounded-lg transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-white rounded-[2rem] border border-dashed border-gray-200">
                        <p class="italic text-gray-400">Belum ada data personel ditemukan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>