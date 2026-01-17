<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">Tambah Prestasi Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-3xl border border-gray-100 overflow-hidden" x-data="{ type: 'siswa' }">
                <form action="{{ route('admin.achievement.store') }}" method="POST" enctype="multipart/form-data" class="p-8 md:p-10 space-y-6">
                    @csrf

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
                                <option value="kecamatan">Kecamatan</option>
                                <option value="kabupaten">Kabupaten/Kota</option>
                                <option value="provinsi">Provinsi</option>
                                <option value="nasional">Nasional</option>
                                <option value="internasional">Internasional</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="title" value="Judul Prestasi / Nama Penghargaan" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                        <x-text-input name="title" type="text" class="block w-full py-3" placeholder="Contoh: Juara 1 Lomba Cerdas Cermat" required />
                    </div>

                    <div x-show="type !== 'sekolah'" x-transition>
                        <x-input-label for="winner_name" value="Nama Peraih (Siswa/Guru)" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                        <x-text-input name="winner_name" type="text" class="block w-full py-3" placeholder="Masukkan nama individu atau kelompok" ::required="type !== 'sekolah'" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="competition_name" value="Nama Event/Kompetisi" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                            <x-text-input name="competition_name" type="text" class="block w-full py-3" placeholder="Contoh: O2SN 2026" />
                        </div>
                        <div>
                            <x-input-label for="year" value="Tahun Perolehan" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                            <x-text-input name="year" type="number" class="block w-full py-3" :value="date('Y')" required />
                        </div>
                    </div>

                    <div>
                        <x-input-label value="Foto Dokumentasi / Sertifikat" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                        <input type="file" name="image" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition" />
                    </div>

                    <div>
                        <x-input-label for="description" value="Keterangan Tambahan" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                        <textarea name="description" rows="3" class="block w-full rounded-2xl border-gray-200 bg-gray-50/50 text-sm" placeholder="Jelaskan detail prestasi secara singkat..."></textarea>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                        <a href="{{ route('admin.achievement.index') }}" class="px-6 py-3 text-xs font-bold uppercase tracking-widest text-gray-500 hover:text-gray-700 transition">Batal</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-black px-10 py-3 rounded-xl shadow-xl shadow-indigo-100 uppercase text-[10px] tracking-widest transition-all">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>