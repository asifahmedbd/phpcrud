<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product PHP</title>
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
	<form action="submitdata.php" method="post" enctype="multipart/form-data">
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
	                                    <input type="text" name="product_sku[]" class="textinput form-control" />
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-md-2">
	                            <div id="div_id_stock_1_service" class="form-group">
	                                <label for="id_stock_1_product" class="control-label  requiredField"> Product
	                                    <span class="asteriskField">*</span>
	                                </label>
	                                <div class="controls ">
	                                    <input type="text" name="product_name[]" class="textinput form-control" />
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-md-1">
	                            <div id="div_id_stock_1_unit" class="form-group">
	                                <label for="id_stock_1_unit" class="control-label requiredField">
	                                    Unit
	                                    <span class="asteriskField">*</span>
	                                </label>
	                                <div class="controls ">
	                                	<select class="select form-control" name="product_unit[]">	<option value="" selected="selected">---------</option>
	                                		<option value="Liter">Liter</option>
	                                		<option value="Pieces">Pieces</option>
	                                		<option value="KG">KG</option>
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
	                                	<input class="form-control" name="product_description[]" step="1" type="text" />
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
	                                	<input class="priceinput form-control" name="product_price[]" type="text" />
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
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
		<button id="add-more" class="btn btn-primary" type="button">Add More</button>
	    <button class="btn btn-primary" type="submit">SUBMIT</button>
    </form>
</div>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- <script src="js/jquery.czMore-1.5.3.2.js"></script> -->
    <script type="text/javascript">
        //One-to-many relationship plugin by Yasir O. Atabani. Copyrights Reserved.
        //$("#czContainer").czMore();

			$('#add-more').click(function () {
                var newRow = `<div class="fieldRow clearfix">
                                <div class="col-md-2">
                                    <div id="div_id_stock_1_service" class="form-group">
                                        <label for="id_stock_1_product" class="control-label  requiredField"> Product SKU
                                            <span class="asteriskField">*</span>
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="product_sku[]" class="textinput form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div id="div_id_stock_1_service" class="form-group">
                                        <label for="id_stock_1_product" class="control-label  requiredField"> Product
                                            <span class="asteriskField">*</span>
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="product_name[]" class="textinput form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div id="div_id_stock_1_unit" class="form-group">
                                        <label for="id_stock_1_unit" class="control-label requiredField">
                                            Unit
                                            <span class="asteriskField">*</span>
                                        </label>
                                        <div class="controls">
                                            <select class="select form-control" name="product_unit[]">
                                                <option value="" selected="selected">---------</option>
                                                <option value="Liter">Liter</option>
                                                <option value="Pieces">Pieces</option>
                                                <option value="KG">KG</option>
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
                                        <div class="controls">
                                            <input class="form-control" name="product_description[]" step="1" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div id="div_id_stock_1_quantity" class="form-group">
                                        <label for="id_stock_1_quantity" class="control-label  requiredField">
                                            Base Price
                                            <span class="asteriskField">*</span>
                                        </label>
                                        <div class="controls">
                                            <input class="priceinput form-control" name="product_price[]" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div id="div_id_stock_1_quantity" class="form-group">
                                        <label for="id_stock_1_quantity" class="control-label  requiredField">
                                            Image
                                            <span class="asteriskField">*</span>
                                        </label>
                                        <div class="controls">
                                            <input class="form-control" name="product_image[]" type="file" multiple />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 remove-row" style="margin-top: 25px;">
                                    <button type="button" class="btn btn-danger remove-button">Delete</button>
                                </div>
                            </div>`;
                $('#czContainer').append(newRow);
            });

			$(document).on('click', '.remove-button', function () {
                $(this).closest('.fieldRow').remove();
            });

    </script>
</body>
</html>