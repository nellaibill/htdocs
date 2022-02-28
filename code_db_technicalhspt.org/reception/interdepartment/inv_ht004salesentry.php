<?php
	include '../../session.php';
        include 'globalfunctions.php';
	$xCurrentQty=0;
	$GLOBALS ['xDate']=$GLOBALS ['xCurrentDate'];
        $xDate=$GLOBALS ['xCurrentDate'];
        $xTempSalesQty=$GLOBALS ['xTempSalesQty'];
        if ( isset( $_GET['txno'] ) && !empty( $_GET['txno'] ) )
	{
	  $no= $_GET['txno'];
	  if($_GET['xmode']=='edit')
	   {
		$GLOBALS ['xMode']='F';
		DataFetch ( $_GET['txno']);
	   }
	   else
	   {

		  $xQry = "DELETE FROM inv_tempsalesentry WHERE txno= $no";
		  mysql_query ( $xQry );
                  fn_TempSalesQty(0);
		  UpdateStockValues(-$_GET['passqty'],$_GET['passitemno'],'');
		  header('Location: inv_ht004salesentry.php'); 	
	   }
	}
	else
	 {
	  GetMaxIdNo ();
	 }
	if (isset ( $_POST ['add'] ))
	{

		DataProcess ( "S");
	}
       elseif (isset ( $_POST ['editsalesinvoiceno'] )) 
	{
	$xSearchSalesInvoiceNo=$_POST['f_searchsalesinvoiceno'];
           /* Check Sales Entries  On the Temporary Table*/

                $result = mysql_query ( "SELECT *  FROM inv_tempsalesentry" ) or die ( mysql_error () );
		$count = mysql_num_rows($result);
		if($count>0)
                 {
		while ( $row = mysql_fetch_array ( $result ) ) 
                    {
                        echo '<script language="javascript">';
                        echo 'alert("Please Delete the Current Sales Entries")';
                        echo '</script>';
	            }
		}
              /* Check Sales Entries not in the Temporary Table proceed sales entrytable passed salesinvoiceno*/
                else 
                 {
/* -----  User Edit Sales Entry for the Current Day Only---  */

             if($login_session=="admin")
               {
                 $xQry="SELECT *  FROM inv_salesentry where salesinvoiceno=$xSearchSalesInvoiceNo" ;
               }
            else
             {
                 $xQry="SELECT *  FROM inv_salesentry where salesinvoiceno=$xSearchSalesInvoiceNo and date='$xDate'" ;
             }

/* -----  User Edit Sales Entry for the Current Day Only Ended ---  */
                 $result = mysql_query ( $xQry) or die ( mysql_error () );
		$count = mysql_num_rows($result);
		if($count>0)
                 {
		while ( $row = mysql_fetch_array ( $result ) ) 
                    {
                       /* To Assign Values For Stock Point and Employee because it get changed on the edit*/

                        $xStockPointNo= $row ['usagestockpointno'];
                        $xEmpNo= $row ['empno'];
                        mysql_query ( "update  config set employeeno=$xEmpNo" ) or die ( mysql_error () );
                        mysql_query ( "update  config_inventory set stockpointno=$xStockPointNo" ) or die ( mysql_error () );
	            }
                    mysql_query ("LOCK TABLES inv_tempsalesentry WRITE, inv_salesentry WRITE")or die ( mysql_error () );
	            mysql_query ("INSERT INTO inv_tempsalesentry(txno,salesinvoiceno,date,itemno,qty,
                    usagestockdetails,createdason,updatedason)                                               
                          SELECT txno,salesinvoiceno,date,itemno,qty,usagestockdetails,createdason,updatedason  
                          FROM inv_salesentry where salesinvoiceno=$xSearchSalesInvoiceNo")or die ( mysql_error () );
	            mysql_query ("DELETE FROM inv_salesentry where salesinvoiceno=$xSearchSalesInvoiceNo")or die ( mysql_error () );
	            mysql_query ("UNLOCK TABLES")or die ( mysql_error () );
                    GetMaxIdNo();
		 }  
               else
                  {
                        echo '<script language="javascript">';
                        echo 'alert("Entries Not Found-Please Contact Administrator")';
                        echo '</script>';

                  }

                  
                 }
	 
	}
       function GetMaxIdNo() {
	$xQry="SELECT  CASE WHEN max(salesinvoiceno)IS NULL OR max(salesinvoiceno)= '' 
		   THEN '1' 
		   ELSE max(salesinvoiceno)+1 END AS salesinvoiceno
	FROM inv_salesentry";

		$result = mysql_query ( $xQry ) or die ( mysql_error () );
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xSalesInvoiceNo'] = $row ['salesinvoiceno'];
		}
            GetMaxTxNo();
	}
 
        function GetMaxTxNo() 
           {
                 $xQry="SELECT  CASE WHEN max(txno)IS NULL OR max(txno)= '' 
                        THEN '1' ELSE max(txno)+1 END AS txno FROM inv_tempsalesentry";
        $result = mysql_query ( $xQry ) or die ( mysql_error () );
	           while ( $row = mysql_fetch_array ( $result ) ) 
                      {
		          $GLOBALS ['xTxNo'] = $row ['txno'];
	              }
            }
      function fn_TempSalesCount()
             {
                $result = mysql_query ( "SELECT *  FROM inv_tempsalesentry" )
                            or die (mysql_error () );
		$GLOBALS ['xTempSalesCount'] = mysql_num_rows($result);
		
             }


	function DataFetch($xTxNo) 
             {
                $xQry="SELECT *  FROM inv_tempsalesentry where txno=$xTxNo";
		$result = mysql_query ($xQry ) or die ( mysql_error () );
		$count = mysql_num_rows($result);
		if($count>0)
                {
		while ( $row = mysql_fetch_array ( $result ) ) 
                  {
	            $GLOBALS ['xTxNo'] = $row ['txno'];
	            $GLOBALS ['xSalesInvoiceNo'] = $row ['salesinvoiceno'];
	            $GLOBALS ['xQty'] = $row ['qty'];
	            $GLOBALS ['xItemNo'] = $row ['itemno'];
	            $GLOBALS ['xDate'] = $row ['date'];
	            $GLOBALS ['xUsageStockDetails'] = $row ['usagestockdetails'];
                    fn_TempSalesQty($row ['qty']);
		    $xQry = "DELETE FROM inv_tempsalesentry WHERE txno=$xTxNo";
                    mysql_query    ( $xQry )or die ( mysql_error () );
                    fn_TempSalesQty(0);
                    UpdateStockValues(-$row ['qty'],$row ['itemno'],'');
                  }
		}
	   }
	function finditemqty($xNo)
	{
	  $result = mysql_query ( "SELECT *  FROM inv_stockentry where itemno=$xNo" ) or die ( mysql_error () );
	  while ( $row = mysql_fetch_array ( $result ) ) 
	   {
		 $GLOBALS ['xAvailableQty'] = $row ['stock'];
	   }
	}
	function DataProcess($mode) {
        $xTxNo= $_POST ['f_txno'];
	$xSalesInvoiceNo=$_POST['f_salesinvoiceno'];
	$xDate=$_POST['f_date'];
	$xItemNo=$_POST['f_itemno'];
	$xQty=$_POST['f_qty'];
	$xUsageDetails=$_POST['f_usagedetails'];
	$xCreatedDate=$GLOBALS ['xCurrentDateTime'];
	$xUpdatedDate=$GLOBALS ['xCurrentDateTime'];
	$xQry="";
	$xMsg="";
	if ($mode == 'S') 
	{
	finditemqty($xItemNo);
	if($xQty<=$GLOBALS['xAvailableQty'])
	 { 
           $xQry = "INSERT INTO inv_tempsalesentry 
               (txno,salesinvoiceno,date,itemno,qty,usagestockdetails,createdason,updatedason)
                VALUES ($xTxNo,$xSalesInvoiceNo,'$xDate',$xItemNo,$xQty,
                                      '$xUsageDetails','$xCreatedDate','$xUpdatedDate')";
			$xMsg="Inserted";
               $retval = mysql_query ( $xQry ) or die ( mysql_error () );
	      if (! $retval) 
	       {
	     die ( 'Could not enter data: ' . mysql_error () );
	       }
              else 
               {
                 UpdateStockValues($xQty,$xItemNo,'');
                 fn_TempSalesQty(0);
               }
	 }
	else
	  {
		echo "Please Enter Low Quantity";
	  }
	} 
	elseif ($mode == 'U')
	{


                  $xQry = "INSERT INTO inv_tempsalesentry 
                       (txno,salesinvoiceno,date,itemno,qty,usagestockdetails,createdason,updatedason)
                          VALUES ($xTxNo,$xSalesInvoiceNo,'$xDate',$xItemNo,$xQty,
                                      '$xUsageDetails','$xCreatedDate','$xUpdatedDate')";
			$xMsg="Inserted";
               $retval = mysql_query ( $xQry ) or die ( mysql_error () );
	      if (! $retval) 
	       {
	     die ( 'Could not enter data: ' . mysql_error () );
	       }
              else 
               {
                 UpdateStockValues($xQty,$xItemNo,'');
                 fn_TempSalesQty(0);
               }
	}
	
	GetMaxIdNo();
	ShowAlert($xMsg);
	}

        function fn_TempSalesQty($xTempSalesQty)
          {
             $xQry="update config_sales set tempsalesqty=$xTempSalesQty";
             mysql_query ($xQry) or die ( mysql_error () );
          }

	function UpdateStockValues($xCurrentQty,$xCurrentItemNo,$mode)
	 {

            if ($mode== "") 
                   {   
		    $xTempSalesQty=0;
                    $xQry="update inv_stockentry set stock=stock-($xCurrentQty)+$xTempSalesQty where itemno=$xCurrentItemNo";
	            mysql_query ( $xQry );
                    } 
              else
                { 
                $xTempSalesQty=$GLOBALS ['xTempSalesQty']; 
                $xQry="update inv_stockentry set stock=stock-($xCurrentQty)+$xTempSalesQty where itemno=$xCurrentItemNo";
	        mysql_query ( $xQry );
                }  
         
          fn_TempSalesQty(0);
	 }
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	<meta charset="UTF-8">
	<title>SALES-ENTRY</title>
	</head>
	<script type="text/javascript">
	function validateForm() 
	 {
	 var xItemNo= document.forms["salesentryform"]["f_itemno"].value;
	 var xQty= document.forms["salesentryform"]["f_qty"].value;
	  if (xItemNo== "0") 
	   {
		alert("Please Choose an Item");
			document.salesentryform.f_itemno.focus();
		return false;
	   }


	  if (xQty== "") 
	   {
		alert("Enter Qty");
			document.salesentryform.f_qty.focus();
		return false;
	   }

	}

       function SearchValidateForm() 
	 {
	 var xSearchSalesInvoiceNo= document.forms["salesentryform"]["f_searchsalesinvoiceno"].value;
	  if (xSearchSalesInvoiceNo== "") 
	   {
		alert("Please Enter Invoice No");
			document.salesentryform.f_searchsalesinvoiceno.focus();
		return false;
	   }

	}

	</script>

	<body onload='document.salesentryform.f_itemno.focus()'> 
