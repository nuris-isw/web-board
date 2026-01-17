<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">Pengaturan Profil Sekolah</h2>
    </x-slot>

    <div class="py-12" x-data="{ tab: 'umum' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-2xl border border-emerald-100 font-bold italic flex items-center shadow-sm">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex space-x-2 mb-6 bg-gray-100/50 p-1.5 rounded-2xl w-fit border border-gray-200">
                <button @click="tab = 'umum'" :class="tab === 'umum' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'" class="px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-widest transition-all">Kontak & Lokasi</button>
                <button @click="tab = 'narasi'" :class="tab === 'narasi' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'" class="px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-widest transition-all">Profil & Sejarah</button>
                <button @click="tab = 'akademik'" :class="tab === 'akademik' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'" class="px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-widest transition-all">Akademik</button>
            </div>

            <div class="bg-white overflow-hidden shadow-xl shadow-gray-100 sm:rounded-3xl border border-gray-100">
                <form action="{{ route('admin.identity.update') }}" method="POST" enctype="multipart/form-data" class="p-8 md:p-12 space-y-12">
                    @csrf @method('PUT')

                    <div x-show="tab === 'umum'" x-transition class="space-y-10">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                            <div class="space-y-8">
                                <div>
                                    <h3 class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em] mb-4">Logo Sekolah</h3>
                                    <div class="flex items-center space-x-6">
                                        <div class="shrink-0">
                                            <img src="{{ $identity->logo ? asset('storage/'.$identity->logo) : 'https://via.placeholder.com/150' }}" class="w-24 h-24 object-contain rounded-2xl bg-gray-50 p-2 border border-gray-100">
                                        </div>
                                        <label class="block">
                                            <span class="sr-only">Pilih Logo</span>
                                            <input type="file" name="logo" class="block w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <h3 class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em]">Kontak</h3>
                                    <div>
                                        <x-input-label for="email" value="Email" class="text-[10px] uppercase ml-1" />
                                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-gray-50/50 border-gray-200" :value="old('email', $identity->email)" />
                                    </div>
                                    <div>
                                        <x-input-label for="phone" value="Telepon" class="text-[10px] uppercase ml-1" />
                                        <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full bg-gray-50/50 border-gray-200" :value="old('phone', $identity->phone)" />
                                    </div>
                                </div>
                            </div>

                            <div class="lg:col-span-2 space-y-8">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-4">
                                        <h3 class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em]">Lokasi Fisik</h3>
                                        <div>
                                            <x-input-label for="address" value="Alamat Lengkap" class="text-[10px] uppercase ml-1" />
                                            <textarea name="address" rows="3" class="mt-1 block w-full rounded-2xl border-gray-200 bg-gray-50/50 focus:ring-indigo-500 focus:border-indigo-500 text-sm">{{ old('address', $identity->address) }}</textarea>
                                        </div>
                                        <div>
                                            <x-input-label for="google_maps" value="Google Maps (Iframe)" class="text-[10px] uppercase ml-1" />
                                            <textarea name="google_maps" rows="4" class="mt-1 block w-full rounded-2xl border-gray-200 bg-gray-50/50 font-mono text-[10px]" placeholder="Paste embed code here...">{{ old('google_maps', $identity->google_maps) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="space-y-4">
                                        <h3 class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em]">Jejaring Sosial</h3>
                                        <div class="space-y-3">
                                            @foreach(['instagram', 'facebook', 'youtube', 'twitter'] as $social)
                                                <div class="relative">
                                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                                        <i class="fab fa-{{ $social }} text-xs"></i>
                                                    </span>
                                                    <input type="text" name="social_media[{{ $social }}]" value="{{ old('social_media.'.$social, $identity->social_media[$social] ?? '') }}" 
                                                           class="pl-10 block w-full rounded-xl border-gray-200 bg-gray-50/50 text-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="URL {{ ucfirst($social) }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div x-show="tab === 'narasi'" x-transition class="space-y-10">
                        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
                            <div class="lg:col-span-1 space-y-6">
                                <h3 class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em]">Kepala Sekolah</h3>
                                <div class="relative group">
                                    <img src="{{ $identity->headmaster_image ? asset('storage/'.$identity->headmaster_image) : 'https://via.placeholder.com/300x400' }}" 
                                         class="w-full aspect-[3/4] object-cover rounded-3xl shadow-xl shadow-indigo-50">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-3xl flex items-center justify-center p-4">
                                        <input type="file" name="headmaster_image" class="absolute inset-0 opacity-0 cursor-pointer">
                                        <span class="text-white text-[10px] font-black uppercase tracking-widest text-center">Ganti Foto</span>
                                    </div>
                                </div>
                                <x-text-input name="headmaster_name" type="text" class="block w-full text-center font-bold" :value="old('headmaster_name', $identity->headmaster_name)" placeholder="Nama Lengkap & Gelar" />
                            </div>
                            <div class="lg:col-span-3 space-y-8">
                                <div>
                                    <h3 class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em] mb-4 text-right">Sambutan Resmi</h3>
                                    <textarea name="welcome_message" class="editor">{{ old('welcome_message', $identity->welcome_message) }}</textarea>
                                </div>
                                <div>
                                    <h3 class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em] mb-4 text-right">Sejarah Singkat</h3>
                                    <textarea name="history" class="editor">{{ old('history', $identity->history) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div x-show="tab === 'akademik'" x-transition class="space-y-10">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <div>
                                <h3 class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em] mb-4">Visi Sekolah</h3>
                                <textarea name="vision" class="editor">{{ old('vision', $identity->vision) }}</textarea>
                            </div>
                            <div>
                                <h3 class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em] mb-4">Misi Sekolah</h3>
                                <textarea name="mission" class="editor">{{ old('mission', $identity->mission) }}</textarea>
                            </div>
                        </div>
                        <div class="pt-6 border-t border-gray-50">
                            <h3 class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em] mb-4">Deskripsi Kurikulum</h3>
                            <textarea name="curriculum" class="editor">{{ old('curriculum', $identity->curriculum) }}</textarea>
                        </div>
                    </div>

                    <div class="pt-10 border-t border-gray-100 flex items-center justify-between">
                        <p class="text-[10px] text-gray-400 italic font-medium">* Periksa kembali semua data sebelum menekan tombol simpan.</p>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-black px-12 py-4 rounded-2xl shadow-xl shadow-indigo-100 uppercase text-[11px] tracking-[0.2em] transition-all hover:-translate-y-1 active:scale-95">
                            Update Identitas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        document.querySelectorAll('.editor').forEach(el => {
            ClassicEditor.create(el, {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ],
            }).catch(error => console.error(error));
        });
    </script>
    <style>
        .ck-editor__editable_inline { min-height: 200px; border-bottom-left-radius: 1.5rem !important; border-bottom-right-radius: 1.5rem !important; }
        .ck-editor__top { border-top-left-radius: 1.5rem !important; border-top-right-radius: 1.5rem !important; }
    </style>
</x-app-layout>