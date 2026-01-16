<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Edit Identitas Sekolah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg shadow-sm font-bold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                <form action="{{ route('admin.identity.update') }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <h3 class="font-bold text-blue-600 uppercase text-xs tracking-widest">Kontak Utama</h3>
                            <div>
                                <x-input-label for="email" value="Email Sekolah" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $identity->email)" required />
                            </div>
                            <div>
                                <x-input-label for="phone" value="Nomor Telepon" />
                                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $identity->phone)" required />
                            </div>
                            <div>
                                <x-input-label for="address" value="Alamat Lengkap" />
                                <textarea id="address" name="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('address', $identity->address) }}</textarea>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h3 class="font-bold text-blue-600 uppercase text-xs tracking-widest">Visi & Misi</h3>
                            <div>
                                <x-input-label for="vision" value="Visi" />
                                <textarea id="vision" name="vision" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('vision', $identity->vision) }}</textarea>
                            </div>
                            <div>
                                <x-input-label for="mission" value="Misi" />
                                <textarea id="mission" name="mission" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('mission', $identity->mission) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-6 border-t border-gray-100">
                        <x-primary-button>
                            {{ __('Simpan Perubahan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>