@props([
    'href' => 'javascript:void(0)',
    'target' => '_self',
    'color' => 'primary',
    'disabled' => false,
    'permission' => '',
    'icon' => '',
    'title' => null,
    'soft' => false,
    'outline' => false,
    'glass' => false,
    'block' => false,
    'no_animation' => false,
    'active' => false,
    'loading' => false,
    'size' => 'sm',
    'icon_position' => 'right',
    'dashed' => false,
    'shape' => '',
    'button' => false,
    'is_submit' => true,
    'wire' => false,
])

@php
    $colorClasses = [
        'primary' => 'bg-accent',
        'secondary' => 'btn-secondary',
        'accent' => 'btn-accent',
        'success' => 'btn-success',
        'danger' => 'btn-error',
        'warning' => 'btn-warning',
        'info' => 'btn-info',
        'dark' => 'btn-dark',
        'light' => 'btn-light',
        'ghost' => 'btn-ghost',
        'link' => 'btn-link',
        'neutral' => 'btn-neutral dark:text-white',
    ];

    $sizeClasses = [
        'lg' => 'btn-lg',
        'md' => 'btn-md',
        'sm' => 'btn-sm',
        'xs' => 'btn-xs',
    ];

    $buttonColorClass = $colorClasses[$color] ?? 'bg-accent';
    $buttonSizeClass = $sizeClasses[$size] ?? '';

    $baseClasses = 'btn uppercase tracking-widest';
    $shapeClass = !empty($shape) && in_array($shape, ['circle', 'square']) ? 'btn-' . $shape : 'rounded-md';

    $shouldHaveWhiteText = true;
    if ($soft || $outline || $glass || $dashed || in_array($color, ['ghost', 'link', 'light', 'dark'])) {
        $shouldHaveWhiteText = false;
    }

    $finalClasses = trim(
        $baseClasses .
            ' ' .
            $buttonColorClass .
            ' ' .
            $buttonSizeClass .
            ' ' .
            $shapeClass .
            ' ' .
            ($soft ? 'btn-soft' : '') .
            ' ' .
            ($outline ? 'btn-outline' : '') .
            ' ' .
            ($glass ? 'btn-glass' : '') .
            ' ' .
            ($block ? 'btn-block' : '') .
            ' ' .
            ($no_animation ? 'no-animation' : '') .
            ' ' .
            ($active ? 'btn-active' : '') .
            ' ' .
            ($loading ? 'btn-loading' : '') .
            ' ' .
            ($disabled ? 'btn-disabled' : '') .
            ' ' .
            ($dashed ? 'btn-dash' : '') .
            ' ' .
            ($shouldHaveWhiteText ? 'text-white' : ''),
    );

    $mergedAttributes = $attributes->merge([
        'class' => $finalClasses,
        'title' => $title ?? ($slot->isNotEmpty() ? strip_tags($slot) : ''),
    ]);
@endphp

@if (!empty($permission))
    {{-- @if (Auth::user()->can($permission)) --}}
    @if ($button)
        <button {{ $disabled ? 'disabled' : '' }} {{ $mergedAttributes }}
            type="{{ $is_submit ? 'submit' : 'button' }}}}">
            @if ($icon_position === 'left')
                @if ($loading)
                    <span class="loading loading-spinner mr-1"></span>
                @elseif (!empty($icon))
                    <i data-lucide="{{ $icon }}" class="w-4 h-4 mr-1"></i>
                @endif
            @endif
            {{ $slot }}
            @if ($icon_position === 'right')
                @if ($loading)
                    <span class="loading loading-spinner ml-1"></span>
                @elseif (!empty($icon))
                    <i data-lucide="{{ $icon }}" class="w-4 h-4 ml-1"></i>
                @endif
            @endif
        </button>
    @else
        <a {{ $disabled ? 'disabled' : '' }} href="{{ $href }}" target="{{ $target }}"
            {{ $wire ? 'wire:navigate' : '' }} {{ $mergedAttributes }}>
            @if ($icon_position === 'left')
                @if ($loading)
                    <span class="loading loading-spinner mr-1"></span>
                @elseif (!empty($icon))
                    <i data-lucide="{{ $icon }}" class="w-4 h-4 mr-1"></i>
                @endif
            @endif
            {{ $slot }}
            @if ($icon_position === 'right')
                @if ($loading)
                    <span class="loading loading-spinner ml-1"></span>
                @elseif (!empty($icon))
                    <i data-lucide="{{ $icon }}" class="w-4 h-4 ml-1"></i>
                @endif
            @endif
        </a>
    @endif
    {{-- @endif --}}
@else
    @if ($button)
        <button {{ $disabled ? 'disabled' : '' }} {{ $mergedAttributes }}
            type="{{ $is_submit ? 'submit' : 'button' }}">
            @if ($icon_position === 'left')
                @if ($loading)
                    <span class="loading loading-spinner mr-1"></span>
                @elseif (!empty($icon))
                    <i data-lucide="{{ $icon }}" class="w-4 h-4 mr-1"></i>
                @endif
            @endif
            {{ $slot }}
            @if ($icon_position === 'right')
                @if ($loading)
                    <span class="loading loading-spinner ml-1"></span>
                @elseif (!empty($icon))
                    <i data-lucide="{{ $icon }}" class="w-4 h-4 ml-1"></i>
                @endif
            @endif
        </button>
    @else
        <a {{ $disabled ? 'disabled' : '' }} href="{{ $href }}" target="{{ $target }}"
            {{ $mergedAttributes }} {{ $wire ? 'wire:navigate' : '' }} {{ $mergedAttributes }}>
            @if ($icon_position === 'left')
                @if ($loading)
                    <span class="loading loading-spinner mr-1"></span>
                @elseif (!empty($icon))
                    <i data-lucide="{{ $icon }}" class="w-4 h-4 mr-1"></i>
                @endif
            @endif
            {{ $slot }}
            @if ($icon_position === 'right')
                @if ($loading)
                    <span class="loading loading-spinner ml-1"></span>
                @elseif (!empty($icon))
                    <i data-lucide="{{ $icon }}" class="w-4 h-4 ml-1"></i>
                @endif
            @endif
        </a>
    @endif
@endif
 
