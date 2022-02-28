<form name="htmlform" method="post" action="inv_ht001_f_complaintsms.php">
<table width="450px">
</tr>
<tr>
 <td valign="top">
  <label for="first_name">First Name *</label>
 </td>
 <td valign="top">
  <input  type="text" name="first_name" maxlength="50" size="30">
 </td>
</tr>
 
<tr>
 <td valign="top"">
  <label for="last_name">Last Name *</label>
 </td>
 <td valign="top">
  <input  type="text" name="last_name" maxlength="50" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="telephone">Telephone Number *</label>
 </td>
 <td valign="top">
  <input  type="text" name="telephone" maxlength="10" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="comments">Comments *</label>
 </td>
 <td valign="top">
  <textarea  name="comments" maxlength="1000" cols="25" rows="6"></textarea>
 </td>
</tr>
<tr>
 <td colspan="2" style="text-align:center">
  <input type="submit" value="Submit"> 
 </td>
</tr>
</table>
</form>
<?php
if (strlen($_POST[telephone]) == 10) {
$message="Dear ".$_POST[first_name]." ".$_POST[last_name].", Your message : ".$_POST[comments];
$message=rawurlencode($message);

$fullapiurl="http://smsc.biz/httpapi/send?username=mdsaleem1804@gmail.com@gmail.com&password=Saleem2580&sender_id=PROMOTIONAL&route=P&phonenumber=9578795653,".$_POST[telephone]."&message=".$message;
// rawurlencode() Encoded message
//Call API
$ch = curl_init($fullapiurl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch); 
echo "<p style='color:green'>".$result."</p>" ; // For Report or Code Check
curl_close($ch);
}
else
{
echo "<p style='color:red'>ERROR</p>" ;
}
//echo "<br><p>SMS Sent....</p>";
?>