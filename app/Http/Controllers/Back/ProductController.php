<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategorySubResource;
use App\Http\Resources\ProductResource;
use App\Http\Responses\ProductResponse;
use App\Models\Category;
use App\Models\CategorySub;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('BackEnd/Products/Index',[
            'products'=> ProductResource::collection(Product::with('category')->latest()->get())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('BackEnd/Products/Create' ,[
            'categories' => CategoryResource::collection(Category::latest()->get()),
            'category_subs' => CategorySubResource::collection(CategorySub::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        return new ProductResponse(new Product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render('BackEnd/Products/Update',[
            'product' => $product,
            'category' => CategoryResource::collection(Category::latest()->get()),
            'category_subs' => CategorySubResource::collection(CategorySub::all()),
            'image' => $product->getFirstMediaUrl('product')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        dd($product);
        return new ProductResponse($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->delete()){
            $product->clearMediaCollection('product');
            return Redirect::route('product.index');
        }
        return back()->withErrors(__('You cannot delete yourself!'));
    }

}
