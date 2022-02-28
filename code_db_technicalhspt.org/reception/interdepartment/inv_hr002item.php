<?php
 include 'globalfile.php';
?>
<script type="text/javascript">
$(document).ready(function () {

    (function ($) {

        $('#filter').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});
</script>

<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div class="input-group"> <span class="input-group-addon">Filter</span>
  <input id="filter" type="text" class="form-control" placeholder="Search here...">
</div>
 <div class="panel panel-primary">
  <div class="panel-heading  text-center">
        <h3 class="panel-title">VIEW-ITEM</h3>
<div class="pull-right">
                <a href="inv_hc002item.php" class="btn btn-default">CONFIG</a>
            </div>
  </div>
 <div class="panel-body">

<div id="divToPrint" >
<div class="container">
<!--
<p><label for="search"><strong>Enter keyword to search </strong></label><input type="text" id="search"/></p>!-->


<?php
$xQry='';
$xSlNo=0;
$xQryFilter='';
 if (isSet($_POST['save'])) 
    {
      $xItemCategoryNo= $_POST['f_itemcategoryno'];
      $xItemGroupNo= $_POST['f_itemgroupno'];
      $xItemSubGroupNo= $_POST['f_itemsubgroupno'];
      $xStockPointNo= $_POST['f_stockpointno'];
      $xQry = "update config_inventory set categoryno=$xItemCategoryNo,groupno=$xItemGroupNo,subgroupno=$xItemSubGroupNo,stockpointno=$xStockPointNo";
      mysql_query($xQry);
      header('Location: inv_hr002item.php');
    }
else
{
$xItemCategoryNo=$GLOBALS ['xItemCategoryNo'];
$xItemGroupNo=$GLOBALS ['xItemGroupNo'];
$xItemSubGroupNo=$GLOBALS ['xItemSubGroupNo'];
$xStockPointNo=$GLOBALS ['xStockPointNo'];
}

if($xItemCategoryNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and itemcategoryno=$xItemCategoryNo";
}

if($xItemGroupNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and itemgroupno=$xItemGroupNo";
}

if($xItemSubGroupNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and itemsubgroupno=$xItemSubGroupNo";
}
if($xStockPointNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and stockpointno=$xStockPointNo";
}

/* View Amc Enable Records Only */

if($GLOBALS ['xViewAmcOnly']  == 0)
 {
  $xQryFilter= $xQryFilter. ' ' . " and amcrequired='Yes'";
 }


$xQry="SELECT *  from m_item where itemname!=''"; 
$xQry.= $xQryFilter. ' ' . "ORDER BY LENGTH(itemname),itemname;";
//$xQry.= $xQryFilter. ' ' . "ORDER BY itemname;";
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 
?>
<table class="table table-striped  table-bordered "  border="1">
      <thead>
<?php
    findstockpointname($xStockPointNo);
    finditemcategoryname($xItemCategoryNo);
    finditemgroupname($xItemGroupNo);
    finditemsubgroupname($xItemSubGroupNo);
    echo '<tr>';
    echo '<td colspan=6> StockPoint -[' . $GLOBALS ['xStockPointName']. '] Category-[' . $GLOBALS ['xItemCategoryName']. ']Group-[' . $GLOBALS ['xItemGroupName']. ']Items</td>';
    echo '</tr>';
?>
        <tr>
           <th> S.NO</th>
           <th> ITEM NAME</th>
          <?php if($GLOBALS ['xViewStockPoint']  == 0){ ?>        <th> STOCKPOINT</th> <? } ?>
          <?php if($GLOBALS ['xViewCategory']  == 0){ ?>          <th> CATEGORY</th> <? } ?>
          <?php if($GLOBALS ['xViewGroup']  == 0){ ?>             <th> GROUP</th> <? } ?>
          <?php if($GLOBALS ['xViewSubGroup']  == 0){ ?>          <th> SUBGROUP</th> <? } ?>
          <?php if($GLOBALS ['xViewBrandNo']  == 0){ ?>           <th> BRANDNAME</th> <? } ?>
          <?php if($GLOBALS ['xViewModelNo']  == 0){ ?>           <th> MODELNO</th> <? } ?>
          <?php if($GLOBALS ['xViewSerialNo']  == 0){ ?>          <th> SERIALNO</th> <? } ?>
          <?php if($GLOBALS ['xViewFunctionOfWorks']  == 0){ ?>   <th> WORKFUNCTIONS</th> <? } ?>
          <?php if($GLOBALS ['xViewAccessories']  == 0){ ?>       <th> ACCESSORIES</th> <? } ?>
          <?php if($GLOBALS ['xViewConditions']  == 0){ ?>        <th> CONDITIONS</th> <? } ?>
          <?php if($GLOBALS ['xViewRemarks']  == 0){ ?>           <th> REMARKS</th> <? } ?>
           <th colspan="2"> ACTIONS</th>
        </tr>
      </thead>

      <tbody class="searchable">
<?php
while ($row = mysql_fetch_array($result2)) {
    $xSlNo+=1;
    findstockpointname($row['stockpointno']);
    finditemcategoryname($row['itemcategoryno']);
    finditemgroupname($row['itemgroupno']);
    finditemsubgroupname($row['itemsubgroupno']);
    echo '<tr>';
    echo '<td>' . $xSlNo. '</td>';
    echo '<td>' . $row['itemname']  . '</td>';

    if($GLOBALS ['xViewStockPoint']  == 0){echo '<td>' . $GLOBALS ['xStockPointShortName']  . '</td>';    }
    if($GLOBALS ['xViewCategory']  == 0){echo '<td>' . $GLOBALS ['xItemCategoryShortName']  . '</td>';    }
    if($GLOBALS ['xViewGroup']  == 0){echo '<td>' . $GLOBALS ['xItemGroupName']  . '</td>';    }
    if($GLOBALS ['xViewSubGroup']  == 0){echo '<td>' . $GLOBALS ['xItemSubGroupName']  . '</td>';    }
    if($GLOBALS ['xViewBrandNo']  == 0){echo '<td>' . $row['brandname']   . '</td>';    }
    if($GLOBALS ['xViewModelNo']  == 0){echo '<td>' . $row['modelno']  . '</td>';    }
    if($GLOBALS ['xViewSerialNo']  == 0){echo '<td>' . $row['serialno']  . '</td>';    }
    if($GLOBALS ['xViewFunctionOfWorks']  == 0){echo '<td>' . $row['functionofworks']  . '</td>';    }
    if($GLOBALS ['xViewAccessories']  == 0){echo '<td>' . $row['accessories']  . '</td>';    }
    if($GLOBALS ['xViewConditions']  == 0){echo '<td>' . $row['conditions']  . '</td>';    }
    if($GLOBALS ['xViewRemarks']  == 0){echo '<td>' . $row['remarks']  . '</td>';    }
   
?>
<td><a href="inv_hm005item.php<?php echo '?itemno='.$row['itemno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="inv_hm005item.php<?php echo '?itemno='.$row['itemno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

<?
echo '</tr>'; 
}
  
?>	
</tbody>
    </table>	
  </div><!-- /container -->
</div>
</div>
</div>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->