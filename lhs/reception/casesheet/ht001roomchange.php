<?php
include 'globalfile.php';
$xDateTime=date("d/m/Y h:i:s");

?>
<body onload='document.testform.f_testtypename.focus()'>

<form class="form" name="testform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel panel-success" >
<div class="panel-heading">
        <h3 class="panel-title  text-center">ROOM CHANGE</h3>
</div>
</div>

<!-- Panel Body !-->

<div class="panel-body">

<!-- Panel -Room Change General Information !-->

<div class="form-group">

<label  class="control-label col-xs-2">Patient ID</label>
	<div class="col-xs-2">
	<select class="form-control"  name="f_patientid" >
                                                      <?php
                                                        $result = mysql_query("SELECT *  FROM m_patientregistration");
                                                        while($row = mysql_fetch_array($result))
                                                        {
                                                      ?>
                                                         <option value = "<?php echo $row['patientid']; ?>" 
                                                         <?php
                                                         // if ($row['patientid']== $GLOBALS ['patientid']){
                                                        //  echo 'selected="selected"';
                                                        //  } 
                                                          ?> >
                                                         <?php echo $row['patientid']; ?> 
                                                         </option>
                                                         <?php
                                                           }
                                                          
                                                          ?>
                                                          </select>
</div>
<br></br>
<label  class="control-label col-xs-2">From Room Details</label>
	<div class="col-xs-4">
<input type="text" class="form-control"  readonly="readonly">
<input type="text" class="form-control" readonly="readonly">
<input type="text" class="form-control" readonly="readonly">

</div>
<br></br>
<br></br>
<br></br>			


<label  class="control-label col-xs-2">To Room Details</label>
	<div class="col-xs-4">
	<select class="form-control"  name="f_toroomtype" >
                                                      <?php
                                                        $result = mysql_query("SELECT *  FROM m_roomtype");
                                                        while($row = mysql_fetch_array($result))
                                                        {
                                                      ?>
                                                         <option value = "<?php echo $row['roomtypeno']; ?>" 
                                                         <?php
                                                         // if ($row['patientid']== $GLOBALS ['patientid']){
                                                        //  echo 'selected="selected"';
                                                        //  } 
                                                          ?> >
                                                         <?php echo $row['roomtypename']; ?> 
                                                         </option>
                                                         <?php
                                                           }
                                                          
                                                          ?>
                                                          </select>
	
	<select class="form-control"  name="f_toroom" >
                                                      <?php
                                                        $result = mysql_query("SELECT *  FROM m_room");
                                                        while($row = mysql_fetch_array($result))
                                                        {
                                                      ?>
                                                         <option value = "<?php echo $row['roomno']; ?>" 
                                                         <?php
                                                         // if ($row['patientid']== $GLOBALS ['patientid']){
                                                        //  echo 'selected="selected"';
                                                        //  } 
                                                          ?> >
                                                         <?php echo $row['roomname']; ?> 
                                                         </option>
                                                         <?php
                                                           }
                                                          
                                                          ?>
                                                          </select>

</div>
<br></br>
<br></br>	
</div>
<label  class="control-label col-xs-2">Date Time</label>
	<div class="col-xs-3">

<input type="datetime" class="form-control" name="f_datetime"  readonly value="<?php echo $xDateTime; ?>"/>
</div>
<br></br>
<br></br>
<br></br>
<!-- Panel -Room Change Information Ended !-->

<div class="panel-footer clearfix">
        <div class="pull-right">
           
               <input type="submit"  name="save"   class="btn btn-primary" value="SAVE" id="save" onclick="return validateForm()"> 
           
               <input type="submit"  name="update"   class="btn btn-primary" value="UPDATE" onclick="return validateForm()" > 
           
        </div>
</div>
</div>
</form>