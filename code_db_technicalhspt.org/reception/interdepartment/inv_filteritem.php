<?php
include('globalfunctions.php');
$xItemSubGroupNo=$_REQUEST['itemsubgroupno'];
$xQry="SELECT itemno,itemname from m_item WHERE itemsubgroupno= $xItemSubGroupNo";
$stmt = mysql_query($xQry);
?>
<label>Item:</label>
<div class="col-xs-3">
<select class="form-control" name="f_itemno">
<option value="0">All</option>
<?php
while($row = mysql_fetch_array($stmt)) {
?>
<option value = "<?php echo $row['itemno']; ?>" 
                                              <?php
                                              if ($row['itemname']== $GLOBALS['xItemName']){
                                               echo 'selected="selected"';
                                               } 
                                            ?> >
                                           <?php echo $row['itemname']; ?> 
                                          </option>
<?
}
echo '</select>';
echo '</div>';
?>