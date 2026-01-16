<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">Manajemen Berita</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola publikasi dan informasi sekolah Anda.</p>
            </div>
            <a href="{{ route('admin.news.create') }}" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all shadow-lg shadow-indigo-100">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                TULIS BERITA
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-400 text-emerald-700 rounded-r-lg shadow-sm flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white shadow-xl shadow-gray-100 sm:rounded-2xl overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100 text-[11px] uppercase text-gray-400 font-black tracking-widest">
                                <th class="p-5 text-center">Preview</th>
                                <th class="p-5">Informasi Berita</th>
                                <th class="p-5 text-center">Status</th>
                                <th class="p-5">Diterbitkan</th>
                                <th class="p-5 text-right">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($news as $item)
                            <tr class="hover:bg-gray-50/80 transition-colors group">
                                <td class="p-5 w-32">
                                    <div class="relative">
                                        <img src="{{ $item->thumbnail ? asset('storage/'.$item->thumbnail) : 'https://via.placeholder.com/300x200?text=No+Image' }}" 
                                             class="w-24 h-16 object-cover rounded-lg shadow-sm group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                </td>
                                <td class="p-5">
                                    <h3 class="font-bold text-gray-800 text-base line-clamp-1 group-hover:text-indigo-600 transition-colors">{{ $item->title }}</h3>
                                    <p class="text-xs text-gray-400 mt-1 flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                        {{ Str::limit(strip_tags($item->content), 60) }}
                                    </p>
                                </td>
                                <td class="p-5 text-center">
                                    @if($item->is_published)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-100 text-emerald-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                                            Published
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-100 text-amber-700">
                                            Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="p-5 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-600">{{ $item->created_at->translatedFormat('d M Y') }}</span>
                                    <p class="text-[10px] text-gray-400 uppercase tracking-tighter">{{ $item->created_at->diffForHumans() }}</p>
                                </td>
                                <td class="p-5 text-right">
                                    <div class="flex justify-end items-center gap-2">
                                        <a href="{{ route('admin.news.edit', $item->slug) }}" class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="Edit Berita">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        
                                        <form action="{{ route('admin.news.destroy', $item->slug) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Hapus Berita">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="bg-gray-50 p-6 rounded-full mb-4">
                                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l5 5v11a2 2 0 01-2 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 3v5h5M8 13h8m-8 4h6"></path></svg>
                                        </div>
                                        <h4 class="text-gray-500 font-bold">Belum ada berita</h4>
                                        <p class="text-gray-400 text-sm mt-1">Mulailah menulis berita pertama Anda hari ini.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($news->hasPages())
                <div class="p-6 bg-gray-50/50 border-t border-gray-100">
                    {{ $news->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>