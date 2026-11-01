<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todoアプリ</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <div class="header-container">
            <h1><a href="{{ route('todos.index') }}">Todo</a></h1>

            <a href="{{ route('categories.index') }}">カテゴリ一覧</a>
        </div>

        @if (session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif

        @error('name')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </header>

    <main class="container">
        <form class="create-form" action="{{ route('categories.store') }}" method="POST">
            @csrf
            <input class="create-input" type="text" name="name">
            <button class="create-btn" type="submit">作成</button>
        </form>

        <h2>category</h2>

        <div class="category-list">
            @foreach ($categories as $category)
                <div class="category-item">
                    <span class="category-content">{{ $category->name }}</span>

                    <form class="update-form" action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input class="update-input" type="text" name="name" value="{{ $category->name }}">
                        <button class="update-btn" type="submit">更新</button>
                    </form>

                    <form class="delete-form" action="{{ route('categories.destroy', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="delete-btn" type="submit">削除</button>
                    </form>
                </div>
            @endforeach
        </div>
    </main>
</body>
</html>