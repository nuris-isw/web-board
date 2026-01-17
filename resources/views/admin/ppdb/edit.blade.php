<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-xl text-gray-800">Pusat Kendali PPDB {{ $ppdb->academic_year }}</h2>
            <a href="{{ route('admin.ppdb.index') }}" class="text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-indigo-600 transition-colors">Kembali</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if(session('success'))
                <div class="p-4 bg-emerald-50 text-emerald-700 rounded-2xl border border-emerald-100 font-bold italic shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="p-4 bg-red-50 text-red-600 rounded-2xl border border-red-100 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm">
                        <form action="{{ route('admin.ppdb.update', $ppdb->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf @method('PUT')
                            <h3 class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em] mb-6">Informasi Utama</h3>
                            
                            <div>
                                <x-input-label value="Brosur PPDB" class="mb-3 text-xs" />
                                <div class="relative group aspect-[3/4] rounded-2xl overflow-hidden bg-gray-100 border-2 border-dashed border-gray-200 flex items-center justify-center">
                                    @if($ppdb->brochure_image)
                                        <img src="{{ asset('storage/'.$ppdb->brochure_image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="text-center p-4">
                                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <p class="text-[10px] text-gray-400 mt-2 uppercase font-bold">Unggah Brosur</p>
                                        </div>
                                    @endif
                                    <input type="file" name="brochure_image" class="absolute inset-0 opacity-0 cursor-pointer">
                                    <div class="absolute inset-0 bg-indigo-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-[10px] font-black uppercase tracking-widest">Ganti Brosur</div>
                                </div>
                            </div>

                            <div>
                                <x-input-label value="Tahun Ajaran" class="text-[10px] uppercase font-bold text-gray-400 mb-1"/>
                                <x-text-input name="academic_year" :value="old('academic_year', $ppdb->academic_year)" class="w-full py-3" placeholder="Tahun Ajaran" />
                            </div>

                            <div>
                                <x-input-label value="WhatsApp Panitia" class="text-[10px] uppercase font-bold text-gray-400 mb-1"/>
                                <x-text-input name="contact_whatsapp" :value="old('contact_whatsapp', $ppdb->contact_whatsapp)" class="w-full py-3" placeholder="Contoh: 08123456789" />
                            </div>

                            <div>
                                <x-input-label value="Link Pendaftaran" class="text-[10px] uppercase font-bold text-gray-400 mb-1"/>
                                <x-text-input name="registration_link" :value="old('registration_link', $ppdb->registration_link)" class="w-full py-3" placeholder="https://link-ppdb.com" />
                            </div>

                            <div>
                                <x-input-label value="Status" class="text-[10px] uppercase font-bold text-gray-400 mb-1"/>
                                <select name="is_active" class="w-full rounded-xl border-gray-200 text-sm font-bold">
                                    <option value="0" {{ $ppdb->is_active ? '' : 'selected' }}>Draft</option>
                                    <option value="1" {{ $ppdb->is_active ? 'selected' : '' }}>Aktif Publik</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="w-full bg-gray-800 text-white py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-black transition-colors shadow-lg">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-indigo-600 p-8 rounded-[2.5rem] text-white shadow-xl shadow-indigo-100">
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] mb-6 opacity-80">Tambah Gelombang Baru</h3>
                        <form action="{{ route('admin.ppdb.periods.store', $ppdb->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @csrf
                            <div class="flex flex-col gap-1">
                                <label class="text-[9px] uppercase font-bold opacity-70">Tipe</label>
                                <select name="type" class="rounded-xl border-none text-gray-800 text-sm font-bold py-3">
                                    <option value="1">Gelombang 1</option>
                                    <option value="2">Gelombang 2</option>
                                    <option value="3">Gelombang 3</option>
                                    <option value="khusus">Jalur Khusus/Prestasi</option>
                                </select>
                            </div>
                            <div class="flex flex-col gap-1">
                                <label class="text-[9px] uppercase font-bold opacity-70">Nama Label</label>
                                <input type="text" name="name" placeholder="Contoh: Early Bird" class="rounded-xl border-none text-gray-800 text-sm font-bold py-3 shadow-inner">
                            </div>
                            <div class="flex flex-col gap-1">
                                <label class="text-[9px] uppercase font-bold opacity-70">Tanggal Mulai</label>
                                <input type="date" name="start_date" class="rounded-xl border-none text-gray-800 text-sm font-bold py-3">
                            </div>
                            <div class="flex flex-col gap-1">
                                <label class="text-[9px] uppercase font-bold opacity-70">Tanggal Berakhir</label>
                                <input type="date" name="end_date" class="rounded-xl border-none text-gray-800 text-sm font-bold py-3">
                            </div>
                            <div class="md:col-span-2 flex flex-col gap-1">
                                <label class="text-[9px] uppercase font-bold opacity-70">Catatan/Benefit</label>
                                <input type="text" name="status_label" placeholder="Contoh: Gratis Seragam Olahraga" class="w-full rounded-xl border-none text-gray-800 text-sm font-bold py-3">
                            </div>
                            <button type="submit" class="md:col-span-2 bg-white text-indigo-600 py-4 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-indigo-50 transition-colors mt-2">Simpan Gelombang</button>
                        </form>
                    </div>

                    <div class="bg-white rounded-[2.5rem] border border-gray-100 overflow-hidden shadow-sm">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50/50 border-b border-gray-50">
                                <tr class="text-[9px] font-black text-gray-400 uppercase tracking-widest">
                                    <th class="px-6 py-4">Gelombang</th>
                                    <th class="px-6 py-4">Periode</th>
                                    <th class="px-6 py-4">Status/Benefit</th>
                                    <th class="px-6 py-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($ppdb->periods as $period)
                                <tr class="group hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-800">{{ $period->name }}</div>
                                        <div class="text-[10px] text-indigo-500 font-black uppercase tracking-tighter italic">Tipe {{ $period->type }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-[11px] font-bold text-gray-600">
                                            {{ $period->start_date->translatedFormat('d M') }} — {{ $period->end_date->translatedFormat('d M Y') }}
                                        </div>
                                        @if($period->is_running)
                                            <span class="text-[8px] font-black text-emerald-500 uppercase tracking-widest">● Sedang Berjalan</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($period->status_label)
                                            <span class="px-3 py-1 bg-amber-50 text-amber-700 rounded-full text-[9px] font-bold uppercase tracking-widest border border-amber-100">{{ $period->status_label }}</span>
                                        @else
                                            <span class="text-gray-300 text-[10px] italic">Tidak ada catatan</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('admin.ppdb.periods.destroy', $period->id) }}" method="POST" onsubmit="return confirm('Hapus gelombang ini?')">
                                            @csrf @method('DELETE')
                                            <button class="p-2 text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic text-sm">Belum ada gelombang pendaftaran.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>