<?php
include 'globalfile.php';
if ( isset( $_GET['itemno'] ) && !empty( $_GET['itemno'] ) )
{
  $no= $_GET['itemno'];
  if($_GET['xmode']=='edit')
   {
    $GLOBALS ['xMode']='F';
    DataFetch ( $_GET['itemno']);
   }
   else
   {
      $xQry = "DELETE FROM m_item WHERE itemno= $no";
      $result = mysql_query ( $xQry );
      if (!$result) {die('This Item is Referring to Some Where Else');}
      header('Location: inv_hr002item.php');
   }
}
else
 {
  GetMaxIdNo ();
 }
$GLOBALS ['xCurrentDate']=date('Y-m-d H:i:s');

if (isset ( $_POST ['save'] ))
{

	DataProcess ( "S");
}
elseif (isset ( $_POST ['update'] )) 
{
	DataProcess ( "U" );
}


function GetMaxIdNo() {
$sql="SELECT  CASE WHEN max(itemno)IS NULL OR max(itemno)= '' 
       THEN '1' 
       ELSE max(itemno)+1 END AS itemno
FROM m_item";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xItemNo'] = $row ['itemno'];
	}
}

function DataFetch($xItemNo) {
    $result = mysql_query ( "SELECT *  FROM m_item where itemno=$xItemNo" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {

	        $GLOBALS ['xItemNo'] = $row ['itemno'];
	        $GLOBALS ['xStockPointNo'] = $row ['stockpointno'];
                $GLOBALS ['xItemCategoryNo']= $row ['itemcategoryno'];
                $GLOBALS ['xItemGroupNo']= $row ['itemgroupno'];
                $GLOBALS ['xItemSubGroupNo']= $row ['itemsubgroupno'];
 		$GLOBALS ['xItemName'] = $row ['itemname'];
	        $GLOBALS ['xBrandName'] = $row ['brandname'];
	        $GLOBALS ['xSerialNo'] = $row ['serialno'];
 		$GLOBALS ['xModelNo'] = $row ['modelno'];
 		$GLOBALS ['xFunctionOfWorks'] = $row ['functionofworks'];
 		$GLOBALS ['xAccessories'] = $row ['accessories'];
 		$GLOBALS ['xConditions'] = $row ['conditions'];
 		$GLOBALS ['xRemarks'] = $row ['remarks'];
 		$GLOBALS ['xAmcRequired'] = $row ['amcrequired'];
	}
	}
}

