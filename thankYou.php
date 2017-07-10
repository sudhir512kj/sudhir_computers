<?php

error_reporting(E_ALL & ~E_NOTICE);

require_once 'core/init.php';

        $full_name=sanitize($_POST['full_name']);
        $email=sanitize($_POST['email']);
        $street=sanitize($_POST['street']);
        $street2=sanitize($_POST['street2']);
        $city=sanitize($_POST['city']);
        $state=sanitize($_POST['state']);
        $zip_code=sanitize($_POST['zip_code']);
        $country=sanitize($_POST['country']);
        $tax=sanitize($_POST['tax']);
        $sub_total=sanitize($_POST['sub_total']);
        $grand_total=sanitize($_POST['grand_total']);
        $cart_id=sanitize($_POST['cart_id']);
        $description=sanitize($_POST['description']);
        $charge_amount=number_format($grand_total,2)*100;


//adjust inventory
$itemQ=$db->query("select * from cart where id='{$cart_id}'");
$iresults=mysqli_fetch_assoc($itemQ);
$items=json_decode($iresults['items'],true);
foreach($items as $item){
    $newSizes=array();
    $item_id=$item['id'];
    $productQ=$db->query("select sizes from products where id='{$item_id}'");
    $product=mysqli_fetch_assoc($productQ);
    $sizes=sizesToArray($product['sizes']);
    foreach($sizes as $size){
        if($size['size']==$item['size']){
            $q=$size['quantity']-$item['quantity'];
            $newSizes[]=array('size'=>$size['size'],'quantity'=>$q);
        }
        else{
            $newSizes[]=array('size'=>$size['size'],'quantity'=>$size['quantity']);
        }
    }
    $sizeString=sizesToString($newSizes);
    $db->query("update products set sizes='{$sizeString}' where id='{$item_id}'");
}



//update cart

        $db->query("update cart set paid=1 where id='{$cart_id}'");
        $db->query("insert into transactions (cart_id,full_name,email,street,street2,city,state,zip_code,country,sub_total,tax,grand_total,description,txn_type) values ('$cart_id','$full_name','$email','$street','$street2','$city','$state','$zip_code','$country','$sub_total','$tax','$grand_total','$description','pay_on_delivery')");

        $domain=($_SERVER['HTTP_HOST']!='localhost')?'.'.$_SERVER['HTTP_HOST']:false;
        setcookie(CART_COOKIE,'',1,"/",$domain,false);

        include 'includes/head.php';
        include 'includes/navigation.php';
        include 'includes/headerpartial.php';

?>

<h1 class="text-center text-success">Thank You!</h1>
<p>
    Your order has been successfully placed. You have been emailed a receipt. Please check your spam folder if it is not in your inbox.
    Additionally you can print this page as a receipt.</p>
    <p>Your receipt number is: <strong><?=$cart_id;?></strong></p>
    <p>Your order will be shipped to the address below.</p>
    <address>
        <?=$full_name;?><br>
        <?=$street;?><br>
        <?=(($street2!='')?$street2.'<br>':'');?>
        <?=$city.', '.$state.' '.$zip_code;?><br>
        <?=$country;?><br>
    </address>


<?php
        include 'includes/footer.php';
        ?>



