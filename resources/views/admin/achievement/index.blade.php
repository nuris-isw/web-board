<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">Prestasi & Penghargaan</h2>
                <p class="text-sm text-gray-500 mt-1">Daftar pencapaian Siswa, Guru, dan Institusi Sekolah.</p>
            </div>
            <a href="{{ route('admin.achievement.create') }}" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all shadow-lg shadow-indigo-100">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                TAMBAH PRESTASI
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-2xl border border-emerald-100 font-bold italic shadow-sm flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-wrap items-center gap-2 mb-8 bg-gray-100/50 p-1.5 rounded-2xl w-fit border border-gray-200">
                <a href="{{ route('admin.achievement.index') }}" 
                   class="px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-widest transition-all {{ !request('type') ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
                    Semua
                </a>
                @foreach(['siswa' => 'Siswa', 'guru' => 'Guru', 'sekolah' => 'Sekolah'] as $key => $label)
                    <a href="{{ route('admin.achievement.index', ['type' => $key]) }}" 
                       class="px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-widest transition-all {{ request('type') == $key ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <div class="bg-white shadow-xl shadow-gray-100 sm:rounded-3xl overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100 text-[10px] uppercase text-gray-400 font-black tracking-[0.2em]">
                                <th class="p-6">Tahun</th>
                                <th class="p-6">Pencapaian & Peraih</th>
                                <th class="p-6 text-center">Tingkat</th>
                                <th class="p-6 text-right">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($achievements as $item)
                            <tr class="hover:bg-gray-50/80 transition-colors group">
                                <td class="p-6">
                                    <span class="text-lg font-black text-gray-300 group-hover:text-indigo-600 transition-colors">{{ $item->year }}</span>
                                </td>
                                <td class="p-6">
                                    <div class="flex items-center">
                                        @if($item->image)
                                            <img src="{{ asset('storage/'.$item->image) }}" class="w-12 h-12 rounded-xl object-cover mr-4 shadow-sm border border-white group-hover:scale-110 transition-transform">
                                        @endif
                                        <div>
                                            <h4 class="font-bold text-gray-800 leading-tight group-hover:text-indigo-600">{{ $item->title }}</h4>
                                            <p class="text-xs text-gray-500 mt-1 uppercase tracking-tighter">
                                                @if($item->achievement_type == 'sekolah')
                                                    <span class="text-emerald-600 font-bold italic">Institusi Sekolah</span>
                                                @else
                                                    {{ $item->winner_name }} <span class="text-gray-300 mx-1">|</span> {{ $item->achievement_type }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-6 text-center">
                                    @php
                                        $colors = [
                                            'kecamatan' => 'bg-slate-100 text-slate-600',
                                            'kabupaten' => 'bg-blue-100 text-blue-700',
                                            'provinsi' => 'bg-amber-100 text-amber-700',
                                            'nasional' => 'bg-orange-100 text-orange-700',
                                            'internasional' => 'bg-indigo-100 text-indigo-700',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest {{ $colors[$item->level] ?? 'bg-gray-100' }}">
                                        {{ $item->level }}
                                    </span>
                                </td>
                                <td class="p-6 text-right">
                                    <div class="flex justify-end items-center gap-3">
                                        <a href="{{ route('admin.achievement.edit', $item->id) }}" class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.achievement.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data prestasi ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-20 text-center">
                                    <div class="flex flex-col items-center italic text-gray-400">
                                        <svg class="w-12 h-12 mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        <p>Belum ada data prestasi tercatat.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($achievements->hasPages())
                <div class="p-6 bg-gray-50/50 border-t border-gray-100">
                    {{ $achievements->appends(['type' => request('type')])->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>