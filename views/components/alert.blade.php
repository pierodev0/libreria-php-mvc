@php
    switch ($type) {
        case 'success':
           $classes = 'bg-green-500';
            break;
        
        default:
            $classes = 'bg-red-600';
            break;
    }
@endphp

<p class="{{ $classes }}">
    {{ $slot }}
</p>