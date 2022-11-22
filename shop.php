
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
 
</head>
<body>
<div class="container">

<form class="form-horizontal" action="" method="post">
  <fieldset class="scheduler-border">
     <legend class="scheduler-border">Product Form:</legend>
      <div class="form-group">
      <label class="control-label col-sm-2" for="Product">Product Name:</label>
      <div class="col-sm-12">
<input class="input" name="products" type="text" class="form-control" value="">
</div>
</div>
<div class="form-group">
      <label class="control-label col-sm-2" for="Quantity">Product Quantity:</label>
      <div class="col-sm-12">
<input class="input" name="quantity" type="text" class="form-control" value="" required>
</div>
</div>
 <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-4">
<input class="submit" name="submit" class="btn btn-success" type="submit"  value="Insert">
</div>
</div>
  </fieldset>
</form>
</body>
</html>

<?php
$product_name = "";
$product_quantity = "";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
} 

if(isset($_POST['submit'])){ // Fetching variables of the form which travels in URL
 $products = $_POST['products'];
  $quantity = $_POST['quantity'];
  


$sql = "INSERT INTO `product`(`product_name`, `product_quantity`) values ('$products', '$quantity')";
if ($conn->query($sql) === TRUE) {
  //echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}



$sql = "SELECT * FROM product";
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){?>

       <table class="table table-striped">
       <?php //echo "<table>";
            echo "<tr>";
                echo "<th>id</th>";
                echo "<th>Item Name</th>";
                echo "<th>Total Product</th>";
                echo "<th>Remaing Item</th>";
                 echo "<th>Edit</th>";
                  echo "<th>Delete</th>";
               
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                $remaing_product = ($row['product_quantity']) - ($row['product_sell']);
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td>" . $row['product_quantity'] . "</td>";
                echo "<td>" . $remaing_product . "</td>";
              echo  "<td>"
				?> <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn-success" >Edit</a> <?php
			"</td>";
		echo "<td>"
				?>
				<a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete?')" class="btn-danger">Delete</a>
		<?php	"</td>";
            echo "</tr>";
        }
        echo "</table>";?>
      </div>
      <?php
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
$conn->close();
?>

