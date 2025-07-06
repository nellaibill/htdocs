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



<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div class="panel panel-success">
<div class="panel-heading">
<b><h3 class="panel-title text-center"><?php 
echo " Complaint Report";
if($GLOBALS ['xViewRequiredDateFilter']==0)
{
echo " $xFromDate to $xToDate ";
}

echo "-Printed  As On ". date("d/M/y h:i:sa"); ?></h3></b>
 <div class="pull-right">
<a href="inv_hc001complaints.php" class="btn btn-primary">CONFIG</a> </div>
</div>
<div class="panel-body">
<div class="input-group"> <span class="input-group-addon">Filter</span>
  <input id="filter" type="text" class="form-control" placeholder="Type here...">
</div>
<div id="divToPrint" >
<table class="table table-bordered">
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
      header('Location: inv_hr001complaints.php');
    }
else
{
$xItemCategoryNo=$GLOBALS ['xItemCategoryNo'];
$xItemGroupNo=$GLOBALS ['xItemGroupNo'];
$xItemSubGroupNo=$GLOBALS ['xItemSubGroupNo'];
$xStockPointNo=$GLOBALS ['xStockPointNo'];
$xItemNo=$GLOBALS ['xItemNo'];
$xComplaintPaymentStatus=$GLOBALS ['xComplaintPaymentStatus'];
}

if($xComplaintPaymentStatus!='0')
{
$xQryFilter= $xQryFilter. ' ' . "and status='$xComplaintPaymentStatus'";
}
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
if($xItemNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and itemno=$xItemNo";
}


if($GLOBALS ['xViewRequiredDateFilter']==0)
{
$xQryFilter= $xQryFilter. ' ' . "and date >= '$xFromDate' AND date<= '$xToDate'";
}
$xQry="SELECT *  from t_complaint WHERE itemno>=0 "; 
$xQry.= $xQryFilter. ' ' . "order by  date desc;";
$result2=mysql_query($xQry);

$rowCount = mysql_num_rows($result2);
echo '</br>'; 

while ($row = mysql_fetch_array($result2)) {
if($xLoopCount==0)
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
}
    $xSlNo+=1;
    $xLoopCount+=1;
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

<td><a href="inv_ht001complaint.php<?php echo '?complaintno='.$row['complaintno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="inv_ht001complaint.php<?php echo '?complaintno='.$row['complaintno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

<?
//}
echo '</tr>'; 
}
  
?>	
</tbody>
    </table>	
	
</div>
</div>
</div>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
