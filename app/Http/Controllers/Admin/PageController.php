<?php

namespace App\Http\Controllers\admin;
use Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\{PageRequest};
use App\Services\Admin\PageServices;

class PageController extends Controller{
    protected $pageServices;
    public function __construct(PageServices $pageServices)
    {
        $this->middleware('permission:cms-section');
        $this->middleware('permission:cms-index', ['only'=>['index']]);   
        $this->middleware('permission:cms-create', ['only'=>['create','store']]);
        $this->middleware('permission:cms-edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:cms-destroy', ['only'=>['destory']]);
        $this->middleware('permission:cms-status', ['only'=>['proxyLogin']]);
        $this->middleware('permission:cms-view', ['only'=>['proxyLogin']]);
        $this->pageServices = $pageServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pages =$this->pageServices->getProfleIndex();
        return view('dashboard.admin.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('dashboard.admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request){
        $this->pageServices->store($request);
        $request->session()->flash('success', __('pageCreate'));
        if( auth()->guard('admin')->check() ){
            return redirect()->route('page.index');
        }else{
            return redirect()->to('/pages');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         if($id > 0){
            $page = $this->pageServices->edit($id);
            return view('dashboard.admin.page.edit', compact('page'));
        }
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
        $this->pageServices->update($request,$id);
        $request->session()->flash('success', 'Page updated successfully.');
        if( auth()->guard('admin')->check() ){
            return redirect()->route('page.index');
        }else{
            return redirect()->to('/pages');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->pageServices->destroy($id);
        session()->flash('danger', 'Page deleted successfully.');
        if( auth()->guard('admin')->check() ){
            return redirect()->route('page.index');
        }else{
            return redirect()->to('/pages');
        }
    }

    /* ========== View All Dynamic Page ========== */
    public function visitPage($slug){
        $pageContent = $this->pageServices->visitPage($slug);
        if($pageContent != []){
            return view('frontend.view', compact('pageContent'));
        }
        return view('dashboard.401');
    }

     /* ========== Page Status ========== */
    public function status(Request $request){
        if($request->ajax()){
            $status = $this->pageServices->status($request);
            return response()->json(['status'=>'success','statusChange'=>$status,'message'=>'Successfully Updated']);
        }
    }
    
}