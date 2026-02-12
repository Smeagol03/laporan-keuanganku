<x-nice-form
    title="Formulir Baru"
    description="Silakan lengkapi data di bawah ini dengan benar"
    action="{{ route('example.store') }}"
    method="POST"
    cancelRoute="{{ route('example.index') }}"
    submitText="Simpan Data"
    cancelText="Batal"
>
    <x-form-group label="Nama" for="name" required helpText="Masukkan nama lengkap Anda">
        <x-text-input
            id="name"
            name="name"
            type="text"
            class="w-full"
            placeholder="John Doe"
            value="{{ old('name') }}"
        />
    </x-form-group>

    <x-form-group label="Email" for="email" required>
        <x-text-input
            id="email"
            name="email"
            type="email"
            class="w-full"
            placeholder="email@example.com"
            value="{{ old('email') }}"
        />
    </x-form-group>

    <x-form-group label="Password" for="password" required helpText="Minimal 8 karakter">
        <x-text-input
            id="password"
            name="password"
            type="password"
            class="w-full"
            placeholder="••••••••"
        />
    </x-form-group>

    <x-form-group label="Kategori" for="category">
        <select name="category" id="category" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">Pilih kategori</option>
            <option value="1">Kategori 1</option>
            <option value="2">Kategori 2</option>
        </select>
    </x-form-group>

    <x-form-group label="Deskripsi" for="description">
        <textarea
            name="description"
            id="description"
            rows="4"
            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            placeholder="Masukkan deskripsi..."
        >{{ old('description') }}</textarea>
    </x-form-group>
</x-nice-form>
