
<x-store-front-layout>
    <div class="ps-checkout pt-80 pb-80">
        <div class="ps-container">
          <form class="ps-checkout__form" action="{{route('checkout.store')}}" method="POST">
            @csrf
            <div class="row">
                  <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                    <div class="ps-checkout__billing">
                      <h3>Billing Detail</h3>
                            <div class="form-group form-group--inline">
                              <x-form-input label='Name' name='billing_name' />
                            </div>
                            
                            <div class="form-group form-group--inline">
                              <x-form-input label='Emai' name='billing_email' />

                            </div>
                            <div class="form-group form-group--inline">
                              <x-form-input label='Phone Number' name='billing_phone' type='tel' />
                            </div>
                            <div class="form-group form-group--inline">
                              <x-form-select name='billing_country' label='Counrty' :items='$counties' defalut='Choose Billing Country'/> 
                            </div>
                            <div class="form-group form-group--inline">
                              <x-form-input label='City' name='billing_city' />
                            </div>
                      <div class="form-group">
                        <div class="ps-checkbox">
                          <input class="form-control" type="checkbox" id="cb01">
                          <label for="cb01">Create an account?</label>
                        </div>
                      </div>
                      <h3 class="mt-40"> Addition information</h3>
                      <div class="form-group form-group--inline textarea">
                        <label>Order Notes</label>
                        <textarea class="form-control" rows="5" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                    <div class="ps-checkout__order">
                      <header>
                        <h3>Your Order</h3>
                      </header>
                      <div class="content">
                        <table class="table ps-checkout__products">
                          <thead>
                            <tr>
                              <th class="text-uppercase">Product</th>
                              <th class="text-uppercase">Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($cart->all() as $item)
                            <tr>
                              <td>{{$item->product->name}}</td>
                              <td>{{$item->product->price * $item->quantity}}</td>
                            </tr>
                                
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <footer>
                        <div class="form-group cheque">
                          <header>
                            <h3>total = ${{$cart->total()}}</h3>
                          </header>
                        </div>
                        <h3>Payment Method</h3>
                        <div class="form-group paypal">
                          <div class="ps-radio ps-radio--inline">
                            <input class="form-control" type="radio" name="payment" id="rdo02">
                            <label for="rdo02">Paypal</label>
                          </div>
                          <ul class="ps-payment-method">
                            <li><a href="#"><img src="images/payment/1.png" alt=""></a></li>
                            <li><a href="#"><img src="images/payment/2.png" alt=""></a></li>
                            <li><a href="#"><img src="images/payment/3.png" alt=""></a></li>
                          </ul>
                          <button type="submit" class="ps-btn ps-btn--fullwidth">Place Order<i class="ps-icon-next"></i></button>
                        </div>
                      </footer>
                    </div>
                    <div class="ps-shipping">
                      <h3>FREE SHIPPING</h3>
                      <p>YOUR ORDER QUALIFIES FOR FREE SHIPPING.<br> <a href="#"> Singup </a> for free shipping on every order, every time.</p>
                    </div>
                  </div>
            </div>
          </form>
        </div>
   </div 
</x-store-front-layout>
