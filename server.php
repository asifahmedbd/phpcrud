<?php

session_start();

include("connection.php");

$requestType = $_SERVER['REQUEST_METHOD'];

if ($requestType == "POST")
{
    
    if (isset($_POST["delete"]))
    {
        $_SESSION['product_id'] = $_POST["product_id"];
        $product_id = $_SESSION['product_id'];
        $sql = "DELETE FROM products where id = $product_id";
        if ($conn->query($sql)===TRUE)
        {
            $_SESSION['success_message'] = "PRODUCT DELETED SUCCESSFULLY";
        }
        
        header("Location: product_view.php");
    }

    if (isset($_POST['update_product']))
    {

            $_SESSION['product_sku'] = $_POST["product_sku"];
            $_SESSION['product_name'] = $_POST["product_name"];
            $_SESSION['product_unit'] = $_POST["product_unit"];
            $_SESSION['product_description'] = $_POST["product_description"];
            $_SESSION['product_price'] = $_POST["product_price"];
            
            $product_sku = $_SESSION["product_sku"];
			$product_name = $_SESSION["product_name"];
			$product_unit = $_SESSION["product_unit"];
			$product_description = $_SESSION ["product_description"];
			$product_price = $_SESSION["product_price"];

            $_SESSION['product_id'] = $_POST["product_id"];
            $product_id = $_SESSION['product_id'];

            $_SESSION['product_image'] = $_FILES['product_image'];
            $product_image = $_SESSION['product_image'];

			$targetDir = "uploads/";
			$allowTypes = array('jpg','png','jpeg','gif');
			$fileNames = array_filter($product_image['name']);
			$errorUpload = $errorUploadType = "";

			if(!empty($fileNames))
			{
				
				foreach ($product_image['name'] as $key=>$val)
				{
					
					$fileName = basename($product_image["name"][$key]);
					$targetFilePath = $targetDir.$fileName;
					$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
					if (in_array($fileType,$allowTypes))
					{
						
						if (move_uploaded_file($product_image["tmp_name"][$key],$targetFilePath))
						{
							
                            $successimage = 1;
							
						}
						else
						{
							$errorUpload .= $product_image["name"][$key]. '|'; 
							echo "ERROR";
						}
					}
					else
					{
						$errorUploadType .= $product_image["name"][$key]. '|';
						echo "ERROR";
					}

				}

			}

			foreach($product_name as $key => $val)
			{
				
                
				$sql = "UPDATE products SET product_sku='". $product_sku[$key] ."', product_name='". $product_name[$key] ."',
				product_unit='". $product_unit[$key] ."', product_description='". $product_description[$key] ."', product_price='". $product_price[$key] ."',
				product_image='". $fileNames[$key] ."' WHERE id = $product_id";


				if ($conn->query($sql) == TRUE)
				{
					
					$insert_success = true;
				}
				else
				{
                    echo "$product_sku[$key]";

					$insert_success = false;
				}

			}	
		
			if ($insert_success == true)
			{
				$_SESSION["success_message"]= "PRODUCT UPDATED SUCCESSFULLY";
				$conn->close();
				header("Location: product_view.php");

			}

		}

    }

?>