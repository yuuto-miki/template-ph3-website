<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                クイズ管理一覧
            </h2>
            {{-- ▼ 新規作成ボタン ▼ --}}
            <a href="{{ route('admin.quizzes.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm">
                新規作成
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-8">
        @if(session('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('message') }}
            </div>
        @endif

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">クイズタイトル</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">操作</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($quizzes as $quiz)
                        <tr class="{{ $quiz->trashed() ? 'bg-gray-50' : '' }}">
                            <td class="px-6 py-4">
                                @if($quiz->trashed())
                                    {{-- ▼ 削除済みの場合：グレーのテキストとラベル ▼ --}}
                                    <span class="text-gray-400 font-medium">{{ $quiz->name }}</span>
                                    <span class="ml-2 px-2 py-1 text-xs bg-gray-200 text-gray-500 rounded">削除済み</span>
                                @else
                                    <a href="{{ route('admin.questions.index', $quiz) }}" class="text-indigo-600 hover:text-indigo-900 font-bold">
                                        {{ $quiz->name }}
                                    </a>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right flex justify-end gap-3">
                                @if(!$quiz->trashed())
                                    <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="text-blue-600 hover:text-blue-900">編集</a>
                                    
                                    {{-- ▼ 削除ボタン ▼ --}}
                                    <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST" 
                                          onsubmit="return confirm('本当に削除しますか？');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">削除</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $quizzes->links() }}</div>
    </div>
</x-app-layout>