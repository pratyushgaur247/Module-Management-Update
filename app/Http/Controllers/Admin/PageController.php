<?php

namespace App\Http\Controllers\admin;

use Str;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\{PageRequest};

class PageController extends Controller{

    public function __construct()
    {
        $this->middleware('permission:cms-section');
        $this->middleware('permission:cms-index', ['only'=>['index']]);   
        $this->middleware('permission:cms-create', ['only'=>['create','store']]);
        $this->middleware('permission:cms-edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:cms-destroy', ['only'=>['destory']]);
        $this->middleware('permission:cms-status', ['only'=>['proxyLogin']]);
        $this->middleware('permission:cms-view', ['only'=>['proxyLogin']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pages = Page::orderBy('id', 'DESC')->paginate(20);
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

        $slug = $this->createSlug($request->title);
        $page = new Page;
        $page->title   = $request->title;
        $page->content = $request->content;
        $page->slug    = $slug;
        $page->status = 0;
        $page->save();

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $page->clearMediaCollection('image');
            $page->addMediaFromRequest('image')->toMediaCollection('image');
        }

        $request->session()->flash('success', 'Page created successfully.');
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
            $page = Page::find($id);
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
        $page = Page::find($id);
        $page->title  = $request->title;
        $page->content = $request->content;
        $page->update();

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $page->clearMediaCollection('image');
            $page->addMediaFromRequest('image')->toMediaCollection('image');
        }

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
        $page = Page::find($id);
        if($page){
            $page->clearMediaCollection('image');
            $page->delete();
        }
        session()->flash('danger', 'Page deleted successfully.');
        if( auth()->guard('admin')->check() ){
            return redirect()->route('page.index');
        }else{
            return redirect()->to('/pages');
        }
    }

    /* ========== View All Dynamic Page ========== */
    public function visitPage($slug){
    
        $pageContent = Page::where(['slug'=>$slug, 'status'=>'1'])->first();
        if($pageContent != []){
            return view('frontend.view', compact('pageContent'));
        }
        return view('dashboard.401');
    }

     /* ========== Page Status ========== */
     public function status(Request $request){
        if($request->ajax()){
            $status = Page::where('id',$request->id)->first()->status;
            if($status == '0'){
                Page::where('id',$request->id)->update(['status'=>'1']);
            }else{
                Page::where('id',$request->id)->update(['status'=>'0']);
            }
            return response()->json(['status'=>'success','statusChange'=>$status,'message'=>'Successfully Updated']);
        }
    }

      /* ========== Unique Slug Function ========== */
      public function createSlug($title, $id = 0){
        // Normalize the title
        $slug = Str::slug($title);

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);

        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++){
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)){
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0){
        return Page::select('slug')->where('slug', 'like', $slug.'%')->where('id', '<>', $id)->get();
    }
    
}