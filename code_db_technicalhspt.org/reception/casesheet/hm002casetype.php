<?php
include 'globalfile.php';


// Get the Patient Id value from Patient Id TextBox On KeyEnter
if (isset ( $_GET ['casetypeno'] ) && ! empty ( $_GET ['casetypeno'] )) {
	$xGetCaseTypeNo = $_GET ['casetypeno'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['casetypeno'] );
	} else {
		$xQry = "DELETE FROM m_casetype WHERE casetypeno=$xGetCaseTypeNo";
		$result = mysql_query ( $xQry );
		if (! $result) {
			die ( 'Invalid query: ' . mysql_error () );
		} else {
			header ( 'Location: hm002casetype.php' );
		}
	}
} else {
	fn_DataClear ();
}



// Post Method Data To be Executed Here

if (isset ( $_POST ['f_BtnCaseTypeSave'] )) {
	// S- Save ,U-Update
	DataProcess ( "S" );
} elseif (isset ( $_POST ['f_BtnCaseTypeUpdate'] )) {
	DataProcess ( "U" );
}

function DataFetch($xCaseTypeNo) {
	$result = mysql_query ( "SELECT *  FROM m_casetype WHERE casetypeno=$xCaseTypeNo" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xCaseTypeNo'] = $row ['casetypeno'];
			$GLOBALS ['xCaseTypeName'] = $row ['casetypename'];
		}
	}
}

function DataProcess($mode) {
	// Get Values from the Patient Registration Form
	$xCaseTypeNo = $_POST ['f_casetypeno'];
	$xCaseTypeName = strtoupper ( $_POST ['f_casetypename'] );
	if ($mode == 'S') {
		$xQry = "INSERT INTO m_casetype (casetypeno,casetypename) VALUES ($xCaseTypeNo,'$xCaseTypeName')";
		$xMsg = "Inserted";
	} elseif ($mode == 'U') {
		$xQry = "UPDATE m_casetype   SET casetypename='$xCaseTypeName' WHERE casetypeno=$xCaseTypeNo";
		$xMsg = "Updated";
	} 
	// echo $xQry;
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	if (! $retval) {
		die ( 'Could not enter data: ' . mysql_error () );
	}
	fn_DataClear();
	ShowAlert ( $xMsg );
}

function fn_DataClear() {
	$xQry = "";
	$xMsg = "";
	$GLOBALS ['xCaseTypeName'] = "";
	GetMaxIdNo ();
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(casetypeno)IS NULL OR max(casetypeno)= ''
       THEN '1'
       ELSE max(casetypeno)+1 END AS casetypeno
FROM m_casetype";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xCaseTypeNo'] = $row ['casetypeno'];
	}
}

?>
<body onload='document.testform.f_testtypename.focus()'>
<div>
<form class="form" name="casetypeform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel panel-success" >
<div class="panel-heading">
        <h3 class="panel-title  text-center">MASTER CASE TYPE</h3>
</div>

<!-- Panel Body !-->

<div class="panel-body">

<!-- Panel -Casetype General Information !-->

<div class="form-group">

<div class="col-xs-3" > 
<label>Case Type No:</label>
<input type="text" class="form-control"  name="f_casetypeno" value="<?php echo $GLOBALS ['xCaseTypeNo']; ?>" readonly >
</div>


<div class="col-xs-7"> 
<label>Case Type Name</label>
<input type="text" class="form-control"  name="f_casetypename" value="<?php echo $GLOBALS ['xCaseTypeName']; ?>" maxlength="50" onkeypress="return restrictCharacters(this, event, alphaOnly);" maxlength="50">
</div>

<br></br>
<br></br>
<br></br>
<!-- Panel -Casetype Information Ended !-->

<div class="panel-footer clearfix">
        <div class="pull-right">
           
               <input type="submit"  name="f_BtnCaseTypeSave"   class="btn btn-primary" value="SAVE" id="save" onclick="return validateForm()"> 
           
               <input type="submit"  name="f_BtnCaseTypeUpdate"   class="btn btn-primary" value="UPDATE" onclick="return validateForm()" > 
           
        </div>
</div>
</div>
</form>



		<hr>
		<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
		<div id="divToPrint">
			<div class="container">
				<div class="panel panel-info">

					<!-- Default panel contents -->
					<div class="panel-heading  text-center">
						<h3 class="panel-title">VIEW CASE TYPE</h3>
					</div>
									<div class="input-group"> <span class="input-group-addon">Filter</span>
  <input id="filter" type="text" class="form-control" placeholder="Search here...">
</div>
					<table class="table">
						<thead>
							<tr>
								<th width="5%">SL.NO</th>
								<th width="90%">CASE TYPE NAME</th>
								<th width="5%">ACTIONS</th>
<?php
if ($login_session == "admin") {
	?>
<th colspan="2" width="5%">ACTIONS

<?php
}
?>
</tr>
						</thead>
						<tbody class="searchable">

<?php
$xQry = '';
$xSlNo = 0;
$xQry = "SELECT *  from m_casetype  order by casetypeno";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	echo '<tr>';
	
	echo '<td>' . $xSlNo += 1 . '</td>';
	echo '<td>' . $row ['casetypename'] . '</td>';
	?>
<td><a
								href="hm002casetype.php<?php echo '?casetypeno='.$row['casetypeno'] . '&xmode=edit'; ?>"
								onclick="return confirm_edit()"> <img src="images/edit.png"
									alt="HTML tutorial"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
							<td><a
								href="hm002casetype.php<?php echo '?casetypeno='.$row['casetypeno']. '&xmode=delete';  ?>"
								onclick="return confirm_delete()"> <img src="images/delete.png"
									alt="HTML tutorial"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
<?php
	echo '</tr>';
}

?>	
</tbody>
					</table>
				</div>
				<!-- /container -->
			</div>
		</div>
		<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
	</form>
	<script type="text/javascript">
    ko.bindingHandlers.nextFieldOnEnter = {
        init: function(element, valueAccessor, allBindingsAccessor) {
            $(element).on('keydown', 'input, select', function (e) {
                var self = $(this)
                , form = $(element)
                  , focusable
                  , next
                ;
                if (e.keyCode == 13) {
                    focusable = form.find('input,a,select,button,textarea').filter(':visible');
                    var nextIndex = focusable.index(this) == focusable.length -1 ? 0 : focusable.index(this) + 1;
                    next = focusable.eq(nextIndex);
                    next.focus();
                    return false;
                }
            });
        }
    };

    ko.applyBindings({});
    </script>