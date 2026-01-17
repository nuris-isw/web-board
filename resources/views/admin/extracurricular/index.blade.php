<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800">Manajemen Ekstrakurikuler</h2>
            <a href="{{ route('admin.extracurricular.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest shadow-lg shadow-indigo-100 transition-all active:scale-95">Tambah Ekskul</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-3xl overflow-hidden border border-gray-100">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-[10px] uppercase text-gray-400 font-black tracking-widest border-b border-gray-100">
                            <th class="p-5">Visual</th>
                            <th class="p-5">Nama Ekskul</th>
                            <th class="p-5">Pembina/Pelatih</th>
                            <th class="p-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($extras as $item)
                        <tr class="hover:bg-gray-50/50 transition group">
                            <td class="p-5 w-24">
                                <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://via.placeholder.com/150' }}" class="w-16 h-16 object-cover rounded-2xl border-2 border-white shadow-sm group-hover:scale-110 transition-transform">
                            </td>
                            <td class="p-5">
                                <div class="font-bold text-gray-800">{{ $item->name }}</div>
                                <div class="text-[10px] text-gray-400 font-medium uppercase tracking-tighter italic">Slug: {{ $item->slug }}</div>
                            </td>
                            <td class="p-5">
                                <div class="inline-flex items-center px-3 py-1 bg-indigo-50 text-indigo-700 rounded-lg text-xs font-bold">
                                    <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ $item->coach ?? 'Belum Ada Pembina' }}
                                </div>
                            </td>
                            <td class="p-5 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.extracurricular.edit', $item->id) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">Edit</a>
                                    <form action="{{ route('admin.extracurricular.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus ekskul ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-xl transition-all">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-10 text-center text-gray-400 italic">Belum ada kegiatan ekstrakurikuler.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>