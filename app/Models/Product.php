<?php

namespace App\Models;

use App\Scopes\ActiveStatusScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use NumberFormatter;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $casts= [
        'price' =>'float',
    ];
    /// Global Scope
    protected static function booted()
    {   
        // Obj from builder of eloquent 
        // every Eloquent come the Model will apply the manipulate 

        static::addGlobalScope( new ActiveStatusScope());
    }

    // Local Scope
    public function scopePrice(Builder $builder, $from , $to = null)
    {   
        $builder->where('price' ,'>=' , $from);
        if($to !== null){
           $builder->where('price', '<=' , $to);
        }

    }
    
    public function scopeActive(Builder $builder){
        $builder->where('products.status', 'active');

    }
    // for ajax because ajax not deal with accessors and meteorites
    protected $appends =[
        'permalink',
        'image_url',
        'formatted_price',
    ];

    protected $fillable = ['name','slug', 'category_id','description','image_path',
                           'price','sale_price','quantity','sku','wight','width',
                           'height','length','status'
                        ];
    // for get uri (route) to ajax
    public function getPermalinkAttribute()
    {
        return route('home.show',$this->slug);
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
        $this->attributes['slug'] = Str::slug($value); 
        $this->attributes['name'] = Str::title($value);
    }  
    // Formatted Price by using php native can use php money package  
    public function getFormattedPriceAttribute()
    {
        $formatter = new NumberFormatter(App::getLocale(), NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->price , 'USD');
    }
    public function category()
    {
       return $this->belongsTo(
           Category::class,
           'category_id',
           'id'
       );
    }
     
    public function ratings()
    {
        return $this->morphToMany(
            Rating::class,
            'rateable',
        );
    }              
}
    