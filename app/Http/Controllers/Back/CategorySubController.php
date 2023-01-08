<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategorySubRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategorySubResource;
use App\Http\Responses\CategorySubResponse;
use App\Models\Category;
use App\Models\CategorySub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CategorySubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('BackEnd/SubCategory/Index',[
            'category_sub'=> CategorySubResource::collection(CategorySub::latest()->get())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('BackEnd/SubCategory/Create',[
            'categories' => CategoryResource::collection(Category::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategorySubRequest $request)
    {
        return new CategorySubResponse(new CategorySub);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategorySub  $categorySub
     * @return \Illuminate\Http\Response
     */
    public function edit(CategorySub $categorySub)
    {
        return Inertia::render('BackEnd/SubCategory/Update',[
            'category_sub' => $categorySub,
            'categories' => CategoryResource::collection(Category::all())
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategorySub  $categorySub
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategorySub $categorySub)
    {
        return new CategorySubResponse($categorySub);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategorySub  $categorySub
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategorySub $categorySub)
    {
        if($categorySub->delete()){
            return back();
        }
        return back()->withErrors(__('You cannot delete yourself!'));
    }
}
