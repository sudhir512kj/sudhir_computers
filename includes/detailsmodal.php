<link  href="../fotorama-4.6.4/fotorama.css" rel="stylesheet">
<script src="../fotorama-4.6.4/fotorama.js"></script>
<style>
    img.details
{
    width: 90%;
    margin: 15px auto;
}
</style>
<?php
        require_once '../core/init.php';
        $id=$_POST['id'];
        $id=(int)$id;
        $sql="select * from products where id='$id'";
        $result=$db->query($sql);
        $product=mysqli_fetch_assoc($result);
        $brand_id=$product['brand'];
        $sql1="select brand from brand where id='$brand_id'";
        $brand_query=$db->query($sql1);
        $brand=mysqli_fetch_assoc($brand_query);
        $sizestring=$product['sizes'];
        $size_array=explode(',',$sizestring);
?>

<!-- Details Model -->
    <?php ob_start(); ?>
        <div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                      <button class="close" type="button" onclick="closeModal()" aria-label="close">
                      <i class="material-icons right" style="color:blue;">clear</i>
        </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <span id="modal_errors" class="bg-danger"></span>
                                <div class="col-sm-6">
                                    <?php $photos=explode(',',$product['image']); ?>
                                    <div class="carousel slide" id="myCarousel" data-ride="carousel">

                                    <?php $i=0;
                                foreach($photos as $photo):
                                    ?>
                                <ol class="carousel-indicators">
                                    <?php for($j=0;$j<sizeof($photos);): ?>
                                <li data-target="#myCarousel" data-slide-to="<?=$j;?>" class="<?=(($j==0)?'active':'');?>"></li>
                                    <?php  $j++; ?>
                                    <?php endfor; ?>
                                </ol>
                                    <div class="center-block carousel-inner" role="listbox">
                                            <div class="item <?=(($i==0)?'active':''); ?>">
                                            <img src="<?=$photo;?>" alt="<?=$product['title'];?>" class="details img-responsive">
                                            </div>
                                    </div>
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                    </a>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h4>Details</h4>
                                <p><?= nl2br($product['description']); ?></p>
                                <hr>
                                <p>Price: $<?= $product['price']; ?></p>
                                <p>Brand: <?= $brand['brand']; ?></p>
                                <form action="add_cart.php" method="post" id="add_product_form">
                                    <input type="hidden" name="product_id" value="<?=$id;?>">
                                    <input type="hidden" name="available" id="available" value="">
                                    <div class="form-group">
                                        <div class="col-xs-3">
                                            <label for="quantity">Quantity:</label>
                                            <input type="number" class="form-control" id="quantity" name="quantity" min="0">
                                        </div><div class="col-xs-9">&nbsp;</div>
                                    </div><br><br>
                                    <div class="form-group">
                                        <label for="size">Size:</label>
                                        <select name="size" id="size" class="form-control">
                                            <option value=""></option>
                                            <?php foreach($size_array as $string) {
                                                    $string_array=explode(':',$string);
                                                    $size=$string_array[0];
                                                    $available=$string_array[1];
                                                    if($available>0){
                                                        echo '<option value="'.$size.'" data-available="'.$available.'">'.$size.' ('.$available.' Available)</option>';
                                                    }
                                            } ?>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" onclick="closeModal()">Close</button>
                    <button class="btn btn-warning" onclick="add_to_cart();return false;"><span class="glyphicon glyphicon-shopping-cart"></span>Add to Cart</button>
                </div>
                </div>
            </div>
        </div>
        <script>
            jQuery('#size').change(function(){
                var available=jQuery('#size option:selected').data("available");
                jQuery('#available').val(available);
            });


        </script>
    <?php echo ob_get_clean(); ?>
