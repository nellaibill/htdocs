<?php
include('globalfile.php');
$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];
?>

<!--             ----------------------- REPORT GOES HERE  ------------------------ 
<div class="panel panel-success">
<div class="panel-heading">
<b><h3 class="panel-title text-center"><?php echo "View Complaints  -Printed  As On ". date("d/M/y h:i:sa"); ?></h3></b>
 <div class="pull-right">
<a href="inv_hc001complaints.php" class="btn btn-primary">CONFIG</a> </div>
</div>
<div class="panel-body">
<div id="divToPrint" >
<table class="table table-bordered">
<?php
$xQry='';
$xSlNo=0;
$xLoopCount=0;
$xQryFilter='';
$xQry="SELECT *  from t_complaint WHERE itemno>=0 and status='$xComplaintPaymentStatus'"; 
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
           <th width="40%"> ITEM </th>
           <th width="20%"> AMOUNT</th>
           <th width="20%"> DESCRIPTION</th>
          <?php if($GLOBALS ['xViewStockPoint']  == 0){ ?>        <th> STOCKPOINT</th> <? } ?>
          <?php if($GLOBALS ['xViewComplaintDate']  == 0){ ?>        <th> DATE</th> <? } ?>
          <?php if($GLOBALS ['xViewComplaintBy']  == 0){ ?>             <th> COMPLAINTBY</th> <? } ?>
          <?php if($GLOBALS ['xViewContactPerson']  == 0){ ?>          <th> CONTACTPERSON</th> <? } ?>
          <?php if($GLOBALS ['xViewStatus']  == 0){ ?>          <th> STATUS</th> <? } ?>
          <?php if($GLOBALS ['xViewRemarks']  == 0){ ?>           <th> REMARKS</th> <? } ?>
          <?php if($GLOBALS ['xViewCompletedDate']  == 0){ ?>           <th> COMPLETED</th> <? } ?>
          <?php if($GLOBALS ['xViewBillNo']  == 0){ ?>          <th> BILLNO</th> <? } ?>
          <?php if($GLOBALS ['xViewBillDetails']  == 0){ ?>   <th> BILLDETAILS</th> <? } ?>
          <?php if($GLOBALS ['xViewPaymentStatus']  == 0){ ?>       <th> PAYMENTSTATUS</th> <? } ?>
           <th colspan="2" width="10%">ACTIONS</td>

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
    echo '<td>' . $row['amount']  .'</td>';
    echo '<td>' . $row['complaintdescription']  . '</td>';

    if($GLOBALS ['xViewStockPoint']  == 0){echo '<td>' . $GLOBALS ['xStockPointShortName']  . '</td>';    }
    if($GLOBALS ['xViewComplaintDate']  == 0){echo '<td>' .date('d/M/Y',strtotime( $row['date'])) . '</td>';    }
    if($GLOBALS ['xViewComplaintBy']  == 0){echo '<td>' . $row['complaintby']  . '</td>';    }
    if($GLOBALS ['xViewContactPerson']  == 0){echo '<td>' .$row['contactperson']  . '</td>';    }
    if($GLOBALS ['xViewStatus']  == 0){echo '<td>' . $row['status']   . '</td>';    }
    if($GLOBALS ['xViewRemarks']  == 0){echo '<td>' . $row['remarks']  . '</td>';    }
    if($GLOBALS ['xViewCompletedDate']  == 0){echo '<td>' . date('d/M/Y',strtotime( $row['completeddate']))  . '</td>';    }
    if($GLOBALS ['xViewBillNo']  == 0){echo '<td>' . $row['billno']  . '</td>';    }
    if($GLOBALS ['xViewBillDetails']  == 0){echo '<td>' . $row['billdetails']  . '</td>';    }
    if($GLOBALS ['xViewPaymentStatus']  == 0){echo '<td>' . $row['paymentstatus']  . '</td>';    }
?>

