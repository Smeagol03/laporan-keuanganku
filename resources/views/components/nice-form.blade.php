@props([
    'title' => null,
    'description' => null,
    'action' => null,
    'method' => 'POST',
    'cancelRoute' => null,
    'submitText' => 'Simpan',
    'cancelText' => 'Batal',
])

<div class="p-8">
    @if ($title || $description)
        <div class="mb-8 text-center">
            @if ($title)
                <h2 class="text-2xl font-bold text-slate-900">{{ $title }}</h2>
            @endif
            @if ($description)
                <p class="mt-2 text-slate-500">{{ $description }}</p>
            @endif
        </div>
    @endif

    @if ($action)
        <form action="{{ $action }}" method="{{ $method === 'GET' ? 'GET' : 'POST' }}" enctype="multipart/form-data">
            @csrf
            @if ($method !== 'GET' && $method !== 'POST')
                @method($method)
            @endif
    @endif

    <div class="space-y-6">
        {{ $slot }}
    </div>

    @if ($action)
        <div class="mt-8 pt-6 border-t border-slate-200 flex items-center justify-end gap-3">
            @if ($cancelRoute)
                <a href="{{ $cancelRoute }}" class="px-5 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-800 transition-colors">
                    {{ $cancelText }}
                </a>
            @endif

            <button type="submit" class="px-6 py-2.5 text-sm font-semibold text-white bg-emerald-600 rounded-xl shadow-md hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all">
                {{ $submitText }}
            </button>
        </div>
    @endif
</div>
