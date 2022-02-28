<?php
include('session.php');
?>
<html>
<title>INSERT INCOME</title>
<body bgcolor="pink">
<form action="insert.php" method="post">
<a href="aviewexpenses.php">INSERT EXPENSES</a>
<a href="../logout.php">LOGOUT</a>
<center><h1>INSERT INCOME RECORDS  HERE</H1></center>
<br>
<pre>
         Date       :	<input type="date" name="date" > 
		 
                  <b>NAME                  AMOUNT     </b>  
                          
               In-Patient  :    <input type="text" name="ip"> 

            Out-Patient(L) :    <input type="text" name="opl">  

            Out-Patient(M) :    <input type="text" name="opm">  

               Lab         :    <input type="text" name="lab">            

               SCAN        :    <input type="text" name="scan"> 

               X-RAY       :    <input type="text" name="xray">  

               ECG         :    <input type="text" name="ecg">  

               Others      :    <input type="text" name="others">  

               Description :    <input type="text" name="description" size="100">  

                                <input type="submit" value="Save" >






<br>
</h2>
</pre>


<br>
<br>
</form>
	