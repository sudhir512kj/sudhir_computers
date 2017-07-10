<?php require 'core/init.php';
      include('includes/head.php'); 
      include('includes/navigation.php');
      include('includes/headerfull.php');
      include('includes/leftbar.php');

      $sql="select * from products where featured=1";
      $featured=$db->query($sql);
?>
<html>
    <head>
        <title>Sudhir Computers</title>
        <link rel="stylesheet" href="css/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" 
        crossorigin="anonymous">

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


    </head>
    <body style="background-image:url(/sudhircomputers/images/polyagonal-web-design.jpg);background-attachement:no-repeat;">
            <!-- main content -->
                <div class="col-md-8">
                    <div class="row">
                        <h2 class="text-center">Feature Products</h2>
                        <?php  while($product = mysqli_fetch_assoc($featured)) : ?>
                            <div class="col-md-3 text-center">
                                <h4><?= $product['title']; ?></h4>
                                <?php $photos=explode(',',$product['image']); ?>
                                <a href="<?= $photos[0]; ?>" rel="thumbnail"><img src="<?= $photos[0]; ?>" alt="<?= $product['title']; ?>" class="img-thumb" width="50px"></a><br><br>
                                <p class="list-price text-danger">List Price: <s>$<?= $product['list_price']; ?></s></p>
                                <p class="price">Our Price: $<?= $product['price']; ?></p>
                                <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $product['id']; ?>)">Details
                                </button>&nbsp;<br>
                                <!--<button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-shopping-cart"></span>Add to Cart</button>-->
                            </div>
                        <?php endwhile; ?>
                        
                    </div>
                </div>
        <?php
        //include('includes/detailsmodal.php');
        include('includes/rightbar.php');
        ?>
        
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <?php include('includes/footer.php'); ?>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
    </body>
</html>
