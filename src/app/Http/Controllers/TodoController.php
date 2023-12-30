<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TodoController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        $todos = Todo::all();
        return view('index', compact('categories', 'todos'));
    }

    public function store(TodoRequest $request): RedirectResponse
    {
        $formData = $request->validated();
        Todo::create($formData);
        return redirect('/')->with('message', 'Todoを作成しました');
    }

    public function update(TodoRequest $request): RedirectResponse
    {
        $formData = $request->validated();
        $todo = Todo::find($request->input('id'));
        $todo->update($formData);
        return redirect('/')->with('message', 'Todoを更新しました');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Todo::find($request->input('id'))->delete();
        return redirect('/')->with('message', 'Todoを削除しました');
    }

    public function search(Request $request): View
    {
        $formCategoryId = $request->input('category_id');
        $formKeyword = $request->input('keyword');
        $todos = Todo::categorySearch($formCategoryId)
            ->keywordSearch($formKeyword)
            ->get();

        $categories = Category::all();

        $request->session()->now('search_keyword', $formKeyword);
        $request->session()->now('search_category_id', $formCategoryId);
        return view('index', compact('categories', 'todos'));
    }
}
