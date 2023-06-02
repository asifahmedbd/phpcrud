<?php 
	session_start();
	// Fetch all products from database
	include 'connection.php';
	$sql = "SELECT * FROM products";
	$result = $conn->query($sql);

	$filepath = 'http://localhost:8080/naushiba/uploads/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Product View</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	

	<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</head>
<body>
<div class="container" style="padding: 10px; margin-top: 20px; border: 2px solid #000; border-radius: 2px;">
	<?php if(isset($_SESSION["success_message"])) { ?>
		<div class="alert alert-success" role="alert">
		  <?php echo $_SESSION["success_message"]; ?>
		</div>
	<?php } ?>
	<div class="row">
		<div class="col-md-10">
			<h2 style="text-align: center; color: #d08c23; ">MANAGE PRODUCT</h2>
		</div>
		<div class="col-md-2">
			<a class="btn btn-primary" href="index.php">Add New Product</a>
		</div>
	</div>
	
	<div class="showdata">
		<table id="example" class="table table-striped table-bordered" style="width:100%">
	        <thead>
	            <tr>
	            	<th>SL.</th>
	                <th>Name</th>
	                <th>SKU</th>
	                <th>Unit</th>
	                <th>Price</th>
	                <th>Image</th>
	                <th>Action</th>
	            </tr>
	        </thead>
	        <tbody>

			<?php

				if ($result -> num_rows >0) 
				{
					$count = 1;
					while($row = $result -> fetch_assoc())
					{
						?>

						<tr>
							
							<td><?php echo $count ?></td>
							<td><?php echo $row["product_name"] ?></td>
							<td><?php echo $row["product_sku"] ?></td>
							<td><?php echo $row["product_unit"] ?></td>
							<td><?php echo $row["product_price"] ?></td>
							
							<td style= "text-align=center;"><img src = "<?php echo $filepath.$row["product_image"] ?>" width = "50" height = "50"></td>
							
							<td style = "display:flex; border:none;">

							<form id = "updateProduct" action = "update_product_view.php" method ="POST">

									<input type = "hidden" name="product_id" value="<?php echo $row["id"]; ?>"/>
									<input type = "submit" class="btn btn-success btn-sm" name="update" value="EDIT"/>

							</form>

							<form id="deleteProduct" action = "server.php" method="POST" style="margin=left:10px;">

									<input type = "hidden" name="product_id" value="<?php echo $row["id"]; ?>"/>
									<input onclick="return confirm('DO YOU WANT TO DELETE THIS PRODUCT?')"
									type = "submit" class="btn btn-danger btn-sm" name="delete" value="DELETE"/>
									
							</form>
							</td>
						</tr>

			<?php
			
				$count++;
				
					}
				}

			?>

	        </tbody>
    	</table>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').DataTable();
	    $('.alert-success').delay(3000).fadeOut('slow');
	});
</script>

</body>
</html>