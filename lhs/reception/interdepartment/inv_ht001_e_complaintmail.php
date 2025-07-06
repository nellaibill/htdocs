<?php
include '../../session.php';
include '../globalfunctions.php';
include '../global_configfunctions.php';
if ( isset( $_GET['complaintno'] ) && !empty( $_GET['complaintno'] ) )
{
  $no= $_GET['complaintno'];
  if($_GET['xmode']=='edit')
   {
    $GLOBALS ['xMode']='F';
    DataFetch ( $_GET['complaintno']);
   }
}
if (isset ( $_POST ['save'] ))
{

	DataProcess ( "S");
}


function DataFetch($xComplaintNo) {
    $result = mysql_query ( "SELECT *  FROM t_complaint where complaintno=$xComplaintNo" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) 
         {

	        $GLOBALS ['xComplaintNo'] = $row ['complaintno'];
 		$GLOBALS ['xItemNo'] = $row ['itemno'];
	        $GLOBALS ['xDate'] = $row ['date'];
	        $GLOBALS ['xComplaintDescription'] = $row ['complaintdescription'];
 	        $GLOBALS ['xComplaintBy'] = $row ['complaintby'];
 		$GLOBALS ['xContactPerson'] = $row ['contactperson'];
	}
      }
}

function DataProcess($mode) {
$xCurrentDateTime=$GLOBALS ['xCurrentDateTime'];
$xComplaintNo= $_POST ['f_complaintno'];
$xItemNo= $_POST ['f_itemno'];
finditemname($xItemNo);
$xStockPointNo= $GLOBALS['xStockPointNo'];
$xComplaintDescription= $_POST ['f_complaintdescription'];
$xComplaintBy= $_POST ['f_complaintby'];
$xContactPerson= $_POST ['f_contactperson'];
$xQry="";
$xMsg="";
if ($mode == 'S') 
{
if(isset($_POST['sendmail'])){
    $to = "admin@technicalhspt.org"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $subject = "Form submission";
    $subject2 = "Copy of your form submission";
    $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
    $message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];

    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    }
} 
elseif ($mode == 'U')
{

}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title> SEND MAIL </title>

</head>
<body>
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title text-center">MAIL VERIFICATION</h3>
</div>
<div class="panel-body">
<form class="form" name="complaintform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset>
 <div class="form-group" >

<div class="col-xs-3">
<label>Complaint No</label>
<input type="text" class="form-control"  name="f_complaintno" value="<?php echo $GLOBALS ['xComplaintNo']; ?>"readonly>
</div>			

<div class="col-xs-6">
<label>Details</label>
<input type="text" class="form-control"  name="f_details" value="<?php echo $GLOBALS ['xComplaintDescription']; ?>" readonly >
</div>

<div class="col-xs-3">
<label>Complaint By</label>
<input type="text" class="form-control"  name="f_complaintby" value="<?php echo $GLOBALS ['xComplaintBy']; ?>" readonly>
</div>								                 
	
<div class="col-xs-4">
<label>Supplier Name:</label>
<select class="form-control"  value="" name="f_mailid"  >
<?php
 $result = mysql_query("SELECT *  FROM inv_supplier order by suppliername");
  echo "<option value='mdsaleem1804@gmail.com'>SALEEM</option>";
  while($row = mysql_fetch_array($result))
   { if($row['supplieremailid'] !='') { ?>
    <option value = "<?php echo $row['supplieremailid']; ?>" 
     <?php
      if ($row['supplierid']== $GLOBALS ['xSupplierNo']){echo 'selected="selected"';} 
    ?> >
     <?php echo  $row['suppliername']. "---  " . $row['supplieremailid'] ?> 
    </option>
    <?} } 
?>
</select>
</div>
	

</div></div>

<div class="panel-footer clearfix">
   <div class="pull-right">
               <input type="submit"  name="sendmail"   class="btn btn-primary" value="SEND-MAIL"> 
        </div>
</div>
		</form>
</div>
</body>
</html>
</body>
</html>