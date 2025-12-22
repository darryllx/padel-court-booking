<x-admin-layout>
    <x-slot name="header">Tambah Lapangan Baru</x-slot>

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-100">
        <form action="{{ route('courts.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Lapangan</label>
                    <select name="court_category_id" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('court_category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kode Lapangan</label>
                    <select name="court_code" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        <option value="" disabled selected>Pilih Kode</option>
                        @foreach(['A', 'B', 'C'] as $code)
                            <option value="{{ $code }}" {{ old('court_code') == $code ? 'selected' : '' }}>
                                Lapangan {{ $code }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">*Nama akan digenerate otomatis (Contoh: Indoor - Lapangan A)</p>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Detail</label>
                <input type="text" name="location" value="{{ old('location') }}" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                    placeholder="Contoh: Lantai 1, Gedung Utama">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Harga per Jam (Rp)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">Rp</span>
                    <input type="number" name="price_per_hour" value="{{ old('price_per_hour') }}" required min="0"
                        class="w-full pl-10 border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                        placeholder="100000">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Fasilitas / Deskripsi</label>
                <textarea name="description" rows="3"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                    placeholder="Contoh: Rumput sintetis, AC, Lampu terang">{{ old('description') }}</textarea>
            </div>

            <div class="mb-8">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_available" value="1" class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50" checked>
                    <span class="ml-2 text-gray-700 font-medium">Status Aktif (Bisa Dipesan)</span>
                </label>
            </div>

            <div class="flex items-center justify-end gap-4 border-t pt-6">
                <a href="{{ route('courts.index') }}" class="text-gray-600 hover:text-gray-800 font-medium">Batal</a>
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition transform hover:scale-105">
                    Simpan Lapangan
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>