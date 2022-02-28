<?php
 include 'globalfile.php';
$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];
$xItemCategoryNo=$GLOBALS ['xItemCategoryNo'];
$xItemGroupNo=$GLOBALS ['xItemGroupNo'];
$xItemSubGroupNo=$GLOBALS ['xItemSubGroupNo'];
$xStockPointNo=$GLOBALS ['xStockPointNo'];
?>

<style type="text/css">
table {
    border-collapse: collapse;
    font-size: 14px;
}

.sales_footer{font-size:30px;}


  hr{
    padding: 0px;
    margin: 0px;    
  }
</style>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="display:none">
<div class="panel panel-success">
<div class="panel-heading text-center">FILTER[GROUP]
<div class="btn-group pull-right">
          <input type="submit"  name="save"   class="btn btn-primary" value="VIEW" >
      </div>
</div>
<div class="panel-body">
<div class="form-group">


<div class="col-xs-3">
<label>From Date:</label>
<input type="date" class="form-control"  name="f_fromdate" value="<?php echo $xFromDate; ?>">
</div>

<div class="col-xs-3">
<label>To Date:</label>
<input type="date" class="form-control"  name="f_todate" value="<?php echo $xToDate; ?>">
</div>
<div class="col-xs-2">
<label>COMPLAINT STATUS</label>
   <select class="form-control"  value="" name="f_status">
	<option value="Completed" <?php if( $GLOBALS ['xStatus']=="Completed") echo 'selected="selected"'; ?>>Completed</option>
		<option value="Processing" <?php if( $GLOBALS ['xStatus']=="Processing") echo 'selected="selected"'; ?>>Processing</option>
	<option value="Cancelled" <?php if( $GLOBALS ['xStatus']=="Cancelled") echo 'selected="selected"'; ?>>Cancelled</option>
   </select>
</div>

</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
</div><!-- Panel !-->
</form>


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



<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div class="panel panel-success">

<div class="panel-body">
<div class="input-group"> <span class="input-group-addon">Filter</span>
  <input id="filter" type="text" class="form-control" placeholder="Type here...">
</div>
<div id="divToPrint" >
<table border="1">
<?php

$xQry='';
$xQryFilter='';

      $xStatus= "Completed";
      if($xItemCategoryNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and itemcategoryno=$xItemCategoryNo";
}

if($xItemGroupNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and itemgroupno=$xItemGroupNo";
}

if($xItemSubGroupNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and itemsubgroupno=$xItemSubGroupNo";
}
if($xStockPointNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and stockpointno=$xStockPointNo";
}

$xQry="SELECT *  from t_complaint where status='$xStatus'  and date>='$xFromDate' and date<='$xToDate' ";
$xQry.= $xQryFilter. ' ' . ";";
//echo $xQry;
$result2=mysql_query($xQry);

$rowCount = mysql_num_rows($result2);
echo '</br>'; 
?>
<b><h3 class="panel-title text-center"><?php 
echo " Complaint Completed Report From $xFromDate ";
echo " to  $xToDate ";
echo "-Printed  As On ". date("d/M/y h:i:sa"); ?></h3></b>

<?php
if($rowCount>0)
{
    ?>
    		 <thead>
        <tr>
           <th width="10%">S.NO</th>
           <th width="20%"> ITEMNAME </th>
           <th width="10%"> AMOUNT</th>
           <th width="5%"> COMP.NO</th>
           <th width="50%"> DESCRIPTION</th>
          <?php if($GLOBALS ['xViewStockPoint']  == 0){ ?>        <th> STOCKPOINT</th> <? } ?>
          <?php if($GLOBALS ['xViewComplaintBy']  == 0){ ?>             <th> COMPLAINTBY</th> <? } ?>
          <?php if($GLOBALS ['xViewContactPerson']  == 0){ ?>          <th> CONTACTPERSON</th> <? } ?>
          <?php if($GLOBALS ['xViewStatus']  == 0){ ?>          <th> STATUS</th> <? } ?>
          <?php if($GLOBALS ['xViewRemarks']  == 0){ ?>           <th> REMARKS</th> <? } ?>
          <?php if($GLOBALS ['xViewComplaintDate']  == 0){ ?>        <th> DATE</th> <? } ?>
          <?php if($GLOBALS ['xViewCompletedDate']  == 0){ ?>           <th> COMPLETED</th> <? } ?>
          <?php if($GLOBALS ['xViewBillNo']  == 0){ ?>          <th> BILLNO</th> <? } ?>
          <?php if($GLOBALS ['xViewBillDetails']  == 0){ ?>   <th> BILLDETAILS</th> <? } ?>
          <?php if($GLOBALS ['xViewPaymentStatus']  == 0){ ?>       <th> PAYMENTSTATUS</th> <? } ?>
          <!-- <th width="10%"> CREATED</th>
           <th width="10%"> UPDATED</th>
           <th colspan="2" width="10%">ACTIONS</td>!-->

        </tr>
      </thead>
      <?php
while ($row = mysql_fetch_array($result2)) {

?>



<?php

    $xSlNo+=1;
   echo '<tbody class=searchable>';
    echo '<td>' . $xSlNo  . '</td>';
    finditemname($row['itemno']);
?>
<td><a href="inv_hr001_a_oldcomplaints.php<?php echo '?itemno='.$row['itemno'] . '&xmode=edit'; ?>"> <?php echo  $GLOBALS['xItemName'] ?>
</a>  </td>
<?php
 findstockpointname($row['stockpointno']);
    echo '<td align=right>Rs ' . $row['amount']  .'</td>';
    echo '<td>' . $row['complaintno']  . '</td>';
    echo '<td>' . $row['complaintdescription']  . '</td>';

    if($GLOBALS ['xViewStockPoint']  == 0){echo '<td>' . $GLOBALS ['xStockPointShortName']  . '</td>';    }
    if($GLOBALS ['xViewComplaintBy']  == 0){echo '<td>' . $row['complaintby']  . '</td>';    }
    if($GLOBALS ['xViewContactPerson']  == 0){echo '<td>' .$row['contactperson']  . '</td>';    }
    if($GLOBALS ['xViewStatus']  == 0){echo '<td>' . $row['status']   . '</td>';    }
    if($GLOBALS ['xViewRemarks']  == 0){echo '<td>' . $row['remarks']  . '</td>';    }
    if($GLOBALS ['xViewComplaintDate']  == 0){echo '<td>' .date('d/M/Y',strtotime( $row['date'])) . '</td>';    }
    if($GLOBALS ['xViewCompletedDate']  == 0){echo '<td>' . date('d/M/Y',strtotime( $row['completeddate']))  . '</td>';    }
    if($GLOBALS ['xViewBillNo']  == 0){echo '<td>' . $row['billno']  . '</td>';    }
    if($GLOBALS ['xViewBillDetails']  == 0){echo '<td>' . $row['billdetails']  . '</td>';    }
    if($GLOBALS ['xViewPaymentStatus']  == 0){echo '<td>' . $row['paymentstatus']  . '</td>';    }
   // echo '<td>' . date('d/M/Y',strtotime( $row['createdason']))  . '</td>';
   // echo '<td>' . date('d/M/Y',strtotime( $row['updatedason']))  . '</td>';
//if($login_session=="admin")
//{
//?>

<?
}
echo '</tr>'; 
}
 else{
      echo "No Records Found ";
 }
 
 
?>	
</tbody>
    </table>	
	
</div>
</div>
</div>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
