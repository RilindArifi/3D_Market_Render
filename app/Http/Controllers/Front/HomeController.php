<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('FrontEnd/Home/Index',[
            'categories' => Category::with('category_sub')->latest()->get(),
            'products' => ProductResource::collection(Product::query()
                ->when($request->filter, function ($query, $search) {
                    $query->where('category_sub_id', $search);
                })
                ->when($request->filled(['orderBy', 'orderByDir']), fn(Builder $builder) => $builder->orderBy($request->input('orderBy'), $request->input('orderByDir')))
                ->latest()
                ->paginate(8)
                ->withQueryString(),
            ),
            'productsCarousel' => ProductResource::collection(Product::latest()->paginate(4))
        ]);
    }

}
