
(function($) {
  $.fn.inputFilter = function(inputFilter) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  };
}(jQuery));



function SwitchPrice(){
    
    
    
    
    $valid=true;
    $combination="";
    CPAttribute_ids.forEach(function (item) { 
            if(!$( "#"+item ).val()){
                $valid=false;
            return false;
            }
           
           $combination+=$( "#"+item ).prop("name")+":"+$( "#"+item ).val()+"|";
        });
    $combination=$combination.slice(0, -1);
    
   if( $valid && variation_ids.hasOwnProperty( $combination)){
       
       
       $id=variation_ids[$combination];
       $selector="#variant_img_"+$id;
       $slideIndex=$( $selector ).data( "slick-index" );
       if($slideIndex)
            $( ".js-product-slider-normal" ).slick('slickGoTo', parseInt($slideIndex));
        else
            $( ".js-product-slider-normal" ).slick('slickGoTo', 0);
    
   }
   else{
        $( ".js-product-slider-normal" ).slick('slickGoTo', 0);
   }
    
   if( $valid && price_variation.hasOwnProperty( $combination)){      
      
      $("#variable_price").html(currency_Symbol+" "+price_variation[$combination]);
   }
   else
   $("#variable_price").html("");
}



function addtoCart(url,itemid,variation=false,qty=false){
    $combination="";
    if(variation){
        $valid=true;       
        CPAttribute_ids.forEach(function (item) { 
            if(!$( "#"+item ).val()){
                $valid=false;
            return false;
            }
           
           $combination+=$( "#"+item ).prop("name")+":"+$( "#"+item ).val()+"|";
        });
        $combination=$combination.slice(0, -1);
        
        
         if(!$valid){
             alert("Please Select Product Variants");
            return false;
         }
         
    }
    if(qty){
        
        var Qt=$("#item-qty").val();
    }
    else{
        var Qt=1;
    }
    
	$.ajax({
		url: url,
		type: "POST",
		data: {
			item_id: itemid,
            variations:$combination,
            qty:Qt
           
		},
		beforeSend:function(json)
		{ 
			SimpleLoading.start('ring'); 
		},
		success: function (result) {
			var results = result;
			
			if(results.status == 1){
				//alertify.alert('Product added sucessfully').setHeader('<em class="alert_header"> Arunodayamedicare </em> ').show();
				//location.reload();
				
				var Totalamount = results.Headercartdetails.Totalamount;
				var TotalItems  = results.Headercartdetails.Totalcartitem;
				$('#cart_mini_total').html(Totalamount);
				$('#cart_mini_items').html(TotalItems);
                var js_total="";
                $.each( results.CartItems.CartItems, function( i, val ) {
                    var string="<div class='navbar-cart-product' id='prod_min_" + val.id +"'>";
                        string+="<div class='d-flex align-items-center'>";
                        string+="<a href='"+val.full_url+"' id='prod_min_"+val.id+"_url'>";
                        string+="<img class='img-fluid navbar-cart-product-image' id='prod_min_"+val.id+"_img' src='"+val.image+"' alt='"+val.item_name+"'></a>";
                        string+="<div class='w-100'>";
                        string+="<div class='pl-3'>";
                        string+="<a class='navbar-cart-product-link' href='"+val.full_url+"' id='prod_min_"+val.id+"_name'>"+val.item_name+"</a>";
                        string+="<small class='d-block text-muted'>Quantity: <span id='prod_min_"+val.id+"_qty'>"+val.qty+"</span></small>";
                        string+="<strong class='d-block text-sm' id='prod_min_"+val.id+"_total'>"+val.row_total+"</strong></div>";
                        string+="</div></div></div>";
                        
                        js_total+=string;
                });
                $('#cart_mini').html(js_total);
			}
			
		},
		complete:function(json)
		{
			SimpleLoading.stop();
		},
	});
}


function setShippingMethod(url,method){
    

	$.ajax({
		url: url,
		type: "POST",
		data: {
			method: method,
           
		},
		beforeSend:function(json)
		{ 
			$("#placeorder").prop('disabled', true);
            SimpleLoading.start('ring'); 
		},
		success: function (result) {
			var results = result;
			
			if(results.status == 1){
				//alertify.alert('Product added sucessfully').setHeader('<em class="alert_header"> Arunodayamedicare </em> ').show();
				//location.reload();
				
				var grand_total = results.cart_data.cart_total;
				var shipping  = results.cart_data.shipping;
				$('#grand_total').html(grand_total);
				$('#shipping_amount').html(shipping);
			}
			
		},
		complete:function(json)
		{
			$("#placeorder").prop('disabled', false);
            SimpleLoading.stop();
		},
	});
}


function ordersessioncheck(url,method){
    

	$.ajax({
		url: url,
		type: "GET",
	
		success: function (result) {
		
			
			console.log(result);
		},
	
	});
}