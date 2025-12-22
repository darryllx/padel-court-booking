<x-admin-layout>
    <x-slot name="header">Edit Lapangan: {{ $court->court_name }}</x-slot>

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-100">
        <form action="{{ route('courts.update', $court->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Lapangan</label>
                    <select name="court_category_id" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ (old('court_category_id', $court->court_category_id) == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kode Lapangan</label>
                    <select name="court_code" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        @foreach(['A', 'B', 'C'] as $code)
                            <option value="{{ $code }}" {{ (old('court_code', $currentCode) == $code) ? 'selected' : '' }}>
                                Lapangan {{ $code }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Detail</label>
                <input type="text" name="location" value="{{ old('location', $court->location) }}" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Harga per Jam (Rp)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">Rp</span>
                    <input type="number" name="price_per_hour" value="{{ old('price_per_hour', $court->price_per_hour) }}" required min="0"
                        class="w-full pl-10 border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Fasilitas / Deskripsi</label>
                <textarea name="description" rows="3"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">{{ old('description', $court->description) }}</textarea>
            </div>

            <div class="mb-8 bg-gray-50 p-4 rounded-lg border border-gray-200">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_available" value="1" 
                        class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
                        {{ $court->is_available ? 'checked' : '' }}>
                    <span class="ml-2 text-gray-700 font-medium">Status Aktif (Bisa Dipesan)</span>
                </label>
                <p class="text-sm text-gray-500 mt-1 ml-6">Jika tidak dicentang, lapangan akan muncul sebagai "Maintenance".</p>
            </div>

            <div class="flex items-center justify-end gap-4 border-t pt-6">
                <a href="{{ route('courts.index') }}" class="text-gray-600 hover:text-gray-800 font-medium">Batal</a>
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition transform hover:scale-105">
                    Update Lapangan
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>