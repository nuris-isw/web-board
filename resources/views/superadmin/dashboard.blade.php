<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Superadmin Dashboard') }}
            </h2>
            <div class="text-sm text-gray-500 font-medium bg-gray-100 px-3 py-1 rounded-full">
                Sistem Pusat Manajemen Webboard
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if(session('success'))
                <div class="p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg shadow-sm flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-sm font-bold text-green-800">{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group">
                    <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                        <svg class="w-16 h-16 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2 .712V17a1 1 0 001 1z"/></svg>
                    </div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Sekolah</p>
                    <p class="text-4xl font-black text-gray-800 mt-1">{{ $total_schools }}</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group">
                    <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:scale-110 transition-transform text-green-600">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-widest text-green-600">Sekolah Aktif</p>
                    <p class="text-4xl font-black text-gray-800 mt-1">{{ $active_schools }}</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group">
                    <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:scale-110 transition-transform text-purple-600">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/></svg>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-widest text-purple-600">Total Konten Berita</p>
                    <p class="text-4xl font-black text-gray-800 mt-1">{{ $total_news }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-white shadow-sm rounded-2xl border border-gray-100 overflow-hidden">
                    <div class="p-6 bg-gray-50/50 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-bold text-lg text-gray-800">Manajemen Unit Sekolah</h3>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold tracking-tighter uppercase">List Unit</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-50 text-[10px] uppercase text-gray-400 font-black tracking-widest border-b border-gray-100">
                                    <th class="p-5">Informasi Sekolah</th>
                                    <th class="p-5">Detail Tema</th>
                                    <th class="p-5">Status</th>
                                    <th class="p-5 text-right">Kelola</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($schools as $school)
                                <tr class="hover:bg-blue-50/30 transition-colors group">
                                    <td class="p-5">
                                        <div class="font-bold text-gray-800 group-hover:text-blue-600 transition-colors">{{ $school->name }}</div>
                                        <div class="text-[10px] font-mono text-gray-400 mt-1">{{ $school->uuid }}</div>
                                    </td>
                                    <td class="p-5">
                                        <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-[10px] font-bold uppercase tracking-tighter italic">
                                            {{ $school->theme_type }}
                                        </span>
                                        <div class="text-xs text-gray-400 mt-1">{{ $school->domain ?? 'no-domain.com' }}</div>
                                    </td>
                                    <td class="p-5 text-sm">
                                        @if($school->is_active)
                                            <span class="inline-flex items-center text-green-600 font-bold text-xs uppercase">
                                                <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span> Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center text-gray-400 font-bold text-xs uppercase">
                                                <span class="w-2 h-2 bg-gray-300 rounded-full mr-2"></span> Off
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-5 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('superadmin.schools.show', $school->uuid) }}" 
                                               class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-xs font-bold hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                                Detail
                                            </a>
                                            <button class="px-3 py-1.5 bg-gray-50 text-gray-400 rounded-lg text-xs font-bold hover:bg-red-50 hover:text-red-600 transition-all">
                                                Suspend
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white shadow-xl rounded-2xl border border-gray-100 p-8 self-start sticky top-6">
                    <div class="mb-6">
                        <h3 class="font-black text-xl text-gray-800">Daftarkan Unit</h3>
                        <p class="text-sm text-gray-400">Tambahkan sekolah baru ke jaringan Webboard.</p>
                    </div>
                    
                    <form action="{{ route('superadmin.schools.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">Nama Instansi</label>
                            <input type="text" name="name" required 
                                   class="w-full bg-gray-50 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all placeholder:text-gray-300" 
                                   placeholder="Contoh: SMA Negeri 2 Banyuwangi">
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">Jenjang Pendidikan</label>
                            <select name="theme_type" required 
                                    class="w-full bg-gray-50 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                                <option value="kindergarten">TK (Kindergarten)</option>
                                <option value="elementary">SD (Elementary)</option>
                                <option value="highschool" selected>SMP/SMA (Highschool)</option>
                            </select>
                        </div>
                        <button type="submit" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-[0.98] uppercase text-xs tracking-widest">
                            Inisialisasi Sekolah
                        </button>
                    </form>
                    
                    <div class="mt-8 p-5 bg-gradient-to-br from-gray-50 to-blue-50 rounded-2xl border border-blue-100 relative overflow-hidden">
                        <svg class="absolute -right-2 -bottom-2 w-16 h-16 text-blue-100 opacity-50" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                        <p class="text-[10px] text-blue-800 font-bold uppercase leading-relaxed relative z-10">Sistem Otomatis</p>
                        <p class="text-[11px] text-blue-600/80 mt-1 relative z-10 font-medium">Data Identitas & API Key akan di-generate secara instan setelah pendaftaran.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>