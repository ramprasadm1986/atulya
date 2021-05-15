$(document).ready(function(){
    
    var couponTotalUse=$('#coupon-total_use').val();
$('#coupon-use_type').on('change', function () {
    var ele = $(this);
    var useDiv = $('.field-coupon-total_use');
    var value = $('#coupon-total_use').val();
    var useValue = $('#coupon-total_use');
    if (this.value === '1') {
        if(!couponTotalUse)
            useValue.val(1);
        else
            useValue.val(couponTotalUse);
        
        useDiv.show();
    } else {
        useValue.val(0);
        useDiv.hide()
    }
});
$('#coupon-filter_by input[type=radio]').on('click', function () {
    var ele = $(this);
    var categoryDiv = $('.field-coupon-categories,.coupon-description-categories,.field-search,.category-help');
    var productDiv = $('.field-coupon-products,.coupon-description-product,.field-search,.product-help');
    var value = ele.filter(":checked").val();
    console.log(value);
    switch (value) {
        case "categories":
            productDiv.hide();
            categoryDiv.show();
            break;

        case "product":
            categoryDiv.hide();
            productDiv.show();
            break;

        default:
            categoryDiv.hide();
            productDiv.hide();
            break;
    }
});
$('#product-category-search').on('keyup',function() {
   var ele=$('#coupon-filter_by input[type=radio]');
    var filter = ele.filter(":checked").val();
    console.log(filter);
    var value = $(this).val();
    var searchDiv = $('#search-data');
    if(value.length>= 3){
        ajax_search(searchDiv,value,filter);
    }else{
        searchDiv.empty();
    }

});

});
function hasConditionChange(event,state) {
    var conditionDiv = $('#conditions');
    if (state) {
        conditionDiv.show()
    } else {
        conditionDiv.hide()
    }
}
function ajax_search(searchDiv,value,filter){
    var searchLoading = $('#search-loading');
    searchDiv.hide();
    searchLoading.show();
    if(filter=="product")
        url='/backend/promo/search/product';
    else
        url='/backend/promo/search/category';
    
    $.post(url,{name:value},function(res){
        searchLoading.hide();
        console.log(res);
        if(res.length){
            searchDiv.empty();
          $.each(res,function(i,k){
              if(filter=="product"){
                  searchDiv.append('<div class="media">\n' +
                      '  <div class="media-left">\n' +
                      '    <img src="'+k.base_image+'" class="media-object" style="width:60px">\n' +
                      '  </div>\n' +
                      '  <div class="media-body">\n' +
                      '    <h4 class="media-heading">SKU: <code>'+k.sku+'</code></h4>\n' +
                      '    <p>'+k.name+'</p> \n' +
                      '  </div>\n' +
                      '</div>');
                }
                else{
                    
                    searchDiv.append('<div class="media">\n' +                       
                      '  <div class="media-body">\n' +
                      '    <h4 class="media-heading">ID: <code>'+k.id+'</code></h4>\n' +
                      '    <p>'+k.name+'</p> \n' +
                      '  </div>\n' +
                      '</div>');
                    
                    
                }
            });
          
            
        }
        else{
            searchDiv.empty();
            searchDiv.append('No Data Found');
        }
        searchDiv.show();
        
    })
//var n = new  Noty({type:'success',text:value}).show();
}

$('.product-checkbox').on('click',function(){
    alert(1);
    var ele = $(this);
    var value = ele.filter(":checked").val();
    var input = $('#coupon-products');

    let val = input;

    val +=", "+value;

    input.val(val);


});

$(document).ready(function(){
    $('input[type=radio]').filter(":checked").trigger("click");
    $('#coupon-use_type').trigger("change").trigger("click");
});
