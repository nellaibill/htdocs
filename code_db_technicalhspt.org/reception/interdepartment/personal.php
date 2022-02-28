
<?php
include 'globalfile.php';

if (isset ( $_POST ['save'] ))
{

	DataProcess ( "S");
}

if (isset ( $_GET ['id'] ) && ! empty ( $_GET ['id'] )) {
	$no = $_GET ['id'];
	if ($_GET ['xmode'] == 'delete') {
$xQry = "DELETE FROM personal WHERE id= $no";
		$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	} 
	header ( 'Location: personal.php' );
}
		
function DataProcess($mode) {
 $xMonth= $_POST ['f_month'];
$xDetails= $_POST ['f_details'];
$xAmount= $_POST ['text'];
if ($mode == 'S') 
{
$xQry="";
$xMsg="";
$xQry = "INSERT INTO personal(month,details,amount)  VALUES ('$xMonth','$xDetails',$xAmount)";
$retval = mysql_query ( $xQry ) or die ( mysql_error () );
header ( 'Location: personal.php' );
}
}
?>
<html >
<head>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>
<body>
    <form name="calculator"  action="<?php echo $_SERVER['PHP_SELF']; ?>"method="post">
            <div class="panel panel-primary">
               <div class="panel-heading text-center"> CALCULATAR
                </div> 

<div class="container">

  
   </br>
  <div class="row" >
      

     <div class="col-sm-4">    
                <label>Month</label>
 <select class="form-control" name="f_month">
    <option value=''>--Select Month--</option>
    <option selected value="Janaury">Janaury</option>
    <option value="February">February</option>
    <option value="March">March</option>
    <option value="April">April</option>
    <option value="May">May</option>
    <option value="June">June</option>
    <option value="July">July</option>
    <option value="August">August</option>
    <option value="September">September</option>
    <option value="October">October</option>
    <option value="November">November</option>
    <option value="December">December</option>
    </select> 
    </div>
                        <div class="col-sm-4">
               <label>Enter Details</label>
                            <input type="text" class="form-control" name="f_details">
                        </div>
                        
                           <div class="col-sm-4">
                             <label>AMOUNT</label>
<table class="table table-hover" border="1">
<tr>
<td>
<input type="text" name="text" size="18">
<br>
</td>
</tr>
<tr>
<td>
<input type="button" class="btn btn-primary" value="1" onclick="calculator.text.value += '1'">
<input type="button" class="btn btn-primary" value="2" onclick="calculator.text.value += '2'">
<input type="button" class="btn btn-primary" value="3" onclick="calculator.text.value += '3'">
<input type="button" class="btn btn-primary" value="+" onclick="calculator.text.value += ' + '">
<br>
<input type="button" class="btn btn-primary" value="4" onclick="calculator.text.value += '4'">
<input type="button" class="btn btn-primary" value="5" onclick="calculator.text.value += '5'">
<input type="button" class="btn btn-primary" value="6" onclick="calculator.text.value += '6'">
<input type="button" class="btn btn-primary" value="-" onclick="calculator.text.value += ' - '">
<br>
<input type="button" class="btn btn-primary" value="7" onclick="calculator.text.value += '7'">
<input type="button" class="btn btn-primary" value="8" onclick="calculator.text.value += '8'">
<input type="button" class="btn btn-primary" value="9" onclick="calculator.text.value += '9'">
<input type="button" class="btn btn-primary" value="*" onclick="calculator.text.value += ' * '">
<br>
<input type="button" class="btn btn-primary" value="c" onclick="calculator.text.value = ''">
<input type="button" class="btn btn-primary" value="0" onclick="calculator.text.value += '0'">
<input type="button" class="btn btn-primary" value="=" onclick="calculator.text.value = eval(calculator.text.value)">
<input type="button" class="btn btn-primary" value="/" onclick="calculator.text.value += ' / '">
<br>
</td>
</tr>
</table>
                        </div>
                        </div>
                
	
	
						</div><br>
						<div class="row" >
      <div class="panel-footer clearfix">
				
	 
		   <input type="submit" class="btn btn-primary"
						name="save" value="SAVE"
				accesskey="s">
<input type="submit" class="btn btn-primary"
						name="deleteall" value="CLEARALL">
	</div>
			</div>
			<div class="panel-footer clearfix">
				
	 
		   

	</div>
			</div></div>
		
			</div>
			</div>
			</form>
			</body>	 
			
	




<!-- ----------------------- REPORT GOES HERE  ------------------------  !-->

<div id="divToPrint" >
  <div class="container">
<div class="panel panel-info">
  <div class="panel-heading  text-center"><h3 class="panel-title">View Calculator</h3></div>
<table class="table table-hover" border="1">
      <thead>
        <tr>
      
           <th width="30%"> MONTH</th>
           <th width="30%"> DESCRIPTION</th>
           <th width="30%"> AMOUNT</th>
           <th colspan="2" width="5%">ACTIONS</td>
        </tr>
      </thead>
      <tbody>

<?php
$xQry='';
$xAmount=0;
$xQry="SELECT *  from personal order by id"; 
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 

while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    echo '<td>' . $row['month']  . '</td>';
    echo '<td>' . $row['details']  . '</td>';
    echo '<td align=right>' . $row['amount']  . '</td>';
    $xAmount+=$row['amount'];
    ?>
  <td><a href="personal.php<?php echo '?id='.$row['id']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<?
echo '</tr>'; 
}
    echo '<tr>';
        echo '<td>TOTAL</td>';
    echo '<td colspan="2" align=right>' .  round($xAmount,2)  . '</td>';
    echo '</tr>'; 

  
?>	
</tbody>
    </table>	
  </div><!-- /container -->
</div>
