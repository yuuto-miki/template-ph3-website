<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー一覧</title>
</head>
<body>
    <h1>ユーザー一覧</h1>
    
    <ul>
        {{-- コントローラーから渡された $users の中身を1つずつ取り出してループする --}}
        @foreach ($users as $user)
            <li>
                名前：{{ $user->name }} <br>
                メール：{{ $user->email }}
            </li>
            <hr>
        @endforeach
    </ul>
</body>
</html>