<style>
hr {
height: 1px;
color: #123455;
background-color: #123455;
border: none;
}
</style>
	<form class="form" name="salesentryform" action="<?php echo $_SERVER['PHP_SELF']; ?>"method="post" >
	 <div class="panel panel-primary">
	  <div class="panel-heading  text-center">
			<h3 class="panel-title">SALES-ENTRY</h3>
	  </div>
	 <div class="panel-body">

<div class="col-xs-1">
<label>Tx.No :</label>
<input type="text" class="form-control"   name="f_txno" value="<?php echo $GLOBALS ['xTxNo']; ?>" readonly>
</div>

	<div class="col-xs-1">
	<label>InvNo:</label>
	<input type="text" class="form-control" name="f_salesinvoiceno" value="<?php echo $GLOBALS ['xSalesInvoiceNo']; ?>" readonly>
	</div>
	<div class="col-xs-3">
	<label>Date:</label>
	<?php
	if ($login_session == "admin") {
	?>
	<input type="date" class="form-control" id="txtDate" name="f_date"
								value="<?php echo $GLOBALS ['xDate'];?>" placeholder="">
	<?php
	} else {
	?>
	<input type="date" class="form-control" id="txtDate" name="f_date"
								value="<?php echo $GLOBALS ['xDate'];?>" placeholder="" readonly>
	<?php
	}
	?>
	</div>
