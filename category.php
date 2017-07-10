<?php require 'core/init.php';
      include('includes/head.php'); 
      include('includes/navigation.php');
      include('includes/headerpartial.php');
      include('includes/leftbar.php');

    if(isset($_GET['cat'])){
        $cat_id=sanitize($_GET['cat']);
    }else{
        $cat_id='';
    }

      $sql="select * from products where categories='$cat_id'";
      $productQ=$db->query($sql);
    $category=get_category($cat_id);
?>
<html>
    <head>
        <title>Sudhir Computers</title>
        <link rel="stylesheet" href="css/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


    </head>
    <body style="background-image:url(/sudhircomputers/images/polyagonal-web-design.jpg);background-attachement:no-repeat;">
            <!-- main content -->
            <div class="col-md-8">
                <div class="row">
                    <h2 class="text-center"><?=$category['parent'].' '. $category['child'];?></h2>
                    <?php  while($product = mysqli_fetch_assoc($productQ)) : ?>
                        <div class="col-md-3 text-center">
                            <h4><?= $product['title']; ?></h4>
                            <?php $photos=explode(',',$product['image']); ?>
                            <a href="<?= $photos[0]; ?>" rel="thumbnail"><img src="<?= $photos[0]; ?>" alt="<?= $product['title']; ?>" class="img-thumb"></a><br><br>
                            <p class="list-price text-danger">List Price: <s>$<?= $product['list_price']; ?></s></p>
                            <p class="price">Our Price: $<?= $product['price']; ?></p>
                            <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $product['id']; ?>)">Details
                            </button><br>
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
        
    </body>
</html>