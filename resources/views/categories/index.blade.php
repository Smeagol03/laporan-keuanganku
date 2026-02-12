<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Kategori</h2>
                <p class="text-slate-500 text-sm mt-1">Kelola kategori pemasukan dan pengeluaran Anda</p>
            </div>
            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-category')">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kategori
            </x-primary-button>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if ($categories->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($categories as $category)
                    <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 hover:shadow-md transition-all duration-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-sm" style="background-color: {{ $category->color }}">
                                    {{ substr($category->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-800">{{ $category->name }}</p>
                                    <p class="text-sm {{ $category->type === 'income' ? 'text-emerald-600' : 'text-red-600' }} capitalize">
                                        {{ $category->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-secondary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-category'); $dispatch('edit-category', { id: {{ $category->id }}, name: '{{ $category->name }}', type: '{{ $category->type }}', color: '{{ $category->color }}' })" class="!p-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </x-secondary-button>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button onclick="return confirm('Apakah Anda yakin?')" class="!p-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </x-danger-button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-2xl p-12 text-center shadow-sm border border-slate-100">
                <div class="h-16 w-16 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-2">Belum ada kategori</h3>
                <p class="text-slate-500 mb-6">Tambahkan kategori pertama untuk memulai pencatatan keuangan.</p>
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-category')">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Kategori
                </x-primary-button>
            </div>
        @endif
    </div>

    <x-modal name="create-category" :show="$errors->any()" focusable>
        <x-nice-form
            title="Tambah Kategori Baru"
            description="Buat kategori baru untuk mengatur keuangan Anda"
            action="{{ route('categories.store') }}"
            method="POST"
            cancelRoute="{{ route('categories.index') }}"
            submitText="Simpan"
            cancelText="Batal"
        >
            <x-form-group label="Nama Kategori" for="name" required :error="$errors->first('name')">
                <x-text-input id="name" name="name" type="text" placeholder="Contoh: Makanan, Gaji" value="{{ old('name') }}" required />
            </x-form-group>

            <x-form-group label="Tipe" for="type" required :error="$errors->first('type')">
                <select id="type" name="type" x-model="type" class="w-full px-4 py-3 text-slate-700 bg-white border border-slate-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" required>
                    <option value="income">Pemasukan</option>
                    <option value="expense">Pengeluaran</option>
                </select>
            </x-form-group>

            <x-form-group label="Warna" for="color" required :error="$errors->first('color')">
                <div class="flex items-center gap-4">
                    <input type="color" id="color" name="color" x-model="color" class="h-12 w-12 border-0 p-0 rounded-xl cursor-pointer shadow-sm" required>
                    <span x-text="color" class="text-sm font-mono text-slate-600 bg-slate-100 px-4 py-2 rounded-lg">{{ old('color', '#10b981') }}</span>
                </div>
            </x-form-group>
        </x-nice-form>
    </x-modal>

    <x-modal name="edit-category" :show="false" focusable>
        <x-nice-form
            title="Edit Kategori"
            description="Perbarui informasi kategori"
            action=""
            method="PATCH"
            cancelRoute="{{ route('categories.index') }}"
            submitText="Perbarui"
            cancelText="Batal"
            id="edit-category-form"
            x-data=""
            x-init="$watch('$dispatch', function(event) {
                if (event.detail) {
                    document.getElementById('edit-category-form').action = '/categories/' + event.detail.id;
                    document.getElementById('edit_name').value = event.detail.name;
                    document.getElementById('edit_type').value = event.detail.type;
                    document.getElementById('edit_color').value = event.detail.color;
                    document.getElementById('edit_color_value').textContent = event.detail.color;
                }
            })"
        >
            <x-form-group label="Nama Kategori" for="edit_name" required :error="$errors->first('name')">
                <x-text-input id="edit_name" name="name" type="text" required />
            </x-form-group>

            <x-form-group label="Tipe" for="edit_type" required :error="$errors->first('type')">
                <select id="edit_type" name="type" x-model="type" class="w-full px-4 py-3 text-slate-700 bg-white border border-slate-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" required>
                    <option value="income">Pemasukan</option>
                    <option value="expense">Pengeluaran</option>
                </select>
            </x-form-group>

            <x-form-group label="Warna" for="edit_color" required :error="$errors->first('color')">
                <div class="flex items-center gap-4">
                    <input type="color" id="edit_color" name="color" x-model="color" class="h-12 w-12 border-0 p-0 rounded-xl cursor-pointer shadow-sm" required>
                    <span id="edit_color_value" x-text="color" class="text-sm font-mono text-slate-600 bg-slate-100 px-4 py-2 rounded-lg"></span>
                </div>
            </x-form-group>
        </x-nice-form>
    </x-modal>
</x-app-layout>
