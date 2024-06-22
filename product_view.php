<?php 
	session_start();
	// Fetch all products from database
	include 'connection.php';
	$sql = "SELECT * FROM products";
	$result = $conn->query($sql);

	$filepath = 'http://localhost/phpcrud/uploads/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Product View</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	

	<script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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

						<tr id="productRow-<?php echo $row["id"]; ?>" class="product-row" data-id="<?php echo $row["id"]; ?>">
							
							<td><?php echo $count ?></td>
							<td class="product-name"><?php echo $row["product_name"] ?></td>
							<td class="product-sku"><?php echo $row["product_sku"] ?></td>
							<td class="product-unit"><?php echo $row["product_unit"] ?></td>
							<td class="product-price"><?php echo $row["product_price"] ?></td>
							
							<td style= "text-align=center;"><img src = "<?php echo $filepath.$row["product_image"] ?>" width = "50" height = "50"></td>
							
							<td style = "border:none;">

								<input type = "submit" class="btn btn-success btn-sm edit_product" name="update" value="EDIT" data-product-id="<?php echo $row["id"]; ?>"/>
								<button type="button" class="btn btn-danger btn-sm delete-product-btn" data-id="<?php echo $row["id"]; ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">DELETE</button>

									
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

<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editProductForm">
          <div class="mb-3">
            <label for="productName" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="productName" name="product_name">
          </div>
		  <div class="mb-3">
            <label for="productSKU" class="form-label">Product SKU</label>
            <input type="text" class="form-control" id="productSKU" name="product_sku">
          </div>
          <div class="mb-3">
            <label for="productPrice" class="form-label">Product Price</label>
            <input type="text" class="form-control" id="productPrice" name="product_price">
          </div>
          <!-- Add more fields as needed -->
		  <input id="product_id" type="hidden" name="product_id" value="">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this product?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').DataTable();
	    $('.alert-success').delay(3000).fadeOut('slow');
		var productIdToDelete;

		$('.edit_product').on('click', function() {
			var productId = $(this).data('product-id');
			$.ajax({
				url: 'ajax_getproductdata.php', // Replace with your server URL
				type: 'GET',
				data: { id: productId },
				success: function(data) {
					console.log(data);
					var productData = JSON.parse(data);
					// Populate the modal fields with the fetched data
					$('#productName').val(productData.product_name);
					$('#productSKU').val(productData.product_sku);
					$('#productPrice').val(productData.product_price);
					// Populate more fields as needed
					
					// Show the modal
					$('#editProductModal').modal('show');
					$('#editProductModal #product_id').val(productData.id);
				},
				error: function(xhr, status, error) {
					console.error('AJAX Error: ' + status + error);
				}
			});
		});

		$('#saveChanges').on('click', function() {
			var productId = $('#editProductModal #product_id').val();
			console.log(productId);
			var formData = $("#editProductForm").serialize();
			// Send data to your PHP file using Ajax
			$.ajax({
				type: "POST",
				url: "ajax_update_product_data.php", // Replace with your PHP file URL
				data: formData,
				success: function(response) {
					var result = JSON.parse(response);

					if (result.status === 'success') {
					var productId = $('#product_id').val();
					var productName = $('#productName').val();
					var productSKU = $('#productSKU').val();
					var productPrice = parseFloat($('#productPrice').val()).toFixed(2);

					var row = $('#productRow-' + productId);
					row.find('.product-name').text(productName);
					row.find('.product-sku').text(productSKU);
					row.find('.product-price').text(productPrice);

					row.find('.edit-product-btn').data('name', productName)
												.data('sku', productSKU)
												.data('price', productPrice);

					$('#editProductModal').modal('hide');

					alert('Product updated successfully!');
					} else {
					alert('Failed to update product: ' + result.message);
					}
				},
				error: function () {
				// Handle error (e.g., display an error message)
				console.log("Error submitting form data.");
				}
			});
		});

		// Set the product ID to delete when the delete button is clicked
		$(document).on('click', '.delete-product-btn', function() {
			productIdToDelete = $(this).data('id');
		});

		// Handle the confirm delete button click
		$('#confirmDeleteButton').on('click', function() {
			$.ajax({
			url: 'ajax_delete_product.php', // Replace with your endpoint
			type: 'POST',
			data: { product_id: productIdToDelete },
			success: function(response) {
				var result = JSON.parse(response);

				if (result.status === 'success') {
				// Remove the product row from the table
				$('#productRow-' + productIdToDelete).remove();

				// Hide the delete confirmation modal
				$('#confirmDeleteModal').modal('hide');

				alert('Product deleted successfully!');
				} else {
				alert('Failed to delete product: ' + result.message);
				}
			},
			error: function(xhr, status, error) {
				alert('Error deleting product: ' + error);
			}
			});
		});

	});
</script>

</body>
</html>