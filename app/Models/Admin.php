<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class Admin extends User
{
    use HasFactory;
    use HasApiTokens;
    use Notifiable;
    public function messages()
    {
        return $this->hasMany(ChMessage::class, 'to_id');
    }
    public function roles()
    {
    return $this->belongsTo(Role::class);
    }
    // public function hasAbility($ability)
    // {
    //     $user = Auth::user();
    
    //     $roles = Role::whereRaw('roles.id IN(SELECT role_id FROM admin_roles
    //      WHERE admin_id = ?)' ,[
    //          $user->id
    //      ])->get();
    //     if($ability instanceof $roles){
    //         return true;
    //     }
    //     return false;

    // }
    public function hasAbility($ability){
        // $roles = Role::whereRaw('roles.id In (SELECT role_id from  role_user WHERE user_id = ?)',[
        //     $this->id   /// before here exist $user->id because we in user model we use $this
        // ])->get();
        $roles =  Role::with('users')->get();
            // dd($roles[0]->abilities);
        foreach($roles as $role){
            // return $role;
            if(in_array($ability, $role->abilities)){
                return true;
            }
            
        }
        return false;
    }
}
