<?php

        session_start();
        include('connection.php');
        $requestType = $_SERVER['REQUEST_METHOD'];

        if($requestType == 'POST')
        {
            if(isset($_POST['update']))
            {
                $_SESSION['product_id'] = $_POST["product_id"];
                $product_id = $_SESSION['product_id'];
                $sql = "SELECT * FROM products where id = $product_id";
                $result = $conn->query($sql);

            }
        }

        $filepath = 'http://localhost/productphp/uploads/';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product Update</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <style type="text/css">
        body {
            padding-top: 60px;
            padding-bottom: 40px;
        }

        .navbar-brand img {
            margin-top: -5px;
            margin-right: auto;
            margin-left: auto;
        }
    </style>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">


    <!-- Latest compiled and minified JavaScript -->
</head>
<body>

<div class="content">
	<h1>Daily Products</h1>
	<form action="server.php" method="post" enctype="multipart/form-data">
        <?php while($row = $result->fetch_assoc()){ ?>
	    <div class="well clearfix">
	        <div id="czContainer">
	            <div id="first">
	                <div class="recordset">
	                    <div class="fieldRow clearfix">
	                    	<div class="col-md-2">
	                            <div id="div_id_stock_1_service" class="form-group">
	                                <label for="id_stock_1_product" class="control-label  requiredField"> Product SKU
	                                    <span class="asteriskField">*</span>
	                                </label>
	                                <div class="controls">
	                                    <input type="text" name="product_sku[]" class="textinput form-control"
                                        value = "<?php echo $row["product_sku"] ?>" />
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-md-2">
	                            <div id="div_id_stock_1_service" class="form-group">
	                                <label for="id_stock_1_product" class="control-label  requiredField"> Product
	                                    <span class="asteriskField">*</span>
	                                </label>
	                                <div class="controls ">
	                                    <input type="text" name="product_name[]" class="textinput form-control" 
                                        value = "<?php echo $row["product_name"] ?>" />
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-md-1">
	                            <div id="div_id_stock_1_unit" class="form-group">
	                                <label for="id_stock_1_unit" class="control-label  requiredField">
	                                    Unit
	                                    <span class="asteriskField">*</span>
	                                </label>
	                                <div class="controls ">
	                                	<select class="select form-control" name="product_unit[]">	<option value="" selected="selected">---------</option>
	                                		<option value="Liter" <?php if($row['product_unit']=="Liter"){?>selected = "selected"<?php }?>>Liter</option>
	                                		<option value="Pieces" <?php if($row['product_unit']=="Pieces"){?>selected = "selected"<?php }?>>Pieces</option>
	                                		<option value="KG" <?php if($row['product_unit']=="KG"){?>selected = "selected"<?php }?>>KG</option>
	                                	</select>
	                            	</div>
	                            </div>
	                        </div>
	                        <div class="col-md-2">
	                            <div id="div_id_stock_1_quantity" class="form-group">
	                                <label for="id_stock_1_quantity" class="control-label  requiredField">
	                                    Description
	                                    <span class="asteriskField">*</span>
	                                </label>
	                                <div class="controls ">
	                                	<input class="form-control" name="product_description[]" step="1" type="text" 
                                        value = "<?php echo $row["product_description"] ?>"/>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-md-2">
	                            <div id="div_id_stock_1_quantity" class="form-group">
	                                <label for="id_stock_1_quantity" class="control-label  requiredField">
	                                    Base Price
	                                    <span class="asteriskField">*</span>
	                                </label>
	                                <div class="controls ">
	                                	<input class="priceinput form-control" name="product_price[]" type="text" 
                                        value = "<?php echo $row["product_price"] ?>"/>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-md-2">
	                            <div id="div_id_stock_1_quantity" class="form-group">
	                                <label for="id_stock_1_quantity" class="control-label  requiredField">
	                                    Image
	                                    <span class="asteriskField">*</span>
	                                </label>
	                                <div class="controls ">
	                                	<input class="form-control" name="product_image[]" type="file" multiple />
	                                </div>
	                            </div>
	                        </div>
                            <div class="col-md-2">
	                            <div id="div_id_stock_1_quantity" class="form-group">
	                                <label for="id_stock_1_quantity" class="control-label  requiredField">
	                                    Current Image
	                                    <span class="asteriskField">*</span>
	                                </label>
	                                <div class="controls ">
                                    <img src = "<?php echo $filepath.$row["product_image"] 
							        ?>" width = "50" height = "50">
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    
        <button class="btn btn-primary" type="submit">UPDATE PRODUCT INFORMATION</button>
        
        <input type = "hidden" name="product_id" value="<?php echo $row["id"]; ?>"/>
        <input type = "hidden" name="update_product"/>
        
        <?php } ?>
    </form>
</div>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="js/jquery.czMore-1.5.3.2.js"></script>
    <script type="text/javascript">
        //One-to-many relationship plugin by Yasir O. Atabani. Copyrights Reserved.
        $("#czContainer").czMore();
    </script>
</body>
</html>
