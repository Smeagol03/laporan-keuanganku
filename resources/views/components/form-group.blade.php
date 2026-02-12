@props([
    'label' => null,
    'for' => null,
    'required' => false,
    'helpText' => null,
    'error' => null,
])

<div class="space-y-2">
    @if ($label)
        <label for="{{ $for }}" class="block text-sm font-semibold text-slate-700">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    {{ $slot }}

    @if ($helpText)
        <p class="text-xs text-slate-500">{{ $helpText }}</p>
    @endif

    @if ($error)
        <p class="text-sm text-red-600">{{ $error }}</p>
    @elseif ($errors = $errors->get($for ?? ''))
        @foreach ($errors as $message)
            <p class="text-sm text-red-600">{{ $message }}</p>
        @endforeach
    @endif
</div>
