<?php

namespace App\Policies;

use App\Models\Product;
// use App\Models\;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

        
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\  $user
     * @return mixed
     */
    public function viewAny( $user)
    {
        // return true;
        return $user->hasAbility('products.view.any');
    }

    /**
     * Determine whether the user can view the model.
     *
     * 
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function view($user, Product $product)
    {
        
        return true;
        return $user->hasAbility('products.view');
    }

    /**
     * Determine whether the user can create models.
     *
     * 
     * @return mixed
     */
    public function create($user)
    {
        //  dd($user);
        return $user->hasAbility('products.create');

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function update( $user, Product $product)
    {
        return $user->hasAbility('products.create');

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function delete( $user, Product $product)
    {
        return $user->hasAbility('products.delete');

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function restore( $user, Product $product)
    {
        return $user->hasAbility('products.restore');

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function forceDelete( $user, Product $product)
    {
        return $user->hasAbility('products.forceDelete');

    }
}
