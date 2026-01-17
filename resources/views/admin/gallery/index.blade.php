<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">Galeri Foto Sekolah</h2>
                <p class="text-sm text-gray-500 mt-1">Dokumentasi visual kegiatan dan fasilitas.</p>
            </div>
            <a href="{{ route('admin.gallery.create') }}" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all shadow-lg shadow-indigo-100">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                UNGGAH FOTO
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-400 text-emerald-700 rounded-r-lg shadow-sm">
                    <span class="font-medium italic">{{ session('success') }}</span>
                </div>
            @endif

            <div class="flex flex-wrap items-center gap-2 mb-8">
                <a href="{{ route('admin.gallery.index') }}" 
                   class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest transition-all {{ !request('category') ? 'bg-indigo-600 text-white shadow-md' : 'bg-white text-gray-500 hover:bg-gray-100' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('admin.gallery.index', ['category' => $cat]) }}" 
                       class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest transition-all {{ request('category') == $cat ? 'bg-indigo-600 text-white shadow-md' : 'bg-white text-gray-500 hover:bg-gray-100' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($galleries as $photo)
                    <div class="group relative bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-2xl transition-all duration-500">
                        <div class="aspect-square overflow-hidden">
                            <img src="{{ asset('storage/' . $photo->image_path) }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        </div>
                        
                        <div class="absolute top-3 left-3">
                            <span class="px-2 py-1 bg-white/90 backdrop-blur text-[9px] font-black uppercase tracking-tighter rounded-md shadow-sm text-gray-700">
                                {{ $photo->category ?? 'Umum' }}
                            </span>
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-5">
                            <p class="text-white text-[10px] italic truncate mb-4 opacity-80">{{ $photo->title }}</p>
                            
                            <div class="flex gap-2">
                                <form action="{{ route('admin.gallery.destroy', $photo->id) }}" method="POST" class="w-full" onsubmit="return confirm('Hapus foto ini secara permanen?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-full py-2 bg-red-600 hover:bg-red-700 text-white text-[10px] font-black uppercase tracking-widest rounded-xl transition-colors flex items-center justify-center gap-2">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-24 text-center bg-white rounded-3xl border-2 border-dashed border-gray-100 italic">
                        <div class="mb-4 flex justify-center text-gray-200">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <p class="text-gray-400">Belum ada foto dalam kategori ini.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $galleries->appends(['category' => request('category')])->links() }}
            </div>
        </div>
    </div>
</x-app-layout>