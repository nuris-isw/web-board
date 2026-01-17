<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">Tambah Fasilitas</h2>
                <p class="text-sm text-gray-500 mt-1">Tambahkan sarana dan prasarana penunjang sekolah.</p>
            </div>
            <a href="{{ route('admin.facility.index') }}" class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-indigo-600 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl shadow-gray-100 sm:rounded-3xl overflow-hidden border border-gray-100">
                <form action="{{ route('admin.facility.store') }}" method="POST" enctype="multipart/form-data" class="p-8 md:p-12 space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                        <div class="lg:col-span-2 space-y-6">
                            <div>
                                <x-input-label for="name" value="Nama Fasilitas" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                                <x-text-input id="name" name="name" type="text" class="block w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl py-3" placeholder="Misal: Laboratorium Komputer Terpadu" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="description" value="Deskripsi Fasilitas" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-2" />
                                <textarea id="description" name="description" class="editor">{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="bg-gray-50/50 p-6 rounded-3xl border border-gray-100 space-y-6">
                                <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Foto Fasilitas</h3>
                                
                                <div class="relative group border-2 border-dashed border-gray-200 rounded-2xl p-4 hover:border-indigo-400 transition-colors bg-white">
                                    <div id="preview-container" class="hidden mb-4">
                                        <img id="preview-image" src="#" class="rounded-xl w-full aspect-video object-cover shadow-sm">
                                    </div>
                                    
                                    <div id="upload-placeholder" class="py-8 text-center space-y-2">
                                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <p class="text-xs font-bold text-gray-500">Klik untuk unggah foto</p>
                                    </div>

                                    <input type="file" name="image" id="image-input" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" required>
                                </div>
                                
                                <p class="text-[10px] text-gray-400 italic">Rekomendasi ukuran 800x600px, Maks 2MB.</p>
                                
                                <hr class="border-gray-100">

                                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-2xl uppercase text-[11px] tracking-[0.2em] shadow-xl shadow-indigo-100 transition-all active:scale-95">
                                    Simpan Fasilitas
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        // Initialize Editor
        ClassicEditor.create(document.querySelector('#description'), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ],
        }).catch(error => console.error(error));

        // Image Preview Logic
        const imageInput = document.getElementById('image-input');
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');
        const placeholder = document.getElementById('upload-placeholder');

        imageInput.onchange = evt => {
            const [file] = imageInput.files;
            if (file) {
                previewImage.src = URL.createObjectURL(file);
                previewContainer.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
        }
    </script>

    <style>
        .ck-editor__editable_inline { 
            min-height: 300px; 
            border-bottom-left-radius: 1.5rem !important; 
            border-bottom-right-radius: 1.5rem !important; 
            border-color: #e5e7eb !important;
        }
        .ck-editor__top { 
            border-top-left-radius: 1.5rem !important; 
            border-top-right-radius: 1.5rem !important; 
            border-color: #e5e7eb !important;
        }
    </style>
</x-app-layout>