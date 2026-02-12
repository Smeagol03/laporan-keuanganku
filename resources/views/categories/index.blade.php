<?php
$title = 'Kategori';
?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6 flex justify-end">
                        <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-category')">
                            {{ __('+ Tambah Kategori') }}
                        </x-primary-button>
                    </div>

                    @if ($categories->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($categories as $category)
                                <div class="border rounded-lg p-4 flex items-center justify-between hover:shadow-md transition-shadow">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold" style="background-color: {{ $category->color }}">
                                            {{ substr($category->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $category->name }}</p>
                                            <p class="text-sm text-gray-500 capitalize">{{ $category->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <x-secondary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-category'); $dispatch('edit-category', { id: {{ $category->id }}, name: '{{ $category->name }}', type: '{{ $category->type }}', color: '{{ $category->color }}' })">
                                            {{ __('Edit') }}
                                        </x-secondary-button>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                {{ __('Hapus') }}
                                            </x-danger-button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500 mb-4">{{ __('Belum ada kategori. Tambahkan kategori pertama Anda!') }}</p>
                            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-category')">
                                {{ __('+ Tambah Kategori') }}
                            </x-primary-button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Create Category Modal -->
    <x-modal name="create-category" :show="$errors->any()" focusable>
        <form action="{{ route('categories.store') }}" method="POST" class="p-6" x-data="{ type: 'expense', color: '#ef4444' }">
            @csrf
            <h2 class="text-lg font-medium text-gray-900 mb-4">{{ __('Tambah Kategori Baru') }}</h2>

            <div class="mb-4">
                <x-input-label for="name" :value="__('Nama Kategori')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required placeholder="Contoh: Makanan, Gaji" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="type" :value="__('Tipe')" />
                <select id="type" name="type" x-model="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    <option value="income">Pemasukan</option>
                    <option value="expense">Pengeluaran</option>
                </select>
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="color" :value="__('Warna')" />
                <div class="flex items-center gap-2 mt-1">
                    <input type="color" id="color" name="color" x-model="color" class="h-10 w-10 border-0 p-0 rounded cursor-pointer" required>
                    <span x-text="color" class="text-sm text-gray-600 font-mono"></span>
                </div>
                <x-input-error :messages="$errors->get('color')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </x-secondary-button>
                <x-primary-button class="ms-3">
                    {{ __('Simpan') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    <!-- Edit Category Modal -->
    <x-modal name="edit-category" :show="false" focusable>
        <form action="" method="POST" class="p-6" id="edit-category-form" x-data="{ type: 'expense', color: '#ef4444' }" x-init="
            $watch('$dispatch', function(event) {
                if (event.detail) {
                    type = event.detail.type;
                    color = event.detail.color;
                    document.getElementById('edit-category-form').action = '/categories/' + event.detail.id;
                }
            })
        ">
            @csrf
            @method('PATCH')
            <h2 class="text-lg font-medium text-gray-900 mb-4">{{ __('Edit Kategori') }}</h2>

            <div class="mb-4">
                <x-input-label for="edit_name" :value="__('Nama Kategori')" />
                <x-text-input id="edit_name" name="name" type="text" class="mt-1 block w-full" required x-model="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="edit_type" :value="__('Tipe')" />
                <select id="edit_type" name="type" x-model="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    <option value="income">Pemasukan</option>
                    <option value="expense">Pengeluaran</option>
                </select>
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="edit_color" :value="__('Warna')" />
                <div class="flex items-center gap-2 mt-1">
                    <input type="color" id="edit_color" name="color" x-model="color" class="h-10 w-10 border-0 p-0 rounded cursor-pointer" required>
                    <span x-text="color" class="text-sm text-gray-600 font-mono"></span>
                </div>
                <x-input-error :messages="$errors->get('color')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </x-secondary-button>
                <x-primary-button class="ms-3">
                    {{ __('Perbarui') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
