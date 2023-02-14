<?php

namespace App\Http\Responses;

use App\Models\Product;
use Illuminate\Contracts\Support\Responsable;

class ProductResponse implements Responsable
{
    private Product $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function toResponse($request)
    {
        $product = Product::updateOrCreate([
            'id' => $this->product->id,
        ], [
            'category_sub_id' => $request->category_sub_id,
            'name' => $request->input('name'),
            'link' => $request->input('link')
        ]);

        if($image = $request->file('image')){
            $product->clearMediaCollection('product');
            $product->addMedia($image)
                ->toMediaCollection('product');
        }

        return redirect()->route('product.index');
    }
}
