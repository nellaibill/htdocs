<?php
fn_DataClear();
include 'globalfile.php';
getconfig_item();
if (isset($_GET ['itemgroupno']) && !empty($_GET ['itemgroupno'])) {
    $GLOBALS ['xItemGroupNo'] = $_GET ['itemgroupno'];
}
if (isset($_GET ['itemno']) && !empty($_GET ['itemno'])) {
    $no = $_GET ['itemno'];
    if ($_GET ['xmode'] == 'edit') {
        $GLOBALS ['xMode'] = 'F';
        DataFetch($_GET ['itemno']);
    } else {
        $xItemNo = $_GET ['itemno'];
        $result = mysql_query("SELECT *  FROM inv_stockentry 
			where itemno= " . $xItemNo) or die(mysql_error());
        while ($row = mysql_fetch_array($result)) {
            $GLOBALS ['xCurrentStock'] = $row ['stock'];
        }
        $xCurrentStock = $GLOBALS ['xCurrentStock'];
        if ($xCurrentStock == 0) {
            $xQry = "DELETE FROM inv_stockentry WHERE itemno= $no";
            $result = mysql_query($xQry);
            $xQry = "DELETE FROM m_item WHERE itemno= $no";
            $result = mysql_query($xQry);
            if (!$result) {
                die('This Item is Referring to Some Where Else');
            }
            header('Location: inv_hm005item.php');
        } else {
            echo '<script type="text/javascript">swal("Stock  ! ", "Stock Available on this item you cannot delete..", "error");</script>';
        }
    }
} else {
    GetMaxIdNo();
}
$GLOBALS ['xCurrentDate'] = date('Y-m-d H:i:s');

if (isset($_POST ['save'])) {
    DataProcess("S");
} elseif (isset($_POST ['update'])) {
    DataProcess("U");
}

function fn_DataClear() {
    $GLOBALS ['xStockNo'] = '';
    $GLOBALS ['xItemNo'] = '';
    $GLOBALS ['xStockPointNo'] = '';
    $GLOBALS ['xItemCategoryNo'] = '';
    $GLOBALS ['xItemGroupNo'] = '';
    $GLOBALS ['xItemSubGroupNo'] = '';

    $GLOBALS ['xItemName'] = '';
    $GLOBALS ['xItemDescription'] = '';
    $GLOBALS ['xHSNCode'] = '';
    $GLOBALS ['xPackNo'] = 1;
    $GLOBALS ['xPackDescription'] = '';
    $GLOBALS ['xGst'] = '';
    $GLOBALS ['xRackName'] = '';
    $GLOBALS ['xRowName'] = '';
    $GLOBALS ['xMinStock'] = 0;

    $GLOBALS ['xBarCode'] = '';
    $GLOBALS ['xColorForItem'] = 1;
    $GLOBALS ['xSizeForItem'] = 1;
    $GLOBALS ['xMrpForItem'] = 0;
    $GLOBALS ['xOriginalPriceForItem'] = 0;
    $GLOBALS ['xDiscountAmountForItem'] = 0;
    $GLOBALS ['xSupplierForItem'] = 1;
    $GLOBALS ['xManufacturerName'] = '';
}

function GetMaxIdNo() {
    $sql = "SELECT  CASE WHEN max(itemno)IS NULL OR max(itemno)= '' 
   THEN '1' 
   ELSE max(itemno)+1 END AS itemno
FROM m_item";
    $result = mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $GLOBALS ['xItemNo'] = $row ['itemno'];
        $GLOBALS ['xBarCode']=$row ['itemno'];
    }
}

