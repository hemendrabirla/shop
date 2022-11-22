<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";
//$row['product_name'] =  "";
//$row['product_quantity'] = "";

$id =  $_GET['id'];



$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM product WHERE `id`= $id";

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
 
        while($row = mysqli_fetch_array($result)){

                $product_name = $row['product_name'];
                $product_total_quantity = $row['product_quantity'];
                $product_sell_quantity = $row['product_sell'];
            /*echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td>" . $row['product_quantity'] . "</td>";
                echo "<td>" . @ $row['product_quantity'] - $row['product_sell'] . "</td>";
              echo  "<td>"
				?> <a href="edit.php?id=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a> <?php
			"</td>";
		"<td>"
				?>
				<a href="delete.php?id=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
		<?php	"</td>";
            echo "</tr>";*/
        }
   
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
}

 ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<form action="" method="post">
<label>Product Name:</label>
<input class="input" name="products" type="text" value="<?php echo $product_name;?>">
<label>Total Product Quantity:</label>
<input class="input" name="quantity" type="text" value="<?php echo $product_total_quantity;?>">
<label>Sell Product Quantity:</label>
<input class="input" name="product_sell" type="text" value="<?php echo $product_sell_quantity;?>" required>
<input class="submit" name="update" type="submit" value="update">
</form>
</body>
</html>

<?php

if (isset($_POST['update'])) {
	  echo $products = $_POST['products'];
	  echo $quantity = $_POST['quantity'];
	  echo $product_sell = $_POST['product_sell'];

	 
 $sql =  "UPDATE `product` SET `product_name` = $products, `product_quantity` = $quantity, `product_sell` = $product_sell WHERE `id` = $id";

    $result = mysqli_query($conn ,$sql);

if($result){
	echo " update";

}
else{
	echo "not update";
}

	
}
?>


