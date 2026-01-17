<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">Tambah Personel</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-[2rem] border border-gray-100 overflow-hidden">
                <form action="{{ route('admin.teacher.store') }}" method="POST" enctype="multipart/form-data" class="p-8 md:p-10 space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2 flex justify-center">
                            <div class="text-center">
                                <x-input-label value="Foto Profil" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-4" />
                                <div class="relative inline-block">
                                    <img id="preview" src="https://ui-avatars.com/api/?name=User&background=F3F4F6&color=A5B4FC" class="w-32 h-32 rounded-full object-cover border-4 border-indigo-50">
                                    <label class="absolute bottom-0 right-0 bg-indigo-600 p-2 rounded-full text-white cursor-pointer shadow-lg hover:bg-indigo-700 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <input type="file" name="photo" class="hidden" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="name" value="Nama Lengkap & Gelar" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                            <x-text-input name="name" type="text" class="block w-full py-3" placeholder="Contoh: Dr. Budi Santoso, M.Pd" required />
                        </div>

                        <div>
                            <x-input-label for="nip" value="NIP / NUPTK (Opsional)" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                            <x-text-input name="nip" type="text" class="block w-full py-3" placeholder="1987..." />
                        </div>

                        <div>
                            <x-input-label for="position" value="Jabatan / Bidang Studi" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                            <x-text-input name="position" type="text" class="block w-full py-3" placeholder="Contoh: Guru Matematika" required />
                        </div>

                        <div>
                            <x-input-label for="type" value="Kategori" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                            <select name="type" class="block w-full rounded-xl border-gray-200 py-3 text-sm font-bold">
                                <option value="guru">Guru (Tenaga Pendidik)</option>
                                <option value="staf">Staf (Kependidikan)</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="order" value="Urutan Tampilan" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                            <x-text-input name="order" type="number" class="block w-full py-3" value="0" required />
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-black px-12 py-4 rounded-2xl shadow-xl shadow-indigo-100 uppercase text-[10px] tracking-widest transition-all">
                            Simpan Personel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>