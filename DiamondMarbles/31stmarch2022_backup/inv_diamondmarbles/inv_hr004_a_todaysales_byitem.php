<?php
 include 'globalfile.php';
 $xCurrentDate=$GLOBALS ['xCurrentDate'];
?>

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

$xDate=date ( 'Y-m-d' );

/* ------------- Area Executes from Home Page  ----------- */
$xQry="SELECT i.itemno,sum(i.qty) as qty,sum(i.amount)as amount from 
		inv_salesentry as i ,m_item as m 
		where  m.itemno=i.itemno  and date='$xDate' group by i.itemno order by m.itemname;";
//$xQry="SELECT itemno,sum(qty) as qty from inv_salesentry as i ,m_item m where date= ' $xCurrentDate'  where m.itemno=i.itemno group by itemno order by m.itemname;";
// /echo $xQry; 
$result2=mysql_query($xQry);
?>
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><b><?php echo "Daily Sales Report As On ". date("d/M/y h:i:sa"); ?></b></div>
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
    echo '<td>' . $row['qty']  . '</td>';
    echo '<td>' . $row['amount']  . '</td>';
    $xGrandTotal+=$row['amount'];
?>
<?php
echo '</tr>'; 

}
echo '<tr>';
echo '<td colspan=3 align=right> GRAND TOTAL</td>';
echo '<td>' . $xGrandTotal . '</td>';
echo '</tr>';
}

else 
 {     
    fn_NoDataFound();
 }
  
?>	
</tbody>
    </table>	
  </div><!-- /container -->
</div></div>
</body></html>	