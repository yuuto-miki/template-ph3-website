<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            クイズ一覧
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-8">
        @if(session('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">成功！</strong>
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            @foreach ($quizzes as $quiz)
                <div class="bg-white shadow-sm rounded-lg p-6 border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">
                        {{ $quiz->name }}
                    </h3>
                    
                    <div class="flex gap-2 mt-4">
                        <a href="{{ route('quizzes.show', $quiz->id) }}" class="inline-block px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700 transition">
                            クイズに挑戦する
                        </a>
                        
                        <a href="{{ route('quizzes.edit', $quiz->id) }}" class="inline-block px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 transition">
                            編集
                        </a>
                        <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" 
                            onsubmit="return confirm('「{{ $quiz->name }}」を本当に削除してもよろしいですか？');">
                            @csrf
                            @method('DELETE') <!-- DELETEメソッドを指定 -->
                            <button type="submit" class="inline-block px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700 transition cursor-pointer">
                                削除
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>