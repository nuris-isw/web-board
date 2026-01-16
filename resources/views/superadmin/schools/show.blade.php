<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <nav class="flex text-sm text-gray-500 mb-1">
                    <a href="{{ route('superadmin.dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-800">Detail Sekolah</span>
                </nav>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ $school->name }}
                </h2>
            </div>
            <a href="{{ route('superadmin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 transition">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 p-4 mb-4 text-green-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="space-y-6">
                    <div class="bg-white p-6 shadow-sm rounded-xl border border-gray-100">
                        <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            Identitas Unit
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">UUID</p>
                                <p class="font-mono text-sm text-gray-600 break-all bg-gray-50 p-2 rounded mt-1">{{ $school->uuid }}</p>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <p class="text-sm text-gray-500">Tipe Tema</p>
                                <span class="px-2 py-0.5 bg-blue-50 text-blue-700 rounded-full text-xs font-bold capitalize">{{ $school->theme_type }}</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <p class="text-sm text-gray-500">Status Sistem</p>
                                <span class="text-green-600 text-xs font-bold uppercase tracking-widest">● Aktif</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-6 shadow-lg rounded-xl text-white">
                        <h4 class="text-blue-100 text-sm font-medium uppercase">Kapasitas Konten</h4>
                        <div class="mt-4 flex items-baseline">
                            <span class="text-4xl font-bold italic">0</span>
                            <span class="ml-2 text-blue-200">Berita Terbit</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">
                    
                    <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
                        <div class="p-6 bg-gray-50/50 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="font-bold text-lg text-gray-800">Akun Admin Terdaftar</h3>
                            <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded text-xs font-bold">{{ $admins->count() }} User</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-gray-50 text-xs uppercase text-gray-400 font-semibold tracking-wider">
                                    <tr>
                                        <th class="p-4">Nama & Email</th>
                                        <th class="p-4">Dibuat Pada</th>
                                        <th class="p-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($admins as $admin)
                                    <tr class="hover:bg-gray-50/50 transition">
                                        <td class="p-4">
                                            <div class="text-sm font-bold text-gray-800">{{ $admin->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $admin->email }}</div>
                                        </td>
                                        <td class="p-4 text-sm text-gray-600">{{ $admin->created_at->format('d M Y') }}</td>
                                        <td class="p-4">
                                            <button class="text-red-500 hover:text-red-700 text-xs font-bold flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="p-12 text-center text-gray-400">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                                <p class="italic">Belum ada akun admin sekolah ini.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
                        <div class="p-6 bg-gray-50/50 border-b border-gray-100">
                            <h3 class="font-bold text-lg text-gray-800">Daftarkan Admin Baru</h3>
                            <p class="text-xs text-gray-500">Akun ini akan memiliki akses penuh terhadap konten {{ $school->name }}.</p>
                        </div>
                        <form action="{{ route('superadmin.schools.storeAdmin', $school->id) }}" method="POST" class="p-6 space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-1">
                                    <label class="text-xs font-bold text-gray-700 uppercase">Nama Lengkap</label>
                                    <input type="text" name="name" required class="block w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="Nama admin...">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-xs font-bold text-gray-700 uppercase">Email Login</label>
                                    <input type="email" name="email" required class="block w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="email@sekolah.sch.id">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-xs font-bold text-gray-700 uppercase">Password</label>
                                    <input type="password" name="password" required class="block w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-xs font-bold text-gray-700 uppercase">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" required class="block w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </div>
                            </div>
                            <div class="pt-4 flex justify-end border-t border-gray-50">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2.5 rounded-lg text-xs font-bold uppercase tracking-widest shadow-md transition-all active:scale-95">
                                    Simpan Akun Admin
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>