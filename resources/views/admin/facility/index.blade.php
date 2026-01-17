<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800">Manajemen Fasilitas</h2>
            <a href="{{ route('admin.facility.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-widest shadow-lg shadow-indigo-100">Tambah Fasilitas</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-3xl overflow-hidden border border-gray-100">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-[10px] uppercase text-gray-400 font-black tracking-widest">
                            <th class="p-5">Foto</th>
                            <th class="p-5">Nama Fasilitas</th>
                            <th class="p-5">Deskripsi</th>
                            <th class="p-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($facilities as $facility)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="p-5 w-32">
                                <img src="{{ $facility->image ? asset('storage/' . $facility->image) : 'https://via.placeholder.com/150' }}" class="w-24 h-16 object-cover rounded-xl border">
                            </td>
                            <td class="p-5 font-bold text-gray-800">{{ $facility->name }}</td>
                            <td class="p-5 text-sm text-gray-500">{{ Str::limit(strip_tags($facility->description), 50) }}</td>
                            <td class="p-5 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.facility.edit', $facility->id) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg">Edit</a>
                                    <form action="{{ route('admin.facility.destroy', $facility->id) }}" method="POST" onsubmit="return confirm('Hapus fasilitas ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-10 text-center text-gray-400 italic">Belum ada data fasilitas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>