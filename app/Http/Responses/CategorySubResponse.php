<?php

namespace App\Http\Responses;

use App\Models\CategorySub;
use Illuminate\Contracts\Support\Responsable;

class CategorySubResponse implements Responsable
{
    public function __construct(private CategorySub $categorySub)
    {

    }

    public function toResponse($request)
    {
        CategorySub::updateOrCreate([
            'id' => $this->categorySub->id,
        ], [
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name')
        ]);

        return redirect()->route('category_sub.index');
    }
}
