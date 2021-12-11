<x-store-front-layout>
    <div class="ps-content pt-80 pb-80">
        <div class="ps-container">
          <div class="ps-cart-listing">
            <table class="table ps-cart__table">
              <thead>
                <tr>
                  <th>All Products</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              @foreach ($cart as $item)
                  {{-- {{ dd($item->product->name)}}  --}}
                <tr>
                  <td><a class="ps-product__preview" href="{{route('home.show', ['slug' => $item->product->slug])}}"><img width="120px" class="mr-15" src="{{$item->product->image_url}}" alt=""> {{$item->product->name}}</a></td>
                  <td>${{$item->product->price}}</td>
                    <td>
                      <div class="form-group--number">
                        {{-- <form action="{{route('carts.quantity', [$item->id])}}" method="post">
                          @csrf --}}
                          <button  type="submit" class="minus"><a href="{{route('carts.quantityDe', [$item->id])}}"><span>-</span></a></button>
                          <input class="form-control" type="text" value="{{$item->quantity}}">
                          <button class="plus"><a href="{{route('carts.quantityIn', [$item->id])}}"><span>+</span></a></button>
                        {{-- </form> --}}
                      </div>
                    </td>
                    <td>${{$item->quantity * $item->product->price}}</td>
                    <td>
                      <a href="{{route('carts.delete', [$item->id])}}"><div class="ps-remove"></div></a>
                    </td>
                  </tr>
               @endforeach
                
              </tbody>
            </table>
            <div class="ps-cart__actions">
              <div class="ps-cart__promotion">
                <div class="form-group">
                  <div class="ps-form--icon"><i class="fa fa-angle-right"></i>
                    <input class="form-control" type="text" placeholder="Promo Code">
                  </div>
                </div>
                <div class="form-group">
                  <button class="ps-btn ps-btn--gray">Continue Shopping</button>
                </div>
              </div>
              <div class="ps-cart__total">
                <h3>Total Price: <span> {{$total}} $</span></h3><a class="ps-btn" href="{{route('checkout.create')}}">Process to checkout<i class="ps-icon-next"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
</x-store-front-layout>
