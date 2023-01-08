<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategorySubResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\CategorySub;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('FrontEnd/Home/Index',[
            'categories' => Category::with('category_sub')->latest()->get(),
            'products' => ProductResource::collection(Product::all()),
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show_products(Category $category)
    {
        // $categories = new CategoryResource($category);

        return inertia('FrontEnd/Products/Index',[
            'products' => ProductResource::collection($category->product)
        ]);
    }
}
