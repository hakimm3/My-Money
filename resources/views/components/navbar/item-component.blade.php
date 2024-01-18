@if ($isActive)
    <li>
        <a href="{{ $route }}" class="block rounded text-primary-700 dark:text-primary-500" aria-current="page">{{ $text }}</a>
    </li>
@else
    <li>
        <a href="{{ $route }}" class="block text-gray-700 hover:text-primary-700 dark:text-gray-400 dark:hover:text-white">{{ $text }}</a>
    </li>
@endif
