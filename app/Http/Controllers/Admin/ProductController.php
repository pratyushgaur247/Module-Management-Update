<?php

namespace App\Http\Controllers\Admin;

use Str;
use Auth;
use File;
use Input;
Use Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\{ProductRequest, ProductUpdateRequest};
use App\Models\{Product, Category};

class ProductController extends Controller{

    public function __construct()
    {
        $this->middleware('permission:product-section');
        $this->middleware('permission:product-index', ['only'=>['index']]);   
        $this->middleware('permission:product-create', ['only'=>['create','store']]);
        $this->middleware('permission:product-edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:product-destroy', ['only'=>['destory']]);
        $this->middleware('permission:product-status', ['only'=>['status']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $allProduct = [];
        if($request->title !== null || $request->sku !== null ){
            if($request->title != ''){
                $allProduct = Product::where('title', 'like', '%' . $request->title . '%');
            }
            if($request->sku != ''){
                $allProduct = Product::where('sku', 'like', '%' . $request->sku . '%');
            }
            
            if($allProduct != []){
                $allProduct = $allProduct->orderBy('id', 'DESC')->paginate(50);
            }

            return view('dashboard.admin.product.index', compact('allProduct'));
        }else{
            $allProduct = Product::orderBy('id', 'DESC')->paginate(20);
            return view('dashboard.admin.product.index', compact('allProduct'));
        }   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $allCategory = Category::orderBy('id', 'DESC')->get();
        return view('dashboard.admin.product.create', compact('allCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request){
        /* ========== Product Table ========== */
        $product = new Product;
        $product->user_id     = auth()->guard('admin')->id() ?? auth()->guard('web')->id();
        $product->title       = $request->title;
        $product->sku         = $request->sku;
        $product->description = $request->description;
        $product->quantity    = $request->quantity;
        $product->category_id = $request->category;
        $product->price       = $request->price;
        $product->save();

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $product->clearMediaCollection('image');
            $product->addMediaFromRequest('image')->toMediaCollection('image');
        }

        session()->flash('success', 'Product has been added successfully but product is not activated yet, you have to change the status to activate the product.');
        if( auth()->guard('admin')->check() ){
            return redirect()->route('product.index');
        }else{
            return redirect()->route('products.index');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        if($id > 0){ 
            $product = Product::find($id);
            if($product != ''){
                $allCategory = Category::orderBy('id', 'DESC')->get();
                return view('dashboard.admin.product.edit', compact('product', 'allCategory'));
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id){
        /* ========== Product Table ========== */
        $product = Product::find($id);;
        $product->title       = $request->title;
        $product->sku         = $request->sku;
        $product->description = $request->description;
        $product->quantity    = $request->quantity;
        $product->category_id = $request->category;
        $product->price       = $request->price;
        $product->update();
        
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $product->clearMediaCollection('image');
            $product->addMediaFromRequest('image')->toMediaCollection('image');
        }

        session()->flash('success', 'Product has been updated successfully.');
        if( auth()->guard('admin')->check() ){
            return redirect()->route('product.index');
        }else{
            return redirect()->route('products.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $product = Product::find($id);     
        if($product){
            $product->clearMediaCollection('image');
            $product->delete();
            session()->flash('success', 'Product has been deleted successfully.');
        }
        if( auth()->guard('admin')->check() ){
            return redirect()->route('product.index');
        }else{
            return redirect()->route('products.index');
        }
    }

    /* ========== Product Status Function ========== */
    public function status($id){
        $productStatus =  Product::find($id)->status;
        if($productStatus == '1'){
            Product::where('id', $id)->update(['status' => '0']);
            $productStatus =  Product::find($id)->status;
            return response()->json(['status'=>'success','message'=>'Product Rejected','type'=>'deactivate']);
        }else{
            Product::where('id', $id)->update(['status' => '1']);     
            return response()->json(['status'=>'success','message'=>'Product Approved','type'=>'activate']);
        }
    }
}