<?php
include 'globalfile.php';
fn_DataClear();
if (isset ( $_GET ['section2no'] ) && ! empty ( $_GET ['section2no'] )) {
	$no = $_GET ['section2no'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['section2no'] );
	}
	else if ($_GET ['xmode'] == 'delete'){
		$xQry = "DELETE FROM bill_suryatraders_section2 WHERE section2no= $no";
		mysql_query($xQry);
		header('Location: report_section2.php');
	}
}
 elseif (isset ( $_POST ['update'] )) {
    $xSection2No = $_POST ['f_section2No'];
	$xCategoryNo = $_POST ['f_itemcategoryno'];
	$xItemNo = $_POST ['f_itemno'];
	$xHsnCode = $_POST ['f_hsncode'];
	$xSizeNo = $_POST ['f_sizeno'];
	$xGsmNo = $_POST ['f_gsmno'];
	$xRmWt = $_POST ['f_rmwt'];
	$xQty = $_POST ['f_qty'];
	$xTotalWt = $_POST ['f_totalwt'];
	$xRate = $_POST ['f_rate'];
	$xAmount = $_POST ['f_amount'];
	$xDiscount = $_POST ['f_discount'];
	$xCgst = $_POST ['f_cgst'];
	$xSgst = $_POST ['f_sgst'];
	$xTotal = $_POST ['f_total'];
	$xTaxinWords = $_POST ['f_taxinwords'];
    $xQry = "update bill_suryatraders_section2  
			set categoryno='$xCategoryNo',
            itemno='$xItemNo',
            hsncode='$xHsnCode',
            sizeno=$xSizeNo,
            gsmno=$xGsmNo,
			rmwt='$xRmWt',
            qty=$xQty,
            totalwt='$xTotalWt',
            rate='$xRate',
            amount='$xAmount',
            discount=$xDiscount,
            cgst=$xCgst,
            sgst=$xSgst,
            total=$xTotal,
            taxinwords='$xTaxinWords'
            where section2no=$xSection2No
			" ;
		//	echo $xQry;
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
} 
function DataFetch($xsection2no) {
	$result = mysql_query ( "SELECT *  FROM bill_suryatraders_section2 where section2no=$xsection2no" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {	
		while ( $row = mysql_fetch_array ( $result ) ) {
            $GLOBALS ['section2no'] = $row ['section2no'];
			$GLOBALS ['salesbillno'] = $row ['salesbillno'];
			$GLOBALS ['categoryno'] = $row ['categoryno'];
			$GLOBALS ['itemno'] = $row ['itemno'];
			$GLOBALS ['hsncode'] = $row ['hsncode'];
			$GLOBALS ['sizeno'] = $row ['sizeno'];
			$GLOBALS ['gsmno'] = $row ['gsmno'];
			$GLOBALS ['rmwt'] = $row ['rmwt'];
			$GLOBALS ['qty'] = $row ['qty'];
            $GLOBALS ['totalwt'] = $row ['totalwt'];
			$GLOBALS ['rate'] = $row ['rate'];
		}
	}
}
function fn_DataClear() {
	$xQry = "";
	$xMsg = "";
            $GLOBALS ['section2no']  = '';
			$GLOBALS ['salesbillno']  = '';
			$GLOBALS ['categoryno']  = '';
			$GLOBALS ['itemno']  = '';
			$GLOBALS ['hsncode']  = '';
			$GLOBALS ['sizeno']  = '';
			$GLOBALS ['gsmno']  = '';
			$GLOBALS ['rmwt']  = '';
			$GLOBALS ['qty']  = '';
            $GLOBALS ['totalwt']  = '';
			$GLOBALS ['rate']  = '';
	GetMaxIdNo ();
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(sizeno)IS NULL OR max(sizeno)= ''
       THEN '1'
       ELSE max(sizeno)+1 END AS sizeno
FROM m_size";
	
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xSizeNo'] = $row ['sizeno'];
	}
}
?>
<!DOCTYPE body PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<body onload='document.sizeform.f_sizename.focus()'>
<link type="text/css" rel="stylesheet" href="css/style.css" />
<script type="text/javascript">
function sum() {
    var txtFirstNumberValue = document.getElementById('f_totalwt').value;
    var txtSecondNumberValue = document.getElementById('f_rate').value;
    var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
    if (!isNaN(result)) {
       document.getElementById('f_amount').value = result;
    }
}
function calculategst() {
	
    var xAmount = document.getElementById('f_amount').value;
    var xDiscount = document.getElementById('f_discount').value;
var xAmountMinusDiscount=xAmount-xDiscount;
    var xCgst = xAmountMinusDiscount*0.06;
   var xSgst = xAmountMinusDiscount*0.06;
   var xTotal = xAmountMinusDiscount+xCgst+xSgst;
 
       document.getElementById('f_cgst').value = xCgst;
       document.getElementById('f_sgst').value = xSgst;
       document.getElementById('f_total').value = xTotal.toFixed(2);
   
}
</script>
	<form class="form" name="sizeform"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		
		<!-- Panel Body !-->

		<div class="panel-body">

			<div class="panel panel-primary">

				<div class="panel-body">
                	<div class="col-xs-2" >
						<label>Section2No</label> <input type="text" class="form-control"
							name="f_section2No" readonly  value="<?php echo $GLOBALS ['section2no']; ?>">
					</div>
					<div class="col-xs-3">
						<label>Category:</label> <select class="form-control"
							name="f_itemcategoryno">
                            <?php
                            $result = mysql_query ( "SELECT *  FROM m_itemcategory  order by itemcategoryname" );
                            while ( $row = mysql_fetch_array ( $result ) ) {
	                            ?>
                            <option value="<?php echo $row['itemcategoryno']; ?>"
								                            <?php
	                            if ($row ['itemcategoryno'] == $GLOBALS ['categoryno']) {
		                            echo 'selected="selected"';
	                            }
	                            ?>>
                             <?php echo $row['itemcategoryname']; ?> 
                            </option>
                            <?php
                            }
                            ?>
                            </select>
					</div>

					<div class="col-xs-3">
						<label>Item:</label> <select class="form-control" name="f_itemno">
                        <?php if($GLOBALS ['itemno']=="Duplex Reel") {?>
                        <option value="Duplex Reel">Duplex Reel</option>
                        <?php } elseif($GLOBALS ['itemno']=="Duplex Sheet") 	 { ?>
						<option value="Duplex Sheet">Duplex Sheet</option>
						 <?php } elseif($GLOBALS ['itemno']=="Reel") 	 { ?>
						<option value="Reel">Reel</option>
						 <?php } else	 { ?>
						<option value="Sheet">Sheet</option>
                         <?php } ?>
						</select>
					</div>

					<div class="col-xs-2">
						<label>Hsn Code:</label> <select class="form-control" name="f_hsncode">
                            <?php
                            $result = mysql_query ( "SELECT *  FROM m_hsncode " );
                            while ( $row = mysql_fetch_array ( $result ) ) {
	                            ?>
         
                              <option value="<?php echo $row['hsncode']; ?>"
								                            <?php
	                            if ($row ['hsncode'] == $GLOBALS ['hsncode']) {
		                            echo 'selected="selected"';
	                            }
	                            ?>>
                             <?php echo $row['hsncode']; ?> 
                            </option>

                             <?php echo $row['hsncode']; ?> 
                            </option>
                            <?php
                            }
                            ?>
                            </select>
					</div>
					<div class="col-xs-2">
						<label>Size:</label> <select class="form-control" name="f_sizeno">
                            <?php
                            $result = mysql_query ( "SELECT *  FROM m_size order by sizename" );
                            while ( $row = mysql_fetch_array ( $result ) ) {
	                            ?>                         
                              <option value="<?php echo $row['sizeno']; ?>"
								                            <?php
	                            if ($row ['sizeno'] == $GLOBALS ['sizeno']) {
		                            echo 'selected="selected"';
	                            }
	                            ?>>
                             <?php echo $row['sizename']; ?> 
                            </option>
                            <?php
                            }
                            ?>
                            </select>
					</div>

					<div class="col-xs-2">
						<label>Gsm:</label> <select class="form-control" name="f_gsmno">
                            <?php
                            $result = mysql_query ( "SELECT *  FROM m_gsm order by gsmname" );
                            while ( $row = mysql_fetch_array ( $result ) ) {
	                            ?>
                                  <option value="<?php echo $row['gsmno']; ?>"
								                            <?php
	                            if ($row ['gsmno'] == $GLOBALS ['gsmno']) {
		                            echo 'selected="selected"';
	                            }
	                            ?>>
                             <?php echo $row['gsmname']; ?> 
                            </option>
                            <?php } ?>
                            </select>
					</div>

					<div class="col-xs-2" >
						<label>Rm Wt</label> <input type="text" class="form-control"
							name="f_rmwt" value="<?php echo $GLOBALS ['rmwt']; ?>">
					</div>

					<div class="col-xs-2">

						<label>Qty</label> <input type="text" class="form-control"
							name="f_qty" value="<?php echo $GLOBALS ['qty']; ?>">
					</div>
				
					<div class="col-xs-2">
						<label>Total Wt</label> <input type="text" class="form-control"
							name="f_totalwt" id="f_totalwt" value="<?php echo $GLOBALS ['totalwt']; ?>">
					</div>

					<div class="col-xs-2">

						<label>Rate</label> <input type="text" class="form-control"
							name="f_rate" id="f_rate" value="<?php echo $GLOBALS ['rate']; ?>" onkeyup="sum();">
					</div>
					
					<div class="col-xs-2" >
						<label>Amount</label> <input type="text" class="form-control"
							name="f_amount" id="f_amount" readonly>
					</div>

		            <div class="col-xs-2" >
						<label>Discount</label> <input type="text" class="form-control"
							name="f_discount" id="f_discount" value="0" onblur="calculategst();">
					</div>
					
							<div class="col-xs-2" >
						<label>CGST</label> <input type="text" class="form-control"
							name="f_cgst" id="f_cgst" readonly >
					</div>
					
							<div class="col-xs-2" >
						<label>SGST</label> <input type="text" class="form-control"
							name="f_sgst" id="f_sgst" readonly >
					</div>
					
							<div class="col-xs-2" >
						<label>Total</label> <input type="text" class="form-control"
							name="f_total" id="f_total" readonly >
					</div>
					
						<div class="col-xs-6" >
						<label>Tax in Words</label> <input type="text" class="form-control"
							name="f_taxinwords"   >
					</div>
				</div>
					<div class="panel-footer clearfix">
						<div class="pull-right">
                        <input type="submit" name="update" class="btn btn-primary"
								value="UPDATE" onclick="return validateForm()">
						</div>
					</div>
			</div>
	
					
		</div>
		<!-- Panel -Room Type Number Information Ended !-->


	</form>
    <!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint">
		<div class="panel panel-info">

			<!-- Default panel contents -->
			<div class="panel-heading  text-center">
				<h3 class="panel-title">VIEW SECTION2</h3>
			</div>
			<div class="input-group">
				<span class="input-group-addon">Filter</span> <input id="filter"
					type="text" class="form-control">
			</div>
			<table class="table">
				<thead>
					<tr>
					<th width="10%">Invoice  No</th>
						<th width="10%">Category</th>
						<th width="10%">Item</th>
						<th width="10%">HSnCode</th>
						<th width="10%">GsmNo</th>
						<th width="10%">SizeNo</th>
						<th width="10%">RmWt</th>
						<th width="10%">Qty</th>
                        <th width="10%">TotalWt</th>
                        <th width="10%">Rate</th>
                        <!--<th width="10%">Amt</th>
                        <th width="10%">Disc</th>
                        <th width="10%">Cgst</th>
                        <th width="10%">Sgst</th>!-->
                        <th width="10%">Total</th>
						<th width="5%" colspan="2">ACTIONS</th>				
					</tr>
				</thead>
				<tbody class="searchable">
					<tr>


    <?php
