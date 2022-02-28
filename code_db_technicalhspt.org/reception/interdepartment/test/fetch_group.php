<?php

require("configure.php");
$xCategoryId = ($_REQUEST["itemcategoryid"] <> "") ? trim($_REQUEST["itemcategoryid"]) : "";
if ($xCategoryId <> "") {
    $sql = "SELECT * FROM m_itemgroup  WHERE itemcategoryno = :cid";
    try {
        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":cid", trim($xCategoryId));
        $stmt->execute();
        $results = $stmt->fetchAll();
    } catch (Exception $ex) {
        echo($ex->getMessage());
    }
    if (count($results) > 0) {
        ?>
        <label>Group: 
            <select name="f_itemgroupno" onchange="showSubGroup(this);">
                <option value="0">Choose Group</option>
                <?php foreach ($results as $rs) { ?>
                    <option value="<?php echo $rs["itemgroupno"]; ?>"><?php echo $rs["itemgroupname"]; ?></option>
                <?php } ?>
            </select>
        </label>
        <?php
    }
}
?>