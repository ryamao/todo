@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="todo__content">
    <div class="todo-form">
        <form class="todo-form__inner" action="/todos" method="post">
            @csrf
            <input type="hidden" name="action" value="store" />
            <h2 class="todo-form__heading">新規作成</h2>
            <div class="todo-form__controls">
                <div class="todo-form__inputs">
                    <div class="todo-form__input-text">
                        <input type="text" name="content" value="{{ old('action') === 'store' ? old('content') : '' }}" />
                    </div>
                    <div class="todo-form__input-category">
                        <select name="category_id">
                            <option value="">カテゴリ</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="todo-form__button">
                    <button class="todo-form__button-submit">作成</button>
                </div>
            </div>
        </form>

        <form class="todo-form__inner" action="/todos/search" method="get">
            @csrf
            <input type="hidden" name="action" value="search" />
            <h2 class="todo-form__heading">Todo検索</h2>
            <div class="todo-form__controls">
                <div class="todo-form__inputs">
                    <div class="todo-form__input-text">
                        <input type="text" name="keyword" value="{{ session('search_keyword') }}" />
                    </div>
                    <div class="todo-form__input-category">
                        <select name="category_id">
                            <option value="">カテゴリ</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ session('search_category_id') === strval($category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="todo-form__button">
                    <button class="todo-form__button-submit">検索</button>
                </div>
            </div>
        </form>
    </div>

    <div class="todo-table">
        <table class="todo-table__inner">
            <tr class="todo-table__row">
                <th class="todo-table__header">Todo</th>
                <th class="todo-table__header">カテゴリ</th>
                <td class="todo-table__empty"></td>
            </tr>

            @foreach ($todos as $todo)
            <tr class="todo-table__row">
                <td class="todo-table__content">
                    <input form="update-form-{{ $todo->id }}" type="text" name="content" value="{{ $todo->content }}" />
                </td>
                <td class="todo-table__category">
                    <select form="update-form-{{ $todo->id }}" name="category_id">
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $todo->category_id === $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="todo-table__buttons">
                    <form class="todo-table__update-form" id="update-form-{{ $todo->id }}" action="/todos/update" method="post">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="action" value="update" />
                        <input type="hidden" name="id" value="{{ $todo->id }}" />
                        <button class="todo-table__update-button">更新</button>
                    </form>
                    <form class="todo-table__delete-form" action="/todos/delete" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="action" value="delete" />
                        <input type="hidden" name="id" value="{{ $todo->id }}" />
                        <button class="todo-table__delete-button">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection