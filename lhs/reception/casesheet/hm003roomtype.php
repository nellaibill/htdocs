<?php
include 'globalfile.php';
$GLOBALS ['xMode']='';


// Get the Patient Id value from Patient Id TextBox On KeyEnter
if (isset ( $_GET ['roomtypeno'] ) && ! empty ( $_GET ['roomtypeno'] )) {
	$xGetRoomTypeNo = $_GET ['roomtypeno'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['roomtypeno'] );
	} else {
		$xQry = "DELETE FROM m_roomtype WHERE roomtypeno=$xGetRoomTypeNo";
		$result = mysql_query ( $xQry );
		if (! $result) {
			die ( 'Invalid query: ' . mysql_error () );
		} else {
			header ( 'Location: hm003roomtype.php' );
		}
	}
} else {
	fn_DataClear ();
}



// Post Method Data To be Executed Here

if (isset ( $_POST ['f_BtnRoomTypeSave'] )) {
	// S- Save ,U-Update
	DataProcess ( "S" );
} elseif (isset ( $_POST ['f_BtnRoomTypeUpdate'] )) {
	DataProcess ( "U" );
}

function DataFetch($xRoomTypeNo) {
	$result = mysql_query ( "SELECT *  FROM m_roomtype WHERE roomtypeno=$xRoomTypeNo" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xRoomTypeNo'] = $row ['roomtypeno'];
			$GLOBALS ['xRoomTypeName'] = $row ['roomtypename'];
			$GLOBALS ['xRoomTypeAmount'] = $row ['roomtypeamount'];
		}
	}
}

function DataProcess($mode) {
	// Get Values from the Patient Registration Form
	$xRoomTypeNo = $_POST ['f_roomtypeno'];
	$xRoomTypeName = strtoupper ( $_POST ['f_roomtypename'] );
	$xRoomTypeAmount = $_POST ['f_roomtypeamount'];
	if ($mode == 'S') {
		$xQry = "INSERT INTO m_roomtype (roomtypeno,roomtypename,roomtypeamount) VALUES ($xRoomTypeNo,'$xRoomTypeName',$xRoomTypeAmount)";
		$xMsg = "Inserted";
	} elseif ($mode == 'U') {
		$xQry = "UPDATE m_roomtype   SET roomtypename='$xRoomTypeName',roomtypeamount=$xRoomTypeAmount WHERE roomtypeno=$xRoomTypeNo";
		$xMsg = "Updated";
	}
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
	$GLOBALS ['xRoomTypeName'] = "";
	$GLOBALS ['xRoomTypeAmount'] = "";
	
	GetMaxIdNo ();
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(roomtypeno)IS NULL OR max(roomtypeno)= ''
       THEN '1'
       ELSE max(roomtypeno)+1 END AS roomtypeno
FROM m_roomtype";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xRoomTypeNo'] = $row ['roomtypeno'];
	}
}
?>
<body onload='document.testform.f_roomtypename.focus()'>
<form class="form" name="testform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<div class="panel panel-success" >

<div class="panel-heading">
        <h3 class="panel-title  text-center">MASTER ROOM TYPE</h3>
</div>
</div>
<!-- Panel Body !-->

<div class="panel-body">

<!-- Panel -Roomtype General Information !-->

<div class="form-group">

<div class="col-xs-3" style="display: none;">  
<label>Room Type No</label>
<input type="text" class="form-control"  name="f_roomtypeno"  value="<?php echo $GLOBALS ['xRoomTypeNo']; ?>" readonly >
</div>


<div class="col-xs-5"> 
<label>Room Type Name</label>
<input type="text" class="form-control"  name="f_roomtypename" value="<?php echo $GLOBALS ['xRoomTypeName']; ?>" maxlength="50" onkeypress="return restrictCharacters(this, event, alphaOnly);" maxlength="50">
</div>


<div class="col-xs-3"> 
<label>Amount</label>
<input type="text" class="form-control"  name="f_roomtypeamount" value="<?php echo $GLOBALS ['xRoomTypeAmount']; ?>" maxlength="50" onkeypress="return restrictCharacters(this, event, integerOnly);" maxlength="50">
</div>
</div>
<br></br>
<br></br>
<!-- Panel -Roomtype Information Ended !-->

<div class="panel-footer clearfix">
        <div class="pull-right">
            <? if ($GLOBALS ['xMode'] == "") {  ?> 
               <input type="submit"  name="f_BtnRoomTypeSave"   class="btn btn-primary" value="SAVE" id="save" onclick="return validateForm()"> 
            <? } else{ ?>
               <input type="submit"  name="f_BtnRoomTypeUpdate"   class="btn btn-primary" value="UPDATE" onclick="return validateForm()" > 
            <? }  ?>
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
						<h3 class="panel-title">VIEW ROOM TYPE</h3>
					</div>
									<div class="input-group"> <span class="input-group-addon">Filter</span>
  <input id="filter" type="text" class="form-control" placeholder="Search here...">
</div>
					<table class="table">
						<thead>
							<tr>
								<th width="5%">SL.NO</th>
								<th width="60%">ROOM TYPE NAME</th>
								<th width="30%">AMOUNT</th>
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
$xQry = "SELECT *  from m_roomtype  order by roomtypeno";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	echo '<tr>';
	
	echo '<td>' . $xSlNo += 1 . '</td>';
	echo '<td>' . $row ['roomtypename'] . '</td>';
	echo '<td>' . $row ['roomtypeamount'] . '</td>';
	?>

<td><a
								href="hm003roomtype.php<?php echo '?roomtypeno='.$row['roomtypeno'] . '&xmode=edit'; ?>"
								onclick="return confirm_edit()"> <img src="images/edit.png"
									alt="HTML tutorial"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
							<td><a
								href="hm003roomtype.php<?php echo '?roomtypeno='.$row['roomtypeno']. '&xmode=delete';  ?>"
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