<td><a href="inv_ht001complaint.php<?php echo '?complaintno='.$row['complaintno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="inv_ht001complaint.php<?php echo '?complaintno='.$row['complaintno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
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
</div>
</div>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->

<div class="table-responsive"> 
    
    <!-- Initialization 
                * js-dynamitable => dynamitable trigger (table)
                -->
    <table class="js-dynamitable     table table-bordered">

      <?php
$xQry='';
$xSlNo=0;
$xLoopCount=0;
$xQryFilter='';
$xQry="SELECT *  from t_complaint WHERE itemno>=0 and status='$xComplaintPaymentStatus'"; 
$xQry.= $xQryFilter. ' ' . "order by  date desc;";
$result2=mysql_query($xQry);

$rowCount = mysql_num_rows($result2);
echo '</br>'; 

while ($row = mysql_fetch_array($result2)) {
if($xLoopCount==0)
{
?>
      
      <!-- table heading -->
      <thead>
        
        <!-- Sortering
                        * js-sorter-asc => ascending sorter trigger
                        * js-sorter-desc => desending sorter trigger
                        -->
        <tr>
          <th>Item<span class="js-sorter-desc     glyphicon glyphicon-chevron-down pull-right"></span> <span class="js-sorter-asc     glyphicon glyphicon-chevron-up pull-right"></span> </th>
          <th>Amount <span class="js-sorter-desc     glyphicon glyphicon-chevron-down pull-right"></span> <span class="js-sorter-asc     glyphicon glyphicon-chevron-up pull-right"></span> </th>
          <th>Description<span class="js-sorter-desc     glyphicon glyphicon-chevron-down pull-right"></span> <span class="js-sorter-asc     glyphicon glyphicon-chevron-up pull-right"></span> </th>
          <th>Date<span class="js-sorter-desc     glyphicon glyphicon-chevron-down pull-right"></span> <span class="js-sorter-asc     glyphicon glyphicon-chevron-up pull-right"></span> </th>
          <th>PaymentStatus<span class="js-sorter-desc     glyphicon glyphicon-chevron-down pull-right"></span> <span class="js-sorter-asc     glyphicon glyphicon-chevron-up pull-right"></span> </th>
        </tr>
        
        <!-- Filtering
                        * js-filter => filter trigger (input, select)
                        -->
        <tr>
          <th> <!-- input filter -->
          <input  class="js-filter  form-control" type="text" value="">
          </th>
          <th><input class="js-filter  form-control" type="text" value=""></th>
          <th><input class="js-filter  form-control" type="text" value=""></th>
          <th><input class="js-filter  form-control" type="text" value=""></th>
           <th> <!-- select filter -->
            
            <select class="js-filter  form-control">
              <option value=""></option>
              <option value="PAID">Paid</option>
              <option value="NOT-PAID">NotPaid</option>
            </select>
          </th>
        </tr>
      </thead>
      
      <!-- table body -->

<?php
}
    $xSlNo+=1;
    $xLoopCount+=1;
   echo '<tbody>';
    finditemname($row['itemno']);
?>
<td><a href="inv_hr001_a_oldcomplaints.php<?php echo '?itemno='.$row['itemno'] . '&xmode=edit'; ?>"> <?php echo  $GLOBALS['xItemName'] ?>
</a>  </td>
<?php
 findstockpointname($row['stockpointno']);
    echo '<td>' . $row['amount']  .'</td>';
    echo '<td>' . $row['complaintdescription']  . '</td>';
    if($GLOBALS ['xViewComplaintDate']  == 0){echo '<td>' .date('d/M/Y',strtotime( $row['date'])) . '</td>';    }
    if($GLOBALS ['xViewPaymentStatus']  == 0){echo '<td>' . $row['paymentstatus']  . '</td>';    }
?>

<td><a href="inv_ht001complaint.php<?php echo '?complaintno='.$row['complaintno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="inv_ht001complaint.php<?php echo '?complaintno='.$row['complaintno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

<?
echo '</tr>'; 
}
  
?>	
    </table>
  </div>
<!-- jquery --> 
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> 

<!-- dynamitable --> 
<script src="js/dynamitable.jquery.min.js"></script>


