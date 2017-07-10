<?php 
        $sql="select * from categories where parent=0";
        $pquery=$db->query($sql);
?>
<!-- Top nav Bar -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
            <div class="container">
                <a href="index.php" class="navbar-brand">Sudhir Computers</a>
                <ul class="nav navbar-nav">
                    <?php while($parent=mysqli_fetch_assoc($pquery)) : ?>
                    <?php 
                    $parent_id=$parent['id'];
                    $sql2="select * from categories where parent='$parent_id'";
                    $cquery=$db->query($sql2);
                    ?>
                    <!-- Menu Items -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $parent['category']; ?><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <?php while($child=mysqli_fetch_assoc($cquery)) : ?>
                            <li><a href="category.php?cat=<?=$child['id'];?>"><?php echo $child['category']; ?></a></li>
                            <?php endwhile; ?>
                        </ul>
                    </li>
                    <?php endwhile; ?>
                    <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</a></li>
                </ul>
            </div>
        </nav>