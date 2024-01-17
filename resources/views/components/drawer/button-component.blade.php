<button type="button" id="{{ $id }}"
    {{ $additionalAttributes ?? '' }}
    data-drawer-target="{{ $drawerId }}"
    data-drawer-show="{{ $drawerId }}" aria-controls="{{ $drawerId }}"
    data-drawer-placement="right"
    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-{{ $color }}-700 hover:bg-{{ $color }}-800 focus:ring-4 focus:ring-{{ $color }}-300 dark:bg-{{ $color }}-600 dark:hover:bg-{{ $color }}-700 dark:focus:ring-{{ $color }}-800">
    <i class="{{ $iconClass }} mr-2"></i> {{ $text }}
</button>