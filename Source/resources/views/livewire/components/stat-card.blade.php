<div class="bg-white p-4 rounded-lg ring-2 ring-gray-200">
    <div class="flex items-center justify-between">
        <div class="flex flex-col gap-2">
            <h1 class="text-gray-500 text-sm">{{ $title }}</h1>
            <p class="text-gray-900 font-semibold text-xl">{{ $value }}</p>
        </div>
        <x-dynamic-component :component="$icon" class="size-6" />
    </div>
</div>
