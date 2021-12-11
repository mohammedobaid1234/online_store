<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $casts=[
        'abilities' =>'json',
    ];
    protected $fillable = ['name', 'abilities'] ;

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'role_user',
        );
    }
    public function admins()
    {
        return $this->belongsToMany(
            Admin::class,
            'role_admins',
        );
    }
}
