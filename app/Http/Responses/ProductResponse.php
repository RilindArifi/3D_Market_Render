<?php

namespace App\Http\Responses;

use App\Models\Product;
use Illuminate\Contracts\Support\Responsable;

class ProductResponse implements Responsable
{
    public function __construct(private Product $product)
    {

    }

    public function toResponse($request)
    {
        $product = Product::updateOrCreate([
            'id' => $this->product->id,
        ], [
            'category_id' => $request->category_id,
            'category_sub_id' => $request->category_sub_id,
            'name' => $request->input('name'),
            'link' => $request->input('link')
        ]);

        if($request->file('image')){
            $product->clearMediaCollection('product');
            $product->addMediaFromRequest('image')
                ->toMediaCollection('product');
        }

        return redirect()->route('product.index');
    }
}
