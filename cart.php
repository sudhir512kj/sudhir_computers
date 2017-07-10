<?php

error_reporting(E_ALL & ~E_NOTICE);
    require_once 'core/init.php';
    include 'includes/head.php';
    include 'includes/navigation.php';
    include 'includes/headerpartial.php';

    if($cart_id!=''){
        $cartQ=$db->query("select * from cart where id='{$cart_id}'");
        $result=mysqli_fetch_assoc($cartQ);
        $items=json_decode($result['items'],true);
        $i=1;
        $sub_total=0;
    }
?>

<html>
    <head>
        <title>Sudhir's Boutique</title>
        <link rel="stylesheet" href="css/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

        <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


    </head>

<br>
<div class="col-md-12">
    <div class="row">
        <h2 class="text-center">My Shopping Cart</h2>
        <?php if($cart_id==''): ?>
            <div class="bg-danger">
                <p class="text-center text-danger">
                    Your shopping cart is empty!
                </p>
            </div>
        <?php else: ?>
            <table class="table table-bordered table-condensed table-striped">
                <thead><th>#</th><th>Item</th><th>Price</th><th>Quantity</th><th>Size</th><th>Sub Total</th></thead>
                <tbody>
                    <?php
                        foreach($items as $item){
                            $product_id=$item['id'];
                            $productQ=$db->query("select * from products where id='{$product_id}'");
                            $product=mysqli_fetch_assoc($productQ);
                            $sArray=explode(',',$product['sizes']);
                            foreach($sArray as $sizeString){
                                $s=explode(':',$sizeString);
                                if($s[0]==$item['size']){
                                    $available=$s[1];
                                }
                            }
                            ?>

                            <tr>
                                <td><?=$i;?></td>
                                <td><?=$product['title'];?></td>
                                <td><?=money($product['price']);?></td>
                                <td>
                                    <button class="btn btn-xs btn-default" onclick="update_cart('removeone','<?=$product['id'];?>','<?=$item['size'];?>');"><span class="glyphicon glyphicon-minus-sign"></span></button>&nbsp;
                                    <?=$item['quantity'];?>&nbsp;
                                    <?php if($item['quantity']<$available): ?>
                                        <button class="btn btn-xs btn-default" onclick="update_cart('addone','<?=$product['id'];?>','<?=$item['size'];?>');"><span class="glyphicon glyphicon-plus-sign"></span></button>
                                    <?php else: ?>
                                        <span class="text-danger">Max</span>
                                    <?php endif; ?>
                                </td>
                                <td><?=$item['size'];?></td>
                                <td><?=money($item['quantity']*$product['price']);?></td>
                            </tr>

                            <?php
                                $i++;
                                $item_count+=$item['quantity'];
                                $sub_total+=($product['price']*$item['quantity']);
                                }
                                $tax=TAXRATE * $sub_total;
                                $tax=number_format($tax,2);
                                $grand_total=$tax+$sub_total;
                            ?>
                </tbody>
            </table><hr>
            <table class="table table-bordered table-condensed text-right">
                <legend>Totals</legend>
                <thead class="totals-table-header"><th class="text-center">Total Items</th><th class="text-center">Sub Total</th><th class="text-center">Tax</th><th class="text-center">Grand Total</th></thead>
                <tbody>
                    <tr>
                        <td><?=$item_count;?></td>
                        <td><?=money($sub_total);?></td>
                        <td><?=money($tax);?></td>
                        <td class="bg-success"><?=money($grand_total);?></td>
                    </tr>
                </tbody>
            </table>

                <!-- CheckOut Button -->
        <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#checkoutModal">
        <span class="glyphicon glyphicon-shopping-cart"></span>  Check Out >>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="checkoutModalLabel">Shipping Address:</h4>
              </div>
              <div class="modal-body">
                  <div class="row">
                    <form action="thankYou.php" method="post" id="payment-form">
                        <span class="bg-danger" id="payment-errors"></span>
                        <input type="hidden" name="tax" value="<?=$tax;?>">
                        <input type="hidden" name="sub_total" value="<?=$sub_total;?>">
                        <input type="hidden" name="grand_total" value="<?=$grand_total;?>">
                        <input type="hidden" name="cart_id" value="<?=$cart_id;?>">
                        <input type="hidden" name="description" value="<?=$item_count.' item'.(($item_count>1)?'s':'').' from Sudhir Computers';?>">
                        <div id="step1" style="display:block;">
                            <div class="form-group col-md-6">
                                <label for="full_name">Full Name:</label>
                                <input class="form-control" id="full_name" name="full_name" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email:</label>
                                <input class="form-control" id="email" name="email" type="email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="street">Street Address:</label>
                                <input class="form-control" id="street" name="street" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="street2">Street Address 2:</label>
                                <input class="form-control" id="street2" name="street2" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city">City:</label>
                                <input class="form-control" id="city" name="city" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="state">State:</label>
                                <input class="form-control" id="state" name="state" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="zip_code">Zip Code:</label>
                                <input class="form-control" id="zip_code" name="zip_code" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="country">Country:</label>
                                <input class="form-control" id="country" name="country" type="text">
                            </div>
                        </div>
                        <!-- <div id="step2" style="display:none;">
                            <div class="form-group col-md-3">
                                <label for="name">Name on Card:</label>
                                <input type="text" id="name" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="number">Card Number:</label>
                                <input type="text" id="number" class="form-control">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cvc">CVC:</label>
                                <input type="text" id="cvc" class="form-control">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="exp-month">Expire Month:</label>
                                <select id="exp-month" class="form-control">
                                    <option value=""></option>
                                     //for($i=1;$i<13;$i++): ?>

                                    <?php //endfor; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="exp-year">Expire Year:</label>
                                <select id="exp-year" class="form-control">
                                    <option value=""></option>
                                    <?php //$yr= date("Y"); ?>
                                    <?php //for($i=0;$i<11;$i++): ?>
                                        <option value="</option>
                                    <?php //endfor; ?>
                                </select>
                            </div>
                        </div> -->

                         <div id="step2" style="display:none;">
                                 <p>&nbsp;&nbsp;
                                  <input class="w3-radio" type="radio" name="payment_option_1" value="pay_on_delivery" checked>
                                  <label class="w3-validate">Pay On Delivery</label>
                                 </p>
                        </div>

              <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="check_address();" id="next_button">Next >></button>
                    <button type="button" class="btn btn-primary" onclick="back_address();" id="back_button" style="display:none;"><< Back</button>
                    <button type="submit" class="btn btn-primary" id="checkout_button" style="display:none;">Check Out >></button>
                  </form>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>
    </div>
