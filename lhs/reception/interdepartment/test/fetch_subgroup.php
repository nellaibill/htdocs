<?php
require("configure.php");
$xGroupId = ($_REQUEST["groupid"] <> "") ? trim($_REQUEST["groupid"]) : "";
if ($xGroupId <> "") {
    $sql = "SELECT * FROM m_itemsubgroup WHERE itemgroupno = :sid";
    try {
        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":sid", trim($xGroupId));
        $stmt->execute();
        $results = $stmt->fetchAll();
    } catch (Exception $ex) {
        echo($ex->getMessage());
    }
     if (count($results) > 0) {
        ?>
        <label>Sub-Group: 
            <select name="f_itemsubgroupno" name="box">
                <option value="0">Choose Sub-Group</option>
                <?php foreach ($results as $rs) { ?>
                    <option value="<?php echo $rs["itemsubgroupno"]; ?>"><?php echo $rs["itemsubgroupname"]; ?></option>
                <?php } ?>
            </select>
        </label>
        <?php
    }
}
?>