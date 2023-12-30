<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="header__heading">
                <a class="header__logo" href="/">Todo</a>
            </h1>
            <nav class="header__nav">
                <div class="header__nav-item">
                    <a class="header__nav-link" href="/categories">カテゴリ一覧</a>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <div class="message">
            @if(session()->has('message'))
            <div class="message__text--success">{{ session('message') }}</div>
            @endisset
            @if($errors->any())
            <ul class="message__text--error">
                @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
            @endif
        </div>

        @yield('content')
    </main>
</body>

</html>