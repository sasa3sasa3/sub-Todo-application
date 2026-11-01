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

        @error('content')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </header>

    <main class="container">
        <h2>新規作成</h2>

        <form class="create-form" action="{{ route('todos.store') }}" method="POST">
            @csrf
            <input class="create-input" type="text" name="content">

            <select name="category_id">
                <option value="">カテゴリ</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <button class="create-btn" type="submit">作成</button>
        </form>

        <h2>Todo検索</h2>

        <form class="search-form" action="{{ route('todos.search') }}" method="GET" class="form-row">

            <input class="search-input" type="text" name="keyword">

            <select name="category_id">
                <option value="">カテゴリ</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <button class="search-btn" type="submit">検索</button>
        </form>


        <div class="todo-list">
            <div class="todo-table-header">
                <span class="col-todo">Todo</span>
                <span class="col-category">カテゴリ</span>
            </div>

            @foreach ($todos as $todo)
                <div class="todo-item">
                    <form class="update-form" action="{{ route('todos.update', $todo->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input class="update-input" type="text" name="content" value="{{ $todo->content }}">

                        <select class="update-select" name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <button class="update-btn" type="submit">更新</button>
                    </form>

                    <form class="delete-form" action="{{ route('todos.destroy', $todo->id) }}" method="POST">
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