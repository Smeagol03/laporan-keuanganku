<?php
$title = 'Transaksi';
?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form action="{{ route('transactions.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
                        <div>
                            <x-input-label for="start_date" :value="__('Dari Tanggal')" />
                            <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" value="{{ request('start_date') }}" />
                        </div>
                        <div>
                            <x-input-label for="end_date" :value="__('Sampai Tanggal')" />
                            <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" value="{{ request('end_date') }}" />
                        </div>
                        <div>
                            <x-input-label for="category_id" :value="__('Kategori')" />
                            <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex gap-2">
                            <x-primary-button type="submit">
                                {{ __('Filter') }}
                            </x-primary-button>
                            <x-secondary-button type="button" onclick="window.location='{{ route('transactions.index') }}'">
                                {{ __('Reset') }}
                            </x-secondary-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Transactions Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">{{ __('Riwayat Transaksi') }}</h3>
                        <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-transaction')">
                            {{ __('+ Tambah Transaksi') }}
                        </x-primary-button>
                    </div>

                    @if ($transactions->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Tanggal') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Kategori') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Deskripsi') }}</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Jumlah') }}</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Aksi') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($transactions as $transaction)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $transaction->transaction_date->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-3 h-3 rounded-full" style="background-color: {{ $transaction->category->color }}"></div>
                                                    <span class="text-sm text-gray-900">{{ $transaction->category->name }}</span>
                                                    <span class="text-xs px-2 py-0.5 rounded capitalize {{ $transaction->category->type === 'income' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                        {{ $transaction->category->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                                                {{ $transaction->description ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium {{ $transaction->category->type === 'income' ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $transaction->category->type === 'income' ? '+' : '-' }} Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                <div class="flex justify-center gap-2">
                                                    <x-secondary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-transaction'); $dispatch('edit-transaction', { id: {{ $transaction->id }}, category_id: {{ $transaction->category_id }}, amount: '{{ $transaction->amount }}', description: '{{ $transaction->description }}', transaction_date: '{{ $transaction->transaction_date->format('Y-m-d') }}' })">
                                                        {{ __('Edit') }}
                                                    </x-secondary-button>
                                                    <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-danger-button onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                                                            {{ __('Hapus') }}
                                                        </x-danger-button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $transactions->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500 mb-4">{{ __('Belum ada transaksi. Tambahkan transaksi pertama Anda!') }}</p>
                            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-transaction')">
                                {{ __('+ Tambah Transaksi') }}
                            </x-primary-button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Create Transaction Modal -->
    <x-modal name="create-transaction" :show="$errors->any()" focusable>
        <form action="{{ route('transactions.store') }}" method="POST" class="p-6">
            @csrf
            <h2 class="text-lg font-medium text-gray-900 mb-4">{{ __('Tambah Transaksi Baru') }}</h2>

            <div class="mb-4">
                <x-input-label for="category_id" :value="__('Kategori')" />
                <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }} ({{ $category->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }})
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="amount" :value="__('Jumlah (Rp)')" />
                <x-text-input id="amount" name="amount" type="number" step="0.01" min="0.01" class="mt-1 block w-full" required value="{{ old('amount') }}" placeholder="0" />
                <x-input-error :messages="$errors->get('amount')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="transaction_date" :value="__('Tanggal')" />
                <x-text-input id="transaction_date" name="transaction_date" type="date" class="mt-1 block w-full" required value="{{ old('transaction_date', date('Y-m-d')) }}" />
                <x-input-error :messages="$errors->get('transaction_date')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="description" :value="__('Deskripsi (Opsional)')" />
                <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Catatan tambahan...">{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
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

    <!-- Edit Transaction Modal -->
    <x-modal name="edit-transaction" :show="false" focusable>
        <form action="" method="POST" class="p-6" id="edit-transaction-form" x-data="" x-init="
            $watch('$dispatch', function(event) {
                if (event.detail) {
                    document.getElementById('edit-transaction-form').action = '/transactions/' + event.detail.id;
                    document.getElementById('edit_category_id').value = event.detail.category_id;
                    document.getElementById('edit_amount').value = event.detail.amount;
                    document.getElementById('edit_description').value = event.detail.description || '';
                    document.getElementById('edit_transaction_date').value = event.detail.transaction_date;
                }
            })
        ">
            @csrf
            @method('PATCH')
            <h2 class="text-lg font-medium text-gray-900 mb-4">{{ __('Edit Transaksi') }}</h2>

            <div class="mb-4">
                <x-input-label for="edit_category_id" :value="__('Kategori')" />
                <select id="edit_category_id" name="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }})</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="edit_amount" :value="__('Jumlah (Rp)')" />
                <x-text-input id="edit_amount" name="amount" type="number" step="0.01" min="0.01" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('amount')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="edit_transaction_date" :value="__('Tanggal')" />
                <x-text-input id="edit_transaction_date" name="transaction_date" type="date" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('transaction_date')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="edit_description" :value="__('Deskripsi (Opsional)')" />
                <textarea id="edit_description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
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
