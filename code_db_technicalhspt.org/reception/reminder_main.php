<?php
include 'globalfile.php';
fn_DataClear ();
if (isset ( $_GET ['task_id'] ) && ! empty ( $_GET ['task_id'] )) {
	$xGettask_id = $_GET ['task_id'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['task_id'] );
	} else {
		$xQry = "DELETE FROM reminder_basic WHERE task_id=$xGettask_id";
		$result = mysql_query ( $xQry );
		if (! $result) {
			die ( 'Invalid query: ' . mysql_error () );
		} else {
			header ( 'Location: reminder_main.php' );
		}
	}
} 

elseif (isset ( $_POST ['save_ledger'] )) {
	DataProcess ( "S" );
} elseif (isset ( $_POST ['update_ledger'] )) {
	DataProcess ( "U" );
}
else {
	GetMaxIdNo ();
}
function DataFetch($xid) {
	$result = mysql_query ( "SELECT *  FROM reminder_basic WHERE task_id=$xid" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			
			$GLOBALS ['xtask_id'] = $row ['task_id'];
            $GLOBALS ['task_name'] = $row ['task_name'];
            $GLOBALS ['due_date'] = $row ['due_date'];
            $GLOBALS ['amount'] = $row ['amount'];
            $GLOBALS ['days'] = $row ['days'];
            $GLOBALS ['description'] = $row ['description'];
            $GLOBALS ['f'] = $row ['f'];
            $GLOBALS ['g'] = $row ['g'];
            $GLOBALS ['h'] = $row ['h'];
            $GLOBALS ['i'] = $row ['i'];
		}
	}
}
function fn_DataClear() {
	$xQry = "";
	$xMsg = "";
	$GLOBALS ['xtask_id'] = '';
	$GLOBALS ['task_name'] = '';
	$GLOBALS ['due_date'] = '';
	$GLOBALS ['amount'] = '';
	$GLOBALS ['days'] = '';
	$GLOBALS ['description'] = '';
    $GLOBALS ['f'] = '';
    $GLOBALS ['g'] = '';
    $GLOBALS ['h'] = '';
    $GLOBALS ['i'] = '';
}

function GetMaxIdNo() {
	$result = mysql_query ( "SELECT  CASE WHEN max(task_id)IS NULL OR max(task_id)= '' THEN '1'
					  ELSE max(task_id)+1 END AS task_id FROM  reminder_basic" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xtask_id'] = $row ['task_id'];
	}
}
function DataProcess($mode) {
    $xtask_id = $_POST ['f_task_id'];
	$a = $_POST ['f_task_name'];
	$b = $_POST ['f_due_date'];
	$c = $_POST ['f_amount'];
	$d = $_POST ['f_days'];
	$e = $_POST ['f_description'];
	$f = date('Y-m-d',strtotime($_POST ['f_due_date']) - $_POST ['f_days']*60*60*24);
	$g = $_POST ['f_status'];
//	$f = new DateTime();
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO reminder_basic
		(task_id,
		task_name,
		due_date,
		amount,
		days,
		description,
		reminder_date,
		status)
		VALUES(
		$xtask_id,
		'$a',
		'$b',
		'$c',
		'$d',
		'$e',
		'$f',
		'$g')";
        //echo $xQry;
		mysql_query ( $xQry ) or die ( mysql_error () );
		echo '<script type="text/javascript">swal("Good job!", "Reminder Created!", "success");</script>';
	} elseif ($mode == 'U') {

        $xQry="update reminder_basic set
		task_name='$a',
        due_date='$b',
        amount='$c',
        days='$d',
        description='$e',
        reminder_date='$f',
        status='$g'
                WHERE task_id=$xtask_id";
              //  echo $xQry;
		mysql_query ( $xQry ) or die ( mysql_error () );
	}
	GetMaxIdNo ();
}

?>
<?php include 'title.php'?>

<body onload='document.ledger_creation.f_ledger_name.focus()'>
	<div class="form-style-8">
    <h2>REMINDER INFORMATION</h2>
		<form class="form" name="ledger_creation"
			action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel-body">
	<div class="col-xs-1" style="display: none;">
	<label>Id:</label>
			<input type="text" name="f_task_id" placeholder="No"  class="form-control" 
				value="<?php echo $GLOBALS ['xtask_id']; ?>" readonly/> 
				</div>
						<div class="col-xs-6 ">
						<label>Task Name:</label>
				<input type="text" name="f_task_name" class="form-control"
				value="<?php echo $GLOBALS ['task_name']; ?>" required />

	</div>


	<div class="col-xs-3" >
    <label> Due Date</label>
			<input type="date" name="f_due_date"  class="form-control" required value="<?php echo $GLOBALS ['due_date']; ?>"
				/>
					</div>
	<div class="col-xs-3">
			<label>Amount:</label>
					<input type="number" name="f_amount"  class="form-control"
				 value="<?php echo $GLOBALS ['amount']; ?>" required />
					</div>

<div class="col-xs-6">

<label>Description</label>
<textarea  class="form-control" name="f_description"
   rows="20" cols="60" >
    
  <?php echo $GLOBALS ['description']; ?>
</textarea>

</div>
	<div class="col-xs-3">
			<label>Day's Count:</label>
					<input type="text" name="f_days"  class="form-control"
				 value="<?php echo $GLOBALS ['days']; ?>" />
					</div>
	

					<div class="col-xs-3">
			<label>Status</label>
						<select class="form-control"  value="" name="f_status">
							<option value="Processing"
								<?php if($GLOBALS ['days']=="Processing") echo 'selected="selected"'; ?>>Processing</option>
							<option value="Completed"
								<?php if( $GLOBALS ['days']=="Completed") echo 'selected="selected"'; ?>>Completed</option>
</select>
					</div>
</div>
</br></br>
		<div class="panel-footer clearfix">
				<div class="pull-right">
	  <?php if ($GLOBALS ['xMode'] == "") {  ?> 
		   <input type="submit" class="btn btn-primary"
						name="save_ledger" value="Save" accesskey="s"> 
	   <?php } else{ ?>
		   <input type="submit" class="btn btn-primary"
						name="update_ledger" value="Update"
				accesskey="s">
	   <?php }  ?>
	</div>
			</div>
			
				
		</form>
	
	</div>

