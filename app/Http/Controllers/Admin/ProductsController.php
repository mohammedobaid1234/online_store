<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use App\Scopes\ActiveStatusScope;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate as FacadesGate;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\Instanceof_;

class ProductsController extends Controller
{   

    public function __construct()
    {

        $this->middleware(['auth:admins', 'verified']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        // $roles = $user->load('roles');
        // $r = 
        // $roles = Role::whereRaw('roles.id IN(SELECT role_id FROM admin_roles
        //  WHERE admin_id = ?)' ,[
        //      $user->id
        //  ])->get();
        //  $roles = $roles->abilities;
         
        //  if('products.view' Instanceof $roles){
        //     return true;
        // }
        // return $roles;
        $this->authorize('view-any',Product::class);
        $products =  Product::withoutGlobalScope(ActiveStatusScope::class)->join('categories', 'categories.id', '=' ,'products.category_id')
        ->active()
        ->select([
            'products.*',
            'categories.name as category_name'
        ])
        ->orderBy('updated_at', 'DESC')
        ->paginate();
        
        return view('Admin/products/index' , [
            'products' => $products
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
        $this->authorize('create', Product::class);
        

        $prevProducts =new Product();
        $categories = Category::withoutGlobalScope(ActiveStatusScope::class)->withTrashed()->get();
        return view('admin/products/create', [
            'prevProducts' =>$prevProducts,
            'categories' => $categories
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
        //
        $this->authorize('create', Product::class);
        
        $name = $request->name;
        if($request->hasFile('image')){
            $uploadedFile = $request->file('image');
            $image_path = $uploadedFile->store('/',[
                'disk' => 'special'
            ]);
            $request->merge([
                'image_path' =>$image_path
            ]);
        }
        
        $newProduct = Product::create($request->except('_token','_method'));
        $newProduct->save();
        return redirect()->route('products.index')->with('succuss', 'The '. $name . ' Product Added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prevCategories  = Product::withoutGlobalScope(ActiveStatusScope::class)->findOrFail($id);
        
        $this->authorize('update', $prevCategories);

        $category = Category::withTrashed()->get(['id', 'name']);
        
        return view('admin/products/edit',[
            'prevProducts' => $prevCategories ,
            'categories'=> $category
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
        $updatedProduct = Product::withoutGlobalScope(ActiveStatusScope::class)->first();
        $this->authorize('product.update', $updatedProduct);

        if($request->hasFile('image')){
            $uploadedFile = $request->file('image');
            $image_path = $uploadedFile->store('/',[
                'disk' => 'special'
            ]);
            $request->merge([
                'image_path' =>$image_path
            ]);
            // dd($request);
        }
        $updatedProduct->where('id','=',$id)->update($request->except('_token', '_method','image'));
       return redirect()->route('products.index')->with('succuss', 'Product'. Product::withoutGlobalScope(ActiveStatusScope::class)->where('id', '=', $id)->first('name')->name  .'Updated');
        
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
        $deleteProduct =Product::withoutGlobalScope(ActiveStatusScope::class)->where('id', '=', $id)->first();
        $this->authorize('product.update', $deleteProduct);

        $name = Product::withoutGlobalScope(ActiveStatusScope::class)->first('name')->name;
        $deleteProduct->delete();
       return redirect()->route('products.index')->with('delete', 'Product '. $name  .' was Deleted');

    }
     // trash 
     public function trash()
     {
         $this->authorize('product.trash', Product::class);
         $products =Product::withoutGlobalScope(ActiveStatusScope::class)->onlyTrashed()->paginate();
        return view('admin/products/trash', ['products' => $products]);
     }
     // restore Function of trash
     public function restore($id =null)
     {
        
         if($id){
             $Product = Product::withoutGlobalScope(ActiveStatusScope::class)->onlyTrashed()->findOrFail($id);
            //  dd($Product);
            $this->authorize('product.restore', $Product);
            $Product->restore();
            return redirect(route('products.index'));

         }
         Product::withoutGlobalScope(ActiveStatusScope::class)->onlyTrashed()->restore();
         return redirect(route('products.index'));

     }

     // force Delete  from trash
     public function forceDelete($id = null)
     {
        if($id){
            $Product = Product::withoutGlobalScope(ActiveStatusScope::class)->onlyTrashed()->findOrFail($id);
            $this->authorize('product.forceDelete', $Product);
            
            $Product->forceDelete();
            return redirect(route('products.index'));
         }
         Product::withoutGlobalScope(ActiveStatusScope::class)->onlyTrashed()->forceDelete();
         return redirect(route('products.index'));

     }
}
