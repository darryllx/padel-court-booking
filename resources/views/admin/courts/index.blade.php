<x-admin-layout>
    <x-slot name="header">Manajemen Lapangan</x-slot>

    <div class="mb-8 flex flex-col md:flex-row justify-between items-center gap-4">
        <a href="{{ route('courts.create') }}" 
           class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition transform hover:scale-105 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Lapangan
        </a>

        <form action="{{ route('courts.index') }}" method="GET" class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
            <select name="category_id" class="border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari lapangan..." 
                       class="pl-10 pr-4 py-2 border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm w-full md:w-64">
            </div>
            
            <button type="submit" class="hidden md:block bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                Cari
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($courts as $court)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 border border-gray-100 overflow-hidden group">
                <div class="absolute mt-4 ml-4">
                    <span class="{{ $court->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} text-xs font-semibold px-2.5 py-0.5 rounded-full border">
                        {{ $court->is_available ? 'Available' : 'Maintenance' }}
                    </span>
                </div>
                <div class="h-48 bg-gray-200 w-full flex items-center justify-center text-gray-400">
                   <span class="text-4xl font-bold">{{ substr($court->court_name, -1) }}</span>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="text-sm text-purple-600 font-semibold uppercase">{{ $court->courtCategory->name ?? 'Umum' }}</p>
                            <h3 class="text-xl font-bold text-gray-800">{{ $court->court_name }}</h3>
                        </div>
                    </div>
                    <div class="space-y-2 mt-4 text-sm text-gray-600">
                        <p>📍 {{ $court->location }}</p>
                        <p>💰 Rp {{ number_format($court->price_per_hour, 0, ',', '.') }} / jam</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-100 flex justify-end gap-2">
                        <a href="{{ route('courts.edit', $court->id) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">Edit</a>
                        <form action="{{ route('courts.destroy', $court->id) }}" method="POST" onsubmit="return confirm('Hapus lapangan ini?');" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm ml-2">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12">
                <p class="text-gray-500">Belum ada data lapangan.</p>
            </div>
        @endforelse
    </div>
    
    <div class="mt-6">
        {{ $courts->links() }}
    </div>
</x-admin-layout>