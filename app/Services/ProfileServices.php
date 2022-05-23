<?php


namespace App\Services;
use Hash;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\{User};
class ProfileServices{
    
    public function getProfile($id)
    {
        return User::find($id);
    }
    public function profileUpdate($request ,$id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $user->email;
        $user->update();

        if($request->hasFile('image') && $request->file('image')->isValid()){
            // $user->media()->delete();
            \DB::table('media')->where('model_id',$id)->delete();
            // $user->clearMediaCollection('image');
            $user->addMediaFromRequest('image')->toMediaCollection('image');
        }
    }
    public function userChangePassword($request ,$id)
    {
        $user =  User::find($id);
        $check = Hash::check($request->old_password, $user->password);
        if($check) {
            $user->password = Hash::make($request->password);
            $user->update();
            return true;
        } else {
            return false;
            
        }
    }
}