<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use PHPUnit\Util\Json;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('categories.view.any');
        // return Category::get();
       return response()->json(CategoryResource::collection(Category::with('children')->paginate(15)), 200, [
           'x-application_name' => config('app.name')
       ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'parent_id' => 'int|nullable|exists:categories,id'
        ]);

        $category = Category::create($request->all());
        return  response()->json($category->refresh(), 201);
        // return $category->refresh();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(new CategoryResource(Category::findOrFail($id)), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['sometimes','required'],
            'parent_id' => 'int|nullable|exists:categories,id'
        ]);
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return response()->json(new CategoryResource($category), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(['message' => 'Category is deleted'], 201);

    }
}
