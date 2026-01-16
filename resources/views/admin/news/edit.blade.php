<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">Edit Berita</h2>
                <p class="text-sm text-gray-500 mt-1">Lakukan perubahan pada berita Anda.</p>
            </div>
            <a href="{{ route('admin.news.index') }}" class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-indigo-600 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl shadow-gray-100 sm:rounded-2xl overflow-hidden border border-gray-100">
                {{-- Gunakan slug untuk route --}}
                <form action="{{ route('admin.news.update', $news->slug) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                        <div class="lg:col-span-2 space-y-6">
                            <div>
                                <x-input-label for="title" value="Judul Berita" class="text-xs font-black uppercase tracking-wider text-gray-400 mb-2" />
                                <x-text-input id="title" name="title" type="text" class="block w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl" :value="old('title', $news->title)" required />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="content" value="Isi Berita" class="text-xs font-black uppercase tracking-wider text-gray-400 mb-2" />
                                <div class="ck-content">
                                    <textarea id="content" name="content" class="hidden">{{ old('content', $news->content) }}</textarea>
                                </div>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100 space-y-6">
                                <div>
                                    <x-input-label value="Thumbnail" class="text-xs font-black uppercase tracking-wider text-gray-400 mb-3" />
                                    
                                    @if($news->thumbnail)
                                        <div class="relative group mb-4">
                                            <img src="{{ asset('storage/'.$news->thumbnail) }}" class="rounded-xl w-full h-40 object-cover border-2 border-white shadow-md">
                                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center">
                                                <span class="text-white text-[10px] font-bold uppercase tracking-widest text-center px-2">Unggah baru untuk mengganti</span>
                                            </div>
                                        </div>
                                    @endif

                                    <input type="file" name="thumbnail" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition" />
                                    <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                                </div>

                                <hr class="border-gray-200/50">

                                <div>
                                    <x-input-label for="is_published" value="Status" class="text-xs font-black uppercase tracking-wider text-gray-400 mb-2" />
                                    <select name="is_published" id="is_published" class="mt-1 block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all text-sm font-medium">
                                        <option value="1" {{ old('is_published', $news->is_published) ? 'selected' : '' }}>Terbitkan</option>
                                        <option value="0" {{ !old('is_published', $news->is_published) ? 'selected' : '' }}>Draft (Sembunyikan)</option>
                                    </select>
                                </div>

                                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-xl uppercase text-[11px] tracking-[0.2em] shadow-xl shadow-indigo-100 transition-all active:scale-[0.98]">
                                    Simpan Perubahan
                                </button>
                            </div>

                            <div class="p-5 bg-amber-50 rounded-2xl border border-amber-100">
                                <h4 class="text-[10px] font-black text-amber-800 uppercase tracking-widest flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                    Info Log
                                </h4>
                                <div class="mt-2 space-y-1">
                                    <p class="text-[10px] text-amber-700/80 uppercase tracking-tighter">Dibuat: {{ $news->created_at->format('d/m/Y H:i') }}</p>
                                    <p class="text-[10px] text-amber-700/80 uppercase tracking-tighter">Terakhir Update: {{ $news->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#content'), {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ],
            })
            .then(editor => {
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
        .ck-editor__editable_inline {
            min-height: 400px;
            border-bottom-left-radius: 1rem !important;
            border-bottom-right-radius: 1rem !important;
            border-color: #e5e7eb !important;
        }
        .ck-editor__top {
            border-top-left-radius: 1rem !important;
            border-top-right-radius: 1rem !important;
            border-color: #e5e7eb !important;
        }
    </style>
</x-app-layout>