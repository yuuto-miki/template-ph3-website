<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            一覧表示
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-8">
        
        @foreach ($posts as $post)
            <div class="mt-4 p-8 bg-white w-full rounded-2xl shadow-sm">
                <h1 class="p-4 text-lg font-semibold">
                    {{ $post->title }}
                </h1>
                
                <hr class="w-full">
                
                <p class="mt-4 p-4">
                    {{ $post->body }}
                </p>
                
                <div class="p-4 text-sm font-semibold text-gray-500">
                    {{ $post->created_at->format('Y/m/d H:i') }}/{{ $post->user->name }}
                </div>
            </div>
        @endforeach
        
    </div>
</x-app-layout>