<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">Edit Data Prestasi</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Inisialisasi x-data dengan nilai dari database --}}
            <div class="bg-white shadow-xl sm:rounded-3xl border border-gray-100 overflow-hidden" 
                 x-data="{ type: '{{ old('achievement_type', $achievement->achievement_type) }}' }">
                
                <form action="{{ route('admin.achievement.update', $achievement->id) }}" method="POST" enctype="multipart/form-data" class="p-8 md:p-10 space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="achievement_type" value="Jenis Prestasi" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                            <select name="achievement_type" x-model="type" class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm font-bold">
                                <option value="siswa">Prestasi Siswa</option>
                                <option value="guru">Prestasi Guru</option>
                                <option value="sekolah">Prestasi Sekolah (Institusi)</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="level" value="Tingkat" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                            <select name="level" class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm font-bold">
                                @foreach(['kecamatan', 'kabupaten', 'provinsi', 'nasional', 'internasional'] as $lvl)
                                    <option value="{{ $lvl }}" {{ old('level', $achievement->level) == $lvl ? 'selected' : '' }}>
                                        {{ ucfirst($lvl) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="title" value="Judul Prestasi / Nama Penghargaan" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                        <x-text-input name="title" type="text" class="block w-full py-3" :value="old('title', $achievement->title)" required />
                    </div>

                    <div x-show="type !== 'sekolah'" x-transition x-cloak>
                        <x-input-label for="winner_name" value="Nama Peraih (Siswa/Guru)" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                        <x-text-input name="winner_name" type="text" class="block w-full py-3" :value="old('winner_name', $achievement->winner_name)" ::required="type !== 'sekolah'" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="competition_name" value="Nama Event/Kompetisi" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                            <x-text-input name="competition_name" type="text" class="block w-full py-3" :value="old('competition_name', $achievement->competition_name)" />
                        </div>
                        <div>
                            <x-input-label for="year" value="Tahun Perolehan" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                            <x-text-input name="year" type="number" class="block w-full py-3" :value="old('year', $achievement->year)" required />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                        <div class="md:col-span-1 text-center">
                            <x-input-label value="Foto Saat Ini" class="text-[9px] font-black uppercase tracking-widest text-gray-400 mb-2" />
                            @if($achievement->image)
                                <img src="{{ asset('storage/'.$achievement->image) }}" class="mx-auto w-24 h-24 object-cover rounded-xl shadow-sm border-2 border-white">
                            @else
                                <div class="mx-auto w-24 h-24 bg-gray-200 rounded-xl flex items-center justify-center text-[10px] text-gray-400 italic">No Image</div>
                            @endif
                        </div>
                        <div class="md:col-span-2">
                            <x-input-label value="Unggah Foto Baru (Opsional)" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                            <input type="file" name="image" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="description" value="Keterangan Tambahan" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                        <textarea name="description" rows="3" class="block w-full rounded-2xl border-gray-200 bg-gray-50/50 text-sm">{{ old('description', $achievement->description) }}</textarea>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                        <a href="{{ route('admin.achievement.index') }}" class="px-6 py-3 text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-gray-600 transition">Batal</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-black px-10 py-3 rounded-xl shadow-xl shadow-indigo-100 uppercase text-[10px] tracking-widest transition-all">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>