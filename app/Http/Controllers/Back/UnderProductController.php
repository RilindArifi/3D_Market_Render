<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnderProductRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UnderProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\UnderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class UnderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $underproduct = UnderProductResource::collection(UnderProduct::with('category','product')->orderBy('id', 'DESC')->get());

        return Inertia::render('BackEnd/UnderProduct/Index' ,[
            'underproduct'=> $underproduct,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = CategoryResource::collection(Category::all());
        $product = ProductResource::collection(Product::all());
        return Inertia::render('BackEnd/UnderProduct/Create', compact('category','product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnderProductRequest $request)
    {
        $under_product = UnderProduct::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'product_id' => $request->product_id,
            'link' => $request->link,
        ]);
        $under_product->addMediaFromRequest('image')
                        ->toMediaCollection('under_product');

        return Redirect::route('underproduct.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $underproduct = UnderProduct::findOrFail($id);
        $category = CategoryResource::collection(Category::all());
        $product = ProductResource::collection(Product::all());

        return Inertia::render('BackEnd/UnderProduct/Update',[
            'underproduct' => $underproduct,
            'products' => $product,
            'categories' => $category,
            'image' => $underproduct->getFirstMediaUrl('under_product')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UnderProductRequest $request, $id)
    {
        $underProduct = UnderProduct::find($id);
        $underProduct->update([
            'category_id' => $request->category_id,
            'product_id' => $request->product_id,
            'name' => $request->name,
            'link' => $request->link,
        ]);
        if($request->file('image')){
            $underProduct->clearMediaCollection('under_product');
            $underProduct->addMediaFromRequest('image')
                ->toMediaCollection('under_product');
        }

        return Redirect::route('underproduct.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $underProduct = UnderProduct::find($id);
        if($underProduct->delete()){
            $underProduct->clearMediaCollection('under_product');
            return Redirect::route('underproduct.index');
        }
        return back()->withErrors(__('You cannot delete!'));
    }
}
