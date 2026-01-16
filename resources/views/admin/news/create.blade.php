<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                {{ __('Tulis Berita Baru') }}
            </h2>
            <a href="{{ route('admin.news.index') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Batal</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2 space-y-4">
                            <div>
                                <x-input-label for="title" value="Judul Berita" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" placeholder="Masukkan judul berita yang menarik..." :value="old('title')" required />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="content" value="Isi Berita" />
                                <textarea id="content" name="content" rows="15" class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Tuliskan isi berita lengkap di sini...">{{ old('content') }}</textarea>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 space-y-4">
                                <h3 class="font-bold text-gray-700 text-sm uppercase tracking-wider">Media & Status</h3>
                                
                                <div>
                                    <x-input-label for="thumbnail" value="Thumbnail Berita" />
                                    <input type="file" name="thumbnail" id="thumbnail" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition" />
                                    <p class="text-[10px] text-gray-400 mt-2 italic">* Format: JPG, PNG (Maks. 2MB)</p>
                                    <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                                </div>

                                <hr class="border-gray-200">

                                <div>
                                    <x-input-label for="is_published" value="Status Publikasi" />
                                    <select name="is_published" id="is_published" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="1">Terbitkan Sekarang</option>
                                        <option value="0">Simpan sebagai Draft</option>
                                    </select>
                                </div>

                                <div class="pt-4">
                                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-blue-200 transition-all uppercase text-xs tracking-widest">
                                        Simpan Berita
                                    </button>
                                </div>
                            </div>

                            <div class="p-4 bg-blue-50 rounded-xl border border-blue-100">
                                <h4 class="text-xs font-bold text-blue-800 uppercase">Tips Menulis</h4>
                                <ul class="text-[11px] text-blue-600 mt-2 space-y-1 list-disc list-inside">
                                    <li>Gunakan judul yang singkat dan padat.</li>
                                    <li>Pastikan gambar thumbnail berkualitas baik.</li>
                                    <li>Periksa kembali ejaan sebelum menerbitkan.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ],
        })
        .then(editor => {
            // Sinkronisasi data ke textarea asli saat form dikirim
            const form = document.querySelector('form');
            form.addEventListener('submit', () => {
                const textarea = document.querySelector('#content');
                textarea.value = editor.getData();
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>

<style>
    /* Menyesuaikan tinggi editor agar pas dengan layout */
    .ck-editor__editable_inline {
        min-height: 400px;
        border-bottom-left-radius: 0.75rem !important;
        border-bottom-right-radius: 0.75rem !important;
    }
    .ck-editor__top {
        border-top-left-radius: 0.75rem !important;
        border-top-right-radius: 0.75rem !important;
    }
</style>