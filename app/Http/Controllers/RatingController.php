<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RatingController extends Controller
{
    public function store(Request $request ,$type)
    {
        $rating_type = $type;
        $request->validate([
            'rating' => ['min:0','max:5'],
            'type' => [Rule::in(['user', 'product']),]
        ]);
       
            $rating = Rating::create([
                'rateable_type' => $rating_type,
                'rateable_id' => $request->post('id'),
                'rating' => $request->post('rating'),
                'user_id' => Auth::id(),
            ]);
            return $rating;
  
    }
}
