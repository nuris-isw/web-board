<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">Unggah Konten Visual Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8">
                <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="title" value="Judul Foto / Banner" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" placeholder="Masukkan judul yang informatif untuk SEO..." required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="type" value="Peruntukan Gambar" />
                            <select id="type" name="type" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="gallery">Galeri Dokumentasi</option>
                                <option value="slider">Hero Slider (Beranda Utama)</option>
                                <option value="home">Gambar Pembuka (Home)</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="order" value="Urutan Tampil (Opsional)" />
                            <x-text-input id="order" name="order" type="number" class="mt-1 block w-full" placeholder="0" min="0" />
                            <p class="text-[10px] text-gray-500 mt-1">*Angka terkecil muncul lebih dulu</p>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="category" value="Kategori (Opsional)" />
                        <x-text-input id="category" name="category" type="text" class="mt-1 block w-full" placeholder="Contoh: Sarana, Prestasi, Kegiatan..." />
                    </div>

                    <div class="relative p-10 border-2 border-dashed border-gray-200 rounded-2xl hover:border-indigo-400 transition-colors bg-gray-50/50 group text-center">
                        <input type="file" name="image" id="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>
                        <div class="space-y-2">
                            <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-sm font-bold text-gray-600" id="file-name-label">Klik atau pilih satu foto ke sini</p>
                            <p class="text-xs text-gray-400">JPG, PNG, atau WEBP hingga 3MB</p>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 text-white font-black py-4 rounded-xl uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                        Simpan dan Publikasikan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Preview nama file yang dipilih
        document.getElementById('image').addEventListener('change', function(e) {
            const label = document.getElementById('file-name-label');
            if (e.target.files.length > 0) {
                label.innerText = 'File terpilih: ' + e.target.files[0].name;
                label.classList.add('text-indigo-600');
            }
        });
    </script>
</x-app-layout>