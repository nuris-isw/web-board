<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-2xl text-gray-800 tracking-tight italic">Dashboard</h2>
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">
                    Kendali Utama <span class="text-indigo-600">{{ $school->name }}</span>
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="/" target="_blank" class="px-4 py-2 bg-white border border-gray-200 text-gray-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-50 transition-all shadow-sm">
                    Lihat Website ↗
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-white rounded-[2.5rem] p-8 border border-gray-100 flex flex-col md:flex-row items-center justify-between gap-6 shadow-sm">
                <div class="space-y-2">
                    <h3 class="text-xl font-black text-gray-800 italic">Halo, {{ explode(' ', auth()->user()->name)[0] }}! 👋</h3>
                    <p class="text-sm text-gray-400 font-medium">Semua modul sistem siap dikelola. Per hari ini, berikut adalah ringkasan data sekolah Anda.</p>
                </div>
                <div class="bg-indigo-50 border border-indigo-100 p-4 rounded-3xl flex items-center gap-4">
                    <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white shadow-lg shadow-indigo-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3" stroke-width="3" stroke-linecap="round" /></svg>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-indigo-400 uppercase tracking-widest">Status PPDB</p>
                        <p class="text-xs font-bold text-indigo-700">Periode {{ $ppdb_active_year ?? 'Non-Aktif' }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm group hover:border-indigo-200 transition-all">
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Berita</p>
                    <div class="flex items-end justify-between">
                        <span class="text-4xl font-black text-gray-800 tracking-tighter">{{ $news_count }}</span>
                        <div class="p-2 bg-blue-50 text-blue-500 rounded-lg group-hover:bg-blue-500 group-hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2" stroke-width="2"/></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm group hover:border-indigo-200 transition-all">
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Guru & Staf</p>
                    <div class="flex items-end justify-between">
                        <span class="text-4xl font-black text-gray-800 tracking-tighter">{{ $teacher_count }}</span>
                        <div class="p-2 bg-purple-50 text-purple-500 rounded-lg group-hover:bg-purple-500 group-hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197" stroke-width="2"/></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm group hover:border-indigo-200 transition-all">
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Ekstrakurikuler</p>
                    <div class="flex items-end justify-between">
                        <span class="text-4xl font-black text-gray-800 tracking-tighter">{{ $extra_count }}</span>
                        <div class="p-2 bg-rose-50 text-rose-500 rounded-lg group-hover:bg-rose-500 group-hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" stroke-width="2"/></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm group hover:border-indigo-200 transition-all">
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Prestasi</p>
                    <div class="flex items-end justify-between">
                        <span class="text-4xl font-black text-gray-800 tracking-tighter">{{ $achievement_count }}</span>
                        <div class="p-2 bg-amber-50 text-amber-500 rounded-lg group-hover:bg-amber-500 group-hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z" stroke-width="2"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm space-y-6">
                    <h4 class="text-[10px] font-black uppercase tracking-[0.3em] text-indigo-600 italic">Shortcut Manajemen</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('admin.ppdb.index') }}" class="p-4 bg-gray-50 rounded-2xl hover:bg-indigo-600 hover:text-white transition-all group">
                            <p class="text-xs font-black uppercase tracking-tighter italic group-hover:text-indigo-100">PPDB</p>
                            <p class="text-[10px] text-gray-400 group-hover:text-white">Atur Gelombang</p>
                        </a>
                        <a href="{{ route('admin.identity.edit') }}" class="p-4 bg-gray-50 rounded-2xl hover:bg-indigo-600 hover:text-white transition-all group">
                            <p class="text-xs font-black uppercase tracking-tighter italic group-hover:text-indigo-100">Profil</p>
                            <p class="text-[10px] text-gray-400 group-hover:text-white">Identitas Sekolah</p>
                        </a>
                        <a href="{{ route('admin.news.create') }}" class="p-4 bg-gray-50 rounded-2xl hover:bg-indigo-600 hover:text-white transition-all group">
                            <p class="text-xs font-black uppercase tracking-tighter italic group-hover:text-indigo-100">Berita</p>
                            <p class="text-[10px] text-gray-400 group-hover:text-white">Tulis Update</p>
                        </a>
                        <a href="{{ route('admin.teacher.index') }}" class="p-4 bg-gray-50 rounded-2xl hover:bg-indigo-600 hover:text-white transition-all group">
                            <p class="text-xs font-black uppercase tracking-tighter italic group-hover:text-indigo-100">Guru</p>
                            <p class="text-[10px] text-gray-400 group-hover:text-white">Data Personel</p>
                        </a>
                    </div>
                </div>

                <div class="bg-gray-900 p-8 rounded-[2.5rem] text-white shadow-2xl shadow-indigo-100 overflow-hidden relative">
                    <div class="relative z-10 space-y-4">
                        <h4 class="text-[10px] font-black uppercase tracking-[0.3em] text-indigo-400">Tips Optimasi Web</h4>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <div class="w-5 h-5 bg-indigo-500 rounded-full flex items-center justify-center text-[10px] font-bold shrink-0">1</div>
                                <p class="text-xs text-gray-400">Pastikan **Brosur PPDB** diunggah dengan format JPG/PNG berkualitas untuk kenyamanan wali murid.</p>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="w-5 h-5 bg-indigo-500 rounded-full flex items-center justify-center text-[10px] font-bold shrink-0">2</div>
                                <p class="text-xs text-gray-400">Gunakan fitur **"Urutan"** pada modul Guru untuk memposisikan Kepala Sekolah di paling atas.</p>
                            </li>
                        </ul>
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-indigo-600 rounded-full blur-3xl opacity-20"></div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>