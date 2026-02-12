<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Transaksi</h2>
                <p class="text-slate-500 text-sm mt-1">Catat dan kelola setiap transaksi keuangan Anda</p>
            </div>
            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-transaction')">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Transaksi
            </x-primary-button>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <form action="{{ route('transactions.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[150px]">
                    <x-form-group label="Dari Tanggal" for="start_date" class="mb-0">
                        <x-text-input id="start_date" name="start_date" type="date" value="{{ request('start_date') }}" />
                    </x-form-group>
                </div>
                <div class="flex-1 min-w-[150px]">
                    <x-form-group label="Sampai Tanggal" for="end_date" class="mb-0">
                        <x-text-input id="end_date" name="end_date" type="date" value="{{ request('end_date') }}" />
                    </x-form-group>
                </div>
                <div class="flex-1 min-w-[180px]">
                    <x-form-group label="Kategori" for="category_id" class="mb-0">
                        <select id="category_id" name="category_id" class="w-full px-4 py-3 text-slate-700 bg-white border border-slate-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </x-form-group>
                </div>
                <div class="flex gap-3">
                    <x-primary-button type="submit">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Filter
                    </x-primary-button>
                    <x-secondary-button type="button" onclick="window.location='{{ route('transactions.index') }}'">
                        Reset
                    </x-secondary-button>
                </div>
            </form>
        </div>

        @if ($transactions->count() > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Deskripsi</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Jumlah</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($transactions as $transaction)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-slate-700 whitespace-nowrap">
                                        {{ $transaction->transaction_date->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-3 w-3 rounded-full flex-shrink-0" style="background-color: {{ $transaction->category->color }}"></div>
                                            <div>
                                                <p class="text-sm font-medium text-slate-800">{{ $transaction->category->name }}</p>
                                                <p class="text-xs {{ $transaction->category->type === 'income' ? 'text-emerald-600' : 'text-red-600' }} capitalize">
                                                    {{ $transaction->category->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-slate-600 max-w-xs truncate">
                                            {{ $transaction->description ?: '-' }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap">
                                        <span class="text-base font-semibold {{ $transaction->category->type === 'income' ? 'text-emerald-600' : 'text-red-600' }}">
                                            {{ $transaction->category->type === 'income' ? '+' : '-' }} Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <x-secondary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-transaction'); $dispatch('edit-transaction', { id: {{ $transaction->id }}, category_id: {{ $transaction->category_id }}, amount: '{{ $transaction->amount }}', description: '{{ $transaction->description }}', transaction_date: '{{ $transaction->transaction_date->format('Y-m-d') }}' })" class="!px-3 !py-1.5 text-xs">
                                                Edit
                                            </x-secondary-button>
                                            <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button onclick="return confirm('Apakah Anda yakin?')" class="!px-3 !py-1.5 text-xs">
                                                    Hapus
                                                </x-danger-button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-slate-100">
                    {{ $transactions->links() }}
                </div>
            </div>
        @else
            <div class="bg-white rounded-2xl p-12 text-center shadow-sm border border-slate-100">
                <div class="h-16 w-16 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-2">Belum ada transaksi</h3>
                <p class="text-slate-500 mb-6">Catat transaksi pertama Anda untuk mulai mengelola keuangan.</p>
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-transaction')">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Transaksi
                </x-primary-button>
            </div>
        @endif
    </div>

    <x-modal name="create-transaction" :show="$errors->any()" focusable>
        <x-nice-form
            title="Tambah Transaksi Baru"
            description="Catat transaksi keuangan Anda"
            action="{{ route('transactions.store') }}"
            method="POST"
            cancelRoute="{{ route('transactions.index') }}"
            submitText="Simpan"
            cancelText="Batal"
        >
            <x-form-group label="Kategori" for="category_id" required :error="$errors->first('category_id')">
                <select id="category_id" name="category_id" class="w-full px-4 py-3 text-slate-700 bg-white border border-slate-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }} ({{ $category->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }})
                        </option>
                    @endforeach
                </select>
            </x-form-group>

            <x-form-group label="Jumlah (Rp)" for="amount" required :error="$errors->first('amount')">
                <x-text-input id="amount" name="amount" type="number" step="0.01" min="0.01" placeholder="0" value="{{ old('amount') }}" required />
            </x-form-group>

            <x-form-group label="Tanggal" for="transaction_date" required :error="$errors->first('transaction_date')">
                <x-text-input id="transaction_date" name="transaction_date" type="date" value="{{ old('transaction_date', date('Y-m-d')) }}" required />
            </x-form-group>

            <x-form-group label="Deskripsi" for="description" :error="$errors->first('description')">
                <textarea id="description" name="description" rows="3" class="w-full px-4 py-3 text-slate-700 bg-white border border-slate-300 rounded-xl shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent resize-none" placeholder="Catatan tambahan...">{{ old('description') }}</textarea>
            </x-form-group>
        </x-nice-form>
    </x-modal>

    <x-modal name="edit-transaction" :show="false" focusable>
        <x-nice-form
            title="Edit Transaksi"
            description="Perbarui informasi transaksi"
            action=""
            method="PATCH"
            cancelRoute="{{ route('transactions.index') }}"
            submitText="Perbarui"
            cancelText="Batal"
            id="edit-transaction-form"
            x-data=""
            x-init="$watch('$dispatch', function(event) {
                if (event.detail) {
                    document.getElementById('edit-transaction-form').action = '/transactions/' + event.detail.id;
                    document.getElementById('edit_category_id').value = event.detail.category_id;
                    document.getElementById('edit_amount').value = event.detail.amount;
                    document.getElementById('edit_description').value = event.detail.description || '';
                    document.getElementById('edit_transaction_date').value = event.detail.transaction_date;
                }
            })"
        >
            <x-form-group label="Kategori" for="edit_category_id" required :error="$errors->first('category_id')">
                <select id="edit_category_id" name="category_id" class="w-full px-4 py-3 text-slate-700 bg-white border border-slate-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }})</option>
                    @endforeach
                </select>
            </x-form-group>

            <x-form-group label="Jumlah (Rp)" for="edit_amount" required :error="$errors->first('amount')">
                <x-text-input id="edit_amount" name="amount" type="number" step="0.01" min="0.01" required />
            </x-form-group>

            <x-form-group label="Tanggal" for="edit_transaction_date" required :error="$errors->first('transaction_date')">
                <x-text-input id="edit_transaction_date" name="transaction_date" type="date" required />
            </x-form-group>

            <x-form-group label="Deskripsi" for="edit_description" :error="$errors->first('description')">
                <textarea id="edit_description" name="description" rows="3" class="w-full px-4 py-3 text-slate-700 bg-white border border-slate-300 rounded-xl shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent resize-none"></textarea>
            </x-form-group>
        </x-nice-form>
    </x-modal>
</x-app-layout>
