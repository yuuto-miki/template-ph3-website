<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $quiz->name }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-8">
        <div id="quiz-container">
            @foreach($quiz->questions as $index => $question)
                <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-bold mb-4">
                        第{{ $index + 1 }}問：{{ $question->text }}
                    </h3>

                    <div class="flex flex-col space-y-3">
                        @foreach($question->choices as $choice)
                            <button type="button" 
                                    class="choice-btn text-left p-3 border rounded-md hover:bg-indigo-50 transition duration-150"
                                    data-correct="{{ $choice->is_correct }}">
                                {{ $choice->text }}
                            </button>
                        @endforeach
                    </div>

                    <div class="result-message mt-4 font-bold text-xl hidden"></div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        // 画面が読み込まれたら実行
        document.addEventListener('DOMContentLoaded', function() {
            // クイズの選択肢（ボタン）をすべて取得
            const buttons = document.querySelectorAll('.choice-btn');

            buttons.forEach(button => {
                // 選択肢がクリックされた時の処理
                button.addEventListener('click', function() {
                    // 同じ問題（親のdiv）の中にある要素を探す
                    const parent = this.closest('.bg-white');
                    const siblings = parent.querySelectorAll('.choice-btn');
                    const resultMessage = parent.querySelector('.result-message');

                    // 1度答えたら、他のボタンは押せなくする
                    siblings.forEach(btn => btn.disabled = true);
                    resultMessage.classList.remove('hidden');

                    // クリックしたボタンの data-correct 属性が "1" (true) かどうかで判定！
                    if (this.dataset.correct === "1") {
                        // 正解の時の見た目変更
                        this.classList.add('bg-green-100', 'border-green-500', 'text-green-800');
                        resultMessage.textContent = "⭕ 正解！";
                        resultMessage.classList.add('text-green-600');
                    } else {
                        // 不正解の時の見た目変更
                        this.classList.add('bg-red-100', 'border-red-500', 'text-red-800');
                        resultMessage.textContent = "❌ 不正解...";
                        resultMessage.classList.add('text-red-600');

                        // さらに、どれが正解だったか緑色にして教えてあげる（親切UI）
                        siblings.forEach(btn => {
                            if (btn.dataset.correct === "1") {
                                btn.classList.add('bg-green-100', 'border-green-500', 'text-green-800');
                            }
                        });
                    }
                });
            });
        });
    </script>
</x-app-layout>