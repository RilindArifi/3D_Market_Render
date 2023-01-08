<?php

namespace App\Http\Responses;

use App\Models\Category;
use Illuminate\Contracts\Support\Responsable;

class CategoryResponse implements Responsable
{
    public function __construct(private Category $category)
    {

    }

    public function toResponse($request)
    {
        Category::updateOrCreate([
            'id' => $this->category->id,
        ], [
            'name' => $request->input('name')
        ]);

        return redirect()->route('category.index');
    }
}