function DataProcess($mode) {
$xItemNo= $_POST ['f_itemno'];
$xStockPointNo= $_POST ['f_stockpointno'];
$xItemCategoryNo= $_POST ['f_itemcategoryno'];
$xItemGroupNo= $_POST ['f_itemgroupno'];
$xItemSubGroupNo= $_POST ['f_itemsubgroupno'];
$xItemName= strtoupper($_POST ['f_itemname']);
$xBrandName= $_POST ['f_brandname'];
$xSerialNo= $_POST ['f_serialno'];
$xModelNo= $_POST ['f_modelno'];
$xFunctionOfWorks= $_POST ['f_functionofworks'];
$xAccessories= $_POST ['f_accessories'];
$xConditions= $_POST ['f_conditions'];
$xRemarks= $_POST ['f_remarks'];
$xAmcRequired=$_POST['f_amc'];
$xQry="";
$xMsg="";
if ($mode == 'S') 
{
$xQry = "INSERT INTO m_item  VALUES ($xItemNo,$xStockPointNo,$xItemCategoryNo,$xItemGroupNo,$xItemSubGroupNo,'$xItemName','$xBrandName','$xSerialNo','$xModelNo','$xFunctionOfWorks','$xAccessories','$xConditions','$xRemarks','$xAmcRequired')";
echo '<script type="text/javascript">swal("Good job!", "Inserted!", "success");</script>';
} 
elseif ($mode == 'U')
{
$xQry = "UPDATE m_item   SET stockpointno=$xStockPointNo,itemcategoryno=$xItemCategoryNo,itemgroupno=$xItemGroupNo,itemsubgroupno=$xItemSubGroupNo,itemname='$xItemName',brandname='$xBrandName',serialno='$xSerialNo',modelno='$xModelNo',functionofworks='$xFunctionOfWorks',accessories='$xAccessories',conditions='$xConditions',remarks='$xRemarks',amcrequired='$xAmcRequired' WHERE itemno=$xItemNo";
$xMsg="Updated";
echo '<script type="text/javascript">swal("Good job!", "Updated!", "success");</script>';
      header('Location: inv_hr002item.php');
}
$retval = mysql_query ( $xQry ) or die ( mysql_error () );
if (! $retval) 
{
die ( 'Could not enter data: ' . mysql_error () );
}

GetMaxIdNo();
ShowAlert($xMsg);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Item </title>
</head>
<!--<link rel="stylesheet" href="../css/table.css">!-->

<script type="text/javascript" src="../js/table.js"></script>
<script type="text/javascript">
function validateForm() 
 {
 
/* var xItemName= document.forms["itemform"]["f_itemname"].value;
 var xBrandName= document.forms["itemform"]["f_brandname"].value;
 if (xItemName== null || xItemName== "") 
    {
        alert("Item Name must be filled out");
        document.itemform.f_itemname.focus();
        return false;
    }
  if (xBrandName== null || xBrandName== "") 
    {
        alert("Brand Name must be filled out");
        document.itemform.f_brandname.focus();
        return false;
    }  
*/
}
</script>
<body onload='document.itemform.f_itemname.focus()'> 
<form class="form" name="itemform" action="<?php echo $_SERVER['PHP_SELF']; ?>"method="post">
 <div class="panel panel-primary">
  <div class="panel-heading  text-center">
        <h3 class="panel-title">MASTER -ITEM </h3>
  </div>
 <div class="panel-body">
    <div class="col-xs-2" style="display: none;">
	<input type="text" class="form-control" id="f_itemno" name="f_itemno" value="<?php echo $GLOBALS ['xItemNo']; ?>"readonly>
    </div>
<div class="col-xs-3">
<label>StockPoint:</label>
<select class="form-control"  value="" name="f_stockpointno"  >
<?php
  $result = mysql_query("SELECT *  FROM m_stockpoint order by stockpointname");
  while($row = mysql_fetch_array($result))
   {?>
    <option value = "<?php echo $row['stockpointno']; ?>" 
     <?php
      if ($row['stockpointno']== $GLOBALS ['xStockPointNo']){echo 'selected="selected"';} 
    ?> >
     <?php echo $row['stockpointname']; ?> 
    </option>
    <? } echo "</select>";
             ?>
</div>


<div class="col-xs-3">
<label>Category:</label>
<select class="form-control"  value="" name="f_itemcategoryno"  >
<?php
  $result = mysql_query("SELECT *  FROM m_itemcategory order by itemcategoryname");
  while($row = mysql_fetch_array($result))
   {?>
    <option value = "<?php echo $row['itemcategoryno']; ?>" 
     <?php
      if ($row['itemcategoryno']== $GLOBALS ['xItemCategoryNo']){echo 'selected="selected"';} 
    ?> >
     <?php echo $row['itemcategoryname']; ?> 
    </option>
    <? } echo "</select>";
             ?>
</div>


<div class="col-xs-3">
<label>Group:</label>
<select class="form-control"  value="" name="f_itemgroupno"  >
<?php
  $result = mysql_query("SELECT *  FROM m_itemgroup order by itemgroupname");
  while($row = mysql_fetch_array($result))
   {?>
    <option value = "<?php echo $row['itemgroupno']; ?>" 
     <?php
      if ($row['itemgroupno']== $GLOBALS ['xItemGroupNo']){echo 'selected="selected"';} 
    ?> >
     <?php echo $row['itemgroupname']; ?> 
    </option>
    <? } echo "</select>";
             ?>
</div>

<div class="col-xs-3">
<label>Sub-Group:</label>
<select class="form-control"  value="" name="f_itemsubgroupno"  >
<?php
  $result = mysql_query("SELECT *  FROM m_itemsubgroup order by itemsubgroupname");
  while($row = mysql_fetch_array($result))
   {?>
    <option value = "<?php echo $row['itemsubgroupno']; ?>" 
     <?php
      if ($row['itemsubgroupno']== $GLOBALS ['xItemSubGroupNo']){echo 'selected="selected"';} 
    ?> >
     <?php echo $row['itemsubgroupname']; ?> 
    </option>
    <? } echo "</select>";
             ?>
</div>

</br></br>
<div class="col-xs-3">
<label>ItemName:</label>
	<input type="text" class="form-control"  name="f_itemname" value="<?php echo $GLOBALS ['xItemName']; ?>" >
</div>
<div class="col-xs-3">
<label>BrandName:</label>
<input type="text" class="form-control"  name="f_brandname" value="<?php echo $GLOBALS ['xBrandName']; ?>" >
</div> 

<div class="col-xs-3">
<label>Serial No:</label>
<input type="text" class="form-control"  name="f_serialno" value="<?php echo $GLOBALS ['xSerialNo']; ?>" >
</div>

<div class="col-xs-3">
<label>Model No:</label>
<input type="text" class="form-control"  name="f_modelno" value="<?php echo $GLOBALS ['xModelNo']; ?>" >
</div>

<div class="col-xs-3">
<label>Amc Required:</label>
<input type="radio" name="f_amc" value="Yes" <?php if($GLOBALS ['xAmcRequired']=="Yes"){ echo "checked";}?>/>Yes
<input type="radio" name="f_amc" value="No" <?php if($GLOBALS ['xAmcRequired']=="No"){ echo "checked";}?>/>No
 
</div>
</br></br>

<div class="col-xs-3">
<label>Function Of Works </label>
<textarea class="form-control" rows="3" cols="15" name="f_functionofworks" style="float:right"><?php echo $GLOBALS ['xFunctionOfWorks']; ?></textarea>
</div>

<div class="col-xs-3">
<label>Accessories</label>
<textarea class="form-control" rows="3" cols="15" name="f_accessories" style="float:right"><?php echo $GLOBALS ['xAccessories']; ?></textarea>
</div>

<div class="col-xs-3">
<label>Conditions</label>
<textarea class="form-control" rows="3" cols="15" name="f_conditions" style="float:right"><?php echo $GLOBALS ['xConditions']; ?></textarea>
</div>

<div class="col-xs-3">
<label>Remarks </label>
<textarea class="form-control" rows="3" cols="15" name="f_remarks" style="float:right"><?php echo $GLOBALS ['xRemarks']; ?></textarea>
</div>

</div><!-- PANEL BODY !-->
<div class="panel-footer clearfix">
        <div class="pull-right">
          <? if ($GLOBALS ['xMode'] == "") {  ?> 
               <input type="submit"  name="save"   class="btn btn-primary" value="SAVE" id="save" onclick="return validateForm()"> 
           <? } else{ ?>
               <input type="submit"  name="update"   class="btn btn-primary" value="UPDATE" onclick="return validateForm()" > 
           <? }  ?>
        </div>
</div>

</div><!-- PANEL !-->
</form>
</body>
</html>