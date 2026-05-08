<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            クイズを編集
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-8">
        <form method="POST" action="{{ route('quizzes.update', $quiz->id) }}">
            @csrf
            @method('PATCH')
            
            <div class="mt-8">
                <div class="w-full flex flex-col">
                    <label for="name" class="font-semibold mt-4">クイズタイトル</label>
                    <input type="text" name="name" class="w-auto py-2 border border-gray-300 rounded-md" id="name" value="{{ old('name', $quiz->name) }}">
                    @error('name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="flex gap-4 mt-4">
                    <x-primary-button>
                        更新する
                    </x-primary-button>
                    <a href="{{ route('quizzes.index') }}" class="inline-block px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                        キャンセル
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
