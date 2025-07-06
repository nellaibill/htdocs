<?php
include('globalfile.php');
$GLOBALS ['xCurrentDate']=date('Y-m-d');
$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];
$xAcNo=$GLOBALS ['xAcNo'];
$xAcType=$GLOBALS ['xAcType'];
$xNetDebit=0;
$xNetCredit=0;
?>
<html>
<title> V-BANK TRANSACTION</title>

<form action="hr002banktransaction_search.php" method="post" name="hr002banktransaction">

<div class="col-xs-3">
<label>ENTER AMOUNT</label>
<input type="text" class="form-control" size="3"  name="f_amount">
</div>
          <input type="submit"  name="save"   class="btn btn-primary" value="VIEW" >


</div>
</form>
<body>
<div id="divToPrint" >
<div class="panel panel-success">
<div class="panel-heading">
       <b> <h3 class="panel-title text-center"><?php echo  " Bank Statement for the Account No- $xAcNo From $xFromDate To $xToDate As On ". date(" Y-m-d h:i:sa"); ?></h3></b>
</div>
<div class="panel-body">
<table class="table table-hover" border="1" id="lastrow">
      <thead>
        <tr>
          <th width="20%"> DATE </th>
          <th width="10%">CHEQUE NO</th>
          <th width="10%">DEBIT</th>
          <th width="10%"> LESS DEBIT</th>
           <th width="35%"> DETAILS</th>
          <th colspan="2" width="5%">ACTIONS</td>
        </tr>
      </thead>
      <tbody>

<?php
$xQry='';
$xQryFilter='';
$xEdit='edit';
$xDelete='delete';
$xDebit=0;
$xCredit=0;
$xLessDebit=0;
$xLessCredit=0;
$xDebitCount=0;
$xCreditCount=0;
require_once('config.php');
if($xAcType!="ALL")
{
$xQryFilter= $xQryFilter. ' ' . "and actype='$xAcType'";
}
$xQry="SELECT *  from banktransaction WHERE date >= '$xFromDate' 
		 AND date<= '$xToDate' and bankacno=$xAcNo"; 
$xQry.= $xQryFilter. ' ' . "order by  date;";
//echo $xQry;
$result2=mysql_query($xQry);

$rowCount = mysql_num_rows($result2);
while ($row = mysql_fetch_array($result2)) {
    
     if(($row['actype']=='DEBIT') ||($row['actype']=='LESSDEBIT'))
     {
    echo '<tr>';
    echo '<td>' . date('d-M-Y',strtotime($row['date']))   . '</td>';
    echo '<td align=right>' . $row['chequeno']  . '</td>';
    if($row['actype']=='DEBIT')
     {
      echo '<td align=right>' . money_format("%!n", $row['amount']) . '</td>';
      echo '<td></td>';
      $xDebit+=$row['amount'] ;
    }
   else if($row['actype']=='LESSDEBIT')
   {
     echo '<td></td>';
     echo '<td align=right>' . money_format("%!n", $row['amount']) . '</td>';
     $xLessDebit+=$row['amount'] ;
   }
   echo '<td align=left>' . $row['details']  . '</td>';
    
echo '</tr>'; 
}
}
    echo '<tr>';
    echo '<td> </td>';
    echo '<td align=right>GRAND-DEBIT-Rs.' . money_format("%!n",  $xDebit-$xLessDebit) . '</td>';
 
    echo '<td align=right> DEBIT -Rs.' . money_format("%!n", $xDebit) . '</td>';
         echo '<td align=right> LESSDEBIT -Rs.' . money_format("%!n", $xLessDebit) . '</td>';
             echo '<td> </td>';
echo '</tr>'; 


?>	
</tbody>
    </table>	
  </div>
  </div>
</div>
</body></html>	