<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChMessage extends Model
{
    
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'form_id',
        );
    }
    public function getName($user_id)
    {
        return User::find($user_id)->name;
    }
}
