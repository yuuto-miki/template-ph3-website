<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            クイズの新規作成
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('admin.quizzes.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">問題タイトル</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    
                    {{-- ▼ バリデーションエラーの表示 ▼ --}}
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        登録する
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>