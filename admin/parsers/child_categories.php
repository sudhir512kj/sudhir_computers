<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/sudhircomputers/core/init.php';
    $parentID=(int)$_POST['parentID'];
    $selected=sanitize($_POST['selected']);
    $childQuery=$db->query("select * from categories where parent='$parentID' order by category");
    ob_start();
?>

    <option value=""></option>
    <?php while($child=mysqli_fetch_assoc($childQuery)): ?>
        <option value="<?=$child['id'];?>"<?=(($selected==$child['id'])?' selected':'');?>><?=$child['category'];?></option>
    <?php endwhile; ?>

<?php echo ob_get_clean(); ?>