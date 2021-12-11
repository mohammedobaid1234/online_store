<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $perPage = 5;
    protected static function booted()
    {
        static::creating(function($model)
        {
            $model->slug = Str::slug($model->name);
        });
    }
   protected $fillable= ['name', 'slug', 'description' , 'parent_id', 'status', 'image_path', 'phone_verified_at'];
   protected $dates =[
    'phone_verified_at'
   ];
   protected $hidden = ['slug'];
   public function getNameAttribute($value)
   {
        if($this->trashed()){
            return $value . ' [ deleted ] ';
        }
        return $value;
   }
   public function getOriginalNameAttribute()
   {
       return $this->attributes['name'];
   }
    public static function validationRules()
    {
        return [
            //
            'name' => ['required',
                     'min:3', 
                    'string', 
                    'max:255',
                    'Filter:php,css'
                ],
            'parent_id'=>['nullable', 'int','exists:categories,id'],
            'description' => ['nullable', 'min:3', 'string'],
            'status'=> ['required', 'in:active,draft'],
            'image'=> ['nullable', 'image', 'dimensions:min-width:300px'] 
        ];

    }
    public function children()
    {
        return $this->hasMany(Category::class,'parent_id');
    }
    public function getImageUrlAttribute($value)
    {
        // dd(asset('images/placeholder.png'));
        if(!$this->image_path){
            return asset('images/placeholder.png');
        }
        if(stripos($this->image_path , 'http') ===  0){
            return $this->image_path;
        }
        return asset('uploads/' . $this->image_path);
    } 
    public function setNameAttribute($value)
    {
        // $this->attributes['slug'] = Str::slug($value);
        $this->attributes['name'] = Str::title($value);
    }
    public function products()
    {
       return $this->hasMany(Product::class);
    }
    
}
