<script type="text/javascript">
function onchangeajax(itemsubgroupno)
 {
alert("hi");
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
 
 var url="inv_filteritem.php"
 url=url+"?itemsubgroupno="+itemsubgroupno
 url=url+"&sid="+Math.random()
document.getElementById("itemdiv").innerHTML='Please wait..<img border="0" src="../images/load.png">'
 if(xmlHttp.onreadystatechange=stateChanged)
 {
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 return true;
 }
 else
 {
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 return false;
 }
 }
 
 function stateChanged()
 {
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 {
 document.getElementById("itemdiv").innerHTML=xmlHttp.responseText
 return true;
 }
 }
 
 function GetXmlHttpObject()
 {
 var objXMLHttp=null
 if (window.XMLHttpRequest)
 {
 objXMLHttp=new XMLHttpRequest()
 }
 else if (window.ActiveXObject)
 {
 objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
 }
 return objXMLHttp;
 }
</script>

<?php
include('globalfunctions.php');
$xItemGroupNo=$_REQUEST['itemgroupno'];
$xQry="SELECT itemsubgroupno,itemsubgroupname from m_itemsubgroup WHERE itemgroupno= $xItemGroupNo";
$stmt = mysql_query($xQry);
?>
<label>Sub-Group:</label>
<div class="col-xs-3">
<select class="form-control" name="f_itemsubgroupno"   onchange="return onchangeajax(this.value);">
<option value ="0">ALL</option>
<?php
while($row = mysql_fetch_array($stmt)) {
?>
<option value = "<?php echo $row['itemsubgroupno']; ?>" 
                                              <?php
                                              if ($row['itemsubgroupname']== $GLOBALS['xItemSubGroupName']){
                                               echo 'selected="selected"';
                                               } 
                                            ?> >
                                           <?php echo $row['itemsubgroupname']; ?> 
                                          </option>
<?
}

?>
</select></div>
<div id="itemdiv"></div>