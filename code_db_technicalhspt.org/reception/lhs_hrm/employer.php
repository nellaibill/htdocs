<?php
ob_start ();
include 'globalfile.php';
$GLOBALS ['xEmployeeName'] = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Employer</title>
<script type="text/javascript">
function validateForm() {
	var xEmpName= document.forms["employerregistration"]["f_EmployeeName"].value;
	if (xEmpName== null || xEmpName== "") 
	{
	  alert("Employee Name must be filled out");
	  document.employerregistration.f_EmployeeName.focus();
	   return false;
	}
}
</script>
</head>

<body onload='document.employerregistration.f_EmployeeName.focus()'>
	<form class="form" name="employerregistration"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-success">
			<div class="panel panel-info">
				<div class="panel-heading  text-center">
					<h3 class="panel-title">Employer Registration</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">

						<div class="col-xs-2" style="display: none;">
							<label> Employee No</label> <input type="text"
								class="form-control" id="f_employeeid" name="f_employeeid"
								value="<?php echo $GLOBALS ['xEmployeeId']; ?>" readonly>
						</div>

						<div class="col-xs-4">
							<label>Employee Name</label> <input type="text"
								class="form-control" name="f_EmployeeName"
								value="<?php echo $GLOBALS ['xEmployeeName']; ?>">
						</div>


						<div class="col-xs-3">

							<label>Department</label> <select class="form-control"
								name="f_Department">
								<option value="1">Morning</option>
								<option value="2">Evening</option>

							</select>
						</div>

					</div>
				</div>
			</div>

			<div class="panel-footer clearfix">
				<div class="pull-right">
	  <?php if ($GLOBALS ['xMode'] == "") {  ?> 
		   <input type="submit" name="save" class="btn btn-primary"
						value="SAVE" id="save" onclick="return validateForm()"> 
	   <?php } else{ ?>
		   <input type="submit" name="update" class="btn btn-primary"
						value="UPDATE" onclick="return validateForm()"> 
	   <?php }  ?>
	</div>
			</div>

		</div>

	</form>


<?php ob_end_flush(); ?>
</body>
</html>