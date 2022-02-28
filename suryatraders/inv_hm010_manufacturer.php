<?php
include 'globalfile.php';
fn_DataClear ();
if (isset ( $_GET ['manufacturerno'] ) && ! empty ( $_GET ['manufacturerno'] )) {
	$no = $_GET ['manufacturerno'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['manufacturerno'] );
	} else {
		$xQry = "DELETE FROM inv_manufacturer WHERE manufacturerno= $no";
		mysql_query ( $xQry ) or die ( mysql_error () );
		echo '<script type="text/javascript">swal("Good job!", "Deleted!", "success");</script>';
		header ( 'Location: inv_hm010_manufacturer.php' );
	}
} elseif (isset ( $_POST ['save'] )) {
	
	DataProcess ( "S" );
} elseif (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
} else {
	fn_GetMaxIdNo ();
}
function fn_DataClear() {
	$GLOBALS ['xCustomerId'] = '';
	$GLOBALS ['xManufacturerName'] = '';
	$GLOBALS ['xAddress'] = '';
	$GLOBALS ['xRange'] = '';
	$GLOBALS ['xDivision'] = '';
	$GLOBALS ['xCommisionerate'] = '';
	$GLOBALS ['xDescription'] = '';
	$GLOBALS ['xCExNo'] = '';
	$GLOBALS ['xTarrifNo'] = '';
	
}
function fn_GetMaxIdNo() {
	$xQry = "SELECT  CASE WHEN max(manufacturerno)IS NULL OR max(manufacturerno)= '' THEN '1' ELSE max(manufacturerno)+1 END AS manufacturerno FROM inv_manufacturer";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xCustomerid'] = $row ['manufacturerno'];
		$GLOBALS ['xMobileNo'] = 0;
	}
}
function DataFetch($xCustomerid) {
	$result = mysql_query ( "SELECT *  FROM inv_manufacturer where manufacturerno=$xCustomerid" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xCustomerid'] = $row ['manufacturerno'];
			$GLOBALS ['xManufacturerName'] = $row ['manufacturername'];
			$GLOBALS ['xAddress'] = $row ['address'];
			$GLOBALS ['xCExNo'] = $row ['cexno'];
			$GLOBALS ['xRange'] = $row ['range'];
			$GLOBALS ['xDivision'] = $row ['division'];
			$GLOBALS ['xDescription'] = $row ['description'];
			$GLOBALS ['xCommisionerate'] = $row ['commisionerate'];
			$GLOBALS ['xTarrifNo'] = $row ['tarrifno'];
		}
	}
}
function DataProcess($mode) {
	$xManufaturerNo = $_POST ['f_manufacturerno'];
	$xManufacturerName = strtoupper ( $_POST ['f_manufacturername'] );
	$xAddress = $_POST ['f_address'];
	$xRange = $_POST ['f_range'];
	$xDivision = $_POST ['f_division'];
	$xDescription = $_POST ['f_description'];
	$xCommisionerate = $_POST ['f_commisionerate'];
	$xCExNo = $_POST ['f_cexno'];
	$xTarrifNo = $_POST ['f_tarrifno'];
	
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO inv_manufacturer  VALUES ($xManufaturerNo,'$xManufacturerName',
		'$xAddress','$xCExNo','$xRange','$xDivision',
		'$xDescription','$xCommisionerate','$xTarrifNo')";
		echo '<script type="text/javascript">swal("Good job!", "Inserted!", "success");</script>';
	} elseif ($mode == 'U') {
		$xQry = "UPDATE inv_manufacturer   SET manufacturername='$xManufacturerName',
		address='$xAddress',
		range='$xRange',
		division='$xDivision',
		description='$xDescription',commisionerate='$xCommisionerate',cexno='$xCExNo' 
		WHERE manufacturerno=$xManufaturerNo";
		echo '<script type="text/javascript">swal("Good job!", "Updated!", "success");</script>';
	}
	//echo $xQry;
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	fn_GetMaxIdNo ();
	ShowAlert ( $xMsg );
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manufacturer</title>
</head>
<script type="text/javascript">
        function validateForm() {

            var xManufacturerName = document.forms["inventorymanufacturerform"]["f_manufacturername"].value;
            if (xManufacturerName == null || xManufacturerName == "") {
                alert("manufacturer-Name must be filled out");
                document
                    .inventorymanufacturerform
                    .f_manufacturername
                    .focus();
                return false;
            }

        }
    </script>