</br></br></br><hr>
	<div class="col-xs-4">
	<label>Item Name:</label>
<select class="form-control"  value="" name="f_itemno" >
<option value="0">Choose Item</option>
<?php
 $result = mysql_query("SELECT *  FROM m_item as i,inv_stockentry as se  where i.itemno=se.itemno and i.stockpointno=31 order by i.itemname");
  while($row = mysql_fetch_array($result))
   {
     ?>
    <option value = "<?php echo $row['itemno']; ?>" 
     <?php
      if ($row['itemno']== $GLOBALS ['xItemNo']){echo 'selected="selected"';} 
    ?> >
     <?php echo $row['itemname']. " - " .$row['stock'] ?> 
    </option>
    <? } 
?>
</select>

	</div>


	<div class="col-xs-2">
	<label>Qty:</label>
	<input type="number" class="form-control" name="f_qty" value="<?php echo $GLOBALS ['xQty']; ?>" style="text-align:right;" onchange="validateForm()">
	</div>


	<div class="col-xs-4">
	<label>Usage Details:</label>
	<input type="text" class="form-control" name="f_usagedetails" value="<?php echo $GLOBALS ['xUsageStockDetails']; ?>">
	</div>


	</div>

	<div class="panel-footer clearfix">
			<div class="pull-right">
			<input type="submit"  name="add"   class="btn btn-primary" value="ADD" id="save" onclick="return validateForm()"> 
