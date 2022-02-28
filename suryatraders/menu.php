<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <?php
        include 'title.php';
        //$GLOBALS ['xUserName'] = $_SESSION['member_id'];
        $xUserName = $GLOBALS ['xUserName'];
        $xRole = 'U';
        $result = mysql_query("select * from m_login where username='$xUserName'")or die(mysql_error());
        $count = mysql_num_rows($result);
        $row = mysql_fetch_array($result);
        if ($count > 0) {
            $xRole = $row['role'];
        }
        ?>
        <link href="css/msofficemenu.css" rel="stylesheet" type="text/css" />
    </head>

    <body onFocus="parent_disable();" onclick="parent_disable()">
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript">
// JavaScript popup window function

        function basicPopup(url) {
            popupWindow = window.open(url, 'popUpWindow', 'height=600,width=1300,left=25,top=20,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes')
        }
        </script>


        <div id="nav">
            <ul>
            <li><a href="homepage_billing.php">Home</a></li>
                <li><span tabindex="1">Master</span>
                    <ul>
                        <li><a href="inv_hm007_customer.php">Customer</a></li>
                        <li><a href="inv_hm011_hsncode.php">HsnCode</a></li>
                        <li><a href="inv_hm002itemcategory.php">Category</a></li>
                        <li><a href="inv_hm008size.php">Size</a></li>
                        <li><a href="inv_hm009gsm.php">Gsm</a></li>
                        <li><a href="inv_hm010_manufacturer.php">Manufacturer</a></li>
							
                    </ul>
				</li>
					 <li><a href="inv_suryatradersbill1.php">Billing</a></li>
                     <li><a href="rent_billing.php">Rent-Billing</a></li>
					<!-- <li><span tabindex="2">Print</span>
									
                    <ul>
							<li><a href="print_format_1.php">P-1</a></li>
							<li><a href="print_format_2.php">P-2</a></li>
							<li><a href="print_format_3_new.php">P-3(GELATINE,Potassium BiChromate)</a></li>
								
             </ul>
             !-->
			 </li>
			 		  <li><span tabindex="2">Return</span>
									
                    <ul>
							<li><a href="purchase_return.php">Purchase Return</a></li>
							<li><a href="sales_return.php">Sals Return</a></li>
             </ul>
             </li>
			              <?php
            // if($xRole=="ADMIN")
           //  {
             ?>
             	 <li><span tabindex="3">Report</span>
									
                    <ul>
							<li><a href="report_section1.php">Section1</a></li>
							<li><a href="report_section2.php">Section2</a></li>
                            <li><a href="report_section3.php">Section3</a></li>
             </ul>
             </li>
             
             <?php
            // }
             ?>
			 	 <li><a href="settings.php">Settings</a></li>
			
<!--
	 <li><span tabindex="3">Return</span>				
                    <ul>
							<li><a href="purchase_return.php">P.R</a></li>
							<li><a href="sales_return.php">S.R</a></li>
             </ul>
			 !-->
			 </li>
				  <li><a href="logout.php"> Logout [<?php echo $xUserName; ?>] </a></li>


            </ul>
        </div>
    </body>
</html>
