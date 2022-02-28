<?php
include 'globalfile.php';
getconfig_item();


if (isset($_POST ['save'])) {
    $xConfigItemNo = $_POST ['f_config_itemno'];
    $xConfigItemDescription = $_POST ['f_config_itemdescription'];
    $xConfigItemHsnCode = $_POST ['f_hsncode'];
    $xConfigItemGst = $_POST ['f_gst'];
    $xConfigItemRack = $_POST ['f_rack'];
    $xConfigItemRow = $_POST ['f_row'];
    $xConfigItemMinstock = $_POST ['f_minstock'];
    
    $xConfigItemPackNo = $_POST ['f_configitem_packno'];
    $xConfigItemPackDescription = $_POST ['f_configitem_packdescription'];
    $xConfigItemBarCode = $_POST ['f_configitem_barcode'];
    $xConfigItemColor = $_POST ['f_configitem_color'];
    $xConfigItemSize = $_POST ['f_configitem_size'];
    $xConfigItemOP = $_POST ['f_configitem_originalprice'];
    $xConfigItemMrp = $_POST ['f_configitem_mrp'];
    $xConfigItemDisAmount = $_POST ['f_configitem_disamount'];
    $xConfigItemSupplierNo = $_POST ['f_configitem_supplierno'];
    $xConfigItemTypeTamil = $_POST ['f_configitem_typetamil'];
    

    $xQry = "update config_item set itemno='$xConfigItemNo',"
            . "itemdescription='$xConfigItemDescription' ,"
            . "hsncode='$xConfigItemHsnCode',"
            . "gst='$xConfigItemGst',"
            . "rack='$xConfigItemRack',"
            . "row='$xConfigItemRow',"
            . "minstock='$xConfigItemMinstock',packno='$xConfigItemPackNo',"
            . "packdescription='$xConfigItemPackDescription',"
            . "barcode='$xConfigItemBarCode',"
            . "color='$xConfigItemColor',"
            . "size='$xConfigItemSize',originalprice='$xConfigItemOP',"
            . "mrp='$xConfigItemMrp',disamount='$xConfigItemDisAmount',"
            . "supplierno='$xConfigItemSupplierNo',typetamil='$xConfigItemTypeTamil'"
            . "where config_item_id=1";

    mysql_query($xQry);
    echo  "<script type='text/javascript'>";
echo "window.close();";
echo "</script>";
    getconfig_item();
}
?>
<html>

    <title>Sales Configuration</title>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <div class="panel panel-primary">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Item
                        Configuration</h4>
                    <div class="btn-group pull-right">
                        <a href="#" class="btn btn-default btn-sm" onclick="window.close()">Close</a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">


                        <div class="col-xs-3">
                            <label>Item No</label> <select class="form-control"
                                                           name="f_config_itemno">
                                <option value="Yes"
                                        <?php if ($GLOBALS ['xConfigItem_ItemNo'] == "Yes") echo 'selected="selected"'; ?>>Yes</option>
                                <option value="No"
                                        <?php if ($GLOBALS ['xConfigItem_ItemNo'] == "No") echo 'selected="selected"'; ?>>No</option>

                            </select>
                        </div>

                        <div class="col-xs-3">  
                            <label>Item Descrption</label> <select class="form-control"
                                                                   name="f_config_itemdescription">
                                <option value="Yes"
                                        <?php if ($GLOBALS ['xConfigItem_ItemDescription'] == "Yes") echo 'selected="selected"'; ?>>Yes</option>
                                <option value="No"
                                        <?php if ($GLOBALS ['xConfigItem_ItemDescription'] == "No") echo 'selected="selected"'; ?>>No</option>

                            </select>
                        </div>

                        <div class="col-xs-3">  
                            <label>HSN CODE</label> <select class="form-control"
                                                            name="f_hsncode">
                                <option value="Yes"
                                        <?php if ($GLOBALS ['xConfigItem_HsnCode'] == "Yes") echo 'selected="selected"'; ?>>Yes</option>
                                <option value="No"
                                        <?php if ($GLOBALS ['xConfigItem_HsnCode'] == "No") echo 'selected="selected"'; ?>>No</option>

                            </select>
                        </div>

                        <div class="col-xs-3">  
                            <label>GST</label> <select class="form-control"
                                                       name="f_gst">
                                <option value="Yes"
                                        <?php if ($GLOBALS ['xConfigItem_Gst'] == "Yes") echo 'selected="selected"'; ?>>Yes</option>
                                <option value="No"
                                        <?php if ($GLOBALS ['xConfigItem_Gst'] == "No") echo 'selected="selected"'; ?>>No</option>

                            </select>
                        </div>

                        <div class="col-xs-3">  
                            <label>RACK</label> <select class="form-control"
                                                        name="f_rack">
                                <option value="Yes"
                                        <?php if ($GLOBALS ['xConfigItem_Rack'] == "Yes") echo 'selected="selected"'; ?>>Yes</option>
                                <option value="No"
                                        <?php if ($GLOBALS ['xConfigItem_Rack'] == "No") echo 'selected="selected"'; ?>>No</option>

                            </select>
                        </div>


                        <div class="col-xs-3">  
                            <label>Row</label> <select class="form-control"
                                                       name="f_row">
                                <option value="Yes"
                                        <?php if ($GLOBALS ['xConfigItem_Row'] == "Yes") echo 'selected="selected"'; ?>>Yes</option>
                                <option value="No"
                                        <?php if ($GLOBALS ['xConfigItem_Row'] == "No") echo 'selected="selected"'; ?>>No</option>

                            </select>
                        </div>

                        <div class="col-xs-3">  
                            <label>Minstock</label> <select class="form-control"
                                                            name="f_minstock">
                                <option value="Yes"
                                        <?php if ($GLOBALS ['xConfigItem_MinStock'] == "Yes") echo 'selected="selected"'; ?>>Yes</option>
                                <option value="No"
                                        <?php if ($GLOBALS ['xConfigItem_MinStock'] == "No") echo 'selected="selected"'; ?>>No</option>

                            </select>
                        </div>
                        <div class="col-xs-3">  
                            <label>Pack No</label> <select class="form-control"
                                                           name="f_configitem_packno">
                                <option value="Yes"
                                        <?php if ($GLOBALS ['xConfigItem_PackNo'] == "Yes") echo 'selected="selected"'; ?>>Yes</option>
                                <option value="No"
                                        <?php if ($GLOBALS ['xConfigItem_PackNo'] == "No") echo 'selected="selected"'; ?>>No</option>

                            </select>
                        </div>

                        <div class="col-xs-3">  
                            <label>Pack Description</label> <select class="form-control"
                                                                    name="f_configitem_packdescription">
                                <option value="Yes"
                                        <?php if ($GLOBALS ['xConfigItem_PackDescription'] == "Yes") echo 'selected="selected"'; ?>>Yes</option>
                                <option value="No"
                                        <?php if ($GLOBALS ['xConfigItem_PackDescription'] == "No") echo 'selected="selected"'; ?>>No</option>

                            </select>
                        </div>

                        <div class="col-xs-3">  
                            <label>Barcode</label> <select class="form-control"
                                                           name="f_configitem_barcode">
                                <option value="Yes"
                                        <?php if ($GLOBALS ['xConfigItem_BarCode'] == "Yes") echo 'selected="selected"'; ?>>Yes</option>
                                <option value="No"
                                        <?php if ($GLOBALS ['xConfigItem_BarCode'] == "No") echo 'selected="selected"'; ?>>No</option>

                            </select>
                        </div>

                        <div class="col-xs-3">  
                            <label>Color</label> <select class="form-control"
                                                         name="f_configitem_color">
                                <option value="Yes"
                                        <?php if ($GLOBALS ['xConfigItem_Color'] == "Yes") echo 'selected="selected"'; ?>>Yes</option>
                                <option value="No"
                                        <?php if ($GLOBALS ['xConfigItem_Color'] == "No") echo 'selected="selected"'; ?>>No</option>

                            </select>
                        </div>

                        <div class="col-xs-3">  
                            <label>Size</label> <select class="form-control"
                                                        name="f_configitem_size">
                                <option value="Yes"
                                        <?php if ($GLOBALS ['xConfigItem_Size'] == "Yes") echo 'selected="selected"'; ?>>Yes</option>
                                <option value="No"
                                        <?php if ($GLOBALS ['xConfigItem_Size'] == "No") echo 'selected="selected"'; ?>>No</option>

                            </select>
                        </div>

                        <div class="col-xs-3">  
                            <label>Original Price</label> <select class="form-control"
                                                                  name="f_configitem_originalprice">
                                <option value="Yes"
                                        <?php if ($GLOBALS ['xConfigItem_OriginalPrice'] == "Yes") echo 'selected="selected"'; ?>>Yes</option>
                                <option value="No"
                                        <?php if ($GLOBALS ['xConfigItem_OriginalPrice'] == "No") echo 'selected="selected"'; ?>>No</option>

                            </select>
                        </div>

                        <div class="col-xs-3">  
                            <label>MRP</label> <select class="form-control"
                                                       name="f_configitem_mrp">
                                <option value="Yes"
                                        <?php if ($GLOBALS ['xConfigItem_Mrp'] == "Yes") echo 'selected="selected"'; ?>>Yes</option>
                                <option value="No"
                                        <?php if ($GLOBALS ['xConfigItem_Mrp'] == "No") echo 'selected="selected"'; ?>>No</option>

                            </select>
                        </div>


                        <div class="col-xs-3">  
                            <label>Dis Amount</label> <select class="form-control"
                                                              name="f_configitem_disamount">
                                <option value="Yes"
                                        <?php if ($GLOBALS ['xConfigItem_DisAmount'] == "Yes") echo 'selected="selected"'; ?>>Yes</option>
                                <option value="No"
                                        <?php if ($GLOBALS ['xConfigItem_DisAmount'] == "No") echo 'selected="selected"'; ?>>No</option>

                            </select>
                        </div>

                        <div class="col-xs-3">  
                            <label>Supplier No</label> <select class="form-control"
                                                               name="f_configitem_supplierno">
                                <option value="Yes"
                                        <?php if ($GLOBALS ['xConfigItem_SupplierNo'] == "Yes") echo 'selected="selected"'; ?>>Yes</option>
                                <option value="No"
                                        <?php if ($GLOBALS ['xConfigItem_SupplierNo'] == "No") echo 'selected="selected"'; ?>>No</option>

                            </select>
                        </div>
<div class="col-xs-3">  
                            <label>Item Name Tamil Typing</label> <select class="form-control"
                                                               name="f_configitem_typetamil">
                                <option value="Yes"
                                        <?php if ($GLOBALS ['xConfigItem_TypeTamil'] == "Yes") echo 'selected="selected"'; ?>>Yes</option>
                                <option value="No"
                                        <?php if ($GLOBALS ['xConfigItem_TypeTamil'] == "No") echo 'selected="selected"'; ?>>No</option>

                            </select>
                        </div>

                    </div>
                </div>
            </div>
            <div class="panel-footer clearfix">
                <div class="pull-right">
                    <input type="submit" name="save" class="btn btn-primary"
                           value="SAVE">
                </div>
            </div>
        </form>
    </body>
</html>