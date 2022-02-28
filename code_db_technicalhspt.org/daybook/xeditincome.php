  <?php 
include('config.php');
$xDate = $_GET['date']; 
$results = mysql_query("select * from xincome where date='$xDate'"); 
$row = mysql_fetch_assoc($results); 
$date = $row['date'];
$ip = $row['ip'];
$opl = $row['opl'];
$opm = $row['opm'];
$lab = $row['lab'];
$scan = $row['scan'];
$xray = $row['xray'];
$ecg = $row['ecg'];
$others = $row['others'];
      ?>

<html>
<title>Day Book</title>
<form action="xincomeinsert.php" method="post">
<h1>TO INSERT RECORDS </H1>
<pre>
         Date       :	<input type="date" name="date" value="<?php echo $date; ?>" > 

                  NAME                  AMOUNT       
                          
               In-Patient  :    <input type="text" name="ip"  value="<?php echo $ip; ?>"> 

            Out-Patient(L) :    <input type="text" name="opl"  value="<?php echo $opl; ?>">  

            Out-Patient(M) :    <input type="text" name="opm"  value="<?php echo $opm; ?>">  

               Lab         :    <input type="text" name="lab"  value="<?php echo $lab; ?>">             

               SCAN        :    <input type="text" name="scan" value="<?php echo $scan; ?>">  

               X-RAY       :    <input type="text" name="xray" value="<?php echo $xray; ?>">  

               ECG         :    <input type="text" name="ecg" value="<?php echo $ecg; ?>">  

               Others      :    <input type="text" name="others" value="<?php echo $others; ?>" >  

               Description :    <input type="text" name="description" size="100" >  

                                <input type="submit" value="Save" >


<a href="datewise.php">VIEW ALL RECORDS CLICK HERE </a>
<br>
<a href="expenses.php">INSERT EXPENSES DETAILS HERE </a>

</pre>


<br>
<br>
</form>
	