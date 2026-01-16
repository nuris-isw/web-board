<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }} - <span class="text-blue-600">{{ $school->name }}</span>
            </h2>
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold uppercase">
                Admin Sekolah
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border-b-4 border-blue-500">
                <h3 class="text-lg font-bold text-gray-800">Selamat Datang, {{ auth()->user()->name }}!</h3>
                <p class="text-gray-500 text-sm mt-1">Kelola informasi dan konten publikasi untuk unit {{ $school->name }} di sini.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Berita & Artikel</p>
                        <p class="text-3xl font-black text-gray-800">{{ $news_count }}</p>
                    </div>
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Galeri Foto</p>
                        <p class="text-3xl font-black text-gray-800">{{ $gallery_count }}</p>
                    </div>
                    <div class="p-3 bg-purple-50 text-purple-600 rounded-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-xl overflow-hidden border border-gray-100">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="font-bold text-gray-800">Menu Pengelolaan</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-gray-100">
                    <a href="#" class="p-6 hover:bg-gray-50 transition block group text-center">
                        <div class="font-bold text-blue-600 group-hover:underline">Identitas Sekolah</div>
                        <p class="text-xs text-gray-400 mt-1">Edit visi, misi, dan alamat.</p>
                    </a>
                    <a href="#" class="p-6 hover:bg-gray-50 transition block group text-center">
                        <div class="font-bold text-blue-600 group-hover:underline">Tulis Berita</div>
                        <p class="text-xs text-gray-400 mt-1">Publikasi pengumuman terbaru.</p>
                    </a>
                    <a href="#" class="p-6 hover:bg-gray-50 transition block group text-center">
                        <div class="font-bold text-blue-600 group-hover:underline">Upload Galeri</div>
                        <p class="text-xs text-gray-400 mt-1">Dokumentasi kegiatan sekolah.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>