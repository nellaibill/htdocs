<?php
include 'globalfile.php';
if ( isset( $_GET['supplierid'] ) && !empty( $_GET['supplierid'] ) )
{
  $no= $_GET['supplierid'];
  if($_GET['xmode']=='edit')
   {
    $GLOBALS ['xMode']='F';
    DataFetch ( $_GET['supplierid']);
   }
   else
   {
      $xQry = "DELETE FROM inv_supplier WHERE supplierid= $no";
      mysql_query ( $xQry ) or die ( mysql_error () );
      echo '<script type="text/javascript">swal("Good job!", "Deleted!", "success");</script>';
      header('Location: inv_hm001supplier.php'); 	
   }
}
elseif (isset ( $_POST ['save'] ))
{

	DataProcess ( "S");
}
elseif (isset ( $_POST ['update'] )) 
{
	DataProcess ( "U" );
}
else
 {
  fn_GetMaxIdNo();
 }

function fn_GetMaxIdNo() {
$xQry="SELECT  CASE WHEN max(supplierid)IS NULL OR max(supplierid)= '' THEN '1' ELSE max(supplierid)+1 END AS supplierid FROM inv_supplier";
	$result = mysql_query ($xQry) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xsupplierid'] = $row ['supplierid'];
                $GLOBALS ['xMobileNo']=0;
	}
}

function DataFetch($xsupplierid) {
    $result = mysql_query ( "SELECT *  FROM inv_supplier where supplierid=$xsupplierid" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {
                $GLOBALS ['xsupplierid'] = $row ['supplierid'];
 		$GLOBALS ['xSupplierName'] = $row ['suppliername'];
                $GLOBALS ['xSupplierAddress'] = $row ['supplieraddress'];
 		$GLOBALS ['xSupplierMobileNo'] = $row ['suppliermobileno'];
                $GLOBALS ['xSupplierEmailId'] = $row ['supplieremailid'];
 		$GLOBALS ['xSupplierTaxNo'] = $row ['suppliertaxno'];
                $GLOBALS ['xSupplierRegisterNo'] = $row ['supplierregisterno'];
 			}
	}
}

