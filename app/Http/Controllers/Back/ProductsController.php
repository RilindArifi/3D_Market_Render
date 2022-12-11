<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $product = ProductResource::collection(Product::with('category')->orderBy('id', 'DESC')->get());
        return Inertia::render('BackEnd/Products/Index',[
            'product'=> $product
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = CategoryResource::collection(Category::orderBy('id', 'DESC')->get());
        return Inertia::render('BackEnd/Products/Create' , compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create([
            'name' => $request->input('name'),
            'category_id' => $request->category_id,
            'link' => $request->input('link'),
        ]);
        $product->addMediaFromRequest('image')
            ->toMediaCollection('product');

        return Redirect::route('product.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $category = Category::all();
        return Inertia::render('BackEnd/Products/Update',[
            'product' => $product,
            'category' => $category,
            'image' => $product->getFirstMediaUrl('product')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'link' => $request->link,
        ]);

        if($request->file('image')){
            $product->clearMediaCollection('product');
            $product->addMediaFromRequest('image')
                ->toMediaCollection('product');
        }
        return Redirect::route('product.index');
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
