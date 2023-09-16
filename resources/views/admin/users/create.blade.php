<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.users.store') }}" class="bg-white shadow-md rounded-lg px-6 py-4">

                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Nama')" />
                    <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block w-full mt-1" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Roles -->
                <div class="mb-4">
                    <x-input-label for="roles" :value="__('Peran')" />
                    <div class="space-y-2">
                        @foreach ($roles as $role)
                            <div class="flex items-center">
                                <input id="role-{{ $role }}" type="checkbox" name="roles[]"
                                    value="{{ $role }}"
                                    {{ old('roles') && in_array($role, old('roles')) ? 'checked' : '' }}
                                    class="form-checkbox h-4 w-4 text-blue-600">
                                <label for="role-{{ $role }}"
                                    class="ml-2 text-gray-800">{{ $role }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Simpan Button -->
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button>
                        {{ __('Simpan') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