function DataProcess($mode) {
$xsupplierid= $_POST ['f_supplierid'];
$xSupplierName= strtoupper($_POST ['f_suppliername']);
$xSupplierAddress= $_POST ['f_supplieraddress'];
if(empty($_POST['f_suppliermobileno'])){
$xSupplierMobileNo= 0;
    }      
else $xSupplierMobileNo= $_POST ['f_suppliermobileno'];
$xSupplierEmailId= $_POST ['f_supplieremailid'];
$xSupplierTaxNo= $_POST ['f_suppliertaxno'];
$xSupplierRegisterNo= $_POST ['f_supplierregisterno'];

$xQry="";
$xMsg="";
if ($mode == 'S') 
{
$xQry = "INSERT INTO inv_supplier  VALUES ($xsupplierid,'$xSupplierName','$xSupplierAddress',$xSupplierMobileNo,'$xSupplierEmailId','$xSupplierTaxNo','$xSupplierRegisterNo')";
      echo '<script type="text/javascript">swal("Good job!", "Inserted!", "success");</script>';
} 
elseif ($mode == 'U')
{
$xQry = "UPDATE inv_supplier   SET suppliername='$xSupplierName',supplieraddress='$xSupplierAddress',suppliermobileno=$xSupplierMobileNo,supplieremailid='$xSupplierEmailId',suppliertaxno='$xSupplierTaxNo',supplierregisterno='$xSupplierRegisterNo' WHERE supplierid=$xsupplierid";
      echo '<script type="text/javascript">swal("Good job!", "Updated!", "success");</script>';
} 
$retval = mysql_query ( $xQry ) or die ( mysql_error () );
fn_GetMaxIdNo();
ShowAlert($xMsg);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>M-SUPPLIER</title>
</head>
<script type="text/javascript">
function validateForm() 
 {
 
 var xSupplierName= document.forms["inventorysupplierform"]["f_suppliername"].value;
 if (xSupplierName== null || xSupplierName== "") 
    {
        alert("Supplier-Name must be filled out");
        document.inventorysupplierform.f_suppliername.focus();
        return false;
    }
   

}
</script>
<body onload='document.inventorysupplierform.f_itemname.focus()'> 
<form class="form" name="inventorysupplierform" action="<?php echo $_SERVER['PHP_SELF']; ?>"method="post">
 <div class="panel panel-primary">
  <div class="panel-heading  text-center">
        <h3 class="panel-title">MASTER -SUPPLIER</h3>
        </div>
    </div>
</div>
</body>
  </div>
 <div class="panel-body">

    <div class="col-xs-2" >
<label>Supplier Id:</label>
<input type="text" class="form-control" " name="f_supplierid" value="<?php echo $GLOBALS ['xsupplierid']; ?>"readonly>
    </div>

<div class="col-xs-3">
<label>Supplier Name :</label>
<input type="text" class="form-control" name="f_suppliername" value="<?php echo $GLOBALS ['xSupplierName']; ?>">
</div>

<div class="col-xs-6">
<label>Address:</label>
<input type="text" class="form-control" name="f_supplieraddress" value="<?php echo $GLOBALS ['xSupplierAddress']; ?>">
</div>

<div class="col-xs-3">
<label>Mobile No:</label>
<input type="number" class="form-control" name="f_suppliermobileno" value="<?php echo $GLOBALS ['xSupplierMobileNo']; ?>">
</div>
<div class="col-xs-3">
<label>Email-Id:</label>
<input type="text" class="form-control" name="f_supplieremailid" value="<?php echo $GLOBALS ['xSupplierEmailId']; ?>">
</div>

<div class="col-xs-3">
<label>Tax-No:</label>
<input type="text" class="form-control" name="f_suppliertaxno" value="<?php echo $GLOBALS ['xSupplierTaxNo']; ?>">
</div>

<div class="col-xs-3">
<label>Register No :</label>
<input type="text" class="form-control" name="f_supplierregisterno" value="<?php echo $GLOBALS ['xSupplierRegisterNo']; ?>">
</div>
</div>

<div class="panel-footer clearfix">
<div class="pull-right">
          <? if ($GLOBALS ['xMode'] == "") {  ?> 
               <input type="submit"  name="save"   class="btn btn-primary" value="SAVE" id="save" onclick="return validateForm()"> 
           <? } else{ ?>
               <input type="submit"  name="update"   class="btn btn-primary" value="UPDATE" onclick="return validateForm()" > 
           <? }  ?>
        </div>
</div>


<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint" >
<div class="container">
<div class="panel panel-info">
  <!-- Default panel contents -->
<div class="panel-heading clearfix">
      <h3 class="panel-title pull-left" style="padding-top: 7.5px;">VIEW SUPPLIER</h3>
       <div class="btn-group pull-right">
         <a href="inv_hc001supplier.php" class="btn btn-default">CONFIG</a>
      </div>
</div>
<table class="table">
      <thead>
        <tr>
           <th>S.NO</th>
           <th> SUPPLIER NAME </th>
          <?php if($GLOBALS ['xViewAddress']  == 0){ ?>  <th> ADDRESS</th> <? } ?>
          <?php if($GLOBALS ['xViewMobileNo']  == 0){ ?>  <th> MOBILENO</th> <? } ?>
          <?php if($GLOBALS ['xViewEmailId']  == 0){ ?>  <th> EMAILID</th> <? } ?>
          <?php if($GLOBALS ['xViewTaxNo']  == 0){ ?>  <th> TAXNO</th> <? } ?>
          <?php if($GLOBALS ['xViewRegisterNo']  == 0){ ?>  <th> REGISTERNO</th> <? } ?>
           <th colspan="2" width="5%">ACTIONS</td>
        </tr>
      </thead>
      <tbody>

<?php
$xSlNo=0;
$xQry='';
$xQry="SELECT *  from inv_supplier order by  suppliername"; 
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    echo '<td>' . $xSlNo+=1 . '</td>';
    echo '<td>' . $row['suppliername']  . '</td>';
    if($GLOBALS ['xViewAddress']  == 0){echo '<td>' . $row['supplieraddress'] . '</td>';    }
    if($GLOBALS ['xViewMobileNo']  == 0){echo '<td>' . $row['suppliermobileno'] . '</td>';    }
    if($GLOBALS ['xViewEmailId']  == 0){echo '<td>' .  $row['supplieremailid']  . '</td>';    }
    if($GLOBALS ['xViewTaxNo']  == 0){echo '<td>' .  $row['suppliertaxno']   . '</td>';    }
    if($GLOBALS ['xViewRegisterNo']  == 0){echo '<td>' . $row['supplierregisterno']  . '</td>';    }
    
?>
<td><a href="inv_hm001supplier.php<?php echo '?supplierid='.$row['supplierid'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="inv_hm001supplier.php<?php echo '?supplierid='.$row['supplierid']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

<?
echo '</tr>'; 
}
  
?>	
</tbody>
    </table>	
</div>
  </div><!-- /container -->
</div>

<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->