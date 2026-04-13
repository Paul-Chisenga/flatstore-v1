 @php
     $currentUrl = url()->current();
     $isActive = str_contains($currentUrl, $attributes->get('href'));
     $activeClass = $isActive ? 'bg-card text-foreground' : '';
 @endphp

 <a
     {{ $attributes->merge([
         'class' => twMerge('text-sm font-medium text-gray-200  hover:text-gray-300 px-4 py-2 rounded-full', $activeClass),
     ]) }}>
     {{ $slot }}
 </a>
