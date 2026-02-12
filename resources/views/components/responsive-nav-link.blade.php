@props(['active' => false])

@php
$classes = $active
    ? 'flex items-center gap-2 w-full px-4 py-2.5 text-sm font-medium text-emerald-700 bg-emerald-50 rounded-lg transition-colors'
    : 'flex items-center gap-2 w-full px-4 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-colors';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
