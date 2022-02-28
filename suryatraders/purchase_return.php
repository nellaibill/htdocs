<?php
include 'config.php';
include 'menu.php';
if(isset($_POST['btn_purchase_return_save']))
{
$xBill_No= $_POST['f_bill_no'];
$xBill_Date= $_POST['f_bill_date'];
$xKgs= $_POST['f_kgs'];
$xUsed_Materials= $_POST['f_used_materials'];
$xReturn_Materials= $_POST['f_return_materials'];
$xQry="update purchase_return 
set bill_no='$xBill_No',
bill_date='$xBill_Date',kgs='$xKgs',
used_materials='$xUsed_Materials',
return_materials='$xReturn_Materials' where id=1";
 //header ( 'Location: purchase_return.php' );
	//echo $xQry;
mysql_query($xQry);
}
?>
<html >
<head>
  

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
</head>
<body>
            <div class="panel panel-primary">
               <div class="panel-heading text-center"> PURCHASE RETURN
                </div> 

<div class="container">
<form class="form" action="purchase_return.php" method="post">

  <div class="row" >
	<br>
    <div class="col-sm-5" >
      <label>Bill no.</label>
      <input type="text" class="form-control" name="f_bill_no">
    </div>
	</div>
	<div class="row" >
	<br>
	<div class="col-xs-5">
						<label>Bill Date</label>
     <input type="date" class="form-control" name="f_bill_date">

	</div>
	</div>
	<div class="row" >
	<br>
	<div class="col-xs-5">
						<label>Kgs.</label>
     <input type="text" class="form-control" name="f_kgs">

	</div>
    </div>
	<div class="row" >
	<br>
	<div class="col-xs-5">
						<label>Used Materials</label>
     <input type="text" class="form-control" name="f_used_materials">

	</div>
    </div>
	<div class="row" >
	<br>
	<div class="col-xs-5">
						<label>Return Materials</label>
     <input type="text" class="form-control" name="f_return_materials">
	 <br>

	</div>
    </div>
	<div class="panel-footer clearfix">
				<div class="pull-right">
	 
		   <input type="submit" class="btn btn-primary"
						name="btn_purchase_return_save" value="UPDATE"
				accesskey="s">

	</div>
			</div>
	</form>
	</div>
	</div>
<div id="divToPrint">
	<div class="container">
		<div class="panel panel-info">

			<!-- Default panel contents -->
			<div class="panel-heading  text-center">
				<h3 class="panel-title">VIEW PURCHASE RETURN </h3>
			</div>
			
			<table class="table">
				<thead>
					<tr>
						<th width="10%">Bill NO</th>
						<th width="10%">Bill Date</th>
						<th width="10%">Kgs.</th>
						<th width="10%">Used Materials</th>
						<th width="10%">Return Materials</th>
					</tr>
				</thead>
				<tbody>
	

<?php

$xQry = "SELECT *  from purchase_return";
$result2 = mysql_query ( $xQry );
while ( $row = mysql_fetch_array ( $result2 ) ) {
echo '<tr>';
	echo '<td>' . $row ['bill_no'] . '</td>';
	echo '<td>' . $row ['bill_date'] . '</td>';
	echo '<td>' . $row ['kgs'] . '</td>';
	echo '<td>' . $row ['used_materials'] . '</td>';
	echo '<td>' . $row ['return_materials'] . '</td>';

	echo '</tr>';
}


?>		</tbody>
			</table>
		</div>
<a href="purchase_return_bill.php">PURCHASE RETURN BILL</a>
	</div>
</div>

	</body>