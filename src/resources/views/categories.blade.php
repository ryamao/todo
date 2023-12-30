@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/categories.css') }}" />
@endsection

@section('content')
<div class="category__content">
    <div class="category-form">
        <form class="category-form__inner" action="/categories" method="post">
            @csrf
            <input type="hidden" name="action" value="store" />
            <div class="category-form__name">
                <input type="text" name="name" value="{{ old('action') === 'store' ? old('name') : '' }}" />
            </div>
            <div class="category-form__create">
                <button>作成</button>
            </div>
        </form>
    </div>

    <div class="category-list">
        <h2 class="category-list__heading">category</h2>
        <ul class="category-list__inner">
            @foreach($categories as $category)
            <li class="category-list__item">
                <div class="category-list__name">
                    <input form="category-list__update-form-{{ $category->id }}" type="text" name="name" value="{{ $category->name }}" />
                </div>
                <div class="category-list__buttons">
                    <form class="category-list__update-form" id="category-list__update-form-{{ $category->id }}" action="/categories/update" method="post">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="action" value="update" />
                        <input type="hidden" name="id" value="{{ $category->id }}" />
                        <button>更新</button>
                    </form>
                    <form class="category-list__delete-form" action="/categories/delete" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="action" value="destroy" />
                        <input type="hidden" name="id" value="{{ $category->id }}" />
                        <button>削除</button>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection