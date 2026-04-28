<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            クイズ一覧
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            @foreach ($quizzes as $quiz)
                <a href="{{ route('quizzes.show', $quiz->id) }}" class="block bg-white shadow-sm rounded-lg p-6 border border-gray-200 hover:bg-indigo-50 hover:border-indigo-300 transition duration-150 ease-in-out cursor-pointer">
                    <h3 class="text-lg font-bold text-gray-900">
                        {{ $quiz->name }}
                    </h3>
                    
                    <p class="mt-4 text-sm font-semibold text-indigo-600">
                        クイズに挑戦する &rarr;
                    </p>
                </a>
                @endforeach

        </div>
    </div>
</x-app-layout>