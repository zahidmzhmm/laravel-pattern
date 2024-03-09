<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Blog List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl bg-slate-100 py-5 rounded-xl mx-auto sm:px-6 lg:px-8 space-y-5">
            @include("errors")
            <ul role="list" class="divide-y divide-gray-100">
                @if($data->count()>=1)
                    @foreach($data as $blog)
                        <li class="flex justify-between bg-slate-200 hover:bg-slate-300 gap-x-6 rounded-md duration-300 mb-2 p-5">
                            <div class="flex min-w-0 gap-x-4">
                                <div class="min-w-0 flex-auto">{{ $blog->title }}</div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <a href="{{ route("blog.show",["blog"=>$blog->id]) }}"
                                   class="bg-green-400 px-3 py-2 text-xs rounded-lg text-white">View</a>
                                <a href="{{ route("blog.edit",["blog"=>$blog->id]) }}"
                                   class="bg-blue-400 px-3 py-2 text-xs rounded-lg text-white">Edit</a>
                                <form action="{{ route("blog.destroy",["blog"=>$blog->id]) }}" method="post"
                                      class="bg-red-400 px-3 py-2 text-xs rounded-lg text-white">
                                    @method("delete")
                                    @csrf
                                    <button type="submit">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="text-center">
                        No Blogs Found
                    </li>
                @endif
            </ul>
        </div>
    </div>
</x-app-layout>
