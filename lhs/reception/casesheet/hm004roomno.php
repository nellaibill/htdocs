<?php
include 'globalfile.php';
// Get the Patient Id value from Patient Id TextBox On KeyEnter
if (isset ( $_GET ['roomno'] ) && ! empty ( $_GET ['roomno'] )) {
	$xGetroomno = $_GET ['roomno'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['roomno'] );
	} else {
		$xQry = "DELETE FROM m_room where roomno=$xGetroomno";
		$result = mysql_query ( $xQry );
		if (! $result) {
			die ( 'Invalid query: ' . mysql_error () );
		} else {
			header ( 'Location: hm004roomno.php' );
		}
	}
} else {
	fn_DataClear ();
}

// Post Method Data To be Executed Here

if (isset ( $_POST ['f_BtnRoomSave'] )) {
	// S- Save ,U-Update
	DataProcess ( "S" );
} elseif (isset ( $_POST ['f_BtnRoomUpdate'] )) {
	DataProcess ( "U" );
}
function fn_DataClear() {
	$xQry = "";
	$xMsg = "";
	$GLOBALS ['xRoomNo'] = "";
	$GLOBALS ['xRoomTypeNo'] = "";
	$GLOBALS ['xRoomTypeName'] = "";
	GetMaxIdNo ();
}
function DataFetch($xRoomNo) {
	$result = mysql_query ( "SELECT *  FROM m_room where roomno=$xRoomNo" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xRoomNo'] = $row ['f_roomno'];
			$GLOBALS ['xRoomTypeNo'] = $row ['f_roomtypename'];
			$GLOBALS ['xRoomTypeName'] = $row ['f_roomname'];
		}
	}
}
function DataProcess($mode) {
	// Get Values from the Patient Registration Form
	$xRoomNo = $_POST ['f_roomno'];
	$xRoomName = strtoupper ( $_POST ['f_roomname'] );
	$xRoomTypeNo =$_POST ['f_roomtypeno'];
	if ($mode == 'S') {
		$xQry = "INSERT INTO m_room (roomno,roomtypeno,roomname) VALUES ($xRoomNo,'$xRoomTypeNo','$xRoomName')";
		$xMsg = "Inserted";
	} elseif ($mode == 'U') {
		$xQry = "UPDATE m_room   SET title='$xRoomTypeNo',roomname='$xRoomName' WHERE roomno='$xRoomNo'";
		$xMsg = "Updated";
	}
	//echo $xQry;
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	if (! $retval) {
		die ( 'Could not enter data: ' . mysql_error () );
	}
	fn_DataClear ();
	ShowAlert ( $xMsg );
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(roomno)IS NULL OR max(roomno)= '' 
       THEN '1' 
       ELSE max(roomno)+1 END AS roomno
FROM m_room";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xRoomNo'] = $row ['roomno'];
	}
}

?>
<!DOCTYPE body PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<body onload='document.testform.f_testtypename.focus()'>
	<form class="form" name="testform"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title  text-center">MASTER ROOM NAME</h3>
			</div>
		</div>
		<!-- Panel Body !-->

		<div class="panel-body">

			<!-- Panel -Room Type Number General Information !-->

			<div class="form-group" >

				<div class="col-xs-3" style="display:none">
					<label>Room No</label> <input type="text" class="form-control"
						name="f_roomno" readonly value="<?php echo $GLOBALS ['xRoomNo']; ?>" >
				</div>

				<label class="control-label col-xs-2">Room Name</label>
				<div class="col-xs-3">
					<input type="text" class="form-control" name="f_roomname"
						maxlength="50"
						
						maxlength="50">
				</div>
				<br></br> <label class="control-label col-xs-2">Room Type Name</label>

				<div class="col-xs-3">
	<select class="form-control"  name="f_roomtypeno" >
                                                      <?php
                                                        $result = mysql_query("SELECT *  FROM m_roomtype");
                                                        while($row = mysql_fetch_array($result))
                                                        {
                                                      ?>
                                                         <option value = "<?php echo $row['roomtypeno']; ?>" 
                                                         <?php
                                                          if ($row['roomtypeno']== $GLOBALS ['xRoomTypeNo']){
                                                          echo 'selected="selected"';
                                                          } 
                                                          ?> >
                                                         <?php echo $row['roomtypename']; ?> 
                                                         </option>
                                                         <?php
                                                           }
                                                          
                                                          ?>
                                                          </select>
				</div>

			</div>

			<br>
			<br>
			<!-- Panel -Room Type Number Information Ended !-->

			<div class="panel-footer clearfix">
				<div class="pull-right">

					<input type="submit" name="f_BtnRoomSave" class="btn btn-primary"
						value="SAVE" id="save" onclick="return validateForm()"> <input
						type="submit" name="f_BtnRoomUpdate" class="btn btn-primary" value="UPDATE"
						onclick="return validateForm()">

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
								<th width="30%">ROOM NAME</th>
								<th width="30%">ROOM TYPE</th>
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
$xQry = "SELECT *  from m_room  order by roomno";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	echo '<tr>';
	
	echo '<td>' . $xSlNo += 1 . '</td>';
	echo '<td>' . $row ['roomname'] . '</td>';
	fn_RoomType($row ['roomtypeno']);
    echo '<td>' .  $GLOBALS ['xRoomTypeName']  . '</td>';
    echo '<td>' .  $GLOBALS ['xRoomTypeAmount']  . '</td>';
    
	?>

<td>
<a href="hm004roomno.php<?php echo '?roomno='.$row['roomno'] . '&xmode=edit'; ?>" 
onclick="return confirm_edit()"> 
<img src="images/edit.png" style="width: 30px; height: 30px; border: 0">

</a>
</td>
							<td><a
								href="hm004roomno.php<?php echo '?roomno='.$row['roomno']. '&xmode=delete';  ?>"
								onclick="return confirm_delete()"> <img src="images/delete.png"
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
    