function DataFetch($xItemNo) {
    $result = mysql_query("SELECT *  FROM m_item where itemno=$xItemNo") or die(mysql_error());
    $count = mysql_num_rows($result);
    if ($count > 0) {
        while ($row = mysql_fetch_array($result)) {

            $GLOBALS ['xItemNo'] = $row ['itemno'];
            $GLOBALS ['xStockPointNo'] = $row ['stockpointno'];
            $GLOBALS ['xItemGroupNo'] = $row ['itemgroupno'];

            $GLOBALS ['xItemName'] = $row ['itemname'];
            $GLOBALS ['xItemDescription'] = $row ['itemdescription'];
            $GLOBALS ['xHSNCode'] = $row ['hsncode'];
            $GLOBALS ['xPackNo'] = $row ['packno'];
            $GLOBALS ['xPackDescription'] = $row ['packdescription'];
            $GLOBALS ['xGst'] = $row ['gst'];
            $GLOBALS ['xRackName'] = $row ['rackname'];
            $GLOBALS ['xRowName'] = $row ['rowname'];
            $GLOBALS ['xMinStock'] = $row ['minstock'];

            $GLOBALS ['xBarCode'] = $row ['barcode'];
            $GLOBALS ['xColorForItem'] = $row ['color'];
            $GLOBALS ['xSizeForItem'] = $row ['size'];
            $GLOBALS ['xMrpForItem'] = $row ['mrp'];
            $GLOBALS ['xOriginalPriceForItem'] = $row ['originalprice'];
            $GLOBALS ['xDiscountAmountForItem'] = $row ['disamount'];
            $GLOBALS ['xSupplierForItem'] = $row ['supplierno'];
            $GLOBALS ['xManufacturerName'] = $row ['manufacturer_name'];
            	
        }
    }
}