</div>

    <script>

        function back_address(){
            jQuery('#payment-errors').html("");
            jQuery('#step1').css("display","block");
            jQuery('#step2').css("display","none");
            jQuery('#next_button').css("display","inline-block");
            jQuery('#back_button').css("display","none");
            jQuery('#checkout_button').css("display","none");
            jQuery('#checkoutModalLabel').html("Shipping Address:");
        }

        function check_address(){
            var data={
                'full_name' : jQuery('#full_name').val(),
                'email': jQuery('#email').val(),
                'street': jQuery('#street').val(),
                'street2': jQuery('#street2').val(),
                'city': jQuery('#city').val(),
                'state': jQuery('#state').val(),
                'zip_code': jQuery('#zip_code').val(),
                'country': jQuery('#country').val(),
                     };
            jQuery.ajax({
                url: '/sudhircomputers/admin/parsers/check_address.php',
                method: 'POST',
                data: data,
                success: function(data){
                    if(data != 'passed'){
                        jQuery('#payment-errors').html(data);
                    }
                    if(data=='passed'){
                        jQuery('#payment-errors').html("");
                        jQuery('#step1').css("display","none");
                        jQuery('#step2').css("display","block");
                        jQuery('#next_button').css("display","none");
                        jQuery('#back_button').css("display","inline-block");
                        jQuery('#checkout_button').css("display","inline-block");
                        jQuery('#checkoutModalLabel').html("Select Payment Options");
                    }
                },
                error: function(){
                  alert("Something went wrong!");
                },
            });
        }
    </script>

<?php include 'includes/footer.php'; ?>