<body onload='document.inventorymanufacturerform.f_manufacturername.focus()'>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form"
		method="post" name="inventorymanufacturerform">
		<div class="panel panel-primary" data-bind="nextFieldOnEnter:true">
			<div class="panel-heading  text-center">
				<h3 class="panel-title">Master -Manufacturer</h3>
			</div>

			<div class="panel-body">

				<div class="col-xs-2" style="display: none;">
					<label>Customer Id:</label> <input type="text" class="form-control"
						name="f_manufacturerno"
						value="<?php echo $GLOBALS ['xCustomerid']; ?>" readonly>
				</div>
				<div class="col-xs-3">
					<label>Manufacturer Name :</label> <input class="form-control"
						name="f_manufacturername" type="text"
						value="<?php echo $GLOBALS ['xManufacturerName']; ?>">
				</div>

				<div class="col-xs-3">
					<label>Address:</label> <input class="form-control"
						name="f_address" type="text"
						value="<?php echo $GLOBALS ['xAddress']; ?>">
				</div>
				
					<div class="col-xs-3">
					<label>C.Ex No :</label> <input class="form-control"
						name="f_cexno" type="text"
						value="<?php echo $GLOBALS ['xCExNo']; ?>">
				</div>
				<div class="col-xs-3">
					<label>Range:</label> <input class="form-control"
						name="f_range" type="text"
						value="<?php echo $GLOBALS ['xRange']; ?>">
				</div>
				<div class="col-xs-3">
					<label>Division:</label> <input class="form-control"
						name="f_division" type="text"
						value="<?php echo $GLOBALS ['xDivision']; ?>">
				</div>


				<div class="col-xs-3">
					<label>Commisionerate</label> <input class="form-control"
						name="f_commisionerate" type="text"
						value="<?php echo $GLOBALS ['xCommisionerate']; ?>">
				</div>


				<div class="col-xs-3">
					<label>Description :</label> <input class="form-control"
						name="f_description" type="text"
						value="<?php echo $GLOBALS ['xDescription']; ?>">
				</div>
				
					<div class="col-xs-3">
					<label>Tarrif No :</label> <input class="form-control"
						name="f_tarrifno" type="text"
						value="<?php echo $GLOBALS ['xTarrifNo']; ?>">
				</div>
				
			</div>

			<div class="panel-footer clearfix">
				<div class="pull-right">
                        <?php if ($GLOBALS ['xMode'] == "") {  ?>
                        <input class="btn btn-primary" id="save"
						name="save" onclick="return validateForm()" type="submit"
						value="SAVE">
                    <?php } else{ ?>
                        <input class="btn btn-primary" name="update"
						onclick="return validateForm()" type="submit" value="UPDATE">
                        <?php }  ?>
                    </div>
			</div>

		</div>
	</form>
	<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
	<div id="divToPrint">
		<div class="container">
			<div class="panel panel-info">
				<!-- Default panel contents -->
				<div class="panel-heading clearfix">
					<h3 class="panel-title pull-left" style="padding-top: 7.5px;">View
						Manufacturer</h3>
					<div class="btn-group pull-right">
						<a class="btn btn-default" href="inv_hc001manufacturer.php">CONFIG</a>
					</div>
				</div>
				<table class="table">
					<thead>
						<tr>
							<th>S.NO</th>
							<th>Manufacturer Name</th>
							<th>Address</th>
							<th>C.Ex.RegNo</th>
							<th>Range</th>
							<th>Division</th>
							<th>Commisionerate</th>
							<th>Description</th>
							<th>TarrifNo</th>
							<th colspan="2" width="5%">ACTIONS</th>
						</tr>
					</thead>
					<tbody>

                                <?php
																																$xSlNo = 0;
																																$xQry = '';
																																$xQry = "SELECT *  from inv_manufacturer order by  manufacturername";
																																$result2 = mysql_query ( $xQry );
																																$rowCount = mysql_num_rows ( $result2 );
																																while ( $row = mysql_fetch_array ( $result2 ) ) {
																																	?><tr>
																																	<?php
																																	echo '<td>' . $xSlNo += 1 . '</td>';
																																	echo '<td>' . $row ['manufacturername'] . '</td>';
																																	echo '<td>' . $row ['address'] . '</td>';		
																																	echo '<td>' . $row ['cexno'] . '</td>';
																																	echo '<td>' . $row ['range'] . '</td>';		
																																	echo '<td>' . $row ['division'] . '</td>';
																																	echo '<td>' . $row ['commisionerate'] . '</td>';
																																	echo '<td>' . $row ['description'] . '</td>';
																																	echo '<td>' . $row ['tarrifno'] . '</td>';
																																	
																																	?>
                                <td><a
								href="inv_hm010_manufacturer.php<?php echo '?manufacturerno='.$row['manufacturerno'] . '&xmode=edit'; ?>"
								onclick="return confirm_edit()"> <img alt="HTML tutorial"
									src="images/edit.png"
									style="width: 30px; height: 30px; border: 0">
							</a></td>


                                <?php
																																	echo '</tr>';
																																}
																																
																																?>
                            
					
					
					
					</tbody>
				</table>
			</div>
		</div>
		<!-- /container -->
	</div>

</body>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->

<script src="js/nextfocus.js"></script>