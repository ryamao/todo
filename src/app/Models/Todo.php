<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'content'];

    public function scopeCategorySearch(Builder $builder, ?string $categoryId): void
    {
        if (empty($categoryId)) return;
        $builder->where('category_id', $categoryId);
    }

    public function scopeKeywordSearch(Builder $builder, ?string $keyword): void
    {
        if (empty($keyword)) return;
        $builder->where('content', 'like', "%{$keyword}%");
    }
}
