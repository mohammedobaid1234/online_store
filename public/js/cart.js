(function($){
    $('#add-to-cart').on('submit', function(e){
        e.preventDefault(); 
        $.post($(this).attr('action'), $(this).serialize(),
            function (items) {
               console.log(items.count);    
                $('.ps-cart__content').empty();
                $('#cart_quantity').empty();
                $('#cart_quantity').append(items.count);
                for(i in items.cart){
                    data = items.cart[i];
                    // console.log(${data.quantity});

                    $('.ps-cart__content').append(`
                    <div class="ps-cart-item"><a class="ps-cart-item__close" href="${data.product.permalink}"></a>
                        <div class="ps-cart-item__thumbnail"><a href="${data.product.permalink}"></a><img src="${data.product.image_url}" alt=""></div>
                        <div class="ps-cart-item__content"><a class="ps-cart-item__title" href="${data.permalink}">${data.product.name}</a>
                        <p><span>Quantity:<i>${data.quantity}</i></span><span>Total:<i>£${data.product.quantity * data.product.price}</i></span></p>
                        </div>
                    </div> 
                `);
                }
            },
            
        );
    })

})(jQuery); 

// (function($){
//     console.log('2');
//     $('.minus').on('click', function(e){
//         e.preventDefault();
//         this.closest('form').submit();
        
//     })
// })(jQuery);