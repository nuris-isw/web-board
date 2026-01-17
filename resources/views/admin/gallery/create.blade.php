<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">Unggah Foto Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8">
                <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <x-input-label for="category" value="Kategori Foto" />
                        <x-text-input id="category" name="category" type="text" class="mt-1 block w-full" placeholder="Contoh: Kegiatan OSIS, Sarana Prasarana..." />
                    </div>

                    <div class="relative p-10 border-2 border-dashed border-gray-200 rounded-2xl hover:border-indigo-400 transition-colors bg-gray-50/50 group text-center">
                        <input type="file" name="images[]" id="images" multiple class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>
                        <div class="space-y-2">
                            <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-sm font-bold text-gray-600">Klik atau seret banyak foto ke sini</p>
                            <p class="text-xs text-gray-400">JPG, PNG hingga 3MB per file</p>
                        </div>
                    </div>

                    <div id="file-list" class="text-xs text-gray-500 italic"></div>

                    <button type="submit" class="w-full bg-indigo-600 text-white font-black py-4 rounded-xl uppercase tracking-widest hover:bg-indigo-700 transition-all">
                        Unggah Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Preview nama file yang dipilih
        document.getElementById('images').addEventListener('change', function(e) {
            const list = document.getElementById('file-list');
            list.innerHTML = e.target.files.length + ' foto terpilih: ' + Array.from(e.target.files).map(f => f.name).join(', ');
        });
    </script>
</x-app-layout>