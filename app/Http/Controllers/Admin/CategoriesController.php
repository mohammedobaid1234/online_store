<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Rules\Filter;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Str;
use App\Http\Requests\CategoryRequest;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Throwable;

class CategoriesController extends Controller
{
    public function __constructor()
    {
        $this->middleware('auth');
    }
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        Gate::authorize('categories.view');
        
        $categories = Category::join('categories as parent', 'categories.parent_id', '=', 'parent.id')
            ->select([
                'categories.*',
                'parent.name as parent_num'
            ])
            
            ->withCount('products as productCount')
            ->orderBy('updated_at', 'DESC')
            ->withTrashed()
            ->paginate(10, ['*']);
            // return $categories;
        return view('admin/categories/index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prevCategories = new Category();

        $categories = Category::pluck('name','id');
        return view('admin/categories/create', [
            'categories' => $categories,
            'prevCategories' => $prevCategories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        // dd(request('name'));
        // $rules = [
        //     'name' => ['required',
        //              'min:3', 
        //             'string', 
        //             'max:255',
        //             // function ($attribute, $value, $fail) 
        //             //     {
        //             //         if(stripos($value, 'gad') !== false){
        //             //             $fail("you can't put $value word");
        //             //         }
        //             //     }
        //             new Filter(['larval' , 'php', 'gat'])
        //             // 'Filter:php'
        //         ],
        //     'parent_id'=>['nullable', 'int','exists:categories,id'],
        //     'description' => ['nullable', 'min:3', 'string'],
        //     'status'=> ['required', 'in:active,draft'],
        //     'image'=> ['nullable', 'image','dimensions:min_width=100']
        // ];
        // try{

        //     $date = $request->all();
        //     $validation =  FacadesValidator::make($date, $rules,[
        //         'required.name' => 'Category Name'
        //     ]);
        //     $msg = $validation->errors()->all();
        //     $clean = $validation->validate();

        // }catch(Throwable $e){
        //     // dd();
        //     return redirect()->route('categories.create')->withErrors($validation)->withInput() ;       
        //   }
        $name = $request->name;
        $request->merge([
            'status' => 'active',
        ]);
        // dd($request);

        $category = new Category($request->except('_token', '_method'));
        $category->save();
        // dd($category);
        return redirect()->route('categories.index')->with('succuss', 'The ' . $name . ' Category Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {   
        
        $category = Category::where('slug', $slug)->first();
        
        $products = $category->load('products');
        
        return view('admin/categories/show', [
            'products' => $products->products,
            'category_id' => $category->id,
            'category_name' => $category->name,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories1 = Category::withTrashed()->where('id', '<>', '$id')->pluck('name','id');
        $categories2 = Category::findOrFail($id);

        return view('admin/categories/edit', [
            "categories" => $categories1,
            "prevCategories" => $categories2,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        // 
        // $validated =  $request->validate();
        // $request->validate([
        //     'name' => Rule::unique('categories')->ignore($request->id) ///////////////////??
        // ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image_path = $file->store('/', [
                'disk' => 'special'
            ]);
            // $file_name = $image_path->getClientOriginalName();
            // dd($image_path);
            $request->merge([
                'image_path' => $image_path
            ]);
            // dd($request);
        }
        // dd($image_path);
        // dd($request);
        Category::where('id', '=', $id)->update($request->except('_token', '_method','image'));
        return redirect()->route('categories.index')->with('succuss', 'Category ' . Category::where('id', '=', $id)->first('name')->name  . ' Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::findOrFail($id);
        // Storage::disk('special')->delete($category->image_path);
        $name = Category::where('id', '=', $id)->first('name')->name;
        Category::where('id', '=', $id)->delete();
        return redirect()->route('categories.index')->with('delete', 'Category ' . $name  . ' was Deleted');
    }
   
}
