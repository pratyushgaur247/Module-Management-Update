<?php

namespace App\Http\Controllers\admin;

use App\Models\{Category};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\{CategoryRequest};



class CategoryController extends Controller{

    public function __construct()
    {
        $this->middleware('permission:category-section');
        $this->middleware('permission:category-index', ['only'=>['index']]);   
        $this->middleware('permission:category-create', ['only'=>['create','store']]);
        $this->middleware('permission:category-edit', ['only'=>['edit', 'update']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $allCategory = Category::orderBy('id', 'DESC')->paginate(20);
        return view('dashboard.admin.category.index', compact('allCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('dashboard.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request){
        $data = [
            'name' => $request->name,
        ];
        Category::create($data);
        session()->flash('success', 'Category has been added successfully.');
        if(auth()->guard('admin')->check()){
            return redirect()->route('category.index');
        }else{
            return redirect()->to('/category');
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
            $category = Category::find($id);
            if($category != ''){
                return view('dashboard.admin.category.edit', compact('category'));
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
    public function update(CategoryRequest $request, $id){
        $category = Category::find($id);;
        $category->name = $request->name;
        $category->update();
        session()->flash('success', 'Category has been updated successfully.');
        if(auth()->guard('admin')->check()){
            return redirect()->route('category.index');
        }else{
            return redirect()->to('/category');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

    }
}
