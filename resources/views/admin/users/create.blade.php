<x-admin-layout>
    <form method="POST" action="{{ route('admin.users.store') }}" class="max-w-2xl mx-auto bg-white rounded-lg shadow-xl dark:bg-gray-800 p-5">
        @csrf

        <div class="mb-6">
            <label for="guru" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guru</label>
            <select name="guru" id="guru" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                                {{ $errors->has('guru') ? 'border-red-500' : '' }}" required>
                <option value="" disabled>Pilih Guru</option>
                @foreach ($daftarGuru as $guru)
                    <option value="{{ $guru->id }}" {{ old('guru') == $guru->id ? 'selected' : '' }}>{{ $guru->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">password</label>
            <input type="password" name="password" placeholder="******" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <div class="flex items-start mb-6">
            <ul class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @foreach ($roles as $role)
                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                        <div class="flex items-center pl-3">
                            <input id="vue-checkbox"
                                   {{ old('roles') && in_array($role, old('roles')) ? 'checked' : '' }}
                                   value="{{ $role }}" name="roles[]" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="vue-checkbox" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ str_replace('_', ' ', $role) }}
                            </label>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <a href="{{ route('admin.users.index') }}" class="text-white bg-gray-400 hover:bg-gray-500 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Kembali</a>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buat Pengguna</button>
    </form>

</x-admin-layout>
