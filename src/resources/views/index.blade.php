@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="todo__content">
    <div class="todo__message">
        @if(session()->has('message'))
        <div class="todo__message--success">{{ session('message') }}</div>
        @endisset
        @error('content')
        <ul class="todo__message--error">
            <li>{{ $message }}</li>
        </ul>
        @enderror
    </div>
    <form class="create-form" action="/todos" method="post">
        @csrf
        <div class="create-form__inner">
            <div class="create-form__text">
                <input class="create-form__text-input" type="text" name="content" />
            </div>
            <div class="create-form__button">
                <button class="create-form__button-submit">作成</button>
            </div>
        </div>
    </form>
    <div class="todo-list">
        <h2 class="todo-list__heading">Todo</h2>
        <ul class="todo-list__inner">
            @foreach ($todos as $todo)
            <li class="todo-list__item">
                <div class="todo-list__text">
                    <input class="todo-list__text-input" form="update-form-{{ $todo->id }}" type="text" name="content" value="{{ $todo->content }}" />
                </div>
                <div class="todo-list__button">
                    <form class="update-form" id="update-form-{{ $todo->id }}" action="/todos/update" method="post">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="id" value="{{ $todo->id }}" />
                        <button class="update-form__button-submit">更新</button>
                    </form>
                    <form class="delete-form" action="/todos/delete" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" value="{{ $todo->id }}" />
                        <button class="delete-form__button-submit">削除</button>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection