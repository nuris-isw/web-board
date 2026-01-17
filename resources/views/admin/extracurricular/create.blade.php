<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800">Tambah Ekstrakurikuler</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-3xl border border-gray-100 overflow-hidden">
                <form action="{{ route('admin.extracurricular.store') }}" method="POST" enctype="multipart/form-data" class="p-8 md:p-10 space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            <div>
                                <x-input-label for="name" value="Nama Ekstrakurikuler" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                                <x-text-input name="name" type="text" class="block w-full" placeholder="Misal: Pramuka Inti" required />
                            </div>
                            <div>
                                <x-input-label for="coach" value="Nama Pembina / Pelatih" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                                <x-text-input name="coach" type="text" class="block w-full" placeholder="Misal: Bp. Budi Santoso, S.Pd" />
                            </div>
                            <div>
                                <x-input-label value="Foto / Logo Ekskul" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                                <input type="file" name="image" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition" />
                            </div>
                        </div>
                        <div>
                            <x-input-label for="description" value="Deskripsi Kegiatan" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                            <textarea id="description" name="description" class="editor">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-black px-10 py-3 rounded-xl shadow-xl shadow-indigo-100 uppercase text-[10px] tracking-widest transition-all active:scale-95">
                            Simpan Ekskul
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#description')).catch(error => console.error(error));
    </script>
</x-app-layout>