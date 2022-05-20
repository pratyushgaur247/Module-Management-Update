<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Cashier\Billable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
// use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    // use SoftDeletes;
    use HasRoles;
    use HasFactory;
    use Billable;
    // use InteractsWithMedia;
    use HasMediaTrait;

    
    protected $table = 'users';
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected $attributes = [ 
        'menuroles' => 'user',
    ];

    public function company()
    {
       return $this->hasOne(Company::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function getAdminUserIndex($request){
        $users = User::where('menuroles', 'user');
        if($request->name && $request->name != null){
            $users = $users->where('name', 'like', '%' . $request->name . '%');
        }

        if($request->email && $request->email != null ){
            $users = $users->where('email', 'like', '%' . $request->email . '%');
        }

        if(auth()->guard('admin')->check()){
            $users = $users->orderBy('id', 'DESC')->paginate(20);
        }else{
            $users = $users->where('id','!=',auth()->guard('web')->id() )->orderBy('id', 'DESC')->paginate(20);
        }
        return $users;
    }

}
