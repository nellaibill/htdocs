<?php
include 'globalfile.php';
?>
<!DOCTYPE html>
<html>

  <body>
<form
	action="label_print.php" method="post">
	<div class="panel panel-success">
		<div class="panel-heading  text-center">
			<h3 class="panel-title">BAR CODE GENERATION</h3>
		</div>
		<div class="panel-body">
			<div class="form-group">

				<div class="col-xs-3">
					<label>From Code:</label> <input type="text" class="form-control"
						name="f_fromcode" value="1001">
				</div>
					<div class="col-xs-3">
					<label>To Code:</label> <input type="text" class="form-control"
						name="f_tocode" value="1002">
				</div>
				<div class="col-xs-3">
					<label>Count:</label> <input type="text" class="form-control"
						name="f_printcount" value="1">
				</div>
			</div>
			<div class="col-xs-3">

				<input type="submit" name="save" class="btn btn-primary"
					value="GENERATE"> <input type="submit" value="PRINT"
					class="btn btn-primary" onclick="PrintDiv();" />
			</div>
		</div>
	</div>
</form>


  </body>
</html>