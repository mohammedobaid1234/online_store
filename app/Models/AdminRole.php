<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AdminRole extends Pivot
{
    use HasFactory;

    public function roles()
    {
        return $this->hasMany(Role::class,'role_id');
    }
}