function DataProcess($mode) {
    $xItemNo = $_POST ['f_itemno'];
    if (empty($_POST['f_stockpointno'])) {
        $xStockPointNo = '';
    } else
        $xStockPointNo = $_POST['f_stockpointno'];

    $xItemGroupNo = $_POST ['f_itemgroupno'];
    $xItemName = strtoupper($_POST ['f_itemname']);
    $xItemDescription = mysql_real_escape_string($_POST ['f_itemdescription']);
    $xHSNCode = $_POST ['f_hsncode'];
    $xGst = $_POST ['f_gst'];
    if (empty($_POST['f_packno'])) {
        $xPackNo = '';
    } else
        $xPackNo = $_POST['f_packno'];

    if (empty($_POST['f_packdescription'])) {
        $xPackDescription = '';
    } else
        $xPackDescription = $_POST['f_packdescription'];

    finditemgroupname($xItemGroupNo);
    $xItemCategoryNo = $GLOBALS ['xItemCategoryNo'];

    if (empty($_POST['f_rackname'])) {
        $xRackName = '';
    } else
        $xRackName = $_POST['f_rackname'];

    if (empty($_POST['f_rowname'])) {
        $xRowName = '';
    } else
        $xRowName = $_POST['f_rowname'];

    if (empty($_POST['f_minstock'])) {
        $xMinStock = 0;
    } else
        $xMinStock = $_POST['f_minstock'];

    if (empty($_POST['f_barcode'])) {
        $xBarCode = '';
    } else
        $xBarCode = $_POST['f_barcode'];



    if (empty($_POST['f_color'])) {
        $xItemColor = '';
    } else
        $xItemColor = $_POST['f_color'];

    if (empty($_POST['f_size'])) {
        $xItemSize = '';
    } else
        $xItemSize = $_POST['f_size'];

    if (empty($_POST['f_originalprice'])) {
        $xItemOriginalPrice = 0;
    } else
        $xItemOriginalPrice = $_POST['f_originalprice'];


    if (empty($_POST['f_mrp'])) {
        $xItemMrp = 0;
    } else
        $xItemMrp = $_POST['f_mrp'];

    if (empty($_POST['f_disamount'])) {
        $xItemDisAmount = 0;
    } else
        $xItemDisAmount = $_POST['f_disamount'];

    if (empty($_POST['f_supplierno'])) {
        $xItemSupplierNo = '';
    } else
        $xItemSupplierNo = $_POST['f_supplierno'];

        if (empty($_POST['f_manufacturer_name'])) {
            $xManufacturerName = '';
        } else
            $xManufacturerName = $_POST['f_manufacturer_name'];

    $xQry = "";
    $xMsg = "";
    if ($mode == 'S') {
        $xQry = "INSERT INTO m_item
		(itemno,stockpointno,itemcategoryno,itemgroupno,itemsubgroupno,itemname,
		itemdescription,hsncode,packno,packdescription,gst,rackname,rowname,minstock,barcode,
                color,size,originalprice,mrp,disamount,supplierno,manufacturer_name
                )  
		VALUES 
		($xItemNo,$xStockPointNo,$xItemCategoryNo,
		$xItemGroupNo,0,
		'$xItemName','$xItemDescription','$xHSNCode',
		$xPackNo,'$xPackDescription','$xGst','$xRackName','$xRowName',$xMinStock,'$xBarCode',
        '$xItemColor','$xItemSize',$xItemOriginalPrice,$xItemMrp,
        $xItemDisAmount,$xItemSupplierNo,'$xManufacturerName')";
       // echo $xQry;
        $retval = mysql_query($xQry) or die(mysql_error());

        if (!$retval) {
            die('Could not enter data: ' . mysql_error());
        } else {
            echo '<script type="text/javascript">swal("Good job!", "Inserted!", "success");</script>';
        }
    } elseif ($mode == 'U') {
        $xQry = "UPDATE m_item  
		 SET itemcategoryno=$xItemCategoryNo,
		itemgroupno=$xItemGroupNo,
		itemname='$xItemName',itemdescription='$xItemDescription',
		hsncode='$xHSNCode',gst='$xGst',
		packno=$xPackNo,packdescription='$xPackDescription',
                rackname='$xRackName',rowname='$xRowName',
                minstock=$xMinStock,barcode='$xBarCode',color='$xItemColor',
                size='$xItemSize',originalprice=$xItemOriginalPrice,mrp=$xItemMrp,
                disamount=$xItemDisAmount,supplierno=$xItemSupplierNo,
                manufacturer_name='$xManufacturerName'
                WHERE itemno=$xItemNo";
        //echo $xQry;
        $xMsg = "Updated";
        $retval = mysql_query($xQry) or die(mysql_error());
        if (!$retval) {
            die('Could not enter data: ' . mysql_error());
        } else {
            echo '<script type="text/javascript">swal("Good job!", "Updated!", "success");</script>';
            header('Location: inv_hm005item.php');
        }
    }

    GetMaxIdNo();
    // ShowAlert ( $xMsg );
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Item</title>
        <style type="text/css">

        </style>
    </head>

    <script type="text/javascript">
        function validateForm()
        {

            var xItemName = document.forms["itemform"]["f_itemname"].value;
            if (xItemName == null || xItemName == "")
            {
                alert("Item Name must be filled out");
                document.itemform.f_itemname.focus();
                return false;
            }
            var xGst = document.forms["itemform"]["f_gst"].value;
            if (xGst == null || xGst == "")
            {
                alert("Gst Percentage of this item to be filled out");
                document.itemform.f_gst.focus();
                return false;
            }
            var xPackNo = document.forms["itemform"]["f_packno"].value;
            if (xPackNo == null || xPackNo == "")
            {
                alert("Pack No must be filled out");
                document.itemform.f_packno.focus();
                return false;
            }
        }
    </script>
    <SCRIPT language=JavaScript src="js/tamil/common.js"></SCRIPT>
    <SCRIPT language=JavaScript src="js/tamil/tamil.js"></SCRIPT>
    <body onload='document.itemform.f_itemname.focus()'>
        <form class="form" name="itemform"
              action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="panel panel-primary">
                <div class="panel-heading  text-center">
                    <h3 class="panel-title">MASTER -ITEM
                        <a href="config_item.php"  class=" btn btn-danger"
                           onclick="basicPopup(this.href);
                                   return false">CONFIGURATION</a></h3>

                </div>
                <div class="panel-body">
                    <div class="col-xs-2" style="display: none;">
                        <input type="text" class="form-control" id="f_itemno"
                               name="f_itemno" value="<?php echo $GLOBALS ['xItemNo']; ?>"
                               readonly>
                    </div>
                    <div class="col-xs-3" style="display: none;">
                        <label>StockPoint:</label> <select class="form-control"
                                                           name="f_stockpointno">
                                                               <?php
                                                               $result = mysql_query("SELECT *  FROM m_stockpoint order by stockpointname");
                                                               while ($row = mysql_fetch_array($result)) {
                                                                   ?>
                                <option value="<?php echo $row['stockpointno']; ?>"
                                <?php
                                if ($row ['stockpointno'] == $GLOBALS ['xStockPointNo']) {
                                    echo 'selected="selected"';
                                }
                                ?>>
                                            <?php echo $row['stockpointname']; ?> 
                                </option>
                                <?php
                            }
                            ?>
                        </select>



                    </div>




                    <?php
                    if ($GLOBALS ['xConfigItem_Group'] == 'Yes') {
                        echo "<div class=col-xs-3>";
                        ?>

                    <?php } else { ?>
                        <div class="col-xs-3" style="display: none;">
                        <?php } ?>
                        <label>Group:</label> <select class="form-control"
                                                      name="f_itemgroupno">
                                                          <?php
                                                          $result = mysql_query("SELECT *  FROM m_itemgroup order by itemgroupname");
                                                          while ($row = mysql_fetch_array($result)) {
                                                              ?>
                                <option value="<?php echo $row['itemgroupno']; ?>"
                                <?php
                                if ($row ['itemgroupno'] == $GLOBALS ['xItemGroupNo']) {
                                    echo 'selected="selected"';
                                }
                                ?>>
                                            <?php echo $row['itemgroupname']; ?> 
                                </option>
                                <?php
                            }
                            ?>
                        </select>



                    </div>
                    <?php
                    if ($GLOBALS ['xConfigItem_TypeTamil'] == 'Yes') {
                        ?>
                        <div class="col-xs-4">
                            <label>ItemName:</label> <input type="text" class="form-control" onKeyDown="toggleKBMode(event)" onKeyPress="javascript:convertThis(event)"
                                                            name="f_itemname" value="<?php echo $GLOBALS ['xItemName']; ?>">
                        </div>
                    <?php } else { ?>
                        <div class="col-xs-4">
                            <label>ItemName:</label> <input type="text" class="form-control" 
                                                            name="f_itemname" value="<?php echo $GLOBALS ['xItemName']; ?>">
                        </div>
                    <?php } ?>

                    <div style="display: none">
                        <textarea name="comment" charset="utf-8" onKeyDown="toggleKBMode(event)" onKeyPress="javascript:convertThis(event)"></textarea>
                        <input type=radio name=keybrd value=roman onclick="toggleKBMode(event, this)" >
                        Phonetic <br>
                        <input type=radio name=keybrd value=typewriter onclick="toggleKBMode(event, this)">
                        Tamil Typewriter<br> 
                        <input type=radio name=keybrd value=tamil99 onclick="toggleKBMode(event, this)"> Tamil 99 <br>

                        <input type=radio name=keybrd value=bamini onclick="toggleKBMode(event, this)" checked> Bamini <br>

                        <input type=radio name=keybrd value=vaanavil onclick="toggleKBMode(event, this)"> Vaanavil <br>

                        <input type=radio name=keybrd value=modular onclick="toggleKBMode(event, this)"> Modular <br>
                        <input type=checkbox onclick="showMap(this)"> Show Keymap<br>
                        <input type=checkbox onclick="showHelp(this)" checked="true"> Online Keymap Help<br>

                    </div>


                    <?php
                    if ($GLOBALS ['xConfigItem_ItemDescription'] == 'Yes') {
                        echo "<div class=col-xs-3>";
                        ?>

                    <?php } else { ?>
                        <div class="col-xs-3" style="display: none;">
                        <?php } ?>
                        <label>ItemDescription:</label> 
                        <input type="text" class="form-control"
                               name="f_itemdescription" id="f_itemdescription" value="<?php echo $GLOBALS ['xItemDescription']; ?>">





                    </div>



                    <?php
                    if ($GLOBALS ['xConfigItem_HsnCode'] == 'Yes') {
                        echo "<div class=col-xs-2>";
                        ?>

                    <?php } else { ?>
                        <div class="col-xs-2" style="display: none;">
                        <?php } ?>
                        <label>HSNCODE:</label> <input type="text" class="form-control"
                                                       name="f_hsncode" value="<?php echo $GLOBALS ['xHSNCode']; ?>">
                    </div>



                    <?php
                    if ($GLOBALS ['xConfigItem_Gst'] == 'Yes') {
                        echo "<div class=col-xs-2>";
                        ?>

                    <?php } else { ?>
                        <div class="col-xs-2" style="display: none;">
                        <?php } ?>
                        <label>GST:</label> <input type="number" class="form-control"
                                                   name="f_gst" value="<?php echo $GLOBALS ['xGst']; ?>">
                    </div>



                    <?php
                    if ($GLOBALS ['xConfigItem_PackNo'] == 'Yes') {
                        echo "<div class=col-xs-2>";
                        ?>

                    <?php } else { ?>
                        <div class="col-xs-2" style="display: none;">
                        <?php } ?>
                        <label>Pack No:</label> <input type="text" class="form-control"
                                                       name="f_packno" value="<?php echo $GLOBALS ['xPackNo']; ?>">
                    </div>


                    <?php
                    if ($GLOBALS ['xConfigItem_PackDescription'] == 'Yes') {
                        echo "<div class=col-xs-2>";
                        ?>

                    <?php } else { ?>
                        <div class="col-xs-2" style="display: none;">
                        <?php } ?>
                        <label>Pack Description:</label> <select class="form-control"
                                                                 name="f_packdescription">
                                                                     <?php
                                                                     $result = mysql_query("SELECT *  FROM m_unit order by unitname");
                                                                     while ($row = mysql_fetch_array($result)) {
                                                                         ?>
                                <option value="<?php echo $row['unitname']; ?>"
                                <?php
                                if ($row ['unitname'] == $GLOBALS ['xPackDescription']) {
                                    echo 'selected="selected"';
                                }
                                ?>>
                                            <?php echo $row['unitname']; ?> 
                                </option>
                                <?php
                            }
                            ?>
                        </select>

                    </div>
                    <?php
                    if ($GLOBALS ['xConfigItem_Rack'] == 'Yes') {
                        echo "<div class=col-xs-2>";
                        ?>

                    <?php } else { ?>
                        <div class="col-xs-2" style="display: none;">
                        <?php } ?>
                        <label>Rack Name:</label> <input type="text" class="form-control"
                                                         name="f_rackname" value="<?php echo $GLOBALS ['xRackName']; ?>">
                    </div>
                    <?php
                    if ($GLOBALS ['xConfigItem_Row'] == 'Yes') {
                        echo "<div class=col-xs-2>";
                        ?>

                    <?php } else { ?>
                        <div class="col-xs-2" style="display: none;">
                        <?php } ?>
                        <label>Row No:</label> <input type="text" class="form-control"
                                                      name="f_rowname" value="<?php echo $GLOBALS ['xRowName']; ?>">
                    </div>
                    <?php
                    if ($GLOBALS ['xConfigItem_MinStock'] == 'Yes') {
                        echo "<div class=col-xs-2>";
                        ?>

                    <?php } else { ?>
                        <div class="col-xs-2" style="display: none;">
                        <?php } ?>
                        <label>Min Stock:</label> <input type="text" class="form-control"
                                                         name="f_minstock" value="<?php echo $GLOBALS ['xMinStock']; ?>">
                    </div>
                    <?php
                    if ($GLOBALS ['xConfigItem_BarCode'] == 'Yes') {
                        echo "<div class=col-xs-2>";
                        ?>

                    <?php } else { ?>
                        <div class="col-xs-2" style="display: none;">
                        <?php } ?>
                        <label> BarCode</label>
                        <input type="text" class="form-control"
                               name="f_barcode" value="<?php echo $GLOBALS ['xBarCode']; ?>" readonly>
                    </div>
                    <?php
                    if ($GLOBALS ['xConfigItem_Color'] == 'Yes') {
                        echo "<div class=col-xs-2>";
                        ?>

                    <?php } else { ?>
                        <div class="col-xs-2" style="display: none;">
                        <?php } ?>
                        <label>Color:</label> <select class="form-control" name="f_color">
                            <?php
                            $result = mysql_query("SELECT *  FROM m_color");
                            while ($row = mysql_fetch_array($result)) {
                                ?>
                                <option value="<?php echo $row['colorno']; ?>"
                                <?php
                                if ($row ['colorno'] == $GLOBALS ['xColorForItem']) {
                                    echo 'selected="selected"';
                                }
                                ?>>
                                            <?php echo $row['colorname'] ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>

                    </div>

                    <?php
                    if ($GLOBALS ['xConfigItem_Size'] == 'Yes') {
                        echo "<div class=col-xs-2>";
                        ?>

                    <?php } else { ?>
                        <div class="col-xs-2" style="display: none;">
                        <?php } ?>
                        <label>Size:</label> 
                        <select class="form-control" name="f_size">
                            <?php
                            $result = mysql_query("SELECT *  FROM m_size");
                            while ($row = mysql_fetch_array($result)) {
                                ?>
                                <option value="<?php echo $row['sizeno']; ?>"
                                <?php
                                if ($row ['sizeno'] == $GLOBALS ['xSizeForItem']) {
                                    echo 'selected="selected"';
                                }
                                ?>>
                                            <?php echo $row['sizename'] ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                    if ($GLOBALS ['xConfigItem_OriginalPrice'] == 'Yes') {
                        echo "<div class=col-xs-2>";
                        ?>

                    <?php } else { ?>
                        <div class="col-xs-2" style="display: none;">
                        <?php } ?>
                        <label>Original Price:</label> <input type="text" class="form-control"
                                                              name="f_originalprice"
                                                              value="<?php echo $GLOBALS ['xOriginalPriceForItem']; ?>"
                                                              >
                    </div>
                    <?php
                    if ($GLOBALS ['xConfigItem_Mrp'] == 'Yes') {
                        echo "<div class=col-xs-2>";
                        ?>

                    <?php } else { ?>
                        <div class="col-xs-2" style="display: none;">
                        <?php } ?>
                        <label>Mrp:</label> <input type="text" class="form-control"
                                                   name="f_mrp" value="<?php echo $GLOBALS ['xMrpForItem']; ?>"
                                                   >
                    </div>


                    <?php
                    if ($GLOBALS ['xConfigItem_DisAmount'] == 'Yes') {
                        echo "<div class=col-xs-2>";
                        ?>

                    <?php } else { ?>
                        <div class="col-xs-2" style="display: none;">
                        <?php } ?>
                        <label>Dis Amount:</label> <input type="text" class="form-control"
                                                          name="f_disamount" 
                                                          value="<?php echo $GLOBALS ['xDiscountAmountForItem']; ?>">
                    </div>
                    <?php
                    if ($GLOBALS ['xConfigItem_SupplierNo'] == 'Yes') {
                        echo "<div class=col-xs-2>";
                        ?>

                    <?php } else { ?>
                        <div class="col-xs-2" style="display: none;">
                        <?php } ?>
                        <label>Supplier Name</label> <select class="form-control"
                                                             name="f_supplierno">
                                                                 <?php
                                                                 $result = mysql_query("SELECT *  FROM account_ledger
		where ledger_undergroup_no=4 
		order by ledger_name");
                                                                 while ($row = mysql_fetch_array($result)) {
                                                                     ?>
                                <option value="<?php echo $row['account_ledger_id']; ?>"
                                <?php
                                if ($row ['account_ledger_id'] == $GLOBALS ['xSupplierNo']) {
                                    echo 'selected="selected"';
                                }
                                ?>>

                                    <?php echo $row['ledger_name']; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    
                    </div>
                    <div class="col-xs-4" >
                    <label>Manufacturer Name</label> 
                        <input type="text" class="form-control" id="f_manufacturer_name"
                               name="f_manufacturer_name" value="<?php echo $GLOBALS ['xManufacturerName']; ?>"
                               >
                    </div>

                </div>
            </div>
            <!-- PANEL BODY !-->
            <div class="panel-footer clearfix">
                <div class="pull-right">
                    <?php if ($GLOBALS ['xMode'] == "") { ?> 
                        <input type="submit" name="save" class="btn btn-primary"
                               value="SAVE" id="save" accesskey="s"
                               onclick="return validateForm()"> 
                           <?php } else { ?>
                        <input type="submit" name="update" class="btn btn-primary"
                               value="UPDATE" accesskey="s" onclick="return validateForm()"> 
                           <?php } ?>
                </div>
            </div>

        </div>
        <!-- PANEL !-->
    </form>

    <!--             ----------------------- REPORT GOES HERE  ------------------------  !-->

    <div id="divToPrint">
        <input id="filter" type="text" class="col-xs-8"
               placeholder="Search here...">
        <table border="1" class="table">
            <thead>
                <tr>
                    <?php
                    if ($GLOBALS ['xConfigItem_Group'] == 'Yes') {
                        ?>
                        <th width="20%">Group</th>
                    <?php } ?>

                    <th width="20%">Item Name</th>
                    <?php
                    if ($GLOBALS ['xConfigItem_ItemDescription'] == 'Yes') {
                        ?>
                        <th width="15%">Item-Details</th>
                    <?php } ?>


                    <th width="20%">HSNCODE</th>
                    <th width="5%">GST</th>
                    <th width="5%">Stock</th>

                    <?php
                    if ($GLOBALS ['xConfigItem_Rack'] == 'Yes') {
                        ?>
                        <th width="10%">Rack</th>
                    <?php } ?>

                    <?php
                    if ($GLOBALS ['xConfigItem_Row'] == 'Yes') {
                        ?>
                        <th width="10%">Row</th>
                    <?php } ?>


                    <?php
                    if ($GLOBALS ['xConfigItem_MinStock'] == 'Yes') {
                        ?>
                        <th width="10%">Min</th>
                    <?php } ?>


                    <?php
                    if ($GLOBALS ['xConfigItem_PackNo'] == 'Yes') {
                        ?>
                        <th width="10%">Packing</th>
                    <?php } ?>

                    <?php
                    if ($GLOBALS ['xConfigItem_BarCode'] == 'Yes') {
                        ?>
                        <th width="10%">BarCode</th>
                        <th width="10%">Color</th>
                        <th width="10%">Size</th>
                        <th width="10%">Price</th>
                        <th width="10%">MRP</th>
                        <th width="10%">DisAmount</th>
                        <th width="10%">SupplierName</th>
                    <?php } ?>
                    <th width="10%">ManufacturerName</th>
                    <th width="10%" colspan=2>DELETE</th>     
                </tr>
            </thead>
            <tbody class="searchable">

                <?php

                function fn_FindCurrentStock($xItemNo) {
                    $xCurrentStock = '';
                    $xQry = "select stock from inv_stockentry where  itemno=$xItemNo";
                    $result = mysql_query($xQry) or die(mysql_error());
                    while ($row = mysql_fetch_array($result)) {
                        $xCurrentStock = $row ['stock'];
                    }
                    return $xCurrentStock;
                }

                $xQry = '';
                if (isset($_GET ['itemgroupno']) && !empty($_GET ['itemgroupno'])) {
                    $xItemGroupNo = $_GET ['itemgroupno'];
                    $xQry = "SELECT *  from m_item where itemgroupno= $xItemGroupNo order by  itemname";
                } else {
                    $xQry = "SELECT *  from m_item order by itemname";
                }
			
                $result2 = mysql_query($xQry);
                echo '</br>';

                while ($row = mysql_fetch_array($result2)) {
              echo '<tr>';
                            finditemcategoryname($row ['itemcategoryno']);
                            finditemgroupname($row ['itemgroupno']);
                            finditemsubgroupname($row ['itemsubgroupno']);

                            if ($GLOBALS ['xConfigItem_Group'] == 'Yes') {
                                echo '<td>' . $GLOBALS ['xItemGroupName'] . '</td>';
                            }

                            echo '<td>' . $row ['itemname'] . '</td>';

                            if ($GLOBALS ['xConfigItem_ItemDescription'] == 'Yes') {
                                echo '<td>' . $row ['itemdescription'] . '</td>';
                            }

                            echo '<td>' . $row ['hsncode'] . '</td>';

                            echo '<td>' . $row ['gst'] . '</td>';

                            echo '<td>' . fn_FindCurrentStock($row ['itemno']) . '</td>';

                            if ($GLOBALS ['xConfigItem_Rack'] == 'Yes') {
                                echo '<td>' . $row ['rackname'] . '</td>';
                            }

                            if ($GLOBALS ['xConfigItem_Row'] == 'Yes') {
                                echo '<td>' . $row ['rowname'] . '</td>';
                            }

                            if ($GLOBALS ['xConfigItem_MinStock'] == 'Yes') {
                                echo '<td>' . $row ['minstock'] . '</td>';
                            }

                            if ($GLOBALS ['xConfigItem_PackNo'] == 'Yes') {
                                echo '<td>' . $row ['packno'] . " - " . $row ['packdescription'] . '</td>';
                            }
                            findsuppliername($row ['supplierno']);
                            if ($GLOBALS ['xConfigItem_BarCode'] == 'Yes') {
                                echo '<td>' . $row ['barcode'] . '</td>';
								fn_FindColorName( $row ['color']);
								 echo '<td>' . $GLOBALS ['xColorName'] . '</td>';
                                 fn_FindSizeName($row ['size'] );
                                echo '<td>' . $GLOBALS ['xSizeName'] . '</td>';
                                echo '<td>' . $row ['originalprice'] . '</td>';
                                echo '<td>' . $row ['mrp'] . '</td>';
                                echo '<td>' . $row ['disamount'] . '</td>';
                                echo '<td>' . $GLOBALS ['xSupplierName'] . '</td>';
                            }
                            echo '<td>' .  $row ['manufacturer_name'] . '</td>';
                          if ($xRole == 'A') { ?>
                        <td><a class="btn btn-danger" href="inv_hm005item.php<?php echo '?itemno=' . $row['itemno'] . '&xmode=edit'; ?>"
                               onclick="return confirm_edit()"> EDIT
                            </a></td>
                  <td><a class="btn btn-danger" href="inv_hm005item.php<?php echo '?itemno=' . $row['itemno'] . '&xmode=delete'; ?>"
                               onclick="return confirm_delete()"> DELETE
                            </a></td>
                        <?php
								  }
                        echo '</tr>';
                    }
                    ?>	
            </tbody>
        </table>
    </div>
</body>
</html>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
