<?php
ob_start ();
include 'globalfile.php';
$GLOBALS ['xEmployerPfPercentage']='';
$GLOBALS ['xEmployerEsiPercentage']='';

$GLOBALS ['xEmployeePfPercentage']='';
$GLOBALS ['xEmployeeEsiPercentage']='';
$GLOBALS ['xHikePercentage']='';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Settings</title>
<script type="text/javascript">
function validateForm() {
	var xPf= document.forms["settings"]["f_pfpercentage"].value;
	var xEsi= document.forms["settings"]["f_esipercentage"].value;
	var xHike= document.forms["settings"]["f_hikepercentage"].value;
	if (xPf== null || xPf== "") 
	{
	  alert("Pf must be filled out");
	  document.settings.f_pfpercentage.focus();
	   return false;
	}
	if (xEsi== null || xEsi== "") 
	{
	  alert("Esi must be filled out");
	  document.settings.f_esipercentage.focus();
	   return false;
	}
	if (xHike== null || xHike== "") 
	{
	  alert("Hike must be filled out");
	  document.settings.f_hikepercentage.focus();
	   return false;
	}
}
</script>
</head>

<body onload='document.settings.f_pfpercentage.focus()'>
	<form class="form" name="settings"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-success">
			<div class="panel panel-info">
				<div class="panel-heading  text-center">
					<h3 class="panel-title">Settings</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">


						<div class="col-xs-2">
							<label>EmployerPF%</label> <input type="text"
								class="form-control" name="f_employer_pfpercentage"
								value="<?php echo $GLOBALS ['xEmployerPfPercentage']; ?>">
						</div>


						<div class="col-xs-2">
							<label>EmployerESI%</label> <input type="text"
								class="form-control" name="f_employer_esipercentage"
								value="<?php echo $GLOBALS ['xEmployerEsiPercentage']; ?>">
						</div>
						
						<div class="col-xs-2">
							<label>EmployeePF%</label> <input type="text"
								class="form-control" name="f_employee_pfpercentage"
								value="<?php echo $GLOBALS ['xEmployeePfPercentage']; ?>">
						</div>


						<div class="col-xs-2">
							<label>EmployeeESI%</label> <input type="text"
								class="form-control" name="f_employee_esipercentage"
								value="<?php echo $GLOBALS ['xEmployeeEsiPercentage']; ?>">
						</div>
						<div class="col-xs-2">
							<label>Hike %</label> <input type="text"
								class="form-control" name="f_hikepercentage"
								value="<?php echo $GLOBALS ['xHikePercentage']; ?>">
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