$xQry = '';
$xSlNo = 0;
$xTotalAmount = 0;
$xQry = "SELECT 
a1.invoiceno1,
a2.section2no,
a2.salesbillno,
a2.categoryno,
a2.itemno,
a2.hsncode,
a2.sizeno,
a2.gsmno,
a2.rmwt,
a2.qty,
a2.totalwt,
a2.rate,
a2.amount,
a2.discount,
a2.cgst,
a2.sgst,
a2.total,
a2.taxinwords
from bill_suryatraders_section1 a1,
bill_suryatraders_section2 a2  
where  a1.date>='2019-04-01'  and a1.salesbillno=a2.salesbillno order by a1.salesbillno desc limit 50";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	finditemcategoryname($row ['categoryno']);
    findgsmname($row ['gsmno']);
    findsizename($row ['sizeno']);
	echo '<td>' . $row ['invoiceno1']. '</td>';
	echo '<td>' . $GLOBALS ['xItemCategoryName']. '</td>';
	echo '<td>' . $row ['itemno']. '</td>';
	echo '<td>' . $row ['hsncode']. '</td>';
	echo '<td>' . $GLOBALS ['xGsmName']. '</td>';
    echo '<td>' . $GLOBALS ['xSizeName']. '</td>';
	echo '<td>' . $row ['rmwt']. '</td>';
    echo '<td>' . $row ['qty']. '</td>';
	echo '<td>' . $row ['totalwt']. '</td>';
    echo '<td>' . $row ['rate']. '</td>';
	/*echo '<td>' . $row ['amount']. '</td>';
	echo '<td>' . $row ['discount']. '</td>';
    echo '<td>' . $row ['cgst']. '</td>';
	echo '<td>' . $row ['sgst']. '</td>';*/
    echo '<td>' . $row ['total']. '</td>';
	?>
    <td><a
							href="report_section2.php<?php echo '?section2no='.$row['section2no']. '&xmode=edit';  ?>"
							onclick="return confirm_edit()"> <img src="images/edit.png"
								style="width: 30px; height: 30px; border: 0">
						</a></td>
						    <td><a
							href="report_section2.php<?php echo '?section2no='.$row['section2no']. '&xmode=delete';  ?>"
							onclick="return confirm_edit()"> <img src="images/delete.png"
								style="width: 30px; height: 30px; border: 0">
						</a></td>
				
<?php
	echo '</tr>';
}

?>		</tbody>
			</table>
		</div>
</div>

</body>
