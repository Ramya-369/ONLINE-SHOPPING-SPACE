<?php
session_start();
$connect=mysqli_connect("localhost","root","","shopping");
if(isset($_POST["atoc"]))
{
    if(isset($_SESSION["shopping"]))
    {
       $item_array_id=array_column($_SESSION["shooping_cart"],"item_id");
       if(!in_array($_GET["id"],$item_array_id))
       {
        $count=count($_SESSION["shopping"]);
            
        $item_array=array
        (
            'item_id'  => $_GET["id"],
            'item_name' =>$_POST["hidden_name"],
            'item_price' ->$_POST["hidden_price"],
            'item_quantity' ->$_POST["quantity"]
        );
        $_SESSION["shopping"][0]=$item_array;
       }
       else{
        echo '<script>alert("Item Already Added")</script>';
        echo '<script>window.location="index.php"</script>';
       }
    }
    else
    {
        $item_array=array
        (
            'item_id'  => $_GET["id"],
            'item_name' =>$_POST["hidden_name"],
            'item_price' =>$_POST["hidden_price"],
            'item_quantity' =>$_POST["quantity"]
        );
        $_SESSSION["shopping"][0]=$item_array;
    }
}
if(isset($_GET["action"]))
{
    if($_GET["action"]=="delete")
    {
        foreach($_SESSION["shopping"] as $keys => $values)
        {
            if($values["item_id"]==$_GET["id"])
            {
                unset($_SESSION[ " shopping"] [$keys] ) ;
                echo '<script>alert ( " Item Removed")</script> ' ;
                echo '<script>window.location="index.php"</script>' ;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
</head>
<body>
    <br/>
    <div class="container" style="width:700px;">
    <h3 align="center">Shopping Space</h3><br/>
    <?php
    $query=" SELECT * FROM products ORDER BY brand_name ASC";
    $result=mysqli_query($connect,$query);
    if(mysqli_num_rows($result))
    {
        while($row=mysqli_fetch_array($result))
        {
            ?>
            <div class="col-md-1 ">
                <form method="POST" action="index.php?action=add&id=<?php echo $row["brand_name"];?>">
                <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:10px 20px; align="center">
                <img src=<?php echo "uploads/".$row["image"];?> style="height:100px;width:100px" class="img-responsive" /><br/>
                <h4 class="text-info"><?php echo $row["product_name"];?></h4>
                <h4 class="text-danger"><?php echo $row["product_price"];?></h4>
                <input type="text" name="quantity" class="form-control" value="1" />
                <input type="hidden" name="hidden_name" value="<?php echo $row["product_name"]; ?>"/>
                <input type="hidden" name="hidden_price" value="<?php echo $row["product_price"]; ?>"/>
                <input type="submit" name="atoc" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
        </div>
        </form>
        </div>
        <?php

            
        }
    } 
    ?>
    <div style="clear:both"></div>
    <br />
    <!--<h3>Order Details</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th width="40%">Item Name</th>
                <th width="10%">Quantity</th>
                <th width="20%">Price</th>
                <th width="15%">Total</th>
                <th width="5%">Actiom</th>
</tr>-->
<!-- if(!empty($_SESSION["shopping"]))
{
    $total=0;
    foreach($_SESSION["shopping"] as $keys => $values)

    {      
        <tr>
            <td>  <?php echo $values["product_name"]; ?></td>
            <td><?php echo $values["product_price"]; ?></td>
            <td><?php echo $values["product_price"]; ?></td>
            <td><?php echo number_format($values["product_price"] * $values["item_price"],2); ?></td>
            <td> <a href="index.php?action=delete&id=<?php echo $values["item_id"];?>"><span class="text-danger">Remove</span></a></td>
        </tr>
     
        <?php
          $total=$total+($values["item_quantity"] * $values["item_price"]);
        ?>
    }

    <tr>
 <td colspan=" 3" align="right">Total</td>
 <td align="right">$ <?php echo number_format ($total,2);?> </td>
 <td></td>
  </tr>
    </table>
}
?> -->

    
