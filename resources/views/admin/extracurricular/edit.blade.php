<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800 leading-tight">Edit Ekstrakurikuler</h2>
            <a href="{{ route('admin.extracurricular.index') }}" class="text-xs font-bold text-gray-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-3xl border border-gray-100 overflow-hidden">
                <form action="{{ route('admin.extracurricular.update', $extracurricular->id) }}" method="POST" enctype="multipart/form-data" class="p-8 md:p-10 space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            <div>
                                <x-input-label for="name" value="Nama Ekstrakurikuler" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                                <x-text-input name="name" type="text" class="block w-full" :value="old('name', $extracurricular->name)" required />
                            </div>

                            <div>
                                <x-input-label for="coach" value="Nama Pembina / Pelatih" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                                <x-text-input name="coach" type="text" class="block w-full" :value="old('coach', $extracurricular->coach)" />
                            </div>

                            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                                <x-input-label value="Media / Foto Ekskul" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-4" />
                                
                                <div class="flex items-center space-x-4">
                                    @if($extracurricular->image)
                                        <div class="relative shrink-0">
                                            <img src="{{ asset('storage/' . $extracurricular->image) }}" class="w-20 h-20 object-cover rounded-xl border-2 border-white shadow-sm">
                                            <span class="absolute -top-2 -right-2 bg-indigo-600 text-white text-[8px] px-2 py-0.5 rounded-full font-bold uppercase tracking-tighter">Aktif</span>
                                        </div>
                                    @endif
                                    
                                    <div class="flex-1">
                                        <input type="file" name="image" class="block w-full text-[10px] text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-white file:text-indigo-700 file:font-bold hover:file:bg-indigo-50 transition" />
                                        <p class="text-[9px] text-gray-400 mt-2 italic">* Kosongkan jika tidak ingin mengganti foto.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <x-input-label for="description" value="Deskripsi & Jadwal Kegiatan" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                            <textarea id="description" name="description" class="editor">{{ old('description', $extracurricular->description) }}</textarea>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-50 flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-black px-12 py-4 rounded-xl shadow-xl shadow-indigo-100 uppercase text-xs tracking-[0.2em] transition-all active:scale-95">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#description'), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ],
        }).catch(error => console.error(error));
    </script>
</x-app-layout>