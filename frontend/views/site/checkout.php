<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Checkout';
?>
<style>
.cartFooter {
    padding: 20px;
    border-top: solid 1px #eee;
    background: #EBEDEF;
    display: inline-block;
    width: 100%;
}
h2.block-title-2, .formBox h3, .block-title-2 {
    border-bottom: 1px solid #CECECE;
    font-size: 13px;
    font-weight: bold;
    margin: 0 0 15px;
    padding: 10px 0;
    position: relative;
    text-transform: uppercase;
}
label{margin-bottom:10px;}
.form-control{margin-bottom:10px;}
.cartMiniTable {
    border: 1px solid #DDDDDD;
    padding: 10px;
}
h4{font-weight:normal;}
.panel-title {
    color: inherit;
    font-size: 16px;
    margin-bottom: 0;
    margin-top: 0;
    padding-bottom: 0;
    color: #454545;
    font-size: 15px;
}
p{color:#454545;}
.table tbody tr td{padding:12px;}


    Rules
    Computed
    Animations
    Fonts

element {

}
tr.CartProduct {

    border-bottom: 1px solid #E7E9EC;

}
.cartTableHeader {

    text-transform: uppercase;
    font-weight: bold;
    font-size: 14px;

}
.cartTableHeader {

    background: #EBEDEF;

}
tr.CartProduct td, tr.CartProduct th {
    padding: 10px 0;
}
ul.tabs.text-center{background: #1e647b;
padding: 10px;
width: 100%;
padding-top: 15px;
border: 1px solid #dedede;
border-radius: 5px;}
.single-product-tab > ul li a{color:#fff !important;}
.single-product-tab > ul li.active a{color:#fff !important;}
.single-product-tab > ul li a::after{background:#fff !important;}
</style>
<div class="container" style="margin-top:20px;">
		<div class="col-lg-9 col-md-9 col-sm-12">

            <div class="single-product-tab bd-bottom product-v3-bt">
               <ul class="tabs text-center">
                  <li class="active"><a data-toggle="pill" href="#review"><i class="fa fa-map-marker" style="color:#E83867;"></i> Address</a></li>
                  <li><a data-toggle="pill" href="#desc"><i class="fa fa-envelope" style="color:#E83867;"></i> Billing</a></li>
                  <li><a data-toggle="pill" href="#add"><i class="fa fa-truck" style="color:#E83867;"></i> Shipping</a></li>
				  <li><a data-toggle="pill" href="#payment"><i class="fa fa-money" style="color:#E83867;"></i> Payment</a></li>
				  <li><a data-toggle="pill" href="#order"><i class="fa fa-check-square" style="color:#E83867;"></i> Order</a></li>
               </ul>
               <div class="tab-content">
				  <div id="review" class="tab-pane fade in active ">
                     <div class="row userInfo">
                            <div class="col-lg-12">
                                <h2 class="block-title-2"> To add a new address, please fill out the form below. </h2>
                            </div>

                            <form>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group required">
                                        <label for="InputName">First Name <sup>*</sup> </label>
                                        <input required type="text" class="form-control" id="InputName"
                                               placeholder="First Name">
                                    </div>
                                    <div class="form-group required">
                                        <label for="InputLastName">Last Name <sup>*</sup> </label>
                                        <input required type="text" class="form-control" id="InputLastName"
                                               placeholder="Last Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="InputEmail">Email </label>
                                        <input type="text" class="form-control" id="InputEmail" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="InputCompany">Company </label>
                                        <input type="text" class="form-control" id="InputCompany" placeholder="Company">
                                    </div>
                                    <div class="form-group required">
                                        <label for="InputAddress">Address <sup>*</sup> </label>
                                        <input required type="text" class="form-control" id="InputAddress"
                                               placeholder="Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="InputAddress2">Address (Line 2) </label>
                                        <input type="text" class="form-control" id="InputAddress2"
                                               placeholder="Address">
                                    </div>
                                    <div class="form-group required">
                                        <label for="InputCity">City <sup>*</sup> </label>
                                        <input required type="text" class="form-control" id="InputCity"
                                               placeholder="City">
                                    </div>
                                    <div class="form-group required">
                                        <label for="InputState">State <sup>*</sup> </label>

                                        <select class="form-control" required aria-required="true" id="InputState"
                                                name="InputState">
                                            <option value="">Choose</option>
                                            <option value="1">Alabama</option>
                                            <option value="2">Alaska</option>
                                            <option value="3">Arizona</option>
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group required">
                                        <label for="InputZip">Zip / Postal Code <sup>*</sup> </label>
                                        <input required type="text" class="form-control" id="InputZip"
                                               placeholder="Zip / Postal Code">
                                    </div>
                                    <div class="form-group required">
                                        <label for="InputCountry">Country <sup>*</sup> </label>
                                        <select class="form-control" required aria-required="true" id="InputCountry"
                                                name="InputCountry">
                                            <option value="">Choose</option>
                                            <option value="38">Algeria</option>
                                            <option value="39">American Samoa</option>
                                            <option value="40">Andorra</option>
                                           
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputAdditionalInformation">Additional information</label>
                                        <textarea rows="3" cols="26" name="InputAdditionalInformation"
                                                  class="form-control" id="InputAdditionalInformation"></textarea>
                                    </div>
                                    <div class="form-group required">
                                        <label for="InputMobile">Mobile phone <sup>*</sup></label>
                                        <input required type="tel" name="InputMobile" class="form-control"
                                               id="InputMobile">
                                    </div>
                                    <div class="form-group required">
                                        <label for="addressAlias">Please assign an address title for future reference.
                                            <sup>*</sup></label>
                                        <input required type="text" value="My address" name="addressAlias"
                                               class="form-control" id="addressAlias">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--/row end-->
						<div class="cartFooter w100">
							<div class="box-footer">
								<div class="pull-left"><a class="btn btn-default" href="index.html"> <i class="fa fa-arrow-left"></i> &nbsp; Back to Shop </a></div>
								<div class="pull-right"><a class="btn btn-primary btn-small " href="checkout-2.html">
									Shipping address &nbsp; <i class="fa fa-arrow-circle-right"></i> </a></div>
							</div>
						</div>
                  </div>
                  <div id="desc" class="tab-pane fade in ">
                    <div class="row userInfo">
                            <div class="col-lg-12">
                                <h2 class="block-title-2"> To add a billing address, please fill out the form
                                    below. </h2>
                            </div>
                            <div class="col-xs-12 col-sm-12">
                                <label class="checkbox-inline" for="checkboxes-0">
                                    <input name="checkboxes" id="checkboxes-0" value="1" type="checkbox">
                                    My delivery and billing addresses are the same. </label>
                                <hr>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group required">
                                    <label for="InputName">First Name <sup>*</sup> </label>
                                    <input required type="text" class="form-control" id="InputName"
                                           placeholder="First Name">
                                </div>
                                <div class="form-group required">
                                    <label for="InputLastName">Last Name <sup>*</sup> </label>
                                    <input required type="text" class="form-control" id="InputLastName"
                                           placeholder="Last Name">
                                </div>
                                <div class="form-group">
                                    <label for="InputEmail">Email </label>
                                    <input type="text" class="form-control" id="InputEmail" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="InputCompany">Company </label>
                                    <input type="text" class="form-control" id="InputCompany" placeholder="Company">
                                </div>
                                <div class="form-group required">
                                    <label for="InputAddress">Address <sup>*</sup> </label>
                                    <input required type="text" class="form-control" id="InputAddress"
                                           placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <label for="InputAddress2">Address (Line 2) </label>
                                    <input type="text" class="form-control" id="InputAddress2" placeholder="Address">
                                </div>
                                <div class="form-group required">
                                    <label for="InputCity">City <sup>*</sup> </label>
                                    <input required type="text" class="form-control" id="InputCity" placeholder="City">
                                </div>
                                <div class="form-group required">
                                    <label for="InputState">State <sup>*</sup> </label>
                                    <select class="form-control" required aria-required="true" id="InputState"
                                            name="InputState">
                                        <option value="">Choose</option>
                                        <option value="1">Alabama</option>
                                       
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group required">
                                    <label for="InputZip">Zip / Postal Code <sup>*</sup> </label>
                                    <input required type="text" class="form-control" id="InputZip"
                                           placeholder="Zip / Postal Code">
                                </div>
                                <div class="form-group required">
                                    <label for="InputCountry">Country <sup>*</sup> </label>
                                    <select class="form-control" required aria-required="true" id="InputCountry"
                                            name="InputCountry">
                                        <option value="">Choose</option>
                                        <option value="38">Algeria</option>
                                        <option value="39">American Samoa</option>
                                        <option value="40">Andorra</option>
                                        <option value="41">Angola</option>
                                        <option value="42">Anguilla</option>
                                     
                                        <option selected="selected" value="21">United States</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="InputAdditionalInformation">Additional information</label>
                                    <textarea rows="3" cols="26" name="InputAdditionalInformation" class="form-control"
                                              id="other"></textarea>
                                </div>
                                <div class="form-group required">
                                    <label for="InputMobile">Mobile phone <sup>*</sup></label>
                                    <input required type="tel" name="InputMobile" class="form-control" id="InputMobile">
                                </div>
                                <div class="form-group required">
                                    <label for="addressAlias">Please assign an address title for future reference. <sup>*</sup></label>
                                    <input required type="text" value="My address" name="addressAlias"
                                           class="form-control" id="addressAlias">
                                </div>
                            </div>
                        </div>
                        <!--/row end-->
						<div class="cartFooter w100">
							<div class="box-footer">

								<div class="pull-left">
									<a class="btn btn-default" href="checkout-1.html"> <i class="fa fa-arrow-left"></i>
										&nbsp; Shipping address </a></div>
								<div class="pull-right">
									<a href="checkout-3.html" class="btn btn-primary btn-small "> Shipping method &nbsp; <i class="fa fa-arrow-circle-right"></i> </a></div>
							</div>
						</div>
                  </div>
                  
                  <div id="add" class="tab-pane fade in">
                     <div class="row userInfo">
                            <div class="col-lg-12">
                                <h2 class="block-title-2"> Choose your delivery method </h2>
                            </div>
                            <div class="col-xs-12 col-sm-12">
                                <div class="w100 row">
                                    <div class="form-group col-lg-4 col-sm-4 col-md-4 -col-xs-12">
                                        <label for="id_country">Country</label>
                                        <select class="form-control" required aria-required="true" id="id_country"
                                                name="id_country">
                                            <option value="">Choose</option>
                                            <option value="38">Algeria</option>
                                            <option value="39">American Samoa</option>
                                            <option value="40">Andorra</option>
                                          
                                            <option value="33">Togo</option>
                                            <option value="17">United Kingdom</option>
                                            <option selected="selected" value="21">United States</option>
                                        </select>
                                    </div>
                                    <div id="states" class="form-group  col-lg-4 col-sm-4 col-md-4 -col-xs-12">
                                        <label for="id-state">State</label>
                                        <select class="form-control" required aria-required="true" id="id-state"
                                                name="id-state">
                                            <option value="">Choose</option>
                                            <option value="1">Alabama</option>
                                            <option value="2">Alaska</option>
                                            
                                        </select>
                                    </div>
                                    <div class="form-group  col-lg-4 col-sm-4 col-md-4 -col-xs-12">
                                        <label for="zipcode">Zip Code</label>
                                        <input type="text" id="zipcode" name="zipcode" class="form-control">
                                        (Needed for certain carriers.)
                                    </div>
                                    <div class="form-group col-lg-12 col-sm-12 col-md-12 -col-xs-12">
                                        <table style="width:100%" class="table-bordered table tablelook2">
                                            <tbody>
                                            <tr>
                                                <td> Carrier</td>
                                                <td>Method</td>
                                                <td>Information</td>
                                                <td>Price!</td>
                                            </tr>
                                            <tr>
                                                <td><label class="radio">
                                                    <input type="radio" name="optionsRadios" id="optionsRadios1"
                                                           value="option1" checked>
                                                    <i class="fa  fa-plane fa-2x"></i> </label></td>
                                                <td> By Road</td>
                                                <td>Pick up in-store</td>
                                                <td>Free!</td>
                                            </tr>
                                            <tr>
                                                <td><label class="radio">
                                                    <input type="radio" name="optionsRadios" id="optionsRadios2"
                                                           value="option2">
                                                    <i class="fa fa-truck fa-2x"></i> </label></td>
                                                <td>By Air</td>
                                                <td>Delivery next day!</td>
                                                <td>Free!</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!--/row-->

                                <div class="cartFooter w100">
                                    <div class="box-footer">
                                        <div class="pull-left"><a class="btn btn-default" href="checkout-2.html"> <i
                                                class="fa fa-arrow-left"></i> &nbsp; Shipping address </a></div>
                                        <div class="pull-right"><a href="checkout-4.html"
                                                                   class="btn btn-primary btn-small "> Payment Method
                                            &nbsp; <i class="fa fa-arrow-circle-right"></i> </a></div>
                                    </div>
                                </div>
                                <!--/ cartFooter -->

                            </div>
                        </div>
						
                    </div>
                    <!--/row end-->
					
					
					<div id="payment" class="tab-pane fade in">
						<div class="row userInfo">
                            <div class="col-lg-12">
                                <h2 class="block-title-2"> Payment method </h2>

                                <p>Please select the preferred shipping method to use on this order.</p>
                                <hr>
                            </div>
                            <div class="col-xs-12 col-sm-12">
                                <div class="paymentBox">
                                    <div class="panel-group paymentMethod" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading panel-heading-custom">
                                                <h4 class="panel-title"><a class="cashOnDelivery" data-toggle="collapse"
                                                                           data-parent="#accordion" href="#collapseOne">
                                                    <span class="numberCircuil"></span> <strong> Cash on
                                                    Delivery</strong> </a></h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <p>All transactions are secure and encrypted, and we neverstor To
                                                        learn more, please view our privacy policy.</p>
                                                    <br>
                                                    <label class="radio-inline" for="radios-4">
                                                        <input name="radios" id="radios-4" value="4" type="radio">
                                                        Cash On Delivery </label>

                                                    <div class="form-group">
                                                        <label for="CommentsOrder">Add Comments About Your Order</label>
                                                        <textarea id="CommentsOrder" class="form-control"
                                                                  name="CommentsOrder" cols="26" rows="3"></textarea>
                                                    </div>
                                                    <div class="form-group clearfix">
                                                        <label class="checkbox-inline" for="checkboxes-1">
                                                            <input name="checkboxes" id="checkboxes-1" value="1"
                                                                   type="checkbox">
                                                            I have read and agree to the <a
                                                                href="terms-conditions.html">Terms & Conditions</a>
                                                        </label>
                                                    </div>
                                                    <div class="pull-right"><a href="checkout-5.html"
                                                                               class="btn btn-primary btn-small "> Order
                                                        &nbsp; <i class="fa fa-arrow-circle-right"></i> </a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading panel-heading-custom">
                                                <h4 class="panel-title"><a data-toggle="collapse"
                                                                           data-parent="#accordion" href="#collapseTwo">
                                                    <span class="numberCircuil"></span><strong> PayPal</strong>
                                                </a></h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <p>All transactions are secure and encrypted, and we neverstor To
                                                        learn more, please view our privacy policy.</p>
                                                    <br>
                                                    <label class="radio-inline" for="radios-3">
                                                        <input name="radios" id="radios-3" value="4" type="radio">
                                                        <img src="images/site/payment/paypal-small.png" height="18"
                                                             alt="paypal"> Checkout with Paypal </label>

                                                    <div class="form-group">
                                                        <label for="CommentsOrder2">Add Comments About Your
                                                            Order</label>
                                                        <textarea id="CommentsOrder2" class="form-control"
                                                                  name="CommentsOrder2" cols="26" rows="3"></textarea>
                                                    </div>
                                                    <div class="form-group clearfix">
                                                        <label class="checkbox-inline" for="checkboxes-0">
                                                            <input name="checkboxes" id="checkboxes-0" value="1"
                                                                   type="checkbox">
                                                            I have read and agree to the <a
                                                                href="terms-conditions.html">Terms & Conditions</a>
                                                        </label>
                                                    </div>
                                                    <div class="pull-right"><a href="checkout-5.html"
                                                                               class="btn btn-primary btn-small "> Order
                                                        &nbsp; <i class="fa fa-arrow-circle-right"></i> </a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading panel-heading-custom">
                                                <h4 class="panel-title"><a class="masterCard" data-toggle="collapse"
                                                                           data-parent="#accordion"
                                                                           href="#collapseThree"> <span
                                                        class="numberCircuil"></span> <strong>
                                                    MasterCard</strong> </a></h4>
                                            </div>
                                            <div id="collapseThree" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <p>All transactions are secure and encrypted, and we neverstor To
                                                        learn more, please view our privacy policy.</p>
                                                    <br>

                                                    <div class="panel open">
                                                        <div class="creditCard">
                                                            <div class="cartBottomInnerRight paymentCard">
                                                            </div>
                                                            <span>Supported</span> <span>Credit Cards</span>

                                                            <div class="paymentInput">
                                                                <label for="CardNumber">Credit Card Number *</label>
                                                                <br>
                                                                <input id="CardNumber" type="text" name="Number" class="form-control">
                                                            </div>
                                                            <!--paymentInput-->
                                                            <div class="paymentInput">
                                                                <label for="CardNumber2">Name on Credit Card *</label>
                                                                <br>
                                                                <input type="text" name="CardNumber2" id="CardNumber2" class="form-control">
                                                            </div>
                                                            <!--paymentInput-->
                                                            <div class="paymentInput">
                                                                <div class="form-group">
                                                                    <label>Expiration date *</label>
                                                                    <br>

                                                                    <div class="col-lg-4 col-md-4 col-sm-4 no-margin-left no-padding">
                                                                        <select class="form-control" required
                                                                                aria-required="true"
                                                                                name="expire">
                                                                            <option value="">Month</option>
                                                                            <option value="1">01 - January</option>
                                                                            <option value="2">02 - February</option>
                                                                            <option value="3">03 - March</option>
                                                                            <option value="4">04 - April</option>
                                                                            <option value="5">05 - May</option>
                                                                            <option value="6">06 - June</option>
                                                                            <option value="7">07 - July</option>
                                                                            <option value="8">08 - August</option>
                                                                            <option value="9">09 - September</option>
                                                                            <option value="10">10 - October</option>
                                                                            <option value="11">11 - November</option>
                                                                            <option value="12">12 - December</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                                        <select class="form-control" required
                                                                                aria-required="true"
                                                                                name="year">
                                                                            <option value="">Year</option>
                                                                            <option value="2013">2013</option>
                                                                            <option value="2014">2014</option>
                                                                            <option value="2015">2015</option>
                                                                            <option value="2016">2016</option>
                                                                            <option value="2017">2017</option>
                                                                            <option value="2018">2018</option>
                                                                            <option value="2019">2019</option>
                                                                            <option value="2020">2020</option>
                                                                            <option value="2021">2021</option>
                                                                            <option value="2022">2022</option>
                                                                            <option value="2023">2023</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--paymentInput-->

                                                            <div style="clear:both"></div>
                                                            <div class="paymentInput clearfix">
                                                                <label for="VerificationCode">Verification Code
                                                                    *</label>
                                                                <br>
                                                                <input type="text" id="VerificationCode"
                                                                       name="VerificationCode" class="form-control" style="width:90px;">
                                                                <br>
                                                            </div>
                                                            <!--paymentInput-->

                                                            <div>
                                                                <input type="checkbox" name="saveInfo" id="saveInfoid">
                                                                <label for="saveInfoid">&nbsp;Save my Card
                                                                    information</label>
                                                            </div>
                                                        </div>
                                                        <!--creditCard-->

                                                        <div class="pull-right"><a href="checkout-5.html"
                                                                                   class="btn btn-primary btn-small ">
                                                            Order &nbsp; <i class="fa fa-arrow-circle-right"></i> </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--/row-->
								</div>
								</div>
								
						<div class="cartFooter w100">
							<div class="box-footer">
								<div class="pull-left"><a class="btn btn-default" href="checkout-3.html"> <i class="fa fa-arrow-left"></i> &nbsp; Billing address </a></div>
							</div>
						</div>
					</div>
					
					<div id="order" class="tab-pane fade in">
						<div class="row userInfo">

                            <div class="col-lg-12">
                                <h2 class="block-title-2"> Review Order </h2>
                            </div>


                            <div class="col-xs-12 col-sm-12">
                                <div class="cartContent w100 checkoutReview ">
                                    <table class="cartTable table-responsive" style="width:100%">
                                        <tbody>
                                        <tr class="CartProduct cartTableHeader">
                                            <th style="width:15%"> Product</th>
                                            <th class="checkoutReviewTdDetails">Details</th>
                                            <th style="width:10%">Unit Price</th>
                                            <th class="hidden-xs" style="width:5%">QNT</th>
                                            <th class="hidden-xs" style="width:10%">Discount</th>
                                            <th style="width:15%">Total</th>
                                        </tr>
                                        <tr class="CartProduct">
                                            <td class="CartProductThumb">
                                                <div><a href="product-details.html"><img src="images/product/3.jpg"></a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="CartDescription">
                                                    <h4><a href="product-details.html">Denim T shirt Black </a></h4>
                                                    <span class="size">12 x 1.5 L</span>

                                                </div>
                                            </td>
                                            <td class="delete">
                                                <div class="price ">$116.51</div>
                                            </td>
                                            <td class="hidden-xs">1</td>
                                            <td class="hidden-xs">0</td>
                                            <td class="price">$116.51</td>
                                        </tr>
                                        <tr class="CartProduct">
                                            <td class="CartProductThumb">
                                                <div><a href="product-details.html"><img src="images/product/2.jpg"></a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="CartDescription">
                                                    <h4><a href="product-details.html">Denim T shirt </a></h4>
                                                    <span class="size">12 x 1.5 L</span>

                                                </div>
                                            </td>
                                            <td class="delete">
                                                <div class="price ">$50</div>
                                            </td>
                                            <td class="hidden-xs">1</td>
                                            <td class="hidden-xs">0</td>
                                            <td class="price">$50</td>
                                        </tr>
                                        <tr class="CartProduct">
                                            <td class="CartProductThumb">
                                                <div><a href="product-details.html"><img src="images/product/5.jpg"></a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="CartDescription">
                                                    <h4><a href="product-details.html">Denim T shirt Red </a></h4>
                                                    <span class="size">12 x 1.5 L</span>

                                                </div>
                                            </td>
                                            <td class="delete">
                                                <div class="price ">$50</div>
                                            </td>
                                            <td class="hidden-xs">1</td>
                                            <td class="hidden-xs">0</td>
                                            <td class="price">$50</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--cartContent-->

                                <div class="w100 costDetails">
                                    <div class="table-block" id="order-detail-content">
                                        <table class="std table" id="cart-summary">
                                            <tbody><tr>
                                                <td>Total products</td>
                                                <td class="price">$216.51</td>
                                            </tr>
                                            <tr style="">
                                                <td>Shipping</td>
                                                <td class="price"><span class="success">Free shipping!</span></td>
                                            </tr>
                                            <tr class="cart-total-price ">
                                                <td>Total (tax excl.)</td>
                                                <td class="price">$216.51</td>
                                            </tr>
                                            <tr>
                                                <td>Total tax</td>
                                                <td id="total-tax" class="price">0.00</td>
                                            </tr>
                                            <tr>
                                                <td> Total</td>
                                                <td id="total-price" class="price">$216.51</td>
                                            </tr>
                                            </tbody><tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--/costDetails-->


                                <!--/row-->


                            </div>


                        </div>
						<div class="cartFooter w100">
							<div class="box-footer">
								<div class="pull-left"><a class="btn btn-default" href="checkout-4.html">
									<i class="fa fa-arrow-left"></i> &nbsp; Payment method </a>
								</div>


								<div class="pull-right">
									<a href="thanks-for-order.html" class="btn btn-primary btn-small ">
										Confirm Order &nbsp; <i class="fa fa-check"></i>
									</a>
								</div>


							</div>
						</div>
						
					</div>
					
					
                  </div>
               </div>
			</div>
			
		<div class="col-lg-3 col-md-3 col-sm-12 rightSidebar">
            <div class="w100 cartMiniTable">
                <table id="cart-summary" class="std table">
                    <tbody>
                    <tr>
                        <td>Total products</td>
                        <td class="price">$216.51</td>
                    </tr>
                    <tr style="">
                        <td>Shipping</td>
                        <td class="price"><span class="success">Free shipping!</span></td>
                    </tr>
                    <tr class="cart-total-price ">
                        <td>Total (tax excl.)</td>
                        <td class="price">$216.51</td>
                    </tr>
                    <tr>
                        <td>Total tax</td>
                        <td class="price" id="total-tax">$0.00</td>
                    </tr>
                    <tr>
                        <td> Total</td>
                        <td class=" site-color" id="total-price">$216.51</td>
                    </tr>
                    </tbody>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!--  /cartMiniTable-->

        </div>	
		
            </div>
         </div>


        </div>	
		
            </div>
         </div>
