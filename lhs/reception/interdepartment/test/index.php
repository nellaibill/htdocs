<?php
require("configure.php");
?>
<!DOCTYPE html>
<html>
    <body>
        <div id="container">
            <div id="body">
               
                                <?php
                                $sql = "SELECT * FROM m_itemcategory";
                                try {
                                    $stmt = $DB->prepare($sql);
                                    $stmt->execute();
                                    $results = $stmt->fetchAll();
                                } catch (Exception $ex) {
                                    echo($ex->getMessage());
                                }
                                ?>
                                <label>Category:
                                    <select name="f_categoryno" onChange="showGroup(this);">
                                        <option value="">Choose Category</option>
                                        <?php foreach ($results as $rs) { ?>
                                            <option value="<?php echo $rs["itemcategoryno"]; ?>"><?php echo $rs["itemcategoryname"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </label>
                       <div id="output1"> <?php
                                $sql = "SELECT * FROM m_itemgroup";
                                try {
                                    $stmt = $DB->prepare($sql);
                                    $stmt->execute();
                                    $results = $stmt->fetchAll();
                                } catch (Exception $ex) {
                                    echo($ex->getMessage());
                                }
                                ?>
                                <label>Group:
                                    <select name="f_groupno" onChange="showSubGroup(this);">
                                        <option value="">Choose Group</option>
                                        <?php foreach ($results as $rs) { ?>
                                            <option value="<?php echo $rs["itemgroupno"]; ?>"><?php echo $rs["itemgroupname"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </label>
                        </div>
                      <div id="output2">
                             <?php
                                $sql = "SELECT * FROM m_itemsubgroup";
                                try {
                                    $stmt = $DB->prepare($sql);
                                    $stmt->execute();
                                    $results = $stmt->fetchAll();
                                } catch (Exception $ex) {
                                    echo($ex->getMessage());
                                }
                                ?>
                                <label>Sub-Group:
                                    <select name="f_subgroupno">
                                        <option value="">Choose Sub-Group</option>
                                        <?php foreach ($results as $rs) { ?>
                                            <option value="<?php echo $rs["itemsubgroupno"]; ?>"><?php echo $rs["itemsubgroupname"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </label></div>
              

                            <!-- Place this tag after the last widget tag. -->
                            <script type="text/javascript">
                                (function() {
                                    var po = document.createElement('script');
                                    po.type = 'text/javascript';
                                    po.async = true;
                                    po.src = 'https://apis.google.com/js/platform.js';
                                    var s = document.getElementsByTagName('script')[0];
                                    s.parentNode.insertBefore(po, s);
                                })();
                            </script>
                        </div>
                       
                    </div>
              
        </div>
        <script src="jquery-1.9.0.min.js"></script>
        <script>
                    function showGroup(sel) {
                        var itemcategoryid = sel.options[sel.selectedIndex].value;
                        $("#output1").html("");
                        $("#output2").html("");
                        if (itemcategoryid.length > 0) {

                            $.ajax({
                                type: "POST",
                                url: "fetch_group.php",
                                data: "itemcategoryid=" + itemcategoryid,
                                cache: false,
                                beforeSend: function() {
                                    $('#output1').html('<img src="loader.gif" alt="" width="24" height="24">');
                                },
                                success: function(html) {
                                    $("#output1").html(html);
                                }
                            });
                        }
                    }

                    function showSubGroup(sel) {
                        var groupid = sel.options[sel.selectedIndex].value;
                        if (groupid.length > 0) {
                            $.ajax({
                                type: "POST",
                                url: "fetch_subgroup.php",
                                data: "groupid=" + groupid,
                                cache: false,
                                beforeSend: function() {
                                    $('#output2').html('<img src="loader.gif" alt="" width="24" height="24">');
                                },
                                success: function(html) {
                                    $("#output2").html(html);
                                }
                            });
                        } else {
                            $("#output2").html("");
                        }
                    }
        </script>
    </body>
</html>
