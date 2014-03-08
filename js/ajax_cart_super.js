//<![CDATA[    
function AddToCartOnListProduct() {
    //'.category-products .btn-cart, .crosssell .btn-cart,.cms-home .btn-cart'
    var is_view = $jq('#product_addtocart_form').attr('method');
    var is_list_compare = $jq('.catalog-product-compare-index').length;
    var is_checkout_page = $jq('.checkout-cart-index').length;
    var is_wishlist_page = $jq('.wishlist-index-index').length;
    if(is_view || is_list_compare >0 || is_checkout_page >0 || is_wishlist_page>0) return false;
    $jq('.btn-cart').each(function(){
        var linkToCart = $jq(this).attr('onclick');
        var effectToCart = $jq('.effect_to_cart').attr('value');
        if(linkToCart){
            linkToCart = linkToCart.replace("setLocation('","").replace("')","");
            //$jq(this).attr('name',linkToCart);
            $jq(this).removeAttr('onclick')
            $jq(this).live('click',function(){
                //getProductInfoFromCart(linkToCart,'type_product=1');
                var base_url = $jq('#ajaxconfig_info a').attr('href');
                if(linkToCart.search('checkout/cart/add')!= -1 || linkToCart.search('ajaxcartsuper/ajaxcart/add') !=-1) {
                    linkToCart =  linkToCart.replace('checkout/cart', 'ajaxcartsuper/ajaxcart');
                    ajaxToCart(linkToCart,"",$jq(this));
                    var img = $jq(this).closest('li').find('img:first');
                    if(!img.length) {
                        img = $jq(this).closest('.actions').parent().find('.product-image');
                        if(!img.length){
                                img = $jq(this).closest('.actions').parent().parent().find('.product-image');
                        }
                        if(!img.length){
                                img = $jq(this).closest('.actions').parent().parent().parent().find('.product-image');
                        }
                        if(!img.length){
                                img = $jq(this).closest('.actions').parent().parent().parent().parent().find('.product-image');
                        }
                        if(!img.length){
                                img = $jq(this).parent().parent().parent().parent().parent().find('.product-image');
                        }
                        if(!img.length){
                                img = $jq(this).parent().parent().parent().parent().parent().parent().find('.product-image');
                        }
                        if(!img.length){
                                img = $jq(this).parent().parent().parent().parent().parent().parent().parent().find('.product-image');
                        }
						if(!img.length){
                                img = $jq(this).parent().parent().parent().parent().parent().parent().parent().parent().find('.product-image');
                        }
						
						if(!img.length){
                                img = $jq(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find('.product-image');
                        }
                    }
                    if(effectToCart==1) {
                        flyToCart($jq(img), $jq('.top-link-cart'));
                    }

                } else {
                    var product_view_url = "";
                    var parent = $jq(this).parent().parent();
                    var productId = null;
                    
                    try {
                        if(parent.find('.regular-price').attr('id')) {
                             productId = parent.find('.regular-price').attr('id').replace('product-price-','');
                        } else {
                            productId = parent.find('.link-wishlist').attr('href').replace(base_url+'wishlist/index/add/product/','').replace('/','');
                        }
                    } catch (exception) { 
                        getProductInfoFromCart(linkToCart);
                        return false;
                    }
                    
                    product_view_url = base_url+'/'+productId;
                    $jq.fancybox({
                        'width'             : '75%',
                        'height'            : 885,
                        'autoScale'         : false,
                        'transitionIn'      : 'none',
                        'transitionOut'     : 'none',
                        'type'              : 'iframe',
                        'href' : product_view_url,
                        'closeBtn' : true,
                        'afterClose' : function() {		
                        // window. location.href = location.href;
                        }
                    });
                    return false;
                }
            // ajaxToCart(linkToCart,"",$jq(this));
            });
        }
    });
}
    
function AddToCartOnProductView() {
    var is_view = $jq('#product_addtocart_form').attr('method');
    var effect_to_cart = $jq('.effect_to_cart').attr('value');
    if(is_view) {
        productAddToCartForm.submit = function(button,url){
            if(this.validator && this.validator.validate()){
                var form = this.form;
                var oldUrl = form.action;
                if (url) {
                    form.action = url;
                }
                var e = null;
                // ajax code
                if(!url){
                    url = $jq('#product_addtocart_form').attr('action');
                }
                var data = $jq('#product_addtocart_form').serialize();
                ajaxToCart(url,data,'view');
                //fly to basket
                
                var img = $jq('#product_addtocart_form').find('.product-img-box .product-image img');
                if(effect_to_cart==1) {
                    if($jq('#ajax_cart_super_product_view').attr('class')!='popup') {
                        flyToCart($jq(img), $jq('.top-link-cart'));
                    }
                }
                
                //End ajax code
                this.form.action = oldUrl;
                if (e) {
                    throw e;
                }
            }
            return false;
        }
    }
}

function getProductIdFrom(url) {
    var myURLArray = url.split('/');
    var lastChunk = '';
    while (myURLArray.length > 0 && lastChunk == '') {
      lastChunk = myURLArray.pop();
    }
    return lastChunk;
}

function getProductInfoFromCart(linkToCart) {
	
    $jq.ajax({
        url: linkToCart,
        type: 'GET',
        data: {},
        beforeSend: function(){
            showLoadingAnimation();
        },
        success: function(data) {
            hideLoadingAnimation();
            var htmlObject = $jq(data);
            var product_action = htmlObject.find('#product_addtocart_form').attr('action');
            var product_id = getProductIdFrom(product_action);
            var base_url = $jq('#ajaxconfig_info a').attr('href');
            var product_view_url = base_url+'/'+product_id;
            $jq.fancybox({
                'width'             : '75%',
                'height'            : 885,
                'autoScale'         : false,
                'transitionIn'      : 'none',
                'transitionOut'     : 'none',
                'type'              : 'iframe',
                'href' : product_view_url,
                'closeBtn' : true,
                'afterClose' : function() {		
                }
            });
        }
    });
}

//compare product
function addProductCompare() {
    $jq('ul.add-to-links li a.link-compare').each(function(){
        var compareUrl = $jq(this).attr('href');
       if(compareUrl.search('product_compare/add/product')!=-1){
             $jq(this).bind('click',function(){
                ajaxToCart(compareUrl,'','');
                return false;
            });
       }
    });
}
//wishlist product
function addProductToCartFromWishlist() {
      $jq('li .link-cart').each(function(){
        var addToCartWishlistUrl = $jq(this).attr('href');
        $jq(this).bind('click',function(){
                ajaxToCart(addToCartWishlistUrl,'','');
            return false;
        });
    });
}

function addProductWishlist() {
     $jq('a.link-wishlist').each(function(){
        var wishlistUrl = $jq(this).attr('href');
        var login = $jq('#ajaxconfig_info a').attr('href')+'customer/account/login/';
       if(wishlistUrl.search('wishlist/index/add/product')!=-1){
        $jq(this).bind('click',function(){
            var isLogin = $jq('#ajaxconfig_info input').attr('value');
            if(isLogin !=1){
                location.href(login);
                return false;
            }
            ajaxToCart(wishlistUrl,'','');
            return false;
        });
       }
    });
}

function addToWishlistCompareOnProductView() {
    var haveLogin = $jq('#ajaxconfig_info input').attr('value');
    if(haveLogin ==1){
        $jq('.product-view .link-wishlist').removeAttr('onclick');
    }
    
    $jq('.product-view .link-wishlist, .product-view .link-compare').bind('click',function(){
        var link = $jq(this).attr('href');
        ajaxToCart(link,'','');
        return false;
    });
}

function removeCompareProductLink(){
      $jq('#compare-items li .btn-remove').each(function(){
        var removeCompareUrl = $jq(this).attr('href');
        try {
            if(removeCompareUrl.search('product_compare/remove/product')!=-1) {
            $jq(this).removeAttr('href');
            $jq(this).removeAttr('onclick');
            $jq(this).live('click',function(){
                 if(confirm('Are you sure you would like to remove this item from the compare products?')){
                      ajaxToCart(removeCompareUrl,'','');
                 };
                return false;
            });
        }
        } catch (exception) { 
        }
    });
}

function removeWislishProductLink(){
      $jq('#wishlist-sidebar li .btn-remove').each(function(){
        var removeWishlistUrl = $jq(this).attr('href');
        if(removeWishlistUrl.search('wishlist/index/remove')!=-1) {
        $jq(this).attr('href','javascript:void(0)');
        $jq(this).removeAttr('onclick');
        $jq(this).live('click',function(){
             if(confirm('Are you sure you would like to remove this item from the wishlist products?')){
                 ajaxToCart(removeWishlistUrl,'','');
             }
            return false;
        });
        }
    });
}


function showLoadingAnimation(){
    var loading_bg = $jq('#ajaxconfig_info button').attr('name');
    var opacity = $jq('#ajaxconfig_info button').attr('value');
    var loading_image = $jq('#ajaxconfig_info img').attr('src');
    var style_wrapper =  "position: fixed;top:0;left:0;filter: alpha(opacity=70); z-index:99999;background-color:"+loading_bg+"; width:100%;height:100%;opacity:"+opacity+"";
    var loading = '<div id ="wraper_ajax" style ="'+style_wrapper+'" ><div  class ="loadding_ajaxcart" style ="z-index:999999;position:fixed; top:50%; left:50%;"><img src="'+loading_image+'"/></div></div>';
    if($jq('#wraper_ajax').length==0) {
        $jq('body').append(loading);
    }
    //$jq('.header-container').append(loading);
}

function showBoxInfo(product_info) {
    var base_url = $jq('#ajaxconfig_info a').attr('href');
    var cart_url = base_url+ 'checkout/cart'
    var str = "<div class ='wrapper_box'>";
    str += "<div><p class ='info'>Add product to  Cart sucessfully</p></div>";
    str += "<div id ='product_info_box'>"+product_info+"</div>";
    str += "<div><a href= 'javascript:void(0)'  id ='continue_shopping'>Continue shopping</a></div>";
    str += "<div><a href='"+cart_url+"' target='_blank' id ='shopping_cart'>Go to shopping cart</a></div></div>";
    //$jq('.loadding_ajaxcart').html(str);
    $jq(str).insertAfter('#wraper_ajax');
    $jq('#wraper_ajax').css('opacity',0.8);
}

function showBoxInfoWishlist(product_info) {
    var base_url = $jq('#ajaxconfig_info a').attr('href');
    var cart_url = base_url+ 'wishlist/'
    var str = "<div class ='wrapper_box pop_wishlist1'>";
    str += "<div><p class ='info'>Add product to Wishlist sucessfully</p></div>";
    str += "<div id ='product_info_box'>"+product_info+"</div>";
    str += "<div><a href= 'javascript:void(0)'  id ='continue_shopping'>Continue shopping</a></div>";
    str += "<div><a href='"+cart_url+"' id='shopping_cart' target='_blank'>Go to wishlist</a></div></div>";
    $jq('.loadding_ajaxcart').html(str);
    $jq(str).insertAfter('#wraper_ajax');
    $jq('#wraper_ajax').css('opacity',0.8);
}

function showBoxInfoCompare(product_info) {
    var base_url = $jq('#ajaxconfig_info a').attr('href');
    var cart_url = base_url+ 'catalog/product_compare/index/'
    var str = "<div class ='wrapper_box pop_compare1'>";
    str += "<div><p class ='info'>Add product to Compare sucessfully</p></div>";
    str += "<div id ='product_info_box'>"+product_info+"</div>";
    str += "<div><a href= 'javascript:void(0)'  id ='continue_shopping'>Continue shopping</a></div>";
    str += "<div><a id='shopping_cart' target='_blank' href='"+cart_url+"'>Go to list Compare</a></div></div>";
    $jq('.loadding_ajaxcart').html(str);
    $jq(str).insertAfter('#wraper_ajax');
    $jq('#wraper_ajax').css('opacity',0.8);
}


function hideLoadingAnimation() {
    $jq('.loadding_ajaxcart,#wraper_ajax,.wrapper_box').remove();
    
}

function showMiniAjaxCart() {
    $jq('#mini_cart_block').show();
}

function hideMiniAjaxCart() {
    $jq('#mini_cart_block').slideUp()
    $jq('#mini_cart_block').hide();
}

function changeDelelteUrl() {
    var str = '<script type ="text/javascript">\n\
                                   $jq("#cart-sidebar a.btn-remove").each(function(){\n\
                                        var delUrl = $jq(this).attr("href");\n\
                                        $jq(this).attr("href","#"); \n\
                                        $jq(this).live("click",function(){\n\
                                            $jq(this).attr("onclick",ajaxToCart(delUrl,"","view"));\n\
                                                return false;                               \n\
                                        });   \n\
                                });\n\
                                \n\
                    </script>';
    return str;
}

function ajaxToCart(url,data,mine) {
    url = url.replace('checkout/cart', 'ajaxcartsuper/ajaxcart');
    try {
        $jq.ajax({
            url: url,
            dataType: 'json',
            type : 'post',
            data : data,
            beforeSend: function(){
                showLoadingAnimation();
   
            },
            success: function(data){
                if(data.status==1) {
                    var base_url = $jq('#ajaxconfig_info a').attr('href');
                    if($jq('#shopping-cart-totals-table').length) {
                       // $jq(".main-container").load(base_url+'ajaxcartsuper/index/cartdelete');
                    }
                    
                    if(data.sidebar_cart) {
                         //$jq('.sidebar .block-cart').append(data.sidebar_cart);
                        $$('.sidebar .block-cart').each(function (el){
                            el.replace(data.sidebar_cart);
                        });
                        if(mine=='view') {
                             if($jq('#ajax_cart_super_product_view').attr('class')=='popup') {
                                 window.parent.insertContentToParent('.sidebar .block-cart',data.sidebar_cart);
                                 window.parent.deleteCartInSidebar();        
                            }
                        }
                         //window.parent.$jq('.sidebar .block-cart:first').removeAttr('class');
                        //$jq('.sidebar').append(changeDelelteUrl());
                    //add sidebar to topLink
                    // $jq('#sidebar_cart_top').html(data.sidebar_cart);
                         
                    }
                    if(data.top_link){
                        var topCartContent =    $jq(data.top_link).find('.top-link-cart').html();
                        $jq('.top-link-cart').html('');
                        $jq('.top-link-cart').html(topCartContent);
                        if(mine=='view') {
                             if($jq('#ajax_cart_super_product_view').attr('class')=='popup') {
                                window.parent.insertContentTopLinkToParent('.quick-access ul.links',data.top_link);
                             }
                        }
                    }
                    //show minicart
                    if(data.mini_cart) {
                        $jq('#mini_cart_block').html('');
                        $jq('#mini_cart_block').html(data.mini_cart);
                        if(mine=='view') {
                             if($jq('#ajax_cart_super_product_view').attr('class')=='popup') {
                                window.parent.insertContentMiniCartToParent('#mini_cart_block',data.mini_cart);
                             }
                            //parent.$jq.fancybox.close();
                        }
                    }
                    
                    if(data.checkout_cart){
                        $jq('.col-main .cart').html('');
                        $jq('.col-main .cart').append(data.checkout_cart);
                    }  
                    
             
                    //compare type
                    if(data.type_sidebar == 'compare'){
                        $$('.sidebar .block-compare').each(function (el){
                            el.replace(data.sidebar_compare);
                        });
                        if(data.product_info) {
                            showBoxInfoCompare(data.product_info);
                            return false;
                        }else {
                            hideLoadingAnimation();
                        }
                    }
                    
                    if(data.type_sidebar == 'wishlist'){
                        if(!$jq('.sidebar .block-wishlist').length){
                            $jq('<div class="block block-wishlist"></div>').insertAfter('.sidebar .block-cart');
                        }
                        $$('.sidebar .block-wishlist').each(function (el){
                            el.replace(data.wishlist_sidebar);
                        });
                        $jq('.quick-access ul.links').html('');
                        $jq('.quick-access ul.links').html(data.top_link);
                        
                        if(data.product_info) {
                            showBoxInfoWishlist(data.product_info);
                            return false;
                        }else {
                            hideLoadingAnimation();
                        }
                    }
                    if(data.product_info) {
                        showBoxInfo(data.product_info);
                    }else {
                        hideLoadingAnimation();
                    }
                 
                } else { 
                  
                    if(data.status==0){
                        if(!confirm(data.message)){
                            hideLoadingAnimation();
                            return false;
                        }
                        hideLoadingAnimation();
                        if(data.url_wislist) {
                            location.href = data.url_wislist;
                            return false;
                        }
                    }
                     if(data.type_product_ajax==1){
                         location.href = url;
                        return false;
                    }
                }
            //parent.$jq.fn.fancybox.close();
            return false;
            }
        });
    } catch (e) {
        alert('erreror here')
        setLocation(url);
    }
}


  // fly to basket  
  function flyToCart(flyer, flyingTo, callBack) {
      try {
        var $jqfunc = $jq(this);
        var divider = 3;
        var flyerClone = $jq(flyer).clone();
        $jq(flyerClone).css({
            position: 'absolute',
            top: $jq(flyer).offset().top + "px",
            left: $jq(flyer).offset().left + "px",
            opacity: 1,
            'z-index': 1000
        });
        $jq('body').append($jq(flyerClone));
        if($jq(flyingTo)) {
            var gotoX = $jq(flyingTo).offset().left + ($jq(flyingTo).width() / 2) - ($jq(flyer).width()/divider)/2;
            var gotoY = $jq(flyingTo).offset().top + ($jq(flyingTo).height() / 2) - ($jq(flyer).height()/divider)/2;
            $jq(flyerClone).animate({
                opacity: 0.7,
                left: gotoX,
                top: gotoY,
                width: 135,
                height: 135
            }, 1000,
            function () {
                $jq(flyingTo).fadeOut('slowly', function () {
                    $jq(flyingTo).fadeIn('slowly', function () {
                        $jq(flyerClone).fadeOut('slowly', function () {
                            $jq(flyerClone).remove();
                            if( callBack != null ) {
                                callBack.apply($jqfunc);
                            }
                        });
                    });
                });
            });
        }
    
    } catch (exception) { 
    
    }    
}

function insertContentToParent(element,data) {
     $$('.sidebar .block-cart').each(function (el){
        el.replace(data);
    });
    //$jq('.sidebar').append(changeDelelteUrl());
    return false;
}

function insertContentTopLinkToParent(element,data) {
    $jq(element).html('');
    $jq(element).append(data);
    return false;
}

function insertContentMiniCartToParent(element,data) {
    $jq(element).html('');
    $jq(element).append(data);
    $jq('#mini_cart_block').show();
    deleteCartInSidebar();
    return false;
}

//delete product out of cart in checkout page
function deleteCartInCheckoutPageBackup(){ 
    $jq("#shopping-cart-table a.btn-remove2").each(function(){
        var delUrl = $jq(this).attr("href");
        $jq( this ).attr("link",delUrl);
        $jq(this).attr("href","javascript:void(0)");
        $jq(this).live("click",function(){
            if(!confirm('Are you sure delete this product out of shopping cart?')){
                return false;
            }
            showLoadingAnimation();
            delUrl = delUrl.replace("checkout/cart/delete", "ajaxcartsuper/index/cartdelete");
            new Ajax.Request(
                delUrl,
                {
                    method: "post",
                    postBody: "",
                    onException: function (xhtml, e)
                    {
                        alert("Exception : " + e);
                    },
                    onComplete: function (xhtml)
                    {
                        var htmlObject = $jq(xhtml.responseText);
                        var topLink = htmlObject.find("#top_link_content").html();
                        $jq(".top-link-cart").html(topLink);
                        $jq(".main-container").html("");
                        //var checkoutContent = htmlObject.find(".ajaxcart_checkout_content").html();
                        $jq(".main-container").html(xhtml.responseText);
                        hideLoadingAnimation();
                    }

                });
            return false;
        });          
    });
}

//delete product out of cart in checkout page
function deleteCartInCheckoutPage(){ 
    $jq('.checkout-cart-index a.btn-remove').removeAttr('onclick');
    $jq(".checkout-cart-index a.btn-remove2,.checkout-cart-index a.btn-remove").click(function(event) {
        event.preventDefault();
        if(!confirm('Are you sure would like to remove this item from the shopping cart?')){
            return false;
        }
         var delUrl = $jq(this).attr("href");
            delUrl = delUrl.replace("checkout/cart/delete", "ajaxcartsuper/index/cartdelete");
        $jq.ajax({
            url: delUrl,
            type: 'POST',
            data: {},
            beforeSend:function(){
               showLoadingAnimation();
            },
            success: function(xhr) {
                $('ajaxcart-checkout-content').innerHTML = xhr;
                $('ajaxcart-checkout-content').insert(xhr);
                var cart_content = $('ajaxcart-checkout-content').down('.cart_content').innerHTML;
                $jq('.top-link-cart').html(cart_content);
                var mini_cart_ajax =$('ajaxcart-checkout-content').down('.top-cart-wrapper').innerHTML;
                $$('.top-cart-contain').each(function (el){
                    el.replace(mini_cart_ajax);
                });
                var full_cart_content = $('ajaxcart-checkout-content').down('.ajaxcart_checkout_content').innerHTML;
                $$('.cart').each(function (el){
                    el.replace(full_cart_content);
                });
                hideLoadingAnimation();
                $jq('#ajaxcart-checkout-content').html('');
            }
        });
        
         $jq(document).ajaxComplete(function(){
            getQuote();
            getDiscountCodes();
            slideEffectAjax();
        })
    });
   
    return false;
}

function getDiscountCodes() {
    $jq('#discount-coupon-form').attr('id','discount-coupon-form-ajax');
    var discountFormAjax = new VarienForm('discount-coupon-form-ajax');
    discountForm.submit = function (isRemove) {
        if (isRemove) {
            $('coupon_code').removeClassName('required-entry');
            $('remove-coupone').value = "1";
        } else {
            $('coupon_code').addClassName('required-entry');
            $('remove-coupone').value = "0";
        }
        return VarienForm.prototype.submit.bind(discountFormAjax)();
    }
}

function getQuote() {
    $jq('#shipping-zip-form').attr('id','shipping-zip-form-ajax');
    var coShippingMethodFormAjax = new VarienForm('shipping-zip-form-ajax');
    coShippingMethodForm.submit = function () {
        var country = $F('country');
        var optionalZip = false;

        for (i=0; i < countriesWithOptionalZip.length; i++) {
            if (countriesWithOptionalZip[i] == country) {
                optionalZip = true;
            }
        }
        if (optionalZip) {
            $('postcode').removeClassName('required-entry');
        }
        else {
            $('postcode').addClassName('required-entry');
        }
        if (this.validator.validate()) {
            this.form.submit();
        }
        console.log(countriesWithOptionalZip.length);
    }.bind(coShippingMethodFormAjax);
}

function slideEffectAjax() {
      $jq('.top-cart-contain').mouseenter(function() {
            $jq(this).find(".top-cart-content").stop(true, true).slideDown();
        });
        //hide submenus on exit
        $jq('.top-cart-contain').mouseleave(function() {
            $jq(this).find(".top-cart-content").stop(true, true).slideUp();
        });
}

function deleteCartInSidebar() {
    var is_checkout_page = $jq('.checkout-cart-index').length;
    if(is_checkout_page>0) return false;
    $jq('#cart-sidebar a.btn-remove, #mini_cart_block a.btn-remove').each(function(){
        var delUrl = $jq(this).attr('href');
        $jq(this).attr('href','#');
        $jq(this).attr('onclick','');
        if(delUrl.search('checkout/cart/delete')!=-1) {
            $jq(this).live('click',function(){
                  if(confirm('Are you sure you would like to remove this item from the shopping cart?')){
                        $jq(this).attr('onclick',ajaxToCart(delUrl,'','view'));
                 };
                return false;
            });              
        }
    });
}  

$jq(document).ready(function(){
    var enable_module = $jq('#enable_module').val();
    if(enable_module==0 || !enable_module) return false;
    //add Class to wishlist link 
    $jq('.quick-access ul li a').each(function(){
        var link = $jq(this).attr('href');
        if(link.search('/wishlist/')!=-1){
            $jq(this).addClass('top_link_wishlist');
        }
    });
    var checkout_url = $jq('.top-link-checkout').attr('href')+'onepage';
    $jq('.top-link-checkout').attr('href',checkout_url);
    //delete product out of cart
    deleteCartInSidebar();
    //delete product out of cart in checkout page
    deleteCartInCheckoutPage();
    //compare link
    addProductCompare();
    removeCompareProductLink();
      
    //wishlist link 
    addToWishlistCompareOnProductView();
    addProductWishlist();
    addProductToCartFromWishlist();
    removeWislishProductLink();
    //hideMiniAjaxCart();
    //add product to cart on list product 
    AddToCartOnListProduct();
    //Add to cart in product view page
    AddToCartOnProductView();
    //hover on link cart 
//    $jq('.top-link-cart').attr('href','javascript:void(0)')
//    $jq('.top-link-cart').live('click',function(){
//        $jq('#mini_cart_block').slideToggle('slowly')
//    })
    $jq('#continue_shopping, #shopping_cart').live('click', function(){
         hideLoadingAnimation();
        $jq('#mini_cart_block').show();
        if($jq('#ajax_cart_super_product_view').attr('class')=='popup') {
            parent.$jq.fancybox.close();
        }
    }); 

    $jq('#wraper_ajax').live('click',function(){
        $jq('#wraper_ajax, .wrapper_box').remove();
    })
    //hide mini cart on popup
    $jq('.ajaxcartsuper-index-productview #mini_cart_block').hide();
    //hover on mini cart 
    slideEffectAjax();
});

$jq(document).ajaxComplete(function(){
    //hide mini cart on popup
    $jq('.ajaxcartsuper-index-productview #mini_cart_block').hide();
    AddToCartOnListProduct();
    deleteCartInSidebar();
    removeCompareProductLink();
    removeWislishProductLink();
    addProductToCartFromWishlist();
    addProductCompare();
    addProductWishlist();
    //deleteCartInCheckoutPage();

})

//]]>