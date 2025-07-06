<?php
 include 'globalfile.php';
$xFromDate=$GLOBALS ['xInvFromDate'];
$xToDate=$GLOBALS ['xInvToDate'];

?>
<title>AUD-SALES</title>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel panel-success">
<div class="panel-heading text-center">FILTER[GROUP]
<div class="btn-group pull-right">
         
</div>

</div>
<div class="panel-body">
<div class="form-group">

  <div class="row">
    


<div class="col-xs-4">

From Date:<input type="date" class="form-control"  name="f_fromdate" value="<?php echo $GLOBALS ['xInvFromDate']; ?>">
</div>

<div class="col-xs-4">

To Date:<input type="date" class="form-control"  name="f_todate" value="<?php echo $GLOBALS ['xInvToDate']; ?>">
</div>


    <div class="col-xs-4">
    <input type="submit"  name="save"   class="btn btn-primary" value="VIEW" >
    </div>
    
  </div><br/>
<!--    <div class="row">
   <div class="col-xs-4">
   <input type="text" class="form-control"  name="f_email" >
   </div>
    <div class="col-xs-4">
    <input type="submit"  name="sendmail"   class="btn btn-primary" value="SEND REPROT TO AUDITOR" >
    </div>
  </div> -->
 

</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
</div><!-- Panel !-->
</form>

<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint" >
 <div class="panel panel-primary">
  <div class="panel-heading  text-center">
<b><?php echo "Sales Entries From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></b>
        
  </div>
 <div class="panel-body">

  <div class="container">
<!--
<p><label for="search"><strong>Enter keyword to search </strong></label><input type="text" id="search"/></p>!-->
<table class="table table-striped  table-bordered " data-responsive="table">
      <thead>
        <tr>
              <th> S.No</th>
           <th>Bill No</th>
           <th> Date</th>
           <th>Name Of the Party</th>
           <th>GSTIN</th>
           <th>Qty</th>
           <th>Value</th>
           <th>Discount</th>           
           <th>GST%</th>
           <th>GST Value</th>
           <th>Total Value</th>
        </tr>
      </thead>
      

      <tbody>

<?php
$xQry='';
$xSlNo=0;
    $xGrandVat=0;
    $xGrandTotal=0;
    $xGrandNetTotal=0;
	$xVatValue=0;
	$xNetTotal=0;
$xQryFilter='';
 if (isSet($_POST['save'])) 
    {
      $xFromDate= $_POST['f_fromdate'];
      $xToDate= $_POST['f_todate'];
      $xQry = "update config_inventory set fromdate='$xFromDate',todate='$xToDate'";
      mysql_query($xQry);
      header('Location: auditor_sales_details.php');
    }
   else if (isSet($_POST['sendmail']))
    {
    	$xEmail= $_POST['f_email'];
    	require("PHPMailer_5.2.0/class.PHPMailer.php");
    	$mail = new PHPMailer();
    	
    	$mail->IsSMTP();                                      // set mailer to use SMTP
    	$mail->Host = "localhost";  // specify main and backup server
    	$mail->SMTPAuth = true;     // turn on SMTP authentication
    	$mail->Username = "root";  // SMTP username
    	$mail->Password = ""; // SMTP password
    	
    	$mail->From = "tcssnellai@gmail.com";
    	$mail->FromName = "the Diamond Marbles";
    	$mail->AddAddress("josh@example.net", "Josh Adams");
    	$mail->AddAddress("ellen@example.com");                  // name is optional
    	$mail->AddReplyTo("info@example.com", "Information");
    	
    	$mail->WordWrap = 50;                                 // set word wrap to 50 characters
    	$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
    	$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
    	$mail->IsHTML(true);                                  // set email format to HTML
    	
    	$mail->Subject = "Here is the subject";
    	$mail->Body    = "This is the HTML message body <b>in bold!</b>";
    	$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
    	
    	if(!$mail->Send())
    	{
    		echo "Message could not be sent. <p>";
    		echo "Mailer Error: " . $mail->ErrorInfo;
    		exit;
    	}
    	
    	echo "Message has been sent";
    	 
    }
else
{
$xFromDate=$GLOBALS ['xInvFromDate'];
$xToDate= $GLOBALS ['xInvToDate'];
}

$xQry="SELECT *
from inv_salesentry where date>= '$xFromDate' AND date<= '$xToDate'
and customerno>0
 and salesinvoiceno>0 order by salesinvoiceno";

//$xQry="SELECT itemno,batchid,salesinvoiceno,date, qty,unitrate,patientid
//from inv_salesentry where date>= '$xFromDate' AND date<= '$xToDate' order by salesinvoiceno";
//echo $xQry;
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 

if(mysql_num_rows($result2)){
while ($row = mysql_fetch_array($result2)) {
    $xSlNo+=1;
    finditemname($row['itemno']);
   // fn_PatientDetails($row['patientid']);
   // findsuppliername($row['supplierno']);
    findcustomername($row['customerno']);
    finditempricevat($row['itemno'],$row['batchid'])
 ?>
 <tr>
 <?php 

 	$xItemVat=$row['vat'];	
    echo '<td>' . $xSlNo. '</td>';
    echo '<td>' . $row['salesinvoiceno']  . '</td>';
    echo '<td>' . date('d/M/y', strtotime($row['date']))   . '</td>';
    echo '<td>'.$GLOBALS ['xCustomerName'].'</td>';
    echo '<td>'.$GLOBALS ['xCustomerGSTINNo'].'</td>';
    echo '<td align=right>'.$row['qty'].'</td>';
    $xInvoiceItemValue=$row['amount'];
    echo '<td align=right>' . fn_RupeeFormat($xInvoiceItemValue) . '</td>';
    echo '<td align=right>'.$row['discountpercentage'].'</td>';
    echo '<td align=right>'.$row['vat'].'</td>';
    echo '<td align=right>'  .fn_RupeeFormat($xInvoiceItemValue*( $xItemVat/100) ). '</td>';
    $xNetTotal=  ( $xInvoiceItemValue*( $xItemVat/100))+ $xInvoiceItemValue;
    echo '<td align=right>' .fn_RupeeFormat($xNetTotal).'</td>';
    $xGrandTotal+=$xInvoiceItemValue;
    $xGrandVat+=$xInvoiceItemValue*($xItemVat/100);
    $xGrandNetTotal+= $xNetTotal;
   $xOldSalesInvoiceNo=$row['salesinvoiceno'];


}
echo '</tr>'; 
   echo '<tr>';
    echo '<td colspan=6> TOTAL .  </td>';
    echo '<td align=right>' . fn_RupeeFormat( $xGrandTotal) . '</td>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td align=right>' . fn_RupeeFormat( $xGrandVat) . '</td>';

    echo '<td align=right>' . fn_RupeeFormat( $xGrandNetTotal) . '</td>';


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
</div>
</div>
</div>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
