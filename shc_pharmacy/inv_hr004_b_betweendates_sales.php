<?php
 include 'globalfile.php';
 $xFromDate=$GLOBALS ['xInvFromDate'];
 $xToDate=$GLOBALS ['xInvToDate'];
fn_DataClear();
function fn_DataClear()
{
$_GET['form']='';
}
?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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




</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
</div><!-- Panel !-->
</form>
<html>
<title> V-SALES</title>
<head><link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">

</head>
<body>
 
<div id="divToPrint" >
<div class="container">

<?php
$xSlNo=0;
$xGrandTotal=0;
 $xQryFilter=''; 
 if (isSet($_POST['save'])) 
    {
   $xFromDate=$_POST['f_fromdate'];
   $xToDate= $_POST['f_todate'];

$xQry="SELECT i.vat as vat,i.itemno,sum(i.qty) as qty,sum(i.amount)as amount 
from inv_salesentry as i ,m_item as m where   
m.itemno=i.itemno 
and  date>='$xFromDate' and date<='$xToDate'
group by i.itemno order by m.itemname;";

$result2=mysql_query($xQry);
?>
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><b>
  <?php echo "Sales Report From From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa");?></b></div>
<table class="table table-hover" border="1" >
     <thead>
        <tr>
           <th width="5%">S.NO</th>
           <th width="25%">ITEM NAME</th>
           <th width="10%">QTY</th>
               <th width="10%">AMOUNT</th>
          </tr>
      </thead>

    <tfoot>
        <tr>
           <th width="5%">S.NO</th>
           <th width="25%">ITEM NAME</th>
           <th width="10%">QTY</th>
           <th width="10%">AMOUNT</th>
          </tr>
      </tfoot>
      <tbody>

<?php
if(mysql_num_rows($result2)){
while ($row = mysql_fetch_array($result2)) {

    echo '<tr>';
		finditemname($row['itemno']);
							echo '<td>' . $xSlNo+=1  . '</td>';
							echo '<td>' . $GLOBALS['xItemName']  . '</td>';
							echo '<td align=right>' . $row['qty']  . '</td>';
							$xGst=$row['vat']/100;
							$xAmount=$row['amount'] ;
							$GstValue=$row['amount']*$xGst;
							$xAmountIncludedGst=$xAmount+$GstValue;
							echo '<td align=right>' . round($xAmountIncludedGst,2) . '</td>';
							$xGrandTotal+=round($xAmountIncludedGst,2);
?>
<?php
echo '</tr>'; 

}
echo '<tr>';
echo '<td colspan=3 align=right> GRAND TOTAL</td>';
echo '<td align=right>' . $xGrandTotal . '</td>';
echo '</tr>';
}

else 
 {     
    fn_NoDataFound();
 }

    }
?>	

</tbody>
    </table>	
  </div><!-- /container -->
</div></div>
</body></html>	