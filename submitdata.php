<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
        include("connection.php");
		
		$requestType = $_SERVER['REQUEST_METHOD'];
		if ($requestType == 'POST')
		{	
			//echo '<pre>'.print_r($_POST, true).'</pre>'; exit();
			$product_sku = $_POST["product_sku"];
			$product_name = $_POST["product_name"];
			$product_unit = $_POST["product_unit"];
			$product_description = $_POST ["product_description"];
			$product_price = $_POST["product_price"];

			$targetDir = "uploads/";
			$allowTypes = array('jpg','png','jpeg','gif');
			$fileNames = array_filter($_FILES['product_image']['name']);
			$errorUpload = $errorUploadType = "";

			if(!empty($fileNames))
			{
				
				foreach ($_FILES['product_image']['name'] as $key=>$val)
				{
					
					$fileName = basename($_FILES["product_image"]["name"][$key]);
					$targetFilePath = $targetDir.$fileName;
					$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
					if (in_array($fileType,$allowTypes))
					{
						
						if (move_uploaded_file($_FILES["product_image"]["tmp_name"][$key],$targetFilePath))
						{
							$successimage = 1;
							
						}
						else
						{
							$errorUpload .= $_FILES["product_image"]["name"][$key]. '|'; 
							echo "ERROR";
						}
					}
					else
					{
						$errorUploadType .= $_FILES["product_image"]["name"][$key]. '|';
						echo "ERROR";
					}

				}

			}

			foreach($product_name as $key => $val)
			{
				
				$sql = "INSERT INTO products (product_sku, product_name, product_unit, product_description, 
				product_price, product_image) VALUES ('". $product_sku[$key] ."','". $product_name[$key] ."',
				'". $product_unit[$key] ."', '". $product_description[$key] ."','". $product_price[$key] ."',
				'". $fileNames[$key] ."')";


				if ($conn->query($sql) == TRUE)
				{
					
					$insert_success = true;
				}
				else
				{
					echo "REACHED";
					$insert_success = false;
				}

			}	
			
			session_start();
			if ($insert_success == true)
			{
				$_SESSION["success_message"]= "PRODUCT INSERTED SUCCESSFULLY";
				$conn->close();
				header("Location: product_view.php");

			}

		}

	?>

</body>
</html>