</div>
	</div>
		

</div></div></br>

	<div class="col-xs-3">
	<input type="text" class="form-control"  name="f_searchsalesinvoiceno" placeholder="Sales Invoice No">
	</div>

	<div class="col-xs-2">
	<input type="submit"  name="editsalesinvoiceno"   class="btn btn-primary" value="Load Invoice No" id="save" onclick="return SearchValidateForm()">
	</div>


<?php
fn_TempSalesCount();
$xCount =$GLOBALS ['xTempSalesCount'];
if($xCount>0)
{
?>
	
	<div id="divToPrint" >
	  <div class="container">
	<table class="table table-hover" border="1" >
		  <thead>
			<tr>
                           <th width="15%">S.NO</th>
			   <th width="65%">ITEMNAME</th>
			   <th width="15%">QTY</th>
			   <th colspan="2" width="5%">ACTIONS</td>
			  </tr>
		  </thead>
		  <tbody>

	<?php
        $xSlNo=0;
	$xQry="SELECT *  from inv_tempsalesentry;"; 
	$result2=mysql_query($xQry);
	while ($row = mysql_fetch_array($result2)) {
                $xSlNo+=1;
		echo '<tr>';
		finditemname($row['itemno']);
                echo '<td>' . $xSlNo  . '</td>';
		echo '<td>' . $GLOBALS ['xItemName'] . '</td>';
		echo '<td>' . $row['qty']  . '</td>';
	?>
	<td><a href="inv_ht004salesentry.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
	  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
	</a>
	</td>
	<td><a href="inv_ht004salesentry.php<?php echo '?txno='.$row['txno']. '&xmode=delete &passqty='.$row['qty']. ' &passitemno='.$row['itemno']  ?>"  onclick="return confirm_delete()">
	  <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
	</a>
	</td>

	<?
	echo '</tr>'; 
	}

	?>	
	</tbody>
		</table>	
	  </div><!-- /container -->
	</div>
	<div class="panel-footer clearfix">
	   <div class="pull-right">
                                   <a href="inv_ht004_c_salescheckout.php"  class="btn btn-primary">SAVE</a> 
           </div>
	</div>

	</form>
<?php
}
?>
