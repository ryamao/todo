<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        return view('categories', compact('categories'));
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());
        return redirect('/categories')->with('message', 'カテゴリを作成しました');
    }

    public function update(CategoryRequest $request): RedirectResponse
    {
        $category = Category::find($request->input('id'));
        $category->update($request->validated());
        return redirect('/categories')->with('message', 'カテゴリを更新しました');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Category::find($request->input('id'))->delete();
        return redirect('/categories')->with('message', 'カテゴリを削除しました');
    }
}
