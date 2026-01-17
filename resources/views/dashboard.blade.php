<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Selamat datang di Panel Admin <span class="font-bold text-indigo-600">{{ $school->name }}</span></p>
            </div>
            <div class="flex items-center space-x-3">
                <span class="px-4 py-1.5 bg-indigo-50 text-indigo-700 rounded-xl text-[10px] font-black uppercase tracking-widest border border-indigo-100">
                    Sistem Manajemen Sekolah
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="relative overflow-hidden bg-indigo-600 rounded-3xl p-8 shadow-xl shadow-indigo-100">
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold text-white">Selamat Datang, {{ auth()->user()->name }}! 👋</h3>
                    <p class="text-indigo-100 mt-2 max-w-xl">Anda berada di Dashboard Admin <b>{{ $school->name }}</b>.<br>Gunakan menu yang tersedia untuk mengelola dan memperbarui konten.</p>
                </div>
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-indigo-500 rounded-full opacity-20"></div>
                <div class="absolute bottom-0 right-0 mb-8 mr-32 w-24 h-24 bg-indigo-400 rounded-full opacity-10"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center group hover:border-indigo-300 transition-all">
                    <div class="p-4 bg-blue-50 text-blue-600 rounded-2xl group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Berita</p>
                        <p class="text-3xl font-black text-gray-800">{{ $news_count }}</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center group hover:border-indigo-300 transition-all">
                    <div class="p-4 bg-purple-50 text-purple-600 rounded-2xl group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Koleksi Galeri</p>
                        <p class="text-3xl font-black text-gray-800">{{ $gallery_count }}</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center group hover:border-indigo-300 transition-all">
                    <div class="p-4 bg-emerald-50 text-emerald-600 rounded-2xl group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Sarana Prasarana</p>
                        <p class="text-3xl font-black text-gray-800">{{ $facility_count ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-3xl overflow-hidden border border-gray-100">
                <div class="p-8 border-b border-gray-50 flex items-center justify-between bg-gray-50/30">
                    <h3 class="font-black text-[11px] uppercase tracking-[0.2em] text-gray-500 flex items-center">
                        <span class="w-2 h-2 bg-indigo-500 rounded-full mr-3"></span>
                        Akses Cepat Pengelolaan
                    </h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 divide-y md:divide-y-0 md:divide-x divide-gray-100">
                    <a href="{{ route('admin.identity.edit') }}" class="p-8 hover:bg-indigo-50/50 transition-all block group text-center">
                        <div class="inline-flex p-3 bg-gray-50 text-gray-400 rounded-xl mb-3 group-hover:bg-white group-hover:text-indigo-600 shadow-sm transition-all italic">Profil</div>
                        <div class="font-bold text-gray-800 group-hover:text-indigo-600">Identitas Sekolah</div>
                        <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-tighter italic">Visi, Misi & Kontak</p>
                    </a>
                    <a href="{{ route('admin.news.create') }}" class="p-8 hover:bg-indigo-50/50 transition-all block group text-center">
                        <div class="inline-flex p-3 bg-gray-50 text-gray-400 rounded-xl mb-3 group-hover:bg-white group-hover:text-indigo-600 shadow-sm transition-all italic">Berita</div>
                        <div class="font-bold text-gray-800 group-hover:text-indigo-600">Tulis Pengumuman</div>
                        <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-tighter italic">Update Berita Terbaru</p>
                    </a>
                    <a href="{{ route('admin.gallery.create') }}" class="p-8 hover:bg-indigo-50/50 transition-all block group text-center">
                        <div class="inline-flex p-3 bg-gray-50 text-gray-400 rounded-xl mb-3 group-hover:bg-white group-hover:text-indigo-600 shadow-sm transition-all italic">Galeri</div>
                        <div class="font-bold text-gray-800 group-hover:text-indigo-600">Upload Foto</div>
                        <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-tighter italic">Dokumentasi Kegiatan</p>
                    </a>
                    <a href="{{ route('admin.facility.index') }}" class="p-8 hover:bg-indigo-50/50 transition-all block group text-center">
                        <div class="inline-flex p-3 bg-gray-50 text-gray-400 rounded-xl mb-3 group-hover:bg-white group-hover:text-indigo-600 shadow-sm transition-all italic">Fasilitas</div>
                        <div class="font-bold text-gray-800 group-hover:text-indigo-600">Sarana Prasarana</div>
                        <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-tighter italic">Kelola Inventaris Lab/Unit</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>