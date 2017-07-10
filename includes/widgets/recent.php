<h3 class="text-center">Popular Items</h3>
<style>
    #recent_widget td{
    font-size: 16px;
    }
</style>
<?php
$transQ=$db->query("select * from cart where paid=1 order by id desc limit 5");
$results=array();
while($row=mysqli_fetch_assoc($transQ)){
    $results[]=$row;
}

$row_count=$transQ->num_rows;
$used_ids=array();
for($i=0;$i<$row_count;$i++){
    $json_items=$results[$i]['items'];
    $items=json_decode($json_items,true);
    foreach($items as $item){
        if(!in_array($item['id'],$used_ids)){
            $used_ids[]=$item['id'];
        }
    }
}
?>

<div id="recent_widget">
    <table class="table table-condensed">
        <?php
        foreach($used_ids as $id):
        $productQ=$db->query("select id,title from products where id='{$id}'");
        $product=mysqli_fetch_assoc($productQ);
        ?>
        <tr>
            <td>
                <?=substr($product['title'],0,15);?>
            </td>
            <td>
                <a class="text-primary" onclick="detailsmodal('<?=$id;?>')">View</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>