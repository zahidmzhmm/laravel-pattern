<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Show Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <p class="font-bold dark:text-white">{{ $blog->title }}</p>
                <p class="dark:text-white mt-3 text-sm">{{ $blog->content }}</p>
                <div class="mt-10">
                    <a href="{{ route("blog.index") }}" class="text-sm text-white px-2 py-1 rounded-xl bg-red-400">Back</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
