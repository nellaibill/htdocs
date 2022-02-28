<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <?php
        //include 'title.php';
       // $xUserName=$_SESSION['member_id'];
       // $xRole=$_SESSION['user_role'];     
       $xRole='A'; 
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
                <li><a href='homepage_billing.php'>Home</a></li>
                <li><span tabindex="1">INC&EXP</span>
                    <ul>


                        <li><a href="index.php">InsertIncome</a></li>
                        <li><a href="viewincomebetweendates.php">View Income</a></li>
                        <li><a href="viewincomebetweendateandproduct.php">View Income B/W Name</a></li>
                        
                        <li><a href="expenses.php">InsertExpenses</a></li>
                        <li><a href="viewallexpenses.php">View Expenses</a></li>
                        <li><a href="viewexpensesbetweendateandproduct.php">View Expenses B/W Name</a></li>
						                        <li><a href="xviewallexpenses.php">View IT Expenses</a></li>
                        <li><a href="xviewexpensesbetweendateandproduct.php">View IT Expenses B/W Name</a></li>
                       
                    </ul></li>

					
					 
                
 <li><span tabindex="3">F.D</span>
                    <ul>


      <li><a href="fd_opening.php">FD OPENING</a></li>
<li><a href="fd_renewal.php">FD RENEWAL</a></li>
<li><a href="report_fdopening.php">FD OPENING-REPORT</a></li>
<li><a href="report_fdrenewal.php">FD RENEWAL-REPORT</a></li>
<li><a href="report_fdopening_it.php">FD OPENING-REPORT(IT)</a></li>
<li><a href="report_fdrenewal_it.php">FD RENEWAL-REPORT(IT)</a></li>
                       
                    </ul></li>

               
                <li><span tabindex="4">Tools</span>
                    <ul>

                        <li><a href="hc001fromtodate.php" onclick="basicPopup(this.href);return false">Set Date </a></li>
                        <li><a href="" onclick="PrintDiv(); return false">Print</a></li>
                        <li><a href="" onclick="RefreshPage(); return false">Refresh </a></li>
                          <li><a href="xviewconsolidatedbetweendate.php">Consolidated Report</a></li>
                    </ul>

                <li><a href="logout.php"> Logout </a></li>


            </ul>
        </div>
    </body>
</html>
