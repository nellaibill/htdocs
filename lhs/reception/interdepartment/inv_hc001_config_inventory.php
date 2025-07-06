<?php
include('globalfile.php');
$xFromDate=date(' d/M/y', strtotime($GLOBALS ['xFromDate'])) ;
$xToDate=date(' d/M/y', strtotime($GLOBALS ['xToDate'])) ;
?>
<!--
<marquee  width=100% height=30 direction=right behavior=alternate scrollamount=10> <font size="4" color="GREEN">Maintanence Work in Progress</font></marquee>!-->
<script type="text/javascript">
$(document).ready(function () {

    (function ($) {

        $('#filter').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});
</script>


<form name="inv_hr001complaints" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<body  onload='document.inv_hr001complaints.f_itemgroupno.focus()'>
<div class="panel panel-success">
<div class="panel-heading text-center">FILTER DATA
<div class="btn-group pull-right">
          <input type="submit"  name="save"   class="btn btn-primary" value="SAVE" >
      </div>
</div>
<div class="panel-body">
<div class="form-group">

<div class="col-xs-3">
<label>StockPoint:</label>
<select class="form-control"  value="" name="f_stockpointno"  >
<?php
  $result = mysql_query("SELECT *  FROM m_stockpoint");
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
  $result = mysql_query("SELECT *  FROM m_itemcategory");
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
<select class="form-control"  value="" name="f_itemgroupno">
<?php
  $result = mysql_query("SELECT *  FROM m_itemgroup");
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
<select class="form-control"  value="" name="f_itemsubgroupno">
 <?php
  $result = mysql_query("SELECT *  FROM m_itemsubgroup");
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

<div class="col-xs-3">
<label>Choose Item</label>
	<select class="form-control"  value="" name="f_itemno">
<option value="0">All</option>
            <?php
            $result = mysql_query("SELECT *  FROM m_item where itemno!=0 and stockpointno!=31 and itemname!='' order by LENGTH(itemname),itemname");
            while($row = mysql_fetch_array($result))
             {
               findstockpointname($row['stockpointno']);
             ?>
            <option value = "<?php echo $row['itemno']; ?>" 
            <?php
                if ($row['itemno']== $GLOBALS ['xItemNo']){
                   echo 'selected="selected"';
                } 
            ?> >
            <?php echo $row['itemname']." [" . $GLOBALS ['xStockPointShortName'] ."]" ?> 
            </option>

             <?
              }
                echo "</select>";
             ?>
</div>
<div class="col-xs-3">
<label>Status</label>
<select  class="form-control" name="f_complaintpaymentstatus">
<option value="0" <?php if( $GLOBALS ['xComplaintPaymentStatus']=="0") echo 'selected="selected"'; ?>>ALL</option> 
<option value="PROCESSING" <?php if( $GLOBALS ['xComplaintPaymentStatus']=="PROCESSING") echo 'selected="selected"'; ?>>PROCESSING</option> 
<option value="COMPLETED" <?php if( $GLOBALS ['xComplaintPaymentStatus']=="COMPLETED") echo 'selected="selected"'; ?>>COMPLETED</option> 
<option value="CANCELLED" <?php if( $GLOBALS ['xComplaintPaymentStatus']=="CANCELLED") echo 'selected="selected"'; ?>>CANCELLED</option> 
</select>
</div>
</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
</div><!-- Panel !-->
</body>
</form>
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div class="panel panel-success">
<div class="panel-heading">
<b><h3 class="panel-title text-center">

<?php

$xQry='';
$xSlNo=0;
$xLoopCount=0;
$xQryFilter='';
 if (isSet($_POST['save'])) 
    {
      $xItemCategoryNo= $_POST['f_itemcategoryno'];
      $xItemGroupNo= $_POST['f_itemgroupno'];
      $xItemSubGroupNo= $_POST['f_itemsubgroupno'];
      $xStockPointNo= $_POST['f_stockpointno'];
      $xItemNo= $_POST['f_itemno'];
      $xComplaintPaymentStatus= $_POST['f_complaintpaymentstatus'];
      $xQry = "update config_inventory set categoryno=$xItemCategoryNo,groupno=$xItemGroupNo,subgroupno=$xItemSubGroupNo,stockpointno=$xStockPointNo,itemno=$xItemNo,complaintpaymentstatus='$xComplaintPaymentStatus'";
      mysql_query($xQry);
echo  "<script type='text/javascript'>";
echo "window.close();";
echo "</script>";
    }
?>
</div>
</div>
</div>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
