<?php


namespace App\Services\Admin;
use Hash;
use Auth;
use Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\{Page};
class PageServices{
    public function getProfleIndex()
    {
        return Page::orderBy('id', 'DESC')->paginate(20);
    }
    public function store()
    {
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

        
    }
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
    public function edit($id)
    {
        return Page::find($id);
    }


    public function update($request,$id)
    {
        $page = Page::find($id);
        $page->title  = $request->title;
        $page->content = $request->content;
        $page->update();

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $page->clearMediaCollection('image');
            $page->addMediaFromRequest('image')->toMediaCollection('image');
        }

        
    }
    public function destroy($id)
    {
        $page = Page::find($id);
        if($page){
            $page->clearMediaCollection('image');
            $page->delete();
        }
    }
    public function visitPage($slug)
    {
        return Page::where(['slug'=>$slug, 'status'=>'1'])->first();
    }
    public function status($request)
    {
        $status = Page::where('id',$request->id)->first()->status;
        if($status == '0'){
            Page::where('id',$request->id)->update(['status'=>'1']);
        }else{
            Page::where('id',$request->id)->update(['status'=>'0']);
        }
        return $status;
    }
    protected function getRelatedSlugs($slug, $id = 0){
        return Page::select('slug')->where('slug', 'like', $slug.'%')->where('id', '<>', $id)->get();
    }
   
}