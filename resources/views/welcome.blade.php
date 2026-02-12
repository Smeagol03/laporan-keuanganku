<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laporan Keuanganku') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Favicon -->
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>💰</text></svg>">
    </head>
    <body class="font-sans antialiased min-h-screen bg-gray-50">
        <div class="relative min-h-screen overflow-hidden bg-gradient-to-b from-blue-50 to-indigo-50">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23d5d7e1" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
            
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex justify-between items-center mb-16">
                    <div class="flex items-center space-x-2">
                        <x-application-logo class="h-10 w-auto fill-current text-blue-600" />
                        <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">LaporanKeuangan</span>
                    </div>
                    
                    <div>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-fast">Dasbor</a>
                            @else
                                <div class="flex space-x-4">
                                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-fast">Masuk</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-fast">
                                            Daftar
                                        </a>
                                    @endif
                                </div>
                            @endauth
                        @endif
                    </div>
                </div>

                <div class="flex flex-col md:flex-row items-center justify-between gap-12">
                    <div class="md:w-1/2 text-center md:text-left">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-gray-900">
                            Kelola <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Keuangan</span> dengan Mudah
                        </h1>
                        <p class="mt-6 text-xl text-gray-600 max-w-2xl">
                            Laporan Keuanganku membantu Anda melacak pemasukan dan pengeluaran secara efisien. Dapatkan wawasan keuangan yang lebih baik untuk masa depan yang lebih cerah.
                        </p>
                        <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 border border-transparent rounded-xl font-bold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-fast shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-transform">
                                    Mulai Sekarang
                                </a>
                            @endif
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-3 bg-white border border-gray-300 rounded-xl font-bold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-fast shadow hover:shadow-md">
                                Masuk ke Akun
                            </a>
                        </div>
                    </div>
                    
                    <div class="md:w-1/2 flex justify-center">
                        <div class="relative w-full max-w-md">
                            <div class="card-hover bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                                <div class="p-1 bg-gradient-to-r from-blue-500 to-indigo-500">
                                    <div class="bg-white rounded-xl p-6">
                                        <div class="space-y-4">
                                            <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                                                <div class="flex items-center space-x-2">
                                                    <div class="h-3 w-3 rounded-full bg-red-400"></div>
                                                    <div class="h-3 w-3 rounded-full bg-yellow-400"></div>
                                                    <div class="h-3 w-3 rounded-full bg-green-400"></div>
                                                </div>
                                                <div class="text-sm font-medium text-gray-500">LaporanKeuangan</div>
                                            </div>
                                            
                                            <div class="space-y-3">
                                                <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                                                    <div class="mr-3 text-blue-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="font-medium text-gray-800">Gaji Bulanan</div>
                                                        <div class="text-xs text-gray-500">Pemasukan • 10 Jan 2026</div>
                                                    </div>
                                                    <div class="font-semibold text-green-600">+Rp 5.000.000</div>
                                                </div>
                                                
                                                <div class="flex items-center p-3 bg-red-50 rounded-lg">
                                                    <div class="mr-3 text-red-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="font-medium text-gray-800">Belanja Bulanan</div>
                                                        <div class="text-xs text-gray-500">Pengeluaran • 12 Jan 2026</div>
                                                    </div>
                                                    <div class="font-semibold text-red-600">-Rp 1.200.000</div>
                                                </div>
                                                
                                                <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                                    <div class="mr-3 text-green-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="font-medium text-gray-800">Bonus Kinerja</div>
                                                        <div class="text-xs text-gray-500">Pemasukan • 15 Jan 2026</div>
                                                    </div>
                                                    <div class="font-semibold text-green-600">+Rp 1.500.000</div>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between">
                                                <div>
                                                    <div class="text-sm text-gray-500">Total Saldo</div>
                                                    <div class="text-lg font-bold text-gray-800">Rp 5.300.000</div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="text-sm text-gray-500">Sisa Bulan Ini</div>
                                                    <div class="text-lg font-bold text-green-600">Rp 2.100.000</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="absolute -bottom-6 -right-6 bg-white rounded-xl shadow-lg p-4 border border-gray-100 card-hover">
                                <div class="flex items-center">
                                    <div class="mr-3 p-2 bg-green-100 rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-800">Aman & Terpercaya</div>
                                        <div class="text-xs text-gray-500">Data Anda terlindungi</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-24 text-center">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-12">
                        Temukan berbagai fitur canggih yang kami sediakan untuk membantu Anda mengelola keuangan dengan lebih efektif
                    </p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 card-hover">
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Pelacakan Transaksi</h3>
                            <p class="text-gray-600">
                                Lacak semua transaksi keuangan Anda dengan cepat dan mudah dalam satu tempat
                            </p>
                        </div>
                        
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 card-hover">
                            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Laporan Analitik</h3>
                            <p class="text-gray-600">
                                Dapatkan laporan keuangan yang komprehensif dan mudah dipahami
                            </p>
                        </div>
                        
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 card-hover">
                            <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Keamanan Data</h3>
                            <p class="text-gray-600">
                                Lindungi data keuangan Anda dengan teknologi enkripsi terbaru
                            </p>
                        </div>
                    </div>
                </div>
                
                <footer class="mt-24 pt-8 border-t border-gray-200 text-center">
                    <p class="text-gray-600">&copy; {{ date('Y') }} Laporan Keuanganku. Hak Cipta Dilindungi.</p>
                </footer>
            </div>
        </div>
    </body>
</html>