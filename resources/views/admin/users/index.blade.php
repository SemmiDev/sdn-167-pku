<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Pengguna') }}
            </h2>
            <a href="{{ route('admin.users.create') }}"
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">
                Tambah
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($users as $user)
                    @php
                        $firstUser = $user[0];
                        $roles = [];
                        foreach ($user as $u) {
                            $roles[] = $u->role;
                        }
                    @endphp

                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="p-4">
                            <div class="flex gap-2 items-center">
                                <img src="https://i.pravatar.cc/100?u={{ $firstUser->id }}" alt="avatar"
                                    class="w-16 h-16 rounded-full flex-shrink-0">

                                <div>
                                    <h3 class="text-xl font-semibold">{{ $firstUser->name }}</h3>
                                    <p class="text-gray-600">{{ $firstUser->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-2 bg-gray-100">
                            <strong>Peran:</strong>
                            @foreach ($roles as $role)
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $role }}
                                </span>
                            @endforeach
                        </div>
                        <div class="p-4 flex justify-end space-x-2">
                            <button
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">
                                Edit
                            </button>
                            <button
                                class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none focus:ring focus:ring-red-300">
                                Hapus
                            </button>
                            <button
                                class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-300">
                                Ganti Password
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">Tidak ada data</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
