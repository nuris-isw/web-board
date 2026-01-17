<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800">Buka PPDB Tahun Ajaran Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-[2.5rem] border border-gray-100 overflow-hidden">
                <form action="{{ route('admin.ppdb.store') }}" method="POST" enctype="multipart/form-data" class="p-8 md:p-12 space-y-6">
                    @csrf
                    
                    <div class="bg-gray-50 p-6 rounded-3xl border border-dashed border-gray-200 text-center">
                        <x-input-label value="Unggah Brosur PPDB" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-4" />
                        
                        <div class="flex flex-col items-center justify-center">
                            <label class="w-full flex flex-col items-center px-4 py-6 bg-white text-indigo-400 rounded-2xl shadow-sm tracking-wide uppercase border border-indigo-100 cursor-pointer hover:bg-indigo-600 hover:text-white transition-all duration-300">
                                <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M16.88 9.1L13.47 5.69C13.08 5.3 12.45 5.3 12.06 5.69L10 7.75L7.94 5.69C7.55 5.3 6.92 5.3 6.53 5.69L3.12 9.1C2.73 9.49 2.73 10.12 3.12 10.51L10 17.39L16.88 10.51C17.27 10.12 17.27 9.49 16.88 9.1Z" />
                                </svg>
                                <span class="mt-2 text-xs font-bold" id="file-name">Pilih File Brosur (JPG/PNG)</span>
                                <input type="file" name="brochure_image" class="hidden" onchange="document.getElementById('file-name').innerText = this.files[0].name" />
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label value="Tahun Ajaran" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                            <x-text-input name="academic_year" placeholder="Misal: 2026/2027" required class="w-full" />
                        </div>
                        <div>
                            <x-input-label value="Status Publikasi" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                            <select name="is_active" class="w-full rounded-xl border-gray-200 text-sm font-bold">
                                <option value="0">Draft (Sembunyikan)</option>
                                <option value="1">Aktif (Tampilkan di Web)</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label value="Link Pendaftaran Online" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                            <x-text-input name="registration_link" placeholder="https://..." class="w-full" />
                        </div>
                        <div>
                            <x-input-label value="WhatsApp Panitia" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                            <x-text-input name="contact_whatsapp" placeholder="0812..." class="w-full" />
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-xl shadow-indigo-100 transition-all active:scale-95">
                            Simpan & Lanjut Atur Gelombang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>