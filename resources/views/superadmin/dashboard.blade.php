<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Superadmin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500">
                    <p class="text-sm font-medium text-gray-500 uppercase">Total Sekolah</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $total_schools }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-green-500">
                    <p class="text-sm font-medium text-gray-500 uppercase">Sekolah Aktif</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $active_schools }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-purple-500">
                    <p class="text-sm font-medium text-gray-500 uppercase">Total Berita</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $total_news }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white shadow-sm sm:rounded-lg overflow-hidden">
                    <div class="p-6 text-gray-900 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-bold text-lg">Manajemen Unit Sekolah</h3>
                        <span class="text-xs text-gray-400 font-mono">Real-time data</span>
                    </div>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-xs uppercase text-gray-500 border-b">
                                <th class="p-4">Nama Sekolah</th>
                                <th class="p-4">Jenjang</th>
                                <th class="p-4">Domain</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($schools as $school)
                            <tr class="hover:bg-gray-50">
                                <td class="p-4">
                                    <div class="font-bold text-blue-600">{{ $school->name }}</div>
                                    <div class="text-xs text-gray-400">UUID: {{ $school->uuid }}</div>
                                </td>
                                <td class="p-4"><span class="px-2 py-1 bg-gray-100 rounded text-xs">{{ ucfirst($school->theme_type) }}</span></td>
                                <td class="p-4 text-sm text-gray-600">{{ $school->domain ?? 'Belum diatur' }}</td>
                                <td class="p-4"><span class="text-green-500 text-xs font-bold">● {{ $school->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                                <td class="p-4 text-right">
                                    <button class="text-gray-400 hover:text-blue-600 mr-2 text-xs font-bold uppercase">Detail</button>
                                    <button class="text-gray-400 hover:text-red-600 text-xs font-bold uppercase">Nonaktif</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-bold text-lg mb-4">Tambah Unit Baru</h3>
                    <form action="{{ route('superadmin.schools.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Sekolah</label>
                            <input type="text" name="name" required class="..." placeholder="Contoh: SMP Negeri 2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenjang/Tema</label>
                            <select name="theme_type" required class="...">
                                <option value="kindergarten">Kindergarten</option>
                                <option value="elementary">Elementary</option>
                                <option value="highschool">Highschool</option>
                            </select>
                        </div>
                        <button type="submit" class="...">Daftarkan Sekolah</button>
                    </form>
                    
                    <div class="mt-8 p-4 bg-blue-50 rounded-lg border border-blue-100">
                        <p class="text-xs text-blue-700 leading-relaxed">
                            <strong>Note:</strong> Mendaftarkan sekolah baru akan otomatis membuat entitas Identitas Sekolah kosong dan satu slot User Admin.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>