<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Dasbor</h2>
                <p class="text-slate-500 text-sm mt-1">Ringkasan keuangan Anda</p>
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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Pemasukan</p>
                        <p class="text-2xl font-bold text-emerald-600 mt-1">Rp 5.000.000</p>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-emerald-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-emerald-600 mt-3">+12% dari bulan lalu</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Pengeluaran</p>
                        <p class="text-2xl font-bold text-red-600 mt-1">Rp 3.200.000</p>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-red-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-red-600 mt-3">-5% dari bulan lalu</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Saldo Tersisa</p>
                        <p class="text-2xl font-bold text-slate-800 mt-1">Rp 1.800.000</p>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-slate-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-emerald-600 mt-3">+8% dari bulan lalu</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-slate-800">Aktivitas Terbaru</h3>
                <a href="{{ route('transactions.index') }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-700">
                    Lihat Semua →
                </a>
            </div>
            <div class="divide-y divide-slate-100">
                <div class="px-6 py-4 flex items-center gap-4 hover:bg-slate-50 transition-colors">
                    <div class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-slate-800">Gaji Bulanan</p>
                        <p class="text-sm text-slate-500">Pemasukan • 10 Jan 2026</p>
                    </div>
                    <p class="text-lg font-semibold text-emerald-600">+Rp 5.000.000</p>
                </div>

                <div class="px-6 py-4 flex items-center gap-4 hover:bg-slate-50 transition-colors">
                    <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-slate-800">Belanja Bulanan</p>
                        <p class="text-sm text-slate-500">Pengeluaran • 12 Jan 2026</p>
                    </div>
                    <p class="text-lg font-semibold text-red-600">-Rp 1.200.000</p>
                </div>

                <div class="px-6 py-4 flex items-center gap-4 hover:bg-slate-50 transition-colors">
                    <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-slate-800">Tagihan Listrik</p>
                        <p class="text-sm text-slate-500">Pengeluaran • 15 Jan 2026</p>
                    </div>
                    <p class="text-lg font-semibold text-red-600">-Rp 200.000</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
